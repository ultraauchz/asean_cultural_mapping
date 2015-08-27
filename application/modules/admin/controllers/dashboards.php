<?php
class Dashboards extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('analytics');
	}
    
    function index()
	{
		//Addlog("read",'ดูรายการจำนวนคนเข้าเว็บไซต์');	
		//$this->ga->authen('favouritedesign@gmail.com','F@vourite','ga:75710162');
		$data['menu_id'] = 22;
		$ga = new analytics();
		if($_GET)
		{
			$now=$_GET['date'];
		}
		else
		{
			$now=date("Y-m-d");
		}
	
		$lastmonth=date('Y-m-d', strtotime('-29 days',mysql_to_unix($now)));

		//Last 10 days visitors (for graph)
		//$data['visits']=$this->ga->getVisits($lastmonth,$now,30);
		$visits = $ga->getResultDate('visits', $lastmonth, $now);
		foreach ($visits as $key => $v) {
			$data['visits'][$key]['ga:date'] = $v['0'];
			$data['visits'][$key]['ga:visits'] = $v['1'];
		}
		
		
		//Summery: visitors, unique visit, pageview, time on site, new visits, bounce rates
		//$data['summery']=$this->ga->getSummery($lastmonth,$now);
		$data['summery']['ga:visits'] = $ga->getResult('visits', $lastmonth, $now);
		$data['summery']['ga:visitors'] = $ga->getResult('visitors', $lastmonth, $now);
		$data['summery']['ga:pageviews'] = $ga->getResult('pageviews', $lastmonth, $now);
		$data['summery']['ga:timeOnSite'] = $ga->getResult('timeOnSite', $lastmonth, $now);
		$data['summery']['ga:newVisits'] = $ga->getResult('newVisits', $lastmonth, $now);
		$data['summery']['ga:bounces'] = $ga->getResult('bounces', $lastmonth, $now);
		$data['summery']['ga:entrances'] = $ga->getResult('entrances', $lastmonth, $now);
		
		
		//All time summery: visitors, page views
		//$data['allTimeSummery']=$this->ga->getAllTimeSummery();
		$data['allTimeSummery']['ga:visits'] = $ga->getResult('visits', '2005-01-01', $now);
		$data['allTimeSummery']['ga:pageviews'] = $ga->getResult('pageviews', '2005-01-01', $now);
		
		//Top 10 visitor countries
		//$data['topCountries']=$this->ga->getTopCountry($lastmonth,$now,10);
		$topCountries = $ga->getResultDate('visits', $lastmonth, $now, 'country', '10', '-ga:visits');
		foreach ($topCountries as $key => $v) {
			$data['topCountries'][$key]['ga:country'] = $v['0'];
			$data['topCountries'][$key]['ga:visits'] = $v['1'];
		}
		
		
		//Top 10 search engine keywords
		//$data['topKeywords'] = $this->ga->getTopKeyword($lastmonth,$now,10);
		$topKeywords = $ga->getResultDate('visits', $lastmonth, $now, 'keyword', '10', '-ga:visits');
		foreach ($topKeywords as $key => $v) {
			$data['topKeywords'][$key]['ga:keyword'] = $v['0'];
			$data['topKeywords'][$key]['ga:visits'] = $v['1'];
		}
		
		//Top 10 referrer websites
		//$data['topReferrer']=$this->ga->getTopReferrer($lastmonth,$now,10);
		$topReferrer = $ga->getResultDate('visits', $lastmonth, $now, 'source', '10', '-ga:visits');
		foreach ($topReferrer as $key => $v) {
			$data['topReferrer'][$key]['ga:source'] = $v['0'];
			$data['topReferrer'][$key]['ga:visits'] = $v['1'];
		}
		
		//Top 10 page views
		//$data['topPages']=$this->ga->getTopPage($lastmonth,$now,10);
		$topPages = $ga->getResultDate('visits', $lastmonth, $now, 'pagePath', '10', '-ga:visits');
		foreach ($topPages as $key => $v) {
			$data['topPages'][$key]['ga:pagePath'] = $v['0'];
			$data['topPages'][$key]['ga:visits'] = $v['1'];
		}
		
		//Top 10 visitor operating systems
		//$data['topOs']=$this->ga->getTopOs($lastmonth,$now,10);
		$topOs = $ga->getResultDate('visits', $lastmonth, $now, 'operatingSystem', '10', '-ga:visits');
		foreach ($topOs as $key => $v) {
			$data['topOs'][$key]['ga:operatingSystem'] = $v['0'];
			$data['topOs'][$key]['ga:visits'] = $v['1'];
		}
		
		//Top 10 visitor browsers
		//$data['topBrowsers']=$this->ga->getTopBrowser($lastmonth,$now,10);
		$topBrowsers = $ga->getResultDate('visits', $lastmonth, $now, 'browser', '10', '-ga:visits');
		foreach ($topBrowsers as $key => $v) {
			$data['topBrowsers'][$key]['ga:browser'] = $v['0'];
			$data['topBrowsers'][$key]['ga:visits'] = $v['1'];
		}
		
		//$this->template->append_metadata(js_datepicker());
		$this->template->build("dashboards/index",$data);
	}
	
	function ajax_load()
	{
		$ga = new analytics();
		if($_GET)
		{
			$now=Date2DB($_GET['date']);
		}
		else
		{
			$now=date("Y-m-d");
		}
	
		$lastmonth=date('Y-m-d', strtotime('-29 days',mysql_to_unix($now)));

		//Last 10 days visitors (for graph)
		//$data['visits']=$this->ga->getVisits($lastmonth,$now,30);
		$visits = $ga->getResultDate('visits', $lastmonth, $now);
		foreach ($visits as $key => $v) {
			$data['visits'][$key]['ga:date'] = $v['0'];
			$data['visits'][$key]['ga:visits'] = $v['1'];
		}
		
		
		//Summery: visitors, unique visit, pageview, time on site, new visits, bounce rates
		//$data['summery']=$this->ga->getSummery($lastmonth,$now);
		$data['summery']['ga:visits'] = $ga->getResult('visits', $lastmonth, $now);
		$data['summery']['ga:visitors'] = $ga->getResult('visitors', $lastmonth, $now);
		$data['summery']['ga:pageviews'] = $ga->getResult('pageviews', $lastmonth, $now);
		$data['summery']['ga:timeOnSite'] = $ga->getResult('timeOnSite', $lastmonth, $now);
		$data['summery']['ga:newVisits'] = $ga->getResult('newVisits', $lastmonth, $now);
		$data['summery']['ga:bounces'] = $ga->getResult('bounces', $lastmonth, $now);
		$data['summery']['ga:entrances'] = $ga->getResult('entrances', $lastmonth, $now);
		
		
		//All time summery: visitors, page views
		//$data['allTimeSummery']=$this->ga->getAllTimeSummery();
		$data['allTimeSummery']['ga:visits'] = $ga->getResult('visits', '2005-01-01', $now);
		$data['allTimeSummery']['ga:pageviews'] = $ga->getResult('pageviews', '2005-01-01', $now);
		
		//Top 10 visitor countries
		//$data['topCountries']=$this->ga->getTopCountry($lastmonth,$now,10);
		$topCountries = $ga->getResultDate('visits', $lastmonth, $now, 'country', '10', '-ga:visits');
		foreach ($topCountries as $key => $v) {
			$data['topCountries'][$key]['ga:country'] = $v['0'];
			$data['topCountries'][$key]['ga:visits'] = $v['1'];
		}
		
		
		//Top 10 search engine keywords
		//$data['topKeywords'] = $this->ga->getTopKeyword($lastmonth,$now,10);
		$topKeywords = $ga->getResultDate('visits', $lastmonth, $now, 'keyword', '10', '-ga:visits');
		foreach ($topKeywords as $key => $v) {
			$data['topKeywords'][$key]['ga:keyword'] = $v['0'];
			$data['topKeywords'][$key]['ga:visits'] = $v['1'];
		}
		
		//Top 10 referrer websites
		//$data['topReferrer']=$this->ga->getTopReferrer($lastmonth,$now,10);
		$topReferrer = $ga->getResultDate('visits', $lastmonth, $now, 'source', '10', '-ga:visits');
		foreach ($topReferrer as $key => $v) {
			$data['topReferrer'][$key]['ga:source'] = $v['0'];
			$data['topReferrer'][$key]['ga:visits'] = $v['1'];
		}
		
		//Top 10 page views
		//$data['topPages']=$this->ga->getTopPage($lastmonth,$now,10);
		$topPages = $ga->getResultDate('visits', $lastmonth, $now, 'pagePath', '10', '-ga:visits');
		foreach ($topPages as $key => $v) {
			$data['topPages'][$key]['ga:pagePath'] = $v['0'];
			$data['topPages'][$key]['ga:visits'] = $v['1'];
		}
		
		//Top 10 visitor operating systems
		//$data['topOs']=$this->ga->getTopOs($lastmonth,$now,10);
		$topOs = $ga->getResultDate('visits', $lastmonth, $now, 'operatingSystem', '10', '-ga:visits');
		foreach ($topOs as $key => $v) {
			$data['topOs'][$key]['ga:operatingSystem'] = $v['0'];
			$data['topOs'][$key]['ga:visits'] = $v['1'];
		}
		
		//Top 10 visitor browsers
		//$data['topBrowsers']=$this->ga->getTopBrowser($lastmonth,$now,10);
		$topBrowsers = $ga->getResultDate('visits', $lastmonth, $now, 'browser', '10', '-ga:visits');
		foreach ($topBrowsers as $key => $v) {
			$data['topBrowsers'][$key]['ga:browser'] = $v['0'];
			$data['topBrowsers'][$key]['ga:visits'] = $v['1'];
		}
		$this->load->view("ajax_load",$data);
	}
	
	function ajax_load_bak()
	{

		$this->ga->authen(site()->google_user, site()->google_password,'ga:'.site()->google_analytics_id);
		$now=date("Y-m-d");
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
		$this->load->view("ajax_load",$data);
	}
	
	
	
}
?>