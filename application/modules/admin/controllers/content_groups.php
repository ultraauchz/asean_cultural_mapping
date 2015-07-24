<?php
/*
 * Content_Groups Controller
 */
class Content_Groups extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		if(!permission("content_groups","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("content_groups","views")) {
			$data["variable"] = new Content_Group();
			$data["variable"]->order_by("orders","ASC")->order_by("id","ASC")->get_page();
			$this->template->build("content_groups/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("content_groups","create")) {
			$data["value"] = new Content_Group($id);
			$this->template->build("content_groups/form",$data);
		} else {
			redirect("admin/content_groups");
		}
	}

	public function save($id=null) {
		if(permission("content_groups","create")) {
			if($_POST) {
				$data = new Content_Group($id);
				$data->web_type_id = 1;
				$data->from_array($_POST);
				$data->title = $_POST["title"];
				$data->is_index = (@$_POST["is_index"]) ? 1 : 0;
				$data->is_thumbnail = (@$_POST["is_thumbnail"]) ? 1 : 0;
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/content_groups");
	}

	public function delete($id) {
		if(permission("content_groups","delete")) {
			if($id) {
				$data = new Content_Group($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/content_groups");
	}

}