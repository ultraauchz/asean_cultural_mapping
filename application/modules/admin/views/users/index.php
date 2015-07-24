<div class="col-lg-12">
    <h1 class="page-header">ผู้ใช้งาน</h1>
</div>

<div class="col-lg-12" style="padding: 10px 0;" >
	<form>		
		ชื่อที่ใช้ในการเข้าระบบ
		<input type="text" class="form-control" name="u" value="<?php echo @$_GET["u"]?>" style="display: inline-block; width: 100px;" />
		
		ชื่อ - นามสกุล
		<input type="text" class="form-control" name="f" value="<?php echo @$_GET["f"]?>" style="display: inline-block; width: 200px;" />
		
		กลุ่ม/ฝ่าย
		<?php echo form_dropdown("c",get_option("org_id","center_name","ma_center","WHERE center_name != '' ORDER BY center_name ASC"),@$_GET["c"],"class=\"form-control\" style=\"display:inline;width: 150px;\" ","เลือกกลุ่ม/ฝ่าย","")?>
		
		สำนัก/กอง
		<?php echo form_dropdown("h",get_option("org_id","heap_name","ma_heap","WHERE heap_name != '' ORDER BY heap_name ASC"),@$_GET["h"],"class=\"form-control\" style=\"display:inline;width: 150px;\" ","เลือกสำนัก/กอง","")?>
		
		สถานะ
		<select class="form-control" name="s" style="display: inline-block; width:80px;" >
			<option value="0" <?php if(@$_GET["s"]==0) echo "selected"?> >ปิด</option>
			<option value="1" <?php if(@$_GET["s"]==1) echo "selected"?> >เปิด</option>
		</select>
		
		<button type="submit" class="btn btn-default" >ค้นหา</button>
	</form>
</div>

<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อผู้ใช้งาน</th>
			<th>ชื่อ - นามสกุล</th>
			<th>กลุ่ม/ฝ่าย</th>
			<th>สำนัก/กอง</th>
			<th>อีเมล์</th>
			<th style="width: 160px;" ><a href="admin/settings/users/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a></th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td>
				<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
					<?php echo ($value->status==1) ? "On" : "Off" ?>
				</button>
			</td>
			<td><?php echo $value->username?></td>
			<td><?php echo $value->firstname." ".$value->lastname?></td>
			<td><?php echo $value->center->center_name?></td>
			<td><?php echo $value->heap->heap_name?></td>
			<td><small><?php echo $value->email?></small></td>
			<td>
				<a href="admin/settings/users/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<a href="admin/settings/users/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="7" ><?php echo $variable->pagination()?></td>
		</tr>
	</tfoot>
	
</table>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('button[data-loading-text]').click(function () {
		    var btn = $(this);
		    if(btn.val()==1) {
				btn.val(0);
		    	btn.removeClass("btn-primary");
		    	btn.addClass("btn-danger");
		    	var status = 0;
		    	var textstatus = "Off";
		    } else {
				btn.val(1);
		    	btn.removeClass("btn-danger");
		    	btn.addClass("btn-primary");
		    	var status = 1;
		    	var textstatus = "On";
		    }
		    btn.button('loading');
		    setTimeout(function(){
				btn.button('reset');
				btn.html(textstatus);
		    },1000);
		    
		    var id = btn.attr("id");
		    $.post("admin/approve/user/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>