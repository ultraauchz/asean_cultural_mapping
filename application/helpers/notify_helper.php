<?php
if(!function_exists('set_notify'))
{
	function set_notify($type,$msg) {
		$config = array(
			'notify' => TRUE,
			'type' => $type,
			'msg' => $msg
		);
		$CI =& get_instance();
		$CI->session->set_flashdata('notify', $config);
		
	}
}

function js_notify() {
	$CI =& get_instance();
	$notify = $CI->session->flashdata('notify');
	
	if(!empty($notify['notify']))
	{
		#$js = '<link rel="stylesheet" href="js/jquery.notifyBar.css" type="text/css" media="screen" />';
	  #  $js .= '<script type="text/javascript" src="js/jquery.notifyBar.js"></script>';
	  	$js = '<script src="'.site_url().'js/notify.min.js"></script>';
	    $js .= '<script type="text/javascript">
			$(function () {
				$.notify("'.$notify['msg'].'", "'.$notify['type'].'");
			});
		</script>
		<style type="text/css">
			div.notifyjs-corner {
				display:inline-block; 
				width:100%;
			}
			div.notifyjs-wrapper{
			}
			div.notifyjs-bootstrap-base {
				border-radius:0px;
				margin:0px;
				padding:8px;
				padding-left:25px;
				
			}
		</style>';
		return $js; 
	}
}