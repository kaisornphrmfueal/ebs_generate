
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<div class="body_resize"  align="center"> 
<div align="center">
    <?
			$gviewg=$_GET['vidg'];

				  	$sql="SELECT  a.group_id,a.customer_code,a.ship_to,order_no,b.id_customer_master,
						DATE_FORMAT(a.cpodate, '%d%m%Y') AS cpod,
						DATE_FORMAT(a.customer_request_date, '%d%m%Y') AS delid,
						'Y' AS fixy, a.qty, a.customer_part_no,a.currency,a.ship_method,'1' AS fix1,a.order_type						
						FROM ".DB_DATABASE.".ebs_group_order b
						LEFT JOIN ".DB_DATABASE.".ebs_report a ON b.group_id=a.group_id
						WHERE a.group_id = '$gviewg' ";

//echo "==".$sql;
			$qr = mysql_query($sql);
			if(mysql_num_rows($qr)<>0){
			$i=1;
			$filename="dowloads/".date("YmdHis").".csv";
			//$filename="dowloads/reportEBS.csv";
			$objWrite = fopen($filename, "w");
		?>
<div class="rightPane">  
<form id="form1" name="form1" method="post" action="">
       <table width="100%" height="140" border="1" bordercolor="#CC9966"class="table01">

    <tr>
     <th height="30" colspan="16">Order imported confirmation</th>
     <th height="30">
     </th>
     </tr>
    <tr>
      <th width="3%" height="30">No.</th>
      <th width="6%">Customer code</th>
      <th width="16%">Customer ship to</th>
      <th width="7%">Order</th>
      <th width="6%">CPO DATE</th>
      <th width="7%">Order Date</th>
      <th width="4%">&nbsp;</th>
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
      </tr>
   
    <?php 	
fwrite($objWrite, "\"Customer code\",\"Customer ship to\",\"Order\",\"CPO DATE\",\"Customer Requested Date\",\"fixed Y\",\"Qty\",");
fwrite($objWrite, "\"\",\"Customer Part no\",\"Currency\",\"Ship Method\",\"CPO DATE \",\"\",\"\",\"fixed 1\",\"$rs[order_type]\" ".PHP_EOL);
	
while($rs=mysql_fetch_array($qr)){ 
$idmaster=$rs['id_customer_master'];

fwrite($objWrite, "\"$rs[customer_code]\",\"$rs[ship_to]\",\"$rs[order_no]\",\"$rs[cpod]\",\"$rs[delid]\",\"$rs[fixy]\",\"Order Type\",");
fwrite($objWrite, "\"\",\"$rs[customer_part_no]\",\"$rs[currency]\",\"$rs[ship_method]\",\"$rs[cpod]\",\"\",\"\",\"$rs[fix1]\",\"$rs[order_type]\" ".PHP_EOL);
	 ?>
   	   <tr  <?php   echo icolor($v); $v = $v + 1; ?> onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;" height="25px" align="center" >
   	     <td height="34" ><div align="center">
   	       <?=$i?>
 	       </div></td>
	
   	     <td><?php echo $rs['customer_code'];?></td>
   	     <td><?php echo $rs['ship_to'];?></td>
   	     <td><?php echo $rs['order_no'];?></td> 
   	     <td><?php echo $rs['cpod'];?></td>
   	     <td><?php echo $rs['delid'];?></td>
   	     <td><?php echo $rs['fixy'];?></td>
   	     <td><?php echo $rs['qty'];?></td>
   	     <td>&nbsp;</td>
   	     <td><? echo $rs['customer_part_no'];?></td>
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
<a href="index.php?cid=<?=base64_encode($idmaster)?>" ><strong>Import Order again</strong></a> ||
<a href="report_to_excel.php?gids=<?=$gviewg?>" ><strong>Export to Excel</strong></a> ||

         <?
		 echo "<a href=$filename><strong>Export To CSV</strong></a>";
			}else{
				echo "<br/><br/><br/><center><div class='table_comment' >NO hava Data... </center>";
				}//if(rows($qr)<>0){
		 ?>

</div>
