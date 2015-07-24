<table class="table">
        <tr>
            <th style="text-align: center;">
                <img src="http://chart.apis.google.com/chart?
chs=800x200
&amp;chg=22,30&amp;chd=t:<?php 
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
&amp;chl=<?php
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
&amp;chxr=1,<?php echo $min ?>,<?php echo $max ?>
&amp;chds=<?php echo $min ?>,<?php echo $max ?>
&amp;chm=o,0066FF,0,-1.0,6|N,0066FF,0,-1.0,11
&amp;chxt=x,y
&amp;cht=lc
" />
            </th>
        </tr>
    </table>


<div class="clear"></div>
	
	<div class="col-lg-6" >
		
		<table class="table table-bordered table-hover table-striped" >
			
			<thead>
				<tr>
					<th colspan="2" >จำนวนผู้เข้าชม</th>
				</tr>
			</thead>
			
			<tbody>
				<tr>
					<td>วันนี้</td>
					<td><?php echo $today["ga:visits"]?></td>
				</tr>
				<tr>
					<td>เดือนนี้</td>
					<td><?php echo $month["ga:visits"]?></td>
				</tr>
				<tr>
					<td>ทั้งหมด</td>
					<td><?php echo $alltime["ga:visits"]?></td>
				</tr>
			</tbody>
			
		</table>
		
		<?php if($topPages):?>
		<table class="table table-bordered table-hover table-striped" >
			
			<thead>
				<tr>
					<th colspan="2" >หน้าที่มีการเข้าสูงสุด</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($topPages as $page):?>
				<tr>
					<td><?php echo $page["ga:pagePath"]?></td>
					<td><?php echo $page["ga:visits"]?></td>
				</tr>
				<?php endforeach?>
			</tbody>
			
		</table>
		<?php endif?>
			
	</div>
	
	<div class="col-lg-6" >
		
		<?php if($topKeywords):?>
		<table class="table table-bordered table-hover table-striped" >
			
			<thead>
				<tr>
					<th colspan="2" >คำค้นหา</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($topKeywords as $keyword):?>
				<tr>
					<td><?php echo $keyword["ga:keyword"]?></td>
					<td><?php echo $keyword["ga:visits"]?></td>
				</tr>
				<?php endforeach?>
			</tbody>
			
		</table>
		<?php endif?>
		
	</div>

<div class="clear"></div>