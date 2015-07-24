<?php
/**
 * Survey_Answer Model
 */
class Survey_Answer extends ORM {

	var $table = "ma_survey_answer";

	var $has_one = array("survey", "survey_question");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
