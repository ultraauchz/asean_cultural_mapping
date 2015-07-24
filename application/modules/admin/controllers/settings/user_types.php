<?php
/**
 * User_Types Controllers
 */
class User_Types extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data["variable"] = new User_Type();
		$data["variable"]->where("id !=",1)->get_page();
		$this->template->build("user_types/index",$data);
	}
	
	public function form($id=null) {
		$data["value"] = new User_Type($id);
		$this->template->build("user_types/form",$data);
	}
	
	public function save($id=null) {
		if($_POST) {
			$data = new User_Type($id);
			$data->from_array($_POST);
			$data->save();
		}
		redirect("admin/settings/user_types");
	}
	
	public function delete($id) {
		if($id) {
			$data = new User_Type($id);
			$data->delete();
		}
		redirect("admin/settings/user_types");
	}
	
}
