<?php
/**
 * Departments Controller
 */
class Organization_charts extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 18;
		$this->modules_name = 'organization_charts';
		$this->current_user = user();
		$this->perm = current_user_permission($this->menu_id);
		if($this->perm->can_view!='y'){
			redirect("admin");
		}
	}
	
	public function index($id=null) {
		$data['current_user'] = $this->current_user;
		$data['perm'] = $this->perm;
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['result'] = new Organization_Chart();
		$data['no'] = 0;
		$country_id = $this->perm->can_access_all == 'y' ? 0 : $this->current_user->organization->country_id; 
		if($country_id > 0 )$data['result']->where('country_id',$country_id);
		$data['result']->include_related('country', 'country_name', true)->order_by('country_name', 'ASC')->get_page();
		save_logs($this->menu_id, 'View', 0, ' View Organization Charts ');
		$this->template->build('organization_charts/index',$data);	
	}
	
	public function form($id=null) {
		$data['current_user'] = $this->current_user;
		$data['perm'] = $this->perm;
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['rs'] = new Organization_Chart($id);
		save_logs($this->menu_id, 'View', $data['rs']->id, ' View '.$data['rs']->country->country_name.' Organization Chart ');
		$this->template->build('organization_charts/form',$data);	
	}
	
	public function save($id=null) {
		if($this->perm->can_create=='y'){
			if ($_POST) {
				$save = new Organization_Chart($id);
				if($_POST['id']==''){
					$_POST['created_by'] = $this->current_user->id; 
				}else{
					$_POST['updated_by'] = $this->current_user->id;
				}
				$save->from_array($_POST);
				$save->save();
				$action = 'Update ';
				save_logs($this->menu_id, $action , $save->id, $action.' '.$save->country->coutry_name.' Organization Chart ');
			}
		}
		redirect("admin/organization_charts/index/".$save->country_id);
	}
}