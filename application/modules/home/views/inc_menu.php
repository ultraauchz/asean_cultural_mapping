<div id="cssmenu" style="margin:30px 0 0 50px;">
    <ul>
    	<?php
    		$active = 0;
			if(base_url()==currentURL()) {
				$active=1;
			}
			
    		foreach ($variable as $key => $value):
							
				switch ($value->route) {
					case 1:
						$links = $value->links;
						break;
					case 2:
						$links = $value->links;
						break;
					case 3:
						$links = "m/".$value->slug;
						break;
					default:
						$links = "javascript:void();";
						break;
				}
				$class = null;
				
				if($roots->where("parent_id",$value->id)->where("status",1)->get(1)->result_count()) {
					$class .= "has-sub";
				}
				
				//	วนหา ลิงค์ภายใน
				foreach ($roots->where("parent_id",$value->id)->where("status",1)->get() as $x => $y) {
	    			switch ($y->route) {
						case 1:
							$l = $y->links;
							break;
						case 2:
							$l = $y->links;
							break;
						case 3:
							$l = "m/".$y->slug;
							break;
						default:
							$l = "#";
							break;
					}
					
					if(base_url($l)==urldecode(currentURL()) && $active==0) {
						$class .= " active";
						$active = 1;
					}
					
				}
				
				if(base_url($links)==urldecode(currentURL()) && $active==0) {
					$class .= " active";
					$active = 1;
				}

		?>
    	<li class="<?php echo $class?>" >
    		<a href="<?php echo $links?>" title="<?php echo $value->title?>" ><?php echo $value->title?></a>
    		<?php if($roots->where("parent_id",$value->id)->where("status",1)->get(1)->result_count()):?>
    		<ul>
    			<?php foreach ($roots->where("parent_id",$value->id)->where("status",1)->order_by('orders','ASC')->get() as $num => $row):
	    			switch ($row->route) {
						case 1:
							$links = $row->links;
							break;
						case 2:
							$links = $row->links;
							break;
						case 3:
							$links = "m/".$row->slug;
							break;
						default:
							$links = "javascript:void();";
							break;
					}
				?>
    			<li><a href="<?php echo $links?>" title="<?php echo $row->title?>" ><?php echo $row->title?></a></li>
    			<?php endforeach?>
    		</ul>
    		<?php endif?>
		</li>
    	<?php endforeach?>
    </ul>
</div>