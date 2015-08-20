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
	function detail($id){
		$data['org'] = new Organization($id);
		$data['org_network'] = new Network();
		$data['org_network']->where('id IN (select network_id from acm_network_org WHERE org_id='.$id.')')->get();
		$data['heritage_result'] = new Heritage();
		$data['heritage_result']->where('id IN (select heritage_id from acm_heritage_organization WHERE org_id='.$id.')')->get();
		$this->template->build('organizations/detail',$data);
	}
}	
?>