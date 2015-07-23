<script>
	$(document).ready(function(){
		$('.btn_checkout').click(function(){
			if(confirm('Send order?')){
				$('#fm_checkout').submit();
			}
		})
	})
</script>
<div id="col-page">
    <div id="breadcrumb"><a href="front/home">HOME</a> > Confirm Order</div>
	<div class="title-page">Confirm Order</div><br>
	 	Your Order no is <span class="order_no"><?php echo $orders['order_f_no'];?></span>
	 	<br><br>
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
                      	<?php echo @$orders['bill_name'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Address:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">                      	
                      	<?php echo @$orders['bill_address'];?>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	City or APO/FPO:
                      	<span class="Txt_red_8">*</span>  
                      </td>
                      <td valign="middle">
                      	<?php echo @$orders['bill_city'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	State/Province:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<?php echo @$orders['bill_state'];?>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Zip/Postal Code:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<?php echo @$orders['bill_zipcode'];?>                     
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Country:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
						<?php echo @$orders['bill_country_name'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Telephone:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<?php echo @$orders['bill_tel'];?>
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
                      	<?php echo @$orders['ship_name'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Address:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">                      	
                      	<?php echo @$orders['ship_address'];?>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	City or APO/FPO:
                      	<span class="Txt_red_8">*</span>  
                      </td>
                      <td valign="middle">
                      	<?php echo @$orders['ship_city'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	State/Province:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<?php echo @$orders['ship_state'];?>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Zip/Postal Code:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<?php echo @$orders['ship_zipcode'];?>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Country:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
						<?php echo @$orders['ship_country_name'];?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Telephone:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<?php echo @$orders['ship_tel'];?>
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
		  $cart = @$order_details;
          if(count($cart)>0){
			  foreach($cart as $item):
				  if($item['product_id']>0 && $item['order_qty'] > 0 ){
					$item_index++;
					$product = GetProductDetail($item['product_id']);
					$price = $item['order_price'];
					$total = $price * $item['order_qty'];
					$gtotal = $gtotal + $total;
					$product_id = $item['product_id'].'|';
					$product_qty = $item['order_qty'].'|';		
					$pimage = $this->db->getone('select image_name from product_image WHERE product_id='.$item['product_id'].' order by show_no desc ');
					$image_src = $pimage!='' ? 'uploads/products/images/'.$pimage : 'http://placehold.it/60x54/E4E3E1/ffffff&text=No+Image';				
		  ?>
          <tr>            
            <td><img src="<?php echo $image_src;?>" width="60" height="54" />&nbsp;<?php echo $product['name_th'];?></td>
            <td>$<?php echo number_format($item['order_price'],2);?></td>
            <td align="center" style="padding:0px;">
            	<input type="hidden" name="product_id[]" class="form-control" style="width:50px;text-align:right;" value="<?php echo $item['product_id'];?>">
            	<input type="text" name="cart_qty[]" class="form-control" style="width:50px;text-align:right;border:0px;" readonly="readonly" value="<?php echo $item['order_qty'];?>">
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
        <? if(@$orders['payment_doc']!=''){ ?>
        <table class="table">
       			<tr>
       				<td>Payment Date</td>
       				<td>Payment File*image only</td>
       			</tr>
       			<tr>
       				<td>
       					<?php echo $orders['payment_date'];?>
       				</td>
       				<td>
       					<a href="uploads/order_payments/<?php echo $orders['payment_doc'];?>" target="_blank">View Payment Image</a>       					
       				</td>
       			</tr>
       		</table>
       	<? } ?>
        <br>
            	<?php if($item_index > 0 ): ?>
            		<div align="center">
            		<span class="label label-warning" style="padding:5px 15px;font-size:20px;margin:0 auto; text-align:center; width:100%;">
            			Order Status ::: <?php echo $orders['order_status_name'];?>
            		</span>            		
            		</div>
            	<?php endif;?>
        <br>
        <?php if($orders['order_status']==1 || $orders['order_status']==2){ ?>
       		<div class="title-page">Send Confirm Payment Document</div><br>
       		<form method="post" enctype="multipart/form-data" action="front/member/send_payment_confirm/<?php echo $orders['id'];?>">
       		<table>
       			<tr>
       				<td>Payment Date</td>
       				<td>Payment File*image only</td>
       			</tr>
       			<tr>
       				<td>
       					<input type="text" class="datepicker form-control" name="payment_date" placeholder="<?php echo date("Y-m-d");?>">
       				</td>
       				<td>
       					<input type="file" name="payment_doc" class="form-control" required="required" accept="image/*">       					
       				</td>
       				<td><input type="submit" name="btn_submit" class="btn btn-primary " value="Send"></td>
       			</tr>
       		</table>
       		</form>
        <?php } ?>
</div>