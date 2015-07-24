<div class="col-lg-12">
    <h1 class="page-header">รายการอัพเดท</h1>
</div>

<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th>ชื่อ</th>
			<th style="width: 160px;" ><a href="admin/updates/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a></th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td>
				<a href="#" data-toggle="modal" data-target="#myModal<?php echo $key?>" ><?php echo mysql_to_th($value->update_date,"F")?></a>
			</td>
			<td>
				<a href="admin/updates/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<a href="admin/events/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
</table>

<?php foreach ($variable as $key => $value):?>
<div id="myModal<?php echo $key?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="padding: 15px;" >
			<h1><?php echo mysql_to_th($value->update_date,"F")?></h1
			<?php echo $value->detail?></div>
	</div>
</div>
<?php endforeach?>

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
		    $.post("admin/approve/event/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>