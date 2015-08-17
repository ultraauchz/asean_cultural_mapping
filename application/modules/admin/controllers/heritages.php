<?php
/**
 * Heritage Controller
 */
class Heritages extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 17;
		$this->modules_name = 'heritages';
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
		 $data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["variable"] = new Heritage();		 
		 if(@$_GET['search'] != '') $data["variable"]->where("  title LIKE '%".$_GET['search']."%' ");
		 if(@$_GET['country_id'] != '') $data["variable"]->where("  country_id = ".$_GET['country_id']." ");
		 $data["variable"]->order_by("orders","ASC")->get_page();
		 $this->template->build("heritages/index",$data);
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
		 $data["rs"] = new Heritage($id);
		 if($id>0){
		 	$data["heritage_org"] = new Heritage_Organization();
		 	$data["heritage_org"]->where('heritage_id = '.$id)->get();
		 }
		 $this->template->build("heritages/form",$data);
	}

	public function save($id=null) {
		// if(permission("hilights","create")) {
			if($_POST) {
				$data = new Heritage($id);
				$data->from_array($_POST);
				$data->save();
				$id = $data->id;
				// $type = ($id)?'edit':'add'; // for logs.
				// save_logs($type, $data->id);
				
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
		// }
		// redirect("admin/heritages");
		redirect('admin/heritages/form/'.$id);
	}

	public function save_heritage_organization($heritage_id=null){
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
				}
			}			
		}	
		redirect('admin/heritages/form/'.$heritage_id);	
	}

	public function delete($id) {
		// if(permission("hilights","delete")) {
			if($id) {
				$data = new Hilight($id);
				$data->delete();
				
				// save_logs('delete', $id);
			}
		// }
		redirect("admin/hilights");
	}
	
	public function image_delete($id){
		if($id) {
			$data = new Heritage_image($id);
			@unlink("uploads/heritage_image/".$data->image);
			$data->delete();
		}
	}
	
}