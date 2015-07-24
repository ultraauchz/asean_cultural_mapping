<?php
/**
 * Links Controllers
 */
class Links extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data["link_groups"] = new Link_Group();
		$data["link_groups"]->where('status', '1')->get();
		$this->template->build("index",$data);
	}
	
}
