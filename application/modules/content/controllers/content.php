<?php
/**
 * Contents Controllers
 */
class Content extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function view($id) {
		$data['value'] = new Contents($id);
		$data["value"]->counter("views");
		$this->template->build("view",$data);
	}
}
