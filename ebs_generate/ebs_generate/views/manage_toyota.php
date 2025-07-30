<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<div class="body_resize"  align="center"> 

<div class="body_resize"  align="center"> 


<?php
        	
        		 $sql="SELECT a.id_master,a.company_name,a.customer_description,a.status_import,
					CASE a.status_import WHEN  0 THEN 'Manual' WHEN 1 THEN 'Import' END AS simport
					FROM ".DB_DATABASE.".ebs_customer_master a
					LEFT JOIN ".DB_DATABASE.".ebs_customer_destination b ON a.id_master=b.id_master
					WHERE 	a.id_master = '1'	
					GROUP BY a.id_master
					ORDER BY a.company_name ";
			


//echo  $sql;
$qr = mysqli_query($con, $sql);

if(mysqli_num_rows($qr)<>0){
	$i=1;
		?>
<div class="rightPane">  

  <table width="97%" height="163" border="1" bordercolor="#CC9966"class="table01">
    <tr >
      <th height="30" colspan="7">
      <div align="center">Manage Master for Toyota</div> </th>

      </tr>
      
    <tr>
      <th width="7%" height="30">No.</th>
      <th width="8%">Update </th>
      <th width="9%">Customer code </th>
      <th width="13%">Customer</th>
      <th width="38%">Description</th>
      <th width="10%">Plant</th>
      <th>Ship To Location </th>
      </tr>
       <?php while($rs=mysqli_fetch_array($qr)){  
		 $qp="SELECT a.id_master,a.company_name,a.customer_description,a.status_import,b.plant,
						CASE a.status_import WHEN 0 THEN 'Manual' WHEN 1 THEN 'Import' END AS simport ,b.customer_code,b.ship_name
			FROM ".DB_DATABASE.".ebs_customer_master a
			LEFT JOIN ".DB_DATABASE.".ebs_customer_destination b ON a.id_master=b.id_master
			WHERE a.id_master ='".$rs['id_master']."'
			AND b.deleted=0
			GROUP BY b.id_destination
			ORDER BY a.company_name,b.customer_code ";		
			$qrp=mysqli_query($con, $qp);
			$np=mysqli_num_rows($qrp);			
		
	   ?>
       
      <tr  <?php $v =0; $v = $v + 1; echo  icolor($v); ?> onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;">
      <td align="center" height="32" <?php if($np>1){ $nps = $np+1;echo "rowspan='".$nps."'";}?> ><?=$i?></td>
      <td align="center" <?php if($np>1){ $nps = $np+1;echo "rowspan='".$nps."'";}?>>
       <a href="#" onClick="javascript:openWins('windows.php?win=edit&idm=<?=$rs['id_master'];?>', '_blank', 950, 650, 1, 1, 0, 0, 0);return false;"  >
          <img src="../images/001_45.gif" width="24" height="24" />
          </a>
      </td>
     

      <?php
		 //Start multi row&column
		  if($np==1){ 
         	while($rsp=mysqli_fetch_array($qrp)){

		 ?>
          <td align="center" height="32"><?php echo sprintf("%05d", $rsp['customer_code']);?></td>
          <td align="center"><?php echo $rsp['company_name'];?></td>
          <td ><div class="tmagin_right"><? echo $rs['customer_description'];?></div></td>
          <td><?php echo $rsp['plant'];?></td>
          <td><?php echo $rsp['ship_name'];?></td>
             <?php
		 	}//	while($rsp=mysql_fetch_array($qrp)){
		}//if($np>1){ 
		?>
</tr>
        <?php
		 //Start multi row&column
		  if($np>1){ 
         	while($rsp=mysqli_fetch_array($qrp)){
					
		 ?>
            <tr  <?php $v =0; $v = $v + 1; echo  icolor($v); ?> onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;">
                <td align="center" height="30px"><?php echo sprintf("%05d", $rsp['customer_code']);?> </td>
                <td align="center"><?php echo $rsp['company_name'];?></td>
                <td ><div class="tmagin_right"><?php echo $rs['customer_description'];?></div></td>
                <td><?php echo $rsp['plant'];?></td>
                <td><?php echo $rsp['ship_name'];?></td>
            </tr>
             <?php
		 	}//	while($rsp=mysql_fetch_array($qrp)){
		}//if($np>1){ 
          //END  multi row&column
		  
		 ?>
     
    <?php
		$i++;	
			}//while($rs=mysql_fetch_array($qr)){
	?>
  
  </table>
         <?php
			}else{
				echo "<br/><br/><br/><center><div class='table_comment' >NO hava Data...Click  ";
				?>
                <a href="#" onClick="javascript:openWins('windows.php?win=add', '_blank',650, 380, 1, 1, 0, 0, 0);return false;" >  here    </a>
                <?php
				echo "  to create new  data </div> </center>";}//if(rows($qr)<>0){
		 ?>

</div>
