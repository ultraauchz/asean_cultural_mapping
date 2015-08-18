<?php
/**
 * User Model
 */
class User extends ORM {
	
	var $table = "acm_user";
	var $has_one = array("organization","acm_user_type");
	var $has_many = array("log","system_log");
	/*
	var $has_one = array("operation_center","user_type",
		'center' => array(
			            'class' => 'center',
			            'other_field' => 'center_id',
			            'join_self_as' => 'center',
			            'join_other_as' => 'org'
			        ),
		'heap'	=> array(
			            'class' => 'heap',
			            'other_field' => 'heap_id',
			            'join_self_as' => 'center',
			            'join_other_as' => 'org'
		)
	);

	var $has_many = array("forum_comment","forum_topic","log","request_rain_progess");
	*/
	function __construct($id=null) {
		parent::__construct($id);
	}
}