<script>
	$(document).ready(function(){		
		$(".btn-cart1").click(function(){
			var product_id = $(this).closest('div').find('[name=hd_product_id]').val();
			var product_qty = 1;
			$.post('front/cart/aj_add_cart',{
					'product_id' : product_id,
					'product_qty' : product_qty
				},function(data){
				new PNotify({
			    title: 'Add to cart complete!',
			    text: 'Your select product add to cart.',
			    icon: 'glyphicon glyphicon-shopping-cart'
				})				
			})			
		})
	})	
</script>
<div id="col-page">
    	<div id="breadcrumb"><a href="front/home">HOME</a> > PRODUCTS > <?php echo $cat['name_th'];?></div>
		<div class="title-page"><?php echo $cat['name_th'];?></div>
		
		<div id="Products-cate">
    	  	<ul>
    	  		<?php
				$i=0; 
				foreach($product as $item):
					$i++; 
					$alt_class = $i == 4 ? 'class="last4" ': "";
					$pimage = $this->db->getone('select image_name from product_image WHERE product_id='.$item['id'].' order by show_no desc ');
					$image_src = $pimage!='' ? 'uploads/products/images/'.$pimage : 'http://placehold.it/172x176/E4E3E1/ffffff&text=No+Image';
					$href = "front/product/detail/".$cat['id']."/".$item['id'];
				?>
            	<li>
       	    	  <div class="box-arrival">
                    	<a href="<?php echo $href;?>"><img src="<?php echo $image_src;?>" width="172" height="130" class="img-arrival"></a>
                        <div class="textbox-arrival">
                            <div class="text-arrival">
                                <div class="text-arrival1"><?php echo $item['name_th'];?></div>
                                <div class="text-arrival2">$<?php echo number_format($item['price'],2);?></div>
                            </div>
                            <input type="hidden" name="hd_product_id" id="hd_product_id" value="<?php echo $item['id'];?>">
                            <?php if($item['qty']<1){ ?>
                            	<img src="media/images/ico_outofstock.png">
                            <? }else{ ?>
                            <a href="#"onclick="return false" class="btn-cart1">&nbsp;</a>
                            <? } ?>
                        </div>
                  </div>
                </li>
                <?php if($i == 4 ){echo '<br><div class="clear" style="line-height:15px;">&nbsp;</div>';}?>
                <?php endforeach;?>	
             </ul>
        </div>
</div>