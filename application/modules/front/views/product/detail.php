<div id="col-page">
    	<div id="breadcrumb"><a href="front/home">HOME</a> > PRODUCTS > <?php echo @$cat['name_th'];?></div>
		<div class="title-page"><?php echo @$cat['name_th'];?></div>
		
		<div id="productdetail">
             
           <div id="productshow">
					<img class="main_image" src="uploads/products/images/<?=$product_image[0]['image_name'];?>" width="300" height="249" />
                    <div id="movers-row">
                    	<? foreach($product_image as $pitem): ?>
                        	<div>
                        		<a href="#" onclick="return false;" class="cross-link active-thumb product_thumb">
                        			<img src="uploads/products/images/<?=$pitem['image_name'];?>" width="85" height="70" class="nav-thumb" border="0" />
                        		</a>
                        	</div>
                        <? endforeach;?>
			  		</div>
           </div>
              
                <div id="detail">
					<div class="nameproduct"><?php echo $product['name_th'];?></div>

                    <div class="prize2">Price: <span class="bigsale">$<?php echo number_format($product['price'],2);?></span></div>
					<div style="float:left;">Shipping & Handling: $<?php echo number_format($product['shipping_price'],2);?></div><br><br>
					<? /*if(count($product_option)>0): ?>
                    <div id="ProductSizeList">
                    <strong>Select Option:</strong>
                    		<select name="product_option" style="color:#E36666;">
                    			<?php foreach($product_option as $p_option): ?>
								<option value="<?php echo $p_option['option_name'];?>"><?php echo $p_option['option_name'];?></option>
								<?php endforeach;?>
                    		</select>
                    </div>
                    <? endif;*/?>
                  <br>
					<div style="float:left;">Quantity</div>
					<?php if($product['qty']<1){ ?>
                            	<img src="media/images/ico_outofstock.png">
                    <? }else{ ?>
					<input type="text" name="cartAdd" id="cartAdd" class="number" style="float:left;" value="1"> 	
					<input type="hidden" name="product_id" value="<?php echo $product['id'];?>">				
					<a href="#" onclick="return false;"  class="btn-cart2">Add to cart</a>
					<? } ?>
                    <div class="clear">&nbsp;</div>
                   
                  <br>
           </div>          
          <div class="clear">&nbsp;</div>
            <div id="detailproducts_more">
            	<div class="title_detailproducts_more">Description</div>
                <?php echo $product['full_detail_en'];?>
            </div>
      </div>
</div>
<script>
	$(document).ready(function(){
		$('.product_thumb').click(function(){
			var img_src = $(this).closest('div').find('img').attr('src');
			$('.main_image').attr('src',img_src);
		})				
	})
</script>