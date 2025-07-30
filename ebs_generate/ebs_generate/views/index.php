<?php require('../includes/template_top.php'); ?>


<div class="body_resize"> 

<?php 
//echo "==".selectStatus($user_login);

	if(!empty($_GET['id'])){
		 require(base64_decode($_GET['id']).".php"); 
	}elseif(!empty($_GET['cid'])){
		 require(base64_decode($_GET['cid']).".php");
	}else{
		 require("generate.php"); 
	}
		
			//require("imports.php"); 
		
	

?>
</div>

<?php require('../includes/template_bottom.php'); ?>