<?php
class Slides extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!permission("slides","views")) {
			redirect("admin");
		}
	}

	public function index()
	{
		$data["variable"] = new Slide();
		$data["variable"]->order_by("orders","ASC")->order_by("id","DSEC")->get_page();
		$this->template->build("slides/index",$data);
	}

	public function form($id=null)
	{
		if(permission("slides","create")) {
			$data["value"] = new Slide($id);
			$this->template->build("slides/form",$data);
		} else {
			redirect("admin/slides");
		}
	}

	public function save($id=null)
	{
		if(permission("slides","create")) {
			if($_POST) {
				$data = new Slide($id);
				$data->from_array($_POST);
				$data->save();
			}
		}
		redirect("admin/slides");
	}

	public function delete($id)
	{
		if(permission("slides","delete")) {
			if($id) {
				$data = new Slide($id);
				$data->delete();
			}
		}
		redirect("admin/slides");
	}

}