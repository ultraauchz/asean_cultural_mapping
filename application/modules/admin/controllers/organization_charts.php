<?php
/**
 * Departments Controller
 */
class Organization_charts extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 18;
		$this->modules_name = 'organization_charts';
		/*if(!permission("organizations","views")) {
			redirect("admin");
		}
		 * 
		 */
	}
	
	public function index() {
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['rs'] = new Organization_Chart();
		$current_user_id = $this->session->userdata("id");
		$user = new User($current_user_id);
		$country_id = @$_GET['country_id'] > 0 ? $_GET['country_id'] : $user->organization->country_id; 
		$data['rs']->where('country_id',$country_id);
		$data["rs"]->get();
		$this->template->build('organization_charts/form',$data);	
	}
	
	public function save($id=null) {
			if ($_POST) {							
				$save = new Organization_Chart();
				$save->where('country_id',$_POST['country_id']);
				$save->from_array($_POST);
				$save->save();
				
				//$type = ($id)?'edit':'add'; // for logs.
				//save_logs($type, $save->id);
			}
		redirect("admin/organization_charts/index");
	}
}