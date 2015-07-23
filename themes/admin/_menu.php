<?php
$CI =& get_instance();
$main_menu = $CI->db->getarray("SELECT * FROM system_menus WHERE show_state = 'y' and parent_id = 0 ORDER BY order_no ");
$current_menu = $CI->db->getrow("SELECT * FROM system_menus WHERE id = ".$menu_id);
?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- search form -->
  <!--
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search..."/>
      <span class="input-group-btn">
        <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </form>
  -->
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->  
  <ul class="sidebar-menu">
    <li class="header">Menu</li>
    <!--
    <li class="active treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
        <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
      </ul>
    </li>
   -->
    <?php 
    foreach($main_menu as $mitem):
		if($mitem['have_child']=='y'){    
   	?>
    <li class="treeview <?php if(@$current_menu['id']==$mitem['id'] || @$current_menu['parent_id']==$mitem['id']){echo 'active';}?>">
      <a href="#">
        <i class="fa fa-files-o"></i>
        <span><?=$mitem['title'];?></span>
        <!-- notify new record-->
        <!--<span class="label label-primary pull-right">4</span>-->
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
      	<?php
      		$child_menu = $CI->db->getarray("SELECT * FROM system_menus WHERE show_state = 'y' and parent_id = ".$mitem['id']." ORDER BY title ");
			foreach($child_menu as $citem):
				$icon = $citem['custom_icon_style']!='' ? $citem['custom_icon_style'] : "fa-circle-o" ;
      	?>
        	<li class="<?php if(@$current_menu['id']==$citem['id']){echo 'active';}?>"><a href="<?php echo $citem['url'];?>"><i class="fa <?php echo $icon;?>"></i> <?php echo $citem['title'];?></a></li>
        <? endforeach;?>
      </ul>
    </li>
    <?php 
		}else{ 
	?>
    <li><a href="<?php echo $mitem['url'];?>"><i class="fa fa-book"></i> <?php echo $mitem['title'];?></a></li>
    <?php } ?>
    <?php endforeach;?>    
  </ul>
</section>
<!-- /.sidebar -->