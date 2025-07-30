<?php
//header("Content-Type: application/vnd.ms-excel");
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="ebs_report.xls"');#ชื่อไฟล์
include ("../includes/configure.php");
include('../functions/function.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<div class="body_resize"  align="center"> 
<div align="center">
    <?php
			$gviewg=$_GET['gids'];
			$guid=$_GET['uid'];
			
			updateStatus($guid,$gviewg);
			
				  	$sql="SELECT  a.group_id,a.customer_code,a.ship_to,order_no,
						DATE_FORMAT(a.cpodate, '%d%m%Y') AS cpod,
						DATE_FORMAT(a.customer_request_date, '%d%m%Y') AS delid,
						'Y' AS fixy, a.qty, a.customer_part_no,a.currency,a.ship_method,'1' AS fix1,a.order_type,
						a.gms_delivery_place_code,a.price_list
						FROM ".DB_DATABASE.".ebs_group_order b
						LEFT JOIN ".DB_DATABASE.".ebs_report a ON b.group_id=a.group_id
						WHERE a.group_id = '$gviewg' ";

//echo "==".$sql;
			$qr = mysqli_query($con, $sql);
			if(mysqli_num_rows($qr)<>0){
	$i=1;
		?>
<div class="rightPane">  
<form id="form1" name="form1" method="post" action="">
       <table width="100%" height="140" border="1" bordercolor="#CC9966"class="table01">

    <tr>
     <th height="30" colspan="19">Order imported confirmation</th>
     </tr>
    <tr>
      <th width="3%" height="30">No.</th>
      <th width="7%">Customer code</th>
      <th width="10%">Customer ship to</th>
      <th width="10%">Order</th>
      <th width="7%">CPO DATE</th>
      <th width="7%">Order Date</th>
      <th width="5%">&nbsp;</th>
      <th width="4%">Order Qty.</th>
      <th width="4%">&nbsp;</th>
      <th width="8%">Customer Part No.</th>
      <th width="6%">Currency</th>
      <th width="5%">Ship Method</th>
      <th width="5%">CPO DATE</th>
      <th width="3%">&nbsp;</th>
      <th width="2%">&nbsp;</th>
      <th width="3%">&nbsp;</th>
      <th width="11%">Order Type </th>
      <th width="11%"> GMS Delivery Place Code</th>
      <th width="11%">Price List Master</th>
      </tr>
   
    <?php 	while($rs=mysqli_fetch_array($qr)){  ?>
   	   <tr height="25px" align="center" >
   	     <td height="34" ><div align="center">
   	       <?=$i?>
 	       </div></td>
	
   	     <td><?php echo sprintf("%05d", $rs['customer_code']);?></td>
   	     <td><?php echo $rs['ship_to'];?></td>
   	     <td><span class="tmagin_right"><?php echo $rs['order_no'];?></span></td> 
   	     <td><?php echo "'".$rs['cpod'];?></td>
   	     <td><?php echo "'".$rs['delid'];?></td>
   	     <td><?php echo $rs['fixy'];?></td>
   	     <td><?php echo $rs['qty'];?></td>
   	     <td>&nbsp;</td>
   	     <td><div  class="tmagin_right"><?php echo $rs['customer_part_no'];?></div></td>
   	     <td><?php echo $rs['currency'];?></td>
   	     <td><?php echo $rs['ship_method'];?></td>
   	     <td><?php echo "'".$rs['cpod'];?></td>
   	     <td>&nbsp;</td>
   	     <td>&nbsp;</td>
   	  	 <td><?php echo $rs['fix1'];?></td>
   	  	 <td><?php echo $rs['order_type'];?></td>
   	  	 <td><?php echo $rs['gms_delivery_place_code'];?></td>
   	  	 <td><?php echo $rs['price_list'];?></td>
   	     </tr>
          <?php						
		$i++;	
			}
		
    ?>
  
  </table>
</form>
         <?php
			}else{
				echo "<br/><br/><br/><center><div class='table_comment' >NO hava Data... </center>";
				}//if(rows($qr)<>0){
		 ?>

</div>
 
  </body>
</html>
