<?php
/**
 * Report Controller
 */
class Reports extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	//	การปฏิบัติการฝนหลวงประจำวัน
	public $url_perday = "http://164.115.100.119/BRRAAintranet/reportcenter/OperateDataPublic.xml";
	
	//	ผลการปฏิบัติการรายเดือน/สัปดาห์
	public $result_list = "http://164.115.100.119/rpt_m/rpt_m.php";

	public $type = array(
		"1"	=> array("result_type_id" => 0,"deposits" => 0,"title" => "รายวัน"),
		"2"	=> array("result_type_id" => 0,"deposits" => 1,"title" => "รายงานสถานการณ์ภัยแล้งและภัยพิบัติ"),
		"3"	=> array("result_type_id" => 0,"deposits" => 2,"title" => "รายวัน (กส.9)"),
		"4"	=> array("result_type_id" => 1,"deposits" => 0,"title" => "รายสัปดาห์"),
		"5"	=> array("result_type_id" => 1,"deposits" => 2,"title" => "รายสัปดาห์ (กส.9)"),
		"6"	=> array("result_type_id" => 2,"deposits" => 0,"title" => "รายเดือน"),
		"7"	=> array("result_type_id" => 2,"deposits" => 2,"title" => "รายเดือน (กส.9)")
	);
	
	public function index() {
		$data["variable"] = new Result();
		$data["variable"]->order_by("id","DESC");
		if(@$_GET["t"]) {
			$data["variable"]->where("result_type_id",$_GET["t"])->get_page();
		} else {
			$data["variable"]->where("result_type_id !=",0)->get_page();
		}
		
		$this->template->build("index",$data);
	}
	
	public function views($id) {
		$data["value"] = new Result($id);
		if($data["value"]->status==1) {
			$data["value"]->counter("views");
			
			if(@strlen(strip_tags($data["value"]->detail))<20) {
				redirect("reports/download/".$data["value"]->id);
				exit();
			}
			
			$this->template->build("views",$data);
		} else {
			show_404();
		}
	}
	
	public function download($id) {
		if($id) {
			$content = new Result($id);
			$content->counter("downloads");

			$url = preg_replace("/ /", "%20", $content->file_path);

			$data = file_get_contents($url);
			$name = basename($url);
			force_download($name,$data);
		}
		redirect("reports");
	}
	
	public function get_list($type) {
		$data["variable"] = new Result();
		$data["variable"]->where("status",1);
		
		switch ($type) {
			case "day":
				$data["variable"]->where("result_type_id",0)->where("deposits",0)->order_by('import_time','DESC')->get(); 
				break;
			case "day1":
				$data["variable"]->where("result_type_id",0)->where("deposits",1)->order_by('import_time','DESC')->get(); 
				break;
			case "day2":
				$data["variable"]->where("result_type_id",0)->where("deposits",2)->order_by('import_time','DESC')->get(); 
				break;
			case "week":
				$data["variable"]->where("result_type_id",1)->where("deposits",0)->order_by('import_time','DESC')->get(); 
				break;
			case "week2":
				$data["variable"]->where("result_type_id",1)->where("deposits",2)->order_by('import_time','DESC')->get(); 
				break;
			case "month":
				$data["variable"]->where("result_type_id",2)->where("deposits",0)->order_by('import_time','DESC')->get(); 
				break;
			case "month2":
				$data["variable"]->where("result_type_id",2)->where("deposits",2)->order_by('import_time','DESC')->get(); 
				break;
		}
		
		$this->load->view("get_list",$data);
	}
	
	public function get_calendar() {
		$this->load->view("get_calendar");
	}
	
	public function gen_calendar() {
		$date_start = date('Y-m-d', $_GET['start']);
		$date_end = date('Y-m-d', $_GET['end']);
		$variable = new Result();
		$variable->where("result_type_id",0)->where("status",1)->get();
		
		$day = (24*60*60*1000);
		foreach ($variable as $key => $value) {
			$title = null;
			$color = null;;
			switch ($value->deposits) {
				case 1:
					$color = "#337AB7";
					break;
				default:
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
	
	//	การปฏิบัติการฝนหลวงประจำวัน
	public function daily() {
		$data["results"] = array(
			"day"	=> array("result_type_id" => 0,"deposits" => 0),
			"day1"	=> array("result_type_id" => 0,"deposits" => 1),
			"day2"	=> array("result_type_id" => 0,"deposits" => 2),
		);

		$data["variable"] = new Result();
		$data["variable"]->where("status",1)->order_by("import_time","DESC")->get_page();
		
		$this->template->build("index_daily",$data);
	}

	public function lists($type) {
		$foo = $this->type;
		$data["title"] = $foo[$type]["title"];
		$data["variable"] = new Result();

		$data["variable"]->where("result_type_id",$foo[$type]["result_type_id"])->where("deposits",$foo[$type]["deposits"]);

		$data["variable"]->where("status",1)->order_by("import_time","DESC")->get_page();
		$this->template->build("lists",$data);
	}
	
	//	ฝนสะสมรายวันจากเรดาร์
	public function rader_daily() {
		$this->template->build("rader_daily");
	}
	
	public function results() {
		$data["variable"] = new Result();
		$data["variable"]->order_by("import_time","DESC")->get_page();
		$this->template->build("result",$data);
	}
	
	public function get_result() {
		require_once("application/libraries/simple_html_dom.php");
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 1);

		ini_set("allow_url_fopen", TRUE);
		
		$html = new Simple_HTML_DOM($this->result_list);
		
		if(empty($html)) {
			echo "ไม่สามารถดึงข้อมูลได้";
		} else {
			$num = count($html->find("table[width=500] tbody tr td a"));
			$x=3;
			for ($i=0; $i < $num; $i++) {
				$result_type_id = 0;	//	set default
				
				$links = iconv("tis-620","utf-8",$html->find("table[width=500] tbody tr td a",$i)->href);
				$file_name = str_replace("Data/", "", $links);
				
				if(stripos(trim(iconv("tis-620","utf-8",$html->find("table[width=500] tbody tr td a",$i)->plaintext)), "สัปดาห์")) {
					$result_type_id = 1;
				}
				
				if(stripos(trim(iconv("tis-620","utf-8",$html->find("table[width=500] tbody tr td a",$i)->plaintext)), "เดือน")) {
					$result_type_id = 2;
				}
				
				if(!file_exists("uploads/results/".$file_name)) {
					
					if(!file_exists("uploads/results")) {
						$maskdir = @umask(0);
						@mkdir("uploads/results",0777);
						@umask($maskdir);
					}
					
					$data = @file_get_contents("http://164.115.100.119/rpt_m/".$links);
					@file_put_contents("uploads/results/".$file_name, $data);
					
					$title = trim(iconv("tis-620","utf-8",$html->find("table[width=500] tbody tr td a",$i)->plaintext));
					$date = @trim(iconv("tis-620","utf-8",$html->find("table[width=500] tbody tr",$x)->children(2)->plaintext));
					$date .= " ".@trim(iconv("tis-620","utf-8",$html->find("table[width=500] tbody tr",$x)->children(2)->next_sibling()->plaintext));
					
					$foo = new Result();
					$foo->title = $title." (กส.9)";
					$foo->result_type_id = $result_type_id;
					$foo->deposits = 2;
					$foo->file_path = "uploads/results/$file_name";
					$foo->import_time = $date;
					$foo->show_date = $date;
					$foo->file_size = filesize($foo->file_path);
					$foo->save();
				}
				
				$x++;
			}
		}
	}
	
}
