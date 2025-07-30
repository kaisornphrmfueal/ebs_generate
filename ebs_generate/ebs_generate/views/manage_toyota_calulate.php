
<?php
 if(!empty($_POST['button']) AND $_POST['button']=="PASS_THRU"){
	 $modelid=$_POST['model_id'];
	 $today = date('Y-m-d H:i:s');
	 	if($modelid!=""){
					$id_model=$modelid;
					}else{
					$id_model=$molid;
						}//if($emploid!=""){
			foreach( $id_model as $idmodels  ):
					if($idmodels!="" and $idmodels!="Array"){
			 	  	  $insertSQL = sprintf("UPDATE ".DB_DATABASE.".ebs_part_master SET pass_thru_status=1 WHERE id_part='$idmodels' ") ;	
					$Result1 = mysqli_query($con, $insertSQL) ;
					
					}
					if($Result1){
								$pagen= base64_encode('model');
								//gotopage("index.php?id=$pagen");			
					}
			endforeach ;

	 	}elseif(!empty($_POST['button']) AND $_POST['button']=="DOMESTIC"){// if($_POST['button']=="Save"){
		 $modelid=$_POST['model_id'];
		 $today = date('Y-m-d H:i:s');
	 	if($modelid!=""){
					$id_model=$modelid;
					}else{
					$id_model=$molid;
						}//if($emploid!=""){
			foreach( $id_model as $idmodels  ):
						if($idmodels!="" and $idmodels!="Array"){
			 	  	    $insertSQL = sprintf("UPDATE ".DB_DATABASE.".ebs_part_master SET pass_thru_status=0 WHERE id_part='$idmodels'") ;	
					$Result1 = mysqli_query($con, $insertSQL) ;
					
					}
					if($Result1){
								
							//	gotopage("admin_manage_shift.php?edit=edit");			
					}
			endforeach ;
		}
		
?>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<div align="center">


    <?php
         	  $q="SELECT a.id_formula,a.supplier_code,a.car_plant,a.dock_code,a.id_destination,b.plant,c.name_en
					FROM ".DB_DATABASE.".ebs_formula_cal a
					LEFT JOIN ".DB_DATABASE.".ebs_customer_destination b ON a.id_destination=b.id_destination
					LEFT JOIN ".DB_DATABASE247.".so_employee_data c ON a.emp_insert = c.emp_id
					GROUP BY a.id_formula ORDER BY a.supplier_code,a.car_plant ";


//echo  $q;
$qr = mysqli_query($con, $q);
	$total=mysqli_num_rows($qr);  
			//	echo $q;
			//	echo "==".$q;
					$i=1;
					if($total<>0)			
				{	
			
								?>



  <table width="680px" height="108" border="1" bordercolor="#CC9966"class="table01">

    <tr>
     <th height="28" colspan="5">
       Manage Formula Calculation</th>
     <th height="28" colspan="2"> <img src="../images/001_01.gif" width="24" height="24" />
     <a href="#" onClick="javascript:openWins('windows.php?win=addcal', '_blank', 650, 350, 1, 1, 0, 0, 0);return false;"  >
      Add New Formula </a></th>
     </tr>
    <tr>
      <th width="4%" height="30">No.</th> 
      <th width="16%">Supplier code</th>
      <th width="16%">Car Plant</th>
      <th width="14%">Dock Code</th>
      <th width="24%">Plant (Destination) </th>
      <th width="18%">Add by</th>
      <th width="8%">Edit</th>
      
      </tr>
   
    <?php  while($rs=mysql_fetch_array($qr)){  ?>
   	   <tr  <?php $v =0; $v = $v + 1; echo  icolor($v); ?>  onMouseOver="className=&quot;over&quot;" 
       	 onMouseOut="className=&quot;&quot;" height="25px" align="center" >
   	     <td height="28" ><div align="center">   <?=$i?>    </div></td>
         <td><div  class="tmagin_right"> <?php echo $rs['supplier_code'];?></div></td>
   	     <td> <div  class="tmagin_right"> <?php echo $rs['car_plant'];?> </div></td> 
   	     <td><div  class="tmagin_right"> <?php echo $rs['dock_code'];?></div></td>
   	     <td><div  class="tmagin_right"> <?php echo $rs['plant'];?></div></td>
   	     <td><?php echo $rs['name_en'];?></td>
   	     <td><a href="#" onClick="javascript:openWins('windows.php?win=editcal&ide=<?=$rs['id_formula'];?>', '_blank', 650, 380, 1, 1, 0, 0, 0);return false;"  >
          <img src="../images/001_45.gif" width="24" height="24" />
          </a></td>
   	   </tr>
    <?php						
		$i++;	
			}
		
    ?>
  </table>
   <?php
								
		
		}else{ echo "<br/><br/><br/><center><div class='table_comment' >NO hava Data...Click  ";
				?>
                <a href="#" onClick="javascript:openWins('windows.php?win=addcal', '_blank',650, 300, 1, 1, 0, 0, 0);return false;" >  here     </a>
                <?php
				echo "  to create new  data </div> </center>";}//if(rows($qr)<>0){
		 ?>

</div>
