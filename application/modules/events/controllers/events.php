<?php
/**
 * Events Controller
 */
class Events extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data["variable"] = new Event();
		$data["variable"]->where("status",1)->get();
		$this->template->build("index",$data);
	}
	
	public function view ($id) {
		$data["variable"] = new Event($id);
		if (empty($data["variable"]->id)) { redirect("events"); }
		$this->template->build("view", @$data);
	}
	
	public function get_fullcalendar () {
		$date_start = date('Y-m-d', $_GET['start']);
		$date_end = date('Y-m-d', $_GET['end']);
		$events = new Event();
		$events->where('start_date <=', $date_end);
		$events->where('end_date >=', $date_start);
		$events->where("status",1)->where_related("event_group","status",1)->get();
		
		foreach ($events as $key => $event) {
			if (empty($event->everyday)) {
				$everyday_[] = array(
									"title"=>$event->title,
									"start"=>$event->start_date,
									"end"=>$event->end_date,
									"url"=>'events/view/'.$event->id,
									"color"=>$event->event_type->code_color
							   ); 
			} else {
				$stert = $event->start_date;
				$end = $event->end_date;
				$one_day = (24 * 60 * 60 * 1000);
				for ($loop = strtotime($event->start_date); $loop <= strtotime($event->end_date); $loop = strtotime("+1 day", $loop)) {
					$eventDate = date('Y-m-d', $loop);
					$loop_day = date('l', $loop);
					if ($loop_day ==  $event->everyday ) {
						$everyday_[] = array(
									"title"=>$event->title,
									"start"=>$eventDate,
									"end"=>$eventDate,
									"url"=>'events/view/'.$event->id,
									"color"=>$event->event_type->code_color
							   );
					}
				}
			}
		}

		echo json_encode(@$everyday_);
	}
	
}
