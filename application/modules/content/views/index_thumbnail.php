<h4><a href="contents?g=<?php echo $group->id?>" title="<?php echo $group->title?>" ><?php echo $group->title?></a></h4>
<br>

<?php foreach ($variable as $key => $value):?>
<div class="col-md-8" >
	
	<?php if(@strlen(strip_tags($value->detail))<20):?>
	<a href="<?php echo $value->file_path?>" class="pull-left" title="<?php echo $value->title?>" target="_blank" style="margin-right:10px;" >
	<?php else:?>
	<a href="contents/view/<?php echo $value->id?>" class="pull-left" style="margin-right:10px;">
	<?php endif?>
		<img src="<?php echo ($value->image_path) ? $value->image_path : "images/no-image.jpg"?>" alt="<?php echo $value->title?>" class="thumbnail" style="width: 120px; height: 130px;" >
	</a>
	
	<?php if(@strlen(strip_tags($value->detail))<20):?>
	<a href="<?php echo $value->file_path?>" title="<?php echo $value->title?>" target="_blank" >
	<?php else:?>
	<a href="contents/view/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" >
	<?php endif?>
		<div class="meta" style="color:#09C; font-weight:700;"><?php echo $value->title?></div>
	</a>
	
	<div class="list-group-item-heading"><?php echo mb_substr(preg_replace("/&#?[a-z0-9]{2,8};/i","",strip_tags($value->detail)), 0, 300, "utf-8")?></div>
	<div class="date_news"> - <?php echo mysql_to_th($value->created,"S",FALSE)?></div>
	<div class="counter_news" >(อ่านแล้ว <?php echo $value->views?> ครั้ง)</div>
</div>
<div class="clearfix" ></div>
<hr class="ryo">
<?php endforeach?>

<?php echo $variable->pagination()?>

<style type="text/css" >
	.date_news {
		display: inline;
		margin-left: 5px;
	}
	.counter_news {
		display: inline;
	}
</style>