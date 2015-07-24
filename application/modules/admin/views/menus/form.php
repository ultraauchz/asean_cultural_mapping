<div class="col-lg-12">
    <?php if($value->title):?>
    	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
    	<h1 class="page-header">เมนู</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/menus/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >เมนูย่อย</label>
		<div class="col-lg-4" >
			<?php echo form_dropdown("parent_id",get_option("id", "title", "ma_menu"),@$value->parent_id,"class=\"form-control\"","-- เลือกเมนูย่อย --",0)?>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเมนู</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเมนู" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >รูปแบบ</label>
		<div class="col-lg-4" >
			<label style="width: 250px;" ><input type="radio" name="route" value="1" <?php if($value->route==1) echo "checked"?> /> รูปแบบที่ 1 <small>ลิงค์ภายในเว็บไซต์</small></label><br />
			<label style="width: 250px;" ><input type="radio" name="route" value="2" <?php if($value->route==2) echo "checked"?> /> รูปแบบที่ 2 <small>กรอก URL เพิ่มเติม</small></label><br />
			<label style="width: 250px;" ><input type="radio" name="route" value="3" <?php if($value->route==3) echo "checked"?> /> รูปแบบที่ 3 <small>เขียนหน้าใหม่</small></label><br />
		</div>
	</div>
	
	<div id="route-1" class="form-group" <?php if($value->route!=1) echo "style=\"display: none;\""?> >
		<label for="title" class="col-sm-2 control-label" >ข้อมูลภายในเว็บไซต์</label>
		<div class="col-lg-4" >
			<select class="form-control" name="s" >
				<option value="#" >-- เลือกลิงค์ภายใน --</option>
				<option value="index" <?php if($value->links=="index") echo "selected"?> >หน้าแรก</option>
				<option value="p" <?php if($value->route_2=="p") echo "selected"?> >หน้าทั่วไป</option>
				<option value="contents" <?php if(preg_match("/contents/", $value->links)) echo "selected"?> >บทความ</option>
				<option value="sitemap" <?php if($value->links=="sitemap") echo "selected"?> >แผนผังเว็บไซต์</option>
				<option value="events" <?php if($value->links=="events") echo "selected"?> >ปฏิทินกิจกรรม</option>
				<option value="contacts_us" <?php if($value->links=="contacts_us") echo "selected"?> >ติดต่อเรา</option>
			</select>
			
			<div id="div-g" style="display: none;" >
				<br />
				<span id="g"></span>
			</div>
			
		</div>
	</div>
	
	<div id="route-2" class="form-group" <?php if($value->route!=2) echo "style=\"display: none;\""?> >
		<label for="title" class="col-sm-2 control-label" >ลิงค์</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="links" placeholder="กรอกชื่อลิงค์ ตัวอย่าง เช่น http://www.google.co.th" value="<?php echo $value->links?>" />
		</div>
	</div>
	
	<div id="route-3" class="form-group" <?php if($value->route!=3) echo "style=\"display: none;\""?> >
		<label for="title" class="col-sm-2 control-label" >รายละเอียด</label>
		<div class="col-lg-4" >
			<textarea class="form-control" name="detail" ><?php echo $value->detail?></textarea>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/menus" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		tiny("detail","<?php echo base_url()?>");
		
		$("input[name=route]").click(function(){
			var value = $(this).val();
			
			switch(value) {
				case '1':
					$("#route-1").show();
					$("#route-2").hide();
					$("#route-3").hide();
					break;
				case '2':
					$("#route-2").show();
					$("#route-1").hide();
					$("#route-3").hide();
					break;
				case '3':
					$("#route-3").show();
					$("#route-1").hide();
					$("#route-2").hide();
					break;
			}
		})
		
		<?php if($value->route==1) {
			if($value->route_2) {
				if(@preg_match("/contents/", $value->links)) {
					echo "$.post('admin/menus/g',function(data) {
						$('#g').html(data);
						$('#g select option[value=$value->route_2]').attr('selected','selected');
						$('#div-g').show();
					});\n";
				}
				
				if(@$value->route_2=="p") {
					echo "$.post('admin/menus/p',function(data) {
						$('#g').html(data);
						$('#g select option[value=".preg_replace("/p\//", "", $value->links)."]').attr('selected','selected');
						$('#div-g').show();
					});\n";
				}
				
			}
		}
		?>
		
		$("select[name=s]").change(function(){
			var value = $(this).val();
			
			switch(value) {
				case "contents":
					$.post("admin/menus/g",function(data) {
						$("#g").html(data);
						$("#div-g").fadeIn();
					})
					break;
				case "p":
					$.post("admin/menus/p",function(data) {
						$("#g").html(data);
						$("#div-g").fadeIn();
					})
					break;
				default:
					$("#div-g").fadeOut();
					$("#g").html("");
					break;
			}
		});
		
	});
</script>