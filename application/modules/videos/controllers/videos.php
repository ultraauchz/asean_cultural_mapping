<?php
/**
 * Videos Controllers
 */
class Videos extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data["variable"] = new Video();
		$data["variable"]->where("status",1)->order_by("id","DESC")->get_page();
		$this->template->build("index",$data);
	}
	
	public function view($id) {
		$data["value"] = new Video($id);
		$this->template->build("view",$data);
	}
	
}
