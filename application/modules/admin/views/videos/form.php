<div class="col-lg-12">
    <?php if($value->title):?>
    	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
    	<h1 class="page-header">วีดีโอ</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/videos/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อวีดีโอ</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อวีดีโอ" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ลิงค์ Youtube</label>
		<div class="col-lg-6" >
			<input type="text" class="form-control" name="links" placeholder="กรอกชื่อลิงค์ เช่น http://www.youtube.com/watch?v=aflSg5NyWfo" value="<?php echo $value->links?>" style="display: inline; width: 450px;" />
			<button type="button" id="gen-video" class="btn btn-primary" >ทดสอบ</button>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" ></label>
		<div class="col-lg-4" >
			<div id="youtube-preview" ></div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/videos" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	
	<?php if($value->links):?>
	function getLink() {
		var links = "<?php echo $value->links?>";

		$.post("admin/videos/get", {video:links}, function(data) {
			$("#youtube-preview").html(data);
		})
	}
	<?php endif?>

	$(document).ready(function() {

		<?php if($value->links):?>
		getLink();
		<?php endif?>
		
		$("#gen-video").click(function(){
			var video = $("input[name=links]").val();
			
			$.post("admin/videos/get",{
				video:video
			}, function(data) {
				$("#youtube-preview").html(data);
			});
			
		});
		
	});
</script>