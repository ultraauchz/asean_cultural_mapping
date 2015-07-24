<?php
/**
 * Galleries Controllers
 */
class Galleries extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data["variable"] = new Gallerie();
		
		if(@$_GET["q"]) {
			$data["variable"]->like("title",$_GET["q"])->or_like("detail",$_GET["q"]);
		}
		
		$data["variable"]->where("status",1)->order_by("orders","ASC")->order_by("id","DESC")->get_page();
		$this->template->build("index",$data);
	}
	
	public function view($slug) {
		$data["value"] = new Gallerie();
		$data["value"]->get_by_slug(urldecode($slug));
		
		if($data["value"]->status==1) {
			$data["value"]->counter("views");
			
			$limit = 20;
			if($data["value"]->image_per_page!=0) {
				$limit = $data["value"]->image_per_page;
			}
			
			$data["variable"] = new Image();
			$data["variable"]->where("gallerie_id",$data["value"]->id)->get_page($limit);
			
			$this->template->build("view",$data);
		} else {
			show_404();
		}
	}
	
	public function search() {
		if(@$_GET) {
			$data["variable"] = new Gallerie();
			$data["variable"]->where("status",1)->like("title",$_GET["q"])->or_like("detail",$_GET["q"])->or_like_related("image","title",$_GET["q"])->get_page();
		}
	}
	
	public function download($id) {
		$content = new Gallerie($id);
		if(file_exists($content->file_path)) {
			$data = file_get_contents(urldecode($content->file_path));
			$name = basename($content->file_path);
			force_download($name,$data);
		} else {
			show_404();
		}
	}
	
}
