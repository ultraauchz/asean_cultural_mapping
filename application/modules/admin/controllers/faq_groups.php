<?php
/*
 * Faq_Groups Controller
 */
class Faq_Groups extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data["variable"] = new Faq_Group();
		$data["variable"]->order_by('orders','asc')->get_page();
		$this->template->build("faq_groups/index",$data);
	}

	public function form($id=null) {
		$data["value"] = new Faq_Group($id);
		$this->template->build("faq_groups/form",$data);
	}

	public function save($id=null) {
		if($_POST) {
			$data = new Faq_Group($id);
			$data->from_array($_POST);
			$data->save();
			
			$type = ($id)?'edit':'add'; // for logs.
			save_logs($type, $data->id);
		}
		redirect("admin/faq_groups");
	}

	public function delete($id) {
		if($id) {
			$data = new Faq_Group($id);
			$data->delete();
			
			save_logs('delete', $id);
		}
		redirect("admin/faq_groups");
	}

}