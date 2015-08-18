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
		$data['rs'] = new Organization_Chart();
		$country_id = $this->perm->can_access_all == 'y' && $id > 0 ? $id : $this->current_user->organization->country_id; 
		$data['rs']->where('country_id',$country_id);
		$data["rs"]->get(1);
		save_logs($this->menu_id, 'View', $data['rs']->id, ' View '.$data['rs']->country->country_name.' Organization Chart ');
		$this->template->build('organization_charts/form',$data);	
	}
	
	public function load_detail(){
		$country_id = @$_POST['id'];
		$rs = new Organization_chart();
		$rs->where('country_id',$country_id);
		$rs->get(1);
		echo '<textarea class="form-control"  name="detail" id="detail" >'.@$rs->detail.'</textarea>';
	}
	
	public function save($id=null) {
		if($this->perm->can_create=='y'){
			if ($_POST) {
				$data = new Organization_Chart();
				$data->where('country_id',$_POST['country_id'])->get(1);
				$save = new Organization_Chart();
				$save->id = @$data->id;
				$save->country_id = $_POST['country_id'];
				$save->detail = $_POST['detail'];
				$save->save();
				$action = 'Update ';
				save_logs($this->menu_id, $action , $save->id, $action.' '.$save->country->coutry_name.' Organization Chart ');
			}
		}
		redirect("admin/organization_charts/index/".$save->country_id);
	}
}