<div class="col-lg-12">
    <h1 class="page-header">ประเภทผู้ใช้งาน</h1>
</div>

<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th>ชื่อ</th>
			<th style="width: 160px;" >
				<a href="admin/settings/user_types/form" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> เพิ่มประเภท</a>
			</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td><?php echo $value->title?></td>
			<td>
				<a href="admin/settings/user_types/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<a href="admin/settings/user_types/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="2" ><?php echo $variable->pagination()?></td>
		</tr>
	</tfoot>
	
</table>