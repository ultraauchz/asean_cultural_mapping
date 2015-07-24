<?php
/**
 * Contents Controllers
 */
class Contacts_us extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data['contact_us'] = new Setting('1');
		
		$this->template->build("index",@$data);
	}
	
	public function save() {
		if(check_captcha($_POST["captcha"])) {
			$_POST['contect_ip'] = $_SERVER["REMOTE_ADDR"];

			if(@$_POST["index"]==1) {
				$_POST["title"] = "(ฟอร์มติดต่อเราหน้าแรก)";
			}
			
			$data = new Contact_us();
			$data->from_array($_POST);
			$data->save();
			
			//set_notify('success', 'บันทึกข้อมูลเรียบร้อย');	
		}
		if(@$_POST["index"]==1) {
			redirect("index");
		} else {
			redirect("contacts_us");	
		}
	}
	
	public function chk_captcha () {
		if(check_captcha(@$_GET["captcha"])) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
}
