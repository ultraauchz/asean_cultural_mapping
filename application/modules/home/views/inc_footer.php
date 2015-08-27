<style>
	#stat{width:100%;}
	#stat th, #stat td{padding:5px 0;border-bottom:1px dotted #eee;}
	#stat th{text-align:left;}
	#stat td{text-align:right;}
</style>
<!--
<div id="text-footer">
    <div id="textAddress"><b>The Fine Arts Department Minitry of Culture Thailand </b><br>The Grand Palace Bangkok, Bangkok 10200.<br>
+66 (2) 225 2652, 221 7811,225 1227, 623 6450    Fax. : +66 (2) 221 0628, 221 1812
    </div>
    <div id="copy"><span class="cp">© Copyright 2015.</span>  2015 ASEAN CULTURAL MAPPING <span class="cp">All Rights Reserved.</span></div>
</div>
-->
<div id="text-footer">
    <div id="textAddress">
    	<?php echo $footage->detail;?>
    </div>
    <div id="copy">
    	<div class="box">
			Visitors
			<div class="box-content" id="stat-area">
				
			</div>
			<div class="bottom"></div>
		</div>
    	<span class="cp">© Copyright 2015.</span>  2015 ASEAN CULTURAL MAPPING <span class="cp">All Rights Reserved.</span>
    </div>
</div>
<script>
	$(function(){
		$('#stat-area').html('<div align="center"><?php echo img('medias/img/ajax-loader.gif'); ?></div>');
		$.get('dashboards/ajax_load', function(data){
			$('#stat-area').html(data);
		});
	});
</script>