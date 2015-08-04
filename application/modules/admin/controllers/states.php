<?php
class States extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 7;
		$this->modules_name = 'states';
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
		$data['result'] = new State();
		if(@$_GET['search']!=''){
			$condition = "  state_name LIKE '%".$_GET['search']."%'";
			$data['result']->where($condition);
		}
		if(@$_GET['country_id']!=''){
			$data['result']->where('country_id',$_GET['country_id']);
		}
		$data["result"]->order_by("state_name","ASC")->get_page();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		$data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		$this->template->build('states/index',$data);
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
		 $data["value"] = new State($id);		 
		 $this->template->build("countries/form",$data);
	}
	
	public function save($id=null) {
			$current_user_id = $this->session->userdata("id");
			
			if ($_POST) {
				$save = new State();
				if($_POST['id']==''){					
					$_POST['created_by'] = $current_user_id; 
				}else{
					$_POST['updated_by'] = $current_user_id;
				}
				$save->from_array($_POST);
				$save->save();
			}
		redirect("admin/".$this->modules_name);
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
				$data = new State($id);
				$data->delete();
				
				//save_logs('delete', $id);
			}
		redirect("admin/".$this->modules_name);
	}	
}
