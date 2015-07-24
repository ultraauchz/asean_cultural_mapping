<?php
/*
 * Events_type Controller
 */
class Events_type extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		if(!permission("events_type","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("events_type","views")) {
			$data["variable"] = new Event_type();		
			$data["variable"]->order_by('orders', 'asc')->get_page();
			$this->template->build("events_type/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("events_type","views")) {
			$data["value"] = new Event_type($id);
			$this->template->build("events_type/form",$data);
		} else {
			redirect("admin/events_type");
		}
	}

	public function save($id=null) {
		if(permission("events_type","create")) {
			if($_POST) {
				$date = new DateTime("tomorrow");
				
				if(empty($_POST["start_date"])) {
					$_POST["start_date"] = date("Y-m-d");
				}
				
				if(empty($_POST["end_date"])) {
					$_POST["end_date"] = $date->format("Y-m-d");
				}
				
				$data = new Event_type($id);
				$data->from_array($_POST);
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/events_type");
	}

	public function delete($id) {
		if(permission("events_type","delete")) {
			if($id) {
				$chk = new Event();
				$chk->where('event_type_id', $id)->get(1);
				
				if ($chk->id==false) {
					$data = new Event_type($id);
					$data->delete();
					
					save_logs('delete', $id);
				} else {
					set_notify('error', 'ไม่สามารถลบ ข้อมูลที่มีการเชื่อมโยงอยู่ได้');
				}
			}
		}
		redirect("admin/events_type");
	}

}