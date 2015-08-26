<?php
/**
 * Organizations Controller
 */
class Organizations extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 5;
		$this->modules_name = 'organizations';
		$this->user = user();
		$this->perm = current_user_permission($this->menu_id);
		if($this->perm->can_view!='y'){
			redirect("admin");
		}
	}

	public function index() {		
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
	     $data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		 $data['perm'] = $this->perm;
		 $data['current_user'] = $this->user;
		 $data["rs"] = new Organization();
		 if(@$_GET['search'] != '') $data["rs"]->where("  org_name LIKE '%".$_GET['search']."%' ");
		 if($this->perm->can_access_all != 'y')
		 {
		 	$data["rs"]->where("  country_id = ".$this->user->organization->country_id." ");
		 }
		 else if(@$_GET['country_id'] != '') 
		 {
		 	$data["rs"]->where("  country_id = ".$_GET['country_id']." ");
		 }		 
		 $data["rs"]->order_by("id","desc")->get_page();		 
		 save_logs($this->menu_id, 'View', 0 , 'View Organizations ');
		 $this->template->build("organizations/index",$data);
	}

	public function form($id=null) {
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data['perm'] = $this->perm;
		 $data['current_user'] = $this->user;
		 $data["rs"] = new Organization($id);
		 $network_org = new Network_Org();
		 $network_org->where('org_id',$id)->get();
		 $data['network_org'] = $network_org; 
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
	
	public function iframe_list(){
		//id=15&area=admin&ctrl=heritages&action=save_heritage_organization
		$country_id = @$_GET['country_id'] > 0 ? $_GET['country_id'] : $this->user->organization->country_id;		
		$data['action_url'] = $_GET['area'].'/'.$_GET['ctrl'].'/'.$_GET['action'].'/'.$_GET['id'];		
		$data['result'] = new Organization();
		$data['country_id'] = $country_id;			
		if($country_id > 0)$data['result']->where('country_id = '.$country_id);
		$data["result"]->order_by("id","desc")->get_page();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
	    $data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		$this->load->view('organizations/iframe_list',$data);
	}
	
	public function load_organizations(){
		$country_id = $_POST['country_id'];
		$data = new Organization();
		if($country_id > 0)$data->where('country_id',$country_id);
		$data->get();
		echo '<select name="org_id" class="form-control">';
		echo '<option value="">-- select organization --</option>';
		foreach($data as $key=>$data_item):
			echo '<option value="'.$data_item->id.'">'.$data_item->org_name.'</option>';
		endforeach;
		echo '</select>';
	}
	
	function delete_network_org($id){
		if($this->perm->can_create=='y'){
			$network_org = new Network_Org($id);
			$org_id = $network_org->org_id;
			$this->db->query("DELETE FROM acm_network_org WHERE id = ".$id);
		}
		redirect('admin/settings/organizations/form/'.$org_id);
	}
	
	public function save_network_organization($org_id=null){
		if($this->perm->can_create=='y'){
			if($org_id > 0){			
				foreach($_POST['chk_org_id'] as $key){						
					$ext= new Network_Org();
					$ext->where('org_id',$org_id)->where("network_id", $key)->get(1);
					if($ext->id) {
						
					}else{					
						$data['network_id'] = $key;
						$data['org_id'] = $org_id;
						$save = new Network_Org();	
						$save->from_array($data);
						$save->save();
					}
				}			
			}	
		}
		redirect('admin/settings/organizations/form/'.$org_id);	
	}
}