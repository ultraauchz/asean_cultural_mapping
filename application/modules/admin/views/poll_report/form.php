<style type='text/css'>
	.form-group div {
		line-height:32px;
	}
</style>
<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">แบบสำรวจ</h1>
    <?php endif?>
</div>

<div class="form-horizontal" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเรื่อง</label>
		<div class="col-lg-4"><?php echo $value->title?></div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >เนื้อหา</label>
		<div class="col-lg-8" ><?php echo $value->detail?></div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >รูปภาพหัวเรื่อง</label>
		<div class="col-lg-4" ></div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >แนบไฟล์</label>
		<div class="col-lg-4" ></div>
	</div>
	
	<hr />
	
	<fieldset>		
		<?php 
			$type = array(1=>'text',2=>'textarea',3=>'checkbox',4=>'radio');
			foreach ($value->survey_question->where("status",1)->get() as $num => $row):
				if($row->survey_question_type_id == 1 
				|| $row->survey_question_type_id == 2
				|| $row->survey_question_type_id == 4
				|| $row->survey_question_type_id == 3) {
					echo modules::run('admin/poll_report/add_question', $type[$row->survey_question_type_id], $row->id, $answer->id);
				} else {
					echo modules::run('admin/poll/add_'.$type[$row->survey_question_type_id], $row->id);
				}
				
			endforeach
		?>
		
		<div class="hidden last-question" ></div>
		
	</fieldset>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<a href="admin/poll_report/index/<? echo $survey_id;?>" class="btn btn-danger" > ย้อนกลับ</a>
		</div>
	</div>
	
</div>