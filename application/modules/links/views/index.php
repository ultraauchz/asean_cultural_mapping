<h2>เว็บลิ้งค์</h2>

<?php foreach($link_groups as $row):?>
<div class="bs-callout bs-callout-info" id="callout-helper-context-color-specificity">
    <h4><?php echo $row->title?></h4>
    <!-- <p>
    	<ul>
		    <?php foreach($row->link->order_by('id','asc')->get() as $item):?>
		    <li><a href="<?php echo $item->url?>" action="<?php echo $item->action?>" title="<?php echo $item->detail?>"><?php echo ($item->detail) ? $item->detail : "กรมฝนหลวงและการบินเกษตร"?></a></li>
		    <?php endforeach;?>
	    </ul>
    </p> -->
    <p>
	    <?php foreach($row->link->order_by('id','asc')->get() as $item):?>
	    	<a href="<?php echo $item->url?>" target="<?php echo $item->action?>" title="<?php echo ($item->detail) ? $item->detail : "กรมฝนหลวงและการบินเกษตร"?>"><img src="<?php echo $item->image?>" style="margin:5px;"></a>
	    <?php endforeach;?>
    </p>
</div>
<?php endforeach;?>
