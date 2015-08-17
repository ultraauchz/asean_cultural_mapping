<?php
class Countries extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 6;;
		$this->modules_name = 'countries';
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
		$data['result'] = new Country();
		if(@$_GET['search']!=''){
			$condition = "  country_name LIKE '%".$_GET['search']."%'";
			$data['result']->where($condition);
		}
		$data["result"]->order_by("country_name","ASC")->get_page();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		$data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		save_logs($this->menu_id, 'View', 0 , 'View Countries ');
		$this->template->build('countries/index',$data);
	}
	
	public function form($id=null) {
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["value"] = new Country($id);		 
		 save_logs($this->menu_id, 'View', $data['value']->id , 'View Country Detail');
		 $this->template->build("countries/form",$data);
	}
	
	public function save($id=null) {
			$current_user_id = $this->session->userdata("id");
			
			if ($_POST) {
				$save = new Country();
				if($_POST['id']==''){					
					$_POST['created_by'] = $current_user_id; 
				}else{
					$_POST['updated_by'] = $current_user_id;
				}
				$save->from_array($_POST);
				$save->save();
				$action = $_POST['id'] > 0 ? 'UPDATE' : 'CREATE';
				save_logs($this->menu_id, $action, $save->id , $action.' '.$save->country_name.' Country');
			}
		redirect("admin/".$this->modules_name);
	}	
	
	public function delete($id=null) {
			if($id) {				
				$data = new Country($id);
				$action = 'DELETE';
				save_logs($this->menu_id, $action, $data->id , $action.' '.$data->country_name.' Country');
				$data->delete();				
			}
		redirect("admin/".$this->modules_name);
	}	
}
