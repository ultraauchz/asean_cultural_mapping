<?php
class Networks extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 14;;
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
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
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
		 $data["value"] = new Network($id);
		 $network_org = new Network_Organization();
		 $network_org->where('network_id',$id)->get();
		 $data['network_org'] = $network_org; 
		 $this->template->build("networks/form",$data);
	}
	
	public function save($id=null) {
			var_dump($_POST);
			if ($_POST) {
				$save = new Network($id);
				$save->from_array($_POST);
				$save->save();
			}
		redirect("admin/networks");
	}
	
	public function save_network_organization($network_id=null){
		if($network_id > 0){			
			foreach($_POST['chk_org_id'] as $key){						
				$ext= new Network_Organization();
				$ext->where('network_id',$network_id)->where("org_id", $key)->get(1);
				if($ext->id) {
					
				}else{					
					$data['network_id'] = $network_id;
					$data['org_id'] = $key;
					$save = new Network_Organization();	
					$save->from_array($data);
					$save->save();
				}
			}			
		}	
		redirect('admin/networks/form/'.$network_id);	
	}
	
	public function delete($id=null) {
			if($id) {
				/*
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
				*/
				$data = new Network($id);
				$data->delete();
				
				//save_logs('delete', $id);
			}
		redirect("admin/networks");
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
