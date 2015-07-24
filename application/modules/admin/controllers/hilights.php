<?php
/**
 * Hilight Controller
 */
class Hilights extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("hilights","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("hilights","views")) {
			$data["variable"] = new Hilight();
			$data["variable"]->order_by("orders","ASC")->get_page();
			$this->template->build("hilights/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("hilights","create")) {
			$data["value"] = new Hilight($id);
			$this->template->build("hilights/form",$data);
		} else {
			redirect("admin/hilights");
		}
	}

	public function save($id=null) {
		if(permission("hilights","create")) {
			if($_POST) {
				$data = new Hilight($id);
				$data->from_array($_POST);
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/hilights");
	}

	public function delete($id) {
		if(permission("hilights","delete")) {
			if($id) {
				$data = new Hilight($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/hilights");
	}
	
}