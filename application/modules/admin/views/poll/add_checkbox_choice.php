<div class="checkbox-choice" style="padding-top: 10px;" >
	<label class="col-sm-3 control-label" ></label>
	<div class="col-lg-4">
	    <div class="input-group">
	    	<input type='hidden' name="qchoice_<?php echo $uid; ?>[]" value="<?php echo $uid2; ?>">
	        <input type="text" class="form-control" name="question_<?php echo $uid?>[]" placeholder="ตัวเลือกที่ 1" value="<?php echo $rs->title; ?>" style="width: 350px;">
	        <span class="input-group-btn">
	            <button type="button" class="btn btn-delete" onclick="removeChoice(this,'checkbox')" >
	            	<span class="glyphicon glyphicon-trash"></span>
	            </button>
	        </span>
	    </div>
	</div>
	
	<div class="clearfix" >&nbsp;</div>
</div>