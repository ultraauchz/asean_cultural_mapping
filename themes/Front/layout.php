<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo site_url(); ?>" />
	<title><?php echo $template['title']; ?></title>
	<?php echo $template['metadata']; ?>
	<?php include_once '_meta.php'; ?>
</head>
<body>
    <div id="wrap1">
      
      	<?php include_once '_header.php';?>
    </div>
<!--------------------------------------------------------END wrap1------------------------------------------------------->
      	<?php include_once '_top_menu.php';?>
		<div class="clear">&nbsp;</div>
		<div id="wrap2">
			<?php include_once '_left_panel.php';?>		      
      	
      		<?php echo $template['body']; ?>
      		<div class="clear">&nbsp;</div>
        </div>              	
        
        <?php include_once '_footer.php'; ?>                                                 
</body>
</html>