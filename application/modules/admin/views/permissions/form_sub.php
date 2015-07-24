<div class="col-lg-12">
	<h1 class="page-header">สิทธิการใช้งาน</h1>
</div>

<form class="form-horizontal" role="form" action="admin/permissions/save/<?php echo $id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ประเภทผู้ใช้งาน</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" value="<?php echo $title?>" readonly />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" ></label>
		<div class="col-lg-10" >
			<table class="table table-bordered table-striped" >
				<thead>
					<th>ฟังก์ชัน</th>
					<th width="5%" >ดู</th>
					<th width="5%" >เพิ่ม</th>
					<th width="5%" >ลบ</th>
					<th width="12%" >ทั้งหมด</th>
				</thead>
				
				<tbody>
					<tr>
						<td colspan="6" class="info" >ประเภทข่าว</td>
					</tr>
					<?php foreach ($content_group as $num => $row):?>
					<tr>
						<td>- <?php echo $row->title?></td>
						<td><input type="checkbox" class="checkbox checkbox-content-<?php echo $num?>" name="content_<?php echo $row->id?>_view" value="1" <?php if(permission("content_".$row->id, "views", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-content-<?php echo $num?>" name="content_<?php echo $row->id?>_create" value="1" <?php if(permission("content_".$row->id, "create", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-content-<?php echo $num?>" name="content_<?php echo $row->id?>_delete" value="1" <?php if(permission("content_".$row->id, "delete", $id)) echo "checked"?> /></td>
						<td>
							<button type="button" class="btn btn-success checkall" data-check="true" value="content-<?php echo $num?>" ><span class="glyphicon glyphicon-check"></span></button>
							<button type="button" class="btn btn-warning checkall" data-check="false" value="content-<?php echo $num?>" ><span class="glyphicon glyphicon-unchecked"></span></button>
						</td>
					</tr>
					<?php endforeach?>
						
					<tr>
						<td colspan="6" >&nbsp;</td>
					</tr>
					<?php foreach ($module as $key => $value):?>
					<tr>
						<td><?php echo $value?></td>
						<td><input type="checkbox" class="checkbox checkbox-<?php echo $key?>" name="<?php echo $key?>_view" value="1" <?php if(permission($key, "views", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-<?php echo $key?>" name="<?php echo $key?>_create" value="1" <?php if(permission($key, "views", $id)) echo "checked"?> /></td>
						<td><input type="checkbox" class="checkbox checkbox-<?php echo $key?>" name="<?php echo $key?>_delete" value="1" <?php if(permission($key, "views", $id)) echo "checked"?> /></td>
						<td>
							<button type="button" class="btn btn-success checkall" data-check="true" value="<?php echo $key?>" ><span class="glyphicon glyphicon-check"></span></button>
							<button type="button" class="btn btn-warning checkall" data-check="false" value="<?php echo $key?>" ><span class="glyphicon glyphicon-unchecked"></span></button>
						</td>
					</tr>
					<?php endforeach?>
				</tbody>
				
			</table>
		</div>
	</div>	

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary" name="sub" value="1" ><span class="glyphicon glyphicon-ok" ></span> Submit</button>
			<a href="admin/permissions" class="btn btn-danger" > Cancel</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" >
	$(document).ready(function(){
			
		$(".checkall").click(function(){
			var value = $(this).val();
			var foo = $(this).attr("data-check");
			
			if (foo=="true") {
				$("input.checkbox-"+value).prop('checked', true);
			} else {
				$("input.checkbox-"+value).prop('checked', false);
			}
			
			return false;
		});
		
	})	
</script>