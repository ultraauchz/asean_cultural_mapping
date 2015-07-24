<div class="form-group <?php echo $uid?>">
    <label class="col-sm-2 control-label">หัวข้อคำถาม<br /><small>(radio)</small></label>
    <div class="col-lg-4">
        <div class="input-group">
            <input type="hidden" name="question_title_reference_id[]" value="<?php echo $uid?>" />
            <input type="hidden" name="question_type_<?php echo $uid?>" value="4" />
            <input type="text" class="form-control" name="question_title[]" placeholder="หัวข้อคำถาม" value="<?php echo @$rs->title; ?>" style="width: 350px;">
            <span class="input-group-btn">
	            <button type="button" class="btn btn-danger btn-delete" data-id="<?php echo $uid?>" onclick="removeGroup(this)" <? echo (@$_GET['type'] == 1)?'style="display:none;"':''; ?>>
	            	<span class="glyphicon glyphicon-trash"></span> ลบ
	            </button>
            </span>
        </div>
    </div>

	<div class="clearfix" >&nbsp;</div>
	
	<?php
	
		if(count($rs->survey_question_choice->all) == 0) {
			echo modules::run('admin/poll/add_radio_choice', $uid);
		} else {
			foreach($rs->survey_question_choice as $item) {
				echo modules::run('admin/poll/add_radio_choice', $uid, $item->id);
			}
		}
	
	?>
			
	
	<div class="clearfix last-choice <?php echo $uid?>" >&nbsp;</div>
	
	<div>
	    <label class="col-sm-3 control-label" ></label>
	    <div class="col-lg-4">
	    	<button type="button" onclick="addChoice('radio','<?php echo $uid?>')" ><span class="glyphicon glyphicon-plus" ></span> เพิ่มตัวเลือก</button>
	    </div>
    </div>
    
	<div class="clearfix" >&nbsp;</div>
	
	<hr />

</div>