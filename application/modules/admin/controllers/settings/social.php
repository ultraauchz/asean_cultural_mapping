<?php
/**
 * Social
 */
class Social extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data["value"] = new Other(1);
		$this->template->build("social/index",$data);
	}
	
	public function save() {
		if($_POST) {
			$data = new Other(1);
			if($_POST["facebook"]) $data->facebook = $_POST["facebook"];
			if($_POST["twitter"]) $data->twitter = $_POST["twitter"];
			if($_POST["email"]) $data->email = $_POST["email"];
			$data->save(); 
		}
		redirect("admin/settings/social");
	}
	
}
