<?php
error_reporting(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?php
	require_once('class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // enable SMTP authentication
	
    		$mail->SMTPSecure = ''; // กำหนดเป็น ssl ถ้าต้องการใช้ (Server ต้องรองรับโรโตคอลนี้)
            $mail->Host = '172.16.128.19'; // mail.fttl.ten.fujitsu.com   mail server ถ้าเป็นบน server ตัวเอง ใช้ localhost (default)
            $mail->Port = '25'; // กำหนด mail port ถ้าไม่สามารถใช้ค่า (default 25)
	
	
	   		$mail->Username = 'naruemon@fttl.ten.fujitsu.com'; // ชื่อและรหัสผ่านบน mail  server ของคุณ
            $mail->Password = 'GdElyL3'; // ชื่อและรหัสผ่านบน mail  server ของคุณ
	
			$mail->From = "naruemon@fttl.ten.fujitsu.com"; // "name@yourdomain.com";
			$mail->AddReplyTo = "naruemon@fttl.ten.fujitsu.com"; // Reply
	$mail->FromName = "Ms.Naruemon  Bootlakorn";  // set from Name
	$mail->Subject = "90 Days Notification"; 
	$mail->Body = "My Body & <b>My Description</b>";

	$mail->AddAddress("naruemon@fttl.ten.fujitsu.com", "MsNaruemon"); // to Address
	

//	$mail->AddAttachment("new.txt");
	//$mail->AddAttachment("thaicreate/myfile2.zip");

	//$mail->AddCC("member@thaicreate.com", "Mr.Member ThaiCreate"); //CC
	//$mail->AddBCC("member@thaicreate.com", "Mr.Member ThaiCreate"); //CC

	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

	$mail->Send(); 
?>

</body>
</html>
