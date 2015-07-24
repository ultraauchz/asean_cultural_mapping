<div class="col-lg-12">
    <h1 class="page-header">ติดต่อเรา</h1>
</div>

<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th>ชื่อ</th>
			<th>หัวเรื่อง</th>
			<th style="width: 160px;" >วันที่ติดต่อ</th>
			<th style="width: 160px;" ><a href="admin/contacts_us/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> แก้ไขที่อยู่</a></th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td><?php echo $value->id?></td>
			<td><?php echo $value->name_contect?></td>
			<td><?php echo $value->title?></td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE); ?></small></td>
			<td>
				<?php if(permission("contacts_us","views")):?>
				<a href="admin/contacts_us/view/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-search" ></span> ดู</a>
				<?php endif?>
				<?php if(permission("contacts_us","delete")):?>
				<a href="admin/contacts_us/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
				<?php endif?>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="5" ><?php echo $variable->pagination()?></td>
		</tr>
	</tfoot>
	
</table>
