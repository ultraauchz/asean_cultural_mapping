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


function save_logs($type, $id = null) {
	$menu = get_menu();
	$user = user();
	
	if($type == 'add') {
		$txt = 'เพิ่มข้อมูล ';
	} else if($type == 'edit') {
		$txt = 'แก้ไขข้อมูล ';
	} else if($type == 'delete') {
		$txt = 'ลบข้อมูล ';
	}
	
	$txt .= ' เมนู "'.$menu.'"';
	$txt .= ' รหัสข้อมูล '.$id;
	$txt .= ' โดย'.' '.$user->firstname;
	$txt .= ' เวลา '.date('Y-m-d H:i:s');
	
	$data = array(
		'type' => $type,
		'menu' => $menu,
		'detail' => $txt,
		'created' => date('Y-m-d H:i:s'),
		'user_id' => $user->id,
		'user_name' => $user->fullname
	);
	
	$save = new Log();
	$save->from_array($data);
	$save->save();
}
