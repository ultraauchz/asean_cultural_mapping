<?php
/**
 * Contents Controllers
 */
class Contacts_us extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("contacts_us","views")) {
			redirect("admin");
		}
	}
	
	public function index() {
		if(permission("contacts_us","views")) {
			$data['variable'] = new Contact_us();
			$data['variable']->order_by("id","DESC")->get_page();
			
			$this->template->build("contacts_us/index",@$data);
		} else {
			redirect("admin");
		}
	}
	
	public function form() {
		if(permission("contacts_us","views")) {
			$data['value'] = new Setting('1');
			$this->template->build("contacts_us/form",@$data);
		} else {
			redirect("admin");
		}
	}
	
	public function view($id) {
		if(permission("contacts_us","views")) {
			if (empty($id)) {
				redirect("admin/contacts_us");
			}
			
			$data['value'] = new Contact_us($id);
			$this->template->build("contacts_us/view",@$data);
		} else {
			redirect("admin");
		}
	}
	
	public function save() {
		if(permission("contacts_us","create")) {
			$_POST['contect_ip'] = $_SERVER["REMOTE_ADDR"];
			
			$data = new Setting('1');
			$data->from_array($_POST);
			$data->save();
		}
		//set_notify('success', 'บันทึกข้อมูลเรียบร้อย');	
		redirect("admin/contacts_us");
	}
	
	public function delete($id) {
		if(permission("contacts_us","delete")) {
			if($id) {
				$data = new Contact_us($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/contacts_us");
	}
	
	public function chk_captcha () {
		if(check_captcha(@$_GET["captcha"])) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
}
