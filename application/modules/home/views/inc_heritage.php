<div id="asean-cultural">
      <div id="content-asean-cultural-1">
        <div id="title-asean-cultural">ASEAN CULTURAL HERITAGE SITES</div>
            <div id="arrow-left-ac"><a href="#">&nbsp;</a></div>
            <div id="arrow-right-ac"><a href="#">&nbsp;</a></div>
      </div>
      <div id="content-asean-cultural">
            <ul style="max-height:750px;">
            	<?php 
            			$i=0;
						foreach($rs as $key=>$heritage):
						$i++;
						if($i==5){
							$i=0;
							$li_style = 'class="last-ac"';
							$clear_div = '<div class="clearfix"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><br></div>';
						}else{
							$li_style = '';
							$clear_div = '';
						}
						$h_image = $heritage->heritage_image->get(1);	
				?>
            	<li <?php echo $li_style;?>>
            		<a href="heritages/detail/<?php echo $heritage->id;?>" >
                	<div class="pic-culture-country">
                		<div style="max-width:174px;max-height:174px;overflow: hidden;margin:0 auto;">
                		<img src="uploads/heritage_image/<?php echo $h_image->image;?>" height="174" class="image-cropper" />
                		</div>
                	</div>
                	<div style="overflow: hidden;max-height: 210px;">
                	<div class="title-culture"><?php echo $heritage->title;?></div>
					<div class="title-country"><?php echo $heritage->country->country_name;?></div>
					<div class="intro" style="max-height:86px;overflow: hidden;"><?php echo $heritage->description;?></div>
					</div>
					</a>
                </li>
                <?php echo $clear_div;?>
                <?php endforeach;?>            	
            </ul>
            <div class="clearfix">&nbsp;</div>
            <div id="btn-viewmore-ac"><a href="heritages/index">+ View all</a></div>
      </div>
        <br>
    </div>