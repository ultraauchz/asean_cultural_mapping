<?php
/**
 * Survey_Question Model
 */
class Survey_Question extends ORM {

	var $table = "ma_survey_question";

	var $has_one = array("survey");

	var $has_many = array("survey_answer","survey_question_choice");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
