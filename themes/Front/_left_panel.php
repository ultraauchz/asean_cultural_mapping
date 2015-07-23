<script>
	$(document).ready(function(){
		$("#btn_newsletter").click(function(){
			  var email = $("#news_email").val();
			  if ( !(/[0-9a-zA-Z_\.\-]+@[0-9a-zA-Z_\.\-]+.[a-zA-Z]+/ig).test(email) )
				{
					alert("Please type your email."+"\n");
				}else{
					$.post('front/home/register_newsletter',{
					'email' : email
						},function(data){
							if(data=='true'){
								new PNotify({
							    title: 'Register success',
							    text: 'Your Email Has Been Register.',
							    icon: 'glyphicon glyphicon-ok'
								})				
							}else{
								new PNotify({
							    title: 'Your Email Already Register.',
							    text: 'Your Email Already Register.',
							    icon: 'glyphicon glyphicon-minus-sign'
								})
							}
							$("#news_email").val('');
					})	
				}
			
		})
	})
</script>
<div id="col1">
<div class="navigation">
<span class="titel-cate">Categories</span>
<?php
		$condition = " and pid = 0 ";
		$sql = "select * from product_category where 1=1 ".$condition."  ORDER BY show_no DESC ";
		$category = $this->db->getarray($sql); 
		$has_sub = '';$href='';
		echo '<ul>';			
			foreach($category as $mitem):
				$sql = "select id from product_category where pid = ".$mitem['id']." ORDER BY show_no DESC ";
				$scategory = $this->db->getone($sql);
				$has_sub = $scategory > 0 ? 'has-sub' : '';
				$href = $scategory > 0 ? "front/product/category/".$mitem['id'] : "front/product/index/".$mitem['id'];
				echo '<li class="'.$has_sub.'">';
					echo '<a href="'.$href.'">'.$mitem['name_th'].'</a>';
						if($scategory > 0){
							echo '<ul>';
							$condition = " and pid = ".$mitem['id'];
							$sql = "select * from product_category where 1=1 ".$condition."  ORDER BY show_no DESC  ";
							$lv2_category = $this->db->getarray($sql); 
							foreach($lv2_category as $lv2_item):
								$sql = "select count(*) from product_category where pid = ".$lv2_item['id'];
								$scategory = $this->db->getone($sql);
								$has_sub = $scategory > 0 ? 'has-sub' : '';
								$href = $scategory > 0 ? "front/product/category/".$lv2_item['id'] : "front/product/index/".$lv2_item['id'];
								echo '<li class="'.$has_sub.'">';
									echo '<a href="'.$href.'">'.$lv2_item['name_th'].'</a>';
										if($scategory > 0){
											echo '<ul>';
											$condition = " and pid = ".$lv2_item['id'];
											$sql = "select * from product_category where 1=1 ".$condition."  ORDER BY show_no DESC ";
											$lv3_category = $this->db->getarray($sql); 
											foreach($lv3_category as $lv3_item):
												$sql = "select count(*) from product_category where pid = ".$lv3_item['id'];
												$scategory = $this->db->getone($sql);
												$has_sub = $scategory > 0 ? 'has-sub' : '';
												$href = $scategory > 0 ? "front/product/category/".$lv3_item['id'] : "front/product/index/".$lv3_item['id'];
												echo '<li class="'.$has_sub.'">';
													echo '<a href="'.$href.'">'.$lv3_item['name_th'].'</a>';
												echo '</li>';	
											endforeach;
											echo '</ul>';
										}
								echo '</li>';	
							endforeach;
							echo '</ul>';
						}							
				echo '</li>';					
			endforeach;
		echo '</ul>';
?>
</div>
<div class="clear">&nbsp;</div>
<!----------------------------------------------------END Nav Leftmenu--------------------------------------------->
<?php if(!is_login()){?>
<form method="post" enctype="multipart/form-data">
<div id="login">
<div class="title-login">Login From</div>
<input name="left_login_username" id="" type="text" class="put-text" placeholder="Username">
<input name="left_login_password" id="" type="password" class="put-text" placeholder="********" style="margin-top:10px;">
<button type="submit" class="btn-Login">Log in</button><br>
<div class="forget"><a href="front/member/forgot_password">Forgot your password?</a></div>
</div>
</form>
<?php }else{ ?>
<div id="login">
<div class="title-login">Welcome</div>
<?php echo login_data('name');?>
<ul>
	<li><a href="front/member/profile">Manage Profile</a></li>
	<li><a href="front/member/order_history">Order History & Send Confirm Payment</a></li>
	<li><a href="front/member/testimonials">Write Customer 's FeedBack</a></li>
	<li><a href="front/member/logout">Log out</a></li>
</ul>
</div>	
<?php } ?>
<!----------------------------------------------------END Login form--------------------------------------------> 
<br>
<?php if(!is_login()){?>
<div><a href="front/member/register_form"><img src="media/images/banner-regis.jpg" width="190" height="92" /></a></div>
<?php } ?>
<br>

<div id="newsletter">
<div class="title-newsletter">Newsletter</div>
<span class="text-signup">Sign Up fo Our Newsletter</span>
<input name="news_email" id="news_email" type="email" class="put-text" placeholder="Fill Email">
<button type="button" name="btn_newsletter" id="btn_newsletter" class="btn-newsletter">Submit</button>
</div>
<!----------------------------------------------------END newsletter-------------------------------------------->
<br>
<div id="yourcart">
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
<span>Total:</span> <span class="total-cart">$<?php echo number_format($gtotal,2);?></span>
<div class="view-full-trolley"><a href="front/cart/index">View full trolley</a></div>
</div>
</div>
<!----------------------------------------------------END You Cart-------------------------------------------->
<br>
<?php
$banner = $this->db->getarray("SELECT * FROM banners order by show_no desc ");
foreach($banner as $item):
	$image_src = $item['image']!='' ? 'uploads/banners/'.$item['image'] : 'http://placehold.it/190x150/E4E3E1/ffffff&text=No+Image';
?>
<a href="<?php echo $item['url'];?>">
<img src="<?php echo $image_src;?>" width="190" alt="<?php echo $item['altimage'];?>" target="_blank" />
</a>
<br>
<? endforeach;?>
</div>
<!----------------------------------------------------------END Col1------------------------------------------------------->  