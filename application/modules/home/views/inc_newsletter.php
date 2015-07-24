<div class="container cntr">

    <div class="btn_menu tabbable" style=" margin-left:250px;">
        <ul>
        	<?php foreach ($variable as $key => $value):?>
            <li class="col-lg-2<?php if($key==0) echo " active"?>"><a href="#content-<?php echo $value->id?>" data-toggle="tab"><?php echo $value->title?></a></li>
        	<?php endforeach?>
        </ul>
    </div>

    <div class="clearfix"></div>

    <div class="tab-content no-space">

		<?php foreach ($variable as $key => $value):?>
        <div class="tab-pane<?php if($key==0) echo " active"?>" id="content-<?php echo $value->id?>">
            <div class="linha">
            	
            	<?php foreach ($value->content->where("status",1)->order_by("orders","ASC")->order_by("id","DESC")->get(2,($value->id==2) ? 1 : null) as $num => $row):?>
                <div class="tile1 vermelho col-lg-3">
                    <div id="img" class="thumbnail"><img src="<?php echo chk_image_path($row->image_path) ? $row->image_path : "images/no-image.jpg"?>" alt="<?php echo $row->title?>" style="width: 234px; height: 128px;" ></div>
                    <div class="textdetail">
                    	<a href="contents/view/<?php echo $row->id?>" target="_blank" title="<?php echo $row->title?>" ><?php echo mb_substr(strip_tags($row->title),0,120,"utf-8")?></a>
                    	<span style="  color: #ff9000; display:block; font-weight: bold;"> - <?php echo mysql_to_th($row->created,"S",FALSE)?></span>
                    </div>
                    <div></div>
                </div>
                <?php endforeach?>

                <div class="tile2 vermelho col-lg-6 listnews">
                    <ul>
            			<?php foreach ($value->content->where("status",1)->order_by("orders","ASC")->order_by("id","DESC")->get(5,($value->id==2) ? 3 : 2) as $num => $row):?>
                        <li><a href="contents/view/<?php echo $row->id?>" target="_blank" title="<?php echo $row->title?>" ><?php echo mb_substr(strip_tags($row->title),0,120,'utf-8')?></a><span style="font-size: 11px; color: #ff9000; font-weight: bold;"> - <?php echo mysql_to_th($row->created,"S",FALSE)?></span></li>
                		<?php endforeach?>
                    </ul>
                    <span style="float:right; margin-right:20px;">
                    	<a href="contents?g=<?php echo $value->id?>" title="ดู<?php echo $value->title?>เพิ่มเติม" ><img src="images/<?php echo color()?>/btn_more.png"></a>
                    </span>
                </div>

            </div>
        </div>
        <?php endforeach?>


    </div>
</div>