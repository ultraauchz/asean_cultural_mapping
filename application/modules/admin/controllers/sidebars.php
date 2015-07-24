<?php
/**
 * Sidebar Controller
 */
class Sidebars extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("sidebar","views")) {
			redirect("admin");
		}
	}
	
	public function index() {
		if(permission("sidebar","views")) {
			$data["variable"] = new Sidebar();
			$data["variable"]->order_by("orders","ASC")->order_by("created","DESC")->get();
			$this->template->build("sidebar/index",$data);
		} else {
			redirect("admin");
		}
	}
	
	public function form($id=null) {
		if(permission("sidebar","create")) {
			$data["value"] = new Sidebar($id);
			$this->template->build("sidebar/form",$data);
		} else {
			redirect("admin/sidebars");
		}
	}
	
	public function save($id=null) {
		if(permission("sidebar","create")) {
			if($_POST) {
				$data = new Sidebar($id);
				$data->from_array($_POST);
				$data->save();	
			}
		}
		redirect("admin/sidebars");
	}

	public function delete($id) {
		if(permission("sidebar","delete")) {
			if($id) {
				$data = new Sidebar($id);
				$data->delete();
			}
		}
		redirect("admin/sidebars");
	}
	
}
