<?php
/**
 * Heritage Controller
 */
class Heritages extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 17;
		$this->modules_name = 'heritages';
		$this->current_user = user();
		$this->perm = current_user_permission($this->menu_id);
		if($this->perm->can_view!='y'){
			redirect("admin");
		}
	}

	public function index() {		
		 $data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		 $data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data['perm'] = $this->perm;
		 $data['current_user'] = $this->current_user;
		 $data["variable"] = new Heritage();		 
		 if(@$_GET['search'] != '') $data["variable"]->where("  title LIKE '%".$_GET['search']."%' ");
		 if($this->perm->can_access_all != 'y')
		 {
		 	$data["variable"]->where("  country_id = ".$this->current_user->organization->country_id." ");
		 }
		 else if(@$_GET['country_id'] != '') 
		 {
		 	$data["variable"]->where("  country_id = ".$_GET['country_id']." ");
		 }
		 $data["variable"]->order_by("orders","ASC")->get_page();
		 save_logs($this->menu_id, 'View', 0 , 'View Heritages ');		 
		 $this->template->build("heritages/index",$data);
	}

	public function form($id=null) {
		 $data['can_save'] = $this->perm->can_create;
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data['perm'] = $this->perm;
		 $data['current_user'] = $this->current_user;
		 $data["rs"] = new Heritage($id);
		 if($id>0){
		 	$data["heritage_org"] = new Heritage_Organization();
		 	$data["heritage_org"]->where('heritage_id = '.$id)->get();
		 }
		 save_logs($this->menu_id, 'View', $data['rs']->id , 'View Heritages Detail');
		 $this->template->build("heritages/form",$data);
	}

	public function save($id=null) {
		if($this->perm->can_create=='y'){
			if($_POST) {
				$data = new Heritage($id);
				if(@$_POST['id'] > 0 ){
					$_POST['updated_by'] = $this->current_user->id;
				}else{
					$_POST['created_by'] = $this->current_user->id;					
				}
				$data->from_array($_POST);				
				$data->save();
				$action = $_POST['id'] > 0 ? 'UPDATE' : 'CREATE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->title.' Heritage');
				$id = $data->id;				
				
				// multiupload
				fix_file($_FILES['files']);
				foreach($_FILES['files'] as $key => $item)
				{
					if($item)
					{
						$heritage_image = new Heritage_image();
						if($_FILES['files'][$key]['name'])
						{
							$heritage_image->image = $heritage_image->upload($_FILES['files'][$key],'uploads/heritage_image');
							$heritage_image->heritage_id = $id;
							$heritage_image->image_detail = $_POST['image_detail'][$key];
							$show_no = $this->db->query("SELECT MAX(id)id FROM acm_heritage_images")->result();
							$heritage_image->show_no = (@$show_no[0]->id)+1;
							$heritage_image->save();
						}		
					}
				}
				
				//update image detail
				foreach($_POST['image_id'] as $key => $item)
				{
					if($item)
					{
						$heritage_image = new Heritage_image();
						$heritage_image->id = $item;
						$heritage_image->image_detail = $_POST['image_detail2'][$key];
						$heritage_image->save();
					}
				}
			}		
		}
		redirect('admin/heritages/form/'.$id);
	}

	public function save_heritage_organization($heritage_id=null){
		if($this->perm->can_create=='y'){
			if($heritage_id > 0){			
				foreach($_POST['chk_org_id'] as $key){						
					$ext= new Heritage_Organization();
					$ext->where('heritage_id',$heritage_id)->where("org_id", $key)->get(1);
					if($ext->id) {
						
					}else{					
						$data['heritage_id'] = $heritage_id;
						$data['org_id'] = $key;
						$save = new Heritage_Organization();	
						$save->from_array($data);
						$save->save();
						$action = 'UPDATE';
						save_logs($this->menu_id, $action, @$heritage_id , $action.' Heritage:::UPDATE HERITAGE ORGANIZATION');
					}
				}			
			}	
		}
		redirect('admin/heritages/form/'.$heritage_id);	
	}
	
	public function delete_heritage_org($id = null){
		
		if($id > 0){
			if($this->perm->can_create=='y'){
				$data = new Heritage_Organization($id);
				$heritage_id = $data->heritage_id;
				$action = 'UPDATE';
				save_logs($this->menu_id, $action, @$heritage_id , $action.' Heritage:::DELETE HERITAGE ORGANIZATION');
				$this->db->query('DELETE FROM acm_heritage_organization WHERE id = '.$id);
			}
			redirect('admin/heritages/form/'.$heritage_id);	
		}else{
			redirect('admin/heritages/index');	
		}
	}

	public function delete($id) {
		if($this->perm->can_delete=='y'){
			if($id) {
				$data = new Heritage($id);
				$action = 'DELETE';
				save_logs($this->menu_id, $action, @$data->id , $action.' '.$data->title.' Heritage');
				$data->delete();				
			}
		}
		redirect("admin/heritages");
	}
	
	public function image_delete($id){
		if($this->perm->can_create=='y'){		
			if($id) {
				$data = new Heritage_image($id);
				@unlink("uploads/heritage_image/".$data->image);
				$action = 'DELETE';
				$heritage = new Heritage($data->heritage_id);
				save_logs($this->menu_id, $action, @$heritage->id , $action.' '.$heritage->title.' Heritage Image.');
				$data->delete();
			}
		}
	}
	
	function ordering() {
		if($this->perm->can_create=='y'){
			$mode = @$_GET['mode'];
			$table_name = 'acm_heritage_images';
			$id = @$_GET['id'];
			$step=1;
			$ext_condition = ' and heritage_id = '.$_GET['heritage_id']." ";
			ordering_data($mode,$table_name,$id,$ext_condition,$step);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
}