<h2><?php echo $value->title?></h2>
<small><?php echo mysql_to_th($value->created,"F",TRUE)?></small>
<hr />

<?php echo Youtube2Iframe($value->links)?>

<?php echo $value->detail?>
    
<hr />

<?php if(file_exists($value->image_path)):?>
<div style="text-align: center;" >
<img src="<?php echo $value->image_path?>" class="img-polaroid" style="margin: auto;" />
</div>
<div class="clearfix" >&nbsp;</div>
<?php endif?>
    
<?php if(file_exists($value->file_path)):?>
<a href="contents/download/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" >
	<button type="button" class="btn btn-primary" > <span class="icon-download-alt"></span> ดาวน์โหลด</button>
</a>
<?php endif?>