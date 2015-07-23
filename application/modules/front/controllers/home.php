<?php
class home extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('hilight_model','hilight');
		$this->load->model('product_category_model','product_category');
		$this->load->model('product_model','product');
		$this->load->model('content_model','content');
		$this->load->model('news_letter_model','news_letter');
    }    
    public $menu_id = 5;
    public function index()
    {
    	//$this->db->debug=true;
		$data['menu_id'] = $this->menu_id;
		$data['main_cat'] = $this->product_category->where('pid = 0 ')->order_by('show_no','desc')->get(FALSE,TRUE);
		$data['hilight'] = $this->hilight->order_by('show_no','desc')->get(FALSE,TRUE);
		$data['new_arrival'] = $this->product->where("cat_lv1 = 1")->limit(10)->order_by('show_no','desc')->get();
		$data['new_arrival_cat_id'] = 1;
		$data['jewelry'] = $this->product->select('product.*')->where("cat_lv1 = 4")->limit(10)->order_by('show_no','desc')->get();
		$data['jewelry_cat_id'] = 4;						
		$data['maylike_product'] = $this->product->get('SELECT * FROM product ORDER BY RAND() LIMIT 5',TRUE);
		$data['popular_product'] = $this->product->get('SELECT * FROM product ORDER BY RAND() LIMIT 5',TRUE);
		$data['random_product']  = $this->product->get('SELECT * FROM product ORDER BY RAND() LIMIT 5',TRUE);
		
		$data['first_page_category'] = $this->db->getarray("select * from product_category where id IN (select cat_lv1 from product where show_firstpage='show') order by show_no desc ");
		
		$this->template->build('index',$data);
	}

	public function register_newsletter(){
		$email = $_POST['email'];
		$exist = $this->db->getone("SELECT email FROM news_letter WHERE email='".$email."'");
		if($exist!=''){
			echo 'false';
		}else{
			$data['email'] = $email;
			$data['register_date'] = date("Y-m-d H:i:s");
			$data['ipaddress'] = (@getenv(HTTP_X_FORWARDED_FOR)) ? @getenv(HTTP_X_FORWARDED_FOR):@getenv(REMOTE_ADDR);
			$this->news_letter->save($data);
			echo 'true';
		}
	}
	
}	
?>