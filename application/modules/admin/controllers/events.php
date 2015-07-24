<?php
/*
 * Events Controller
 */
class Events extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		if(!permission("events","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("events","views")) {
			$data["variable"] = new Event();		
			if (!empty($_GET['g'])) {
				$data['variable']->where('event_type_id', $_GET['g']);
				$data["title"] = new Event_type($_GET["g"]);
			}
			$data["variable"]->get_page();
			
			$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
			$this->template->build("events/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("events","create")) {
			$data["value"] = new Event($id);
			if (!empty($_GET['g'])) {
				$data["title"] = new Event_type($_GET["g"]);
				$data["value"]->event_type_id = $data["title"]->id;
			}
			$this->template->build("events/form",$data);
		} else {
			redirect("admin/events");
		}
	}

	public function save($id=null) {
		if(permission("events","create")) {
			if($_POST) {
				$date = new DateTime("tomorrow");
				
				if(empty($_POST["start_date"])) {
					$_POST["start_date"] = date("Y-m-d");
				}
				
				if(empty($_POST["end_date"])) {
					$_POST["end_date"] = $date->format("Y-m-d");
				}
				
				$data = new Event($id);
				$data->from_array($_POST);
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/events?g=".$_POST["event_type_id"]);
	}

	public function delete($id) {
		if(permission("events","delete")) {
			if($id) {
				$data = new Event($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/events?g=".@$_GET["g"]);
	}

}