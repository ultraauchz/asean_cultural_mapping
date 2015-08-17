<?php
class Aboutus extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 9;
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
		//save_logs($menu_id, $action, $data_id, $description)		
		$rs = new Contents();
		$data['rs'] = $rs->where("slug","aboutus")->get(1);		
		$data['menu_id'] = $this->menu_id;
		save_logs($this->menu_id, 'View', $data['rs']->id, ' View Aboutus ');
		$this->template->build("contents/form",$data);
	}
	
	public function save(){
		$data = new Contents();
		$data->from_array($_POST);
		$data->save();
		save_logs($this->menu_id, 'Update', $data->id, ' Update Aboutus ');
		// $data->check_last_query();
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	
}