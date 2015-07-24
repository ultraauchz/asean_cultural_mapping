<?php
/**
 * Forum Controller
 */
class Forum extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data["variable"] = new Forum_Topic();
		$data["variable"]->get_page();
		$this->template->build("forum/index",$data);
	}
	
	public function form($id=FALSE) {
		$data["value"] = new Forum_Topic($id);
		$this->template->build("forum/form",$data);
	}
	
	public function save($id=FALSE) {
		if($_POST) {
			$forum = new Forum_Topic($id);
			$forum->user_id = $_POST["user_id"];
			$forum->title = strip_tags($_POST["title"]);
			$forum->detail = $_POST["detail"];
			$forum->save();
		}
		redirect("admin/forum");
	}
	
	public function delete($id) {
		if($id) {
			$forum = new Forum_Topic($id);
			
			foreach ($forum->forum_comment->where("forum_topic_id",$id)->get() as $key => $value) {
				$data = new Forum_Comment($value->id);
				$data->delete();
			}
			
			$forum->delete();
		}
		redirect("admin/forum");
	}
	
	public function user_list() {
		$data["variable"] = new User();
		$data["variable"]->get();
		$this->load->view("forum/user_list",$data);
	}
	
}
