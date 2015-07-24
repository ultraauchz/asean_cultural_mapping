<?php
/**
 * Faqs Controllers
 */
class Faqs extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data["faq_groups"] = new Faq_Group();
		
		if(@$_GET['search']){
			switch (@$_GET['type']) {
			    case 'category':
			        $data["faq_groups"]->where("title like '%".@$_GET['search']."%'");
			        break;
			    case 'question':
			        $data["faq_groups"]->where_related_faq("question like '%".@$_GET['search']."%'");
			        break;
			    case 'answer':
			        $data["faq_groups"]->where_related_faq("answer like '%".@$_GET['search']."%'");
			        break;
			    default:
			    	$search = $_GET["search"];
			    	$data["faq_groups"]->like("title","search")->or_like_related("faq","question",$_GET["sear"])->or_like_related("faq","answer",$_GET["sear"]);
			    	break;
			}
		}
		
		$data["faq_groups"]->where('status', 1)->order_by('orders','asc')->get();
		$this->template->build("index",$data);
	}
	
}
