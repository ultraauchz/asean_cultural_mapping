<?php
/**
 * User_Types Controllers
 */
class User_Types extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 4;
		$this->modules_name = 'user_types';
	}
	
	public function index() {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data["variable"] = new User_Type();
		$data["variable"]->where("id !=",1)->get_page();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		$this->template->build("user_types/index",$data);
	}
	
	public function form($id=null) {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data["value"] = new User_Type($id);
		$data["menus"] = new System_Menu();
		$data['menus']->where('url IS NOT NULL')->order_by("title","ASC")->get();		
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
