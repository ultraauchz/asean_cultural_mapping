<?php
class Signin extends Base_Controller {

	public function __construct() {
		parent::__construct();	
	}

	public function index() {
		$this->load->view("sign_in");
	}
	
	public function action() {
		if(login($this->input->post("username"), $this->input->post("password"))) {
			set_notify('success', 'ยินดีต้อนรับเข้าสู่ระบบ');
			//save_logs($menu_id, $action, $data_id, $description)
			save_logs(19, 'Log In', $this->session->userdata("id"), $_POST['username'].' Logged In ');			
			redirect("admin");
		} else {
		
			set_notify('error', 'Username หรือ Password ไม่ถูกต้อง กรุณาตรวจสอบ');
			redirect("admin/signin");
		}
	}

}