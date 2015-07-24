<?php
/*
 * Link_Groups Controller
 */
class Link_Groups extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data["variable"] = new Link_Group();
		$data["variable"]->get_page();
		$this->template->build("link_groups/index",$data);
	}

	public function form($id=null) {
		$data["value"] = new Link_Group($id);
		$this->template->build("link_groups/form",$data);
	}

	public function save($id=null) {
		if($_POST) {
			$data = new Link_Group($id);
			$data->from_array($_POST);
			$data->save();
			
			$type = ($id)?'edit':'add'; // for logs.
			save_logs($type, $data->id);
		}
		redirect("admin/link_groups");
	}

	public function delete($id) {
		if($id) {
			$data = new Link_Group($id);
			$data->delete();
			
			save_logs('delete', $id);
		}
		redirect("admin/link_groups");
	}

}