<?php
class hilight extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('hilight_model','hilight');
		$this->load->model('product_category_model','product_category');
		$this->load->model('product_model','product');
		$this->load->model('content_model','content');
    }    
    public $menu_id = 5;
    public function index($id)
    {
    	//$this->db->debug=true;
		$data['hilight'] = $this->hilight->get_row($id);
		$this->template->build('hilight/index',$data);
	}
}	
        