

<?
//echo "==".$_POST['btnhid'];
if($_POST['btnhid']=="Save"){
			$mast_id=$_POST['hidm'];
			$sqli="INSERT INTO ".DB_DATABASE.".ebs_customer_destination SET 
				id_master='".$_POST['hidm']."', plant='".$_POST['plant']."', destination_name='".$_POST['dname']."',
				customer_code='".$_POST['code']."', ship_name='".$_POST['sname']."', price_list='".$_POST['plist']."', 
				currency='".$_POST['cern']."',remark='".$_POST['remark']."', emp_insert='$user_login', date_insert='".date('Y-m-d H:i:s')."'";        
		$qri=mysql_query($sqli);
		if($qri){
			//go_page_opener("?msg=true");
			$maxdest  = selectMaxDest($user_login);
			log_hist($user_login,'Add','ebs_customer_destination',$maxdest);
			gotopage("windows.php?win=dest&idm=$mast_id");
			}else{
					alert("Can't save data, plase try again.");
				}
		
	}else if($_POST['btnhid']=="Update"){
		$mast_id=$_POST['hidmm'];
		  $sqli="UPDATE ".DB_DATABASE.".ebs_customer_destination SET plant='".$_POST['plant']."', 
				destination_name='".$_POST['dname']."', customer_code='".$_POST['code']."', ship_name='".$_POST['sname']."',
				 price_list='".$_POST['plist']."', currency='".$_POST['cern']."', remark='".$_POST['remark']."',
				 emp_update='$user_login', date_update='".date('Y-m-d H:i:s')."' WHERE id_destination='".$_POST['hidd']."'";
		$qri=mysql_query($sqli);
		if($qri){
			log_hist($user_login,'UPDATE','ebs_customer_destination',$_POST['hidd']);
			gotopage("windows.php?win=dest&idm=$mast_id");
			}else{
					alert("Can't update data, plase try again.");
				}
		
		}


	//---------------
	if($_GET['del']=="delete"){
		 	$masti=$_GET['idm'];
		    $sqli="UPDATE ".DB_DATABASE.".ebs_customer_destination SET deleted=1,
					emp_update='$user_login', date_update='".date('Y-m-d H:i:s')."'
						 WHERE id_destination='".$_GET['ids']."'";
		$qri=mysql_query($sqli);
		if($qri){
			log_hist($user_login,'Deleted','ebs_customer_destination',$_GET['ids']);
			gotopage("windows.php?win=dest&idm=$masti");
			}else{
					alert("Can't update data, plase try again.");
				}
		
		}//if($_GET['del']=="delete"){

		
?>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? $gid=$_GET['idm'];?>
                  
 		<div align="center">   
       	  <a href='windows.php?win=addc&ide=<?=$gid?>'>Manage Customer Master</a>  ||
   		  <a href='windows.php?win=edit&idm=<?=$gid?>'>Manage Destination</a> </div>
     
       <?

			if($_GET['ida']=="addst"){
					 //&eid=pedit
					if($_GET['eid']=="pedit"){
						$iddest=$_GET['ids'];
						$sqle=" SELECT a.id_destination,a.id_master,a.plant,a.destination_name,a.remark,
							a.customer_code,a.ship_name,a.price_list,a.currency,b.company_name
							FROM ".DB_DATABASE.".ebs_customer_master b
							LEFT JOIN ".DB_DATABASE.".ebs_customer_destination a ON  b.id_master = a.id_master	
							WHERE a.id_destination ='$iddest'" ; //$iddest=$_GET['ids'];
					
					}else{
						$sqle=" SELECT b.company_name, b.id_master 
							FROM ".DB_DATABASE.".ebs_customer_master b
							WHERE b.id_master ='$gid'" ; //$iddest=$_GET['ids'];
						}
					//	echo $sqle;
					$qre=mysql_query($sqle);
					$rse=mysql_fetch_array($qre);
					$id_dest = $rse['id_destination'];
					
			?>
        
	    <form id="form1" name="form1" method="post" action=""onSubmit="JavaScript:return Checkdata();" autocomplete="off">
        <table width="766" border="1" class="table01" align="center">
              <tr>
                <th height="28" colspan="2" >  Destination</th>
              </tr>
               <tr>
        <td width="337" height="25"><div class="tmagin_left">Company Name :</div></td>  
        <td width="780"><div class="tmagin_right"><? echo $rse['company_name']?></div></td>
          </tr>
             <tr>
            <td width="337" height="25"><div class="tmagin_left">Customer Code :</div></td>
            <td width="780"><div class="tmagin_right">
              <input type="text" name="code" id="code" value="<?=$rse['customer_code']?>"/>  
              <span class="Arial_14_red">*Exp. 2</span></div></td>
          </tr>
           <tr>
            <td width="337" height="25"><div class="tmagin_left">Plant :</div></td>  
            <td width="780"><div class="tmagin_right">
              <input type="text" name="plant" id="plant" size="45" value="<?=$rse['plant']?>"/>
            </div></td>
          </tr>
             <tr>
            <td width="337" height="25"><div class="tmagin_left">Destication  Name :</div></td>
            <td width="780"><div class="tmagin_right">
              <input type="text" name="dname" id="dname" size="45" value="<?=$rse['destination_name']?>"/> 
              <span class="Arial_14_red">*Exp. TK Gateway Factory </span></div></td>
          </tr>
          <tr>
            <td width="337" height="25"><div class="tmagin_left">Currency :</div></td>
            <td width="780"><div class="tmagin_right"> <input type="text" name="cern" id="cern" value="<?=$rse['currency']?>"/> 
              <span class="Arial_14_red">*Exp.THB</span></div></td>
          </tr>
           <tr>
            <td width="337" height="25"><div class="tmagin_left">Price List:</div></td>  
            <td width="780"><div class="tmagin_right">
              <input type="text" name="plist" id="plist" size="45" value="<?=$rse['price_list']?>"/>
            <span class="Arial_14_red">*Exp.FTTL_TK_LINE_THB</span> </div></td>
          </tr>
   
          <tr>
            <td width="337" height="25"><div class="tmagin_left">Ship To:</div></td>
            <td width="780"><div class="tmagin_right">
              <input type="text" name="sname" id="sname" size="45" value="<?=$rse['ship_name']?>"/> 
              <span class="Arial_14_red">*Exp.TK_FG_SHIP</span>
            </div></td>
          </tr>
          <tr>
            <td width="337" height="25"><div class="tmagin_left">Remark :</div></td>
            <td width="780"><div class="tmagin_right">
              <textarea name="remark" id="remark" cols="40" rows="3"><?=$rse['remark']?></textarea>
            </div></td>
          </tr>
              <tr>
                <td height="25" colspan="2" align="center" >
                                <?php  if($_GET['eid']=="pedit"){
                                            echo "<input id='cssbutton'  name='button' type='submit' value='Update' />";
											echo "<input id='cssbutton'  name='btnhid' type='hidden' value='Update' />";
                                            echo "<input type='hidden' name='hidd' id='hidd'  value='$id_dest' />";
											echo "<input type='hidden' name='hidmm' id='hidmm'  value='$gid' />";
										//	echo "==".$id_dest.$gid;
                                        }else{
                                            echo "<input id='cssbutton'  name='button' type='submit' value='Save' />";
											echo "<input id='cssbutton'  name='btnhid' type='hidden' value='Save' />";
                                            echo "<input type='hidden' name='hidm' id='hidm'  value='$gid' />";
											
                                    }?>
                    <input type=button value="Close Window" onclick="javascript: window.opener.location.reload();window.close();" />
                   
            
                </td>
              </tr>
         </table>
        </form>
        
                
		<?	}//if(GET['id'])	   ?>              
                     
    <?
       		 	$sql="SELECT a.id_destination,a.id_master,a.plant,a.destination_name,a.remark,
						a.customer_code,a.ship_name,a.price_list,a.currency,b.company_name
						FROM ".DB_DATABASE.".ebs_customer_master b
						LEFT JOIN ".DB_DATABASE.".ebs_customer_destination a ON  b.id_master = a.id_master
						WHERE a.id_master ='$gid'
						AND deleted=0
						ORDER BY a.id_destination";
				$qr=mysql_query($sql);
				$num=mysql_num_rows($qr);
				//echo $sql;
				if($num<>0){
					$i=1;
	   ?>
                
<table width="98%" border="1" class="table01" align="center">
          <tr>
            <th height="30" colspan="9"> Manage Destination</th>
            <th height="30" colspan="2">  <a  href="windows.php?win=dest&ida=addst&idm=<?=$gid?>">Add new</a> </th>
            </tr>
               <tr>
                  <th width="69" height="24">No</th>
                  <th width="88"><span class="tmagin_left">Company Name</span></th>
                  <th><span class="tmagin_left">Customer Code</span></th>
                  <th><span class="tmagin_left">Plant</span></th>
                  <th><span class="tmagin_left">Destication</span></th>
                  <th><span class="tmagin_left">Currency</span></th>
                  <th>Price List</th>
                  <th><span class="tmagin_left">Delivery Name</span></th>
                  <th><span class="tmagin_left">Remark</span></th>
                  <th width="43">Edit</th>
                  <th>Delete</th>
       	     </tr>
            <?php
            		while($rs=mysql_fetch_array($qr)){
			?>
        
           <tr  <?php echo icolor($v); $v = $v + 1; ?> onmouseover="className=&quot;over&quot;"  onMouseOut="className=&quot;&quot;" height="25px" align="center">
            <td height="24"><?=$i?></td>
            <td height="24"><?php echo $rs['company_name'];?></td>
            <td width="75"><?php echo $rs['customer_code'];?></td>
            <td width="109"><?php echo $rs['plant'];?></td>
            <td width="111"><?php echo $rs['destination_name'];?></td>
            <td width="65"><?php echo $rs['currency'];?></td>
            <td width="192"><?php echo $rs['price_list'];?></td>
            <td width="139"><?php echo $rs['ship_name'];?></td>
            <td width="121"><?php echo $rs['remark'];?></td>
            <td>
              <a  href="windows.php?win=dest&eid=pedit&ida=addst&idm=<?=$gid?>&ids=<?=$rs['id_destination']?>">
                <img src="../images/b_edit.png" border="0" />
              </a>            </td>
            <td width="55">
             <a href="windows.php?win=dest&idm=<?=$gid?>&ids=<?=$rs['id_destination']?>&amp;del=delete" onclick="return ConfirmDel();" >	
            				<img src="../images/ci_del.gif" border="0" />
                    </a></td>
           </tr>
          	<?php
					$i++;
            			}//while($rs=mysql_fetch_array($qr)){
			?>
        </table>
		<?php
		
				}//if($num<>0){
						else
						{
						?>
<br/>
</p>
						<p><br/>
	  </p>
						<center>
						<div class="table_comment" >NO hava Data..Click <a href="windows.php?win=dest&idm=<?=$gid?>&ida=addst">here</a> to add new part</div>
					  </center>

						  <? 
							}
							
					  ?>
<div align="center">	<input type=button value="Close Window" onclick="javascript: window.opener.location.reload();window.close();" /></div>
 