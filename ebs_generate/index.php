<?php session_start();
 include("includes/configure.php");

 			if(!empty($_GET['log_i'])){
		 	$id=$_GET['log_i'];
 	 		$user_log=base64_decode($id);
		 }
		 $user_ip=session_id();
 		$_SESSION["user_login"] = $user_log;
		session_write_close();
		$user_login = $_SESSION["user_login"];
		echo "<META HTTP-EQUIV=refresh CONTENT=\"0; URL=".HTTP_SERVER.DIR_PAGE.DIR_VIEWS."\">";


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>EBS Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #dfdfdf;">

<div class="container mt-5" >

	<div class="card" width="50%">
	  <div class="card-body">
	  		<div class="text-center">
				<img src="images/logo.png">
				<h2>EBS Reports Login</h2>
			</div>
		  
		  <form action="" method="POST">
		    <div class="form-group">
		      <label for="usr">Username:</label>
		      <input type="text" class="form-control" name="username" required="">
		    </div>
		    <div class="form-group">
		      <label for="pwd">Password:</label>
		      <input type="password" class="form-control" name="password" required="">
		    </div>
		    <button type="submit" class="btn btn-success btn-block">Login</button>
		  </form>
	  </div>
	</div>
	
</div>

</body>
</html>
