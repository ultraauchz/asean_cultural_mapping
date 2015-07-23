<?php
class product extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('hilight_model','hilight');
		$this->load->model('product_category_model','product_category');
		$this->load->model('product_model','product');
		$this->load->model('product_image_model','product_image');
		$this->load->model('product_option_model','product_option');
		$this->load->model('content_model','content');
    }    
    public $menu_id = 5;
    public function category($pid)
    {
    	//$this->db->debug=true;
		$data['category'] = $this->product_category->where('pid = '.$pid)->order_by('show_no','desc')->get(FALSE,TRUE);
		$this->template->build('product/category',$data);
	}
	
	public function index($cat_id)
    {
    	//$this->db->debug=true;
    	$condition = $cat_id > 0 ? 'cat_lv1 = '.$cat_id.' or cat_lv2 = '.$cat_id.' or cat_lv3 = '.$cat_id : ' 1= 1 ';
		$data['product'] = $this->product->where($condition)->get();
		$data['pagination'] = $this->product->pagination();
		$data['cat'] = $cat_id > 0 ? $this->product_category->get_row($cat_id) : array('id'=>0,'name_th'=>'ALL Products');
		$this->template->build('product/product_list',$data);
	}
	
	public function detail($cat_id,$product_id)
    {
    	//$this->db->debug=true;
		$data['product'] = $this->product->get_row($product_id);
		$data['product_image'] = $this->product_image->where('product_id='.$product_id)->order_by('show_no','desc')->get(FALSE,TRUE);
		$data['product_option'] = $this->product_option->where('product_id='.$product_id)->order_by('option_name','asc')->get(FALSE,TRUE);
		
			if($data['product']['cat_lv3']> 0){
				$cat_id = $data['product']['cat_lv3'];
			}else if($data['product']['cat_lv2']>0){
				$cat_id = $data['product']['cat_lv2'];
			}else{
				$cat_id = $data['product']['cat_lv1'];
			}
		$data['cat'] = $this->product_category->get_row($cat_id);
		
		
		$page_title = "THAIcomplex.com:::".$data['product']['page_title'];
		$meta= '<meta name="title" content="'.$data['product']['page_title'].'" />
		 		<meta name="description" content="'.$data['product']['meta_description'].'" />
		 		<meta name="keywords" content="'.$data['product']['meta_keyword'].'" />
		 		';
		$this->template->title($page_title);
		$this->template->append_metadata($meta);			
		$this->template->build('product/detail',$data);
	}
}	
        