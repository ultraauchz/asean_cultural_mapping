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
		$data['menu_id'] = 0;
		//save_logs($data['menu_id'], 'View', $this->session->userdata("id"), ' View Dashboard ');
		//redirect('admin/dashboards');
		$this->template->build("index",@$data);
	}
	
	public function signout() {
		logout();
		redirect("index");
	}		
}