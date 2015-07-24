<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">ประเภทข่าว</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/content_groups/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อประเภท</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>

	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >แสดงในหน้าแรก</label>
		<div class="col-lg-4" >
			<input type="checkbox" name="is_index" value="1" <?php echo ($value->is_index)?'checked="checked"':''; ?> />
		</div>
	</div>

	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >แสดง Thumbnail</label>
		<div class="col-lg-4" >
			<input type="checkbox" name="is_thumbnail" value="1" <?php echo ($value->is_thumbnail)?'checked="checked"':''; ?> />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> Submit</button>
			<a href="admin/content_groups" class="btn btn-danger" > Cancel</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		tiny("detail","<?php echo base_url()?>");
	});
</script>