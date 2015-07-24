<div class="inner">
	<div style=" text-align:right;">หน้าหลัก  > ปฏิทินกิจกรรม</div>
	<h3><a href="#" rel="bookmark" title="Permanent Link to Cras in odio nisi"><?php echo $variable->title; ?></a></h3><br>
	<?php $thai_day_arr=array("Sunday"=>"อาทิตย์", "Monday"=>"จันทร์", "Tuesday"=>"อังคาร", "Wednesday"=>"พุธ", "Thursday"=>"พฤหัสบดี", "Friday"=>"ศุกร์", "Saturday"=>"เสาร์");  ?>
	<p class="meta" style="color:#09C; font-weight:700;">
		<?php echo 'วันที่ '.mysql_to_th($variable->start_date).' ถึง '.mysql_to_th($variable->end_date).' ' ?>
		<?php echo (empty($variable->everyday))?'':' ( ทุกวัน'.$thai_day_arr[$variable->everyday].' )'; ?>
	</p><br>
		<?php echo (file_exists($variable->image_path))?'':'<div align="center" ><img src="'.$variable->image_path.'" class="thumbnail"></div><br><br>'; ?>
	<p><?php echo $variable->detail; ?></p>
    
	<hr />
	    
	<?php if($value->file_path):?>
	<a href="contents/download/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" >
		<button type="button" class="btn btn-primary" > <span class="icon-download-alt"></span> ดาวน์โหลด</button>
	</a>
	<?php endif?>
</div>