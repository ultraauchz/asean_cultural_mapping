<?php
class Networks extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['rs'] = new Network();
		if(@$_GET['search']!='')$data["rs"]->where("title LIKE '%".$_GET['search']."%' ");
		$data['rs']->order_by('show_no','desc')->get();
		$this->template->build('networks/index',$data);
	}

	function detail($id){
		$data['rs'] = new Network($id);
		$data['network_org'] = new Organization();
		$data['network_org']->where('id in (SELECT org_id FROM acm_network_org WHERE network_id = '.$id.')')->get();		
		$this->template->build('networks/detail',$data);
	}	
}	
?>