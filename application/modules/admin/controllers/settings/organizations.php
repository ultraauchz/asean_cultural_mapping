<?php
/**
 * Organizations Controller
 */
class Organizations extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 5;
		$this->modules_name = 'organizations';
		/*
		if(!permission("hilights","views")) {
			redirect("admin");
		}
		 * 
		 */
	}

	public function index() {
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["rs"] = new Organization();
		 if(@$_GET['search'] != '') $data["rs"]->where("  org_name LIKE '%".$_GET['search']."%' ");
		 if(@$_GET['country_id'] != '') $data["rs"]->where("  country_id = ".$_GET['country_id']." ");
		 $data["rs"]->order_by("id","desc")->get_page();
		 $data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
	     $data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		 save_logs($this->menu_id, 'View', 0 , 'View Organizations ');
		 $this->template->build("organizations/index",$data);
	}

	public function form($id=null) {
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["rs"] = new Organization($id);
		 save_logs($this->menu_id, 'View', @$data['rs']->id , 'View Organizations Detail '.@$data['rs']->org_name);
		 $this->template->build("organizations/form",$data);
	}

	public function save($id=null) {
			if($_POST) {
				$data = new Organization($id);
				$data->from_array($_POST);
				$data->save();
				$action = @$_POST['id'] > 0 ? 'UPDATE' : 'CREATE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->org_name.' Organizations ');
			}
		redirect("admin/settings/organizations");
	}

	public function delete($id) {
			if($id) {
				$data = new Hilight($id);
				$action = 'DELETE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->org_name.' Organizations ');
				$data->delete();
			}
		redirect("admin/organizations");
	}
	
}