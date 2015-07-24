<?php
/**
 * Survey_Answer_Detail Modell
 */
class Survey_Answer_Detail extends ORM {
	
	public $table = "ma_survey_answer_detail";
	
	var $has_one = array("survey");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
