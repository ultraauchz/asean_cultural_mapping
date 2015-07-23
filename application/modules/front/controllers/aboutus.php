<?php
class aboutus extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('product_category_model','product_category');
		$this->load->model('product_model','product');
		$this->load->model('content_model','content');
    }    
    public $menu_id = 5;
    public function index($id=1)
    {
    	//$this->db->debug=true;
		$data['content'] = $this->content->get_row($id);
		$this->template->build('aboutus',$data);
	}
}	
        