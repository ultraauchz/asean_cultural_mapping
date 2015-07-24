<?php if($programs):?>
<div class="span3">
    
    <div id="clients">
        <div class="thumbnail">
        	
            <div class="blockDtl">
                <h4>โปรแกรมระบบงาน</h4>
            </div>
            
            <div>
            	
                <ul>
                	<?php foreach ($programs as $key => $program):?>
                    <li><a href="<?php echo $program->links?>" target="_blank" title="<?php echo $program->title?>" ><?php echo $program->title?></a></li>
                        <?php foreach ($root_programs as $num => $row):if($row->parent==$program->id):?>
                        <li>-- <a href="<?php echo $row->links?>" target="_blank" title="<?php echo $row->title?>" ><?php echo $row->title?></a></li>
                        <?php endif;endforeach?>
					<?php endforeach?>
                </ul>
                
            </div>
        </div>
    </div>
    
    <br>
    
</div>
<?php endif?>

<?php if($programs):?>
<div class="span3">
    
    <div id="clients">
        <div class="thumbnail">
        	
            <div class="blockDtl">
                <h4>คู่มือการใช้งาน</h4>
            </div>
            
            <div>
            	
                <ul>
                	<?php foreach ($manuals as $key => $manual):
                        $links = "centre/manual/".$manual->id;
                        if( ((strlen(strip_tags($manual->detail)))<20) && ($manual->file_path==true)) {
                            $links = $manual->file_path;
                        }
                    ?>
                    <li><a href="<?php echo $links?>" target="_blank" title="<?php echo $manual->title?>" ><?php echo $manual->title?></a></li>
                        <?php foreach ($root_manuals as $num => $row):if($row->parent==$manual->id):
                            $links = "centre/manual/".$row->id;
                            if( ((strlen(strip_tags($row->detail)))<20) && ($row->file_path==true)) {
                                $links = $row->file_path;
                            }
                        ?>
                        <li>-- <a href="<?php echo $links?>" target="_blank" title="<?php echo $row->title?>" ><?php echo $row->title?></a></li>
                        <?php endif;endforeach?>
					<?php endforeach?>
                </ul>
                
            </div>
        </div>
    </div>
    
    <br>
    
</div>
<?php endif?>