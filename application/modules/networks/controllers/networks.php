<?php
class Networks extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}

	function detail($id){
		$data['rs'] = new Network($id);
		$data['network_org'] = new Network_Org();
		$data['network_org']->where('network_id = '.$id)->get();
		$this->template->build('networks/detail',$data);
	}	
}	
?>