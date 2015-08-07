<?php
/**
 * Organizations Controller
 */
class Organizations extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 5;
		$this->modules_name = 'organizations';
		/*
		if(!permission("hilights","views")) {
			redirect("admin");
		}
		 * 
		 */
	}

	public function index() {
		/*
		if(permission("hilights","views")) {
			$data["variable"] = new Hilight();
			$data["variable"]->order_by("orders","ASC")->get_page();
			$this->template->build("hilights/index",$data);
		} else {
			redirect("admin");
		}
		 * 
		 */
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["rs"] = new Organization();
		 $data["rs"]->order_by("id","desc")->get_page();
		 $this->template->build("organizations/index",$data);
	}

	public function form($id=null) {
		/*
		if(permission("hilights","create")) {
			$data["value"] = new Hilight($id);
			$this->template->build("hilights/form",$data);
		} else {
			redirect("admin/hilights");
		}
		 * 
		 */
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["rs"] = new Organization($id);
		 $this->template->build("organizations/form",$data);
	}

	public function save($id=null) {
		// if(permission("hilights","create")) {
			if($_POST) {
				$data = new Organization($id);
				$data->from_array($_POST);
				$data->save();
				
				// $type = ($id)?'edit':'add'; // for logs.
				// save_logs($type, $data->id);
			}
		// }
		redirect("admin/settings/organizations");
	}

	public function delete($id) {
		// if(permission("hilights","delete")) {
			if($id) {
				$data = new Hilight($id);
				$data->delete();
				
				// save_logs('delete', $id);
			}
		// }
		redirect("admin/organizations");
	}
	
}