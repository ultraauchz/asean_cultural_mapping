<style>
ul.heritages {
	padding-left:0px;
    margin-bottom: 14px;
    list-style: none;
}


ul.heritages>li {
    margin: 0px 0px;
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
<form method="get" enctype="multipart/form-data">
<div style="padding:10px 5px;">	
<div style="float:left;width:100%;">
  <div class="col-xs-3">
<label for="search">Title</label> 
<input type="text" name="search" class="form-control" placeholder="Enter Heritage Title" value="<?=@$_GET['search'];?>">
  </div>
  <div class="col-xs-3">
<label for="coutry_id">Country</label> 
<?php
	echo form_dropdown("country_id",get_option("id","country_name","acm_country","WHERE zone = 'ASEAN' ORDER BY country_name ASC"),@$_GET["country_id"],"class=\"form-control\" style=\"display:inline;\" ","-- Select Country --","");	
?>
  </div>
  <div class="col-xs-3">
<br>
<input type="submit" name="b" class="btn btn-primary" value="Search">
  </div>
</div>
</form>
</div>
<div class="clearfix"></div>
<?php echo $rs->pagination()?>
<ul class="heritages">
<?php 
foreach($rs as $key=>$heritage):
		$h_image = $heritage->heritage_image->order_by('show_no','desc')->get(1);	
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
<?php echo $rs->pagination()?>