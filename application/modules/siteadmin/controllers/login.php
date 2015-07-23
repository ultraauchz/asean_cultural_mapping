<?php
class login extends Blank_Controller
{
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index()
    {
    	$data='';
		if(is_login() && login_data('isadmin')==1){		
			redirect('siteadmin/front');
		}
		else{
			$this->load->view('index');	
		}
	}
	
	public function signin()
	{
		$status = login($_POST['username'],$_POST['password']);
		if($status==1)
		{
			//save_log(98,'Log in','Log In To Admin System');
			redirect('siteadmin/front');
		}
		else
		{
			$this->load->view('index');	
		}
	}	
}	
        