<?php


//*---------------------------------SUb time----------------------------//
function subtime($t_time){
		 $rest = substr($t_time, 0, -3);
		 return $rest; 
		}
//----------------------------- LOG HOSTORY -------------------------------------------------//

	
	/////////-----------------///////////////

	function log_hist($user_id,$action,$table,$id_action)
 {
  $rec_date = date('Y-m-d H:i:s');
  $database_log =DB_DATABASE;
  if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
								$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
								} else {
								$ip = $_SERVER["REMOTE_ADDR"];
						}//else {
	 	 $sqll = "INSERT INTO $database_log.ebs_log_history SET  emp_id='$user_id',
					 action_name='$action', table_name='$table', table_id_action='$id_action', 
					reccord_date='$rec_date', ip_address='$ip', mac_address=''";					

 		mysql_query($sqll);
// echo "==".$sql ;
 }	
 function selectName($ilog){
		$database = DB_DATABASE247;
		 $sqln = "SELECT CONCAT(name_en,' ',lastname_en) AS sname FROM $database.so_employee_data WHERE emp_id = '$ilog' ";
 		$qrn=mysql_query($sqln);
		$rsn=mysql_fetch_array($qrn);
		return $rsn['sname'];
	
	}
	
 function selectMaxCust($user){
		$database = DB_DATABASE;
		 $sqln = "SELECT MAX(id_master) AS mxid FROM $database.ebs_customer_master WHERE emp_insert = '$user'";
 		$qrn=mysql_query($sqln);
		$rsn=mysql_fetch_array($qrn);
		return $rsn['mxid'];
	
	}
 function selectMaxDest($user){
		$database = DB_DATABASE;
		 $sqln = "SELECT MAX(id_destination) AS dest FROM $database.ebs_customer_destination  WHERE emp_insert = '$user'";
 		$qrn=mysql_query($sqln);
		$rsn=mysql_fetch_array($qrn);
		return $rsn['dest'];
	
	}
 function selectMaxModel($user){
		$database = DB_DATABASE;
		 $sqln = " SELECT MAX(id_part)  AS mxisp FROM $database.ebs_part_master WHERE emp_insert = '$user'";
 		$qrn=mysql_query($sqln);
		$rsn=mysql_fetch_array($qrn);
		return $rsn['mxisp'];
	
	}
 function selectMaxgroup($user){
		$database = DB_DATABASE;
		  $sqlgi = " SELECT MAX(group_id)  AS mxgroup FROM $database.ebs_group_order WHERE emp_insert = '$user' ";
 		$qrgi=mysql_query($sqlgi);
		$rsgi=mysql_fetch_array($qrgi);
		return $rsgi['mxgroup'];
	
	}
	
 function selectCountNull($groupid){
		$database = DB_DATABASE;
		  $sqlgi = " SELECT COUNT(*)  AS status_empty
				 FROM $database.ebs_order_original a 
				 LEFT JOIN $database.ebs_part_master c ON a.customer_part_no = c.customer_part 
				 WHERE a.group_id='$groupid'
				 AND c.pass_thru_status IS NULL ";
 		$qrgi=mysql_query($sqlgi);
		$rsgi=mysql_fetch_array($qrgi);	
		return $rsgi['status_empty'];
	
	}
	
	 function selectCustN($cust){
		$database = DB_DATABASE;
	 	$sqlc = "SELECT company_name FROM $database.ebs_customer_master WHERE id_master = '$cust'  ";
 		$qrc=mysql_query($sqlc);
		$rsc=mysql_fetch_array($qrc);
		return $rsc['company_name'];
	
	}
	 function updateStatus($user,$group){
		$database = DB_DATABASE;
		 $sqls = "UPDATE $database.ebs_group_order SET status_group='Exported', 
				emp_update='$user', date_update='".date('Y-m-d H:i:s')."' WHERE group_id='$group'";
 		$qrs=mysql_query($sqls);
		
	}
	
	
	 function countRowsg($group){
		$database = DB_DATABASE;
		 $sqlr = "SELECT count(*) AS crows FROM $database.ebs_report WHERE group_id = '$group' ";
 		$qrr=mysql_query($sqlr);
		$rsr=mysql_fetch_array($qrr);
		return $rsr['crows'];
	}
	
	
	
//----------------------------------END PATH---------------------------------------//
////////////////////////////////////////// Date show////////////////////////////////////////////////////////////	
function echodate($dshow){
		$a = $dshow;
		list($d,$m,$y) = explode('-',$a);
		$ndate= date("d M Y", strtotime($y.'-'.$m.'-'.$d));
		 return $ndate; // Êè§¤èÒ¡ÅÑº
		}
		//echo echodate("2012-11-11");
		

/*-----------------------------------------------------------*/
 ///////////////////// ip ////////////////////

	function getValeInput($input,$typ){
		$instr = "";
		if($typ=="int"){ $instr="".(int)$_POST[$input].",";	
		}else if($typ=="float"){ $instr = "".(float)$_POST[$input].",";			
		}else if($typ=="vchar"){ $instr = "'".$_POST[$input]."',";		
		}else if($typ=="file_name"){ $instr = "'".$_FILES[$input]['name']."',";	
		}else if($typ=="date"){ $instr = "'".date("Y-m-d")."',";			
		}else if($typ=="dtime"){ $instr = "'".date("Y-m-d H:i:s")."',";			
		}else if($typ=="ip"){ $instr = "'".$_SERVER['REMOTE_ADDR']."',";		
		}else if($typ=="imgbyte"){
			 $instr = "'".addslashes(fread(fopen($_FILES[$input]['tmp_name'],"r"),filesize($_FILES[$input]['tmp_name'])))."',";			
		}
		return $instr;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////


function insertPOST($tb){
			$strN = ""; $strVal = "";
			foreach ($_POST as $key => $value){ 
			list($a) = explode("*", $key);
			list($b) = explode("*", $value);
			if( $b != ' ' ){  $strN .= $a.",";  $strVal .="'". $b."',"; 	}
			}
			$strN = substr($strN,4,-1); 
			$strVal = substr($strVal,6,-1);
			$sql = " insert into $tb ($strN) values ($strVal) "; //echo $sql; exit;
			return q( $sql ) or die( mysql_error()." No : ".mysql_errno() );
}


function updatePOST($tb,$wh=''){ 
			$strVal = "";
				foreach ($_POST as $key => $value){ 
			list($a) = explode("*", $key);
			list($b) = explode("*", $value);
			if( $b != ' ' ){  $strVal .= $a." = " ."'". $b."',"; 	}
			}
			$strVal = substr($strVal,12,-1);
			$sql = " update $tb set $strVal $wh ";  //echo $sql; exit;
			return q( $sql ) or die( mysql_error()." No : ".mysql_errno() );
	}
	
	#55555555555555555555555555
	
	function data_visible($table,$hfile,$status,$hid,$hvalue){

	if ($status=="Y")
		$xstatus="N";
	else
		$xstatus="Y";
	$sql ="UPDATE $table SET $hfile='$xstatus' WHERE $hid=$hvalue";
	return q( $sql ) or die( mysql_error()." No : ".mysql_errno() );
}


######################################
function delete_data($table,$did,$dvalue){
	$sql ="DELETE FROM $table WHERE $did=$dvalue";
	return q( $sql ) or die( mysql_error()." No : ".mysql_errno() );
}
	
# 55555555555555555555555555555555555555555555555555555555555555555555555555555555555555555 #
	function delete($table_sql){
        return mysql_query(" delete from $table_sql ") or die( mysql_error()." No : ".mysql_errno() );	
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function query($sql){
		return mysql_query($sql);
}
function rows($re)
{
	$i = mysql_num_rows($re);
	return $i;
}
function fetch($re)
{
	return mysql_fetch_array($re);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function alert($t)
	{
		echo "<script language='javascript'>";
		echo "alert('$t');";
		echo "</script>";
	}
	
function go_page_opener($url){
		//echo "<font size=2 color=green>processing...</font>";
		echo "<script type=\"text/javascript\">window.opener.location.reload(); window.close();</script>";
	}	
	
			function gotopage($t)
	{
		echo "<script language='javascript'>";
		echo "window.location='$t';";
		echo "</script>";
	}
	
	
	function icolor($i)
{
			if ($i%2 == 0)
			{
				echo "bgcolor='#EDF5FC' ";
			}else{
			
				echo  "bgcolor='#FFFFFF' ";
			}
}
////////////////////////////////////áºè§Ë¹éÒ
function pnavigator($before_p,$plus_p,$total,$total_p,$chk_page,$upage){      
    global $urlquery_str;   
    $pPrev=$chk_page-1;   
    $pPrev=($pPrev>=0)?$pPrev:0;   
    $pNext=$chk_page+1;   
    $pNext=($pNext>=$total_p)?$total_p-1:$pNext;        
    $lt_page=$total_p-4;  
	$nClass=""; 
    if($chk_page>0){     
        echo "<a  href='?id=".$upage."&s_page=$pPrev&urlquery_str=".$urlquery_str."' class='naviPN'>Prev</a>";   
    }   
    if($total_p>=11){   
        if($chk_page>=4){   
            echo "<a $nClass href='?id=".$upage."&s_page=0&urlquery_str=".$urlquery_str."'>1</a><a class='SpaceC'>. . .</a>";      
        }   
        if($chk_page<4){   
            for($i=0;$i<$total_p;$i++){     
                $nClass=($chk_page==$i)?"class='selectPage'":"";   
                if($i<=4){   
                echo "<a $nClass href='?id=".$upage."&s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";      
                }   
                if($i==$total_p-1 ){    
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?id=".$upage."&s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";      
                }          
            }   
        }   
        if($chk_page>=4 && $chk_page<$lt_page){   
            $st_page=$chk_page-3;   
            for($i=1;$i<=5;$i++){   
                $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";   
                echo "<a $nClass href='?id=".$upage."&s_page=".intval($st_page+$i).@$_SESSION['ses_qCurProvince']."'>".intval($st_page+$i+1)."</a> ";         
            }   
            for($i=0;$i<$total_p;$i++){     
                if($i==$total_p-1 ){    
                $nClass=($chk_page==$i)?"class='selectPage'":"";   
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?id=".$upage."&s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";      
                }          
            }                                      
        }      
        if($chk_page>=$lt_page){   
            for($i=0;$i<=4;$i++){   
                $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";   
                echo "<a $nClass href='?id=".$upage."&s_page=".intval($lt_page+$i-1).@$_SESSION['ses_qCurProvince']."'>".intval($lt_page+$i)."</a> ";      
            }   
        }           
    }else{   
        for($i=0;$i<$total_p;$i++){     
            $nClass=($chk_page==$i)?"class='selectPage'":"";   
            echo "<a href='?id=".$upage."&s_page=$i&urlquery_str=".$urlquery_str."' $nClass  >".intval($i+1)."</a> ";      
        }          
    }      
    if($chk_page<$total_p-1){   
        echo "<a href='?id=".$upage."&s_page=$pNext&urlquery_str=".$urlquery_str."'  class='naviPN'>Next</a>";   
    }   
}      
/// PAGE USER  -------

////////////////////////////////////áºè§Ë¹éÒ
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){     
    global $urlquery_str;  
    $pPrev=$chk_page-1;  
    $pPrev=($pPrev>=0)?$pPrev:0;  
    $pNext=$chk_page+1;  
    $pNext=($pNext>=$total_p)?$total_p-1:$pNext;       
    $lt_page=$total_p-4;  
    if($chk_page>0){    
        echo "<a  href='?s_page=$pPrev&urlquery_str=".$urlquery_str."' class='naviPN'>Prev</a>";  
    }  
    if($total_p>=11){  
        if($chk_page>=4){  
            echo "<a $nClass href='?s_page=0&urlquery_str=".$urlquery_str."'>1</a><a class='SpaceC'>. . .</a>";     
        }  
        if($chk_page<4){  
            for($i=0;$i<$total_p;$i++){    
                $nClass=($chk_page==$i)?"class='selectPage'":"";  
                if($i<=4){  
                echo "<a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";     
                }  
                if($i==$total_p-1 ){   
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";     
                }         
            }  
        }  
        if($chk_page>=4 && $chk_page<$lt_page){  
            $st_page=$chk_page-3;  
            for($i=1;$i<=5;$i++){  
                $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";  
                echo "<a $nClass href='?s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";      
            }  
            for($i=0;$i<$total_p;$i++){    
                if($i==$total_p-1 ){   
                $nClass=($chk_page==$i)?"class='selectPage'":"";  
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";     
                }         
            }                                     
        }     
        if($chk_page>=$lt_page){  
            for($i=0;$i<=4;$i++){  
                $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";  
                echo "<a $nClass href='?s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";     
            }  
        }          
    }else{  
        for($i=0;$i<$total_p;$i++){    
            $nClass=($chk_page==$i)?"class='selectPage'":"";  
            echo "<a href='?s_page=$i&urlquery_str=".$urlquery_str."' $nClass  >".intval($i+1)."</a> ";     
        }         
    }     
    if($chk_page<$total_p-1){  
        echo "<a href='?s_page=$pNext&urlquery_str=".$urlquery_str."'  class='naviPN'>Next</a>";  
    }  
}      
/// PAGE USER  -------


function page_navigator_user($before_p,$plus_p,$total,$total_p,$chk_page,$gpage,$gtxt){      
    global $urlquery_str;   
    $pPrev=$chk_page-1;   
    $pPrev=($pPrev>=0)?$pPrev:0;   
    $pNext=$chk_page+1;   
    $pNext=($pNext>=$total_p)?$total_p-1:$pNext;        
    $lt_page=$total_p-4;   
    if($chk_page>0){     
        echo "<a  href='?id=".$gpage."&serh=".$gtxt."&s_page=$pPrev&urlquery_str=".$urlquery_str."' class='naviPN'>Prev</a>";   
    }   
    if($total_p>=11){   
        if($chk_page>=4){   
            echo "<a $nClass href='?id=".$gpage."&serh=".$gtxt."&s_page=0&urlquery_str=".$urlquery_str."'>1</a><a class='SpaceC'>. . .</a>";      
        }   
        if($chk_page<4){   
            for($i=0;$i<$total_p;$i++){     
                $nClass=($chk_page==$i)?"class='selectPage'":"";   
                if($i<=4){   
                echo "<a $nClass href='?id=".$gpage."&serh=".$gtxt."&s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";      
                }   
                if($i==$total_p-1 ){    
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?id=".$gpage."&serh=".$dates."&s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";      
                }          
            }   
        }   
        if($chk_page>=4 && $chk_page<$lt_page){   
            $st_page=$chk_page-3;   
            for($i=1;$i<=5;$i++){   
                $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";   
                echo "<a $nClass href='?id=".$gpage."&serh=".$gtxt."&s_page=".intval($st_page+$i).@$_SESSION['ses_qCurProvince']."'>".intval($st_page+$i+1)."</a> ";         
            }   
            for($i=0;$i<$total_p;$i++){     
                if($i==$total_p-1 ){    
                $nClass=($chk_page==$i)?"class='selectPage'":"";   
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?id=".$gpage."&serh=".$dates."&s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";      
                }          
            }                                      
        }      
        if($chk_page>=$lt_page){   
            for($i=0;$i<=4;$i++){   
                $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";   
                echo "<a $nClass href='?id=".$gpage."&serh=".$gtxt."&s_page=".intval($lt_page+$i-1).@$_SESSION['ses_qCurProvince']."'>".intval($lt_page+$i)."</a> ";      
            }   
        }           
    }else{   
        for($i=0;$i<$total_p;$i++){     
            $nClass=($chk_page==$i)?"class='selectPage'":"";   
            echo "<a href='?id=".$gpage."&serh=".$gtxt."&s_page=$i&urlquery_str=".$urlquery_str."' $nClass  >".intval($i+1)."</a> ";      
        }          
    }      
    if($chk_page<$total_p-1){   
        echo "<a href='?id=".$gpage."&serh=".$gtxt."&s_page=$pNext&urlquery_str=".$urlquery_str."'  class='naviPN'>Next</a>";   
    }   
}      



///------- PAGE USER ------------
////////////////////////////////////»Ô´áºè§Ë¹éÒ
function cutstring($str, $len) {
  if (strlen($str)<=$len) return $str;
  else return sprintf("%.".$len."s..", $str);
}


      
////////////////////////////////// function string date
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์"," มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม"," กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	
	
	////////////////////////  function num to string
function bathformat($number) {
  $numberstr = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
  $digitstr = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');

  $number = str_replace(",","",$number); //ลบ comma
  $number = explode(".",$number); //แยกจุดทศนิยมออก

  //เลขจำนวนเต็ม
  $strlen = strlen($number[0]);
  $result = '';
  for($i=0;$i<$strlen;$i++) {
    $n = substr($number[0], $i,1);
    if($n!=0) {
      if($i==($strlen-1) AND $n==1){ $result .= 'เอ็ด'; }
      elseif($i==($strlen-2) AND $n==2){ $result .= 'ยี่'; }
      elseif($i==($strlen-2) AND $n==1){ $result .= ''; }
      else{ $result .= $numberstr[$n]; }
      $result .= $digitstr[$strlen-$i-1];
    }
  }
  
  //จุดทศนิยม
  $strlen = strlen($number[1]);
  if ($strlen>2) { //ทศนิยมมากกว่า 2 ตำแหน่ง คืนค่าเป็นตัวเลข
    $result .= 'จุด';
    for($i=0;$i<$strlen;$i++) {
      $result .= $numberstr[(int)$number[1][$i]];
    }
  } else { //คืนค่าเป็นจำนวนเงิน (บาท)
    $result .= 'บาท';
    if ($number[1]=='0' OR $number[1]=='00' OR $number[1]=='') {
      $result .= 'ถ้วน';
    } else {
      //จุดทศนิยม (สตางค์)
      for($i=0;$i<$strlen;$i++) {
        $n = substr($number[1], $i,1);
        if($n!=0){
          if($i==($strlen-1) AND $n==1){$result .= 'เอ็ด';}
          elseif($i==($strlen-2) AND $n==2){$result .= 'ยี่';}
          elseif($i==($strlen-2) AND $n==1){$result .= '';}
          else{ $result .= $numberstr[$n];}
          $result .= $digitstr[$strlen-$i-1];
        }
      }
      $result .= 'สตางค์';
    }
  }
  return $result;
}

//--------- str_replace

function nl2br2($string) {
$string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
return $string;
} 



	function ConfirmCancel(){
			if 	 (confirm ("Do you want to cancel data?")==true){ 
				return true;
			}
				return false;
		}
		
function convDate($dDate) {
$datecon = date_create_from_format('d-M-y', $dDate);
$daten=date_format($datecon, 'Y-m-d');
return $daten;

}
	
function convDate2($dDate) {
$datecon = date_create_from_format('Ymd', $dDate);
$daten=date_format($datecon, 'Y-m-d');
return $daten;

}


function convDate3($dDate) {
$datecon = date_create_from_format('d/m/Y', $dDate);
$daten=date_format($datecon, 'Y-m-d');
return $daten;

}

function convDate4($dDate) {
$datecon = date_create_from_format('d-m-Y', $dDate);
$daten=date_format($datecon, 'Y-m-d');
return $daten;

}

function convDate5($dDate) {
$datecon = date_create_from_format('d-m-y', $dDate);
$daten=date_format($datecon, 'Y-m-d');
return $daten;

}
?>
