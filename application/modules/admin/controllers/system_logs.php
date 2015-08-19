<?php
class System_Logs extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		$this->menu_id = 21;
		$this->modules_name = 'system_logs';
		$this->current_user = user();
		$this->perm = current_user_permission($this->menu_id);
		if($this->perm->can_view!='y'){
			redirect("admin");
		}
	}
	
	public function index() {		
		$data['menu_id'] = $this->menu_id;
		$data['modules_name'] = $this->modules_name;
		$data['current_user'] = $this->current_user;
		$data['perm'] = $this->perm;
		$data['result'] = new System_log();
		if(@$_GET['start_date']!='' && @$_GET['end_date']!=''){
			$data['result']->where("date(log_date) >= '".$_GET['start_date']."' AND date(log_date) <= '".$_GET['end_date']."'");
		}else if(@$_GET['start_date']!='' && @$_GET['end_date']==''){
			$data['result']->where("date(log_date) >= '".$_GET['start_date']."'");
		}if(@$_GET['end_date']!=''){
			$data['result']->where("date(log_date) <= '".$_GET['end_date']."'");
		}
		if(@$_GET['search']!='')$data['result']->where_related("user","firstname LIKE '%".$_GET['search']."%'");
		if(@$_GET['org_id']!='')$data['result']->where_related("user","org_id = ".$_GET['org_id']);
		if(@$_GET['country_id']!='')$data['result']->where_related("user","org_id in (select id from acm_organization where country_id=".$_GET['country_id'].")");		
		$data["result"]->order_by("log_date","DESC")->get_page();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		$data['page'] = (empty($_GET['page']))? 1 : $_GET['page'];
		if(@$_GET['submit']=='')save_logs($this->menu_id, 'View', 0 , 'View System Logs ');
		$this->template->build('system_logs/index',$data);		
	}
	
	
}
