<?php
class Heritages extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['rs'] = new Heritage();
		if(@$_GET['search']!='')$data["rs"]->where("title LIKE '%".$_GET['search']."%' ");
		if(@$_GET['country_id']>0)$data["rs"]->where("country_id = ".$_GET['country_id']." ");
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