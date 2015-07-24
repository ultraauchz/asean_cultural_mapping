<?php
/*
 * Content Controller
 */
class Contents extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		if(@$_GET["g"]) {
			$g = $_GET["g"];
			if(permission("content_$g","views")) {
				$data["variable"] = new Content();
				$data["variable"]->where("content_group_id",$g)->order_by("orders","ASC")->order_by("id","DESC")->get_page();
				
				$data["title"] = new Content_Group($g);
				
				$this->template->build("contents/index",$data);
			} else {
				redirect("admin");
			}
		} else {
			redirect("contents?g=1");
		}
	}

	public function form($id=null) {
		if(@$_GET["g"]) {
			$g = $_GET["g"];
			$data["group"] = new Content_Group($g);
			$data["where"] = null;

			if(!permission("content_groups","views")) {
				$variable = new Permission();
				$variable->where("user_type_id",user()->user_type_id)->like("module","content_")->not_like("module","groups")->order_by("module","ASC")->get();

				foreach ($variable as $key => $value) {
					$wid = str_replace("content_", "", $value->module);
					if($key==0) {
						$data["where"] .= " WHERE id = $wid";
					} else {
						$data["where"] .= " OR id = $wid";
					}
				}
			} else {
				$data["where"] .= " WHERE WEB_TYPE_ID = 1";
			}
		
			$data["value"] = new Content($id);
			$data['value']->content_group_id = (empty($id)) ? $g :$data['value']->content_group_id;
		
			$this->template->build("contents/form",$data);
		}
	}

	public function save($id=null) {
		if($_POST) {
			$data = new Content($id);
			$data->from_array($_POST);
			$data->save();
			
			$data->slug = clean_url($_POST["title"])."-".$data->id;
			$data->save();
			
			$type = ($id)?'edit':'add'; // for logs.
			save_logs($type, $data->id);
		}
		redirect("admin/contents?g=".$_POST["content_group_id"]);
	}

	public function delete($id) {
		if($id) {
			$data = new Content($id);
			$data->delete();
			
			save_logs('delete', $id);
		}
		redirect("admin/contents?g=".$_GET["g"]);
	}

}