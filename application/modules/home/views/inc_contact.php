<div id="contactSection">
    <h2 class="cntr" style="color:#F69;">ติดต่อกรม</h2>
    <div class="container">
        <div class="row" style=" margin:30px 0 0 100px;">
            <div class="span6">

                <form id="form_comment" class="form-horizontal" action="contacts_us/save" method="post" >
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="input01">ชื่อ</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="name_contect" maxlength="250" >
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="input11">อีเมล์</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="email" maxlength="250" >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input01">หัวเรื่อง</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="title" maxlength="250" >
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="textarea">รายละเอียด</label>
                            <div class="controls">
                                <textarea id="textarea" class="input-xlarge" name="detail" rows="3" style="height:65px"></textarea>
                            </div>
                        </div>
                        
                        <div class="control-group">
    						<label for="title" class="col-sm-2 control-label" >รหัสยืนยัน</label>
                            <div class="controls">
								<img src="contacts_us/captcha" style="margin: 5px 0;" />
								<br />
    							<input type="text" class="input-mini" name="captcha" maxlength="6" >
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="input11"></label>
                            <div class="controls">
                                <input type="hidden" name="index" value="1" >
                                <button type="submit" id="contact-submit" class="btn btn-success">ส่งข้อความ</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <div class="span3">
                <div>
                    <h4 style="color:#F99;">กรมฝนหลวงและการบินเกษตร </h4>
                    <p><?php echo strip_tags($value->detail);?></p>
                </div>

            </div>

        </div>
    </div>
</div>