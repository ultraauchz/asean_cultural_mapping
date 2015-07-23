<script>
	$(document).ready(function(){
		$('.btn_update_cart').click(function(){
			$('#mode').val('update');
			$('#fm_cart').submit();
		})
		$('.btn_checkout').click(function(){
			$('#mode').val('checkout');
			$('#fm_cart').submit();
		})
		$(".btn_remove").click(function(){
			if(confirm('Delete this item?')){
				$(this).closest('tr').remove();
				$('#mode').val('update');
				$('#fm_cart').submit();
			}
		})
	})
</script>
<form id="fm_cart" enctype="multipart/form-data" method="post" action="front/cart/submit">
<div id="col-page">
    <div id="breadcrumb"><a href="front/home">HOME</a> > VIEW FULL TROLLEY</div>
	<div class="title-page">View full trolley</div><br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb-trolley">
          <tr>
          	<th><strong></strong></th>            
            <th><strong>Product</strong></th>
            <th width="150"><strong>Price</strong></th>
            <th width="100"><strong>Quantity</strong></th>
            <th width="150"><strong>Total Price</strong></th>           
          </tr>
          <?php
          $item_index = 0;
		  $gtotal = 0;
          if(count($cart)>0){
			  foreach($cart as $item):
				  if($item['id']>0 && $item['qty'] > 0 ){
					$item_index++;
					$product = GetProductDetail($item['id']);
					$price = $product['price'];
					$total = $price * $item['qty'];
					$gtotal = $gtotal + $total;
					$product_id = $item['id'].'|';
					$product_qty = $item['qty'].'|';		
					$pimage = $this->db->getone('select image_name from product_image WHERE product_id='.$item['id'].' order by show_no desc ');
					$image_src = $pimage!='' ? 'uploads/products/images/'.$pimage : 'http://placehold.it/60x54/E4E3E1/ffffff&text=No+Image';				
		  ?>
          <tr>       
          	<td width="55">
          		<input type="button" name="btn_remove" id="btn_remove" class="btn btn-danger btn_remove" value="X">
          	</td>     
            <td><img src="<?php echo $image_src;?>" width="60" height="54" />&nbsp;<?php echo $product['name_th'];?></td>
            <td>$<?php echo number_format($product['price'],2);?></td>
            <td align="center" style="padding:0px;">
            	<input type="hidden" name="product_id[]" class="form-control" style="width:50px;text-align:right;" value="<?php echo $item['id'];?>">
            	<input type="text" name="cart_qty[]" class="form-control number" style="width:50px;text-align:right;" value="<?php echo $item['qty'];?>">
           	</td>
            <td>$<?php echo number_format($total,2);?></td>                   
          </tr>
          <?php 
				  }
          	endforeach;
		  ?>
		  <tr>
            <td colspan="3" style="text-align:right;padding:10px 15px;color:red;font-weight: bold;" >Grand Total</td>
            <td style="color:red;font-weight: bold;" >$<?php echo number_format($gtotal,2);?></td>
          </tr>        
		  <?php
		  }else{
		  ?>
		  <tr>
            <td colspan="5" style="text-align:center;padding:100px 30px;font-weight:bold;color:red;">Your trolley is Empty.</td>
          </tr>
		  <?php		  
		  }
          ?>  
          
          <tr>
            <td colspan="5" class="bottom-tb-trolley">&nbsp;</td>
          </tr>
        </table>
        <br>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right">
            	<?php if($item_index > 0 ): ?>
            	<input type="hidden" value="mode" id="mode" name="mode">
            	<a href="front/cart/empty_cart" onclick="return confirm('Empty TrolleyM');" class="btn btn-danger btn_empty_cart"><i class="glyphicon glyphicon-trash"></i> Empty Trolley</a>
            	<a href="#" onclick="return false;" class="btn btn-primary btn_update_cart"><i class="glyphicon glyphicon-refresh"></i> Update Cart</a>
            	<a href="#" onclick="return false;" class="btn btn-success btn_checkout"><i class="glyphicon glyphicon-ok"></i> Check Out</a>
            	<?php endif;?>
            </td>
          </tr>
        </table>                       
</div>
</form>