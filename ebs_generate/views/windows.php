<?php session_start();
include('../includes/configure.php');
include('../includes/chk_session.php');
include('../functions/function.php');

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Generate order for EBS system </title>

<link rel="stylesheet" href="<?=HTTP_SERVER.DIR_PAGE.DIR_INCLUDES.DIR_CSS?>/windows.css" type="text/css"  charset="utf-8"/>
<link rel="stylesheet" href="<?=HTTP_SERVER.DIR_PAGE.DIR_INCLUDES.DIR_CSS?>/txt.css" type="text/css"  charset="utf-8"/>


<script type="text/javascript" src="<?=HTTP_SERVER.DIR_PAGE.DIR_JAVA?>all.js"></script>
<script type="text/javascript" src="<?=HTTP_SERVER.DIR_PAGE.DIR_JAVA?>java.js"></script>

</head>
<body>
<?php
		if($_GET['win']=="addc"){
				require('windown_customer.php');
			}else if ($_GET['win']=="dest"){
				 $gid=$_GET['idm'];
				require('windown_destination.php');
			}else if ($_GET['win']=="edit"){
				 $gid=$_GET['idm'];
				require('windown_destination.php');
			}else if ($_GET['win']=="addm"){
				require('windown_model.php');
			}else if ($_GET['win']=="editm"){
				require('windown_model.php');
			}else if ($_GET['win']=="export"){
				require('windown_export.php');
			}else if ($_GET['win']=="addcal"){
				require('windown_calculation.php');
			}else if ($_GET['win']=="editcal"){
				require('windown_calculation.php');
			}
			
			
				
				
?>

</body>
</html>