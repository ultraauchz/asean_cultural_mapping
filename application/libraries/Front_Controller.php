<?php
class Front_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();	
		// check login
		//if(!is_login()) redirect('users/admin/users/index');
		// set theme
		$this->template->set_theme('Front');
		
		// set layout
		$this->template->set_layout('layout');
		
		
		// set title
		$title = "THAIcomplex.com";
		$this->template->title($title);
		
		// Set js
		//$this->template->append_metadata(js_notify());
		
	}
	
}
?>