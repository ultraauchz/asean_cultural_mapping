<?php
class Networks extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 15;
		$this->modules_name = 'networks';
		/*
		if(!permission("organizations","views")) {
			redirect("admin");
		}
		 * 
		 */
	}
	
	public function index() {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['result'] = new Network();
		$data["result"]->order_by("id","ASC")->get_page();
		$this->template->build('networks/index',$data);
		/*
		if(permission("departments","views")) {
			$data["variable"] = new Department();
			$data["variable"]->where('parent_id','0');
			$data["variable"]->order_by('orders', 'asc');
			$data["variable"]->get();
			$this->template->build("departments/index",$data);
		} else {
			redirect("admin");
		}*/
		
	}
	
	public function form($id=null) {
		/*
		if(permission("departments","create")) {
			$data["value"] = new Department($id);
			if (empty($id)) {
				@$data['value']->orders = $this->orders(0);
				@$data['max_orders'] = $data['value']->orders;
			} else {
				@$data['max_orders'] = $this->orders($data["value"]->parent_id, $id);
			}
			$this->template->build("departments/form",$data);
		} else {
			redirect("admin/departments");
		}
		 * 
		 */
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $this->template->build("networks/form",$data);
	}
	
	public function forms($parent_id=null) {
		if(permission("departments","create")) {
			$data["value"] = new Department();
			@$data["value"]->parent_id = $parent_id;
			@$data['value']->orders = $this->orders($parent_id);
			@$data['max_orders'] = $data['value']->orders;
			$this->template->build("departments/form",$data);
		} else {
			redirect("admin/departments");
		}
	}
	
	public function save($id=null) {
		if(permission("departments","create")) {
			if ($_POST) {
				$parent_id = (empty($_POST['parent_id']))?'0':$_POST['parent_id'];
				$chk = new Department();
				$chk->where('orders', $_POST['orders']);
				$chk->where('parent_id', $parent_id);
				$chk->order_by('orders', 'asc');
				$chk->get_page();
				
				$orders_max = $this->orders($parent_id,$id);
				$orders_old = $this->chk_orders($id);
				if ($chk->id) {
					
					$tmp = new Department();
					($_POST['orders'] != $orders_max)?$tmp->where('orders >=', $_POST['orders']):$tmp->where('orders >', $_POST['orders']);
					($id != '')?$tmp->where('orders <=', $orders_old):'';
					$tmp->where('parent_id', $parent_id);
					$tmp->order_by('orders', 'asc');
					$tmp->get_page();
					
					foreach ($tmp as $key => $item) {
						$save_update = new Department();
						if ($item->id != $id) {
							$update['id'] = $item->id;
							$update['orders'] = $item->orders+1;
							$save_update->from_array($update);
							$save_update->save();
						}
					}
					
					if ($id != '') {
						$tmp2 = new Department();
						($_POST['orders'] != '1')?$tmp2->where('orders <=', $_POST['orders']):$tmp2->where('orders <', $_POST['orders']);		
						$tmp2->where('orders >=', $orders_old);
						$tmp2->where('parent_id', $parent_id);
						$tmp2->order_by('orders', 'asc');
						$tmp2->get_page();
						foreach ($tmp2 as $key => $item2) {
							$save_update = new Department();
							if ($item2->id != $id) {
								$update['id'] = $item2->id;
								$update['orders'] = $item2->orders-1;
								$save_update->from_array($update);
								$save_update->save();
							}
						}
					}
					
				}
				$save = new Department($id);
				$save->from_array($_POST);
				$save->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/departments");
	}
	
	public function delete($id=null) {
		if(permission("departments","delete")) {
			if($id) {
				
				$tmp = new Department($id);
				$tmp2 = new Department();
				$tmp2->where('orders >=', $tmp->orders);
				$tmp2->where('parent_id', $tmp->parent_id);
				$tmp2->order_by('orders', 'asc');
				$tmp2->get_page();
				foreach ($tmp2 as $key => $item2) {
					$save_update = new Department();
					if ($item2->id != $id) {
						$update['id'] = $item2->id;
						$update['orders'] = $item2->orders-1;
						$save_update->from_array($update);
						$save_update->save();
					}
				}
	
				$data = new Department($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/departments");
	}
	
	public function orders($parent_id=null, $id=null) {
		if(permission("departments","create")) {
			$tmp= new Department($id);
			if (empty($id)) {
				$tmp->select("max(orders) as orders");
				$tmp->where('parent_id', $parent_id);
				$tmp->get_page();
				$orders_new =  $tmp->orders+1;
			} else {
				$tmp->select("max(orders) as orders");
				$tmp->where('parent_id', $parent_id);
				$tmp->get_page();
				$orders_new =  $tmp->orders;
			}
		}
		return $orders_new;
	}
	
	public function chk_orders($id=null) {
		$tmp= new Department($id);
		$orders_new =  $tmp->orders;
		return $orders_new;
	}
}
