<div class="col-lg-12">
	<h1 class="page-header">โปรแกรมระบบงาน</h1>
</div>

<form class="form-horizontal" role="form" action="admin/centre/manage/save_program/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >เมนูย่อย</label>
		<div class="col-lg-4" >
			<?php echo @form_dropdown('parent',get_option('id','title','ma_centre_program','WHERE parent = 0 ORDER BY orders ASC'),@$value->parent,'class="form-control"','-- เลือกเมนูย่อย --',0);?>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเรื่อง</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >รูปแบบลิงค์</label>
		<div class="col-lg-4" >
			<label style="width: 250px;" ><input type="radio" name="link_type" value="1" <?php if($value->link_type==1 || $value->id==false) echo "checked"?> /> หัวข้อ</label><br />
			<label style="width: 250px;" ><input type="radio" name="link_type" value="2" <?php if($value->link_type==2) echo "checked"?> /> ลิงค์</label><br />
		</div>
	</div>

	<div class="form-group" id="div-links" <?php if($value->link_type!=2 || empty($value->id)) echo 'style="display: none;"'?> >
		<label for="title" class="col-sm-2 control-label" >ลิงค์</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="links" placeholder="กรอกลิงค์" value="<?php echo $value->links?>" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยีนยัน</button>
			<a href="admin/centre/manage" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript">
	$(document).ready(function(){

		$('[name=link_type]').click(function(){
			var btn = $(this);
			var value = btn.val();
			var div = $('#div-links');

			if(value=='2') {
				div.show();
			} else {
				div.hide();
			}
		})

	})
</script>