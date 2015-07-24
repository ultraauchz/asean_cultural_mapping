<?php
/**
 * Forums Controllers
 */
class Forums extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
	}
	
	public function view($slug) {
		$data["value"] = new Forum();
		$data["value"]->get_by_slug(urldecode($slug));
		
		if($data["value"]->id) {
			$data["comments"] = new Forum_Comment();
			$data["comments"]->where("forum_id",$data["value"]->id)->order_by("id","ASC")->get_page();	
		}
		
		$this->template->build("view",$data);
	}
	
	public function comment($id) {
		
	}
	
	public function edit($slug) {
		$data["value"] = new Forum();
		$data["value"]->get_by_slug(urldecode($slug));
		
		$this->template->build("view",$data);
	}
	
	public function save() {
		if($_POST) {
			
		}
	}
	
}
