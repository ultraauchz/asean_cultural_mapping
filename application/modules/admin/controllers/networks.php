<?php
class Networks extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 14;;
		$this->modules_name = 'networks';
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
		
		$data['result'] = new Network();
		if(@$_GET['search']!='')$data['result']->where(" title LIKE '%".$_GET['search']."%' OR CODE LIKE '%".$_GET['search']."%' ");		
		$data["result"]->order_by("show_no","DESC")->get_page();		
		save_logs($this->menu_id, 'View', 0 , 'View Networks ');
		$this->template->build('networks/index',$data);
	}
	
	public function form($id=null) {
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data['perm'] = $this->perm;
	     $data['current_user'] = $this->user;
		
		 $data["value"] = new Network($id);
		 $network_org = new Network_Org();
		 $network_org->where('network_id',$id)->get();
		 $data['network_org'] = $network_org; 
		 save_logs($this->menu_id, 'View', @$data['value']->id , 'View Network Detail ');
		 $this->template->build("networks/form",$data);
	}
	
	public function save($id=null) {
			if($this->perm->can_create=='y'){
				if ($_POST) {
					$save = new Network();
					if($_POST['id']==''){
						$show_no = $this->db->query("SELECT MAX(show_no)show_no FROM acm_network")->result();
						$_POST['show_no'] = @$show_no[0]->show_no < 1 ? 1 : $show_no[0]->show_no + 1;
						$_POST['created_by'] = $this->user->id; 
					}else{
						$_POST['updated_by'] = $this->user->id;
					}
					$save->from_array($_POST);
					$save->save();
					$action = $_POST['id'] > 0 ? 'UPDATE' : 'CREATE';
					save_logs($this->menu_id, $action, @$save->id , $action.' '.$save->title.' Network');
				}
			}
		redirect("admin/networks");
	}
	
	public function save_network_organization($network_id=null){
		if($this->perm->can_create=='y'){
			if($network_id > 0){			
				foreach($_POST['chk_org_id'] as $key){						
					$ext= new Network_Org();
					$ext->where('network_id',$network_id)->where("org_id", $key)->get(1);
					if($ext->id) {
						
					}else{					
						$data['network_id'] = $network_id;
						$data['org_id'] = $key;
						$save = new Network_Org();	
						$save->from_array($data);
						$save->save();
					}
				}			
			}	
		}
		redirect('admin/networks/form/'.$network_id);	
	}
	
	public function delete($id=null) {
		if($this->perm->can_delete=='y'){
			if($id) {
				$data = new Network($id);
				$action = 'DELETE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->title.' Network');
				$data->delete();
			}
		}
		redirect("admin/networks");
	}
	
	function delete_network_org($id){
		if($this->perm->can_create=='y'){
			$network_org = new Network_Org($id);
			$network_id = $network_org->network_id;
			$this->db->query("DELETE FROM acm_network_org WHERE id = ".$id);
		}
		redirect('admin/networks/form/'.$network_id);
	}
	
	function ordering() {
		if($this->perm->can_create=='y'){
			$mode = @$_GET['mode'];
			$table_name = 'acm_network';
			$id = @$_GET['id'];
			$step=1;
			$ext_condition = '';
			$ext_condition = @$_GET['search']!='' ? " AND title LIKE '%".$_GET['search']."%' " : "";
			ordering_data($mode,$table_name,$id,$ext_condition,$step);
		}
		redirect('admin/networks/index?search='.@$_GET['search']);
	}

	public function iframe_list(){
		//id=15&area=admin&ctrl=heritages&action=save_heritage_organization
		$data['action_url'] = $_GET['area'].'/'.$_GET['ctrl'].'/'.$_GET['action'].'/'.$_GET['id'];		
		$data['result'] = new Network();
		if(@$_GET['search']!='')$data['result']->where(" title LIKE '%".@$_GET['search']."%' ");
		$data["result"]->order_by("show_no","desc")->get_page();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
	    $data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		$this->load->view('networks/iframe_list',$data);
	}
}
