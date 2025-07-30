
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<div class="body_resize"  align="center"> 
<div align="center">
    <?php
			$gviewg=$_GET['vidg'];

				  	$sql="SELECT  a.group_id,a.customer_code,a.ship_to,order_no,b.id_customer_master,
						DATE_FORMAT(a.cpodate, '%d%m%Y') AS cpod,
						DATE_FORMAT(a.customer_request_date, '%d%m%Y') AS delid,
						'Y' AS fixy, a.qty, a.customer_part_no,a.currency,a.ship_method,'1' AS fix1,a.order_type						
						FROM ".DB_DATABASE.".ebs_group_order b
						LEFT JOIN ".DB_DATABASE.".ebs_report a ON b.group_id=a.group_id
						WHERE a.group_id = '$gviewg' ";

//echo "==".$sql;
			$qr = mysqli_query($con, $sql);
			if(mysqli_num_rows($qr)<>0){
			$i=1;
		/*	$filename="dowloads/".date("YmdHis").".csv";
			//$filename="dowloads/reportEBS.csv";
			$objWrite = fopen($filename, "w");*/
		?>
<div class="rightPane">  
<form id="form1" name="form1" method="post" action="">
       <table width="100%" height="111" border="1" bordercolor="#CC9966"class="table01">

    <tr>
     <th height="30" colspan="16">Order imported confirmation</th>
     <th height="30">
     </th>
     </tr>
    <tr>
      <th width="3%" height="30px">No.</th>
      <th width="9%">Customer code</th>
      <th width="12%">Customer ship to</th>
      <th width="7%">Order</th>
      <th width="7%">CPO DATE</th>
      <th width="6%">Order Date</th>
      <th width="2%">&nbsp;</th>
      <th width="6%">Order Qty.</th>
      <th width="2%">&nbsp;</th>
      <th width="11%">Customer Part No.</th>
      <th width="6%">Currency</th>
      <th width="8%">Ship Method</th>
      <th width="5%">CPO DATE</th>
      <th width="2%">&nbsp;</th>
      <th width="2%">&nbsp;</th>
      <th width="3%">&nbsp;</th>
      <th width="9%">Order Type </th>
      </tr>
   
    <?php 	
/*fwrite($objWrite, "\"Customer code\",\"Customer ship to\",\"Order\",\"CPO DATE\",\"Customer Requested Date\",\"fixed Y\",\"Qty\",");
fwrite($objWrite, "\"\",\"Customer Part no\",\"Currency\",\"Ship Method\",\"CPO DATE \",\"\",\"\",\"fixed 1\",\"order_type\" ".PHP_EOL);*/
	
while($rs=mysqli_fetch_array($qr)){ 
$idmaster=$rs['id_customer_master'];
$idcustom=sprintf("%05d", $rs['customer_code']);
/*fwrite($objWrite, "\"$idcustom\",\"$rs[ship_to]\",\"$rs[order_no]\",\"$rs[cpod]\",\"$rs[delid]\",\"$rs[fixy]\",\"$rs[qty]\",");
fwrite($objWrite, "\"\",\"$rs[customer_part_no]\",\"$rs[currency]\",\"$rs[ship_method]\",\"$rs[cpod]\",\"\",\"\",\"$rs[fix1]\",\"$rs[order_type]\"\r".PHP_EOL);*/
	 ?>
   	   <tr  <?php $v =0; $v = $v + 1; echo  icolor($v); ?>  onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;" height="25px" align="center" >
   	     <td height="27" ><div align="center">
   	       <?php echo $i?>
 	       </div></td>
	
   	     <td><?php echo sprintf("%05d", $rs['customer_code']);?> </td>
   	     <td><?php echo $rs['ship_to'];?></td>
   	     <td><?php echo $rs['order_no'];?></td> 
   	     <td><?php echo $rs['cpod'];?></td>
   	     <td><?php echo $rs['delid'];?></td>
   	     <td><?php echo $rs['fixy'];?></td>
   	     <td><?php echo $rs['qty'];?></td>
   	     <td>&nbsp;</td>
   	     <td><?php echo $rs['customer_part_no'];?></td>
   	     <td><?php echo $rs['currency'];?></td>
   	     <td><?php echo $rs['ship_method'];?></td>
   	     <td><?php echo $rs['cpod'];?></td>
   	     <td>&nbsp;</td>
   	     <td>&nbsp;</td>
   	  	 <td><?php echo $rs['fix1'];?></td>
   	      <td><?php echo $rs['order_type'];?></td>
   	     </tr>
          <?php						
		$i++;	
			}
		
    ?>
  
  </table>
</form>
<?php 
	if($idmaster==1){
		
		echo "<a href='index.php?cid=".base64_encode("1_cal")."' ><strong>Import Order again (by Calculation)</strong></a> ||";
?>
	
<?php 	} ?>
<a href="index.php?cid=<?php echo base64_encode($idmaster)?>" ><strong>Import Order again </strong></a> ||
<a href="report_to_excel.php?gids=<?php echo $gviewg?>&uid=<?php echo $user_login?>"><strong>Export to Excel</strong></a> || 
<a href="report_to_csv.php?gids=<?php echo $gviewg?>&uid=<?php echo $user_login?>" target="_blank" ><strong>Export To CSV</strong></a>
         <?php
			}else{
				echo "<br/><br/><br/><center><div class='table_comment' >NO hava Data... </center>";
				}//if(rows($qr)<>0){
		 ?>

</div>
