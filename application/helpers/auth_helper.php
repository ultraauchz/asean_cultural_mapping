<?php
function login($username,$password)
{
	$CI =& get_instance();
	//$CI->db->debug=TRUE;
	$sql = "select * from system_users where  username = ? and password = ? ";
	$id = $CI->db->GetOne($sql,array($username,$password));	
	if($id)
	{
		$CI->session->set_userdata('id',$id);
		$ip=(@getenv(HTTP_X_FORWARDED_FOR)) ? @getenv(HTTP_X_FORWARDED_FOR):@getenv(REMOTE_ADDR); 
		$CI->session->set_userdata('ipaddress',$ip);
		$CI->session->set_userdata('date_login',now());				
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}


function is_login($usertype = FALSE)
{
	$CI =& get_instance();
	//$CI->db->debug = true;
	{
		$sql = 'select id from system_users where id = ?';
		$id = $CI->db->GetOne($sql,$CI->session->userdata('id'));
	}
	return ($id) ? true : false;
}

function permission($menu_id,$action)
{
	$sql = 'SELECT  *
	FROM system_usertype_detail 
	WHERE system_usertype_id= '.login_data('usertype').' 
	AND menu_id ='.$menu_id;
	$CI =& get_instance();
	$perm = @$CI->db->getrow($sql);	
	return @$perm[$action];
}

function login_data($field)
{
	$CI =& get_instance();
	$sql = 'select '.$field.' from system_users  where system_users.id = ?';
	$result = $CI->db->GetOne($sql,$CI->session->userdata('id'));
	//dbConvert($result);
	return $result;
}
function save_log($menu_id=FALSE,$action=FALSE,$description='')
{
	$CI=& get_instance();
	$data['user_id'] = login_data("id");
	$data['menu_id'] = $menu_id;
	$data['action'] = $action;
	$data['action_date'] = date("Y-m-d H:i:s");
	$data['ipaddress'] = $_SERVER['REMOTE_ADDR'];
	$data['description']=$description;
	$table='admin_log';

		$columns = $CI->db->MetaColumnNames($table);
		$meta = $CI->db->MetaColumns($table);
		//array_walk($data,'dbConvert','TIS-620');
		$data = array_change_key_case($data, CASE_UPPER);
		$data = array_intersect_key($data,$columns);
			$column = '';
			$value = '';
			$comma = '';
			foreach($data as $key => $item)
			{
				$column .= $comma.''.$key.'';
				if($meta[$key]->type=='N')
				{
						$value .= $item == '' ? $comma."0" : $comma.str_replace(',','',$item);
				}
				else
				{
						$value .=  $comma.'\''.$item.'\'';
				}
			
				$comma = ',';
			}
			$sql = 'INSERT INTO '.$table.'(id,'.$column.') VALUES ("",'.$value.')';
			//echo $sql;
			
			$CI->db->Execute($sql);

}
function logout()
{
	$CI =& get_instance();	
	$CI->session->unset_userdata('id');	
}


function regist_login($email,$password)
{
	$CI =& get_instance();
	$sql = "select * from regist_person where email = ? and password = ? ";
	//$id = $CI->db->GetOne($sql,array($username,md5($password)));	
	$id = $CI->db->GetOne($sql,array($email,$password));
	if($id)
	{
		$CI->session->set_userdata('id',$id);
		$ip=(@getenv(HTTP_X_FORWARDED_FOR)) ? @getenv(HTTP_X_FORWARDED_FOR):@getenv(REMOTE_ADDR); 
		$CI->session->set_userdata('ipaddress',$ip);
		$CI->session->set_userdata('date_login',now());				
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function is_regist_login()
{
	$CI =& get_instance();
		$sql = 'select id from regist_person where id = ?';
		$id = $CI->db->GetOne($sql,$CI->session->userdata('id'));
	return ($id) ? true : false;
}

function login_regist_data($field)
{
	$CI =& get_instance();
	//$CI->db->debug=TRUE;
		$sql = 'select '.$field.' from regist_person  where regist_person.id = ?';
	
	$result = $CI->db->GetOne($sql,$CI->session->userdata('id'));
	//dbConvert($result);
	return $result;
}

function login_regist_data_row($user_id=FALSE){
	$CI =& get_instance();
	//$CI->db->debug=TRUE;
		$user_id = $user_id > 0 ? $user_id : $CI->session->userdata('id');
		$sql = 'select regist_person.*, 
		country.name as country_name,
		title.title as title_name,
		gender.title as gender_title,
		nationality.title as nationality_title,
		food.title as food_title,
		payment_status.title as payment_status_title,
		payment_option.title as payment_option_title,
		person_type.title as person_title
		
		from regist_person 
		left join country on regist_person.country = country.id  
		left join title on regist_person.title = title.id
		left join gender on regist_person.gender = gender.id
		left join nationality on regist_person.nationality = nationality.id
		left join food on regist_person.food = food.id
		left join payment_status on regist_person.payment_status = payment_status.id
		left join payment_option on regist_person.payment_option = payment_option.id
		left join person_type on regist_person.person_status = person_type.id
		where regist_person.id = '.$user_id;
	
	$row = $CI->db->getrow($sql);
	//dbConvert($result);
	$row['fullname'] = $row['title_name'].' '.$row['firstname'].' '.$row['lastname'];
	return $row;
}

function time_login_update($id){
	$CI =& get_instance();
	$CI->db->execute("UPDATE users SET TIME_LOGIN= ".time()." WHERE id = $id");
}

function time_check_last_login(){
	$CI =& get_instance();
	$CI->db->execute("UPDATE users SET STATUS = 0 WHERE TIME_LOGIN <=".(time()-600));
}
	
	function get_menu_name($menu_id=FALSE){
	$CI=& get_instance();
	return $CI->db->getone("SELECT title FROM admin_menu WHERE id=".$menu_id);
}
?>