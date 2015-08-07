<style>
ul.networks {
    margin-bottom: 14px;
    list-style: none;
}

ul.networks>li { margin: 0 0 20px 0; }
/*
ul.networks>li a { 
    display: block;
margin: 0 0 7px 0;
background: #F7F5F2;
font-size: 18px;
color: #333;
padding: 5px 0 0 20px;
text-decoration: none;
}

ul.networks>li a:hover { background-color: #EFEFEF; }*/

.pin { border-left: 2px solid #EA1E63;border-top:2px solid #EA1E63;border-right:2px solid #EA1E63;border-bottom:2px solid #EA1E63;border-radius: 5px;}
.networks_title{
	background:#fcf7d1;
	padding:10px 5px;	
	font-size:16px;
	font-weight:bold;
}
.networks_desc{
	background:#FFFFFF;
	padding:3px 5px;
}
</style>
<div id="breadcrumb"><a href="home/index">Home</a> > Network of ASEAN</div>
<div id="title-page">Networks of ASEAN</div>
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