
<?
//echo "==".$_POST['btnhid'];
if($_POST['btnhid']=="Save"){
//idcus

		   $sqli="INSERT INTO ".DB_DATABASE.".ebs_part_master SET 
				fttl_part='".$_POST['fttlpart']."', customer_part='".$_POST['custpart']."', description='".$_POST['desc']."', 
				pass_thru_status=".$_POST['spass'].", emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";        
			$qri=mysql_query($sqli);
			if($qri){
				$idpart= selectMaxModel($user);
				log_hist($user_login,'Add','ebs_part_master',$idpart);
				go_page_opener("?msg=true");
				}else{
						alert("Can't save data, plasw try again.");
				}
		
	}else if($_POST['btnhid']=="Update"){
		$idp=$_POST['hidm'];
		  $sqli="UPDATE  ".DB_DATABASE.".ebs_part_master SET fttl_part='".$_POST['fttlpart']."', 
				customer_part='".$_POST['custpart']."', description='".$_POST['desc']."', pass_thru_status='".$_POST['spass']."', 
				emp_update='$user_login', date_update='".date('Y-m-d H:i:s')."' WHERE id_part='".$idp."'";
		$qri=mysql_query($sqli);
		if($qri){
			
			log_hist($user_login,'Update','ebs_part_master',$idp);
			go_page_opener("?msg=true");
			}else{
					alert("Can't update data, plase try again.");
				}
		
		}

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/JavaScript">
function validate(form2) {
	if(document.form2.fttlpart.value == ""){
			alert("Please input FTTL part no.");
			document.form2.fttlpart.focus();
			return (false);
	}else if(document.form2.custpart.value == ""){
			alert("Please input Customer part no.");
			document.form2.custpart.focus();
			return (false);
	}else{  
			form2.button.disabled = true;  
			form2.button.value = 'Adding...';  
			return true;  
			}


}///function validate(form) {

</script>
<?
$idg=$_GET['ide'];
if(!empty($idg)){
 $sql="SELECT id_part,fttl_part,customer_part,description,pass_thru_status
		FROM  ".DB_DATABASE.".ebs_part_master
		WHERE id_part='".$idg."'";
$qr = mysql_query($sql);
$rs=mysql_fetch_array($qr);

}


		?>

 <form id="form2" name="form2" method="post" action=""  onsubmit='return validate(this)' autocomplete="off">
<table width="98%"  border="1" class="table01" align="center">
  <tr>
    <th height="27" colspan="2">Manage Model Master</th>
  </tr>
  <tr>
    <td width="337" height="25"><div class="tmagin_left">FTTL Model No. :</div></td>  
    <td width="780"><div class="tmagin_right">
      <input type="text" name="fttlpart" id="fttlpart" size="45" value="<?=$rs['fttl_part']?>"/>
      <span class="Arial_14_red">*</span></div></td>
  </tr>
   <tr>
    <td width="337" height="25"><div class="tmagin_left">Customer model No. :</div></td>  
    <td width="780"><div class="tmagin_right">
      <input type="text" name="custpart" id="custpart" size="45" value="<?=$rs['customer_part']?>"/>
   <span class="Arial_14_red">*</span> </div></td>
  </tr>
  <tr> 
    <td width="337" height="25"><div class="tmagin_left">Description  :</div></td>
    <td width="780"><div class="tmagin_right">
      <textarea name="desc" id="desc" cols="40" rows="3"><?=$rs['description']?></textarea>
      </div></td>
  </tr>
    <tr>
    <td width="337" height="25"><div class="tmagin_left">Customer model No. :</div></td>  
    <td width="780"><div class="tmagin_right">
      <select name="spass" id="spass">
        <option value="0"<? if($rs['pass_thru_status']==0){ echo "selected='selected'";}?> >FTTL_FG_DOMESTIC</option>
        <option value="1"<? if($rs['pass_thru_status']==1){ echo "selected='selected'";}?> >FTTL_FG_PASS_THRU</option>
      </select>
    </div></td>
  </tr>
    <td height="25" colspan="2" align="center">
 
        	<?php if(empty($idg) ){
							echo "<input id='button'  name='button' type='submit' value='Save' />";
							echo "<input id='btnhid'  name='btnhid' type='hidden' value='Save' />";
				}else{
						
							echo "<input id='button'  name='button' type='submit' value='Update' />";
							echo "<input id='btnhid'  name='btnhid' type='hidden' value='Update' />";
							    echo "<input type='hidden' name='hidm' id='hidm'  value='$idg' />";
							//echo $idg;
					}?> 
    


      <input type=button value="Close" onclick="javascript:window.close();" /></td>
  </tr>
</table>
 </form>  
 