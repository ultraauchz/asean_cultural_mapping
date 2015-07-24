<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <base href="<?php echo base_url()?>"></base>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $value->title?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    </style>

</head>

<body>
	
	<?php echo $value->detail?>
	
	<div class="row text-center" >
		<a href="<?php echo base_url()?>" >เข้าสู่เว็บไซต์</a>
	</div>
	
</body>

</html>