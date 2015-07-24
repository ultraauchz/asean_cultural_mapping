<?php if($programs):?>
<div class="span3">
    
    <div id="clients">
        <div class="thumbnail">
            
            <div class="blockDtl">
                <h4>โปรแกรมระบบงาน</h4>
            </div>
            
            <div>
                
                <ul>
                    <?php foreach ($programs as $key => $program):
                        $links = null;
                        if($program->link_type==2) {
                            $links = 'href="'.$program->links.'"';
                        }
                    ?>
                    <li><a <?php echo $links?> target="_blank" title="<?php echo $program->title?>" ><?php echo $program->title?></a></li>
                        <?php foreach ($root_programs as $num => $row):if($row->parent==$program->id):
                            $links = null;
                            if($row->link_type==2) {
                                $links = 'href="'.$row->links.'"';
                            }
                        ?>
                        <li style="list-style: none;" >-- <a <?php echo $links?> target="_blank" title="<?php echo $row->title?>" ><?php echo $row->title?></a></li>
                        <?php endif;endforeach?>
                    <?php endforeach?>
                </ul>
                
            </div>
        </div>
    </div>
    
    <br>
    
</div>
<?php endif?>

<?php if($manuals):?>
<div class="span3">
    
    <div id="clients">
        <div class="thumbnail">
            
            <div class="blockDtl">
                <h4>คู่มือการใช้งาน</h4>
            </div>
            
            <div>
                
                <ul>
                    <?php foreach ($manuals as $key => $manual):
                        $links = "href='centre/manual/".$manual->id."'";
                        if($manual->link_type==2) {
                            $links = 'href="'.$manual->links.'"';
                        }
                        if($manual->link_type==3) {
                            if( ((strlen(strip_tags($manual->detail)))<20) && ($manual->file_path==true)) {
                                $links = 'href="'.$manual->file_path.'"';
                            }   
                        }
                    ?>
                    <li><a <?php echo $links?> target="_blank" title="<?php echo $manual->title?>" ><?php echo $manual->title?></a></li>
                        <?php foreach ($root_manuals as $num => $row):if($row->parent==$manual->id):
                            $links = "href='centre/manual/".$row->id."'";
                            if($row->link_type==2) {
                                $links = 'href="'.$row->links.'"';
                            }
                            if($row->link_type==3) {
                                if( ((strlen(strip_tags($row->detail)))<20) && ($row->file_path==true)) {
                                    $links = 'href="'.$row->file_path.'"';
                                }   
                            }
                        ?>
                        <li style="list-style: none;" >-- <a <?php echo $links?> target="_blank" title="<?php echo $row->title?>" ><?php echo $row->title?></a></li>
                        <?php endif;endforeach?>
                    <?php endforeach?>
                </ul>
                
            </div>
        </div>
    </div>
    
    <br>
    
</div>
<?php endif?>

<style type="text/css">
    #clients a:hover {
        text-decoration: none;
    }
</style>