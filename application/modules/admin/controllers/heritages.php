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
		 $data['menu_id'] = $this->menu_id;
		 $data['modules_name'] = $this->modules_name;
		 $data["variable"] = new Heritage();
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
		 $this->template->build("heritages/form",$data);
	}

	public function save($id=null) {
		// if(permission("hilights","create")) {
			if($_POST) {
				$data = new Heritage($id);
				$data->from_array($_POST);
				$data->save();
				
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
		redirect($_SERVER['HTTP_REFERER']);
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