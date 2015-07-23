<?php
class home extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index()
    {
			redirect('front/home');
	}
}	
        