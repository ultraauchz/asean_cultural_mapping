<?php
/**
 * Hilight Controller
 */
class Hilights extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 13;
		$this->modules_name = 'hilights';
		/*
		if(!permission("hilights","views")) {
			redirect("admin");
		}
		 * 
		 */
	}

	public function index() {
		/*
		if(permission("hilights","views")) {
			$data["variable"] = new Hilight();
			$data["variable"]->order_by("orders","ASC")->get_page();
			$this->template->build("hilights/index",$data);
		} else {
			redirect("admin");
		}
		 * 
		 */
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["variable"] = new Hilight();
		 $data["variable"]->order_by("show_no","DESC")->get_page();
		 $data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		 $data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		 save_logs($this->menu_id, 'View', 0 , 'View Hilights ');
		 $this->template->build("hilights/index",$data);
	}

	public function form($id=null) {
		/*
		if(permission("hilights","create")) {
			$data["value"] = new Hilight($id);
			$this->template->build("hilights/form",$data);
		} else {
			redirect("admin/hilights");
		}
		 * 
		 */
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["value"] = new Hilight($id);
		 save_logs($this->menu_id, 'View', $data['value']->id , 'View Detail Hilights ');
		 $this->template->build("hilights/form",$data);
	}

	public function save($id=null) {
		// if(permission("hilights","create")) {
			if($_POST) {
				if($_POST['id']==''){
					$show_no = $this->db->query("SELECT MAX(show_no)show_no FROM acm_hilights")->result();
					$_POST['show_no'] = @$show_no[0]->show_no < 1 ? 1 : $show_no[0]->show_no + 1;
					$_POST['created_by'] = $current_user_id; 
				}else{
					$_POST['updated_by'] = $current_user_id;
				}
				$data = new Hilight($id);
				$data->from_array($_POST);
				$data->save();
				$action = $_POST['id'] > 0 ? "UPDATE" : "CREATE";
				save_logs($this->menu_id, $action, $data->id , $action.' Hilights ');
				// $type = ($id)?'edit':'add'; // for logs.
				// save_logs($type, $data->id);
			}
		// }
		redirect("admin/hilights");
	}

	public function delete($id) {
		// if(permission("hilights","delete")) {
			if($id) {
				$data = new Hilight($id);
				$action = 'DELETE';
				save_logs($this->menu_id, $action, $data->id , $action.' Hilights ');
				$data->delete();				
				// save_logs('delete', $id);
			}
		// }
		redirect("admin/hilights");
	}
	
	function ordering() {
		$mode = @$_GET['mode'];
		$table_name = 'acm_hilights';
		$id = @$_GET['id'];
		$step=1;
		$ext_condition = '';
		$ext_condition = @$_GET['search']!='' ? " AND title LIKE '%".$_GET['search']."%' " : "";
		ordering_data($mode,$table_name,$id,$ext_condition,$step);
		$action = "UPDATE";
		save_logs($this->menu_id, $action, $id , $action.' Hilights ');
		redirect('admin/hilights/index?search='.@$_GET['search']);
	}
	
}