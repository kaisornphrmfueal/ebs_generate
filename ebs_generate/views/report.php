<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<div class="body_resize"  align="center"> 
<div align="center">
 <form id="form1" name="form1" method="post" action="">
   <table width="751" border="1" align="center" class="table01" >
     <tr>
       <td width="475" height="37"><div class="tmagin_right">Search : EmpID Import,Company Name, Date Import (Ex.2015-11): </div> </td>
       <td width="260">
              <input type="text" name="tsearch" id="tsearch" style=" width:180px;" />
       <input type="submit" name="button" id="button" value="Submit" /></td>
     </tr>
   </table>
</form>   
    <?php
        	if(!empty($_POST['tsearch'])){
				$txtsearsh= $_POST['tsearch'];
					$x="AND ((a.company_name LIKE '$txtsearsh%')  OR  (a.date_insert LIKE '$txtsearsh%') OR  (b.emp_insert LIKE '$txtsearsh%') )";
				}else{
						$x="";
					}
           	 $sql="SELECT a.id_master,a.company_name,a.status_import,
					CASE a.status_import WHEN 0 THEN 'Manual' WHEN 1 THEN 'Import' END AS simport ,
					CONCAT (c.name_en,' (',c.emp_id,')') AS en_name,b.file_name,
					date_format(b.date_insert,'%d-%b-%Y %H:%i') AS dates,
					 IFNULL(date_format(b.date_update,'%d-%b-%Y %H:%i'),'-') AS expdates,
					b.status_group,b.group_id 
					FROM ".DB_DATABASE.".ebs_customer_master a 
					LEFT JOIN ".DB_DATABASE.".ebs_group_order b ON a.id_master=b.id_customer_master 
					LEFT JOIN ".DB_DATABASE247.".so_employee_data AS c ON b.emp_insert=c.emp_id 
					WHERE ((status_group = 'Imported') OR (status_group = 'Inputed' )) 
					$x
					GROUP BY  b.group_id ORDER BY b.status_group DESC ,b.date_insert DESC limit 100  ";// OR (status_group = 'Exported' )
			


//echo  $sqlg;
$qr = mysqli_query($con, $sql);

if(mysqli_num_rows($qr)<>0){
	$i=1;
		?>
<div class="rightPane">  

  <table width="97%" height="172" border="1" bordercolor="#CC9966"class="table01">
    <tr >
      <th height="30" colspan="10">
      <div align="center">Report for EBS</div> </th>
      </tr>
      
    <tr>
      <th width="7%" height="30">No.</th>
       <th width="9%">Group No.</th>
      <th width="15%">Company Name </th>
      <th width="10%">Total Record</th>
      <th width="10%">Gerate By</th>
      <th width="11%">Gerate Date</th>
      <th width="13%">Exported Date</th>
      <th width="11%">Status</th>
      <th width="7%">Original Data</th>
      <th width="7%">Export </th>
    </tr>
       <?php while($rs=mysqli_fetch_array($qr)){   ?>
      <tr  <?php $v =0; $v = $v + 1; echo  icolor($v); ?> onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;" align="center">
      <td height="30px"><?=$i?></td>
      <td><?=$rs['group_id']?></td>
      <td><?php echo $rs['company_name'];?></td>
      <td><?php echo countRowsg($rs['group_id']);?></td>
      <td><?=$rs['en_name']?></td>
      <td><?=$rs['dates']?></td>
      <td>-</td>
      <td height="30px"><?=$rs['status_group']?></td>
      <td>
      <?php if (!empty($rs['file_name'])){?>
      <a target="_blank" href="uploads/<?=$rs['file_name']?>">   <img src="../images/001_38.gif" width="24" height="24" />
       </a>
       <?php }//?>
       </td>
      <td><a href="#" onClick="javascript:openWins('windows.php?win=export&idgr=<?=$rs['group_id'];?>', '_blank', 1150, 650, 1, 1, 0, 0, 0);return false;">
          <img src="../images/001_51.gif" width="24" height="24" /></a></td>
      
</tr>
	 <?php 
        $i++;
     
        }//	while($rsp=mysql_fetch_array($qrp)){
    ?>
  
  </table>
         <?php
			}else{
				echo "<br/><br/><br/><center><div class='table_comment' >NO hava Data... ";
			}//if(rows($qr)<>0){
		 ?>

</div>
