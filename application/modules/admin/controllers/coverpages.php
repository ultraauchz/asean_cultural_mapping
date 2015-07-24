<?php
/*
 * Coverpages Controller
 */
class Coverpages extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		parent::__construct();
		if(!permission("coverpages","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("coverpages","views")) {
			$data["variable"] = new Coverpage();		
			$data["variable"]->get_page();
			$this->template->build("coverpages/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("coverpages","views")) {
			$data["value"] = new Coverpage($id);
			$this->template->build("coverpages/form",$data);
		} else {
			redirect("admin");
		}
	}

	public function save($id=null) {
		if(permission("coverpages","create")) {
			if($_POST) {
				$data = new Coverpage($id);
				$data->from_array($_POST);
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/coverpages");
	}

	public function delete($id) {
		if(permission("coverpages","delete")) {
			if($id) {
				$data = new Coverpage($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/coverpages");
	}
	
	public function preview($id) {
		$data["value"] = new Coverpage($id);
		$this->load->view("coverpages/preview",$data);
	}

}