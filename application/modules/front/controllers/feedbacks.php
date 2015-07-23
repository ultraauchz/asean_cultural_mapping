<?php
class feedbacks extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('users_model','users');
		$this->load->model('testimonials_model','testimonials');
		$this->load->model('orders_model','orders');
		$this->load->model('order_details_model','order_details');
		$this->load->model("product_model",'product');
		$this->load->model('product_image_model','product_image');
		
    }    
    public function index()
    {
    	//$this->db->debug=true;
    	$data['feedbacks'] = $this->testimonials->where('testimonials.status=2')->order_by('id','desc')->get();
		$data['pagination'] = $this->testimonials->pagination();
  		$this->template->build('feedbacks/index',$data);			
	}
}