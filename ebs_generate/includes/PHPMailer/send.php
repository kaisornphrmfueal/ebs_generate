<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?
require("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host = "mail.mymail.com"; // SMTP server
$mail->From = "$email";
$mail->FormName = "$cname ($fname)";
$mail->AddAddress("dtae@mymail.com");

$mail->Subject = "Customer Contact";
$mail->Body = "$msg";
$mail->WordWrap = 50;

$send_nail = $mail->Send();
if(!$send_mail) {
echo $mail->ErrorInfo;
}
?>
</body>
</html>
