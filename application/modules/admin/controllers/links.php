<?php
/**
 * Links Controller
 */
class Links extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("links","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("links","views")) {
			$data["variable"] = new Link();
			
			if(@$_GET["g"]) {
				$data["variable"]->where("link_group_id",$_GET["g"]);
				$data["title"] = new Link_Group($_GET["g"]);
			}
			
			$data["variable"]->order_by("orders","ASC")->order_by("id","DESC")->get_page();
			$this->template->build("links/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("links","create")) {
			$data["value"] = new Link($id);
			$this->template->build("links/form",$data);
		} else {
			redirect("admin/links");
		}
	}

	public function save($id=null) {
		if(permission("links","create")) {
			if($_POST) {
				$data = new Link($id);
				$data->from_array($_POST);
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/links?g=".$_POST['link_group_id']);
	}

	public function delete($id) {
		if(permission("links","delete")) {
			if($id) {
				$rand = new Link_Group();
				$rand->get(1);

				$data = new Link($id);
				$g = ($data->link_group_id) ? $data->link_group_id : $rand->id;
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/links?g=$g");
	}
	
}