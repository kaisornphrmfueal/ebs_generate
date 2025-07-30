<?php
//echo "--".$_POST['btnSubmit'];

	if(!empty($_POST['btnSubmit']) AND $_POST['btnSubmit']=="Submit"){
			
		$uploads_dir = 'uploads';	
		$pcus=$_POST['hcust'];
		@$dest=$_POST['hdesc']; 
		  $name= $_FILES["fileCSV"]["name"];
		 $tmp_name= $_FILES["fileCSV"]["tmp_name"];
		$_FILES["fileCSV"]["type"];
		  $txt_type=substr($name, -3,3); 
		if(!empty($tmp_name)){
				if ($txt_type=="txt"){
					$tsub="|";//\t
					$newname= date("ymdHis").".txt";
				}else{
					$tsub = "|";
					$newname= date("ymdHis").".htm";
				}

		copy($tmp_name,"$uploads_dir/$newname") ;
		 $objCSV = fopen("$uploads_dir/$newname", 'r');
			
		//selectMaxgroup()
	 	  $sqlg="INSERT INTO ".DB_DATABASE.".ebs_group_order SET 
				id_customer_master='$pcus',id_destination='$dest' , file_name='$newname',status_group='Import',
				emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
		$qrg=mysqli_query($con, $sqlg);
		
	//	echo "==".$tsub;
		$groupig=selectMaxgroup($user_login);
		log_hist($user_login,'Import','ebs_group_order',$groupig);
			
			
			while (($objArr = fgetcsv($objCSV,2000, $tsub)) !== FALSE) {  //\t
			//echo "--".$objArr[0]. "--";
				
				//print_r($objArr);
			if(!empty($objArr[8])){
				@$daten3=convDate3($objArr[47]);
				@$datecpo=convDate3($objArr[54]);
				
			$npname=addslashes($objArr[39]);
			  @$csql="INSERT INTO ".DB_DATABASE.".ebs_order_original SET  group_id='$groupig',invoice_no='".$objArr[9]."',id_destination='',
					order_no='".$objArr[8]."', customer_name='".$objArr[5]."', plant_name='".$objArr[6]."', delivery_date='".$daten3."',
					delivery_time='".$objArr[48]."', cpo_date='".$datecpo."', item_no='".$objArr[37]."', 
					customer_part_no='".$objArr[38]."', part_name='".$npname."',
					dock_code='".$objArr[58]."', delivery_qty='".$objArr[43]."', qty_box='".$objArr[42]."', packing_type='".$objArr[59]."',supp_code='".$objArr[1].$objArr[2]."',
					status_insert=2, emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
					
				$cqr = mysqli_query($con, $csql);
				
			  }//	if(!empty($objArr[8])){
			}//while (($objArr = fgetcsv($objCSV,$chunksize, ",")) !== FALSE) {
//echo $csql;
			fclose($objCSV);
				if($objCSV){
					$idmg=base64_encode('confirm_import_formula')."&cidg=$groupig&cusid=$pcus";//&idest=31
					gotopage("index.php?id=$idmg");
					//alert("dddd");
				}else{
					alert("Can't upload data, please try again.");		
					}//if($objCSV){
						
		}//if(!empty($tmp_name)){
		
	
	}


?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">


function Checkdata1() {
type_file = document.getElementById('fileCSV').value;
length_file = document.getElementById('fileCSV').value.length;
file_name = type_file;

	 if (type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="txt"  &&  type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="htm")
	{
		alert( 'For .txt and .htm file Only' );
		/*document.getElementById('fileCSV').innerHTML ="";*/	
		return (false);
		}else{
		document.getElementById('fileCSV').innerHTML ="<img src='"+file_name+"'><br>";
		return (true) ;
	}

}
</script>
<div class="body_resize"  align="center"> 
<?php
	 // $custid=base64_decode($_GET['cid']);//1_cal.php
	 $custid="1";
?>
    <br/> <br/>
    		Download Format to import  file ::  <?php echo "<a target='_blank' href=exp/htm.htm >Exp. htm File</a>";?> || 
             <?php echo "<a target='_blank' href=exp/txt.txt >Exp. text File</a>";?>
   <br/> 
     <br/>
    		<form id="form1"  name="form1"enctype="multipart/form-data" method="post" action=""  onSubmit="JavaScript:return Checkdata1();">        
                 <table width="540" border="1"  class="table01" >
                     <tr>
                       <th height="28" colspan="2"><span class="Arial_14_red">TOYOTA </span> Order Import 
						   <span class="Arial_14_red">(Generate by Formula  Calculation) </span> </th>
                     </tr>
                     <tr>
                       <td width="208" height="25"><div class="tmagin_left">File import ::</div></td>
                       <td width="316"><div class="tmagin_right"><input type="file" name="fileCSV" id="fileCSV"  /></div></td>
                     </tr>
                     <tr>
                       <td colspan="2" align="center">
                       <input type="submit" name="btnSubmit"  id="btnSubmit" value="Submit" />
                        <input type="hidden" name="hcust" id="hcust"  value="<?=$custid?>"/></td>
                     </tr>
                  </table>
    		</form>

</div>
