<script>
	$(document).ready(function(){
		$('.btn_checkout').click(function(){
			if(confirm('Send order?')){
				$('#fm_checkout').submit();
			}
		})
	})
</script>
<form id="fm_checkout" enctype="multipart/form-data" method="post" action="front/confirm/submit">
<div id="col-page">
    <div id="breadcrumb"><a href="front/home">HOME</a> > Confirm Order</div>
	<div class="title-page">Confirm Order</div><br>
	    <table width="100%">
	    	<td>
	    		<table class="table" style="border:1px solid #CCCCCC;">
	    			<tr>
                    <th height="31" colspan="2" valign="middle">
                    	Billing Information
                    </th>
                  </tr>  
                  <tr>
                      <td valign="middle">
                      	Full Name: 
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<?php echo @$billing['bill_name'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Address:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">                      	
                      	<?php echo @$billing['bill_address'];?>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	City or APO/FPO:
                      	<span class="Txt_red_8">*</span>  
                      </td>
                      <td valign="middle">
                      	<?php echo @$billing['bill_city'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	State/Province:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<?php echo @$billing['bill_state'];?>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Zip/Postal Code:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<?php echo @$billing['bill_zipcode'];?>                     
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Country:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
						<?php echo @$billing['bill_country_name'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Telephone:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<?php echo @$billing['bill_tel'];?>
                      </td>
                  </tr>
	    		</table>
	    	</td>
	    	<td>
	    		<table class="table" style="border:1px solid #CCCCCC;">
	    			<tr>
                    <th height="31" colspan="2" valign="middle">
                    	Shipping Information
                    </th>
                  </tr>  
                  <tr>
                      <td valign="middle">
                      	Full Name: 
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<?php echo @$shipping['ship_name'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Address:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">                      	
                      	<?php echo @$shipping['ship_address'];?>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	City or APO/FPO:
                      	<span class="Txt_red_8">*</span>  
                      </td>
                      <td valign="middle">
                      	<?php echo @$shipping['ship_city'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	State/Province:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<?php echo @$shipping['ship_state'];?>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Zip/Postal Code:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<?php echo @$shipping['ship_zipcode'];?>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Country:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
						<?php echo @$shipping['ship_country_name'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Telephone:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<?php echo @$shipping['ship_tel'];?>
                      </td>
                  </tr>
	    		</table>
	    	</td>
	    </table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb-trolley">
          <tr>            
            <th><strong>Product</strong></th>
            <th width="150"><strong>Price</strong></th>
            <th width="100"><strong>Quantity</strong></th>
            <th width="150"><strong>Total Price</strong></th>           
          </tr>
          <?php
          $item_index = 0;
		  $gtotal = 0;
		  $cart = @$_SESSION['cart'];
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
            <td><img src="<?php echo $image_src;?>" width="60" height="54" />&nbsp;<?php echo $product['name_th'];?></td>
            <td>$<?php echo number_format($product['price'],2);?></td>
            <td align="center" style="padding:0px;">
            	<input type="hidden" name="product_id[]" class="form-control" style="width:50px;text-align:right;" value="<?php echo $item['id'];?>">
            	<input type="text" name="cart_qty[]" class="form-control" style="width:50px;text-align:right;border:0px;" readonly="readonly" value="<?php echo $item['qty'];?>">
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
            <td colspan="4" style="text-align:center;padding:100px 30px;font-weight:bold;color:red;">Your trolley is Empty.</td>
          </tr>
		  <?php		  
		  }
          ?>  
          
          <tr>
            <td colspan="4" class="bottom-tb-trolley">&nbsp;</td>
          </tr>
        </table>
        <br>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right">
            	<?php if($item_index > 0 ): ?>
            	<input type="hidden" value="mode" id="mode" name="mode">
            	<a href="front/cart/index" class="btn btn-primary btn_update_cart"><i class="glyphicon glyphicon-shopping-cart"></i> Back To Trolley</a>
            	<a href="front/checkout/index" class="btn btn-primary btn_update_cart"><i class="glyphicon glyphicon-pencil"></i> Back To Change Address</a>
            	<a href="#" onclick="return false;" class="btn btn-success btn_checkout"><i class="glyphicon glyphicon-ok"></i> Send Order</a>
            	<?php endif;?>
            </td>
          </tr>
        </table>                       
</div>
</form>