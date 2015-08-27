<?php
class blueprint extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 11;
		$this->perm = current_user_permission($this->menu_id);
		if($this->perm->can_view!='y'){
			redirect("admin");
		}
	}
	
	public function index() {
		$data['can_save'] = $this->perm->can_create;				
		save_logs($this->menu_id, 'View', $this->session->userdata("id"), ' View ASEAN Blue Print ');
		$rs = new Contents();
		$data['rs'] = $rs->where("slug","blueprint")->get(1);
		$data['menu_id'] = $this->menu_id;
		$this->template->build("contents/form",$data);
	}
	
	public function save(){
		if($this->perm->can_create=='y'){
			$data = new Contents();
			if($_POST['id']==''){
				$_POST['created_by'] = $this->current_user->id; 
			}else{
				$_POST['updated_by'] = $this->current_user->id;
			}
			$data->from_array($_POST);
			$data->save();
			save_logs($this->menu_id, 'Update', $this->session->userdata("id"), ' Update ASEAN Blue Print ');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
}
