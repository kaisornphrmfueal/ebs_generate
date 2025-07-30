<? 
$user_ip=$_SESSION['user_ip'];
$id_person_login=$_SESSION['id_person_login'];
$sess_username=$_SESSION['sess_username'];


if($user_ip<>session_id() or $id_person_login == " " ){
				alert ("Please Login");
				gotopage("index.php");

				exit();
}

?>
