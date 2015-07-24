<table class="table table-bordered table-hover table-striped" >
	
	<thead>
		<tr>
			<th>ชื่อเรื่อง</th>
			<th style="width: 100px;" >จำนวนคนดู</th>
			<th style="width: 220px;" >วันที่</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($variable as $key => $value):
			$searchword = "/".$_GET["q"]."/i";
			$replace = "<strong>$0</strong>";
			
			$title = strip_tags($value->title);
			$title = preg_replace($searchword, $replace, $title);
			
			$detail = strip_tags($value->detail);
			$detail = preg_replace($searchword, $replace, $detail);
		?>	
		<tr>
			<td>
				<a href="contents/view/<?php echo $value->slug?>" title="<?php echo strip_tags($value->title)?>" target="_blank" >
					<?php echo $title?>
				</a>
				<br />
				<small><?php echo mb_substr($detail, 0, 280,"utf-8")?></small>
			</td>
			<td><?php echo @number_format($value->views,0)?></td>
			<td><?php echo mysql_to_th($value->created,"F",true)?></td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="3" ><?php echo $variable->pagination()?></td>
		</tr>
	</tfoot>

</table>