<?php

	if(!empty($_POST['hbtn']) AND $_POST['hbtn']=="Confirm"){
		  
		$pgroup=$_POST['hgroup'];

				  	$sqlc="SELECT a.group_id,a.order_no,a.delivery_date,a.cpo_date,a.customer_part_no,
							a.delivery_qty,a.id_destination,b.customer_code,b.ship_name,c.pass_thru_status,b.currency,b.ship_method,
							CASE c.pass_thru_status WHEN '0' THEN 'FTTL_FG_DOMESTIC'  WHEN '1' THEN 'FTTL_FG_PASS_THRU' ELSE 'Empty' END AS sptrue,
							DATE_FORMAT(a.delivery_date, '%d%m%Y') AS delivery_d,
							DATE_FORMAT(a.cpo_date, '%d%m%Y') AS cpod ,
							b.gms_delivery_place_code,b.price_list
							FROM ".DB_DATABASE.".ebs_order_original a
							LEFT JOIN ".DB_DATABASE.".ebs_customer_destination b ON a.id_destination=b.id_destination
							LEFT JOIN ".DB_DATABASE.".ebs_part_master c ON a.customer_part_no = c.customer_part
							WHERE a.group_id='$pgroup' 
							GROUP BY a.id_original";
							
					$qrc = mysqli_query($con, $sqlc);
					if(mysqli_num_rows($qrc)<>0){
							log_hist($user_login,'Imported','ebs_report',$pgroup);
							mysqli_query($con, "UPDATE lgt_ebs_generate.ebs_group_order SET status_group='Imported', 
										emp_update='$user_login', date_update='".date('Y-m-d H:i:s')."' WHERE group_id='$pgroup'");
							while($rsi=mysqli_fetch_array($qrc)){
								$sqli="INSERT INTO ".DB_DATABASE.".ebs_report SET group_id='".$rsi['group_id']."', 
									customer_code='".$rsi['customer_code']."', ship_to='".$rsi['ship_name']."', 
									order_no='".$rsi['order_no']."', cpodate='".$rsi['cpo_date']."', customer_request_date='".$rsi['delivery_date']."', 
									qty='".$rsi['delivery_qty']."', customer_part_no='".$rsi['customer_part_no']."', 
									currency='".$rsi['currency']."', ship_method='".$rsi['ship_method']."', order_type='".$rsi['sptrue']."', 
									price_list='".$rsi['price_list']."', gms_delivery_place_code='".$rsi['gms_delivery_place_code']."', 
									emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";
								$qri=mysqli_query($con, $sqli);
							}//while($rsi=mys
							
							$idmg=base64_encode('view_report')."&vidg=$pgroup";
							gotopage("index.php?id=$idmg");
							
						}else{
								alert("Can't confirm report, please contact Adminstrator!!");
							}//if(mysql_num_rows($qrc)<>0){
							
			
			
	}//if($_POST['hbtn']=="Connfrim")
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script language="javascript" type="text/JavaScript">
function validate(form) {

				form1.button.disabled = true;  
				form1.button.value = 'Please wait...';  
				return true;  
	}
		</script>

<div class="body_resize"  align="center"> 
<div align="center">
    <?php
			  $gidst=$_GET['cidg'];
			   $gcust=$_GET['cusid'];
					
					if($gcust=="1"){
					 	$sqlupb="SELECT a.id_original ,CASE c.pass_thru_status WHEN '0' THEN '7' WHEN '1' THEN '6' ELSE '0' END AS sdest
								FROM ".DB_DATABASE.".ebs_order_original a 
								LEFT JOIN ".DB_DATABASE.".ebs_part_master c ON a.customer_part_no = c.customer_part
								WHERE a.group_id='$gidst' 
								AND customer_name = 'BANGPAKONGT' 
								AND  plant_name = 'BN'
								GROUP BY a.id_original";
						$qrupb=mysqli_query($con, $sqlupb);
						while($rsupb=mysqli_fetch_array($qrupb)){
							 	$sqlupdes="UPDATE ".DB_DATABASE.".ebs_order_original 
										SET id_destination='".$rsupb['sdest']."' 
										WHERE id_original='".$rsupb['id_original']."'";
								$qrupdes=mysqli_query($con, $sqlupdes);
							}		
						}//if($gcust=="1"){
			 
				     	 $sql="SELECT a.group_id,a.order_no,a.delivery_date,a.cpo_date,a.customer_part_no,a.customer_name,
							a.delivery_qty,a.id_destination,b.customer_code,b.ship_name,c.pass_thru_status,b.currency,b.ship_method,
							CASE c.pass_thru_status WHEN '0' THEN 'FTTL_FG_DOMESTIC'  WHEN '1' THEN 'FTTL_FG_PASS_THRU' ELSE 'Empty' END AS sptrue,
							DATE_FORMAT(a.delivery_date, '%d%m%Y') AS delivery_d,
							DATE_FORMAT(a.cpo_date, '%d%m%Y') AS cpod ,
							b.gms_delivery_place_code,b.price_list
							FROM ".DB_DATABASE.".ebs_order_original a
							LEFT JOIN ".DB_DATABASE.".ebs_customer_destination b ON a.id_destination=b.id_destination
							LEFT JOIN ".DB_DATABASE.".ebs_part_master c ON a.customer_part_no  = c.customer_part
							WHERE a.group_id='$gidst' 
							GROUP BY a.id_original";
//echo "==".$sql;
			$qr = mysqli_query($con, $sql);
			$rowsn= mysqli_num_rows($qr);
			if($rowsn<>0){
	$i=1;
		?>
<div class="rightPane">  
<form id="form1" name="form1" method="post" action=""onsubmit='return validate(this)'>
       <table width="100%" height="140" border="1" bordercolor="#CC9966"class="table01">

    <tr>
     <th height="30" colspan="12">Order imported confirmation</th>
     </tr>
    <tr>
      <th width="4%" height="30">No.</th>
      <th width="7%">Customer code</th>
      <th width="16%">Customer ship to</th>
      <th width="15%">Order</th>
      <th width="8%">CPO DATE</th>
      <th width="12%">Customer Requested Date</th>
      <th width="5%">Order Qty.</th>
      <th width="13%">Customer Part No.</th>
      <th width="7%">Currency</th>
      <th width="13%">Order Type </th>
      <th width="11%"> GMS Delivery Place Code</th>
      <th width="11%">Price List Master</th>
      </tr>
   
    <?php 	while($rs=mysqli_fetch_array($qr)){  ?>
   	   <tr  <?php $v =0; $v = $v + 1; echo  icolor($v); ?>  onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;" height="25px" align="center" >
   	     <td height="34" ><div align="center">
   	       <?=$i?>
 	       </div></td>

   	     <td> <?php echo sprintf("%05d", $rs['customer_code']);?> </td>
   	     <td><?php echo $rs['ship_name'];?></td>
   	     <td><?php echo $rs['order_no'];?></td> 
   	     <td><?php echo sprintf("%08d", $rs['cpod']);?></td>
   	     <td><?php echo sprintf("%08d", $rs['delivery_d']);?></td>
   	     <td><?php echo $rs['delivery_qty'];?></td>
   	     <td><?php echo $rs['customer_part_no'];?></td>
   	     <td><?php echo $rs['currency'];?></td>
   	     <td <?php if($rs['sptrue']=="Empty"){echo "bgcolor='#FF0000'";}?>><span class="tmagin_right"><?php echo $rs['sptrue'];?></span></td>
   	     <td><?php echo $rs['gms_delivery_place_code'];?></td>
   	     <td><?php echo $rs['price_list'];?></td>
   	     </tr>
          <?php						
		$i++;	
			}
		
    ?>
   	   <tr  <?php   echo icolor($v); $v = $v + 1; ?> onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;" height="25px" align="center" >
   	     <td height="34" colspan="12" >
   
         <?php 	if(selectCountNull($gidst)<>0){?>
            <input type="submit" name="button3" id="button3" value="Add Customer Part No."
             onClick="javascript:openWins('windows.php?win=addm', '_blank', 650, 350, 1, 1, 0, 0, 0);return false;"  />
			<?php	}else{	
					$allori=countRowsA($gidst);
					if($allori<>$rowsn){ 
							
						echo "<span class='txt-red-b'>The rows of original file does not match with the rows of system generate <br/>";
						echo countRowsA($gidst)." <> ".$rowsn;
						echo "</span><br/>";
					 }else{
			 ?>
   	       <input type="submit" name="button" id="button" value="Confirm"/>
           <input type="hidden" name="hbtn" id="hbtn"  value="Confirm"/>
           <input type="hidden" name="hgroup" id="hgroup" value="<?=$gidst?>" /> 
           <?php
					}
				}//if(selectCountNull($groupid)<>0){
		   ?>
           
         <input type="submit" name="button2" id="button2" value="Refresh"  onclick="window.location.reload(true);"  />
         <input type="button" name="button4" id="button4" value="Cancel"  

         onclick="window.location.href='index.php?cid=<?=base64_encode($gcust)?>';"  /></td>
   	     </tr>
   
  </table>
</form>
         <?php
			}else{
				echo "<br/><br/><br/><center><div class='table_comment' >NO hava Data... </center>";
				}//if(rows($qr)<>0){
		 ?>

</div>
