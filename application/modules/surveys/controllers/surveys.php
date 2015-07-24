<?php
/**
 * Surveys Controllers
 */
class Surveys extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$date = date("Y-m-d");
		$data["variable"] = new Survey();
		$data["variable"]->where("status",1)
			->group_start()
				->where("start_date <=",$date)
				->where("end_date >=",$date)
			->group_end()
			->or_where("period_type = '1'")
			->get_page();

		$this->template->build("index",$data);
	}
	
	public function view($id) {
		$data["value"] = new Survey($id);
		$data["value"]->counter("views");

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

		//Check ipaddress
		$sad = new Survey_answer_detail();
		$sad->where("ip_address = '".$_SERVER['REMOTE_ADDR']."'")
			->where("survey_id = '".$id."'")
			->get(1);
		$data['status'] = (empty($sad->id))?'survey':'result';
		
		/*
		if($data['value']->question_type == 2) {
			$this->session->set_flashdata("error",1);
			$this->session->set_flashdata("msg",'ไม่สามารถทำแบบสอบถามซ้ำได้');
			redirect('surveys');
		}*/

		$this->template->build("view",$data);
	}
	
	public function send($id) {
		$error = 0;
		$msg = null;	
		
		if(check_captcha(@$_POST["captcha"]) || $id==4) {
			
			$ago = 0;
			
			if($this->session->userdata("last_survey")) {
				$ago = $this->session->userdata("last_survey")+86400;
			}	
		
			if(now()>$ago) {
				$this->session->set_userdata("last_survey",now());
				
				//	save ลง table คำตอบ
				$ans_detail = new Survey_Answer_Detail();
				$ans_detail->survey_id = $id;
				$ans_detail->ip_address = $_SERVER["REMOTE_ADDR"];
				$ans_detail->save();
				
				//	save ลงในคำตอบย่อย
				foreach ($_POST as $key => $value) {
					$survey_question_id = preg_replace("/[^0-9?!]/", "", $key);
					
					$data = new Survey_Question($survey_question_id);
					$type = $data->survey_question_type_id;
					
					if($type<3) {
						$ans = new Survey_Answer();
						$ans->survey_id = $id;
						$ans->survey_question_id = $survey_question_id;
						$ans->survey_question_type_id = $type;
						$ans->survey_answer_detail_id = $ans_detail->id;
						$ans->answer_value = $value;
						$ans->save();
					} else {
						$ans = new Survey_Answer();
						$ans->survey_id = $id;
						$ans->survey_question_id = $survey_question_id;
						$ans->survey_question_type_id = $type;
						$ans->survey_answer_detail_id = $ans_detail->id;
						$ans->survey_question_chioice_id = $value;
						$ans->save();
					}
				}
				
				$survey = new Survey($id);
				$survey->counter('results');
			} else {
				$error = 1;
				$msg .= "ไม่สามารถส่งแบบสอบถามซ้ำได้<br />";
			}
		} else {
			$error = 1;
			$msg .= "กรุณาใส่รหัสยืนยันให้ถูกต้อง<br />";
		}
		
		if($error==0) {
			redirect("surveys");
		} else {
			$this->session->set_flashdata("error",1);
			$this->session->set_flashdata("msg",$msg);
			redirect("surveys");
		}
	}
	
}
