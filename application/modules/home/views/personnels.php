<!-- Page Title -->
<h4><a href="home/personnels" title="โครงสร้างบุคลากร" >โครงสร้างบุคลากร</a></h4>

	<?php
		function child_personnel($id = 0, $department_id = null, $department_title = null)
		{
			$CI =& get_instance();
			$sql = "select *
					from personnel
					where personnel.status = '1' and personnel.department_id = '".$department_id."' and personnel.parent_id = '".$id."' order by personnel.orders asc";
			$tmp = $CI->db->query($sql)->result();
			
			if(count($tmp) != 0)
			{
				if ($id == '0') {
					echo '<div align="center" ><div style="border: 2px solid #b5d9ea;background#cde7ee">'.$department_title.'</div></div>';
				}
				
				foreach($tmp as $item)
				{
					$col = count($tmp);
					if($col > 4) $col = 3;
					$photo = (chk_image_path($item->image_path))?$item->image_path:'images/no_images.png';
					echo '<div style="display:inline-block; width:'.((100/$col)-1).'%; text-align:center;  vertical-align:top;">';
						echo '<div class="manager_box" style="text-align:center; padding:5px 5px;">';
								echo '<div align="center">';
									echo '<img src="'.$photo.'" style="width:100px;height:120px"><br />';
									echo '<label style="margin-top:10px; background:#CCC; border-radius:4px; font-size:11px; font-weight:bold; padding:10px 5px; line-heigth:30px; width:220px;">';
									echo $item->fname.' '.$item->lname;
									echo (empty($item->position))?'':'<br />'.$item->position;
									echo '</label>';	
								echo '</div>';
						echo '</div> <BR><BR>';
						child_personnel($item->id, $item->department_id);
					echo '</div>';
				}
			}
			return @$rs;		
		}


			function department_list($id=null) {
				if ($id){
					$dept = new Department($id);
					
					$list = new Department();
					$list->where('parent_id',$id);
					$list->order_by('orders', 'asc');
					$list->get();
				
					child_personnel(0, $id, $dept->title);
					foreach ($list as $key_tmp => $tmp) {
						
						department_list($tmp->id);
					}
				}	
			}
		?>
	
	<div class="col-md-8 auction" >
		<div>
			<?php 
				foreach ($variable as $key => $value) {
					department_list($value->id);
				}
				
			?>
		</div>
	</div>
	