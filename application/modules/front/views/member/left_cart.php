<div class="title-yourcart">Your cart</div>
<span class="text1-yourcart">Now in your cart</span> <span class="text2-yourcart"><?php echo number_format(GetCartItemCount(),0);?> items</span>
<div class="list-cart">
<ul>
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
				<li><a href="front/product/detail/0/<?php echo $product['id'];?>"><?php echo $product['name_th'];?></a> <span class="cartAdd"><?php echo $item['qty'];?></span> $<?php echo number_format($total,2);?></li>
			<?php 
				  }
          	endforeach;
		  }
		  ?>
</ul>
<span>Total:</span> <span class="total-cart">$<?php echo number_format($gtotal);?></span>
<div class="view-full-trolley"><a href="front/cart/index">View full trolley</a></div>
</div>