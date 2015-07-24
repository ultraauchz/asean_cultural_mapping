<?php
class Galleries extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		if(!permission("galleries","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("galleries","views")) {
			$data["variable"] = new Gallerie();
			$data["variable"]->order_by("orders","ASC")->order_by("id","DESC")->get_page();
			$this->template->build("galleries/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("galleries","create")) {
			$data["value"] = new Gallerie($id);
			$this->template->build("galleries/form",$data);
		} else {
			redirect("admin/galleries");
		}
	}

	public function save($id=null) {
		if(permission("galleries","create")) {
			if(@$_POST) {
				$data = new Gallerie($id);
				$data->from_array($_POST);
				$data->save();
				
				$data->slug = clean_url($data->title)."-".$data->id;
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect("admin/galleries");
	}

	public function delete($id) {
		if(permission("galleries","delete")) {
			if($id) {
				$images = new Image();
				$images->where("gallerie_id",$id)->get();
				
				foreach ($images as $key => $image) {
					$this->delete_image($image->id);
				}
				
				$data = new Gallerie($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/galleries");
	}
	
	public function uploads($id) {
		if(permission("galleries","create")) {
			if($_FILES) {
				foreach ($_FILES as $key => $value) {
					$file = new Image();
					$file->gallerie_id = $id;
					$file->image_path = $file->upload($_FILES["Filedata"],"gallery");
					$file->thumb("gallery/thumbs", 160, 100, "x");
					$file->save();
				}
			}
		}
	}
	
	public function savetitle($id) {
		if(permission("galleries","create")) {
			$image = new Image($id);
			$image->title = $_POST["title"];
			$image->save();
		}
	}
	
	public function delete_image($id) {
		if(permission("galleries","delete")) {
			$image = new Image($id);
			$gallerie_id = $image->gallerie_id;
			@unlink("gallery/thumbs/".$image->image_path);
			@unlink("gallery/".$image->image_path);
			$image->delete();
			
			$this->countimage($gallerie_id);
		}
	}
	
	public function countimage($id) {
		if(permission("galleries","create")) {
			$gallerie = new Gallerie($id);
			$total = $gallerie->image->get()->result_count();
			$gallerie->total_image = $total;
			$gallerie->save();
		}
	}

}