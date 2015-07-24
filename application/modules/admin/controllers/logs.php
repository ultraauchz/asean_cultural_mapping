<?php
/**
 * Logs Controller
 */
class Logs extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("logs","extra")) {
			redirect("admin");
		}
	}

	public function index() {
		$data["variable"] = new Log;

		if(@$_GET["sch_s_d"]) {
			$s_date = $_GET["sch_s_d"];

			if($_GET["sch_s_h"]) {
				$s_hour = sprintf("%02d",$_GET["sch_s_h"]);

				if($_GET["sch_s_m"]) {
					$s_min = sprintf("%02d",$_GET["sch_s_m"]);

					$s_date = $s_date." ".$s_hour.":".$s_min.":00";
				} else {
					$s_date = $s_date." ".$s_hour.":00:00";
				}
			} else {
				$s_date = $s_date." 00:00:00";
			}

			$data["variable"]->where("created >=",$s_date);
		}

		if(@$_GET["sch_e_d"]) {
			$e_date = $_GET["sch_e_d"];

			if($_GET["sch_e_h"]) {
				$e_hour = sprintf("%02d",$_GET["sch_e_h"]);

				if($_GET["sch_e_m"]) {
					$e_min = sprintf("%02d",$_GET["sch_e_m"]);

					$e_date = $e_date." ".$e_hour.":".$e_min.":00";
				} else {
					$e_date = $e_date." ".$e_hour.":00:00";
				}
			} else {
				$e_date = $e_date." 00:00:00";
			}

			$data["variable"]->where("created <=",$e_date);
		}

		$data["variable"]->order_by("id","DESC")->get_page();

		$this->template->build("logs/index",$data);
	}

}