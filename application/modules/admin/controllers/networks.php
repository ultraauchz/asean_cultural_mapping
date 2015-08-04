<?php
class Networks extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 14;;
		$this->modules_name = 'networks';
		/*
		if(!permission("organizations","views")) {
			redirect("admin");
		}
		 * 
		 */
	}
	
	public function index() {		
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['result'] = new Network();
		if(@$_GET['search']!=''){
			$condition = "  title LIKE '%".$_GET['search']."%'";
			$data['result']->where($condition);
		}
		$data["result"]->order_by("show_no","DESC")->get_page();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		$data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		$this->template->build('networks/index',$data);
		/*
		if(permission("departments","views")) {
			$data["variable"] = new Department();
			$data["variable"]->where('parent_id','0');
			$data["variable"]->order_by('orders', 'asc');
			$data["variable"]->get();
			$this->template->build("departments/index",$data);
		} else {
			redirect("admin");
		}*/
		
	}
	
	public function form($id=null) {
		/*
		if(permission("departments","create")) {
			$data["value"] = new Department($id);
			if (empty($id)) {
				@$data['value']->orders = $this->orders(0);
				@$data['max_orders'] = $data['value']->orders;
			} else {
				@$data['max_orders'] = $this->orders($data["value"]->parent_id, $id);
			}
			$this->template->build("departments/form",$data);
		} else {
			redirect("admin/departments");
		}
		 * 
		 */		 
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["value"] = new Network($id);
		 $network_org = new Network_Org();
		 $network_org->where('network_id',$id)->get();
		 $data['network_org'] = $network_org; 
		 $this->template->build("networks/form",$data);
	}
	
	public function save($id=null) {
			$current_user_id = $this->session->userdata("id");
			if ($_POST) {
				$save = new Network();
				if($_POST['id']==''){
					$show_no = $this->db->query("SELECT MAX(show_no)show_no FROM acm_network")->result();
					$_POST['show_no'] = @$show_no[0]->show_no < 1 ? 1 : $show_no[0]->show_no + 1;
					$_POST['created_by'] = $current_user_id; 
				}else{
					$_POST['updated_by'] = $current_user_id;
				}
				$save->from_array($_POST);
				$save->save();
			}
		redirect("admin/networks");
	}
	
	public function save_network_organization($network_id=null){
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
		redirect('admin/networks/form/'.$network_id);	
	}
	
	public function delete($id=null) {
			if($id) {
				/*
				$tmp = new Department($id);
				$tmp2 = new Department();
				$tmp2->where('orders >=', $tmp->orders);
				$tmp2->where('parent_id', $tmp->parent_id);
				$tmp2->order_by('orders', 'asc');
				$tmp2->get_page();
				foreach ($tmp2 as $key => $item2) {
					$save_update = new Department();
					if ($item2->id != $id) {
						$update['id'] = $item2->id;
						$update['orders'] = $item2->orders-1;
						$save_update->from_array($update);
						$save_update->save();
					}
				}
				*/
				$data = new Network($id);
				$data->delete();
				
				//save_logs('delete', $id);
			}
		redirect("admin/networks");
	}
	
	function delete_network_org($id){
		$network_org = new Network_Org($id);
		$network_id = $network_org->network_id;
		$this->db->query("DELETE FROM acm_network_org WHERE id = ".$id);
		redirect('admin/networks/form/'.$network_id);
	}
	
	function ordering() {
		$mode = @$_GET['mode'];
		$table_name = 'acm_network';
		$id = @$_GET['id'];
		$step=1;
		$ext_condition = '';
		$ext_condition = @$_GET['search']!='' ? " AND title LIKE '%".$_GET['search']."%' " : "";
		ordering_data($mode,$table_name,$id,$ext_condition,$step);
		redirect('admin/networks/index?search='.@$_GET['search']);
	}
}
