<?php
class Signin extends Base_Controller {

	public function __construct() {
		parent::__construct();	
	}

	public function index() {
		$this->load->view("sign_in");
	}
	
	public function action() {
		if(login($this->input->post("email"), $this->input->post("passwords"))) {
			set_notify('success', 'ยินดีต้อนรับเข้าสู่ระบบ');
			redirect("admin");
		} else {
		
			set_notify('error', 'Username หรือ Password ไม่ถูกต้อง กรุณาตรวจสอบ');
			redirect("admin/signin");
		}
	}

}