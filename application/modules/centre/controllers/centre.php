<?php
/**
 * Centre Controller
 */
class Centre extends Base_Controller {
	
	function __construct() {
		parent::__construct();
		$this->template->set_layout("default/centre");
	}
	
	public function index() {
		$data["value"] = new Centre_Page(1);
		$this->template->build("index",$data);
	}
	
	public function inc_centre() {
		$data["programs"] = new Centre_Program;
		$data["programs"]->where('parent',0)->where("status",1)->order_by('orders','ASC')->order_by("id","DESC")->get();

		$data['root_programs'] = new Centre_Program;
		$data['root_programs']->where('parent !=',0)->where('status',1)->order_by('orders','ASC')->order_by('id','DESC')->get();
		
		$data["manuals"] = new Centre_Manual();
		$data["manuals"]->where('parent',0)->where("status",1)->order_by("id","ASC")->get();

		$data['root_manuals'] = new Centre_Manual;
		$data['root_manuals']->where('parent !=',0)->where('status',1)->order_by('orders','ASC')->order_by('id','DESC')->get();

		$this->load->view("inc_centre",$data);
	}
	
	public function manual($id) {
		$data["value"] = new Centre_Manual($id);
		$this->template->build("manual",$data);
	}
	
}
