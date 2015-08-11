<style>
ul.heritages {
	padding-left:0px;
    margin-bottom: 14px;
    list-style: none;
}


ul.heritages>li {
    margin: 30px 0px;
    box-shadow: 0 0 3px #CACACA;
    background: white;
}

.pin {
    padding: 20px 0px;
    border-bottom: 4px solid #fcac85;
}
.heritages_title {
    font-size: 16px;
    font-weight: bold;
    margin: 0px 0px;
    margin-left:240px;
    border-bottom: 1px solid #ddd;
}
.heritages_desc {
    margin: 10px 30px;
    min-height: 80px;    
    margin-left:240px;
}

.pin>.thump {
    float: left;
    margin: 0px 10px 0px 15px;
}

</style>
<div id="breadcrumb"><a href="home/index">Home</a> > ASEAN Cultural Heritage Sites</div>
<div id="title-page">ASEAN Cultural Heritage Sites</div>
<ul class="heritages">
<?php 
foreach($rs as $key=>$heritage):
		$h_image = $heritage->heritage_image->get(1);	
?>
	<li class="pin">	
		<div class="thump clip-circle" style="max-height: 130px;overflow: hidden;">
		 <a href="heritages/detail/<?php echo $heritage->id;?>"><img src="uploads/heritage_image/<?php echo $h_image->image;?>"  width="200" border="0"></a>
		</div>
		<div class="heritages_title">
			<a href="heritages/detail/<?php echo $heritage->id;?>"><?php echo $heritage->title;?> ::: <?php echo $heritage->country->country_name;?></a>
		</div>
		<div class="heritages_desc">
			<?php echo $heritage->description;?>
		</div>
	</li>
<?php endforeach;?>
<?php echo $rs->pagination()?>
</ul>