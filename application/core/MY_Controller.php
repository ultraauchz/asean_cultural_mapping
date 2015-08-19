<?php
/*
 * Public Controller
 */
class Base_Controller extends MX_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->template->title("ASEAN Cultural Mapping");
		$this->template->set_layout("default/layout");
		$this->template->append_metadata(js_notify());
		
		if(!$this->session->userdata("color")) {
			$this->session->set_userdata("color", "default");
		}
    }
	
	public function captcha() {
		$this->load->library("captcha");
		$captcha = new Captcha();
		$captcha->size = 6;
		$captcha->session = "captcha";
		$captcha->display();
	}
	
}
 
/*
 * Admin Controller
 * Required login
 */
class Admin_Controller extends MX_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->template->title("ASEAN Cultural Mapping");
		$this->template->set_layout("admin/layout");
		$this->template->append_metadata(js_notify());
		
		if(user()->id < 1){
			set_notify('error', 'กรุณาเข้าสู่ระบบ');
			redirect("admin/signin");
		}
		/*if(!permission("admin","extra")) {
			set_notify('error', 'กรุณาเข้าสู่ระบบ');
			redirect("admin/signin");
		}*/
	} 
}