<div id="breadcrumb"><a href="home/index">Home</a> > <?php echo $value->title;?></div>
<div id="title-page"><?php echo $value->title?></div>
<small style="display: block;" ><?php echo $value->created?> ( Read <?php echo $value->views?> )</small>
</div>
<?php if($value->image_path):?>
<div style="text-align: center;" >
<img src="<?php echo $value->image_path?>" class="img-polaroid" style="margin: auto;" />
</div>
<div class="clearfix" >&nbsp;</div>
<?php endif?>

<div style="margin:0 auto;width:1100px;padding:20px;">
<?php echo $value->detail?>
</div>
    
<hr />
    
<?php if($value->file_path):?>
<a href="contents/download/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" >
	<button type="button" class="btn btn-primary" > <span class="icon-download-alt"></span> ดาวน์โหลด</button>
</a>
<?php endif?>