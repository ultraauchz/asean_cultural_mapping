<?php
class Organizations extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['menu_id'] = '7';
		$this->template->build('organizations/index',$data);
	}

	function Chart($country_id){
		$data['org_chart'] = new Organization_Chart();
		$data['org_chart']->where('country_id = '.$country_id)->get();
		$this->template->build('organizations/chart',$data);
	}	
}	
?>