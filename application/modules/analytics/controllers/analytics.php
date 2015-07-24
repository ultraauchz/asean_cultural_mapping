<?php
class Analytics extends Base_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('admin/ga');
	}
	
	function index()
	{
		$ga = new ga();
		$this->ga->authen('royalrain2512@gmail.com','rain2512','ga:98468001');
		if($_GET)
		{
			$now=Date2DB($_GET['date']);
		}
		else
		{
			$now=date("Y-m-d");
		}
	
		$lastmonth=date('Y-m-d', strtotime('-29 days',mysql_to_unix($now)));

		//Summery: visitors, unique visit, pageview, time on site, new visits, bounce rates
		$data['summery']=$this->ga->getSummery($lastmonth,$now);
		
		//All time summery: visitors, page views
		$data['allTimeSummery']=$this->ga->getAllTimeSummery();
		
		//Last 10 days visitors (for graph)
		$data['visits']=$this->ga->getVisits($lastmonth,$now,30);
		
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
		$this->template->append_metadata(js_datepicker());
		$this->template->build("index",$data);
	}
	
	function inc_home()
	{
		$ga = new ga();
		$ga->authen('royalrain2512@gmail.com','rain2512','ga:98468001');
		$data['allTimeSummery']=$ga->getAllTimeSummery();
		$this->load->view("inc_home",$data);
	}
	
	function tracking_script(){
		// analytics
		echo "<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			  ga('create', 'UA-26850682-6', 'auto');
			  ga('send', 'pageview');
			
			</script>";
			
		// histat
		echo '<style>#histatsC{display:none !important;}</style><!-- Histats.com  START  (standard)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15_gif.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="" ><script  type="text/javascript" >
try {Histats.startgif(1,2915783,4,8006,"");
Histats.track_hits();} catch(err){};
</script></a>
<!-- Histats.com  END  -->';
	}
}
?>