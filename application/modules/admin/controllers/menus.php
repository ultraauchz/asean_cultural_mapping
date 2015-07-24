<?php
/**
 * Menus Controller
 */
class Menus extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("menus","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("menus","views")) {
			$data["variable"] = new Menu();
			$data["variable"]->where('parent_id',0)->order_by("orders","ASC")->order_by("orders","ASC")->get();

			$data["roots"] = new Menu;
			$data["roots"]->where('parent_id !=',0)->order_by('orders',"ASC")->get();

			$this->template->build("menus/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("menus","create")) {
			$data["value"] = new Menu($id);
			
			$data["pages"] = new Page();
			$data["pages"]->order_by("id","ASC")->get();
			
			$this->template->build("menus/form",$data);
		} else {
			redirect("admin/menus");
		}
	}

	public function save($id=null) {
		if(permission("menus","create")) {
			if($_POST) {
				$data = new Menu($id);
				$data->parent_id = $_POST["parent_id"];
				$data->title = $_POST["title"];
				
				switch (@$_POST["route"]) {
					case 1:
						$data->route = 1;
						switch (@$_POST["s"]) {
							case 'contents':
								if($_POST["g"]) {	//	ตรวจสอบว่าเป็นค่าที่เลือกเป็นประเภทบทความหรือไม่
									$data->route_2 = $_POST["g"];
									$data->links = "contents?g=".$_POST["g"];
								} else {	//	ถ้าไม่ได้เลือกประเภทบทความจะไปที่หน้ารวมบทความทั้งหมด
									$data->links = "contents";
								}
								break;
							case 'p':
								if(@$_POST["g"]) {	//	ตรวจสอบว่าเป็นค่าที่เลือกเป็นประเภทบทความหรือไม่
									$data->route_2 = "p";
									$data->links = "p/".$_POST["g"];
								}
								break;
							default:
								$data->links = $_POST["s"];						
								break;
						}
						break;
					case 2:
						$data->route = 2;
						$data->links = $_POST["links"];
						break;
					case 3:
						$data->route = 3;
						$data->detail = $_POST["detail"];
						break;
					default:
						$data->route = 2;
						$data->links = "#";
						break;
				}
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				
				save_logs($type, $data->id);
				
				if(@$_POST["route"]==3) {
					$data->slug = clean_url($_POST["title"])."-".$data->id;
					$data->save();
				}
			}
		}
		redirect("admin/menus");
	}

	public function delete($id) {
		if(permission("menus","delete")) {
			if($id) {
				$data = new Menu($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/menus");
	}
	
	public function g() {
		echo form_dropdown("g",get_option("id", "title", "ma_content_group","WHERE web_type_id = 1"),@$value->route_2,"class=\"form-control\"","-- เลือกประเภท --","1");
	}
	
	public function p() {
		echo form_dropdown("g",get_option("slug", "title", "ma_page"),@$value->route_2,"class=\"form-control\"","-- เลือกหน้าทั่วไป --","1");
	}
	
}
