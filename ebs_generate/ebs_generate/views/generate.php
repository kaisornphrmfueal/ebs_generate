<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<div class="body_resize"  align="center"> 

 <form id="form1" name="form1" method="post" action="">
   <table width="736" border="1" align="center" class="table01" >
     <tr>
       <td width="409" height="37"><div class="tmagin_right">Search : Company Name, Customer Code, Plant : </div> </td>
       <td width="311">
              <input type="text" name="tsearch" id="tsearch" style=" width:180px;" />
       <input type="submit" name="button" id="button" value="Submit" /></td>
     </tr>
   </table>
</form>   
    <?php
        	if(!empty($_POST['tsearch'])){
				$txtsearsh= $_POST['tsearch'];
					$x="AND (a.company_name LIKE '$txtsearsh%')  OR  (b.customer_code LIKE '$txtsearsh%') OR  (b.plant LIKE '$txtsearsh%')";
				}else{
						$x="";
					}
        		 $sql="SELECT a.id_master,a.company_name,a.customer_description,a.status_import,
					CASE a.status_import WHEN  0 THEN 'Manual' WHEN 1 THEN 'Import' END AS simport
					FROM ".DB_DATABASE.".ebs_customer_master a
					LEFT JOIN ".DB_DATABASE.".ebs_customer_destination b ON a.id_master=b.id_master
					WHERE 	a.id_master != '1'  $x	
					GROUP BY a.id_master
					ORDER BY a.company_name ";
			


//echo  $sqlg;
$qr = mysqli_query($con, $sql);

if(mysqli_num_rows($qr)<>0){
	$i=1;
		?>
<div class="rightPane">  

  <table width="97%" height="172" border="1" bordercolor="#CC9966"class="table01">
    <tr >
      <th height="30" colspan="7">
      <div align="center">Manage Customer Data</div> </th>
      </tr>
      
    <tr>
      <th width="7%" height="30">No.</th>
      <th width="12%">Generate report</th>
      <th>Customer code </th>
      <th>Customer</th>
      <th>Description</th>
      <th>Plant</th>
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
      <td height="30px" <?php if($np>1){ $nps = $np+1;echo "rowspan='".$nps."'";}?> ><?=$i?></td>
      <td <?php if($np>1){ $nps = $np+1;echo "rowspan='".$nps."'";}?>>
      <?php  	if($rs['simport']=="Import"){ ?>
          		<a href="index.php?cid=<?=base64_encode($rs['id_master'])?>" ><img src="../images/<?php echo "import";?>.png" /></a>   
                <br/><br/>
                <a href="index.php?cid=<?=base64_encode("manual")?>&smid=<?=$rs['id_master']?>" ><img src="../images/<?php echo "manual";?>.png" /></a>
		<?php	}else{ ?>
          	<a href="index.php?cid=<?=base64_encode("manual")?>&smid=<?=$rs['id_master']?>" ><img src="../images/<?php echo "manual";?>.png" /></a>   
		<?php 	}//	if($rs['simport']=="Import"){  ?>
      </td>
     

      <?php
		 //Start multi row&column
		  if($np==1){ 
         	while($rsp=mysqli_fetch_array($qrp)){

		 ?>
          <td height="30px"><?php echo sprintf("%05d", $rsp['customer_code']);?></td>
          <td><?php echo $rsp['company_name'];?></td>
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
                <td height="30px"><?php echo sprintf("%05d", $rsp['customer_code']);?> </td>
                <td><?php echo $rsp['company_name'];?></td>
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
