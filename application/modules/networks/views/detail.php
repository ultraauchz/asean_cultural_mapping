<div id="breadcrumb"><a href="home/index">Home</a> > <a href="networks/index">Network of ASEAN</a> > <?php echo $rs->title;?></div>
<div id="title-page"><?php echo $rs->title;?></div>
    <?php echo $rs->detail;?>


<div id="title-page">Members</div>
 <ul>
<?php
$no = 0; 
foreach ($network_org as $key => $network_org_item):
	$no++; 
?>
		<li>
			<a href="organizations/detail/<?php echo $network_org_item->id;?>">
				<?php echo $network_org_item->org_name;?> ::: <?php echo $network_org_item->country->country_name;?>
			</a> 
		</li>				
<? endforeach;?>
</ul>
