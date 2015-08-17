<?php
$CI =& get_instance();
$current_menu = new Menu();
$current_menu->where("id",$menu_id)->get(1);
$CI->load->model('Menu','menu');
$main_menu = $CI->menu->where("parent_id = 0 and show_state='y'")->order_by('order_no','asc')->get();
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
    foreach($main_menu as $key => $mitem):
		if($mitem->have_child =='y'){    
   	?>
    <li class="treeview <?php if(@$current_menu->id ==$mitem->id || @$current_menu->parent_id == $mitem->id){echo 'active';}?>">
      <a href="#">
        <i class="fa fa-files-o"></i>
        <span><?=$mitem->title;?></span>
        <!-- notify new record-->
        <!--<span class="label label-primary pull-right">4</span>-->
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
      	<?php
      		$child_menu = $CI->menu->where("show_state = 'y' and parent_id = ".$mitem->id)->order_by('title','asc')->get();
			foreach($child_menu as $key => $citem):
				$icon = $citem->custom_icon_style !='' ? $citem->custom_icon_style : "fa-circle-o" ;
      	?>
        	<li class="<?php if(@$current_menu->id == $citem->id){echo 'active';}?>"><a href="<?php echo $citem->url;?>"><i class="fa <?php echo $icon;?>"></i> <?php echo $citem->title;?></a></li>
        <? endforeach;?>
      </ul>
    </li>
    <?php 
		}else{ 
	?>
    <li><a href="<?php echo $mitem->url;?>"><i class="fa fa-book"></i> <?php echo $mitem->title;?></a></li>
    <?php } ?>
    <?php endforeach;?>    
  </ul>
</section>
<!-- /.sidebar -->