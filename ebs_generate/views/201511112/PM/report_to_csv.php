<?php
include ("../includes/configure.php");
$filName = "customer.csv";
    $objWrite = fopen("customer.csv", "w");

    $query = "SELECT a.group_id,a.customer_code,a.ship_to,order_no, DATE_FORMAT(a.cpodate, '%d%m%Y') AS cpod,
			 DATE_FORMAT(a.customer_request_date, '%d%m%Y') AS delid, 'Y' AS fixy, a.qty, a.customer_part_no,
			 a.currency,a.ship_method,'1' AS fix1,a.order_type 
			 FROM lgt_ebs_generate.ebs_group_order b 
			 LEFT JOIN lgt_ebs_generate.ebs_report a ON b.group_id=a.group_id 
			 WHERE a.group_id = '7' ";
    $run=mysql_query($query);

    while($objResult = mysql_fetch_array($run))
    {
        fwrite($objWrite, "\"$objResult[customer_code]\",\"$objResult[ship_to]\",\"$objResult[order_no]\",");
        fwrite($objWrite, "\"$objResult[cpod]\",\"$objResult[delid]\",\"$objResult[fixy]\" \n");
    }
    fclose($objWrite);

 	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=$filName");

	

	
	exit;

?>
