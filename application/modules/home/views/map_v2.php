<script type="text/javascript" src="js/maphilight/jquery.maphilight.js"></script>

<table class="table table-bordered table-responsive table-striped">
	<thead>
		<th>
			<td>
				<div style="width:620px; height:1126px; z-index:2; top:0; left:0;">
					
					<img id="map2" class="map-hilight" src="js/maphilight/thailand.png" alt="" width="620" height="1126" border="0" usemap="#Map2" />
					
					<map name="Map2">
						<?php foreach ($variable as $key => $value):?>
						<area shape="poly" coords="<?php echo $value->coords?>" href="#" alt="<?php echo $value->title?>" title="<?php echo $value->title?>" data-maphilight='{"strokeColor":"0000ff","strokeWidth":2,"fillColor":"ff0000","fillOpacity":0.3}'  target="_blank" />
						<?php endforeach?>
					</map>
				</div>
			</td>
			<td>
				<table class="table table-bordered table-hover table-striped" >
					<?php foreach ($variable as $key => $value):?>
					<tr>
						<td><?php echo $value->title?></td>
					</tr>
					<?php endforeach?>
				</table>
			</td>
		</th>
	</thead>
</table>


<script type="text/javascript">
	$(document).ready(function(){
		
		$(".map-hilight").maphilight();
		
	})
</script>