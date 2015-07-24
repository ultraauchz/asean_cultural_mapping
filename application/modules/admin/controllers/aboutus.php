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
		$contents = new Contents();
		$data['contents'] = $contents->where("slug='aboutus'");
		$data['menu_id'] = $this->menu_id;
		$this->template->build("contents/form",$data);
	}
	
	public function save(){
		
	}
	
}
