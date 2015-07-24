<?php
/**
 * Faqs Controller
 */
class Faqs extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("faqs","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("faqs","views")) {
			$data["variable"] = new Faq();
			
			if(@$_GET["g"]) {
				$data["variable"]->where("faq_group_id",$_GET["g"]);
				$data["title"] = new Faq_Group($_GET["g"]);
			}
			
			$data["variable"]->order_by('orders','asc')->get_page();
			$this->template->build("faqs/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("faqs","create")) {
			$data["value"] = new Faq($id);
			$this->template->build("faqs/form",$data);
		} else {
			redirect("admin/faqs");
		}
	}

	public function save($id=null) {
		if(permission("faqs","create")) {
			if($_POST) {
				$data = new Faq($id);
				$data->from_array($_POST);
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/faqs?g=".$_POST['faq_group_id']);
	}

	public function delete($id) {
		if(permission("faqs","delete")) {
			if($id) {
				$data = new Faq($id);
				$g = ($data->faq_group_id) ? $data->faq_group_id : 1;
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/faqs?g=$g");
	}
	
}