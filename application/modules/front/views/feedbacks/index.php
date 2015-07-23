<div id="col-page">
    	<div id="breadcrumb"><a href="front/home">HOME</a> > Customer 's FeedBack(s)</div>
		<div class="title-page">Customer 's FeedBack(s)</div>
		<br>
		
	    	<? 
	    		foreach($feedbacks as $item):
				$product_image = $this->product_image->where('product_id='.$item['product_id'])->order_by('show_no','desc')->get(FALSE,TRUE); 
	    	?>
	    	<div class="alert alert-success" style="min-height: 150px;" role="alert">
				<div style="text-align:left;vertical-align:baseline;">
					<b>by:</b> <?php echo $item['create_name'];?> <b>[<?php echo $item['create_date'];?>] status [<?php echo $item['status_name'];?>]</b>
				</div>
				<div style="padding:10px 10px;">
					<div style="display:inline;width:50px;float:left;">
						<img class="main_image" src="uploads/products/images/<?=$product_image[0]['image_name'];?>" width="50" />
					</div>
					<div style="margin-left:70px;">
						<a href="front/product/detail/0/<?=$item['product_id'];?>" style="text-decoration: none;">
						Product Code::: <? echo $item['product_code'];?><br> 
						Product Name::: <? echo $item['product_name'];?>
						</a>
					</div>
				</div>
				<b>FeedBack</b><br>
				“<?php echo $item['detail'];?>”				
		    </div>
	    	<? endforeach;?>
		<?php echo $pagination;?>
		
		
</div>