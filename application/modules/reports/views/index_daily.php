<h2>การปฏิบัติการฝนหลวงประจำวัน</h2>
<small><?php echo mysql_to_th(date("Y-m-d H:i:s"),"F",TRUE)?></small>

<hr />

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#per_day" aria-controls="per_day" role="tab" data-toggle="tab">รายวัน</a></li>
        <li role="presentation"><a href="#per_day1" aria-controls="per_day1" role="tab" data-toggle="tab">รายงานสถานการณ์ภัยแล้งและภัยพิบัติ</a></li>
        <li role="presentation"><a href="#per_day2" aria-controls="per_day2" role="tab" data-toggle="tab">รายวัน (กส.9)</a></li>
        <li role="presentation"><a href="#calendar" aria-controls="calendar" data-show="0" role="tab" data-toggle="tab">ปฏิทิน</a></li>
        
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="per_day">
        	<table class="table table-bordered table-striped" >

        		<thead>
        			<tr><th style="text-align: right;" ><a href="reports/lists/1" >ดูทั้งหมด</a></th></tr>
        		</thead>
	
				<tbody>
	        	<?php foreach ($variable as $key => $value):?>
	        		<?php if($value->result_type_id==$results["day"]["result_type_id"] && $value->deposits==$results["day"]["deposits"]):?>
					<tr>
						<td><a href="reports/views/<?php echo $value->id?>" ><?php echo $value->title?></a></td>
					</tr>
	        		<?php endif;?>
	        		<?php if($key==19) break?>
	        	<?php endforeach;?>
				</tbody>
				
			</table>
        </div>
        <div role="tabpanel" class="tab-pane" id="per_day1">
        	<table class="table table-bordered table-striped" >

        		<thead>
        			<tr><th style="text-align: right;" ><a href="reports/lists/2" >ดูทั้งหมด</a></th></tr>
        		</thead>
	
				<tbody>
	        	<?php foreach ($variable as $key => $value):?>
	        		<?php if($value->result_type_id==$results["day1"]["result_type_id"] && $value->deposits==$results["day1"]["deposits"]):?>
					<tr>
						<td><a href="reports/views/<?php echo $value->id?>" ><?php echo $value->title?></a></td>
					</tr>
	        		<?php endif;?>
	        		<?php if($key==19) break?>
	        	<?php endforeach;?>
				</tbody>

			</table>
        </div>
        <div role="tabpanel" class="tab-pane" id="per_day2">
        	<table class="table table-bordered table-striped" >

        		<thead>
        			<tr><th style="text-align: right;" ><a href="reports/lists/3" >ดูทั้งหมด</a></th></tr>
        		</thead>
	
				<tbody>
	        	<?php foreach ($variable as $key => $value):?>
	        		<?php if($value->result_type_id==$results["day2"]["result_type_id"] && $value->deposits==$results["day2"]["deposits"]):?>
					<tr>
						<td><a href="reports/views/<?php echo $value->id?>" ><?php echo $value->title?></a></td>
					</tr>
	        		<?php endif;?>
	        		<?php if($key==19) break?>
	        	<?php endforeach;?>
				</tbody>
				
			</table>
        </div>
        <div role="tabpanel" class="tab-pane" id="calendar"></div>
    </div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$("[aria-controls=calendar]").click(function(){
			var status = $(this).attr("data-show");

			if(status==0) {
				$.get("reports/get_calendar", function(data) {
					$("#calendar").html(data);
				})

				$(this).attr("data-show",1);
			}
			
		})
		
	})
</script>