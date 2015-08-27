<div id="breadcrumb"><a href="home/index">Home</a> > <a href="heritages/index">ASEAN Cultural Heritage Sites</a> > <a href="heritages/index?country_id=<?php echo $rs->country_id;?>"><?php echo $rs->country->country_name;?></a> > <?php echo $rs->title;?></div>
            <div id="title-page"><?php echo $rs->title;?> ::: <?php echo $rs->country->country_name;?></div>
                <?php echo $rs->detail;?>                        
            <div id="title-page">Responsibilities of</div>
            <ul>
			<?php
			$no = 0; 
			foreach ($heritage_org as $key => $heritage_org_item):
				$no++; 
			?>
					<li>
						<a href="organizations/detail/<?php echo $heritage_org_item->org_id;?>">
							<?php echo $heritage_org_item->organization->org_name;?> ::: <?php echo $heritage_org_item->organization->country->country_name;?>
						</a> 
					</li>				
			<? endforeach;?>
			</ul>			
			<div class="clearfix"><p></p></div>
			<div id="title-page">Gallery</div>
			<div class="image-zoom-container">
			<?if(@$rs->heritage_image->get() != "") : ?>
				<?foreach($rs->heritage_image->order_by('show_no','desc')->get() as $row):?>
				<div class="zoom-container multiple-borders ">
				<a rel="image_group" href="uploads/heritage_image/<?=$row->image?>" class="fancybox" title="<?=@$row->image_detail?>"><img src="uploads/heritage_image/<?=$row->image?>" class="" width="150"></a>
				</div>
				<?endforeach?>
			<?endif;?>            
			</div>