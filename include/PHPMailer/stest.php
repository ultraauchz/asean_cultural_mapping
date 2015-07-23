<?
?>
<?PHP
require("class.phpmailer.php");  // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path
$attachments = array();
?>
<form name="sed" enctype="multipart/form-data" method="post" >
	<input type="file" name="images[]" /><br />
    <input type="file" name="images[]" /><br />
	<input type="submit" name="submit"  value="submit"/>
</form>
<?
if($_POST['submit']!=''){
	$email = array("unisexx@hotmail.com" => "DEAR","t_auchz@hotmail.com" => "AUT","clinton_toey@hotmail.com" => "TOEY");
//	$email = array("ultraauchz@gmail.com" => "DEAR","t_auchz@hotmail.com" => "AUT");
	$subject = " TEST WITH ATTACH ";
	$body = " ทดสอบ ทดสอบ ";
	if($_FILES[images]!=''){
		$attachments =  uploadFile();
		smtpmail($email,$subject,$body,$attachments);
	}else{
	smtpmail($email,"TEST","TSET",$attachments);
	}
}
//
//------Check TYPE------\\
function checkType() {
while(list($key,$value) = each($_FILES[images][type])){
strtolower($value);
/*if($value != "image/jpeg" AND $value != "image/pjpeg" AND $value != "") {
exit('Sorry , current format is <b>'.($value).'</b> ,only Jpeg or jpg are allowed.') ;
}*/
}
//
checkSize();
//
}
//-------END OF Check TYPE--------\\
//
//---CheckSizeFunction ---\\
function checkSize(){
while(list($key,$value) = each($_FILES[images][size]))
{
$maxSize = 5000000;
if(!empty($value)){
if ($value > $maxSize) {
echo"Sorry this is a very big file .. max file size is $maxSize Bytes = 5 MB";
exit();
}
else {
$result = "File size is ok !<br>";
//
}
//
}
//
}
uploadFile();
//
}
//-------END OF Check Size--------\\
//
//==============upload File Function============\\
//
function uploadFile() {
global $attachments;
while(list($key,$value) = each($_FILES[images][name]))
{
//
if(!empty($value))
{
$filename = $value;
//the Array will be used later to attach the files and then remove them from server ! 
array_push($attachments, $filename);
$dir = "uploaded/$filename";
$success = copy($_FILES[images][tmp_name][$key], $dir);
}
//
}
//
if ($success) {
echo " Files Uploaded Successfully<BR>";

//
}else {
exit("Sorry the server was unable to upload the files...");
}
return $attachments;
//
}


function smtpmail( $email , $subject , $body,$attachments )
{
    $mail = new PHPMailer();
    $mail->IsSMTP();         
      $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้                        
//	$host = "10.10.10.60";
//    $port = "25";
//    $mail->Username = "crmsupport@m-society.go.th";   //  account e-mail ของเราที่ต้องการจะส่ง
//    $mail->Password = "spiderman";  //  รหัสผ่าน e-mail ของเราที่ต้องการจะส่ง
	$host = "ssl://smtp.gmail.com";
    $port = "465";
    $mail->Host     = $host;
	$mail->Port = $port;
    $mail->SMTPAuth = true;     //  เลือกการใช้งานส่งเมล์ แบบ SMTP
    $mail->Username = "ultraauchz@gmail.com";   //  account e-mail ของเราที่ต้องการจะส่ง
    $mail->Password = "Aut02051982";  //  รหัสผ่าน e-mail ของเราที่ต้องการจะส่ง

    $mail->From     = "ultraauchz@gmail.com";  //  account e-mail ของเราที่ใช้ในการส่งอีเมล
    $mail->FromName = "บร๊ะเจ้า"; //  ชื่อผู้ส่งที่แสดง เมื่อผู้รับได้รับเมล์ของเรา
	
		$recipients = $email;
		foreach($recipients as $email => $name)
		{
		   $mail->AddAddress($email, $name);
		}
    $mail->IsHTML(true);                  // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
    $mail->Subject     = $subject;        // หัวข้อที่จะส่ง(ไม่ต้องแก้ไข)
    $mail->Body     = $body;                   // ข้อความ ที่จะส่ง(ไม่ต้องแก้ไข)
	//now Attach all files submitted
	foreach($attachments as $key => $value) { //loop the Attachments to be added ...
	$mail->AddAttachment("uploaded"."/".$value);
	}

	if(!$mail->Send())
	{
	echo "Message was not sent <p>";
	echo "Mailer Error: " . $mail->ErrorInfo;
	exit;
	}
	//
	echo "Message has been sent";
	// after mail is sent with attachments , delete the images on server ...
	foreach($attachments as $key => $value) {//remove the uploaded files ..
	unlink("uploaded"."/".$value);
	}


//     $result = $mail->send();       
     return $result;
}


?>