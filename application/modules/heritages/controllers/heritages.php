<?php
class Heritages extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['rs'] = new Heritage();
		$data['rs']->order_by('id','desc')->get_page();
		$this->template->build('heritages/index',$data);
	}

	function detail($id){
		$data['rs'] = new Heritage($id);
		if($id>0){
		 	$data["heritage_org"] = new Heritage_Organization();
		 	$data["heritage_org"]->where('heritage_id = '.$id)->get();
		 }
		$this->template->build('heritages/detail',$data);
	}	
}	
?>