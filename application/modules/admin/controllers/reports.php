<?php
/**
 * Reports Controller
 */
class Reports extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("reports","extra")) {
			redirect("admin");
		}
	}
	
	public function index() {
		if(permission("reports","extra")) {
		$data["variable"] = new Result();

		if(@$_GET["r"]) {
			$data["variable"]->where("result_type_id",$_GET["r"]);
		}

		if(@$_GET["d"]) {
			$data["variable"]->where("deposits",$_GET["d"]);
		}

		$data["variable"]->order_by("id","DESC")->get_page();
		$this->template->build("reports/index",$data);
		} else {
			redirect("admin");
		}
	}
	
	public function form($id=null) {
		if(permission("reports","extra")) {
			$data["value"] = new Result($id);
			$this->template->build("reports/form",$data);
		} else {
			redirect("admin/reports");
		}
	}
	
	public function save($id=null) {
		if(permission("reports","extra")) {
			if($_POST) {
				
				if(@empty($_POST["import_time"])) {
					$_POST["import_time"] = date("Y-m-d");
				}
				
				$data = new Result($id);
				$data->from_array($_POST);
				$data->save();
				
				if(@$_POST["file_path"]) {
					$data->file_size = @filesize($data->file_path);	
					$data->save();
				}
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/reports");
	}
	
	public function delete($id) {
		if(permission("reports","extra")) {
			if($id) {
				$data = new Result($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/reports");
	}
	
	public function get_calendar() {
		$date_start = date('Y-m-d', $_GET['start']);
		$date_end = date('Y-m-d', $_GET['end']);
		$variable = new Result();
		$variable->get();
		
		$day = (24*60*60*1000);
		foreach ($variable as $key => $value) {
			$title = null;
			$color = null;;
			switch ($value->result_type_id) {
				case 1:
					$title = "รายสัปดาห์";
					$color = "#337AB7";
					break;
				case 2:
					$title = "รายเดือน";
					$color = "#f0AD4E";
					break;
				default:
					$title = "รายวัน";
					$color = "#5cb85c";
					break;
			}
			$data_[] = array(
				"title"		=> $value->title,
				"start"	=> date("Y-m-d", strtotime($value->import_time)),
				"url"		=> "reports/views/".$value->id,
				"color"	=> $color
			);
		}
		
		echo json_encode(@$data_);
	}
	
}
