<?php
/**
 * Contents Controllers
 */
class Contents extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
		$data["variable"] = new Content();
		if(@$_GET["g"]) {
			$data["group"] = new Content_Group($_GET["g"]);
			
			$data["variable"]->where("content_group_id",$_GET["g"]);
		}
		
		$data["variable"]->where("status",1)->order_by("orders","ASC")->order_by("id","DESC")->get_page();
		if ($data["group"]->is_thumbnail != '1') {
			$this->template->build("index",$data);
		} else {
			$this->template->build("index_thumbnail",$data);
		}
	}
	
	public function view($id) {
		$data["value"] = new Content($id);
		
		if($data["value"]->status==1 && $data["value"]->content_group->status==1) {
			$data["value"]->counter("views");
			
			if(@strlen(strip_tags($data["value"]->detail))<1 && $data["value"]->file_path==true) {
				redirect($data["value"]->file_path);
				exit();
			}
			
			$data['comment'] = new Content_comment();
			$data['comment']->where('content_id', $data["value"]->id);
			$data['comment']->get();
		
			$this->template->build("view",$data);
		} else {
			show_404();
		}
	}
	
	public function download($id) {
		$content = new Content($id);
		if(file_exists($content->file_path)) {
			$content->counter("downloads");
			$data = file_get_contents(urldecode($content->file_path));
			$name = basename($content->file_path);
			force_download($name,$data);
		} else {
			show_404();
		}
	}
	
	public function save_comment($id) {
		$_POST['comment_ip'] = $_SERVER["REMOTE_ADDR"];
		$_POST['content_id'] = $id;
		
		$content = new Content($id);
		if (empty($content->id)) { redirect("home"); }
		
		$data = new Content_comment();
		$data->from_array($_POST);
		$data->save();

		redirect("contents/view/".$content->slug);
	}
	
	public function chk_captcha () {
		if(check_captcha(@$_GET["captcha"])) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
}
