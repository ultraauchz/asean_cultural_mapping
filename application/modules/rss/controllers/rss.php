<?php
/**
 * RSS Feed Controller
 */
class Rss extends Base_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper("xml");	//	สำหรับแปลง text
	}
	
	public function index() {
		if(!@$_GET["g"]) {
			$data["variable"] = new Content_Group();
			$data["variable"]->where("status",1)->order_by("id","ASC")->get();
			$this->template->build("index",$data);
		} else {
			$data["feed_name"] = "RSS Feed";
			$data["encoding"] = "utf-8";
			$data["feed_url"] = base_url()."rss";
	       	$data["page_language"] = "th";
	       	$data["page_description"] = "RSS Feed";
	       	$data["creator_email"] = "nnoreply@royalrain.go.th";
			
			$limit = 50;
			
			if(@is_numeric($_GET["n"])) {
				$limit = $_GET["n"];
			}
			
			$data["variable"] = new Content();
			$data["variable"]->where("status",1)->where("content_group_id",$_GET["g"])->get($limit);
			
			header("Content-type: text/xml; charset=utf-8");
	       	$this->load->view("view",$data);
		}
	}
	
}
