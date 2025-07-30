<?php
	//Send Header
//header to give the order to the browser
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=exported-data.csv');

include ("../includes/configure.php");
include('../functions/function.php');

  
$gviewg=$_GET['gids'];
$guid=$_GET['uid'];
updateStatus($guid,$gviewg);


			$sql="SELECT  a.group_id,a.customer_code,a.ship_to,order_no,b.id_customer_master,
				DATE_FORMAT(a.cpodate, '%d%m%Y') AS cpod,
				DATE_FORMAT(a.customer_request_date, '%d%m%Y') AS delid,
				'Y' AS fixy, a.qty, a.customer_part_no,a.currency,a.ship_method,'1' AS fix1,a.order_type,
				a.gms_delivery_place_code,a.price_list
				FROM ".DB_DATABASE.".ebs_group_order b
				LEFT JOIN ".DB_DATABASE.".ebs_report a ON b.group_id=a.group_id
				WHERE a.group_id = '$gviewg' ";
						
						
			$qr = mysqli_query($con, $sql);
			if(mysqli_num_rows($qr)<>0){
			$i=1;
			//$filename="dowloads/".date("YmdHis").".csv";
			//$filename="dowloads/reportEBS.csv";
			$objWrite = fopen('php://output', 'w');
			//$objWrite = fopen($filename, "w");

			
				while($rs=mysqli_fetch_array($qr)){ 
				$idmaster=$rs['id_customer_master'];
				$idcustom=sprintf("%05d", $rs['customer_code']);
				
				fwrite($objWrite, "\"$idcustom\",\"$rs[ship_to]\",\"$rs[order_no]\",\"$rs[cpod]\",\"$rs[delid]\",\"$rs[fixy]\",\"$rs[qty]\",");
				fwrite($objWrite, "\"\",\"$rs[customer_part_no]\",\"$rs[currency]\",\"$rs[ship_method]\",\"$rs[cpod]\",\"\",\"\",\"$rs[fix1]\",\"$rs[order_type]\" ,\"$rs[gms_delivery_place_code]\" ,\"$rs[price_list]\" \r".PHP_EOL);
				
				}///while($rs=mysql_fetch_array($qr)){ 
			}//if(mysql_num_rows($qr)<>0){
			
	//gotopage($filename)

?>
