<?php
class country extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('country_model','country');
    }    
    public $menu_id = 6;
	public $module_name = 'country';
    public function index()
    {
		$data['menu_id'] = $this->menu_id;
		$condition = @$_GET['search']!= '' ? " AND (name LIKE '%".$_GET['search']."%' ) " : "";
		$data['rs'] = $this->country->where(' 1=1 '.$condition)->order_by('id','desc')->get();
		$data['pagination'] = $this->country->pagination();
		$data['module_name'] = $this->module_name;
    	$this->template->build($this->module_name.'/index',$data);
	}
	
	public function form($id=FALSE){
		$data['menu_id'] = $this->menu_id;
		$data['module_name'] = $this->module_name;
		if($id>0){
			$data['rs'] = $this->country->get_row($id);
		}
		$this->template->build($this->module_name.'form',$data);
	}
	
	public function save(){
		$_POST['lastupdate'] = date("Y-m-d H:i:s");		
		if(@$_POST['id']==''){
			$_POST['isadmin'] = 1;
			$_POST['registerdate'] = $_POST['lastupdate'];			
		}else{
			$user = $this->users->get_row($_POST['id']);
		}
		$_POST['password'] = $_POST['password'] == '' ? $user['password'] : $_POST['password'];
		$this->users->save($_POST);
		redirect('siteadmin/'.$this->module_name.'/index');
	}
	
	public function delete($id=FALSE){
		$data['menu_id'] = $this->menu_id;
		$this->users->delete($id);
		redirect('siteadmin/'.$this->module_name.'/index');
	}
}	
        