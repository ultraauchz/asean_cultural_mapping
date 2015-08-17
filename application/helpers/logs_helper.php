<?php
function get_menu() {
	$tmp = explode('/', $_SERVER['PATH_INFO']);
	$type = 'front';
	foreach($tmp as $item) {
		if($item) {
			$path_info[] = $item;
		}
		$type = ($item=='admin')?'back':$type;
	}
	$rs = ($type == 'front')?$path_info[0]:$path_info[1];
	return $rs;
}


function save_logs($menu_id, $action, $data_id, $description) {
	/*
	id	int
	menu_id	int
	user_id	int
	data_id	int
	action	varchar
	description	text
	ipaddress	varchar
	log_date	datetime
	*/
	$CI =& get_instance();
	$data['menu_id'] = $menu_id;
	$data['user_id'] = $CI->session->userdata("id");
	$data['data_id'] = $data_id;
	$data['action'] = $action;	
	$data['description'] = $description;
	$data['ipaddress'] = $_SERVER['REMOTE_ADDR'];
	$data['log_date'] = date("Y-m-d H:i:s");
	
	$save = new Log();
	$save->from_array($data);
	$save->save();
}
