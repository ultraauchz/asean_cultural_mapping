<div class="col-lg-12">
    <h1 class="page-header">ศูนย์ปฏิบัติการกรมฝนหลวงและการบินเกษตร</h1>
</div>

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#manage" aria-controls="manage" role="tab" data-toggle="tab" >หน้าหลัก</a></li>
        <li role="presentation"><a href="#program" aria-controls="program" role="tab" data-toggle="tab" data-get-list="1" >โปรแกรมระบบงาน</a></li>
        <li role="presentation"><a href="#manual" aria-controls="manual" role="tab" data-toggle="tab" data-get-list="1" >คู่มือการใช้งาน</a></li>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="manage">
        	
        	<form action="admin/centre/manage/edit" method="post" >
	
			<div class="form-group" >
				<label for="title" class="col-sm-2 control-label" >เนื้อหา</label>
				<div class="col-lg-4" >
					<textarea class="form-control" name="detail" ><?php echo $value->detail?></textarea>
				</div>
			</div>
			
			<div class="clearfix" ></div>
			<br />

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
				</div>
			</div>
			
			</form>
	
        </div>
        <div role="tabpanel" class="tab-pane" id="program"></div>
        <div role="tabpanel" class="tab-pane" id="manual"></div>
    </div>

</div>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript" >
	
	$(document).ready(function() {
		
		tiny("detail","<?php echo base_url()?>");
		
		$("[data-get-list]").click(function() {
			var type = $(this).attr("aria-controls");
			var loading_text = "<div align=\"center\" style=\"margin-top:30px;\">กำลังโหลดข้อมูล....<br /><img src=\"images/ajax-loader.gif\" /></div>";
			
			$("#"+type).html(loading_text);
			
			setTimeout(function() {
				$.get("admin/centre/manage/list_"+type, function(data) {
					$("#"+type).html(data);
				})
			}, 500);
		})
		
	})
	
</script>