<?php
/**
 * Pilots Controllers
 */
class Pilots extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->template->build("index");
	}
	
	public function step($id) {
		$this->load->view("step_$id");
	}
	
}
