<?php
class users extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('users_model','users');
    }    
    public $menu_id = 21;
    public function index()
    {
    	//$this->db->debug=true;
		$data['menu_id'] = $this->menu_id;
		$condition = @$_GET['search']!= '' ? " AND (name LIKE '%".$_GET['search']."%' OR username = '%".$_GET['search']."%') " : "";
		$data['rs'] = $this->users->where('isadmin = 1'.$condition)->order_by('id','desc')->get();
		$data['pagination'] = $this->users->pagination();
    	$this->template->build('users/index',$data);
	}
	
	public function form($id=FALSE){
		$data['menu_id'] = $this->menu_id;
		if($id>0){
			$data['rs'] = $this->users->get_row($id);
		}
		$this->template->build('users/form',$data);
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
		redirect('siteadmin/users/index');
	}
	
	public function delete($id=FALSE){
		$data['menu_id'] = $this->menu_id;
		$this->users->delete($id);
		redirect('siteadmin/users/index');
	}
}	
        