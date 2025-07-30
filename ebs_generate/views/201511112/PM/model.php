
<?
 if($_POST['button']=="PASS_THRU"){
	 $modelid=$_POST['model_id'];
	 $today = date('Y-m-d H:i:s');
	 	if($modelid!=""){
					$id_model=$modelid;
					}else{
					$id_model=$molid;
						}//if($emploid!=""){
			foreach( $id_model as $idmodels  ):
					if($idmodels!="" and $idmodels!="Array"){
			 	  	  $insertSQL = sprintf("UPDATE lgt_ebs_generate.ebs_part_master SET pass_thru_status=1 WHERE id_part='$idmodels' ") ;	
					$Result1 = mysql_query($insertSQL) ;
					
					}
					if($Result1){
								$pagen= base64_encode('model');
								//gotopage("index.php?id=$pagen");			
					}
			endforeach ;

	 	}elseif($_POST['button']=="DOMESTIC"){// if($_POST['button']=="Save"){
		 $modelid=$_POST['model_id'];
		 $today = date('Y-m-d H:i:s');
	 	if($modelid!=""){
					$id_model=$modelid;
					}else{
					$id_model=$molid;
						}//if($emploid!=""){
			foreach( $id_model as $idmodels  ):
						if($idmodels!="" and $idmodels!="Array"){
			 	  	    $insertSQL = sprintf("UPDATE lgt_ebs_generate.ebs_part_master SET pass_thru_status=0 WHERE id_part='$idmodels'") ;	
					$Result1 = mysql_query($insertSQL) ;
					
					}
					if($Result1){
								
							//	gotopage("admin_manage_shift.php?edit=edit");			
					}
			endforeach ;
		}
		
?>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="body_resize"  align="center"> 
<div align="center">
<form id="form2" name="form2" method="post" action="">
<table width="100%" border="1" class="table01">
      
          <tr align="center">
                <td width="21%" height="28">
              		<div class="text_black12_bold"  align="right">SEARCH || Model No:&nbsp;&nbsp;&nbsp;&nbsp;</div>
                </td>
            <td colspan="2" align="left">&nbsp;&nbsp;&nbsp; 
            <input type="text" name="modeln"  id="modeln" 
             value="<?  if(!empty($_POST["modeln"])){ echo $_POST["modeln"];} ?>"   >
           
              <input type="submit" name="button" id="button" value="Search" />
       <span class="Arial_14_red">       *Just input 13 digit or lesser</span></td>
          </tr>
       
</table>
</form>
<?
if(!empty($_POST["modeln"])){
			$x= "WHERE fttl_part Like '".$_POST["modeln"]."%' ";
		
		 }else{
			$x= "";
			  }
?>
    <?
        	  $sql="SELECT id_part, fttl_part,customer_part,pass_thru_status,description,
					 CASE  pass_thru_status WHEN 1 THEN 'FTTL_FG_PASS_THRU' WHEN 0 THEN 'FTTL_FG_DOMESTIC'  ELSE 'Unknow' END AS passthru 
					FROM ".DB_DATABASE.".ebs_part_master
				 	 $x
					 ORDER BY fttl_part ";


//echo  $sqlg;
$qr = mysql_query($sql);

if(mysql_num_rows($qr)<>0){
	$i=1;
		?>
<div class="rightPane">  

<form id="form1" name="form1" method="post" action="" onsubmit='return validateStatus(this)'>
        <input id='cssbutton'  name='button' type='submit' value='PASS_THRU' />&nbsp;
        <input id='cssbutton'  name='button' type='submit' value='DOMESTIC' />
       <table width="80%" height="104" border="1" bordercolor="#CC9966"class="table01">

    <tr>
     <th height="30" colspan="5">
       Manage Model Pass Thru</th>
     <th height="30" colspan="2"> <img src="../images/001_01.gif" width="24" height="24" />
     <a href="#" onClick="javascript:openWins('windows.php?win=addm', '_blank', 650, 350, 1, 1, 0, 0, 0);return false;"  >
      Add New Model</a></th>
     </tr>
    <tr>
      <th width="4%" height="30">No.</th> 
      <th width="6%"> <input type="checkbox" name="Check_ctr" value="cancel"  onClick="CheckStatus(document.form1.model_id)"/></th>
      <th width="27%">Customer Model No.</th>
      <th width="17%">FTTL Model No.</th>
      <th width="22%">Description</th>
      <th width="17%">Order Type</th>
      <th width="7%">Edit</th>
      
      </tr>
   
    <?php  while($rs=mysql_fetch_array($qr)){  ?>
   	   <tr  <?php   echo icolor($v); $v = $v + 1; ?> onMouseOver="className=&quot;over&quot;" 
       	 onMouseOut="className=&quot;&quot;" height="25px" align="center" >
   	     <td height="34" ><div align="center">   <?=$i?>    </div></td>
         <td>  <input name="model_id[]"  id="model_id"type="checkbox" value="<?=$rs['id_part']?>"  />
         <input type="hidden" name="model_id[]" id="model_id" value="<?=$model_id?>"/></td>
   	     <td><div  class="tmagin_right"> <?php echo $rs['customer_part'];?></div></td> 
   	     <td> <div  class="tmagin_right"> <?php echo $rs['fttl_part'];?> </div></td> 
   	     <td><div  class="tmagin_right"> <?php echo $rs['description'];?></div></td>
   	     <td> <span class="<? if($rs['pass_thru_status']=="1") {echo "txt-green-m";}else{echo "txt-orange-m";}?>">    
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
         <?
			}else{
				echo "<br/><br/><br/><center><div class='table_comment' >NO hava Data...Click  ";
				?>
                <a href="#" onClick="javascript:openWins('windows.php?win=add', '_blank',650, 300, 1, 1, 0, 0, 0);return false;" >
     here  
      </a>
                <?
				echo "  to create new  data </div> </center>";}//if(rows($qr)<>0){
		 ?>
</form>
</div>
