<div id="footerSection">
    <div class="container">
        <div class="socialMedia">
            <a class="facebook" href="<?php echo $value->facebook?>" title="facebook" target="_blank" ></a>
            <a class="twitter" href="<?php echo $value->twitter?>" title="twitter" target="_blank" ></a>
        </div>
        <div id="footerMenu">
        	<?php echo Modules::run("analytics/inc_home")?> <span style="color:lawngreen; font-weight:bold;">กำลังออนไลน์อยู่ที่หน้านี้ <?php echo online_users()?> คน</span>
        </div>
        <p><small>สงวนลิขสิทธิ์ กรมฝนหลวงและการบินเกษตร www.royalrain.go.th พ.ศ.2557</small>
        </p>
    </div>
</div>
<a href="#" class="go-top" style="display: none;"><i class="icon-double-angle-up"></i></a>