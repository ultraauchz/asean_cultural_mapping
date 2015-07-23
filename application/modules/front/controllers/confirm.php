<?php
class confirm extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('country_model','country');
		$this->load->model('orders_model','orders');
		$this->load->model('order_details_model','order_details');
    }    
    public $menu_id = 5;
    public function index($id=5)
    {
    	//$this->db->debug=true;
    	$data = '';
		if(is_login()){
			if($_POST){
				$prefix = 'bill_';
				$billing[$prefix.'name'] = $_POST[$prefix.'name'];
				$billing[$prefix.'address'] = $_POST[$prefix.'address'];
				$billing[$prefix.'city'] = $_POST[$prefix.'city'];
				$billing[$prefix.'state'] = $_POST[$prefix.'state'];
				$billing[$prefix.'zipcode'] = $_POST[$prefix.'zipcode'];
				$billing[$prefix.'country'] = $_POST[$prefix.'country'];
				$billing[$prefix.'tel'] = $_POST[$prefix.'tel'];
				$billing[$prefix.'country_name'] = $this->db->getone('select country_name from countries where id = '.$billing[$prefix.'country']);
				$prefix = 'ship_';
				$shipping[$prefix.'name'] = $_POST[$prefix.'name'];
				$shipping[$prefix.'address'] = $_POST[$prefix.'address'];
				$shipping[$prefix.'city'] = $_POST[$prefix.'city'];
				$shipping[$prefix.'state'] = $_POST[$prefix.'state'];
				$shipping[$prefix.'zipcode'] = $_POST[$prefix.'zipcode'];
				$shipping[$prefix.'country'] = $_POST[$prefix.'country'];
				$shipping[$prefix.'tel'] = $_POST[$prefix.'tel'];
				$shipping[$prefix.'country_name'] = $this->db->getone('select country_name from countries where id = '.$shipping[$prefix.'country']);
			}else{
				redirect('front/checkout/index');
			}
			$_SESSION['billing'] = $billing;
			$_SESSION['shipping'] = $shipping;
			$data['billing'] = $billing;
			$data['shipping'] = $shipping;
  		    $this->template->build('confirm/index',$data);			
		}else{
			redirect('front/checkout/index');
		}
	}
	
	public function finish($id){
		//$this->db->debug= true;
		$data['orders'] =$this->orders->get_row($id);
		$data['orders']['bill_country_name'] = $this->db->getone('select country_name from countries where id = '.$data['orders']['bill_country']);
		$data['orders']['ship_country_name'] = $this->db->getone('select country_name from countries where id = '.$data['orders']['ship_country']);
		$data['order_details'] = $this->order_details->where('order_id='.$id)->order_by('order_details.id','asc')->get(FALSE,TRUE);
		$this->template->build('confirm/finish',$data);
	}
	
	public function submit(){
		if(@$_SESSION['billing']){
			$billing = $_SESSION['billing'];
			$shipping = $_SESSION['shipping'];
			$cart = $_SESSION['cart'];
			$data['order_date'] = date("Y-m-d H:i:s");
			$data['order_no'] = $this->db->getone("SELECT max(order_no)+1 FROM orders WHERE YEAR(order_date)=".date('Y')." AND MONTH(order_date)=".date("m"));
			$data['order_no'] = $data['order_no'] == 0 || $data['order_no'] == '' ? 1 : $data['order_no'];
			$data['order_f_no'] = date("Ymd").str_pad($data['order_no'],4, STR_PAD_LEFT);
			$data['order_status'] = 1;
			$data['user_id'] = login_data('id');
			$prefix = 'bill_';
			$data[$prefix.'name'] = $billing[$prefix.'name'];
			$data[$prefix.'address'] = $billing[$prefix.'address'];
			$data[$prefix.'city'] = $billing[$prefix.'city'];
			$data[$prefix.'state'] = $billing[$prefix.'state'];
			$data[$prefix.'zipcode'] = $billing[$prefix.'zipcode'];
			$data[$prefix.'country'] = $billing[$prefix.'country'];
			$data[$prefix.'tel'] = $billing[$prefix.'tel'];
			$prefix = 'ship_';
			$data[$prefix.'name'] = $shipping[$prefix.'name'];
			$data[$prefix.'address'] = $shipping[$prefix.'address'];
			$data[$prefix.'city'] = $shipping[$prefix.'city'];
			$data[$prefix.'state'] = $shipping[$prefix.'state'];
			$data[$prefix.'zipcode'] = $shipping[$prefix.'zipcode'];
			$data[$prefix.'country'] = $shipping[$prefix.'country'];
			$data[$prefix.'tel'] = $shipping[$prefix.'tel'];
			$order_id = $this->orders->save($data);
			$orders = $this->orders->get_row($order_id);
			if(count($cart)>0){
			  foreach($cart as $item):
				  if($item['id']>0 && $item['qty'] > 0 ){
					$detail['order_id'] = $order_id;
					$detail['product_id'] = $item['id'];
					$product_data = GetProductDetail($item['id']);
					$detail['order_qty'] = $item['qty'];
					$detail['order_price'] = $product_data['price'];
					$this->order_details->save($detail);
					$update_data['id'] = $product_data['id'];
					$update_data['qty'] = $product_data['qty'] < $item['qty'] ? 0 : $product_data['qty'] - $item['qty'];
					$this->product->save($update_data);
				  }
			  endforeach;				
			}	
			$_SESSION['billing'] = null;
			$_SESSION['shipping'] = null;
			$_SESSION['cart'] = null;
			send_order_email($orders);
			redirect('front/confirm/finish/'.$order_id);
		}
	}
}	
        