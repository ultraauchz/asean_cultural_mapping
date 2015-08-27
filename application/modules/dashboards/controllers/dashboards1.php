<?php
class Dashboards extends Public_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('Analytics');
		$this->lang->load('stat');
	}
	
	function ajax_load()
	{
		$ga = new Analytics();
		var_dump($ga);
        //$ga->authen(site()->google_user, site()->google_password,'ga:'.site()->google_analytics_id);
        //$now=date("Y-m-d");
        //$lastmonth=date('Y-m-01');

        //Summery: visitors, unique visit, pageview, time on site, new visits, bounce rates
        //$today = $ga->getSummery($now,$now);
        //$summery = $ga->getSummery($lastmonth,$now);
		//$allTimeSummery = $ga->getAllTimeSummery();
        echo '<div id="stat">
            <span id="today"></span> วันนี้ '.number_format($ga->getTotay()).' คน &nbsp;
            <span id="month"></span> เดือนนี้ '.number_format($ga->getMonth()).' คน &nbsp;
            <span id="all"></span> ทั้งหมด '.number_format($ga->getTotal()).' คน
        </div>';
	}
	
	function inc_side()
	{
		$this->load->view("inc_side");
	}
	
}
?>