<div class="container cntr">
    <div class="row" style="margin-bottom:30px;">
        <div class="span3" style="max-height: 240px;">
            <?php if($value2->question_type == 1) { ?> 
            <div class="thumbnail">
				<h4 style="color:#27ae60;">ความพึงพอใจต่อเว็บไซต์?</h4>
                <?php
                if($status == 'survey') { ?>
    				<form class="form-horizontal" action="surveys/send/<?php echo $value2->id?>" method="post"  style='text-align:left; padding:10px;'>
                            <?php foreach ($value2->survey_question->get() as $num => $row):?>
                                <div ><?php echo $row->title?></div>
                                <div>
                                    <?php
                                        switch ($row->survey_question_type_id) {
                                            case 1:
                                                echo form_input("input_x".$row->id);
                                                break;
                                            case 2:
                                                echo form_textarea("textarea_".$row->id);
                                                break;
                                            case 3:
                                                foreach ($row->survey_question_choice->get() as $foo => $bar) {
                                                    echo "<div style='line-height:30px; padding-left:10px;'>".form_checkbox("checkbox_".$row->id,$bar->id)." ".$bar->title."</div>";
                                                }
                                                break;
                                            case 4:
                                                foreach ($row->survey_question_choice->get() as $foo => $bar) {
                                                    echo "<div style='line-height:30px; padding-left:10px;'>".form_radio("radio_".$row->id,$bar->id)." ".$bar->title."</div>";
                                                }
                                                break;
                                        }
                                    ?>
                                </div>
                            <?php endforeach?>

                                <!--<div style='padding:10px 0px; text-align:center;'><img src="surveys/captcha" /></div>-->
                                <div style='text-align:center;'>
                                    <!--<input type="text" class="form-control" name="captcha" maxlength="6" style="width:150px;" /> -->
                                    <button type="submit" class="btn btn-success" >ยืนยัน</button>
                                </div>
                            
                            
                    </form>
                <?php } else {
                    function cal_perc($most = 0, $cur = 0) {
                        if($most == 0 || $cur == 0) {
                            return 0;
                        } else {
                            return str_replace('.00', null, number_format(((100/$most)*$cur), 2));
                        }
                    }

                    ?><div style='padding:10px;'><?php
                    foreach($ans_list as $item) {
                        echo '<div style="font-weight:bold; font-size:12px; text-align:left;">'.$item['title'].' ('.cal_perc($ans_perc['most_val'], $item['answer_amount']).'%)</div>';
                        ?>
                        <div class="progress progress-sm progress-info" style='height:5px; margin-bottom:10px;'>
                            <div class="bar" style="font-size:10px; width:<?php echo cal_perc($ans_perc['most_val'], $item['answer_amount']); ?>%;"></div>
                        </div>
                        <?php
                    }
                    ?></div><?php
                } ?>
			</div>
            <?php } ?>
            <div style='clear:both;'></div>
        </div>
        <div class="span3" style="max-height: 240px; overflow: hidden;" >
            <div class="thumbnail">

                <h4 id="head_unstyled" >ข้อมูลนโยบาย</h4>


                <ul class="unstyled" >
                    <li>
                        <img src="images/<?php echo color()?>/policy1.jpg" style="float:left; margin:3px 0 0 5px;" class="thumbnail">
                        <h6 style="float:left; color:#0daebd; padding-left:10px;">
                        <a href="http://61.19.219.7/RRMThaiGov/httpdocs/history_61_2557.pdf"   target="_blank">นโยบายรัฐบาล นายกรัฐมนตรี</a></h6>
                    </li>

                    <li>
                        <img src="images/<?php echo color()?>/policy2.jpg" style="float:left;  margin:3px 0 0 5px;" class="thumbnail">
                        <h6 style="float:left; color:#0daebd; padding-left:10px; width:170px;">
                        <a href="http://www.thaigov.go.th/th/news-ministry/2012-08-15-09-40-18/item/85876-85876.html"   target="_blank">นโยบายรัฐมนตรีว่าการกระทรวงเกษตรและสหกรณ์</a></h6>
                    </li>

                    <li>
                        <img src="images/<?php echo color()?>/policy3.jpg" style="float:left;  margin:3px 0 0 5px;" class="thumbnail">
                        <h6 style="float:left; color:#0daebd; padding-left:10px; width:170px;">
                        <a href="http://www.moac.go.th/main.php?filename=policy_permanent"   target="_blank">นโยบายปลัดกระทรวงเกษตรและสหกรณ์</a></h6>
                    </li>
                </ul>
            </div>
        </div>

        <div class="span3" style="max-height: 240px; overflow: hidden;" >
            <div class="thumbnail">

                <h4 id="head_situation" >สถานการณ์ภัยพิบัติ</h4>
                <br>
                <div align="left" style="font-weight:bold;">
                    <ol>
                        <a href="http://tms.gistda.or.th/" target="_blank">
                            <li>ระบบติดตามสถานการณ์ภัยพิบัติ</li>
                        </a>
                        <a href="http://flood.gistda.or.th/" target="_blank">
                            <li>สถานการณ์ น้ำท่วม</li>
                        </a>
                        <a href="http://fire.gistda.or.th/" target="_blank">
                            <li>สถานการณ์ ไฟป่า</li>
                        </a>
                        <a href="http://drought.gistda.or.th/" target="_blank">
                            <li>สถานการณ์ ภัยแล้ง</li>
                        </a>
                        <a href="http://coastalradar.gistda.or.th/index.php" target="_blank">
                            <li>ข้อมูลเรดาห์ชายฝั่ง</li>
                        </a>
                        <a href="http://rice.gistda.or.th/ricefield/" target="_blank">
                            <li>ระบบติดตามสถานการณ์เพาะปลูกข้าวนาปี 57/58</li>
                        </a>
                    </ol>
                </div>
                <br>
            </div>
        </div>

        <div class="span3" style="max-height: 240px; overflow: hidden;" >
            <div class="thumbnail">
                <h4 style="color:#F60;">ข่าวผู้บริหาร</h4>
                <img src="<?php echo chk_image_path($value->image_path) ? $value->image_path : "images/no-image.jpg"?>" alt="<?php echo $value->title?>" style="width: 240px; height: 123px;" >
                <div class="listnews" style="padding-top:5px;">
                    <a href="contents/view/<?php echo $value->id?>" target="_blank" title="<?php echo $value->title?>" ><?php echo mb_substr(strip_tags($value->title),0,100,"utf-8")?>...</a>
                </div>
            </div>
        </div>


    </div>
</div>
<br>