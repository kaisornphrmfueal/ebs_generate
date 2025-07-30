<?
//--------------------------START 21 IMCT SERVICE ---------------------------
	if($_POST['btnsvsubmit']=="Submit"){
		//echo "--".$_POST['btnsvsubmit'];
		$uploads_dir = 'uploads';	
		$pcus=$_POST['hcust2'];
		$dest="30"; //FIX for IMCT Service
		$name= $_FILES["fileCSV2"]["name"];
		$tmp_name= $_FILES["fileCSV2"]["tmp_name"];
		$_FILES["fileCSV2"]["type"];
		if(!empty($tmp_name)){
		$newname= date("ymdHis").$name;
	
		copy($tmp_name,"$uploads_dir/$newname") ;
		$objCSV = fopen("$uploads_dir/$newname", 'r');
		//selectMaxgroup()
	 	$sqlg="INSERT INTO lgt_ebs_generate.ebs_group_order SET 
				id_customer_master='$pcus',id_destination='$dest' , file_name='$newname',status_group='Import',
				emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
		$qrg=mysql_query($sqlg);
		
		$newname= date("ymdHis").$name;
		$groupig=selectMaxgroup($user_login);
		log_hist($user_login,'Add','ebs_group_order',$groupig);
			while (($objArr = fgetcsv($objCSV,2000, "\t")) !== FALSE) {  //,
			if(!empty($objArr[10])){
			@$daten3=convDate($objArr[3]);
			$daten13= date("Y-m-d", strtotime($daten3." -2 day" ) );
			  $csql="INSERT INTO ".DB_DATABASE.".ebs_order_original SET  group_id='$groupig',invoice_no='".$objArr[0]."',id_destination='$dest',
					order_no='".$objArr[10]."', customer_name='".$objArr[1]."', plant_name='".$objArr[2]."', delivery_date='".$daten3."',
					delivery_time='', cpo_date='".$daten13."', item_no='".$objArr[5]."', 
					customer_part_no='".$objArr[6]."', pwd='".$objArr[7]."', fttl_part_no='".$objArr[8]."', part_name='".$objArr[9]."',
					dock_code='', delivery_qty='".$objArr[11]."', qty_box='".$objArr[12]."', 
					status_insert=1, emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
			  $cqr = mysql_query($csql);
			  }//	if(!empty($objArr[10])){
			
			}//while (($objArr = fgetcsv($objCSV,$chunksize, ",")) !== FALSE) {

			fclose($objCSV);
				if($objCSV){
								$idmg=base64_encode('confirm_import')."&cidg=$groupig";//&cusid=21&idest=31
					gotopage("index.php?id=$idmg");
					//alert("dddd");
				}else{
					alert("Can't upload data, please try again.");		
					}//if($objCSV){
						
		}//if(!empty($tmp_name)){
	}//if($_POST['btnsvsubmit']=="Submit"){
		

	if($_POST['btnNormalSubmit']=="Submit"){
		echo "----".$_POST['btnNormalSubmit'];
	
		$uploads_dir = 'uploads';	
		$pcus=$_POST['hcust'];
		$pdesc=$_POST['hdesc'];
		$name= $_FILES["fileCSV2"]["name"];
		$tmp_name= $_FILES["fileCSV2"]["tmp_name"];
		$_FILES["fileCSV2"]["type"];
		if(!empty($tmp_name)){
		$newname= date("ymdHis").$name;
	
		copy($tmp_name,"$uploads_dir/$newname") ;
		$objCSV = fopen("$uploads_dir/$newname", 'r');
		//selectMaxgroup()
	 	$sqlg="INSERT INTO lgt_ebs_generate.ebs_group_order SET 
				id_customer_master='$pcus',id_destination='$dest' , file_name='$newname',status_group='Import', 
				emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
		$qrg=mysql_query($sqlg);
		
		$newname= date("ymdHis").$name;
		$groupig=selectMaxgroup($user_login);
		log_hist($user_login,'Add','ebs_group_order',$groupig);
			while (($objArr = fgetcsv($objCSV,2000, "\t")) !== FALSE) {  //,
			if(!empty($objArr[0])){
			@$daten3=convDate($objArr[2]);
			$npart=substr($objArr[2], 0, 6)."-".substr($objArr[2], -4);  ;
			$daten13= date("Y-m-d", strtotime($daten3." -2 day" ) );
			$ntime=sprintf("%04d", $objArr[6]);
			$newtime=substr($ntime, 0, 2).":".substr($ntime, -2).":00" ;
			  	  $csql="INSERT INTO ".DB_DATABASE.".ebs_order_original SET  group_id='$groupig',invoice_no='',id_destination='$pdesc',
					order_no='".$objArr[0]."', customer_name='IMCT', plant_name='".$objArr[7]."', delivery_date='".$daten3."',
					delivery_time='$newtime', cpo_date='".$daten13."', item_no='".$objArr[5]."', 
					customer_part_no='".$npart."', pwd='', fttl_part_no='', part_name='',
					dock_code='', delivery_qty='".$objArr[3]."', qty_box='".$objArr[5]."', 
					status_insert=1, emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
			  $cqr = mysql_query($csql);
			  }//	if(!empty($objArr[10])){
			
			}//while (($objArr = fgetcsv($objCSV,$chunksize, ",")) !== FALSE) {

			fclose($objCSV);
				if($objCSV){
					$idmg=base64_encode('confirm_import')."&cidg=$groupig";//&cusid=21&idest=31
					gotopage("index.php?id=$idmg");
					//alert("dddd");
				}else{
					alert("Can't upload data, please try again.");		
					}//if($objCSV){
						
		}//if(!empty($tmp_name)){
		
	
	}
//--------------------------END 21 IMCT SERVICE ---------------------------

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="<?=HTTP_SERVER.DIR_PAGE.DIR_JAVA?>jquery-1.1.3.1.pack.js" type="text/javascript"></script>
<script src="<?=HTTP_SERVER.DIR_PAGE.DIR_JAVA?>jquery.tabs.pack.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=HTTP_SERVER.DIR_PAGE.DIR_INCLUDES.DIR_CSS?>/jquery.tabs.css" type="text/css" media="print, projection, screen">

<script type="text/javascript">
function Checkdata1() {
type_file = document.getElementById('fileCSV').value;
length_file = document.getElementById('fileCSV').value.length;
file_name = type_file;
	 if (type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="txt"  )
	{
		alert( 'For Text file Only' );
		/*document.getElementById('fileCSV').innerHTML ="";*/	
		return (false);
		}else{
		document.getElementById('fileCSV').innerHTML ="<img src='"+file_name+"'><br>";
		return (true) ;
	}
}
</script>
<script type="text/javascript">

function Checkdata2() {
type_file = document.getElementById('fileCSV2').value;
length_file = document.getElementById('fileCSV2').value.length;
file_name = type_file;
	 if (type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="txt"  )
	{
		alert( 'For Text file Only' );
		/*document.getElementById('fileCSV').innerHTML ="";*/	
		return (false);
		}else{
		document.getElementById('fileCSV2').innerHTML ="<img src='"+file_name+"'><br>";
		return (true) ;
	}
}
</script>

       
  <script type="text/javascript">
            $(function() {

                $('#container-1').tabs();
             
            });
        </script>


<div class="body_resize"  > 
<?
	$custid=base64_decode($_GET['cid']);
?>

  <div id="container-1">
            <ul>
                <li><a href="#fragment-1"><span>Isuzu Normal and Random Part</span></a></li>
                <li><a href="#fragment-2"><span>Isuzu Service Part </span></a></li>
                <li><a href="#fragment-3"><span>Isuzu IMKDC </span></a></li>
                <li><a href="#fragment-4"><span>Isuzu Gateway  </span></a></li>
            </ul>
            <div id="fragment-1">
       <br/>
                        Download Format to import  Text file ::  
						<?php echo "<a target='_blank' href=exp/IMCT.txt >Exp. Isuzu Normal  File (IMCT.txt)</a>";?>  ||
                        <?php echo "<a target='_blank' href=exp/IMCTRD.txt >Exp. Isuzu Random  File (IMCTRD.txt)</a>";?> 
              <br/> <br/>
                        <form id="form1"  name="form1"enctype="multipart/form-data" method="post" action=""  onSubmit="JavaScript:return Checkdata1();">        
                             <table width="540" border="1"  class="table01" >
                                 <tr>
                                   <th height="28" colspan="2"> Isuzu Normal and Random  Part Order Import</th>
                                 </tr>
                                 <tr>
                                   <td width="208" height="25"><div class="tmagin_left">File import ::</div></td>
                                   <td width="316"><div class="tmagin_right"><input type="file" name="fileCSV" id="fileCSV"  /></div></td>
                                 </tr>
                                 <tr>
                                   <td colspan="2" align="center">
                                   <input type="submit" name="btnNormalSubmit"  id="btnNormalSubmit" value="Submit" />
                                   <input type="hidden" name="hcust" id="hcust"  value="<?=$custid?>"/>
                                    <input type="hidden" name="hdesc" id="hdesc"  value="30"/>
                                   </td>
                                 </tr>
                              </table>
                        </form>
			<br/>
            <img src="exp/<? echo "imct"?>.png" />
            </div>
            
             <div id="fragment-2">
               <br/>
       			 Download Format to import  Text file ::  <?php echo "<a target='_blank' href=exp/ServiceIMCT.txt>Exp. Isuzu Service  File (ServiceIMCT.txt)</a>";?> 

               <br/> <br/>
                        <form id="form2"  name="form2"enctype="multipart/form-data" method="post" action=""  onSubmit="JavaScript:return Checkdata2();">        
                             <table width="540" border="1"  class="table01" >
                                 <tr>
                                   <th height="28" colspan="2"> Isuzu Service Part Order Import</th>
                                 </tr>
                                 <tr>
                                   <td width="208" height="25"><div class="tmagin_left">File import ::</div></td>
                                   <td width="316"><div class="tmagin_right"><input type="file" name="fileCSV2" id="fileCSV2"  /></div></td>
                                 </tr>
                                 <tr>
                                   <td colspan="2" align="center">
                                   <input type="submit" name="btnsvsubmit"  id="btnsvsubmit" value="Submit" />
                                      <input type="hidden" name="hcust2" id="hcust2"  value="<?=$custid?>"/>
                                   </td>
                                 </tr>
                              </table>
                        </form>
				<br/>
					<img src="exp/<? echo "serviceimct"?>.png" />
             </div>
             
             
             <div id="fragment-3">
     			  <br/>
                    

             </div>
             
             <div id="fragment-4">
     			  
                  <br/>
                    

            </div>
            
             
             
             
      </div>
      
   

</div>
