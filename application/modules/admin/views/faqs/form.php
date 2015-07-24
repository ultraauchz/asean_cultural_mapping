<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">FAQ</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/faqs/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ประเภทคำถาม</label>
		<div class="col-lg-4" >
			<?php echo form_dropdown("faq_group_id",get_option("id", "title", "ma_faq_group"),($value->faq_group_id) ? $value->faq_group_id : @$_GET["g"],"class=\"form-control\"")?>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >คำถาม</label>
		<div class="col-lg-6" >
			<input type="text" class="form-control" name="question" placeholder="กรอกคำถาม" value="<?php echo $value->question?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >คำตอบ</label>
		<div class="col-lg-6" >
			<textarea class="form-control" rows="4" name="answer" placeholder="กรอกคำตอบ"><?=$value->answer?></textarea>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/faqs?g=<?php echo ($value->faq_group_id) ? $value->faq_group_id : @$_GET["g"]?>" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>