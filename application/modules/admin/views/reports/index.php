<h2>ปฏิทินกิจกรรม <div id='loading' style='display:none'>loading...</div></h2>
<div id="fullcalendar" style="width: 80%;" ></div>

<br />

<form class="form-inline" >
	<fieldset>
		<legend>ค้นหา</legend>
		
		
	    <div class="panel panel-default">
	    	
	        <div class="panel-heading" role="tab" id="headingOne">
						
				<select class="form-control" name="r" style="width: 250px;" >
					<option value="" >เลือกรูปแบบ</option>
					<option value="0" <?php if(@$_GET["r"]==='0') echo "selected"?> >รายวัน</option>
					<option value="1" <?php if(@$_GET["r"]==1) echo "selected"?> >รายสัปดาห์</option>
					<option value="2" <?php if(@$_GET["r"]==2) echo "selected"?> >รายเดือน</option>
				</select>

				<select class="form-control" name="d" style="width: 250px;" >
					<option value="" >เลือกประเภท</option>
					<option value="0" <?php if(@$_GET["d"]==='0') echo "selected"?> >สรุปผลการปฏิบัติการฝนหลวง</option>
					<option value="1" <?php if(@$_GET["d"]==1) echo "selected"?> >รายงานสถานการณ์ภัยแล้งและภัยพิบัติ</option>
					<option value="2" <?php if(@$_GET["d"]==2) echo "selected"?> >กส.9</option>
				</select>

				<button type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-search" ></span> ค้นหา</button>
	        </div>
	        
	    </div>

		
	</fieldset>
</form>

<hr />

<table class="table table-bordered table-striped" >
	<thead>
		<tr>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อ</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" >
				<a href="admin/reports/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a>
			</th>
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
			<td>
				<?php echo $value->title?>
				&nbsp;<small style="color: #428bca;" >
					<?php
						switch ($value->result_type_id) {
							case 1:
								echo "(รายสัปดาห์ ";
								break;
							case 2:
								echo "(รายเดือน ";
								break;
							default:
								echo "(รายวัน ";
								break;
						}

						switch ($value->deposits) {
							case 1:
								echo ": รายงานสถานการณ์ภัยแล้งและภัยพิบัติ)";
								break;
							case 2:
								echo ": กส.9)";
								break;
							default:
								echo ": สรุปผลการปฏิบัติการฝนหลวง)";
								break;
						}
					?>
				</small>
			</td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<a href="admin/reports/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<a href="admin/reports/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="4"><?php echo $variable->pagination()?></td>
		</tr>
	</tfoot>
	
</table>

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
						 url: 'admin/reports/get_calendar',
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
		    $.post("admin/approve/result/"+id,{status:status});
		    return false;
		    
		});
			
	})
</script>