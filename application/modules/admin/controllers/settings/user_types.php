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
			$current_user_id = $this->session->userdata("id");
			if(@$_POST['id']>0){
				$_POST['updated_by'] = $current_user_id; 
			}else{
				$_POST['created_by'] = $current_user_id; 
			}
			$data = new User_Type();
			$data->from_array($_POST);
			$data->save();
			$perm['user_type_id'] = $data->id;
			$this->db->query("DELETE FROM acm_user_type_permission WHERE user_type_id = ".$_POST['id']);
			$menus = new System_Menu();
			$menus->where('url IS NOT NULL')->order_by("title","ASC")->get();
			foreach($menus as $key=>$menu_item):
				$perm['menu_id'] = $menu_item->id;
				$perm['can_view'] = @$_POST['chk_'.$menu_item->id.'_view_access'];
				$perm['can_create'] = @$_POST['chk_'.$menu_item->id.'_create_access'];
				$perm['can_delete'] = @$_POST['chk_'.$menu_item->id.'_delete_access'];
				$perm['can_access_all'] = @$_POST['chk_'.$menu_item->id.'_access_all'];
				$user_type_perm = new User_Type_Permission();
				$user_type_perm->from_array($perm);
				$user_type_perm->save();
			endforeach;
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
