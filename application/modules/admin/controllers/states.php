<?php
class States extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 7;
		$this->modules_name = 'states';
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
		$data['current_user'] = $this->user;
		$data['perm'] = $this->perm;
		
		$data['result'] = new State();
		if(@$_GET['search']!='')$data['result']->where("state_name LIKE '%".$_GET['search']."%'");
		if($this->perm->can_access_all != 'y')
		 {
		 	$data["result"]->where("  country_id = ".$this->user->organization->country_id." ");
		 }
		 else if(@$_GET['country_id'] != '') 
		 {
		 	$data["result"]->where("  country_id = ".$_GET['country_id']." ");
		 }
		$data["result"]->order_by("state_name","ASC")->get_page();		
		save_logs($this->menu_id, 'View', 0 , 'View States ');
		$this->template->build('states/index',$data);		
	}
	
	public function form($id=null) {
		 $data['current_user'] = $this->user;
		 $data['perm'] = $this->perm;		 
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["value"] = new State($id);		 
		 save_logs($this->menu_id, 'View', @$data['value']->id , 'View State Detail');
		 $this->template->build("states/form",$data);
	}
	
	public function save($id=null) {
		if($this->perm->can_create == 'y'){
			if ($_POST) {
				$save = new State();
				if($_POST['id']==''){					
					$_POST['created_by'] = $this->user->id; 
				}else{
					$_POST['updated_by'] = $this->user->id;
				}
				$save->from_array($_POST);
				$save->save();
				$action = $_POST['id'] > 0 ? 'UPDATE' : 'CREATE';
				save_logs($this->menu_id, $action, @$save->id , $action.' '.$save->state_name.' State Detail');
			}
		}
		redirect("admin/".$this->modules_name);
	}	
	
	public function delete($id=null) {
		if($this->perm->can_delete == 'y'){			
			if($id) {
				$data = new State($id);
				$action ='DELETE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->state_name.' State Detail');				
				$data->delete();
			}
		}
		redirect("admin/".$this->modules_name);
	}
	
	public function load_states(){
		$country_id = $_POST['country_id'];
		$states = new State();
		if($country_id > 0)$states->where('country_id',$country_id);
		$states->get();
		echo '<select name="state_id" class="form-control">';
		echo '<option value="">-- select state --</option>';
		foreach($states as $key=>$state_item):
			echo '<option value="'.$state_item->id.'">'.$state_item->state_name.'</option>';
		endforeach;
		echo '</select>';
	}	
}
