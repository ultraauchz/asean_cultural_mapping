<div id="portfolioSection">
    <div class="cntr" style="margin:20px 0 30px 0;"><img src="images/<?php echo color()?>/service/title_service.png">
    </div>
    <div class="container">

        <div class="tabbable tabs">
            <div class="tab-content label-primary">
                <div class="tab-pane active" id="all">
                    <div class="row" >
                        <?php foreach ($variable as $key => $value):?>
                        <div class="span3" >
                                <a href="<?php echo $value->links?>" title="<?php echo $value->title?>" target="_blank" >
                                    <img src="<?php echo ($value->image_path) ? $value->image_path : "images/default/service/service_1.png" ?>" style="float:left;">
                                    <h5 style="float:left; color:#0daebd; padding-left:5px; padding-top:5px;"><?php echo $value->title?></h5>
                                </a>
                        </div>
                        <?php endforeach?>
                    </div>
                </div>




            </div>
        </div>
    </div>
</div>