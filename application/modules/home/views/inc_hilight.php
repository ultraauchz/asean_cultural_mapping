<div id="carouselSection" class="cntr">
    <div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators hide">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php foreach ($variable as $key => $value):
                $links = "javascript:void()";
                if($value->links && $value->links!="#") {
                    $links = $value->links;
                }
            ?>
            <div class="item<?php if($key==0) echo " active"?>" >
                <a class="cntr" href="<?php echo $links?>" ><img src="<?php echo $value->image_path?>" alt="<?php echo($value->title) ? $value->title : "กรมฝนหลวงและการบินเกษตร"?>" style="width:1100px;height:244px;"></a>
            </div>
            <?php endforeach?>
        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
</div>