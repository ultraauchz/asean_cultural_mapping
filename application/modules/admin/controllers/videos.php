<?php
/**
 * Videos Controller
 */
class Videos extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("videos","views")) {
			redirect("admin");
		}
	}
	
	public function index() {
		if(permission("pages","views")) {
			$data["variable"] = new Video();
			$data["variable"]->order_by('orders', 'asc')->get_page();
			$this->template->build("videos/index",$data);
		} else {
			redirect("admin");
		}
	}
	
	public function form($id=null) {
		if(permission("pages","create")) {
			$data["value"] = new Video($id);
			$this->template->build("videos/form",$data);
		} else {
			redirect("admin");
		}
	}
	
	public function save($id=null) {
		if(permission("pages","create")) {
			if($_POST) {
				$data = new Video($id);
				$data->from_array($_POST);
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/videos");
	}
	
	public function delete($id) {
		if(permission("pages","delete")) {
			if($id) {
				$data = new Video($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/videos");
	}
	
	public function get() {
		echo Youtube2Iframe($_POST["video"], 560, 315);
	}
	
}