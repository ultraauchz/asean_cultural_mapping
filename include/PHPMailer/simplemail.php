<?
$send_to = "t_auchz@hotmail.com ";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers.= "Content-Type: text/html; charset=tis-620"."\r\n"; 
$headers .= "From: ultraauchz@gmail.com\r\n";

$subject = "ได้ป่าวหว่า!";



$message="Thanks for your interest in Thailand Delight<br>
<br>
ทดสอบ ขอบคุณมาก
<br>
";		  
			mail($send_to,$subject,$message,$headers);	
?>
