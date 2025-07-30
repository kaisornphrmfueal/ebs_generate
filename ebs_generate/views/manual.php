<?php
//echo "--".$_POST['btnNormalSubmit2'];
	if(!empty($_POST['button'] )&& $_POST['button']=="Submit"){

		$pcust=$_POST['hcust'];
				//selectMaxgroup()
				
	 	 $sqlg="INSERT INTO ".DB_DATABASE.".ebs_group_order SET 
				id_customer_master='$pcust',status_group='Manual',
				emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
		$qrg=mysqli_query($con, $sqlg);

		$groupig=selectMaxgroup($user_login);
		log_hist($user_login,'Manual','ebs_group_order',$groupig);
		for($i=1;$i<=$_POST['lastid'];$i++){
					//alert($_POST['txtRow6'.$i]);
				if(!empty($_POST['txtRow'.$i])){
					
				$csql="INSERT INTO ".DB_DATABASE.".ebs_order_original SET 
						group_id='$groupig', id_destination='".$_POST['txtRow6'.$i]."', order_no='".$_POST['txtRow'.$i]."',
						delivery_date='".convDate4($_POST['txtRow3'.$i])."',cpo_date='".convDate4($_POST['txtRow2'.$i])."', item_no=$i,
						customer_part_no='".$_POST['txtRow5'.$i]."', delivery_qty='".$_POST['txtRow4'.$i]."', 
						status_insert=0, emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
				$cqr = mysqli_query($con, $csql);
				}//if(!empty($_POST['txtRow'.$i])){
				if($cqr){
					$idmg=base64_encode('confirm_manual')."&cidg=$groupig&cusid=$pcust";//&idest=31
				gotopage("index.php?id=$idmg");
				}//if($cqr){
				
					
			}//	for($i=1;$i<=$_POST['lastid'];$i++){
		
	}//	if(!empty($_POST['button'] )&& $_POST['button']=="Submit"){
	
	
	
	
	
	
	
	


?>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script language="javascript">

<?php 
 $strSQL = "SELECT id_destination,ship_name
			FROM ".DB_DATABASE.".ebs_customer_destination
			WHERE id_master = '".$_GET['smid']."' ";
$objQuery = mysqli_query($con, $strSQL);

?>
	
	function fncCreateSelectOption(ele)
		 { 
		var objSelect = ele;
			var Item = new Option("", ""); 
			//objSelect.options[objSelect.length] = Item;
			<?php
			while($objResult = mysqli_fetch_array($objQuery))
			{
			?>
			var Item = new Option("<?=$objResult["ship_name"];?>", "<?=$objResult["id_destination"];?>"); 
			
				objSelect.options[objSelect.length] = Item;
			
			<?php
			}
			?>
			
			
			
			
		}
</script>
<script src="<?=HTTP_SERVER.DIR_PAGE.DIR_JAVA?>rows.js" type="text/javascript"></script>


 
<div class="body_resize" align="center"  > 
<?php		
	  $custid=$_GET['smid'];
	// $custid=base64_decode($_GET['cid']);
?>
<br/>

<div align="center"><span class="Arial_14_red"><?php echo selectCustN($custid)?></span> Manual Input Orders</div>
<form name="form1"  id="form1"method="post" action="" onsubmit='return validateRow(this)'> 
<table width="947px" border="1" id="tblSample" class="table01" align="center">


    <th width="6%" height="35">No.</th>
    <th width="22%">Order No<br/></th>
    <th width="11%">CPO Date<br/>
      (dd-mm-yyyy) </th>
    <th width="9%">Delivery Date<br/>
      (dd-mm-yyyy) </th>
    <th width="7%">Order Qty.</th>
    <th width="29%">Customer Part no.</th>
    <th width="16%">Plant </th>
    </tr>
   <tr  align="center">
    <td height="26">1</td>
    <td><input type="text" name="txtRow1"
     id="txtRow1" size="30" onKeyPress="keyPressTest(event, this);"   /></td>
    <td>
      <input type="text" name="txtRow21"
     id="txtRow21" size="15" onKeyPress="keyPressTest(event, this);"  onKeyUp="autoTab(this)" />
    </td>
    <td>  <input type="text" name="txtRow31"
     id="txtRow31" size="15" onKeyPress="keyPressTest(event, this);"  onKeyUp="autoTab(this)" /></td>
    <td><input type="text" name="txtRow41"
     id="txtRow41" size="15" onKeyPress="keyPressTest(event, this);" /></td>
    <td><input type="text" name="txtRow51"
     id="txtRow51" size="40" onKeyPress="keyPressTest(event, this);" /></td>
    <td>
       <select name="txtRow61" id="txtRow61" >
    <?php
		 $sqlsel = "SELECT id_destination,ship_name
					FROM lgt_ebs_generate.ebs_customer_destination
					WHERE id_master = '".$_GET['smid']."' ";
		 $qrsel = mysqli_query($con, $sqlsel);
		 while($rssel=mysqli_fetch_array($qrsel)){
			 echo "<option value='".$rssel['id_destination']."'>".$rssel['ship_name']."</option>";
		 }
		 
	?>
 
     		 
    </select>
    
    </td>
    </tr>
</table>

<input type="button" value="Add" onclick="addRowToTable();" />
<input type="button" value="Remove" onclick="removeRowFromTable();" />
<input type="Submit" name="button" id="button" value="Submit"  />


<input type="hidden" name="lastid" id="lastid" value="">
<input type="hidden" name="hcust" id="hcust" value="<?=$custid?>">
</form>
</div>