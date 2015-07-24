<div class="col-lg-12">
	<h1 class="page-header"><?php echo $title?></h1>
</div>

<form class="form-horizontal" role="form" action="admin/settings/permissions/save/<?php echo $id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ประเภทผู้ใช้งาน</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" value="<?php echo $title?>" readonly />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ประเภทผู้ใช้งาน</label>
		<div class="col-lg-10" >
			
			

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#main_function" aria-controls="main_function" role="tab" data-toggle="tab">ฟังก์ชันเว็บไซต์หลัก</a></li>
    <li role="presentation"><a href="#main_content" aria-controls="main_content" role="tab" data-toggle="tab">ข่าวเว็บไซต์หลัก</a></li>
    <li role="presentation"><a href="#intranet" aria-controls="intranet" role="tab" data-get-list="intranet" data-has="0" data-toggle="tab">อินทราเน็ต</a></li>
    <li role="presentation" class="dropdown">
    	<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="true">เว็บไซต์หน่วยงาน <span class="caret"></span></a>
	    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
	    	<?php foreach ($web_types as $w_key => $web_type):?>
	     	   <li><a href="#web_<?php echo $web_type->id?>_function" tabindex="-1" role="tab" id="dropdown1-tab" data-get-list="<?php echo $web_type->id?>" data-has="0" data-toggle="tab" aria-controls="web_<?php echo $web_type->id?>_function"><?php echo $web_type->title?></a></li>
			<?php endforeach?>
	    </ul>
	</li>
    <li role="presentation"><a href="#request_rain" aria-controls="request_rain" role="tab" data-get-list="request_rain" data-has="0" data-toggle="tab">แบบฟอร์มขอฝน</a></li>
  </ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="main_function">
	    	<table class="table table-bordered table-striped" >
				<thead>
					<th>ฟังก์ชัน <a><small>(เว็บไซต์หลัก)</small></a></th>
					<th style="width:50px;" >ดู</th>
					<th style="width:50px;" >เพิ่ม</th>
					<th style="width:50px;" >ลบ</th>
					<th style="width:80px;" >ทั้งหมด</th>
				</thead>
				
				<tbody>
					<?php foreach ($module as $key => $value):?>
					<?php if($value->extra==1):?>
					<tr>
						<td><?php echo $value->title?><?php if($value->intranet_only==1) echo " <a><small>(เฉพาะระบบ Intranet)</small></a>"?></td>
						<td colspan="4" ><input type="checkbox" class="checkbox checkbox-<?php echo $value->module?>" name="<?php echo $value->module?>_extra" value="1" <?php if(permission($value->module, "extra", $id)) echo "checked"?> /></td>
					</tr>
					<?php else:?>
					<tr>
						<td><?php echo $value->title?><?php if($value->intranet_only==1) echo " <a><small>(เฉพาะระบบ Intranet)</small></a>"?></td>
						<td><input type="checkbox" class="checkbox checkbox-<?php echo $value->module?>" name="<?php echo $value->module?>_view" value="1" <?php if(permission($value->module, "views", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-<?php echo $value->module?>" name="<?php echo $value->module?>_create" value="1" <?php if(permission($value->module, "create", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-<?php echo $value->module?>" name="<?php echo $value->module?>_delete" value="1" <?php if(permission($value->module, "delete", $id)) echo "checked"?> /></td>
						<td>
							<button type="button" class="btn btn-success btn-xs checkall" data-check="true" value="<?php echo $value->module?>" ><span class="glyphicon glyphicon-check"></span></button>
							<button type="button" class="btn btn-warning btn-xs checkall" data-check="false" value="<?php echo $value->module?>" ><span class="glyphicon glyphicon-unchecked"></span></button>
						</td>
					</tr>
					<?php endif?>
					<?php endforeach?>
				</tbody>
				
			</table>
	    </div>
	    
	    <div role="tabpanel" class="tab-pane" id="main_content">
	    	<table class="table table-bordered table-striped" >
				<thead>
					<th>ประเภทข่าว <a><small>(เว็บไซต์หลัก)</small></a></th>
					<th style="width:50px;" >ดู</th>
					<th style="width:50px;" >เพิ่ม</th>
					<th style="width:50px;" >ลบ</th>
					<th style="width:80px;" >ทั้งหมด</th>
				</thead>
				
				<tbody>
					<?php foreach ($content_group as $num => $row):?>
					<tr>
						<td><?php echo $row->title?></td>
						<td><input type="checkbox" class="checkbox checkbox-content-<?php echo $num?>" name="content_<?php echo $row->id?>_view" value="1" <?php if(permission("content_".$row->id, "views", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-content-<?php echo $num?>" name="content_<?php echo $row->id?>_create" value="1" <?php if(permission("content_".$row->id, "create", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-content-<?php echo $num?>" name="content_<?php echo $row->id?>_delete" value="1" <?php if(permission("content_".$row->id, "delete", $id)) echo "checked"?> /></td>
						<td>
							<button type="button" class="btn btn-success btn-xs checkall" data-check="true" value="content-<?php echo $num?>" ><span class="glyphicon glyphicon-check"></span></button>
							<button type="button" class="btn btn-warning btn-xs checkall" data-check="false" value="content-<?php echo $num?>" ><span class="glyphicon glyphicon-unchecked"></span></button>
						</td>
					</tr>
					<?php endforeach?>
				</tbody>
				
			</table>
	    </div>

	    <div role="tabpanel" class="tab-pane" id="request_rain">
	    	<table class="table table-bordered table-striped" >
				<thead>
					<th>แบบฟอร์มขอฝน <a><small>(เว็บไซต์หลัก)</small></a></th>
					<th style="width:50px;" >ดู</th>
					<th style="width:50px;" >เพิ่ม</th>
					<th style="width:50px;" >ลบ</th>
					<th style="width:80px;" >ทั้งหมด</th>
				</thead>
				
				<tbody>
					
					<?php foreach ($module_request as $key => $value): ?>
					<?php if($value->extra==1):?>
					<tr>
						<td><?php echo $value->title?><?php if($value->intranet_only==1) echo " <a><small>(เฉพาะระบบ Intranet)</small></a>"?></td>
						<td colspan="4" ><input type="checkbox" class="checkbox checkbox-<?php echo $value->module?>" name="<?php echo $value->module?>_extra" value="1" <?php if(permission($value->module, "extra", $id)) echo "checked"?> /></td>
					</tr>
					<?php else:?>
					<tr>
						<td><?php echo $value->title?><?php if($value->intranet_only==1) echo " <a><small>(เฉพาะระบบ Intranet)</small></a>"?></td>
						<td><input type="checkbox" class="checkbox checkbox-<?php echo $value->module?>" name="<?php echo $value->module?>_view" value="1" <?php if(permission($value->module, "views", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-<?php echo $value->module?>" name="<?php echo $value->module?>_create" value="1" <?php if(permission($value->module, "create", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-<?php echo $value->module?>" name="<?php echo $value->module?>_delete" value="1" <?php if(permission($value->module, "delete", $id)) echo "checked"?> /></td>
						<td>
							<button type="button" class="btn btn-success btn-xs checkall" data-check="true" value="<?php echo $value->module?>" ><span class="glyphicon glyphicon-check"></span></button>
							<button type="button" class="btn btn-warning btn-xs checkall" data-check="false" value="<?php echo $value->module?>" ><span class="glyphicon glyphicon-unchecked"></span></button>
						</td>
					</tr>
					<?php endif?>
					<?php endforeach?>
				</tbody>
				
			</table>
	    </div>
	    
		<div role="tabpanel" class="tab-pane" id="intranet"></div>
	    
	    <?php foreach ($web_types as $w_key => $web_type):?>
		<div role="tabpanel" class="tab-pane" id="web_<?php echo $web_type->id?>_function"></div>
	    <?php endforeach?>
	    
	</div>

</div>
			
			
		</div>
	</div>	

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/settings/permissions" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" >
	$(document).ready(function(){
		
		$("body").on("click",".checkall",function() {
			var value = $(this).val();
			var foo = $(this).attr("data-check");
			if (foo=="true") {
				$("input.checkbox-"+value).prop('checked', true);
			} else {
				$("input.checkbox-"+value).prop('checked', false);
			}
			return false;
		})
		
		<?php if($web_intranet->id):?>
			$.get("admin/settings/permissions/get_intranet/"+<?php echo $id?>, function(data) {
				$("#intranet").html(data);
				$("[data-get-list=intranet]").attr("data-has",1);
			})
		<?php endif?>
		
		<?php
			foreach ($web_types as $w_key => $web_type):
				if(${"web_".$web_type->id}->id):
		?>
			$.get("admin/settings/permissions/get_list/"+<?php echo $id?>+"/"+<?php echo $web_type->id?>, function(data) {
				$("#web_<?php echo $web_type->id?>_function").html(data)
				$("[data-get-list=<?php echo $web_type->id?>]").attr("data-has",1)
			});
		<?php endif;
			endforeach;
		?>	
		
		$("[data-get-list]").click(function() {
			var id = <?php echo $id?>;
			var type = $(this).attr("data-get-list");
			var has = $(this).attr("data-has");

			if(has==0) {
				if(type=="intranet") {
					$("#intranet").html("<div align=\"center\" style=\"margin-top:30px;\">กำลังโหลดข้อมูล....<br /><img src=\"images/ajax-loader.gif\" /></div>");

					setTimeout(function(){
						$.get("admin/settings/permissions/get_intranet/"+id, function(data) {
							$("#intranet").html(data);
						})
					},500);
					
				} else {
					$("#web_"+type+"_function").html("<div align=\"center\" style=\"margin-top:30px;\">กำลังโหลดข้อมูล....<br /><img src=\"images/ajax-loader.gif\" /></div>");

					setTimeout(function(){
						$.get("admin/settings/permissions/get_list/"+id+"/"+type, function(data) {
							$("#web_"+type+"_function").html(data);
						})
					},500);
				}
				$(this).attr("data-has",1);
			}
		})
		
	})	
</script>