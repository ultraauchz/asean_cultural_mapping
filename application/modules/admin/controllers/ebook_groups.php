<?php
/**
 * Hilight Controller
 */
class Ebook_groups extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("ebook_groups","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("ebook_groups","views")) {
			$data['rs'] = new Ebook_group();
			$data['rs']->order_by('orders', 'asc')->get_page();
			
			$this->template->build("ebook_groups/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function form($id=null) {
		if(permission("ebook_groups","create")) {
			$data["rs"] = new Ebook_group($id);
			
			$this->template->append_metadata('<link rel="stylesheet" href="js/uploadify/uploadify.css" />');
			$this->template->append_metadata('<script type="text/javascript" src="js/uploadify/jquery.uploadify.js" ></script>');
			$this->template->build("ebook_groups/form",$data);
		} else {
			redirect("admin/ebook_groups");
		}
	}
	
	public function save($id=null) {
		if(permission("ebook_groups","create")) {
			if($_POST) {
				$_POST['status'] = 1;
				$data = new Ebook_group($id);
				$data->from_array($_POST);
				$data->save();
				
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		redirect('admin/ebook_groups');
	}

	public function delete($id) {
		if(permission("ebook_groups","delete")) {
			if($id) {
				$data = new Ebook_group($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/ebook_groups");
	}
	
}