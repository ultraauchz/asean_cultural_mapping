<div class="container">
	<div class="col-lg-12">
	    <h1 class="page-header">
	    	<? echo anchor('admin/ebooks/', 'หนังสืออิเล็กทรอนิกส์'); ?> > รายงานการเข้าใช้งาน 
	    </h1>
	</div>
	<div class="row">
		<div class="col-md-6">
			<table class='table table-striped'>
				<thead>
					<tr>
						<th colspan="3">อันดับการเข้าชม (แบ่งตามหนังสือ)</th>
					</tr>
				</thead>
				<tbody>
					<? foreach($tb1 as $item) { $no1++; ?>
						<tr>
							<td style="width:50px;	"><? echo $no1; ?></td>
							<td><? echo $item->title; ?></td>
							<td><? echo (empty($item->viewer))?0:$item->viewer; ?></td>
						</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
		
		<div class="col-md-6">
			<table class='table table-striped'>
				<thead>
					<tr>
						<th colspan="3">อันดับการเข้าชม (แบ่งตามประเภทหนังสือ)</th>
					</tr>
				</thead>
				<tbody>
					<? foreach($tb2->result() as $item) { $no2++; ?>
						<tr>
							<td style="width:50px;	"><? echo $no2; ?></td>
							<td><? echo $item->title; ?></td>
							<td><? echo (empty($item->viewer))?0:$item->viewer; ?></td>
						</tr>	
					<? } ?>
						
					<? //} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
