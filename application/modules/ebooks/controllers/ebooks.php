<?php
/**
 * Hilight Controller
 */
class Ebooks extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['rs'] = new Ebook_group();
		if(!empty($_GET['g'])) { $data['rs']->where('id', $_GET['g']); }
		$data['rs'] -> where('status', 1)->get_page();
		
		$data['rs'] = $data['rs']->ebook->where('status', 1)->get_page();
		
		$this->template->build("ebooks/index",$data);
	}
	private function add_viewer($id) { // เพิ่มจำนวนผู้เข้าใช้งาน
		$db = new Ebook($id);
		$db->viewer = $db->viewer+1;
		$db->save();
	}
		public function book($id=null) {
			$this->add_viewer($id);
			$info = new Ebook_info();
			$info->get_page();
			
			foreach($info as $item) {
				$data['info'][$item->type] = $item->value;
			}
			$data['book'] = new Ebook($id);
			
			$data['rs'] = new Ebook_detail();
			$data['rs']->where('ebook_id', $id);
			$data['rs']->get();
			
			if(count($data['rs']->all) == 0) {
				#set_notify('error', 'ไม่พบหนังสือ หรือยังไม่มีการเพิ่มข้อมูลหนังสือ');
				redirect('ebooks');
			}
			#$this->template->set_layout('default/layout2')->build('ebooks/book', $data);
			$this->load->view('ebooks/book', $data);
		}
		
	public function print_page($id, $page) {
		$rs = new Ebook_detail();
		$rs->where('ebook_id', $id);
		$rs->get(1, ($page-1));
		
		echo '<script>window.print();</script>';
		echo '<img src="'.site_url().'uploads/ebook/'.$rs->tmp_name.'" />';
	}
}