<?php
class contents extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('contents_model','contents');
    }    
    public $menu_id = 5;
    public function index()
    {
    	//$this->db->debug=true;
		$data['menu_id'] = $this->menu_id;
		$data['item'] = $this->contents->get_content("aboutus");
		$this->template->build('aboutus/form',$data);
	}
	
	public function form($id=FALSE){
		$data['menu_id'] = $this->menu_id;
		if($id>0){
			$data['item'] = $this->users->get_row($id);
		}
		$this->template->build('aboutus/form',$data);
	}
	
	public function save(){
		//$this->db->debug = true;		
		$data['menu_id'] = $this->menu_id;
		$_POST['update_by'] = login_data('id');
		$_POST['updated_date'] = date("Y-m-d h:i:s");		
		$this->content->save($_POST);
		redirect('siteadmin/aboutus/index');
	}
}	
        