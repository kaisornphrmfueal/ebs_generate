<?PHP
require("class.phpmailer.php");
$mail = new PHPMailer();

$body = "���ͺ����������������� UTF-8 ��ҹ SMTP Server ���� PHPMailer.";

$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->Host = "localhost"; // SMTP server
$mail->Port = 25; // ����
$mail->Username = "root"; // account SMTP
$mail->Password = "1234"; // ���ʼ�ҹ SMTP

$mail->SetFrom("korn@yourdomain.com", "korn");
$mail->AddReplyTo("naruemon@fttl.ten.fujitsu.com", "korn");
$mail->Subject = "���ͺ PHPMailer.";

$mail->MsgHTML($body);

$mail->AddAddress("rnaruemon@fttl.ten.fujitsu.com", "recipient1"); // ����Ѻ�����˹��
//$mail->AddAddress("recipient2@somedomain.com", "recipient2"); // ����Ѻ������ͧ

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>