<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<div class="body_resize"  align="center"> 
<div align="center">
    <?
        	$sql="SELECT id_customer,company_name,delivery_place,customer_code,delivery_place_no,
				ship_name,price_list,customer_description,currency
				FROM ".DB_DATABASE.".ebs_customer
				ORDER BY company_name";


//echo  $sqlg;
$qr = mysql_query($sql);

if(mysql_num_rows($qr)<>0){
	$i=1;
		?>
<div class="rightPane">  
       <table width="100%" height="104" border="1" bordercolor="#CC9966"class="table01">

    <tr>
     <th height="30" colspan="7">
         Manage Customer Data</th>
     <th height="30">  <img src="../images/001_01.gif" width="24" height="24" />
     <a href="#" onClick="javascript:openWins('windows.php?win=add', '_blank', 650, 350, 1, 1, 0, 0, 0);return false;"  >
      Add New Data
      </a></th>
      </tr>
    <tr>
      <th width="3%" height="30">No.</th>
      <th width="13%">Company Name </th>
      <th width="9%">Customer Code</th>
      <th width="11%">Delivery Place Code</th>
      <th width="16%">Delivery Place </th>
      <th width="30%">Description</th>
      <th width="8%">Currency</th>
      <th width="10%">Edit</th>
      </tr>
   
    <?php 
								while($rs=mysql_fetch_array($qr)){  
								
								
								?>
   	   <tr  <?php   echo icolor($v); $v = $v + 1; ?> onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;" height="25px" align="center" >
   	     <td height="34" ><div align="center">
   	       <?=$i?>
 	       </div></td>
   	     <td><div  class="tmagin_right"> <?php echo $rs['company_name'];?></div></td> 
   	     <td><?php echo sprintf("%06d", $rs['customer_code']);?></td>
   	     <td><?php echo sprintf("%06d", $rs['delivery_place_no']);?></td>
   	     <td><div  class="tmagin_right"><?php echo $rs['delivery_place'];?></div></td>
   	     <td><div  class="tmagin_right"><? echo $rs['customer_description'];?></div></td>
   	     <td><?php echo $rs['currency'];?></td>
   	      <td>    <a href="#" onClick="javascript:openWins('windows.php?win=edit&ide=<?=$rs['id_customer'];?>', '_blank', 650, 380, 1, 1, 0, 0, 0);return false;"  >
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
                <a href="#" onClick="javascript:openWins('windows.php?win=add', '_blank',650, 380, 1, 1, 0, 0, 0);return false;" >  here    </a>
                <?
				echo "  to create new  data </div> </center>";}//if(rows($qr)<>0){
		 ?>

</div>
