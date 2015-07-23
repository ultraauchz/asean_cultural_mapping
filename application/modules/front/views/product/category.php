<div id="col-page">
<div id="breadcrumb"><a href="front/home">HOME</a> > PRODUCTS</div>
<div class="title-page">PRODUCTS</div>
<br>
<div id="Products-cate">
       		
			<ul>
				<?php
				$i=0; 
				foreach($category as $item):
					$i++; 
					$alt_class = $i == 4 ? 'class="last4" ': "";
					$image_src = $item['image_name']!='' ? 'uploads/product_category/'.$item['image_name'] : 'http://placehold.it/190x194/E4E3E1/ffffff&text=No+Image';
					$sql = "select id from product_category where pid = ".$item['id'];
					$scategory = $this->db->getone($sql);
					$href = $scategory > 0 ? "front/product/category/".$item['id'] : "front/product/index/".$item['id'];
				?>
            	<li>
           	    	<a href="<?php echo $href;?>"><img src="<?php echo $image_src;?>" width="190" height="194" class="box-product"></a>
                    <div class="box-name"><a href="<?php echo $href;?>"><?php echo $item['name_th'];?></a></div>
                </li>
                <?php if($i == 4 ){echo '<div class="white-space">&nbsp;</div>';$i=0;} ?>
				<?php endforeach;?>
            </ul>
</div>            			  
</div>