<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">แบบสำรวจ</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/poll/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเรื่อง</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >เนื้อหา</label>
		<div class="col-lg-4" >
			<textarea class="form-control" name="detail" ><?php echo $value->detail?></textarea>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >กำหนดระยะเวลา</label>
		<div class="col-lg-4" >
			<?php 
				$value->period_type = (empty($value->period_type))?1:$value->period_type ;
				echo form_radio('period_type', 1, ($value->period_type == 1)?true:false, 'onclick="$(\'.period_input\').val(\'\'); $(\'.period_sector\').hide(); "').' ไม่กำหนดระยะเวลา ';
				echo form_radio('period_type', 2, ($value->period_type == 2)?true:false, 'onclick="$(\'.period_input\').val(\'\'); $(\'.period_sector\').show();"').' กำหนดระยะเวลา '; 
			?>
		</div>
	</div>

	<div class="form-group period_sector" style="<?php echo ($value->period_type == 2)?null:'display:none;'; ?>">
		<label for="title" class="col-sm-2 control-label" >วันที่เริ่มต้น</label>
		<div class="col-lg-4" >
			<input type="text" style='display:inline-block; width:90px;' id="datepicker-1" class="form-control period_input datepicker" name="start_date" placeholder="วันที่เริ่มต้น" value="<?php echo $value->start_date?>" data-date-format="yyyy-mm-dd" readonly="readonly" />
			<img src='images/icon_calendar.png' style='display:inline-block; width:25px;'>
		</div>
	</div>
	
	<div class="form-group period_sector" style="<?php echo ($value->period_type == 2)?null:'display:none;'; ?>">
		<label for="title" class="col-sm-2 control-label" >วันที่สิ้นสุด</label>
		<div class="col-lg-4" >
			<input type="text" style="display:inline-block; width:90px;" id="datepicker-2" class="form-control period_input datepicker" name="end_date" placeholder="วันที่สิ้นสุด" value="<?php echo $value->end_date?>" data-date-format="yyyy-mm-dd" readonly="readonly" />
			<img src='images/icon_calendar.png' style='display:inline-block; width:25px;'>
		</div>
	</div>

	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >รูปภาพหัวเรื่อง</label>
		<div class="col-lg-4" >
			<div class="input-group">
			    <input type="text" id="image_path" class="form-control" name="image_path" placeholder="รูปภาพหัวเรื่อง" value="<?php echo $value->image_path?>" />
			    <span class="input-group-btn">
			    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=image_path" class="btn btn-primary iframe-btn" >เลือกรูปภาพ</a>
				</span>
			</div>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >แนบไฟล์</label>
		<div class="col-lg-4" >
			<div class="input-group">
			    <input type="text" id="file_path" class="form-control" name="file_path" placeholder="เลือกไฟล์" value="<?php echo $value->file_path?>" />
			    <span class="input-group-btn">
			    	<!-- <button type="button" class="btn btn-primary" onclick="browser('file','file_path')" >เลือกไฟล์</button> -->
			    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=2&field_id=file_path" class="btn btn-primary iframe-btn" >เลือกไฟล์</a>
				</span>
			</div>
		</div>
	</div>
	
	<hr />
	
	<fieldset>
		<div class="form-group">
		<label for="title" class="col-sm-2 control-label" >ประเภทคำถาม</label>
			<div class="col-sm-4" >
				<?php  $value->question_type = (empty($value->question_type))?1:$value->question_type;  ?>
				<input type='radio' name='question_type' value='1' <? echo ($value->question_type == 1)?'checked="checked"':null; ?> 
					onclick="$('.question_sector').hide(); $('.question_sector_1').show();
					$('div.last-question').html('');
					addQuestion1();"
				> โหวต
				<input type='radio' name='question_type' value='2' <? echo ($value->question_type == 2)?'checked="checked"':null; ?> 
					onclick="$('.question_sector').hide(); $('.question_sector_2').show();
					$('div.last-question').html('');"
				> แบบฟอร์ม
			</div>
		</div>
		<!-- Question type 1 -->
		<div class='question_sector question_sector_1' <? echo ($value->question_type == 1)?null:'style="display:none;"'; ?>>
		<!--
			<div class='form-group'>
				<label for="title" class="col-sm-2 control-label" >เพิ่มตัวเลือก</label>
				<div class='col-sm-2'>
					<button type='button' class='btn btn-sm btn-primary' onclick="addQuestion1()">+ เพิ่มตัวเลือก</button>
				</div>
			</div>
		-->
		</div>
		<!-- End : Question type 1 -->

		<!-- Question type 2 -->
		<div class='question_sector question_sector_2' <? echo ($value->question_type == 2)?null:'style="display:none;"'; ?>>
			<div class="form-group">
			<label for="title" class="col-sm-2 control-label" >เพิ่มคำถาม</label>
				<div class="col-sm-2" >
					<select id="question-type" class="form-control" >
						<option value="text" >text</option>
						<option value="textarea" >textarea</option>
						<option value="checkbox" >checkbox</option>
						<option value="radio" >radio</option>
					</select>
				</div>
				<div class="col-sm-2" >
					<button type="button" id="btn-add" class="btn btn-primary" onclick="addQuestion(this)" ><span class="glyphicon glyphicon-plus" ></span> เพิ่มคำตอบ</button>
				</div>
			</div>
		</div><!-- End : question type 2 -->


		<div class="last-question">
			<?php 
				$type = array(1=>'text',2=>'textarea',3=>'checkbox',4=>'radio');
				if($value->question_type == 1) {
					foreach ($value->survey_question->where("status",1)->get() as $num => $row) {
						echo modules::run('admin/poll/add_'.$type[$row->survey_question_type_id], $row->id, '1');
					}
				} else {
					foreach ($value->survey_question->where("status",1)->get() as $num => $row) {
						echo modules::run('admin/poll/add_'.$type[$row->survey_question_type_id], $row->id);
					}
				}
				#if($value->question_type == 1) {
					
					
				#} else {
				
				#}
					
			?>
		</div>
	</fieldset>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/poll" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<link rel="stylesheet" href="js/datepicker/css/datepicker.css" />
<script type="text/javascript" src="js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">

	function removeGroup(e) {
		var btn = $(e);
		var group = btn.parents(".form-group");
				
		group.fadeOut();
		
		setTimeout(function() {
			group.remove();
		},1500)
		return false;
	}

	function addQuestion1() {
		//var question_type = $("#question-type").val();
		var area = $(".last-question");
		//var pattern = "<div class='form-group' ><label class='col-sm-2 control-label' ></label><div class='col-lg-4' ><div class='input-group' ><input type='text' class='form-control' name='question[]' style='width: 350px;' /><span class='input-group-btn'><button type='button' class='btn btn-danger btn-delete' onclick='removeGroup(this)' ><span class='glyphicon glyphicon-trash' > ลบ</span></button></span></div></div></div>";
		
		$.get("admin/poll/add_radio", {
			type : 1
		},function(data) {
			//$(data).append(area);
			area.append(data);
		})
	}
	
	function addQuestion(e) {
		var question_type = $("#question-type").val();
		var area = $(".last-question");
		var pattern = "<div class='form-group' ><label class='col-sm-2 control-label' ></label><div class='col-lg-4' ><div class='input-group' ><input type='text' class='form-control' name='question[]' style='width: 350px;' /><span class='input-group-btn'><button type='button' class='btn btn-danger btn-delete' onclick='removeGroup(this)' ><span class='glyphicon glyphicon-trash' > ลบ</span></button></span></div></div></div>";
		
		$.get("admin/poll/add_"+question_type, function(data) {
			//$(data).append(area);
			area.append(data);
		})
	}
	
	function addChoice(type,id) {
		var area = $(".last-choice."+id);
		
		$.get("admin/poll/add_"+type+"_choice/"+id, function(data) {
			$(data).insertBefore(area);
		})
	}
	
	function removeChoice(e,type) {
		var btn = $(e);
		var group = btn.parents("."+type+"-choice");
		
		group.fadeOut()
		
		setTimeout(function() {
			group.remove();
		},1500)
		return false;
	}
	
	tiny("detail","<?php echo base_url()?>");
    
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	
	var checkin = $('#datepicker-1').datepicker({
	    onRender: function(date) {
	        //	return date.valueOf() < now.valueOf() ? 'disabled' : '';
	    }
	}).on('changeDate', function(ev) {
	    if (ev.date.valueOf() > checkout.date.valueOf()) {
	        var newDate = new Date(ev.date)
	        newDate.setDate(newDate.getDate() + 1);
	        checkout.setValue(newDate);
	    }
	    checkin.hide();
	    $('#datepicker-2')[0].focus();
	}).data('datepicker');
	var checkout = $('#datepicker-2').datepicker({
	    onRender: function(date) {
	        return date.valueOf() < checkin.date.valueOf() ? 'disabled' : '';
	    }
	}).on('changeDate', function(ev) {
	    checkout.hide();
	}).data('datepicker');
		
</script>