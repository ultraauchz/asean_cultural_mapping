<h4><a href="surveys" title="แบบสำรวจความคิดเห็น " >แบบสำรวจความคิดเห็น </a></h4>
<br>

<?php if($this->session->flashdata("error")==1):?>
<div class="alert alert-danger text-center" role="alert">
	<strong>ผิดพลาด กรุณาตรวจสอบข้อมูล</strong>
	<br />

	<?php echo $this->session->flashdata("msg")?>
</div>
<?php endif?>

<?php foreach ($variable as $key => $value):?>
<div class="col-md-8" >
	<a href="surveys/view/<?php echo $value->slug?>" class="pull-left" style="margin-right:10px;">
		<img src="<?php echo chk_image_path($value->image_path) ? $value->image_path : "images/no-image.jpg"?>" width="120" height="0" alt="<?php echo $value->title?>" class="thumbnail">
	</a>
	
	<a href="surveys/view/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" >
		<div class="meta" style="color:#09C; font-weight:700;"><?php echo $value->title?></div>
	</a>
	
	<div class="list-group-item-heading"><?php echo mb_substr(strip_tags($value->detail), 0, 300, "utf-8")?></div>
	<div class="date_news"><?php echo mysql_to_th($value->created,"F",TRUE)?></div>
</div>
<hr class="ryo">
<?php endforeach?>

<?php echo $variable->pagination()?>