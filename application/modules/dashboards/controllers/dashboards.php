<?php
class Dashboards extends Base_Controller
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
		echo '<div id="stat">
            <span id="today"></span> วันนี้ '.number_format($ga->getToday()).' คน &nbsp;
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