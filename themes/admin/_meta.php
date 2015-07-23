<base href="<?php echo site_url(); ?>" />
<meta charset="UTF-8">
<title>Siteadmin</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- Bootstrap 3.3.2 -->
<link href="themes/admin/medias/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="media/plugin/file_upload/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<link href="themes/admin/medias/css/pagination.css" rel="stylesheet" type="text/css" />        
<!-- FontAwesome 4.3.0 -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons 2.0.0 -->
<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
<!-- Theme style -->
<link href="themes/admin/medias/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<!-- AdminLTE Skins. Choose a skin from the css/skins 
     folder instead of downloading all of them to reduce the load. -->
<link href="themes/admin/medias/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<!-- iCheck -->
<link href="themes/admin/medias/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="themes/admin/medias/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="themes/admin/medias/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link href="themes/admin/medias/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="themes/admin/medias/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="themes/admin/medias/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<link href="themes/admin/medias/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<link href="themes/admin/medias/css/general.css" rel="stylesheet" type="text/css" />



<!-- jQuery 2.1.3 -->
<script src="themes/admin/medias/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="media/plugin/file_upload/js/fileinput.js" type="text/javascript"></script>
<!-- jQuery UI 1.11.2 -->
<script src="themes/admin/medias/js/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="themes/admin/medias/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
<!-- Morris.js charts -->
<script src="themes/admin/medias/js/raphael-min.js"></script>
<!--<script src="themes/admin/medias/plugins/morris/morris.min.js" type="text/javascript"></script>-->
<!-- Sparkline -->
<script src="themes/admin/medias/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="themes/admin/medias/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="themes/admin/medias/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="themes/admin/medias/plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="themes/admin/medias/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="themes/admin/medias/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="themes/admin/medias/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="themes/admin/medias/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="themes/admin/medias/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='themes/admin/medias/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="themes/admin/medias/js/app.min.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="themes/admin/medias/js/pages/dashboard.js" type="text/javascript"></script>-->

<!-- AdminLTE for demo purposes -->
<!--<script src="themes/admin/medias/js/demo.js" type="text/javascript"></script>-->

<!-- DATA TABES SCRIPT -->
<script src="themes/admin/medias/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="themes/admin/medias/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script src="themes/admin/medias/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="themes/admin/medias/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="themes/admin/medias/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		$(".datepicker").datepicker({ format: 'yyyy-mm-dd' });
		$('.btn_delete').click(function(){
			if(confirm('Delete this item?')){
				return true;
			}else{
				return false;
			}
		})
	})
</script>
<style>
	input.datepicker{
		width:90px !important;
	}
</style>