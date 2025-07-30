<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<div class="body_resize"  align="center"> 
<div align="center">
 <form id="form1" name="form1" method="post" action="">
   <table width="736" border="1" align="center" class="table01" >
     <tr>
       <td width="409" height="37"><div class="tmagin_right">Search : Company Name, Customer Code, Delivery Place : </div> </td>
       <td width="311">
              <input type="text" name="tsearch" id="tsearch" style=" width:180px;" />
       <input type="submit" name="button" id="button" value="Submit" /></td>
     </tr>
   </table>
</form>   
    <?
			if(!empty($_POST['tsearch'])){
				$txtsearsh= $_POST['tsearch'];
					$x="WHERE (a.company_name LIKE '$txtsearsh%')  OR  (b.customer_code LIKE '$txtsearsh%') OR  (b.plant LIKE '$txtsearsh%')";
				}else{
						$x="";
					}
        	$sql="SELECT a.id_master,a.company_name,a.customer_description,a.status_import,b.plant,
					CASE a.status_import WHEN  0 THEN 'Manual' WHEN 1 THEN 'Import' END AS simport
					FROM ".DB_DATABASE.".ebs_customer_master a
					LEFT JOIN ".DB_DATABASE.".ebs_customer_destination b ON a.id_master=b.id_master
						$x	
					GROUP BY a.id_master
					ORDER BY a.company_name ";
			

//echo  $sqlg;
$qr = mysql_query($sql);

if(mysql_num_rows($qr)<>0){
	$i=1;
		?>
<div class="rightPane">  

  <table width="100%" height="172" border="1" bordercolor="#CC9966"class="table01">
    <tr >
      <th height="30" colspan="7">
      <div align="center">Manage Customer Data</div> </th>
      <th width="12%" height="30">
  <img src="../images/001_01.gif" width="24" height="24" />
     <a href="#" onClick="javascript:openWins('windows.php?win=addc', '_blank', 850, 650, 1, 1, 0, 0, 0);return false;"  >
      Add Customer
      </a></th>
      </tr>
      
    <tr>
      <th width="7%" height="30">No.</th>
      <th width="10%">Company Name </th>
      <th width="29%">Description</th>
      <th width="7%">Status </th>
      <th width="8%">Update Plant</th>
      <th width="12%">Customer code </th>
      <th width="15%">Plant</th>
      <th>Ship To Location</th>
      </tr>
       <?php while(@extract($rs=mysql_fetch_array($qr))){  
		 $qp="SELECT id_destination,id_master,plant,customer_code,ship_name
		FROM ".DB_DATABASE.".ebs_customer_destination
		WHERE id_master ='".$rs['id_master']."'
		AND deleted=0 ";		
		$qrp=mysql_query($qp);
		 $np=mysql_num_rows($qrp);			
		
	   ?>
       
      <tr  <?php $v =0; $v = $v + 1; echo  icolor($v); ?> onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;">
      <td height="30px" <? if($np>1){ $nps = $np+1;echo "rowspan='".$nps."'";}?> ><?=$i?></td>
      <td <? if($np>1){ $nps = $np+1;echo "rowspan='".$nps."'";}?>><? echo $rs['company_name'];?></td>
      <td <? if($np>1){ $nps = $np+1;echo "rowspan='".$nps."'";}?>><div class="tmagin_right"><? echo $rs['customer_description'];?></div></td>
      <td <? if($np>1){ $nps = $np+1;echo "rowspan='".$nps."'";}?>><?=$rs['simport'];?></td>
      <td <? if($np>1){ $nps = $np+1;echo "rowspan='".$nps."'";}?>> 
       <a href="#" onClick="javascript:openWins('windows.php?win=edit&idm=<?=$rs['id_master'];?>', '_blank', 950, 650, 1, 1, 0, 0, 0);return false;"  >
          <img src="../images/001_45.gif" width="24" height="24" />
          </a>
          </td>
 <?
		 //Start multi row&column
		  if($np==1){ 
         	while($rsp=mysql_fetch_array($qrp)){
					
		 ?>
           
        <td height="30px"   ><? echo $rsp['customer_code'];?></td>
              <td><? echo $rsp['plant'];?></td>
              <td><div class="tmagin_right"><? echo $rsp['ship_name'];?></div></td>
          
             <?
		 	}//	while($rsp=mysql_fetch_array($qrp)){
		}//if($np>1){ 
		?>
</tr>
        <?
		 //Start multi row&column
		  if($np>1){ 
         	while($rsp=mysql_fetch_array($qrp)){
					
		 ?>
            <tr  <?php $v =0; $v = $v + 1; echo  icolor($v); ?> onMouseOver="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;">
              <td height="30px"   ><? echo $rsp['customer_code'];?></td>
              <td><? echo $rsp['plant'];?></td>
              <td><? echo $rsp['ship_name'];?></td>
            </tr>
             <?
		 	}//	while($rsp=mysql_fetch_array($qrp)){
		}//if($np>1){ 
          //END  multi row&column
		  
		 ?>
     
    <? 
		$i++;	
			}//while($rs=mysql_fetch_array($qr)){
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
