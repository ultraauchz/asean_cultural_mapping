<?php echo bread_crumb($menu_id);?>
<style type="text/css">
	#dashboard>h1 {
		background:#F4F4F4;
		font-size:16px;
		padding:8px 15px;
		font-weight:bold;
		margin-top:0px;
	}

	
	table.table {
		border-spacing:5px;
		border-collapse: separate;
	}
	table.table tbody tr th {
		border-left:2px solid #333;
	}
	table.table tbody tr td {
		text-align:right;
	}
	#dashboard{
		padding:10px 15px;
	}
</style>
<section class="content">
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div id="dashboard" style="padding:0 5px; 0 0">
				<h1>Visitors Summary</h1>
				<div class="search" style="padding:2px 15px;">
					<form method="get">
						Show the previous 30 days countdown from <input class="datepicker" type="text" name="date" value="<?php echo @$_GET['date'] ?>" /> <input type="submit" value="Show" class="btn btn-info" />
					</form>
				</div>
				<img src="http://chart.apis.google.com/chart?
				chs=1000x200
				&amp;chg=22,30&amp;chd=t:<?
				$i=0;
				$max=0;
				$min=100000;
				foreach($visits as $v){
					if($i>0)echo ",";
					if($v['ga:visits']>$max)$max=$v['ga:visits'];
					if($v['ga:visits']<$min)$min=$v['ga:visits'];
					echo $v['ga:visits'];
					$i++;
				}
				$max=$max+5;
				$min=$min-5;
				?>
				&amp;chl=<?
				$i=0;
				foreach($visits as $v){
					if($i>0)echo "|";
					$tmp=null;
					$tmp[]=substr($v['ga:date'], -2);
					$tmp[]=substr($v['ga:date'], -4,2);
					//echo $v['ga:date'];
					echo "$tmp[0]/$tmp[1]";
					$i++;
				}
				?>
				&amp;chxr=1,<?= $min ?>,<?= $max ?>
				&amp;chds=<?= $min ?>,<?= $max ?>
				&amp;chm=o,0066FF,0,-1.0,6|N,0066FF,0,-1.0,11
				&amp;chxt=x,y
				&amp;cht=lc
				" />
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<div class="box">
			<div id="dashboard" style="padding:0 5px; 0 0">
				<h1>Usaged</h1>
				<table class="table form">
				<tr><th>visits</th><td><?= $summery['ga:visits'] ?></td></tr>
				<tr><th>unique visitors</th><td><?= $summery['ga:visitors'] ?></td></tr>
				<tr><th>pageviews</th><td><?= $summery['ga:pageviews'] ?></td></tr>
				<tr><th>time on site</th><td><?= floor(($summery['ga:timeOnSite']/$summery['ga:visits'])/60) . ":" . ($summery['ga:timeOnSite']/$summery['ga:visits']) % 60 ?></td></tr>
				<tr><th>new visits</th><td><?= ceil(($summery['ga:newVisits']/$summery['ga:visits'])*100) ?> %</td></tr>
				<tr><th>bounce rate</th><td><?= ceil(($summery['ga:bounces']/$summery['ga:entrances'])*100)?> %</td></tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="box">
			<div id="dashboard" style="padding:0 5px; 0 0">
				<h1>Visitors</h1>
				<table class="table form">
					<tr><th>visits</th><td><?= $allTimeSummery['ga:visits'] ?></td></tr>
					<tr><th>pageviews</th><td><?= $allTimeSummery['ga:pageviews'] ?></td></tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<div class="box">
			<div id="dashboard" style="padding:0 5px; 0 0">
				<h1>Top 10 Countries</h1>
				<table class="table form">
				<? foreach($topCountries as $country){ ?>
				<tr><th><?= $country['ga:country'] ?></th><td><?= $country['ga:visits'] ?></td></tr>
				<? } ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="box">
			<div id="dashboard" style="padding:0 5px; 0 0">
				<h1>Most keywords</h1>
				<table class="table form">
				<? foreach($topKeywords as $keyword){ ?>
				<tr><th><?= $keyword['ga:keyword'] ?></th><td><?= $keyword['ga:visits'] ?></td></tr>
				<? } ?>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<div class="box">
			<div id="dashboard" style="padding:0 5px; 0 0">
				<h1>An overview of the sources of traffic.</h1>
				<table class="table form">
				<? foreach($topReferrer as $ref){ ?>
				<tr><th><div><?= $ref['ga:source'] ?></div></th><td><?= $ref['ga:visits'] ?></td></tr>
				<? } ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="box">
			<div id="dashboard" style="padding:0 5px; 0 0">
				<h1>Top Content</h1>
				<table class="table form">
				<? foreach($topPages as $page){ ?>
				<tr><th><div><?= $page['ga:pagePath'] ?></div></th><td><?= $page['ga:visits'] ?></td></tr>
				<? } ?>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<div class="box">
			<div id="dashboard" style="padding:0 5px; 0 0">
				<h1>Visitor Operating System</h1>
				<img src="http://chart.apis.google.com/chart?
				chs=370x160
				&amp;chd=t:<?
				$i=0;
				foreach($topOs as $os){
					if($i>0)echo ",";
					echo $os['ga:visits'];
					$i++;
				}
				?>
				&amp;chl=<?
				$i=0;
				foreach($topOs as $os){
					if($i>0)echo "|";
					echo $os['ga:operatingSystem'];
					$i++;
				}
				?>
				&amp;cht=p3
				" />
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="box">
			<div id="dashboard" style="padding:0 5px; 0 0">
				<h1>Visitor Browser</h1>
				<img src="http://chart.apis.google.com/chart?
				chs=370x160
				&amp;chd=t:<?
				$i=0;
				foreach($topBrowsers as $browser){
					if($i>0)echo ",";
					echo $browser['ga:visits'];
					$i++;
				}
				?>
				&amp;chl=<?
				$i=0;
				foreach($topBrowsers as $browser){
					if($i>0)echo "|";
					echo $browser['ga:browser'];
					$i++;
				}
				?>
				&amp;cht=p3
				" />
			</div>
		</div>
	</div>
</div>
</section>