<style>
	#banner .carousel-control{
		background:none !important;
		border: none !important;
	}
</style>

<div id="banner" class="hidden-phone" >
    <div class="container">
        <h2 class="cntr" style="padding-top:30px; color:#FFF;">ลิงค์แบนเนอร์</h2>
        <h4 class="cntr" style=" padding-bottom:30px; color:#FFF;"><a href="links">ลิงค์เว็บไซต์ต่างๆที่เกี่ยวข้อง</a></h4>
        <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-1 banner">
                
                <div class="cntr">
				    <div id="mainCarousel" class="carousel slide">
				        <div class="carousel-inner">
				        	
				        	<div class="item active row">
							  	<?php foreach($value as $key => $item):?>
							  		<?php echo (($key%4)==0 && ($key != 0))? '</div><div class="item row">' : '' ;?>
							  		<a href="<?php echo $item->url?>" class="span3" target="<?php echo $item->action?>" title="<?php echo ($item->detail) ? $item->detail : "กรมฝนหลวงและการบินเกษตร"?>">
								      	<img class="img-responsive" src="<?php echo $item->image?>" alt="<?php echo ($item->detail) ? $item->detail : "กรมฝนหลวงและการบินเกษตร"?>" style="margin:0 30px;">
									</a>
							  	<?php endforeach;?>
							</div>

				        </div>
				        <a class="left carousel-control" href="#mainCarousel" data-slide="prev" style="margin: -17px 0 0 -20px;">&lsaquo;</a>
				        <a class="right carousel-control" href="#mainCarousel" data-slide="next" style="margin: -17px -20px 0 0;">&rsaquo;</a>
				    </div>
				</div>
                
                
            </div>
        </div>


    </div>
</div>