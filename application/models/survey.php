<?php
/**
 * Survey
 */
class Survey extends ORM {

	var $table = "ma_survey";

	var $has_many = array("survey_answer","survey_question", "survey_answer_detail","survey_question_choice");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
