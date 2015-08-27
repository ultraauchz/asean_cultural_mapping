<style>
	#stat{width:100%;}
	#stat th, #stat td{padding:5px 0;border-bottom:1px dotted #eee;}
	#stat th{text-align:left;}
	#stat td{text-align:right;}
</style>
<div class="box">
	<h3><?php echo lang('stat_header'); ?></h3>
	<div class="box-content" id="stat-area">
		
	</div>
	<div class="bottom"></div>
</div>
<script>
	$(function(){
		$('#stat-area').html('<div align="center"><?php echo img('media/images/ajax-loader.gif'); ?></div>');
		$.get('dashboards/ajax_load', function(data){
			$('#stat-area').html(data);
		});
	});
</script>