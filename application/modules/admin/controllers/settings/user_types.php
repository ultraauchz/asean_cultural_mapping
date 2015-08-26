<?php
/**
 * User_Types Controllers
 */
class User_Types extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 4;
		$this->modules_name = 'user_types';
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
		
		$data["variable"] = new User_Type();
		if(@$_GET['search']!='')$data['variable']->where("title LIKE '%".$_GET['search']."%' ");
		$data["variable"]->get_page();
		
		save_logs($this->menu_id, 'View', 0 , 'View User Types ');
		$this->template->build("user_types/index",$data);
	}
	
	public function form($id=null) {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['current_user'] = $this->user;
		$data['sperm'] = $this->perm;
		
		$data["value"] = new User_Type($id);
		$data["menus"] = new System_Menu();
		$data['menus']->where('url IS NOT NULL')->order_by("title","ASC")->get();		
		save_logs($this->menu_id, 'View', @$data['value']->id , 'View User Type Detail');
		$this->template->build("user_types/form",$data);
	}
	
	public function save($id=null) {
		if($this->perm->can_create=='y'){
			if($_POST) {				
				if(@$_POST['id']>0){
					$_POST['updated_by'] = $this->user->id; 
				}else{
					$_POST['created_by'] = $this->user->id; 
				}
				$data = new User_Type();
				$data->from_array($_POST);
				$data->save();
				$action = $_POST['id'] > 0 ? 'UPDATE' : 'CREATE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->title.' User Type Detail');
				$sperm['user_type_id'] = $data->id;
				$this->db->query("DELETE FROM acm_user_type_permission WHERE user_type_id = ".$data->id);
				$menus = new System_Menu();
				$menus->where('url IS NOT NULL')->order_by("title","ASC")->get();
				foreach($menus as $key=>$menu_item):
					$sperm['menu_id'] = $menu_item->id;
					$sperm['can_view'] = @$_POST['chk_'.$menu_item->id.'_view_access'];
					$sperm['can_create'] = @$_POST['chk_'.$menu_item->id.'_create_access'];
					$sperm['can_delete'] = @$_POST['chk_'.$menu_item->id.'_delete_access'];
					$sperm['can_access_all'] = @$_POST['chk_'.$menu_item->id.'_access_all'];
					$user_type_perm = new User_Type_Permission();
					$user_type_perm->from_array($sperm);
					$user_type_perm->save();				
				endforeach;
			}
		}
		redirect("admin/settings/user_types");
	}
	
	public function delete($id) {
		if($this->perm->can_delete=='y'){
			if($id) {
				$data = new User_Type($id);
				$action = 'DELETE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->title.' User Type Detail');
				$this->db->query("DELETE FROM acm_user_type_permission WHERE user_type_id = ".$data->id);
				$this->db->query("DELETE FROM acm_user_type WHERE id = ".$data->id);
			}
		}
		redirect("admin/settings/user_types");
	}
	
}
