<h3><?php echo $title?></h3>

<table class="table table-bordered table-striped" >
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td><a href="reports/views/<?php echo $value->id?>" ><?php echo $value->title?></a></td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr><th><?php echo $variable->pagination()?></th></tr>
	</tfoot>
	
</table>