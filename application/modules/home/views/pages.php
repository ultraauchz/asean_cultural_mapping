<div id="blank">
    <div id="breadcrumb"><a href="index">หน้าแรก</a> > <?php echo $value->title?></div>
    <span class="title-page-blank"><?php echo $value->title?></span>
    <br>
    <div class="clearfix" ></div>
    
    <?php if(file_exists($value->image_path)):?>
    <img src="<?php echo $value->image_path?>" class="img-responsive" style="margin: auto;" />
    <br />
    <div class="clearfix" ></div>
    <?php endif?>
    
    <?php echo detail_page($value->detail) ?>
</div>