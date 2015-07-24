<?php
/**
 * Layouts Controllers
 */
class Layouts extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data["variable"] = new Web_Layout();
		$data["variable"]->order_by("orders","ASC")->get();
		$this->template->build("layouts/index",$data);
	}
	
	public function save() {
		if($_POST) {
			foreach ($_POST["id"] as $key => $value) {
				$data = new Web_Layout($value);
				$data->orders = $_POST["orders"][$key];
				$data->save();
			}
		}
		redirect("admin/layouts");
	}
	
}