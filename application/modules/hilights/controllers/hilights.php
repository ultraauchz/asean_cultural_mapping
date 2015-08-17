<?php
class Hilights extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}

	function detail($id){
		$data['rs'] = new Hilight($id);
		$this->template->build('hilights/detail',$data);
	}	
}	
?>