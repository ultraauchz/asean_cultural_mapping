<div class="col-lg-12">
    <h1 class="page-header">สิทธิการใช้งาน</h1>
</div>

<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th>ชื่อ</th>
			<th style="width: 100px;" ></th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td><?php echo $value->title?></td>
			<td>
				<a href="admin/settings/permissions/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
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