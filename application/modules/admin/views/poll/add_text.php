<div class="form-group <?php echo $uid?>">
    <label class="col-sm-2 control-label">หัวข้อคำถาม<br /><small>(text)</small></label>
    <div class="col-lg-4">
        <div class="input-group">
            <input type="hidden" name="question_title_reference_id[]" value="<?php echo $uid?>" />
            <input type="hidden" name="question_type_<?php echo $uid?>" value="1" />
            <input type="text" class="form-control" name="question_title[]" placeholder="หัวข้อคำถาม" value="<?php echo @$rs->title;?>" style="width: 350px;">
            <span class="input-group-btn">
	            <button type="button" class="btn btn-danger btn-delete" data-id="<?php echo $uid?>" onclick="removeGroup(this)" >
	            	<span class="glyphicon glyphicon-trash"></span> ลบ
	            </button>
            </span>
        </div>
    </div>

	<div class="clearfix" >&nbsp;</div>
	
	<hr />

</div>