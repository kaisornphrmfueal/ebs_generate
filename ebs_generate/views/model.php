
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
<form id="form2" name="form2" method="post" action="">
<table width="100%" border="1" class="table01">
      
          <tr align="center">
                <td width="21%" height="28">
              		<div class="text_black12_bold"  align="right">SEARCH || Model No ot Plant:&nbsp;&nbsp;&nbsp;&nbsp;</div>
                </td>
            <td colspan="2" align="left">&nbsp;&nbsp;&nbsp; 
            <input type="text" name="modeln"  id="modeln" 
             value="<?php  if(!empty($_POST["modeln"])){ echo $_POST["modeln"];} ?>"   >
           
              <input type="submit" name="button" id="button" value="Search" />
       <span class="Arial_14_red">       *Just input 13 digit or lesser</span></td>
          </tr>
       
</table>
</form>
<?php
if(!empty($_POST["modeln"])){
			$x= "WHERE (fttl_part Like '".$_POST["modeln"]."%') OR  (customer_part Like '".$_POST["modeln"]."%') OR  (plant Like '%".$_POST["modeln"]."%') ";
		
		 }else{
			$x= "";
			  }
?>
    <?php
         	  $q="SELECT id_part, fttl_part,customer_part,pass_thru_status,description,plant,
					 CASE  pass_thru_status WHEN 1 THEN 'FTTL_FG_PASS_THRU' WHEN 0 THEN 'FTTL_FG_DOMESTIC'  ELSE 'Unknow' END AS passthru 
					FROM ".DB_DATABASE.".ebs_part_master
				 	 $x
					 ORDER BY fttl_part ";


//echo  $q;
$qr = mysqli_query($con, $q);
	$total=mysqli_num_rows($qr);  
			//	echo $q;
			//	echo "==".$q;
					$i=1;
					if($total<>0)			
				{	
								$e_page=15; // ????? ?????????????????????????????     +
								
								
								if(!isset($_GET['s_page']) or !empty($modeln)){     
									$_GET['s_page']=0;     
								}else{     
									$chk_page=$_GET['s_page'];       
									$_GET['s_page']=$_GET['s_page']*$e_page;     
								}     
								$q.=" LIMIT ".$_GET['s_page'].",$e_page";  
								$qr=mysqli_query($con, $q);  
								if(mysqli_num_rows($qr)>=1){     
									@$plus_p=($chk_page*$e_page)+mysqli_num_rows($qr);     
								}else{     
									@$plus_p=($chk_page*$e_page);         
								}     
								$total_p=ceil($total/$e_page);     
								@$before_p=($chk_page*$e_page)+1; 
								
								
								?>



  <table width="80%" height="108" border="1" bordercolor="#CC9966"class="table01">

    <tr>
     <th height="28" colspan="5">
       Manage Model Pass Thru</th>
     <th height="28" colspan="2"> <img src="../images/001_01.gif" width="24" height="24" />
     <a href="#" onClick="javascript:openWins('windows.php?win=addm', '_blank', 650, 350, 1, 1, 0, 0, 0);return false;"  >
      Add New Model</a></th>
     </tr>
    <tr>
      <th width="4%" height="30">No.</th> 
      <th>Customer Model No.</th>
      <th width="17%">FTTL Model No.</th>
      <th width="13%">Description</th>
      <th width="13%">Plant</th>
      <th width="13%">Order Type</th>
      <th width="7%">Edit</th>
      
      </tr>
   
    <?php  while($rs=mysqli_fetch_array($qr)){  ?>
   	   <tr  <?php $v =0; $v = $v + 1; echo  icolor($v); ?>  onMouseOver="className=&quot;over&quot;" 
       	 onMouseOut="className=&quot;&quot;" height="25px" align="center" >
   	     <td height="28" ><div align="center">   <?=$i?>    </div></td>
         <td><div  class="tmagin_right"> <?php echo $rs['customer_part'];?></div></td>
   	     <td> <div  class="tmagin_right"> <?php echo $rs['fttl_part'];?> </div></td> 
   	     <td><div  class="tmagin_right"> <?php echo $rs['description'];?></div></td>
   	     <td><div  class="tmagin_right"> <?php echo $rs['plant'];?></div></td>
   	     <td> <span class="<?php if($rs['pass_thru_status']=="1") {echo "txt-green-m";}else{echo "txt-orange-m";}?>">    
         	 <?php echo $rs['passthru'];?></span>
         </td>
   	     <td><a href="#" onClick="javascript:openWins('windows.php?win=editm&ide=<?=$rs['id_part'];?>', '_blank', 650, 380, 1, 1, 0, 0, 0);return false;"  >
          <img src="../images/001_45.gif" width="24" height="24" />
          </a></td>
   	   </tr>
    <?php						
		$i++;	
			}
		
    ?>
  </table>
   <?php
								
		 if($total>0){ ?>  
               <div class="browse_page" >
                          <?php       @page_navigator_user($before_p,$plus_p,$total,$total_p,$chk_page,base64_encode('model'),$modeln);  	  ?>
  </div>  
            <?php }
			
		}else{ echo "<br/><br/><br/><center><div class='table_comment' >NO hava Data...Click  ";
				?>
                <a href="#" onClick="javascript:openWins('windows.php?win=add', '_blank',650, 300, 1, 1, 0, 0, 0);return false;" >  here     </a>
                <?php
				echo "  to create new  data </div> </center>";}//if(rows($qr)<>0){
		 ?>

</div>
