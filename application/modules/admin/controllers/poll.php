<?php
/**
 * Poll Controller
 */
class Poll extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("polls","views")) {
			redirect("admin");
		}
	}
	
	public function index() {
		if(permission("polls","views")) {
			$data["variable"] = new Survey();
			$data["variable"]->order_by("orders","ASC")->order_by("id","DESC")->get_page();
			$this->template->build("poll/index",$data);
		} else {
			redirect("admin");
		}
	}
	
	public function form($id=null) {
		if(permission("polls","create")) {
			$data["value"] = new Survey($id);
			$this->template->build("poll/form",$data);
		} else {
			redirect("admin/poll");
		}
	}
	
	public function result($id) {
		if(permission("polls","views")) {
			$data["value"] = new Survey($id);
			$this->template->build("poll/result",$data);
		} else {
			redirect("admin/poll");
		}
	}
	
	public function save($id=null) {
		if(permission("polls","create")) {
			if(@$_POST) {
				//Survey		
				$survey = new Survey($id);
				$survey->title = strip_tags($_POST["title"]);
				$survey->detail = @$_POST["detail"];
				$survey->start_date = (empty($_POST["start_date"]))?null:$_POST["start_date"];
				$survey->end_date = (empty($_POST["end_date"]))?null:$_POST["end_date"];
				$survey->image_path = @$_POST["image_path"];
				$survey->period_type = @$_POST['period_type'];
				$survey->file_path = @$_POST["file_path"];
				$survey->question_type = $_POST['question_type'];
				$survey->save();
					
				$type = ($id) ? "edit" : "add"; // for logs.
				save_logs($type, $survey->id);
				
				$id = $survey->id;
				
				
				//Survey Question
					$chk_remove = new Survey_question();
					$chk_remove->where('survey_id', $id);
		
					foreach($_POST["question_title_reference_id"] as $key => $value) {
						$qold = new Survey_question();
						$qold->where('uid', $value)->get(1);
						
						$qdata = array(
							'id'=>@$qold->id,
							'survey_id'=>$id,
							'survey_question_type_id'=>$_POST['question_type_'.$value],
							'uid'=>$value,
							'title'=>$_POST['question_title'][$key],
						);
						
						$q = new Survey_question(); //Question
						$q->from_array($qdata);
						$q->save();	
			
						//Check remove
						$chk_remove->where('id <> ', $q->id);
						
						
						//Survey question choice
						//Check remove choice
						$chk_remove_choice = new Survey_question_choice();
						$chk_remove_choice->where('survey_question_id', $q->id);
						
						if(!empty($_POST['question_'.$q->uid])) {
							foreach($_POST['question_'.$q->uid] as $key => $item2) {
								if($item2) {
									$qchoice_old = new Survey_question_choice();
									$qchoice_old->where('uid', $_POST['qchoice_'.$q->uid][$key]);
									$qchoice_old->get(1);
									
									$qchoice_data = array(
										'id'=>$qchoice_old->id,
										'survey_id'=>$id,
										'survey_question_id'=>$q->id,
										'uid'=>$_POST['qchoice_'.$q->uid][$key],
										'title'=>$item2
									);
									
									$qchoice = new Survey_question_choice();
									$qchoice->from_array($qchoice_data);
									$qchoice->save();
									
									//Check remove choice
									$chk_remove_choice->where('id <> ', $qchoice->id);
								}
							} //foreach($_POST['question_'.$q->uid] as $key => $item2) {
						}
							
						//Remove question choice
						$chk_remove_choice->get();
						foreach($chk_remove_choice as $item) {
							$remove_choice = new Survey_question_choice($item->id);
							$remove_choice->delete();
						}
					}
	
					//Remove Question
					$chk_remove->get();
					foreach($chk_remove as $item) {
						//Remove question choice
						$this->db->query("delete from ma_survey_question_choice where survey_question_id = '".$item->id."'");
						
						//Remove question
						$qdelete = new Survey_question($item->id);
						$qdelete->delete();
					}
			}
		}
		redirect("admin/poll");
	}
	
	public function delete($id) {
		if(permission("polls","delete")) {
			if($id) {
				
				//Survey question
				$this->db->query("delete from ma_survey_question where survey_id = '".$id."'");
				 
				//Survey question choice
				$this->db->query("delete from ma_survey_question_choice where survey_id = '".$id."'");
				
				//Survey answer
				$this->db->query("delete from ma_survey_answer where survey_id = '".$id."'");
				
				//Survey answer detail
				$this->db->query("delete from ma_survey_answer_detail where survey_id = '".$id."'");
				
				//Survey answer detail
				$this->db->query("delete from ma_survey where id = '".$id."'");
	
				save_logs('delete', $id);
			}
		}
		redirect("admin/poll");
	}
	
	
	public function add_text($id = null) {
		$data['rs'] = new Survey_question($id);
		$data["uid"] = (empty($data['rs']->uid))?uniqid():$data['rs']->uid;
		
		$this->load->view("poll/add_text",$data);
	}
	
	public function add_textarea($id = null) {
		#$data["uid"] = uniqid();
		$data['rs'] = new Survey_question($id);
		$data["uid"] = (empty($data['rs']->uid))?uniqid():$data['rs']->uid;
		
		$this->load->view("poll/add_textarea",$data);
	}
	
	public function add_checkbox($id = null) {
		#$data["uid"] = uniqid();
		$data['rs'] = new Survey_question($id);
		$data["uid"] = (empty($data['rs']->uid))?uniqid():$data['rs']->uid;
		
		$this->load->view("poll/add_checkbox",$data);
	}
	
	public function add_checkbox_choice($uid, $id = null) {
		$data["uid"] = $uid;//
		$data['rs'] = new Survey_question_choice($id);
		$data['uid2'] = (empty($data['rs']->uid))?uniqid():$data['rs']->uid;
		
		$this->load->view("poll/add_checkbox_choice",$data);
	}
	
	public function add_radio($id = null, $t = null) {
		$_GET['type'] = (empty($_GET['type']))?$t:$_GET['type'];
		#$data["uid"] = uniqid();
		$data['rs'] = new Survey_question($id);
		$data["uid"] = (empty($data['rs']->uid))?uniqid():$data['rs']->uid;
		
		$this->load->view("poll/add_radio",$data);
	}
	
	public function add_radio_choice($uid, $id = null) {
		$data["uid"] = $uid;
		$data['rs'] = new Survey_question_choice($id);
		$data['uid2'] = (empty($data['rs']->uid))?uniqid():$data['rs']->uid;
		
		
		$this->load->view("poll/add_radio_choice",$data);
	}
	
}
