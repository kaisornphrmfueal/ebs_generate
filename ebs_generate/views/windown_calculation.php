
<?php
//echo "==".$_POST['btnhid'];
if(!empty($_POST['btnhid']) AND $_POST['btnhid']=="Save"){
//idcus  

		    $sqli="INSERT INTO ".DB_DATABASE.".ebs_formula_cal SET 
						supplier_code='".$_POST['sup_code']."', car_plant='".$_POST['c_plant']."',
						dock_code='".$_POST['doc_code']."', id_destination=".$_POST['plant_select'].",
						emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";        
			$qri=mysqli_query($con, $sqli);
			if($qri){
				$idpart= selectMaxModel($user);
				log_hist($user_login,'Add','ebs_formula_cal',$idpart);
				go_page_opener("?msg=true");
				}else{
						alert("Can't save data, plasw try again.");
				}
		
	}else if(!empty($_POST['btnhid']) AND  $_POST['btnhid']=="Update"){
		$idp=$_POST['hidm'];
		  $sqli="UPDATE  ".DB_DATABASE.".ebs_formula_cal SET 
		  		supplier_code='".$_POST['sup_code']."', car_plant='".$_POST['c_plant']."',
						dock_code='".$_POST['doc_code']."', id_destination=".$_POST['plant_select'].",
				emp_update='$user_login', date_update='".date('Y-m-d H:i:s')."' WHERE id_formula='".$idp."'";
		$qri=mysqli_query($con, $sqli);
		if($qri){
			
			log_hist($user_login,'Update','ebs_formula_cal',$idp);
			go_page_opener("?msg=true");
			}else{
					alert("Can't update data, plase try again.");
				}
		
		}

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/JavaScript">
function validate(form2) {    
	if(document.form2.sup_code.value == ""){
			alert("Please input Supplier code");
			document.form2.sup_code.focus();
			return (false);
	}else if(document.form2.c_plant.value == ""){
			alert("Please input Car Plant");
			document.form2.c_plant.focus();
			return (false);
	}else if(document.form2.doc_code.value == ""){
			alert("Please input Dock Code");
			document.form2.doc_code.focus();
			return (false);
	}else if(document.form2.plant_select.value == ""){
			alert("Please select Plant (Destination) ");
			document.form2.plant_select.focus();
			return (false);
	}else{  
			form2.button.disabled = true;  
			form2.button.value = 'Adding...';  
			return true;  
			}


}///function validate(form) {

</script>
<?php

if(!empty($_GET['ide'])){
	$idg=$_GET['ide'];
  $sql="SELECT id_formula,supplier_code,car_plant,dock_code,id_destination
		FROM  ".DB_DATABASE.".ebs_formula_cal
		WHERE id_formula='".$idg."' ORDER BY supplier_code";
$qr = mysqli_query($con, $sql);
$rs=mysqli_fetch_array($qr);
$rs_forc=$rs['id_formula'];
$rs_dest=$rs['id_destination'];
}


		?>

 <form id="form2" name="form2" method="post" action=""  onsubmit='return validate(this)' autocomplete="off">
<table width="98%"  border="1" class="table01" align="center">
  <tr>
    <th height="27" colspan="2">Manage  Formula Calculation</th>
  </tr>
     <tr>
    <td width="337" height="25"><div class="tmagin_left">Supplier code  :</div></td>
    <td width="780"><div class="tmagin_right">
      <input type="text" name="sup_code" id="sup_code" size="45" value="<?php if(!empty($rs['supplier_code'])){echo $rs['supplier_code'];}?>"/>
   <span class="Arial_14_red">*</span> </div></td>
  </tr>
  <tr>
    <td width="337" height="25"><div class="tmagin_left">Car Plant. :</div></td> 
    <td width="780"><div class="tmagin_right">
      <input type="text" name="c_plant" id="c_plant" size="45" value="<?php if(!empty($rs['car_plant'])) {echo $rs['car_plant'];}?>"/>
      <span class="Arial_14_red">*</span></div></td>
  </tr>

  <tr> 
    <td width="337" height="25"><div class="tmagin_left">Dock Code :</div></td> 
    <td width="780"><div class="tmagin_right">
      
        <input type="text" name="doc_code" id="doc_code" size="45" value="<?php if(!empty($rs['dock_code'])){echo $rs['dock_code'];}?>"/>
    
        <span class="Arial_14_red">*</span></div></td>
  </tr>
   
    <tr>
    <td width="337" height="25"><div class="tmagin_left">Plant (Customer ship to)  :</div></td>  
    <td width="780"><div class="tmagin_right"><select name="plant_select" id="plant_select" > 
        <option value="">Please Plant (Customer ship to)</option>
         

        <?php
        $sql_pl= "SELECT id_destination,ship_name FROM ".DB_DATABASE.".ebs_customer_destination
					WHERE id_master = '1'  ";
        $qr_pl = mysqli_query($con, $sql_pl);
        
			while ($re_pl = mysqli_fetch_array($qr_pl)) {
				$rsplid=$re_pl['id_destination'];
				$rspln=$re_pl['ship_name'];
				
			if($rsplid == $rs_dest){ $selct="selected='selected' "; }else{ $selct="";}
			echo "<option value=\"$rsplid\" $selct>$rspln</option>";
			}
		
		
        ?>
		
        </select>
        <span class="Arial_14_red">* <?php //echo $rsplid ."==". $rs_dest.$selct;?></span></div></td>
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
 