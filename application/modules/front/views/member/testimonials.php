<div id="col-page">
    	<div id="breadcrumb"><a href="front/home">HOME</a> > Customer 's FeedBack(s)</div>
		<div class="title-page">Customer 's FeedBack(s)</div>
		<br>
		<? if(count($testimonials)<1){ ?>
	    <? }else{ ?>
	    	<? 
	    		foreach($testimonials as $item):
				$product_image = $this->product_image->where('product_id='.$item['product_id'])->order_by('show_no','desc')->get(FALSE,TRUE); 
	    	?>
	    	<div class="alert alert-success" style="min-height: 150px;" role="alert">
	    		<div style="text-align:right;margin-top:-25px;margin-right:-5px;">					
					<a href="front/member/testimonials_delete/<?=$item['id'];?>" class="btn btn-xs btn-danger btn_delete">X</a>
				</div>
				<div style="text-align:left;vertical-align:baseline;">
					<b>by:</b> <?php echo login_data('name');?> <b>[<?php echo $item['create_date'];?>] status [<?php echo $item['status_name'];?>]</b>
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
	    <? } ?>
		<?php echo $pagination;?>
		
		<fieldset>
			<legend>Write Customer 's FeedBack to us</legend>
			<form name="testimonial" enctype="multipart/form-data" method="post" action="front/member/testimonials_save">
			<div class="form-group">
				<label for="order_detail_id">Select Order Product For Feedback</label>
				<?php 
				$sql = "
				SELECT
					order_details.id,
					product_id,
					product.name_th,
					CONCAT(product.name_th , ':::ORDER#' , orders.order_f_no) description
				FROM
					order_details
					left join product on order_details.product_id = product.id
					left join orders on order_details.order_id = orders.id
				WHERE
					order_details.id not in (SELECT order_detail_id FROM testimonials)
					AND orders.order_status = 5
					AND orders.user_id = ".login_data('id');				
				echo form_dropdown('order_detail_id',get_option('id','description','('.$sql.')AB'),'','id="order_detail_id" class="form-control" required="required" data-error="Select Ordered Product For Feedback" ','--Select Ordered Product--','');
				?>
				 <div class="help-block with-errors"></div>
			</div>
			<div class="form-group product_detail">
			</div>
			<div class="form-group">
			  <label>Detail:</label>
		      <textarea name="detail" class="form-control" style="width:1000px;height:80px;background:#fcffe2;"></textarea>		      
		    </div>
		    <br>
		    <div class="input-group">
		    	<input type="submit" name="submit" value="Send" class="btn btn-primary">
		    </div>
		    </form>
		</fieldset>
</div>
<script>
	$(document).ready(function(){
		$("[name=testimonial]").validator();
		$("[name=order_detail_id]").change(function(){
			var order_detail_id = $(this).val();
			$.post('front/member/aj_ordered_product',{
					'order_detail_id' : order_detail_id,
				},function(data){
				$('.product_detail').html(data);					
			})
			
		});
	});
</script>