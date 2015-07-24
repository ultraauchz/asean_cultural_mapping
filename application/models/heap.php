<?php
/**
 * Heap Model
 * สำนัก / กอง
 */
class Heap extends ORM {
	
	public $table = "ma_heap";
	
	public $has_many = array(
		'heap_id' => array(
			            'class' => 'user',
			            'other_field' => 'heap',
			             'join_self_as' => 'heap',
			            'join_other_as' => 'org',
			            'join_field_name' => 'org_id'
			        )
	);
	
	public function __construct($id=null) {
		parent::__construct($id);
	}
	
	public function user() {
		$value = new User();
		$value->where("center_id",$this->org_id)->get();
		return $value;
	}
	
	public function center() {
		$value = new Center();
		$value->get_by_heap_id($this->id);
		return $value;
	}
}
