<?php
class blueprint extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 11;
		/*
		if(!permission("polls","views")) {
			redirect("admin");
		}
		 */
	}
	
	public function index() {		
			/*
		if(permission("polls","create")) {
			$data["value"] = new Survey($id);
			$this->template->build("poll/form",$data);
		} else {
			redirect("admin/poll");
		}
			 */
		save_logs($this->menu_id, 'View', $this->session->userdata("id"), ' View ASEAN Blue Print ');
		$rs = new Contents();
		$data['rs'] = $rs->where("slug","blueprint")->get(1);
		$data['menu_id'] = $this->menu_id;
		$this->template->build("contents/form",$data);
	}
	
	public function save(){
		$data = new Contents();
		$data->from_array($_POST);
		$data->save();
		save_logs($this->menu_id, 'Update', $this->session->userdata("id"), ' Update ASEAN Blue Print ');
		// $data->check_last_query();
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	
}
