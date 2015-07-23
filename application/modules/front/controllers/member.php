<?php
class member extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('users_model','users');
		$this->load->model('orders_model','orders');
		$this->load->model('order_details_model','order_details');
		$this->load->model("product_model",'product');
		$this->load->model('product_image_model','product_image');
		$this->load->model('testimonials_model','testimonials');
    }    
    public function profile()
    {
    	$data = '';
		if(is_login()){			
  		    $this->template->build('member/profile',$data);			
		}else{
			redirect('front/member/register_form');	
		}
	}
	public function update_profile(){
		if(is_login()){
			if(@$_POST){
				$_POST['id'] = login_data('id');
				$_POST['password'] = $_POST['password'] == '' ? login_data('password') : $_POST['password'];
				$_POST['lastupdate'] = date("Y-m-d H:i:s");				
				$this->users->save($_POST);
				login($_POST['username'],$_POST['password']);
				redirect('front/member/profile');
			}	
		}else{
			redirect('front/member/register_form');
		}
	}
	public function login(){
		if($_POST){
			login($_POST['username'],$_POST['password']);
			if(is_login()){
				redirect('front/member/profile');	
			}else{
				$this->template->build('member/register_form');
			}
		}
	}
	public function forgot_password(){
		$this->template->build('member/forgot_password');		
	}
	public function send_password(){
		if(isset($_POST['email'])){
			$member = $this->db->getrow("select * from system_users where email='".$_POST['email']."'");
			if(@$member['id']!=''){
				send_password_email($member);
				echo "<script>alert('your password has been sent to your email.');window.location='../../front/member/forgot_password';</script>";
			}else{
				echo "<script>alert('your email not exist.');window.location='../../front/member/forgot_password';</script>";
			}
		}
	}
	public function register_form(){
		$data='';
		if(is_login()){
			redirect('front/member/profile');
		}else{
			$this->template->build('member/register_form',$data);
		}
	}
	public function register(){
		if(@$_POST){
			$_POST['registerdate'] = date("Y-m-d H:i:s");
			$_POST['status'] = '1';
			$user_id = $this->users->save($_POST);
			send_register_email($user_id);
			login($_POST['username'],$_POST['password']);
			redirect('front/member/register_complete'); 
		}
	}
	public function order_history(){
		//$this->db->debug = true;
		$data['orders'] = $this->orders->where('user_id='.login_data('id'))->order_by('id','desc')->get(); 
		$data['pagination'] = $this->orders->pagination();
		$this->template->build('member/order_list',$data);
	}
	public function order_detail($id){
		if(is_login()){
			$data['orders'] = $this->orders->get_row($id);
			$data['order_details'] = $this->order_details->where('order_id='.$id)->order_by('id','asc')->get(FALSE,TRUE);
			$this->template->build('member/order_detail',$data);
			
		}else{
			redirect('front/member/profile');
		}		
	}
	public function send_payment_confirm($id){
		if(is_login()){
			if($_FILES['payment_doc']['name']!=''){
				$data = $this->orders->get_row($id);
								
				if($data['payment_doc']!='')@unlink("uploads/order_payments/".$data['payment_doc']);
				$ext = pathinfo($_FILES['payment_doc']['name'], PATHINFO_EXTENSION);
				$picname = $id."_".date("Y-m-d_H-i-s").".".$ext;
				$uploaddir = 'uploads/order_payments/';
				$fpicname = $uploaddir.$picname;
				move_uploaded_file($_FILES['payment_doc']['tmp_name'], $fpicname);
				$data['payment_doc']=$picname;
				$data['order_status'] = 2;
				$data['payment_date'] = $_POST['payment_date'];
				$this->orders->save($data);
			}
			redirect('front/member/order_detail/'.$id);
			
		}else{
			redirect('front/member/profile');
		}
	}
	
	public function testimonials(){
		if(is_login()){			
  		    $data['testimonials'] = $this->testimonials->where('user_id='.login_data('id'))->order_by('create_date','desc')->get();
			$data['pagination'] = $this->testimonials->pagination();
			$this->template->build('member/testimonials',$data);
		}else{
			redirect('front/member/register_form');	
		}
	}
	
	public function testimonials_save(){
		if(is_login()){
			$_POST['status'] = 1;
			$_POST['user_id'] = login_data("id");
			$_POST['create_by'] = login_data("id");
			$_POST['create_date'] = date("Y-m-d H:i:s");
  		    $this->testimonials->save($_POST);
			redirect('front/member/testimonials');
		}else{
			redirect('front/member/register_form');	
		}
	}
	
	public function testimonials_delete($id){
		if(is_login()){
  		    $this->db->execute('delete from testimonials where id='.$id.' and user_id='.login_data('id'));
			redirect('front/member/testimonials');
		}else{
			redirect('front/member/register_form');	
		}
	}
	
	
	public function logout(){
		logout();
		redirect('front/member/profile');
	}
	
	public function register_complete(){
		$this->template->build('member/register_complete');
	}
	
	public function aj_ordered_product(){
		$order_detail = $this->order_details->get_row($_POST['order_detail_id']);
		$product = $this->product->get_row($order_detail['product_id']);
		$data['product_image'] = $this->product_image->where('product_id='.$product['id'])->order_by('show_no','desc')->get(FALSE,TRUE);
		$orders = $this->orders->get_row($order_detail['order_id']);
		$data['orders'] = $orders;
		$data['order_detail'] = $order_detail;
		$data['product'] = $product;
		$this->load->view('front/member/product_detail',$data);
	}
}