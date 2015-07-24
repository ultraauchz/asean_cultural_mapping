<div id="calendar">
	
	<div class="col-lg-8" >
		<h2>ปฏิทินกิจกรรม <div id='loading' style='display:none'>loading...</div></h2>
		<div id="fullcalendar" ></div>
	</div>
	
	
	<!-- Complain -->
	<?php if(permission('complains', 'view')):?> 
		<div class="col-lg-4" style='display:none;'>
			<h2>เรื่องร้องเรียน</h2>
			<table class="table table-bordered table-hover table-responsive table-striped" >
				<thead>
					<th style="width: 10px;" >ลำดับ</th>
					<th>เรื่อง</th>
					<th style="width: 100px;" >วันที่</th>
				</thead>
				
				<tbody>
					<?php
					$no = 0;
					foreach($complain as $item) { $no++;
						?>
						<tr>
							<td class='text-center'><?php echo $no; ?></td>
							<td><?php echo $item->offender; ?></td>
							<td><?php echo mysql_to_th($item->created, "S", true); ?></td>
						</tr>
						<?php
					} ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3" class="text-right" >
							<a href="admin/complains" >ดูทั้งหมด</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
	<?php endif;?>
	<!-- End : Complain -->
	<div class="clearfix" >&nbsp;</div>
	
	<div id="stat-area" class="col-lg-12" ></div>
</div>

<link href='js/fullcalendar-1.6.2/fullcalendar/fullcalendar.css' rel='stylesheet' />
<script src='js/fullcalendar-1.6.2/jquery/jquery-ui-1.10.2.custom.min.js'></script>
<script src='js/fullcalendar-1.6.2/fullcalendar/fullcalendar.js'></script>
<script type="text/javascript">
	$(document).ready(function(){

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
				
		$("#fullcalendar").fullCalendar({
			editable: false,
			header: {
				left: "prev",
				center: "title",
				right: "next"
			}
			, events: {
						 url: 'admin/get_fullcalendar',
				         data: function() { // a function that returns an object
				            return {
				                monthParam : $('#calendar').fullCalendar( 'getDate' ).getMonth(),
				                yearParam : $('#calendar').fullCalendar( 'getDate' ).getFullYear(),
				            };
				         }
			},
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
		});
        	
        $('#stat-area').html('<div align="center" style="margin-top:30px;">กำลังโหลดข้อมูลสถิติ....<br /><img src="images/ajax-loader.gif" /></div>');
        $.get('admin/inc_statistic', function(data){
            $('#stat-area').html(data);
        });
			
	})
</script>

<div class="clearfix" >&nbsp;</div>
