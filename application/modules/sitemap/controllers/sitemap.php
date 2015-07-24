<?php
/**
 * Sitemap Controllers
 */
class Sitemap extends Base_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper("xml");
	}
	
	public function index() {
		$data["menus"] = new Menu();
		$data["menus"]->where("status",1)->where("parent_id",0)->order_by("orders","ASC")->get();
		
		$data["roots"] = new Menu();
		$data["roots"]->where("status",1)->where("parent_id !=",0)->order_by("orders","ASC")->get();
		
		$data["contents"] = new Content_Group();
		$data["contents"]->where("status",1)->order_by("id","ASC")->get();
		
		$this->template->build("index",$data);
	}
	
	public function xml() {
		$data["menus"] = new Menu();
		$data["menus"]->where("status",1)->order_by("id","ASC")->get();
		
		header("Content-type: text/xml; charset=utf-8");
		$this->load->view("xml",$data);
	}
	
}
