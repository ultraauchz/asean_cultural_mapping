<?php
/**
 * Permissions Controller
 */
class Permissions extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public $module = array(
		"activeuser"			=> "อนุมัติคำร้องขอใช้งาน",					//	intranet
		"admin"					=> "ผู้ดูแลระบบ",
		"budget"				=> "การเบิก - จ่าย",								//	intranet
		"complains"			=> "เรื่องร้องเรียน",
		"contacts_us"			=> "ติดต่อเรา",
		"content_groups"	=> "ประเภทข่าว",
//		"contents"				=> "ข่าว",
		"coverpages"			=> "หน้าก่อนเข้าเว็บไซต์",
		"departments"		=> "หน่วยงาน",
		"downloads"			=> "ดาวน์โหลด",									//	intranet
		"ebook_groups"		=> "ประเภทหนังสืออิเล็กทรอนิกส์",
		"ebooks"				=> "หนังสืออิเล็กทรอนิกส์",
		"events_type"			=> "ประเภทกิจกรรม",
		"events"					=> "กิจกรรม",
		"faqs"					=> "FAQ",
		"forum"					=> "ถาม-ตอบ",
		"galleries"				=> "อัลบั้มรูป",
		"hilights"				=> "สไลด์หน้าแรก",
		"links"					=> "เว็บลิงค์",
		"logs"					=> "บันทึกการใช้งาน",
		"menus"				=> "เมนู",
		"news"					=> "ข่าวประชาสัมพันธ์ภายในกรม ฯ",		//	intranet
		"pages"					=> "หน้า",
		"personnels"			=> "บุคลากร",
		"permissions"			=> "จัดการสิทธิ",
		"polls"					=> "แบบสำรวจ",
		"requests"				=> "แบบฟอร์มขอฝน",
		"sharefile"				=> "แชร์ไฟล์",									//	intranet
		"user_types"			=> "ประเภทผู้ใช้งาน",
		"users"					=> "ผู้ใช้งาน",
		"videos"					=> "วีดีโอ"
	);
	
	public function index() {
		$data["variable"] = new User_Type();
		$data["variable"]->where("id !=",1)->get_page();
		$this->template->build("permissions/index",$data);
	}
	
	public function form($id) {
		$data["id"] = $id;
		$data["title"] = new User_Type($id);
		$data["title"] = $data["title"]->title;
		
		//	ประเภทข่าวเว็บไซต์หลัก
		$data["content_group"] = new Content_Group();
		$data["content_group"]->where("web_type_id",1)->order_by("title","ASC")->get();
		
		//	ประเภทเว็บไซต์
		$data["web_types"] = new Web_Type();
		$data["web_types"]->order_by("id","ASC")->get();

		
		//	check permission เดิมของ intranet
		$data["web_intranet"] = new Permission();
		$data["web_intranet"]->where("module LIKE \"int\_%\"")->get(1);
		
		//	check permission เดิมของเว็บไซต์หน่วยงาน
		foreach ($data["web_types"] as $key => $value) {
			$data["web_".$value->id] = new Permission();
			$data["web_".$value->id]->where("module LIKE \"d".$value->id."\_%\"")->get(1);
		}
		
		$data["module"] = new Module();
		$data["module"]->where("main",1)->order_by("extra","DESC")->order_by("id","ASC")->get();

		$data['module_request'] = new Module();
		$data['module_request']->where('request', 1)->order_by('extra', 'desc')->order_by('id', 'asc')->get();


		
		$this->template->build("permissions/form",$data);
	}
	
	public function save($id) {
		if($_POST) {

			$variable = new Permission();
			$variable->where("user_type_id",$id)->get()->delete_all();
			
			//	permission เว็บไซต์หลัก
			$module = new Module();
			$module->where("main",1)->order_by("extra","DESC")->order_by("id","ASC")->get();
				
			foreach ($module as $key => $value) {
				if(!empty($_POST[$value->module."_view"]) || !empty($_POST[$value->module."_create"]) || !empty($_POST[$value->module."_delete"]) || !empty($_POST[$value->module."_extra"])) {
					$foo = new Permission();
					$foo->user_type_id = $id;
					$foo->module = $value->module;
					$foo->views = @$_POST[$value->module."_view"] ? 1 : 0;
					$foo->create = @$_POST[$value->module."_create"] ? 1 : 0;
					$foo->delete = @$_POST[$value->module."_delete"] ? 1 : 0;
					$foo->extra = @$_POST[$value->module."_extra"] ? 1 : 0;
					$foo->save();
				}
			}
		
			//	permission ประเภทข่าวของเว็บไซต์หลัก
			$content = new Content_Group();
			$content->order_by("title","ASC")->get();
			
			foreach ($content as $key => $value) {
				if(!empty($_POST["content_".$value->id."_view"]) || !empty($_POST["content_".$value->id."_create"]) || !empty($_POST["content_".$value->id."_delete"])) {
					$foo = new Permission();
					$foo->user_type_id = $id;
					$foo->module = "content_".$value->id;
					$foo->views = @$_POST["content_".$value->id."_view"] ? 1 : 0;
					$foo->create = @$_POST["content_".$value->id."_create"] ? 1 : 0;
					$foo->delete = @$_POST["content_".$value->id."_delete"] ? 1 : 0;
					$foo->save();
				}
			}
			
			//	check ถ้ามีการเลือกของ intranet
			if(@$_POST["intranet"]) {
				$module = new Module();
				$module->where("intranet",1)->order_by("extra","DESC")->order_by("id","ASC")->get();
				
				foreach ($module as $num => $row) {
					if(!empty($_POST["int_".$row->module."_view"]) || !empty($_POST["int_".$row->module."_create"]) || !empty($_POST["int_".$row->module."_delete"]) || !empty($_POST["int_".$row->module."_extra"])) {
						$intranet = new Permission();
						$intranet->user_type_id = $id;
						$intranet->module = "int_".$row->module;
						$intranet->views = @$_POST["int_".$row->module."_view"] ? 1 : 0;
						$intranet->create = @$_POST["int_".$row->module."_create"] ? 1 : 0;
						$intranet->delete = @$_POST["int_".$row->module."_delete"] ? 1 : 0;
						$intranet->extra = @$_POST["int_".$row->module."_extra"] ? 1 : 0;

						$intranet->save();
					}
				}
			}
			
			//	check ถ้ามีการเลือกของเว็บหน่วยงาน
			if(@$_POST["department"]) {
				$module = new Module();
				$module->where("department",1)->order_by("extra","DESC")->order_by("id","ASC")->get();
				
				foreach ($_POST["department"] as $key => $value) {
					foreach ($module as $num => $row) {
						if(!empty($_POST["d".$value."_".$row->module."_view"]) || !empty($_POST["d".$value."_".$row->module."_create"]) || !empty($_POST["d".$value."_".$row->module."_delete"]) || !empty($_POST["d".$value."_".$row->module."_extra"])) {
							$department = new Permission();
							$department->user_type_id = $id;
							$department->module = "d".$value."_".$row->module;
							$department->views = @$_POST["d".$value."_".$row->module."_view"] ? 1 : 0;
							$department->create = @$_POST["d".$value."_".$row->module."_create"] ? 1 : 0;
							$department->delete = @$_POST["d".$value."_".$row->module."_delete"] ? 1 : 0;
							$department->extra = @$_POST["d".$value."_".$row->module."_extra"] ? 1 : 0;
							$department->save();
						}
					}
				}
			}
			if(!empty($_POST['requests_view'])) {
				$module = new Module();
				$module->where('request', 1)->order_by('extra', 'desc')->order_by('id', 'asc')->get();

				foreach($module as $num => $row) {
					$request = new Permission();
					$request->user_type_id = $id;
					$request->module = $row->module;
					$request->views = @$_POST[$row->module."_view"] ? 1 : 0;
					$request->create = @$_POST[$row->module."_create"] ? 1 : 0;
					$request->delete = @$_POST[$row->module."_delete"] ? 1 : 0;
					$request->extra = @$_POST[$row->module."_extra"] ? 1 : 0;
					$request->save();
				}
			}
		}
		redirect("admin/settings/permissions");
	}
	
	public function get_intranet($id) {
		$data["id"] = $id;
		
		$data["module"] = new Module();
		$data["module"]->where("intranet",1)->order_by("extra","DESC")->order_by("id","ASC")->get();
		$this->load->view("permissions/get_intranet",$data);
	}
	
	public function get_list($id,$type) {
		$data["id"] = $id;
		$data["web"] = new Web_Type($type);
		
		$data["module"] = new Module();
		$data["module"]->where("department",1)->order_by("extra","DESC")->order_by("id","ASC")->get();
		$this->load->view("permissions/get_list",$data);
	}
	
	public function gen() {
		foreach ($this->module as $key => $value) {
			$data = new Module();
			$data->module = $key;
			$data->title = $value;
			$data->save();
		}
	}
	
}
