<?php
/**
 * Manage Controller
 */
class Manage extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("centre","extra")) {
			redirect("admin");
		}
	}
	
	public function index() {
		$data["value"] = new Centre_Page(1);
		$this->template->build("centre/index",$data);
	}
	
	public function edit() {
		if($_POST) {
			$data = new Centre_Page(1);
			$data->detail = $_POST["detail"];
			$data->save();
		}
		redirect("admin/centre/manage");
	}
	
	public function form_program($id=null) {
		$data["value"] = new Centre_Program($id);
		$this->template->build("centre/form_program",$data);
	}
	
	public function form_manual($id=null) {
		$data["value"] = new Centre_Manual($id);
		$this->template->build("centre/form_manual",$data);
	}
	
	public function save_program($id=null) {
		if($_POST) {
			$data = new Centre_Program($id);
			$data->from_array($_POST);
			$data->status = 1;
			$data->save();
		}
		redirect("admin/centre/manage");
	}
	
	public function save_manual($id=null) {
		if($_POST) {
			$data = new Centre_Manual($id);
			$data->from_array($_POST);
			$data->status = 1;
			$data->save();
		}
		redirect("admin/centre/manage");
	}
	
	public function delete_program($id) {
		if($id) {
			$data = new Centre_Program($id);
			$data->delete();
		}
		redirect("admin/centre/manage");
	}
	
	public function delete_manual($id) {
		if($id) {
			$data = new Centre_Manual($id);
			$data->delete();
		}
		redirect("admin/centre/manage");
	}
	
	public function list_program() {
		$data["variable"] = new Centre_Program;
		$data["variable"]->where('parent',0)->order_by("orders","ASC")->order_by("id","DESC")->get();

		$data['roots'] = new Centre_Program;
		$data['roots']->where('parent !=',0)->order_by('orders','ASC')->order_by('id','DESC')->get();
		
		$this->load->view("centre/get_program",$data);
	}
	
	public function list_manual() {
		$data["variable"] = new Centre_Manual;
		$data["variable"]->where('parent',0)->order_by("orders","ASC")->order_by("id","DESC")->get();

		$data['roots'] = new Centre_Manual;
		$data['roots']->where('parent !=',0)->order_by('orders','ASC')->order_by('id','DESC')->get();

		$this->load->view("centre/get_manual",$data);
	}
	
}
