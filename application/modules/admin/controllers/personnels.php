<?php
/**
 * Personnel Controller
 */
class Personnels extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("personnels","views")) {
			redirect("admin");
		}
	}
	
	public function index($dept=null) {
		if(permission("personnels","views")) {
			$data["variable"] = new Personnel();
			$data["variable"]->where('department_id', $dept);
			$data["variable"]->where('parent_id', 0);
			$data["variable"]->order_by('orders', 'asc');
			$data["variable"]->get_page();
			
			$data["dept"] = new Department($dept);
			if (empty($data["dept"]->id)) { redirect("admin/personnels"); }
			$this->template->build("personnels/index",$data);
		} else {
			redirect("admin");
		}
	}
	
	public function forms($dept=null, $parent_id=null) {
		if(permission("personnels","create")) {
			@$data['value'] = new Personnel();
			
			@$data['value']->orders = $this->orders($dept, '', $parent_id);
			@$data['value']->parent_id = $parent_id;
			@$data['max_orders'] = $data['value']->orders;
			
			$data["dept"] = new Department($dept);
			if (empty($data["dept"]->id)) { redirect("admin/personnels"); }
			
			$this->template->build("personnels/form",$data);
		} else {
			redirect("admin/personnels");
		}
	}
	
	public function form($dept=null, $id=null) {
		if(permission("personnels","create")) {
			$data["value"] = new Personnel($id);
			if (empty($id)) {
				@$data['value']->orders = $this->orders($dept);
				@$data['max_orders'] = $data['value']->orders;
			} else {
				@$data['max_orders'] = $this->orders($dept, $id);
			}
			$data["dept"] = new Department($dept);
			if (empty($data["dept"]->id)) { redirect("admin/personnels"); }
			
			$this->template->build("personnels/form",$data);
		} else {
			redirect("admin/personnels");
		}
	}
	
	public function save($dept=null, $parent_id=null, $id=null) {
		if(permission("personnels","create")) {
			$parent_id = (empty($parent_id))?'0':$parent_id;
			if ($_POST) {
				//$parent_id = (empty($_POST['parent_id']))?'0':$_POST['parent_id'];
				$_POST['parent_id'] = $parent_id;
				$data["dept"] = new Department($dept);
				if (empty($data["dept"]->id)) { redirect("admin/personnels"); }
				$_POST['department_id'] = $data["dept"]->id;
				
				$chk = new Personnel();
				$chk->where('orders', $_POST['orders']);
				$chk->where('department_id', $dept);
				$chk->where('parent_id', $parent_id);
				$chk->order_by('orders', 'asc');
				$chk->get_page();
				
				$orders_max = $this->orders($parent_id,$id);
				$orders_old = $this->chk_orders($id);
				if ($chk->id) {
					
					$tmp = new Personnel();
					($_POST['orders'] != $orders_max)?$tmp->where('orders >=', $_POST['orders']):$tmp->where('orders >', $_POST['orders']);
					($id != '')?$tmp->where('orders <=', $orders_old):'';
					$tmp->where('department_id', $dept);
					$tmp->where('parent_id', $parent_id);
					$tmp->order_by('orders', 'asc');
					$tmp->get_page();
					
					foreach ($tmp as $key => $item) {
						$save_update = new Personnel();
						if ($item->id != $id) {
							$update['id'] = $item->id;
							$update['orders'] = $item->orders+1;
							$save_update->from_array($update);
							$save_update->save();
						}
					}
					
					if ($id != '') {
						$tmp2 = new Personnel();
						($_POST['orders'] != '1')?$tmp2->where('orders <=', $_POST['orders']):$tmp2->where('orders <', $_POST['orders']);		
						$tmp2->where('orders >=', $orders_old);
						$tmp2->where('department_id', $dept);
						$tmp2->where('parent_id', $parent_id);
						$tmp2->order_by('orders', 'asc');
						$tmp2->get_page();
						foreach ($tmp2 as $key => $item2) {
							$save_update = new Personnel();
							if ($item2->id != $id) {
								$update['id'] = $item2->id;
								$update['orders'] = $item2->orders-1;
								$save_update->from_array($update);
								$save_update->save();
							}
						}
					}
					
				}
				$save = new Personnel($id);
				$save->from_array($_POST);
				$save->save();
			}
		}
		redirect("admin/personnels/index/".$dept);
	}
	
	public function delete($dept_id=null, $id=null, $parent_id=null) {
		if(permission("personnels","delete")) {
			$parent_id = (empty($parent_id))?'0':$parent_id;
			if($id) {
				$tmp = new Personnel($id, $web_type->id);
				$chk_tmp = new Personnel('', $web_type->id);
				$chk_tmp->where('department_id', $dept_id);
				$chk_tmp->where('parent_id', $tmp->id);
				$chk_tmp->get_page();
				if (empty($chk_tmp->id)) {
					$tmp2 = new Personnel('', $web_type->id);
					$tmp2->where('orders >=', $tmp->orders);
					$tmp2->where('department_id', $tmp->department_id);
					$tmp2->where('parent_id', $tmp->parent_id);
					$tmp2->order_by('orders', 'asc');
					$tmp2->get_page();
					foreach ($tmp2 as $key => $item2) {
						$save_update = new Personnel('', $web_type->id);
						if ($item2->id != $id) {
							$update['id'] = $item2->id;
							$update['orders'] = $item2->orders-1;
							$save_update->from_array($update);
							$save_update->save();
						}
					}
	
					$data = new Personnel($id);
					$data->delete();
				}
			}
		}
		redirect("admin/personnels/index/".$dept_id);
	}
	
	public function orders($dept_id=null, $id=null, $parent_id=null) {
		$tmp= new Personnel($id);
		if (empty($id)) {
			$tmp->select("max(orders) as orders");
			$tmp->where('department_id', $dept_id);
			if (!empty($parent_id)) {
				$tmp->where('parent_id', $parent_id);
			}
			$tmp->get_page();
			$orders_new =  $tmp->orders+1;
		} else {
			$tmp->select("max(orders) as orders");
			$tmp->where('department_id', $dept_id);
			if (!empty($parent_id)) {
				$tmp->where('parent_id', $parent_id);
			}
			$tmp->get_page();
			$orders_new =  $tmp->orders;
		}
		return $orders_new;
	}
	
	public function chk_orders($id=null) {
		$tmp= new Personnel($id);
		$orders_new =  $tmp->orders;
		return $orders_new;
	}
}
