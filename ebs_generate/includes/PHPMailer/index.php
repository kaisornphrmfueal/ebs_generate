<?PHP
require("class.phpmailer.php");
$mail = new PHPMailer();

$body = "ทดสอบการส่งอีเมล์ภาษาไทย UTF-8 ผ่าน SMTP Server ด้วย PHPMailer.";

$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->Host = "localhost"; // SMTP server
$mail->Port = 25; // พอร์ท
$mail->Username = "root"; // account SMTP
$mail->Password = "1234"; // รหัสผ่าน SMTP

$mail->SetFrom("korn@yourdomain.com", "korn");
$mail->AddReplyTo("naruemon@fttl.ten.fujitsu.com", "korn");
$mail->Subject = "ทดสอบ PHPMailer.";

$mail->MsgHTML($body);

$mail->AddAddress("rnaruemon@fttl.ten.fujitsu.com", "recipient1"); // ผู้รับคนที่หนึ่ง
//$mail->AddAddress("recipient2@somedomain.com", "recipient2"); // ผู้รับคนที่สอง

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>