<?php
//--------------------------START 21 IMCT SERVICE ---------------------------
	if(!empty($_POST['btnsvsubmit']) AND $_POST['btnsvsubmit']=="Submit"){
		//echo "--".$_POST['btnsvsubmit'];
		$uploads_dir = 'uploads';	
		$pcus=$_POST['hcust2'];
		$dest="31"; //FIX for IMCT Service
		$name= $_FILES["fileCSV2"]["name"];
		$tmp_name= $_FILES["fileCSV2"]["tmp_name"];
		$_FILES["fileCSV2"]["type"];
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
			while (($objArr = fgetcsv($objCSV,2000, ",")) !== FALSE) {  //,\t
			if(!empty($objArr[10])){
			@$daten3=convDate($objArr[3]);
			$daten13= date("Y-m-d", strtotime($daten3." -2 day" ) );
			$npname=addslashes($objArr[9]);
			$npwd=addslashes($objArr[7]);
			$newcuspart =$objArr[6];//str_replace("-", "", $objArr[6]);
			    $csql="INSERT INTO ".DB_DATABASE.".ebs_order_original SET  group_id='$groupig',invoice_no='".$objArr[0]."',id_destination='$dest',
					order_no='".$objArr[10]."', customer_name='".$objArr[1]."', plant_name='".$objArr[2]."', delivery_date='".$daten3."',
					delivery_time='', cpo_date='".$daten13."', item_no='".$objArr[5]."', 
					customer_part_no='".$newcuspart."', pwd='".$npwd."', fttl_part_no='".$objArr[8]."', part_name='".$npname."',
					dock_code='', delivery_qty='".$objArr[11]."', qty_box='".$objArr[12]."', 
					status_insert=1, emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
				$cqr = mysqli_query($con, $csql);
			  }//	if(!empty($objArr[10])){
			
			}//while (($objArr = fgetcsv($objCSV,$chunksize, ",")) !== FALSE) {

			fclose($objCSV);
				if($objCSV){
					$idmg=base64_encode('confirm_import')."&cidg=$groupig&cusid=21";//&idest=31
				gotopage("index.php?id=$idmg");
					//alert("dddd");
				}else{
					alert("Can't upload data, please try again.");		
					}//if($objCSV){
						
		}//if(!empty($tmp_name)){
	}//if($_POST['btnsvsubmit']=="Submit"){
		

	if(!empty($_POST['btnNormalSubmit']) AND $_POST['btnNormalSubmit']=="Submit"){
		$_POST['btnNormalSubmit'];
		$uploads_dir = 'uploads';	
		$pcus=$_POST['hcust'];
		$pdesc=$_POST['hdesc'];
		 $name= $_FILES["fileCSV".$pdesc]["name"];
		 $tmp_name= $_FILES["fileCSV".$pdesc]["tmp_name"];
		$_FILES["fileCSV".$pdesc]["type"];
		if(!empty($tmp_name)){
		$newname= date("ymdHis").".htm";
	
		copy($tmp_name,"$uploads_dir/$newname") ;
		$objCSV = fopen("$uploads_dir/$newname", 'r');
		//selectMaxgroup()
		$sqlg="INSERT INTO lgt_ebs_generate.ebs_group_order SET 
				id_customer_master='$pcus',id_destination='$pdesc' , file_name='$newname',status_group='Import', 
				emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
		$qrg=mysqli_query($con, $sqlg);
		
	//echo "----".$pdesc;
		$groupig=selectMaxgroup($user_login);
		log_hist($user_login,'Import','ebs_group_order',$groupig);
				while(!feof($objCSV)) { 
					$data = fgets($objCSV);
						if(substr($data, 120, 8)<>""){
						 $norder= substr($data, 2, 10);//ORDER
						 $npartno= substr($data, 35, 6)."-".substr($data, 41, 4);//substr($data, 35, 10). "<BR/>";//Part
						$netadate= substr($data, 50, 8);//ETA
						@$daten3=convDate2($netadate);
						$daten13= date("Y-m-d", strtotime($daten3." -2 day" ) );
						$norqty= substr($data, 58, 6);//OrderQty
						$npname= addslashes(substr($data, 64, 30));//Part name
						$ncust= substr($data, 120, 5);//cust name
						 $nplant= substr($data, 164, 2);//Plant name
						$nbxqty= substr($data, 134, 5);//Box Qty.
						$ntime =substr($data, 159, 4);//Time
						$newtime=substr($ntime, 0, 2).":".substr($ntime, -2).":00" ;
					 $csql="INSERT INTO ".DB_DATABASE.".ebs_order_original SET  group_id='$groupig',invoice_no='',id_destination='$pdesc',
							order_no='".$norder."', customer_name='".$ncust."', plant_name='".$nplant."', delivery_date='".$daten3."',
							delivery_time='$newtime', cpo_date='".$daten13."', item_no='', 
							customer_part_no='".$npartno."', pwd='', fttl_part_no='', part_name='$npname',
							dock_code='', delivery_qty='".$norqty."', qty_box='".$nbxqty."', 
							status_insert=1, emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
					  $cqr = mysqli_query($con, $csql);
					  
						}//if(substr($data, 50, 8)<>""){
					}//while(!feof($objCSV)) { 
							
		

			fclose($objCSV);
				if($objCSV){
					$idmg=base64_encode('confirm_import')."&cidg=$groupig&cusid=21";//&idest=31
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
type_file = document.getElementById('fileCSV30').value;
length_file = document.getElementById('fileCSV30').value.length;
file_name = type_file;
	 if (type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="htm"  )
	{
		alert( 'For .htm file Only' );
		/*document.getElementById('fileCSV').innerHTML ="";*/	
		return (false);
		}else{
		document.getElementById('fileCSV30').innerHTML ="<img src='"+file_name+"'><br>";
		return (true) ;
	}
}

function Checkdata2() {
type_file = document.getElementById('fileCSV2').value;
length_file = document.getElementById('fileCSV2').value.length;
file_name = type_file;
	 if (type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="csv"  )
	{
		alert( 'For Text CSV Only' );
		/*document.getElementById('fileCSV').innerHTML ="";*/	
		return (false);
		}else{
		document.getElementById('fileCSV2').innerHTML ="<img src='"+file_name+"'><br>";
		return (true) ;
	}
}

function Checkdata3() {
type_file = document.getElementById('fileCSV32').value;
length_file = document.getElementById('fileCSV32').value.length;
file_name = type_file;
	 if (type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="htm"  )
	{
		alert( 'For .htm file Only' );
		/*document.getElementById('fileCSV').innerHTML ="";*/	
		return (false);
		}else{
		document.getElementById('fileCSV32').innerHTML ="<img src='"+file_name+"'><br>";
		return (true) ;
	}
}

function Checkdata4() {
type_file = document.getElementById('fileCSV39').value;
length_file = document.getElementById('fileCSV39').value.length;
file_name = type_file;
	 if (type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="htm"  )
	{
		alert( 'For .htm file Only' );
		/*document.getElementById('fileCSV').innerHTML ="";*/	
		return (false);
		}else{
		document.getElementById('fileCSV39').innerHTML ="<img src='"+file_name+"'><br>";
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
<?php
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
                        Download Format to import HTML file ::  
						<?php echo "<a target='_blank' href=exp/IMCT.htm >Exp. Isuzu Normal and Random  File (IMCT.htm)</a>";?>  

              <br/> <br/>
                        <form id="form1"  name="form1"enctype="multipart/form-data" method="post" action=""  onSubmit="JavaScript:return Checkdata1();">        
                             <table width="540" border="1"  class="table01" >
                                 <tr>
                                   <th height="28" colspan="2"><span class="Arial_14_red"> Isuzu Normal and Random  Part</span> Order Import</th>
                                 </tr>
                                 <tr>
                                   <td width="208" height="25"><div class="tmagin_left">File import ::</div></td>
                                   <td width="316"><div class="tmagin_right"><input type="file" name="fileCSV30" id="fileCSV30"  /></div></td>
                                 </tr>
                                 <tr>
                                   <td colspan="2" align="center">
                                   <input type="submit" name="btnNormalSubmit"  id="btnNormalSubmit" value="Submit" />
                                   <input type="hidden" name="btnNormalSubmit" id="btnNormalSubmit"  value="Submit"/>
                                   <input type="hidden" name="hcust" id="hcust"  value="<?=$custid?>"/>
                                   <input type="hidden" name="hdesc" id="hdesc"  value="30"/>
                                   </td>
                                 </tr>
                              </table>
                        </form>
			<br/>
            <img src="exp/<?php echo "imct_new"; ?>.png"   />
            </div>
            
             <div id="fragment-2">
               <br/>
       			 Download Format to import  CSV file ::  <?php echo "<a target='_blank' href=exp/IMCTService.csv>Exp. Isuzu Service  File (IMCTService.csv)</a>";?> 

               <br/> <br/>
                        <form id="form2"  name="form2"enctype="multipart/form-data" method="post" action=""  onSubmit="JavaScript:return Checkdata2();">        
                             <table width="540" border="1"  class="table01" >
                                 <tr>
                                   <th height="28" colspan="2"> <span class="Arial_14_red">Isuzu Service Part </span>Order Import</th>
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
					<img src="exp/<?php echo "serviceimct"?>.png"  />
             </div>
             
             
             <div id="fragment-3">
     			  <br/>
                        Download Format to import  HTML file ::  
						<?php echo "<a target='_blank' href=exp/IMKDC.htm >Exp. Isuzu IMKDC  File (IMKDCIMCT.htm)</a>";?>  
              <br/> <br/>
                        <form id="form3"  name="form3"enctype="multipart/form-data" method="post" action=""  onSubmit="JavaScript:return Checkdata3();">        
                             <table width="540" border="1"  class="table01" >
                                 <tr>
                                   <th height="28" colspan="2"><span class="Arial_14_red"> Isuzu IMKDC Part</span> Order Import</th>
                                 </tr>
                                 <tr>
                                   <td width="208" height="25"><div class="tmagin_left">File import ::</div></td>
                                   <td width="316"><div class="tmagin_right"><input type="file" name="fileCSV32" id="fileCSV32"  /></div></td>
                                 </tr>
                                 <tr>
                                   <td colspan="2" align="center">
                                   <input type="submit" name="btnNormalSubmit"  id="btnNormalSubmit" value="Submit" />
                                    <input type="hidden" name="btnNormalSubmit" id="btnNormalSubmit"  value="Submit"/>
                                   <input type="hidden" name="hcust" id="hcust"  value="<?=$custid?>"/>
                                   <input type="hidden" name="hdesc" id="hdesc"  value="32"/>
                                   </td>
                                 </tr>
                              </table>
                        </form>
			<br/>
            <img src="exp/<?php echo "imkdcimct_new"?>.png"/>

             </div>
             
             <div id="fragment-4">
     			  
                  <br/>
                            Download Format to import CSV file ::  
						<?php
						 echo "<a target='_blank' href=exp/GW.htm >Exp. IMCT Gateway File (IMCTGW.htm)</a>";
							
						?>  
              <br/> <br/>
                        <form id="form4"  name="form4"enctype="multipart/form-data" method="post" action=""  onSubmit="JavaScript:return Checkdata4();">        
                             <table width="540" border="1"  class="table01" >
                                 <tr>
                                   <th height="28" colspan="2"><span class="Arial_14_red"> Isuzu Gateway  Part</span> Order Import</th>
                                 </tr>
                                 <tr>
                                   <td width="208" height="25"><div class="tmagin_left">File import ::</div></td>
                                   <td width="316"><div class="tmagin_right"><input type="file" name="fileCSV39" id="fileCSV39"  /></div></td>
                                 </tr>
                                 <tr>
                                   <td colspan="2" align="center">
                                   <input type="submit" name="btnNormalSubmit"  id="btnNormalSubmit" value="Submit" />
                                    <input type="hidden" name="btnNormalSubmit" id="btnNormalSubmit"  value="Submit"/>
                                   <input type="hidden" name="hcust" id="hcust"  value="<?=$custid?>"/>
                                   <input type="hidden" name="hdesc" id="hdesc"  value="39"/>
                                   </td>
                                 </tr>
                              </table>
                        </form>
			<br/>
            <img src="exp/<?php echo "imctgw_new"?>.png"/>


            </div>
            
             
             
             
      </div>
      
   

</div>
