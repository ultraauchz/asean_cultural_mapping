<?php
class siteadmin extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index()
    {
    	$data='';
		if(is_login()){		
			redirect('siteadmin/front');
		}
		else{
			$this->load->view('index');	
		}
	}
	
	public function front(){
		$data = '';
		$data['menu_id'] = 0;
		$this->template->build('front',$data);
	}	
	
	public function signout(){
		save_log(99,'Log Out','Log Out To Admin System');
		logout();
		redirect('siteadmin/index');
	}
}	
        