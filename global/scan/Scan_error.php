<?php
include ("class.phpmailer.php");
$mail = new PHPMailer();
if(!isset($path))
$path = 'C:\xampp\apache\logs\error.log';
$result = touch($path);
if($result){
  //doc noi dung file log error
  $data = file_get_contents($path);
  //xoa du lieu trong file log error
  file_put_contents($path,'');
}
$mail->setMail('smtp'); // smtp | mail (ham mail trong PHP), default: mail 

$mail->Host = "smtp.gmail.com"; // 
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; // ssl hoac tls, neu su dung tls thi $mail->Port la: 587
$mail->Username = "mem.mccorp@gmail.com"; // tai khoan dang nhap de gui email 
$mail->Password = "minhchaugame@123";            // mat khau gui email

$mail->From = "mem.mccorp@gmail.com"; // email se duoc thay the email trong smtp
$mail->AddReplyTo("mem.mccorp@gmail.com");  // email cho phep nguoi dung reply lai
$mail->FromName = "System log"; // ho ten nguoi gui email

$mail->WordWrap = 50; 
$mail->IsHTML('text/html');     //text/html | text/plain, default:text/html 

$mail->AltBody = "Send from iTNET class_smtp_mail"; //Text Body

$mail->Body = $data; //HTML Body
$mail->Subject = "Notification";
$mail->AddAddress("kietva@mc-corp.vn"); // email nguoi nhan

$mail->Send();
$mail->ClearAddresses();

?>