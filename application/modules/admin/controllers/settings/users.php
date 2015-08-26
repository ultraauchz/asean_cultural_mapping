<?php
/**
 * Users Controllers
 */
class Users extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->menu_id = 3;
		$this->modules_name = 'users';
		$this->current_user = user();
		$this->perm = current_user_permission($this->menu_id);
		if($this->perm->can_view!='y'){
			redirect("admin");
		}
	}

	public function index() {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['current_user'] = $this->current_user;
		$data['perm'] = $this->perm;
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		$data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		
		$data["variable"] = new User();
		if(@$_GET['search']!='')$data["variable"]->where("username LIKE '%".$_GET['search']."%' OR firstname LIKE '%".$_GET['search']."%' OR lastname LIKE '%".$_GET['search']."%' ");
		if(@$_GET['org_id']>0)$data["variable"]->where("org_id = ".$_GET['org_id']);
		if($this->perm->can_access_all != 'y')
		 {
		 	$data["variable"]->where("org_id IN (SELECT id FROM acm_organization WHERE country_id = ".$this->current_user->organization->country_id.") ");
		 }
		 else if(@$_GET['country_id'] != '') 
		 {
		 	$data["variable"]->where("org_id IN (SELECT id FROM acm_organization WHERE country_id = ".$_GET['country_id'].") ");
		 }		
		$data["variable"]->where("id !=",user()->id)->get_page();
		save_logs($this->menu_id, 'View', 0 , 'View Users ');
		$this->template->build("users/index",$data);
	}

	public function form($id=false) {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['current_user'] = $this->current_user;
		$data['perm'] = $this->perm;
		$data["value"] = new User($id);
		save_logs($this->menu_id, 'View', @$data['value']->id , 'View User Detail');
		$this->template->build("users/form",$data);
	}

	public function save($id=false) {
		if($this->perm->can_create =='y'){
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
				$data->org_id = $_POST['org_id'];
				$data->position = strip_tags($_POST['position']);
				$data->user_type_id = $_POST['user_type_id'];			
				$data->username = strip_tags($_POST['username']);
				$data->status = !empty($_POST['status']) ? '1' : '0';
				if($_POST['id']==''){
					$data->created_by = $this->current_user->id; 
				}else{
					$data->updated_by = $this->current_user->id;
				}
				$data->save();
				$action = $_POST['id'] > 0 ? 'UPDATE' : 'CREATE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->firstname.' '.$data->lastname.' User Detail');
			}
		}
		redirect("admin/settings/users");
	}

	public function delete($id = null) {
		if($this->perm->can_delete == 'y'){
			if($id) {
				$data  = new User($id);
				$action = 'DELETE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->firstname.' '.$data->lastname.' User Detail');
				$this->db->query("DELETE FROM acm_user WHERE id=".$id);
			}		
		}
		redirect('admin/settings/users');
	}
}
