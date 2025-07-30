

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">


function Checkdata1() {
type_file = document.getElementById('fileCSV').value;
length_file = document.getElementById('fileCSV').value.length;
file_name = type_file;

	 if (type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="txt"  &&  type_file.substring(type_file.lastIndexOf('.') + 1,length_file) !="htm")
	{
		alert( 'For .txt and .htm file Only' );
		/*document.getElementById('fileCSV').innerHTML ="";*/	
		return (false);
		}else{
		document.getElementById('fileCSV').innerHTML ="<img src='"+file_name+"'><br>";
		return (true) ;
	}

}
</script>
<div class="body_resize"  align="center"> 

    <br/> <br/>
    		Download Format to import  file ::  <?php echo "<a target='_blank' href=exp/htm.htm >Exp. htm File</a>";?> || 
             <?php echo "<a target='_blank' href=exp/txt.txt >Exp. text File</a>";?>
   <br/> 
     <br/>
    		<form id="form1"  name="form1"enctype="multipart/form-data" method="post" action=""  onSubmit="JavaScript:return Checkdata1();">        
                 <table width="540" border="1"  class="table01" >
                     <tr>
                       <th height="28" colspan="2">Import Customer Confirmation Data </th>
                     </tr>
                     <tr>
                       <td width="208" height="25"><div class="tmagin_left">File import ::</div></td>
                       <td width="316"><div class="tmagin_right"><input type="file" name="fileCSV" id="fileCSV"  /></div></td>
                     </tr>
                     <tr>
                       <td colspan="2" align="center">
                       <input type="submit" name="btnSubmit"  id="btnSubmit" value="Submit" /></td>
                     </tr>
                  </table>
    		</form>

</div>
