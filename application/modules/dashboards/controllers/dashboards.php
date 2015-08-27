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
            <span id="today"></span> Today '.number_format($ga->getToday()).' users &nbsp;
            <span id="month"></span> This Month '.number_format($ga->getMonth()).' users &nbsp;
            <span id="all"></span> All '.number_format($ga->getTotal()).' users
        </div>';	
	}
	
	function inc_side()
	{
		$this->load->view("inc_side");
	}
	
}
?>