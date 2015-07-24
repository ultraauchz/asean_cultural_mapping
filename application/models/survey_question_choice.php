<?php
/**
 * Survey_Question_Choice Model
 */
class Survey_Question_Choice extends ORM {
	
	var $table = "ma_survey_question_choice";

	
	var $has_one = array("survey","survey_question");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
