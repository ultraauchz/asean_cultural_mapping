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

	public function inc_footer() {
		$data['footage'] = new Contents();
		$data['footage']->where("slug = 'footage'")->get(1);
		$this->load->view("inc_footer",$data);
	}
	
	public function inc_header() {
		$this->load->view("inc_header");
	}
	
	public function inc_menu(){
		$this->load->view("inc_menu");
	}
	
	public function inc_hilight() {
		$data["variable"] = new Hilight();
		$data["variable"]->where("status",1)->order_by("show_no","DESC")->order_by("created","DESC")->get(5);
		
		$this->load->view("inc_hilight",$data);
	}
	
	public function inc_org_map(){
		$this->load->view('inc_org_map');
	}
	
	public function inc_network_asean(){
		$data['networks'] = new Network();
		$data['networks']->order_by('show_no','desc')->get();
		$this->load->view('inc_network_asean',$data);
	}
	
	public function inc_heritage(){
		$data['rs'] = new Heritage();
		$data['rs']->order_by('id','desc')->get(10);
		$this->load->view('inc_heritage', $data);
	}
	
	public function inc_layout() {
		$data["variable"] = new Web_Layout();
		$data["variable"]->order_by("orders","ASC")->order_by("id","ASC")->get();
		$this->load->view("home",$data);
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