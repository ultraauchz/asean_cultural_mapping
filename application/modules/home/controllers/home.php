<?php
class Home extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function contacts() {
		if($_POST) {
			$_POST["contact_ip"] = $_SERVER["REMOTE_ADDR"];
			
			$data = new Contact_Us();
			$data->from_array($_POST);
			$data->save();
		}
		
		if($data->id) {
			echo "ได้รับข้อความของคุณเรียบร้อย"; 
		}
	}
	
	//	เปลี่ยนขนาด fonts
	public function fonts($size) {
		$this->session->set_userdata("fontsize",$size);
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function index() {
		$data["value"] = new Coverpage();
		$data["value"]->where("status",1)->where("start_date <=",date("Y-m-d"))->where("end_date >=",date("Y-m-d"))->order_by('orders','ASC')->order_by("id","DESC")->get(1);

		if($data["value"]->id && !$this->session->userdata("coverpage")) {
			$this->session->set_userdata("coverpage",TRUE);
			$this->load->view("coverpage",$data);
		} else {
			$this->template->set_layout("default/index");
			$this->template->build("index");	
		}
	}

	public function inc_banner() {
		$data['value'] = new Link();
		$data['value']->where_related("link_group","status",1)->where("status",1)->order_by('id','desc')->get(15);
		$this->load->view("inc_banner",$data);
	}
	
	public function inc_centre() {
		$this->load->view("inc_centre");
	}

	public function inc_contact(){
		$data['value'] = new Setting('1');
		$this->load->view("inc_contact",$data);
	}

	public function inc_eservice() {
		$data["variable"] = new Sidebar();
		$data["variable"]->where("status",1)->order_by("orders","ASC")->order_by("created","ASC")->get();
		$this->load->view("inc_eservice",$data);
	}

	public function inc_footer() {
		$data["value"] = new Other(1);
		$this->load->view("inc_footer",$data);
	}
	
	public function inc_header() {
		$this->load->view("inc_header");
	}
	
	public function inc_hilight() {
		$data["variable"] = new Hilight();
		$data["variable"]->where("status",1)->order_by("orders","ASC")->order_by("created","DESC")->get(5);
		
		$this->load->view("inc_hilight",$data);
	}
	
	public function inc_information() {
		

		$data["value"] = new Content();
		$data["value"]->where("status",1)->where("content_group_id",2)->order_by("orders","ASC")->order_by("id","DESC")->get(1);


		$id = 4;
		//Poll content.
		$data["value2"] = new Survey($id);
		$data["value2"]->counter("views");

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
		$data['status'] = (empty($sad->id))?'survey':'result'; //แบบสอบถาม : กราฟ

		if($data['status'] == 'result' && $this->session->userdata("last_survey")) {
			#$ago = $this->session->userdata("last_survey")+86400;
			$data['status'] = 'survey';//แบบสอบถาม
		}	

		$this->load->view("inc_information",$data);
	}

	public function inc_km() {
		$this->load->view("inc_km");
	}
	
	public function inc_layout() {
		$data["variable"] = new Web_Layout();
		$data["variable"]->order_by("orders","ASC")->order_by("id","ASC")->get();
		$this->load->view("home",$data);
	}

	public function inc_menu() {
		$data["variable"] = new Menu();
		$data["variable"]->where("status",1)->where("parent_id",0)->order_by("orders","ASC")->get();
		
		$data["roots"] = new Menu();
		$data["roots"]->where("status",1)->where("parent_id !=",0)->order_by("orders","ASC")->get();
		
		$this->load->view("inc_menu",$data);
	}
	
	public function inc_newsletter() {
		$data["variable"] = new Content_Group();
		$data["variable"]->where("status",1)->where("is_index",1)->get();
		$this->load->view("inc_newsletter",$data);
	}
	
	public function inc_ourservice() {
		$this->load->view("inc_ourservice");
	}

	public function inc_portfolio() {
		$this->load->view("inc_portfolio");
	}

	public function inc_sidebar() {
		$data["variable"] = new Sidebar();
		$data["variable"]->where("status",1)->order_by("orders","ASC")->order_by("created","ASC")->get();
		$this->load->view("inc_sidebar",$data);
	}

	public function inc_slidetext() {
		$variable = new Slide();
		$variable->where("status",1)->order_by("orders","ASC")->get();
		foreach ($variable as $key => $value) {
			if($key!=0) {
				echo " | "	;
			}
			echo "<a href=\"".$value->links."\" target=\"_blank\" style=\"font-weight: bold;\" >".$value->title."</a>";
		}
	}
	
	//	แผนที่
	public function map() {
		$data["variable"] = new Province();
		$data["variable"]->order_by("title","ASC")->order_by("id","ASC")->get();
		$this->template->build("map_v2",$data);
	}
	
	//	เมนู
	public function menus($id) {
		$data["value"] = new Menu();
		$data["value"]->get_by_slug(urldecode($id));
		$this->template->build("view",$data);
	}
	
	//	หน้าทั่วไป
	public function pages($id) {
		$data["value"] = new Page();
		$data["value"]->get_by_slug(urldecode($id));
		$this->template->build("pages",$data);
	}
	
	public function panel() {
		$data["variable"] = new Content();
		$data["variable"]->where("status",1)->where("content_group_id",1)->order_by("created","DESC")->get(3);
		$this->load->view("panel",$data);
	}

	//	ค้นหา
	public function search() {
		if($_GET) {
			$data["variable"] = new Content();
			$data["variable"]->like("title",$_GET["q"])->or_like("detail",$_GET["q"])->get_page(20);
			$this->template->build("search",$data);
		}
	}
	
	public function department () {
		$sql = "select department.title, department.id, department.status, dept.id as main_id
				from department
				left join department dept on department.parent_id = dept.id and dept.status = '1'
				where department.status = '1'
				and dept.status = 1";
		$result = $this->db->query($sql)->result();
		$data['rs'] = '';
		foreach ($result as $key => $tmp) {
			$data['rs'] .= "[{v:'".$tmp->id."', f:'".$tmp->title."'}, '".$tmp->main_id."', ''],";
		}
		
		$this->template->build("dapartment",@$data);
		//$this->load->view("dapartment",@$data);
	}
	
	public function personnels ($slug=null) {
		$sql = "select * from department 
				where status = '1' and parent_id = '0'";
		$data['variable'] = $this->db->query($sql)->result();
		$this->template->build("personnels", @$data);
	}
	
	
	public function colors($color="default") {
		$this->session->set_userdata("color", $color);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function debug() {
		$sad = new Survey_answer_detail();
		$sad->where("ip_address = '".$_SERVER['REMOTE_ADDR']."'")->get(1);
		echo $_SERVER['REMOTE_ADDR'].'<BR>';
		echo $sad->id.', ';
		echo $sad->ip_address;
	}
}