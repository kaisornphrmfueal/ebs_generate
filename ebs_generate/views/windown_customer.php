
<?php
//echo "==".$_POST['btnhid'];
if(!empty($_POST['btnhid']) AND $_POST['btnhid']=="Save"){

		$cname = mysqli_real_escape_string($con, $_POST['cname']);
		$desc = mysqli_real_escape_string($con, $_POST['desc']);
	
		 $sqli="INSERT INTO ".DB_DATABASE.".ebs_customer_master 
				SET  company_name='$cname', customer_description='$desc', 
				 emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";        
		$qri=mysqli_query($con, $sqli);
		if($qri){
			//go_page_opener("?msg=true");
			
			$mxcis=selectMaxCust($user_login);
			log_hist($user_login,'Add','ebs_customer_master',$mxcis);
			echo "<div align='center'><span class='txt-red-m'>Add Customer Data completed!!</span> Click ";
			echo "<a href='windows.php?win=dest&idm=$mxcis'>here</a> to  Manage Customer Destination</div>";
			//gotopage("windows.php?win=dest&idm=$mxcis");	
			}else{
					alert("Can't save data, plasw try again.");
				}
		
	}else if(!empty($_POST['btnhid']) AND  $_POST['btnhid']=="Update"){
		$upud=$_POST['idcus'];
		$cname = mysqli_real_escape_string($con, $_POST['cname']);
		$desc = mysqli_real_escape_string($con, $_POST['desc']);
		
		 $sqli="UPDATE lgt_ebs_generate.ebs_customer_master SET company_name='$cname', 
				customer_description='$desc', emp_update='$user_login', date_update='".date('Y-m-d H:i:s')."' 
				WHERE id_master='$upud' ";
		$qri=mysqli_query($con, $sqli);
		if($qri){
			log_hist($user_login,'Update','ebs_customer_master',$upud);
			echo "<div align='center'><span class='txt-red-m'>Update Customer Data completed!!</span> Click ";
			echo "<a href='windows.php?win=dest&idm=$upud'>here</a> to  Manage Customer Destination</div>";
			}else{
					alert("Can't update data, plase try again.");
				}
		}

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if(!empty($_GET['ide'])){ 
$idg=$_GET['ide'];
 $sql="SELECT id_master,company_name,customer_description
 FROM ".DB_DATABASE.".ebs_customer_master WHERE id_master='".$idg."'";
$qr = mysqli_query($con, $sql);
$rs=mysqli_fetch_array($qr);

}


		?>

 <form id="form2" name="form2" method="post" action="" autocomplete="off">
<table width="98%"  border="1" class="table01" align="center">
  <tr>
    <th height="27" colspan="2">Manage Customer Master Data</th>
  </tr>
  <tr>
    <td width="337" height="25"><div class="tmagin_left">Company Name :</div></td> 
    <td width="780"><div class="tmagin_right">
      <input type="text" name="cname" id="cname" size="45" value="<?php if(!empty($rs['company_name'])){echo $rs['company_name'];}?>"/>
    </div></td>
  </tr>
  <tr>
    <td width="337" height="25"><div class="tmagin_left">Description  :</div></td>
    <td width="780"><div class="tmagin_right">
      <textarea name="desc" id="desc" cols="40" rows="3"><?php if(!empty($rs['customer_description'])){echo $rs['customer_description'];}?></textarea>
      </div></td>
  </tr>
   <tr>
    <td width="337" height="25"><div class="tmagin_left">Generate Type  :</div></td>  
    <td width="780"><div class="tmagin_right">   Manual </div></td>
  </tr>
    <td height="25" colspan="2" align="center">
 
        	<?php if(empty($idg) ){
							echo "<input id='button'  name='button' type='submit' value='Save' />";
							echo "<input id='btnhid'  name='btnhid' type='hidden' value='Save' />";
				}else{
							echo "<input id='button'  name='button' type='submit' value='Update' />";
							echo "<input id='btnhid'  name='btnhid' type='hidden' value='Update' />";
					}?>
    

      <input type="hidden" name="idcus" id="idcus" value="<?=$rs['id_master']?>"  />
      <input type=button value="Close" onclick="javascript: window.opener.location.reload();window.close();" /></td>
  </tr>
</table>
 </form>  
 