<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <base href="<?php echo base_url()?>" ></base>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สำนักโรคจากการประกอบอาชีพ และสิ่งแวดล้อม</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
    	$(document).ready(function(){
    		
    		$("button[data-user-id]").click(function(){
    			var id = $(this).attr("data-user-id");
    			var username = $("span[data-user-id="+id+"]").html();
    			var target_user = window.parent.document.getElementById("username");
    			var target_id = window.parent.document.getElementById("user_id");
    			$(target_user).val(username);
    			$(target_id).val(id);
        		parent.$.fancybox.close();
    		})
    		
    	})
    </script>

</head>

<body>
	
<table class="table table-bordered table-hover table-responsive table-striped" >
	<thead>
		<tr>
			<th>ชื่อผู้ใช้งาน</th>
			<th style="width: 60px;" >เพิ่ม</th>
		</tr>
	</thead>
	<?php foreach ($variable as $key => $value):?>
	<tr>
		<td><span data-user-id="<?php echo $value->id?>" ><?php echo $value->username?></span></td>
		<td><button type="button" class="btn btn-default" data-user-id="<?php echo $value->id?>" ><span class="glyphicon glyphicon-plus"></span></button></td>
	</tr>
	<?php endforeach?>
</table>

</body>

</html>