<?php
/**
 * Hilight Controller
 */
class Ebooks extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("ebooks","views")) {
			redirect("admin");
		}
	}

	public function index() {
		/*
		$data['rs'] = new Ebook_group();
		if(!empty($_GET['g'])) {
			$data['cat'] = new Ebook_group($_GET['g']);
			$data['rs']->where('id', $_GET['g']);
		}
		$data['rs']->where('status', 1)->get();
		
		$data['rs'] = $data['rs']->ebook->order_by('orders', 'asc')->get_page();
		/**/
		
		$data['cat'] = (empty($_GET['g']))?null:new Ebook_group($_GET['g']);
		
		$rsQuery = "select ebook.* from ebook 
			join ebook_group on ebook.ebook_group_id = ebook_group.id 
				and ebook_group.status = 1
			where 
				1=1 ";
		$rsQuery .= (empty($_GET['g']))?null:" and ebook.ebook_group_id = '".$_GET['g']."'";
		$rsQuery .= "order by orders asc";
		$data['rs'] = $this->db->query($rsQuery);
		
		
		$this->template->build("ebooks/index",$data);
	}

	public function form($id=null) {
		if(permission("ebooks","create")) {
			$info = new Ebook_info();
			$info->get_page();
			foreach($info as $item) {
				$data['info'][$item->type] = $item->value;
			}
			
			 
			$data["rs"] = new Ebook($id);
			#$data['rs']->ebook_group_id = (empty($_GET['g']))?$data['rs']->ebook_group_id:$_GET['g'];
			
			$ebook_group_id = null;
			$ebook_group_id = (empty($_GET['g']))?$ebook_group_id:$_GET['g'];
			$ebook_group_id = (empty($data['rs']->ebook_group_id))?$ebook_group_id:$data['rs']->ebook_group_id;
			
			if($ebook_group_id) {
				$data['group'] = new Ebook_group($ebook_group_id);
			}				
			
			$this->template->append_metadata('<link rel="stylesheet" href="js/uploadify/uploadify.css" />');
			$this->template->append_metadata('<script type="text/javascript" src="js/uploadify/jquery.uploadify.js" ></script>');
			$this->template->build("ebooks/form",$data);
		} else {
			redirect("admin");
		}
	}
	
	public function report() {
		if(permission("ebooks","views")) {
			//รายงานการเข้าใช้งาน (จำแนกตตามหนังสือ)
			$data['tb1'] = new Ebook();
			$data['tb1'] -> order_by('viewer', 'desc')
				->get(5);
			
			//รายงานการเข้าใช้งาน (จำแนกตามประเภทหนังสือ)
			$data['tb2'] = $this->db->query("
			select 
				ebook_group.id,
				ebook_group.title,
				sum(ebook.viewer) viewer
			from ebook_group
			left join ebook on  ebook_group.id = ebook.ebook_group_id
			group by 
				ebook_group.id,
				ebook_group.title
			limit 0, 5");
				
			$data['no1'] = $data['no2'] = 0;
			
			$this->template->build('ebooks/report', @$data);
		} else {
			redirect("admin/ebooks");
		}
	}

	public function example($id=null) {
		if(permission("ebooks","views")) {
			$info = new Ebook_info();
			$info->get_page();
			foreach($info as $item) {
				$data['info'][$item->type] = $item->value;
			}
			$data['book'] = new Ebook($id);
			
			$data['rs'] = new Ebook_detail();
			$data['rs']->where('ebook_id', $id);
			$data['rs']->get();
			$this->template->build('ebooks/example', $data);
		} else {
			redirect("admin/ebooks");
		}
	}
	
	public function review($id = null) {
		if(permission("ebooks","views")) {
			$data['rs'] = new Ebook_detail();
			$data['rs']->where('ebook_id', $id);
			$data['rs']->get();
			$data['id'] = $id;
			$this->load->view('ebooks/review', $data);
		} else {
			redirect("admin/ebooks");
		}
	}
	
	public function file_delete($id = null) {
		if(permission("ebooks","delete")) {
			if($id) {
				//Delete ebook detail data
				$data = new Ebook_detail($id);
				$tmp_name = $data->tmp_name;
				$data->delete();
				
				//Delete ebook files
				$dir = 'uploads/ebook/'.$tmp_name;
				unlink($dir);
			}
		}
	}
	
	public function upload($id = null) {
		if(permission("ebooks","create")) {
			$tmpname = $_FILES['Filedata']['tmp_name'];
			$dir = 'uploads/ebook/';
			$path = $_FILES['Filedata']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$filename = uniqid().'.'.$ext;
			move_uploaded_file($tmpname, $dir.$filename);
			
			$data['save'] = new Ebook_detail();
			$data['save']->from_array(array('ebook_id'=>$id, 'file_name' => $filename, 'tmp_name'=>$filename, 'created'=>date('Y-m-d H:i:s'), 'updated'=>date('Y-m-d H:i:s')));
			$data['save']->save();
		}
	}
	
	public function print_page($id, $page) {
		if(permission("ebooks","views")) {
			$rs = new Ebook_detail();
			$rs->where('ebook_id', $id);
			$rs->get(1, ($page-1));
			
			echo '<script>window.print();</script>';
			echo '<img src="'.site_url().'uploads/ebook/'.$rs->tmp_name.'" />';
		} else {
			redirect("admin/ebooks");
		}
	}
	
	public function setting() {
		if(permission("ebooks","create")) {
			$db = new Ebook_info();
			$db->get_page();
			
			foreach($db as $item) {
				$data['rs'][$item->type] = $item->value;
			}
			
			$this->template->build('ebooks/setting', @$data);
		} else {
			redirect("admin/ebooks");
		}
	}
	
	public function setting_save() {
		if(permission("ebooks","create")) {
			if($_POST) {
	
				foreach($_POST as $key=>$item) {
					$this->db->query("delete from ebook_info where type = '".$key."'");
					$data = array(
						'type' 	=> $key,
						'value'	=> $item
					);
					$save = new Ebook_info();
					$save->from_array($data);
					$save->save();
				}
			}
		}
		redirect('admin/ebooks/setting');
	}

	public function save($id=null) {
		if(permission("ebooks","views")) {
			if($_POST) {
				//Ebook info
				$infoTmp = new Ebook_info();
				$infoTmp->get_page();
				foreach($infoTmp as $item) {
					$info[$item->type] = $item->value;
				}
				
				
				$_POST['book_width'] = (empty($_POST['book_width']))?$info['width']:$_POST['book_width'];
				$_POST['book_height'] = (empty($_POST['book_height']))?$info['height']:$_POST['book_height'];
					
				$_POST['status'] = 1;
				$data = new Ebook($id);
				$data->from_array($_POST);
				$data->save();
	
				$type = ($id)?'edit':'add'; // for logs.
				save_logs($type, $data->id);
			}
		}
		if($id) {
			redirect("admin/ebooks?g=".@$_POST['ebook_group_id']);
		} else {
			redirect("admin/ebooks/form/".$data->id."?g=".@$_POST['ebook_group_id']);
		}
	}

	public function delete($id) {
		if(permission("ebooks","delete")) {
			if($id) {
				$dir = 'uploads/ebook/';
				
				$data = new Ebook_detail();
				$data->where('ebook_id', $id);
				$data->get();
				foreach($data as $item) {
					unlink($dir.$item->tmp_name);
					
					$data_detail = new Ebook_detail($item->id);
					$data_detail->delete();
				}
	
				$data = new Ebook($id);
				$data->delete();
				
				save_logs('delete', $id);
			}
		}
		redirect("admin/ebooks");
	}
	
}