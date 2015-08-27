<style>
	#stat{width:100%;}
	#stat th, #stat td{padding:5px 0;border-bottom:1px dotted #eee;}
	#stat th{text-align:left;}
	#stat td{text-align:right;}
</style>
<div class="box">
	<h3><?php echo lang('stat_header'); ?></h3>
	<div class="box-content">
		<table id="stat">
			<tr><th><?php echo lang('stat_visiter'); ?></th><td><?= $allTimeSummery['ga:visits'] ?></td></tr>
			<tr><th><?php echo lang('stat_page_view'); ?></th><td><?= $allTimeSummery['ga:pageviews'] ?></td></tr>
		</table>
	</div>
	<div class="bottom"></div>
</div>