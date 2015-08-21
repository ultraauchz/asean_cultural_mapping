<style>
ul.networks {
	padding-left:0px;
    margin-bottom: 14px;
    list-style: none;
}
.networks_title {
    font-size: 16px;
    font-weight: bold;
    margin: 0px 20px;
    border-bottom: 1px solid #ddd;
}

ul.networks>li {
    margin: 0px 0px;
    box-shadow: 0 0 3px #CACACA;
    background: white;
}

.pin {
    padding: 20px 0px;
    border-bottom: 4px solid #fcac85;
}

.networks_desc {
    margin: 10px 20px;
}
</style>
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
<div id="breadcrumb"><a href="home/index">Home</a> > <a href="organizations/index">ASEAN Cultural Organizations</a> > <a href="organizations/chart/<?php echo $org->country_id;?>"><?php echo $org->country->country_name;?></a> > <?php echo $org->org_name;?></div>
<div id="title-page"><?php echo $org->org_name;?> ::: <?php echo $org->country->country_name;?></div>
<?php echo $org->org_detail;?>
<div id="title-page">Membership of</div>
<ul class="networks">
<?php
$no = 0; 
foreach ($org_network as $key => $org_network_item):
	$no++; 
?>
		<li class="pin">	
			<div class="networks_title">
				<a href="networks/detail/<?php echo $org_network_item->id;?>"><?php echo $org_network_item->title;?> ::: <?php echo $org_network_item->code;?></a>
			</div>
			<div class="networks_desc">
				<?php echo $org_network_item->description;?>
			</div>
		</li>			
<? endforeach;?>
</ul>
<div id="title-page">Heritage Responsibilities</div>
<ul class="heritages">
<?php 
foreach($heritage_result as $key=>$heritage):
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
</ul>
