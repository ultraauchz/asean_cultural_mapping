<?php
/**
 * Users Controllers
 */
class profile extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->menu_id = 24;
		$this->modules_name = 'profile';
		$this->current_user = user();
		$this->perm = current_user_permission($this->menu_id);
	}

	public function index() {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['current_user'] = $this->current_user;
		$data['perm'] = $this->perm;
		$data["value"] = new User($this->current_user->id);
		save_logs($this->menu_id, 'View', @$data['value']->id , 'View Profile Detail');
		$this->template->build("users/form",$data);
	}

	public function save($id=false) {
			$id = $this->current_user->id;
			$_POST['updated_by'] = $this->current_user->id;
			if($_POST) {
				$data = new User($id);
	
				//	ตรวจสอบชื่อ username ซ้ำ
				if(@$_POST["username"]) {
					$chk = new User();
	
					if($id) {
						$chk->where("id !=",$id);
					}
	
					$chk->where("username",strip_tags(trim($_POST["username"])))->get();
	
					if($chk->id) {
						redirect("admin/settings/users");
					}
				}
	
				//	ตรวจสอบชื่อ email ซ้ำ
				if(@$_POST["email"]) {
					$chk = new User();
	
					if($id) {
						$chk->where("id !=",$id);
					}
	
					$chk->where("email",strip_tags(trim($_POST["email"])))->get();
	
					if($chk->id) {
						//	redirect("admin/settings/users");
					}
				}
	
				//	Username
				//	$data->username = strip_tags(trim($_POST["username"]));
				
				
				if(!empty($_POST["password"])) {
					$data->password = encrypt_password(strip_tags(trim($_POST["password"])));
				}
	
				$data->titulation = strip_tags($_POST["titulation"]);
				$data->firstname = strip_tags($_POST["firstname"]);
				$data->lastname = strip_tags($_POST["lastname"]);
				$data->email = strip_tags($_POST["email"]);
				$data->tel = strip_tags($_POST["tel"]);
				$data->position = strip_tags($_POST['position']);
				if($_POST['id']==''){
					$data->created_by = $this->current_user->id; 
				}else{
					$data->updated_by = $this->current_user->id;
				}
				$data->save();
				$action = $_POST['id'] > 0 ? 'UPDATE' : 'CREATE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->firstname.' '.$data->lastname.' User Detail');
			}
		redirect("admin/settings/profile");
	}

}
