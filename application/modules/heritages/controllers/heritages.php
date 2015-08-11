<?php
class Heritages extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['rs'] = new Heritage();
		$data['rs']->order_by('id','desc')->get();
		$this->template->build('heritages/index',$data);
	}

	function detail($id){
		$data['rs'] = new Heritage($id);
		$data['network_org'] = new Network_Org();
		$data['network_org']->where('network_id = '.$id)->get();
		$this->template->build('heritages/detail',$data);
	}	
}	
?>