<?php
class Countries extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 6;;
		$this->modules_name = 'countries';
		$this->user = user();
		$this->perm = current_user_permission($this->menu_id);
		if($this->perm->can_view!='y'){
			redirect("admin");
		}
	}
	
	public function index() {		
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;		
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		$data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		$data['perm'] = $this->perm;
		$data['result'] = new Country();		
		if(@$_GET['search']!=''){
			$condition = "  country_name LIKE '%".$_GET['search']."%'";
			$data['result']->where($condition);
		}
		$data["result"]->order_by("country_name","ASC")->get_page();		
		save_logs($this->menu_id, 'View', 0 , 'View Countries ');
		$this->template->build('countries/index',$data);
	}
	
	public function form($id=null) {
		 $data['perm'] = $this->perm;
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["value"] = new Country($id);		 
		 save_logs($this->menu_id, 'View', $data['value']->id , 'View Country Detail');
		 $this->template->build("countries/form",$data);
	}
	
	public function save($id=null) {
		if($this->perm->can_create=='y'){
			if ($_POST) {
				$save = new Country();
				if($_POST['id']==''){					
					$_POST['created_by'] = $this->user->id; 
				}else{
					$_POST['updated_by'] = $this->user->id;
				}
				$save->from_array($_POST);
				$save->save();
				$action = $_POST['id'] > 0 ? 'UPDATE' : 'CREATE';
				save_logs($this->menu_id, $action, $save->id , $action.' '.$save->country_name.' Country');
			}
		}
		redirect("admin/".$this->modules_name);
	}	
	
	public function delete($id=null) {
		if($this->perm->can_delete=='y'){
			if($id) {				
				$data = new Country($id);
				$action = 'DELETE';
				save_logs($this->menu_id, $action, $data->id , $action.' '.$data->country_name.' Country');
				$data->delete();				
			}
		}
		redirect("admin/".$this->modules_name);
	}	
}
