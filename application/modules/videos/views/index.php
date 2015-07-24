<h4><a href="videos" title="วีดีโอ" >วีดีโอ</a></h4>
<br />

<?php foreach ($variable as $key => $value):?>
<div class="col-md-8" >
	<a class="pull-left" href="#" style="margin-right: 10px;" >
		<?php echo YoutubeIframe2Thumb($value->links,160,100,"class=\"thumbnail\"")?>
	</a>
	
	<a href="videos/view/<?php echo $value->id?>" title="<?php echo $value->title?>" >
		<div class="meta" style="color:#09C; font-weight:700;"><?php echo $value->title?></div>
	</a>
	
	<div class="list-group-item-heading"><?php echo mb_substr(strip_tags($value->detail), 0, 300, "utf-8")?></div>
	<div class="date_news"><?php echo mysql_to_th($value->created,"F",TRUE)?></div>
</div>
<hr class="ryo" >
<?php endforeach?>

<?php echo $variable->pagination()?>

<style type="text/css">
.ryo {
	clear: both;;
}
</style>