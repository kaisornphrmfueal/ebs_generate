<?php
error_reporting(0);
    include("../../systems/connect.in.php");
 	include("../admin/chk_session.php");

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
		$id_tour=$_GET['id_tour'];	
	              $sql1 = "SELECT mail_user,d_mail,final_date,id_user ,name ,id_em_ref ,title, status_ref,site ,id_tour,to_date  FROM tour,jp_user 
						WHERE tour.id_em_ref=jp_user.id_em 
						and tour.id_user_ref=jp_user.id_user
						and a_flag=0 
						and del=0
						and id_tour=$id_tour
						GROUP BY  id_tour
						order by final_date ASC ";
				$result1 = mysql_query($sql1);
				$rs2=mysql_fetch_array($result1);
				
				$id_em=$rs2['id_em_ref'];
				
				$sql3="select title,name,id_em,mail_user 
							from jp_user 
							where id_em='$id_em' ";
				$result3=mysql_query($sql3);
				$rs3=mysql_fetch_array($result3);
				
	
	
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
	$mail->Body = $rs2['title'].$rs2['name']."<br><br>"."1111".$rs3['title'].$rs3['name'];

	$mail->AddAddress($rs3['mail_user'], $rs3['title'].$rs3['name']); // to Address
	
			

//	$mail->AddAttachment("new.txt");
	//$mail->AddAttachment("thaicreate/myfile2.zip");

	//$mail->AddCC("member@thaicreate.com", "Mr.Member ThaiCreate"); //CC
	//$mail->AddBCC("member@thaicreate.com", "Mr.Member ThaiCreate"); //CC
	

	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low


	$mail->Send(); 
	
			if($mail)
							{
											$d_mail = date("Y-m-d");
											
													
											$sql= "UPDATE tour SET d_mail = '$d_mail' WHERE id_tour = '$id_tour'";
										//	$result =mysql_query($sql);
													alert("Send Mail complete.");
													gotopage ("../send_mail.php");
										}else{
												alert("Error");
												gotopage ("../send_mail.php");
							}//end 		if($sendM){
	
	//gotopage("../admin/send_mail.php")
		
			
?>

</body>
</html>
