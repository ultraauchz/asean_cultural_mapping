<div id="network">
	<div id="title-network">NETWORK OF ASEAN</div>
    <div id="line-title-network">&nbsp;</div>
    <br>
    <div id="content-network">
   	  <!--<p style="text-align:center;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>-->
        <br>
        <ul>
        	<?php foreach($networks as $key=>$network_item):?>
        		<li><a href="networks/detail/<?php echo $network_item->id;?>"><?php echo $network_item->title;?> <?php if($network_item->code!='')echo ' ::: '.$network_item->code;?></a></li>
        	<?php endforeach;?>
        </ul>
    </div>
</div>