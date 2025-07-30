<?php
//echo "--".$_POST['btnNormalSubmit2'];
	if(!empty($_POST['btnNormalSubmit2']) AND $_POST['btnNormalSubmit2']=="Submit"){
			
		$uploads_dir = 'uploads';	
		$pcus=$_POST['hcust'];
		$dest=$_POST['hdesc']; 
		  $name= $_FILES["fileCSV"]["name"];
		$tmp_name= $_FILES["fileCSV"]["tmp_name"];
		$_FILES["fileCSV"]["type"];
		if(!empty($tmp_name)){
			
		$newname= date("ymdHis").".csv";
	
		copy($tmp_name,"$uploads_dir/$newname") ;
		$objCSV = fopen("$uploads_dir/$newname", 'r');
		//selectMaxgroup()
	 	   $sqlg="INSERT INTO ".DB_DATABASE.".ebs_group_order SET 
				id_customer_master='$pcus',id_destination='$dest' , file_name='$newname',status_group='Import',
				emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
		$qrg=mysqli_query($con, $sqlg);

		$groupig=selectMaxgroup($user_login);
		log_hist($user_login,'Import','ebs_group_order',$groupig);
			while (($objArr = fgetcsv($objCSV,2000, ",")) !== FALSE) {  //\t
				//echo "--". $objArr[1];
			if(!empty($objArr[0])){
			@$daten3=convDate($objArr[3]);
		$daten13= date("Y-m-d", strtotime($daten3." -2 day" ) );
			$npname=addslashes($objArr[11]);
			$npwd=addslashes($objArr[8]);
			$norder=$objArr[0]; //substr($objArr[0], 3
			       $csql="INSERT INTO ".DB_DATABASE.".ebs_order_original SET  group_id='$groupig',invoice_no='".$objArr[0]."',id_destination='$dest',
					order_no='".$norder."', customer_name='".$objArr[1]."', plant_name='".$objArr[2]."', delivery_date='".$daten3."',
					delivery_time='".$objArr[5]."', cpo_date='".$daten13."', item_no='".$objArr[6]."', 
					customer_part_no='".$objArr[7]."', pwd='".$npwd."', fttl_part_no='".$objArr[10]."', part_name='".$npname."',
					dock_code='".$objArr[12]."', delivery_qty='".$objArr[13]."', qty_box='".$objArr[14]."', 
					status_insert=1, emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
				$cqr = mysqli_query($con, $csql);
			  }//	if(!empty($objArr[10])){
				  
				  
			}//while (($objArr = fgetcsv($objCSV,$chunksize, ",")) !== FALSE) {

			fclose($objCSV);
				if($objCSV){
					$idmg=base64_encode('confirm_import')."&cidg=$groupig&cusid=$pcus";//&idest=31
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
	 if (type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="csv"  )
	{
		alert( 'For CSV file Only' );
		/*document.getElementById('fileCSV').innerHTML ="";*/	
		return (false);
		}else{
		document.getElementById('fileCSV').innerHTML ="<img src='"+file_name+"'><br>";
		return (true) ;
	}
}


</script>

<div class="body_resize"  > 
<?php
	 $custid=base64_decode($_GET['cid']);
?>

<BR/>
                        Download Format to import  CSV file ::  
						<?php echo "<a target='_blank' href=exp/GMTH.txt >Exp. GMTH  File (GMTH.csv)</a>";?>  
                        
              <br/> <br/>
                        <form id="form1"  name="form1"enctype="multipart/form-data" method="post" action=""  onSubmit="JavaScript:return Checkdata1();">        
                             <table width="540" border="1"  class="table01" >
                                 <tr>
                                   <th height="28" colspan="2"><span class="Arial_14_red"> GENERAL MOTOR (GMTH) Part</span> Order Import</th>
                                 </tr>
                                 <tr>
                                   <td width="208" height="25"><div class="tmagin_left">File import ::</div></td>
                                   <td width="316"><div class="tmagin_right"><input type="file" name="fileCSV" id="fileCSV"  /></div></td>
                                 </tr>
                                 <tr>
                                   <td colspan="2" align="center">
                                   <input type="submit" name="btnNormalSubmit"  id="btnNormalSubmit" value="Submit" />
                                   <input type="hidden" name="btnNormalSubmit2" id="btnNormalSubmit2"  value="Submit"/>
                                   <input type="hidden" name="hcust" id="hcust"  value="<?=$custid?>"/>
                                   <input type="hidden" name="hdesc" id="hdesc"  value="22"/>
                                   </td>
                                 </tr> 
                              </table>
                        </form>
			<br/>
            <img src="exp/<?php echo "gmth"?>.png"   />
     
     </div>