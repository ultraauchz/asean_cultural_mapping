<?
	class GenBook {
		private $id;
		private $page;
		private $coverpage;
		public $size = array('width'=>325, 'height'=>500);
		private $path;
		
		public function help() {
			echo "<pre>
 ==================
		!Readme!
 ==================
 *** การใช้งาน Genbook จำเป้นจะต้องมี Jquery อยู่ก่อนแล้ว 
 *** การ set_path แนะนำให้ทำในจุดที่เป็น header เพราะภายหลังการ set_path  genbook จะเรียกไฟล์ที่จำเป็นออกมาในทันที
\$book->set_id('Book1');// -- เริ่มต้นต้องกำหนด \"ID\" ให้กับหนังสือก่อนการดำเนินงานใด ๆ
\$book->set_path(array( 'library' => 'turnjs4/' )); // -- ทำการกำหนดที่อยู่ของ library ให้กับ class เพื่อให้ class สามารถทำงาน, นำเข้าข้อมูลมาจาก library ได้อย่างถูกต้อง
\$book->set_size('500', '700');  // -- กำหนดขนาดให้กับหนังสือ array('ความกว้าง', 'ความยาว')

\$book->set_coverpage('book/booktest1/cover_001.jpg'); // -- หากต้องการให้มีปก ต้องใช้คำสั่ง coverpage เพื่อสร้างหน้าปกให้แก่หนังสือ
\$book->set_page('book/booktest1/001.jpg'); // -- ใส่หน้าหนังสือให้แก่หนังสือทีละหน้า
\$book->set_page('book/booktest1/002.jpg');
\$book->set_page('book/booktest1/003.jpg');
\$book->set_page('book/booktest1/004.jpg');
\$book->set_page('book/booktest1/005.jpg');
\$book->get(); // เรียกหนังสืออกมาเพื่อใช้งาน
			</pre>";
			return false;
		}
		
		
		
		public function set_path($path) {
			$this->path = $path;
			$this->call_library();
		}
		private function call_library() {
			$path = $this->path;
			echo '<link rel="stylesheet" href="'.$path.'/default.css" type="text/css">';
			echo '<script src="'.$path.'/lib/hash.js"></script>';
			echo '<script src="'.$path.'/lib/turn.html4.min.js"></script>';
			echo '<script src="'.$path.'/lib/turn.min.js"></script>';
			echo '<script src="'.$path.'/lib/zoom.min.js"></script>';
		}
		
		
		function set_size($width = null, $height = null) {
			if($width) { $this->size['width'] = $width; }
			if($height) { $this->size['height'] = $height; }
		}
		private function get_size($type) {
			return (empty($this->size[$type]))?false:$this->size[$type];
		}
		
		
		function set_coverpage($page) {
			$this->coverpage['page'][] = $page;
			$this->coverpage['status'] = true;
		}
		function unset_coverpage() {
			usnet($this->coverpage);
			$this->coverpage['status'] = false;
		}
		
		
		function set_id($id) {
			$this->id = $id;
		}
		
		private function get_shadow($type) {
			$path = $this->path;
			if($type == 'left') {
				return "<img src='".$path."/images/shadow_page_left.png' class='shadow'>";
			} else if($type == 'right') {
				return "<img src='".$path."/images/shadow_page_right.png' class='shadow'>";
			} else if($type == 'cover') {
				return "<img src='".$path."/images/shadow_page_cover.png' class='shadow'>";
			} else if($type == 'paper') {
				return "<img src='".$path."/images/texture_paper.png' class='shadow'>";
			}
		}


		function set_page($page) {
			$this->page[] = $page;
		}
		function match_page($directory, $cover = false) {
			$tmp = dir($directory);
			while(false != ($item = $tmp->read())) {
				if($item != '.' && $item != '..') {
					if(in_array($item, $cover) || $item == $cover) {
						$this->set_coverpage($directory.'/'.$item);
					} else {
						$this->page[] = $directory.'/'.$item;
					}
				}
			}
			return count($this->page); // คืนค่าจำนวนหน้าหนังสือ
		}
		
		public function btn_zoomin() {
			echo 'zoomin';
		}

		public function get() {
			if(empty($this->id)) {
				echo 'กรุณระบุ id ให้แก่รายการนี้';
				return false;
			}
			if(empty($this->path)) {
				echo 'กรุณาระบุ Path ที่อยู่ของ library ก่อนการดำเนินการ';
			}
			
			$page = 0;
			$section = 0;
			echo '<div id="'.$this->id.'" class="ebook">';
				if($this->coverpage['status']) {
					echo "<div class='hard'>";
						echo $this->get_shadow("cover");
						echo '<img src="'.$this->coverpage['page'][0].'" style="width:100%; height:100%;" />'; 
					echo "</div>";
					echo "<div class='hard' style='background:#eee;'>".$this->get_shadow("cover").$this->get_shadow("paper")."</div>";
				}
				
					foreach($this->page as $item) {
						$page++;
						$section = ($section == 0)?1:0;
						echo '<div class="page">';
							if($section == 1) {
								echo $this->get_shadow('right');
								echo '<div class="page_no left" style="">'.$page.'</div>';
							} else if($section == 0) {
								echo $this->get_shadow('left');
								echo '<div class="page_no right" style="">'.$page.'</div>';
							}
								
							echo '<img src="'.$item.'" style="width:100%; height:100%;"/>';
						echo '</div>';
					}
					
				if($this->coverpage['status']) {
					if($section == 1) {
						echo '<div class="page">'.$this->get_shadow('left').'</div>';
					}
					echo "<div class='hard' style='background:#eee;'>".$this->get_shadow('cover').$this->get_shadow("paper")."</div>";
					echo "<div class='hard' style='background:#eee;'>".$this->get_shadow('cover').$this->get_shadow("paper")."</div>";
				}
			
			echo '</div>';
			#echo ($this->get_size('width')*2);
			echo "<script type='text/javascript'>
				$('#".$this->id."').turn({
					width: ".($this->get_size('width')*2).",
					height: ".$this->get_size('height')."
				});
				$('#".$this->id."').on('drag', function(){
					$(this).trigger('mouseup');
				});
			</script>";
		}
	}
?>