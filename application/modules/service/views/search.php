<div class="hero-unit" style="padding: 20px;margin-bottom: 0;" >
	<h3>ติดตามการขอรับบริการฝนหลวง</h3>
	<p>กรุณากรอกหมายเลขบัตรประชาชนที่ท่านระบุไว้ในฟอร์มขอรับบริการฝนหลวง</p>
  
  	<p>
  		<form action="service/search" method="get" >
  			<input type="text" class="form-control" name="v" placeholder="กรุณาระบุหมายเลขบัตรประชาชน" value="<?php echo @$_GET["v"]?>" style="margin-bottom: 0; width: 300px;" />
    		<button type="submit" class="btn btn-primary">ยืนยัน</button>
    	</form>
	</p>
</div>

<div class="clearfix" >&nbsp;</div>

<hr />

<table class="table table-bordered table-striped" >
	<thead>
		<tr>
			<th>เลขที่เรื่อง</th>
			<th>วันที่แจ้ง</th>
			<th>ชื่อ - นามสกุลผู้ร้องขอ</th>
			<th>พื้นที่ที่ต้องการให้ทำฝน</th>
			<th>สถานะ</th>
			<th style="width: 50px;" ></th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td><?php echo $value->form_number?></td>
			<td><?php echo mysql_to_th($value->request_date,"F",FALSE)?></td>
			<td><?php echo $value->title.$value->firstname." ".$value->lastname?></td>
			<td>
				<?php 
					$i=0;
                    foreach ($value->request_rain_area_province as $provinces => $province) {
                    	if($i!=0) echo ',';
                        echo $province->title.' ('.$value->request_rain_area_amphur->where('province_id',$province->province_id)->get()->result_count().' อำเภอ)';
                        $i++;
                    }
				?>
			</td>
			<td>
				<span class="label label-<?php echo $value->status->label_class_frontend;?>" ><?php echo $value->status->short_title?></span>
			</td>
			<td>
				<a href="service/view/<?php echo $value->uid?>" class="btn btn-primary" target="_blank" ><i class="icon-file" ></i></a>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<?php echo $variable->pagination()?>
		</tr>
	</tfoot>
	
</table>

<style type="text/css">
</style>