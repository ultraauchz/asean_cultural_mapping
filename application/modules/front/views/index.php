<style>
	.btn-more{
	  float: right;
	  margin-top: 8px;
	  display: block;
	  width: 243px;
	  padding:5px 10px;
	  /*background-image: url(../images/btn-seemore.png);*/
	  border:1px solid #CCCCCC;
	  background:#F4F4F4;
	  text-decoration: none;
	  cursor: pointer;
	}
</style>
<script>
	$(document).ready(function(){		
		
	})	
</script>
<div id="col2">
  	  <div id="highlight">
	  	  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	        <ol class="carousel-indicators">
	          <?php
	          	$i=0; 
	          	foreach($hilight as $item):
					$i++; 
	          ?>
	          <li data-target="#carousel-example-generic" data-slide-to="0" <?php if($i==1)echo 'class="active" ';?>></li>
	          <? endforeach;?>
	        </ol>
	        <div class="carousel-inner">
	          <?php
	          	$i=0;
	           	foreach($hilight as $item): 
				   	$i++;
					$href = $item['url']=='' ? 'front/hilight/index/'.$item['id'] : $item['url'];
					$tartget = $item['url']=='' ? '_self' : '_blank';
	          ?>
	          <div class="item  <?php if($i==1)echo 'active ';?>">
	          	<a href="<?php echo $href;?>" target="<?php echo $tartget;?>">
	            <img src="uploads/hilights/<?php echo $item['image'];?>" style="width:790px;height:405px;">
	            </a>
	            <div class="carousel-caption">
	            	<!-- title -->
	            </div>
	          </div>
	          <? endforeach;?>
	        </div>
	        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
	          <span class="fa fa-angle-left"></span>
	        </a>
	        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
	          <span class="fa fa-angle-right"></span>
	        </a>
	      </div>
      </div>
      <div class="clear">&nbsp;</div>
       <!--------------------------------------------------------END Highlight-------------------------------------------------->
       
       <div id="MainCategories">
       		<div class="title-MainCategories">Main Categories</div>
			<ul>
				<?php
				$i=0; 
				foreach($main_cat as $item):
					$i++; 
					$alt_class = $i == 4 ? 'class="last4" ': "";
					$image_src = $item['image_name']!='' ? 'uploads/product_category/'.$item['image_name'] : 'http://placehold.it/190x194/E4E3E1/ffffff&text=No+Image';
					$sql = "select id from product_category where pid = ".$item['id'];
					$scategory = $this->db->getone($sql);
					$href = $scategory > 0 ? "front/product/category/".$item['id'] : "front/product/index/".$item['id'];
				?>
            	<li <?php echo $alt_class;?>>
           	    	<a href="<?php echo $href;?>"><img src="<?php echo $image_src;?>" width="190" height="194" class="box-product"></a>
                    <div class="box-name"><a href="<?php echo $href;?>"><?php echo $item['name_th'];?></a></div>
                </li>
                <?php if($i == 4 ){echo '<div class="white-space">&nbsp;</div>';$i=0;} ?>
                <?php endforeach;?>
            </ul>
            
       </div>
 	  <!-------------------------------------------------------END Main Categories--------------------------------------------->
 	 <?
 	 foreach($first_page_category as $cat):
 	 ?>
     <div id="new-arrival">
	   <div class="title-new-arrival"><?php echo $cat['name_th'];?></div>
       <div class="btn-more btn"  ><a href="front/product/index/<?php echo $cat['id'];?>">+ See more <?php echo $cat['name_th'];?></a></div>
       <div class="clear" style="line-height:1px;">&nbsp;</div>
  		<div class="header-new-arrival">
  			<img src="<?php echo (is_file('uploads/product_category/'.@$cat['banner_image_name']))? 'uploads/product_category/'.@$cat['banner_image_name'] : 'media/images/noimage.gif' ?>"  />
  		</div>
            <ul>
            	<?php 
            	$i=0;
				$product = $this->db->getarray("select * from product where cat_lv1=".$cat['id']." and show_firstpage='show' order by show_no desc ");
            	foreach($product as $item):
					$i++; 
					$alt_class = $i == 4 ? 'class="last4" ': "";
					$pimage = $this->db->getone('select image_name from product_image WHERE product_id='.$item['id'].' order by show_no desc ');
					$image_src = $pimage!='' ? 'uploads/products/images/'.$pimage : 'http://placehold.it/172x176/E4E3E1/ffffff&text=No+Image';
					$href = "front/product/detail/".$new_arrival_cat_id."/".$item['id'];
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
                            	<img src="media/images/ico_outofstock.png" style="display:inherit;">
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
     <? endforeach; ?>
    <!---------------------------------------------------------END New Arrival------------------------------------------------> 
    </div>
    <!----------------------------------------------------------END Col2------------------------------------------------------->  
    
    <div id="col3">
           <div id="u-may-like">
       		<div class="title-u-may-like">You May Like</div>
            <ul>
            	<?php
            	$i=0; 
				$class="bg-u-may-like";
            	foreach($maylike_product as $item): 
					$i++;
					$class = $class=="" ? "bg-u-may-like" : "";
					$pimage = $this->db->getone('select image_name from product_image WHERE product_id='.$item['id'].' order by show_no desc ');
					$image_src = $pimage!='' ? 'uploads/products/images/'.$pimage : 'http://placehold.it/57x57/E4E3E1/ffffff&text=No+Image';
					$cat_id = $item['cat_lv3'] > 0 ? $item['cat_lv3'] : $item['cat_lv2'] > 0 ? $item['cat_lv2'] : $item['cat_lv1'];
					$href = "front/product/detail/".$cat_id."/".$item['id'];
            	?>
            	<li class="<?php echo $class;?>" style="height:90px;">
                	<div class="img-u-may-like"><a href="<?php echo $href;?>"><img src="<?php echo $image_src;?>" width="57" height="57" /></a></div>
                    <span class="detail-u-may-like"><a href="#"><?php echo $item['name_th'];?></a></span>
                    <span class="prize"><a href="<?php echo $href;?>">$<?php echo number_format($item['price'],2);?></a></span>
                </li>
                <?php endforeach;?>                           	    
            </ul>
            
       </div>
       <!--------------------------------------------------END You may like------------------------------------------->
       <div class="clear">&nbsp;</div>
       <div id="u-may-like">
       		<div class="title-u-may-like">Popular Products</div>
            <ul>
            	<?php
            	$i=0; 
				$class="bg-u-may-like";
            	foreach($popular_product as $item): 
					$i++;
					$class = $class=="" ? "bg-u-may-like" : "";
					$pimage = $this->db->getone('select image_name from product_image WHERE product_id='.$item['id'].' order by show_no desc ');
					$image_src = $pimage!='' ? 'uploads/products/images/'.$pimage : 'http://placehold.it/57x57/E4E3E1/ffffff&text=No+Image';
					$cat_id = $item['cat_lv3'] > 0 ? $item['cat_lv3'] : $item['cat_lv2'] > 0 ? $item['cat_lv2'] : $item['cat_lv1'];
					$href = "front/product/detail/".$cat_id."/".$item['id'];
            	?>
            	<li class="<?php echo $class;?>" style="height:90px;">
                	<div class="img-u-may-like"><a href="<?php echo $href;?>"><img src="<?php echo $image_src;?>" width="57" height="57" /></a></div>
                    <span class="detail-u-may-like"><a href="#"><?php echo $item['name_th'];?></a></span>
                    <span class="prize"><a href="<?php echo $href;?>">$<?php echo number_format($item['price'],2);?></a></span>
                </li>
                <?php endforeach;?>
            </ul>
            
       </div>
       <!--------------------------------------------------END Popular Products------------------------------------------->
        <div class="clear">&nbsp;</div>
       <div id="u-may-like">
       		<div class="title-u-may-like">Random Products</div>
            <ul>
            	<?php
            	$i=0; 
				$class="bg-u-may-like";
            	foreach($random_product as $item): 
					$i++;
					$class = $class=="" ? "bg-u-may-like" : "";
					$pimage = $this->db->getone('select image_name from product_image WHERE product_id='.$item['id'].' order by show_no desc ');
					$image_src = $pimage!='' ? 'uploads/products/images/'.$pimage : 'http://placehold.it/57x57/E4E3E1/ffffff&text=No+Image';
					$cat_id = $item['cat_lv3'] > 0 ? $item['cat_lv3'] : $item['cat_lv2'] > 0 ? $item['cat_lv2'] : $item['cat_lv1'];
					$href = "front/product/detail/".$cat_id."/".$item['id'];
            	?>
            	<li class="<?php echo $class;?>" style="height:90px;">
                	<div class="img-u-may-like"><a href="<?php echo $href;?>"><img src="<?php echo $image_src;?>" width="57" height="57" /></a></div>
                    <span class="detail-u-may-like"><a href="#"><?php echo $item['name_th'];?></a></span>
                    <span class="prize"><a href="<?php echo $href;?>">$<?php echo number_format($item['price'],2);?></a></span>
                </li>
                <?php endforeach;?>
            </ul>
            
       </div>
       <!--------------------------------------------------END Random Products------------------------------------------->
    
    </div>
    <!----------------------------------------------------------END Col3------------------------------------------------------->