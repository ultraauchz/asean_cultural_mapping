<?php
class checkout extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('users_model','users');
    }    
    public $menu_id = 5;
    public function index($id=5)
    {
    	//$this->db->debug=true;
    	$data = '';
		if(is_login()){
			if(@$_SESSION['billing']!=null){
				$billing = $_SESSION['billing'];				
			}else{
				$prefix = 'bill_';
				$billing[$prefix.'name'] = login_data('name');
				$billing[$prefix.'address'] = login_data($prefix.'address');
				$billing[$prefix.'city'] = login_data($prefix.'city');
				$billing[$prefix.'state'] = login_data($prefix.'state');
				$billing[$prefix.'zipcode'] = login_data($prefix.'zipcode');
				$billing[$prefix.'country'] = login_data($prefix.'country');
				$billing[$prefix.'tel'] = login_data($prefix.'tel');
			}
			if(@$_SESSION['shipping']!=null){
				$shipping = $_SESSION['shipping'];
			}else{
				$prefix = 'ship_';
				$shipping[$prefix.'name'] = login_data($prefix.'name');
				$shipping[$prefix.'address'] = login_data($prefix.'address');
				$shipping[$prefix.'city'] = login_data($prefix.'city');
				$shipping[$prefix.'state'] = login_data($prefix.'state');
				$shipping[$prefix.'zipcode'] = login_data($prefix.'zipcode');
				$shipping[$prefix.'country'] = login_data($prefix.'country');
				$shipping[$prefix.'tel'] = login_data($prefix.'tel');
			}
			$_SESSION['billing'] = $billing;
			$_SESSION['shipping'] = $shipping;
			$data['billing'] = $billing;
			$data['shipping'] = $shipping;
  		    $this->template->build('checkout/checkout',$data);			
		}else{
			$this->template->build('checkout/login_registration',$data);	
		}
	}
	
	public function login(){
		if($_POST){
			login($_POST['username'],$_POST['password']);
		}
		redirect('front/checkout/index');
	}
	
	public function register(){
		if(@$_POST){
			$_POST['registerdate'] = date("Y-m-d H:i:s");
			$_POST['status'] = '1';
			$this->users->save($_POST);
			login($_POST['username'],$_POST['password']);
			redirect('front/checkout/index');
		}
	}
}	
        