<?php
class Admin extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library("ga");
	}
	
	public function approve($model,$id) {
		if($_POST) {
			$foo = new $model($id);
			$foo->status = ($_POST["status"]==1) ? 1 : 0;
			$foo->save();
		}
	}
	
	public function orders($table,$redirect=FALSE) {
		if($_POST) {
			$key = count($_POST["id"]);
			for ($i=0; $i < $key ; $i++) { 
				if(empty($_POST["orders"][$i])) {
					$_POST["orders"][$i] = 0;
				}
				
				if(@$_POST["icon"]==1) {
					$data = array(
							"id" => $_POST["id"][$i],
							"orders" => @is_numeric($_POST["orders"][$i]) ? @$_POST["orders"][$i] : 0,
							"icon_new" => @$_POST["icon_new_".$_POST["id"][$i]]==FALSE ? 0 : 1,
							"icon_update" => @$_POST["icon_update_".$_POST["id"][$i]]==FALSE ? 0 : 1
						);
				} else {
					$data = array(
							"id" => $_POST["id"][$i],
							"orders" => @is_numeric($_POST["orders"][$i]) ? @$_POST["orders"][$i] : 0
						);
				}
				$this->db->where("id",$_POST["id"][$i]);
				$this->db->update($table,$data);
			}
		}
		
		if(@$_POST["g"]) {
			$redirect .= "?g=".$_POST["g"];
		}
		
		if(@$_POST["redirect"]) {
			redirect($_POST["redirect"]);
			return false;
		}

		redirect("admin/$redirect");
	}

	public function inc_graph() {
		$this->load->view("inc_graph");
	}

	public function inc_menu() {
		$data["has_permission"] = 0;
		
		$data["contents"] = new Content_Group();
		$data["contents"]->where("web_type_id",1)->order_by("orders","ASC")->order_by("id","ASC")->get();
		
		$data["ebooks"] = new Ebook_Group();
		$data["ebooks"]->where('status', '1')->get();
		
		$data["faqs"] = new Faq_Group();
		$data["faqs"]->where('status', '1')->get();
		
		$data["links"] = new Link_Group();
		$data["links"]->where('status', '1')->get();
		
		$data["events"] = new Event_type();
		$data["events"]->where('status', '1')->get();
		
		$variable = new Permission();
		$variable->where("module LIKE \"%content\_%\"")->where("module !=","content_groups")->where('user_type_id',user()->user_type_id)->get(1);
		if($variable->id) {
			$data["has_permission"] = 1;
		}
		
		$this->load->view("inc_menu",$data);
	}
	
	public function inc_statistic()
	{
		$ga = new ga();
		$this->ga->authen('royalrain2512@gmail.com','rain2512','ga:98468001');
		//	$ga->authen('royalrain2512@gmail.com','rain2512','ga:98468001');
		$now=date("Y-m-d");
		
		$lastmonth=date("Y-m-d", strtotime('-1 month',mysql_to_unix($now)));

		$data["today"] = $this->ga->getSummery($now,$now);
		$data["month"] = $this->ga->getSummery($lastmonth,$now);
		$data["alltime"] = $this->ga->getAllTimeSummery();
		
		$lastmonth=date('Y-m-d', strtotime('-30 days'));

		//Summery: visitors, unique visit, pageview, time on site, new visits, bounce rates
		$data['summery']=$this->ga->getSummery($lastmonth,$now);
		
		//All time summery: visitors, page views
		$data['allTimeSummery']=$this->ga->getAllTimeSummery();
		
		//Last 10 days visitors (for graph)
		$data['visits']=$this->ga->getVisits(date('Y-m-d', strtotime('-10 days')),$now,10);
		
		//Top 10 search engine keywords
		$data['topKeywords']=$this->ga->getTopKeyword($lastmonth,$now,10);
		
		//Top 10 visitor countries
		$data['topCountries']=$this->ga->getTopCountry($lastmonth,$now,10);
		
		//Top 10 page views
		$data['topPages']=$this->ga->getTopPage($lastmonth,$now,10);
		
		//Top 10 referrer websites
		$data['topReferrer']=$this->ga->getTopReferrer($lastmonth,$now,10);
		
		//Top 10 visitor browsers
		$data['topBrowsers']=$this->ga->getTopBrowser($lastmonth,$now,10);
		
		//Top 10 visitor operating systems
		$data['topOs']=$this->ga->getTopOs($lastmonth,$now,10);
		$this->load->view("inc_statistic",$data);
	}

	public function index() {
		$data['complain'] = new Complain();
		$data['complain']->get_page(10);
		$this->template->build("index",@$data);
	}
	
	public function signout() {
		logout();
		redirect("index");
	}

	public function get_fullcalendar () {
		$date_start = date('Y-m-d', $_GET['start']);
		$date_end = date('Y-m-d', $_GET['end']);
		$events = new Event();
		$events->where('start_date <=', $date_end);
		$events->where('end_date >=', $date_start);
		$events->where("status",1)->get();
		
		foreach ($events as $key => $event) {
			if (empty($event->everyday)) {
				$everyday_[] = array(
									"title"=>$event->title,
									"start"=>$event->start_date,
									"end"=>$event->end_date,
									"url"=>'admin/events/form/'.$event->id,
									"color"=>$event->event_type->code_color
							   ); 
			} else {
				$stert = $event->start_date;
				$end = $event->end_date;
				$one_day = (24 * 60 * 60 * 1000);
				for ($loop = strtotime($event->start_date); $loop <= strtotime($event->end_date); $loop = strtotime("+1 day", $loop)) {
					$eventDate = date('Y-m-d', $loop);
					$loop_day = date('l', $loop);
					if ($loop_day ==  $event->everyday ) {
						$everyday_[] = array(
									"title"=>$event->title,
									"start"=>$eventDate,
									"end"=>$eventDate,
									"url"=>'admin/events/form/'.$event->id,
									"color"=>$event->event_type->code_color
							   );
					}
				}
			}
		}

		echo json_encode(@$everyday_);
	}

	public function get_xml() {
		$url = "http://164.115.100.119/BRRAAintranet/reportcenter/OperateDataPublic.xml";
		$xml = new DOMDocument;
		$xml->load($url);
		
		$variable = $xml->getElementsByTagName("BaseData");
		foreach ($variable as $key => $value) {
			$province = $value->getElementsByTagName("base")->item(0)->nodeValue."<br />";
			echo anchor($value->getElementsByTagName("mapurl")->item(0)->nodeValue,$province);
		}
	}
}