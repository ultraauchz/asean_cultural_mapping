<?php
/**
 * answer Controller
 */
class Poll_report extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("polls","views")) {
			redirect("admin");
		}
	}
	
	public function index($id = null) {
		$data["rs"] = new Survey_answer_detail();
		$data['rs']->where('survey_id', $id);
		$data["rs"]->get_page();
		$data['no'] = 0;

		$sql = "select 
			sqc.id,
			sqc.title,
			count(sa.id) answer_amount
		from ma_survey_question_choice sqc
			left join ma_survey_answer sa on sqc.survey_question_id = sa.survey_question_id and sqc.id = sa.survey_question_chioice_id
		where sqc.survey_id = ".$id."
		group by
			sqc.id,
			sqc.title";
		$data['ans_perc']['most_val'] = 0;
		foreach($this->db->query($sql)->result_array() as $item) {

			$data['ans_list'][$item['id']] = $item;
			$data['ans_perc']['most_val'] += $item['answer_amount'];
		}
		
		$this->template->build("poll_report/index",$data);
	}
	
	public function detail($id) {
		$data['answer'] = new Survey_answer_detail($id);
		
		$data['survey_id'] = $data['answer']->survey_id;
		$data["value"] = new Survey($data['survey_id']);
		
		$this->template->build("poll_report/form",$data);
	}
	
	public function add_question($type, $id = null, $ans_id = null) {
		$type = ($type=='textarea')?'text':$type; //Textarea เหมือนกับ text
		
		//Get label
		$label = new Survey_question($id);
		$data['label'] = $label->title;
			
		//Get Answer
		$data['answer'] = new Survey_answer();
		$data['answer'] -> where('survey_question_id', $id)
			->where('survey_answer_detail_id', $ans_id)
			->get();
		
		
		if($type == 'text') {
			$data['answer_title'] = $data['answer']->answer_value;
		} else if($type == 'checkbox') {
			$data['answer_title'] = '';
			$no = 0;
			foreach($data['answer'] as $item) {
				$data['answer_title'] .= ($no != 0)?', ':null;
				$no++;
				
				$answer = new Survey_question_choice($item->survey_question_chioice_id);
				$data['answer_title'] .= $answer->title;
			}
			
			
		} else {
			$answer = new Survey_question_choice($data['answer']->survey_question_chioice_id);
			$data['answer_title'] = $answer->title;
		}
			
		$this->load->view("poll_report/add_answer",$data);
	}

	public function delete($id) {
		if($id) {
			$ans = new Survey_answer_detail($id);
			$survey_id = $ans->survey_id;
			$ans->delete();

			$survey = new Survey($survey_id);
			$survey->results = ($survey->results-1);
			$survey->save();
		}
		redirect("admin/poll_report/index/$survey_id");
	}
}
