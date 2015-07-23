<div id="col-page">
    	<div id="breadcrumb"><a href="front/home">HOME</a> > Order History</div>
		<div class="title-page">Order History</div>
		<br>
		<table class="table table-borderd table-hover">
			<thead>
				<th>Order No</th>
				<th>Order Date</th>
				<th>Payment Date</th>
				<th>Order Status</th>
				<th>Billing Address</th>
				<th>Shipping Address</th>
				<th>Amount</th>
				<th>View Detail</th>
			</thead>
			<tfoot>
				
			</tfoot>
			<tbody>
				<?php foreach($orders as $item): ?>
				<tr>
					<td>
						<?php echo $item['order_f_no'];?>
					</td>
					<td>
						<?php echo $item['order_date'];?>
					</td>
					<td>
						<?php echo $item['payment_date'];?>
					</td>
					<td>
						<?php echo $item['order_status_name'];?>
					</td>
					<td>
						<?php
							$flag = 'bill_';
							echo $item[$flag.'name'].'<br>'
							.$item[$flag.'address'].'<br>'
							.$item[$flag.'city'].'  '
							.$item[$flag.'state'].'<br>'
							.$item[$flag.'country_name'].' '
							.$item[$flag.'zipcode'].'<br>'
							.'Tel:'.$item[$flag.'tel']
							;
						?>
					</td>
					<td>
						<?php
							$flag = 'ship_';
							echo $item[$flag.'name'].'<br>'
							.$item[$flag.'address'].'<br>'
							.$item[$flag.'city'].'  '
							.$item[$flag.'state'].'<br>'
							.$item[$flag.'country_name'].' '
							.$item[$flag.'zipcode'].'<br>'
							.'Tel:'.$item[$flag.'tel']
							;
						?>
					</td>
					<td>
						<?php echo '$'.number_format($item['order_amount'],2);?>
					</td>
					<td>
						<a href="front/member/order_detail/<?php echo $item['id'];?>" class="btn btn-success"><i class="glyphicon glyphicon-zoom-in"></i>View</a>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<?php echo $pagination;?>
</div>