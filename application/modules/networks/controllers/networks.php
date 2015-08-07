<?php
class Networks extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['rs'] = new Network();
		$data['rs']->order_by('show_no','desc')->get();
		$this->template->build('networks/index',$data);
	}

	function detail($id){
		$data['rs'] = new Network($id);
		$data['network_org'] = new Network_Org();
		$data['network_org']->where('network_id = '.$id)->get();
		$this->template->build('networks/detail',$data);
	}	
}	
?>