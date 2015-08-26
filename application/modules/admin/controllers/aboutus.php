<?php
class Aboutus extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 9;
		$this->perm = current_user_permission($this->menu_id);
		if($this->perm->can_view!='y'){
			redirect("admin");
		}
	}
	
	public function index() {		
		$rs = new Contents();
		$data['rs'] = $rs->where("slug","aboutus")->get(1);		
		$data['menu_id'] = $this->menu_id;
		save_logs($this->menu_id, 'View', $data['rs']->id, ' View Aboutus ');
		$data['can_save'] = $this->perm->can_create;
		$this->template->build("contents/form",$data);
	}
	
	public function save(){
		if($this->perm->can_create=='y'){
			$data = new Contents();
			$_POST['updated_by'] = date("Y-m-d H:i:s");
			$data->from_array($_POST);
			$data->save();
			save_logs($this->menu_id, 'Update', $data->id, ' Update Aboutus ');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
}