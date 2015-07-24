<?php
/**
 * Pages Controllers
 */
class Pages extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("pages","views")) {
			redirect("admin");
		}
	}
	
	public function index() {
		if(permission("pages","views")) {
			$data["variable"] = new Page();
			$data["variable"]->order_by("id","DESC")->get_page();
			$this->template->build("pages/index",$data);
		} else {
			redirect("admin");
		}
	}
	
	public function form($id=null) {
		if(permission("pages","create")) {
			$data["value"] = new Page($id);
			$this->template->build("pages/form",$data);
		} else {
			redirect("admin/pages");
		}
	}
	
	public function save($id=null) {
		if(permission("pages","create")) {
			if($_POST) {
				$data = new Page($id);
				$data->from_array($_POST);
				$data->save();
				
				$data->slug = (@$_POST['slug']) ? clean_url($_POST["slug"]) : clean_url($_POST["title"])."-".$data->id;
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/pages");
	}

	public function delete($id) {
		if(permission("pages","delete")) {
			if($id) {
				$data = new Page($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/pages");
	}
	
}
