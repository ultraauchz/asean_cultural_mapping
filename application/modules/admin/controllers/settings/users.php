<?php
/**
 * Users Controllers
 */
class Users extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->menu_id = 3;
		$this->modules_name = 'users';
	}

	public function index() {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data["variable"] = new User();

		if(@$_GET["u"]) {
			$data["variable"]->like("username",$_GET["u"]);
		}

		if(@$_GET["f"]) {
			$data["variable"]->group_start()->like("firstname",$_GET["f"])->or_like("lastname",$_GET["f"])->group_end();
		}

		if(@$_GET["s"]) {
			$data["variable"]->where("status",$_GET["s"]);
		}

		$data["variable"]->where("id !=",user()->id)->get_page(50);
		$this->template->build("users/index",$data);
	}

	public function form($id=false) {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data["value"] = new User($id);

		//if($data["value"]->fd_admin==1 || $id==user()->id) {
			//redirect("admin/settings/users");
		//}

		$this->template->build("users/form",$data);
	}

	public function save($id=false) {
		if($_POST) {
			$data = new User($id);

			if($data->fd_admin==1) {
				redirect("admin/settings/users");
			}

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

			if((!empty($_POST["password"])) && ($_POST["password"]===$_POST["passwords"])) {
				$data->passwords = encrypt_password(strip_tags(trim($_POST["passwords"])));
			}

			$data->firstname = strip_tags($_POST["firstname"]);
			$data->lastname = strip_tags($_POST["lastname"]);
			$data->email = strip_tags($_POST["email"]);
			$data->tel = strip_tags($_POST["tel"]);
			$data->heap_id = @$_POST["heap_id"];
			$data->per_cardno = @$_POST["per_cardno"];
			$data->center_id = @($_POST["center_id"]) ? $_POST["center_id"] : 0;
			$data->user_type_id = @($_POST["user_type_id"]) ? $_POST["user_type_id"] : 0;
			$data->request_rain = (@$_POST["request_rain"]==1) ? 1 : 0;
			$data->username = strip_tags($_POST['username']);

			$data->save();
		}
		redirect("admin/settings/users");
	}

	public function delete($id = null) {
		if(!$id) {
			redirect('admin/settings/users');
		}
		
		$this->db->query("delete from ma_user where id = '".$id."'");		
		
		redirect('admin/settings/users');
	}

	public function get_center($id=null) {
		if($id) {
			$foo = new Heap();
			$foo->get_by_org_id($id);
			$heap_id = $foo->id;
			echo @form_dropdown("center_id",get_option("org_id","center_name","ma_center","WHERE heap_id = $heap_id"),null,"class=\"form-control\"","เลือกสำนัก/กอง","");
		}
	}

}
