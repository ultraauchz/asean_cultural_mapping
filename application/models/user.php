<?php
/**
 * User Model
 */
class User extends ORM {
	
	var $table = "acm_users";
	var $has_one = array("acm_organizations","acm_user_types");
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
	
	public function Organization() {
		$value = new Center();
		$value->get_by_org_id($this->org_id);
		return $value;
	}
}