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
<div id="breadcrumb"><a href="home/index">Home</a> > Network of ASEAN</div>
<div id="title-page">Networks of ASEAN</div>
<form method="get" enctype="multipart/form-data">
<div style="padding:10px 5px;padding-bottom: 30px;">	
<div style="float:left;width:100%;">
  <div class="col-xs-3">
<label for="search">Title</label> 
<input type="text" name="search" class="form-control" placeholder="Enter Network Title" value="<?=@$_GET['search'];?>">
  </div>
  <div class="col-xs-3">
<br>
<input type="submit" name="b" class="btn btn-primary" value="Search">
  </div>
</div>
</form>
</div>
<div class="clearfix"></div>
<br>
<ul class="networks">
<?php foreach($rs as $key=>$network): ?>
	<li class="pin">	
		<div class="networks_title">
			<a href="networks/detail/<?php echo $network->id;?>"><?php echo $network->title;?> ::: <?php echo $network->code;?></a>
		</div>
		<div class="networks_desc">
			<?php echo $network->description;?>
		</div>
	</li>
<?php endforeach;?>
</ul>