// JavaScript Document

/*--------------------- START ADD ROWS------------------------------------*/

// mredkj.com
// 2006-07-21
// Last updated 2006-02-21

function addRowToTable()
{
	 var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1
  var iteration = lastRow;
  var row = tbl.insertRow(lastRow);
  
  
  
  // left cell
  var cellLeft = row.insertCell(0);
  var textNode = document.createTextNode(iteration);
  cellLeft.appendChild(textNode);
  
  
  
  
  // right cell Date
  var cellRight = row.insertCell(1);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.size = 30;
  //el.value=	el.name;
  
  el.onkeypress = keyPressTest;
  cellRight.appendChild(el);
  
   // right cell/Description
  var cellRight2 = row.insertCell(2);
  var el2 = document.createElement('input');
  el2.type = 'text';
  el2.name = 'txtRow2' + iteration;
  el2.id = 'txtRow2' + iteration;
  el2.size = 15;

  el2.onkeyup = function (event){
				var pattern=new String("__-__-____"); // กำหนดรูปแบบในนี้ dd-mm-yy
				var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
				var returnText=new String("");
				var obj_l=this.value.length;
				var obj_l2=obj_l-1;
				for(i=0;i<pattern.length;i++){
				if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
				returnText+=this.value+pattern_ex;
				this.value=returnText;
				}
				}
				if(obj_l>=pattern.length){
				this.value=this.value.substr(0,pattern.length);
				}
			} ;
 // el2.value=el2.name;
  
  el2.onkeypress = keyPressTest;
  cellRight2.appendChild(el2);
  
     // right cell/Start time
  var cellRight3 = row.insertCell(3);
  var el3 = document.createElement('input');
  el3.type = 'text';
  el3.name = 'txtRow3' + iteration;
  el3.id = 'txtRow3' + iteration;
  el3.size = 15;
  //el3.value=el3.name;
  el3.onkeyup = function (event){
				var pattern=new String("__-__-____"); // กำหนดรูปแบบในนี้ yyyy-mm-dd
				var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
				var returnText=new String("");
				var obj_l=this.value.length;
				var obj_l2=obj_l-1;
				for(i=0;i<pattern.length;i++){
				if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
				returnText+=this.value+pattern_ex;
				this.value=returnText;
				}
				}
				if(obj_l>=pattern.length){
				this.value=this.value.substr(0,pattern.length);
				}
			} ;
  
  el3.onkeypress = keyPressTest;
  cellRight3.appendChild(el3);
  

// right cell/44
  var cellRight4 = row.insertCell(4);
  var el4 = document.createElement('input');
  el4.type = 'text';
  el4.name = 'txtRow4' + iteration;
  el4.id = 'txtRow4' + iteration;
  el4.size = 15;
 
  
  el4.onkeypress = keyPressTest;
  cellRight4.appendChild(el4);
  
  
  // right cell/55
  var cellRight5 = row.insertCell(5);
  var el5 = document.createElement('input');
  el5.type = 'text';
  el5.name = 'txtRow5' + iteration;
  el5.id = 'txtRow5' + iteration;
  el5.size = 40;
 // el5.value=el5.name;
  
  el5.onkeypress = keyPressTest;
  cellRight5.appendChild(el5);
  
  // right cell/55
  var cellRight6 = row.insertCell(6);
  var el6 = document.createElement('select');
 // el6.type = 'text';
  el6.name = 'txtRow6' + iteration;
  el6.id = 'txtRow6' + iteration;
  fncCreateSelectOption(el6)
//alert(fncCreateSelectOption())
//alert("el6.options.add( new Option(1,1));	el6.options.add( new Option(2,2) ); el6.options.add( new Option(3,3) );")
//el6.options.add( new Option("Method2","FI") );
//el6.size = 40;
//el5.value=el5.name;
//el6.onkeypress = keyPressTest;
  cellRight6.appendChild(el6);


}

function keyPressTest(e, obj)
{
  var validateChkb = document.getElementById('chkValidateOnKeyPress');
  if (validateChkb.checked) {
    var displayObj = document.getElementById('spanOutput');
    var key;
    if(window.event) {
      key = window.event.keyCode; 
    }
    else if(e.which) {
      key = e.which;
    }
    var objId;
    if (obj != null) {
      objId = obj.id;
    } else {
      objId = this.id;
    }
    displayObj.innerHTML = objId + ' : ' + String.fromCharCode(key);
  }
  alert(e + obj);
}

function removeRowFromTable()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  if (lastRow > 2)  tbl.deleteRow(lastRow - 1);

}
/*function openInNewWindow(frm)
{
  // open a blank window
  var aWindow = window.open('', 'TableAddRowNewWindow',
   'scrollbars=yes,menubar=yes,resizable=yes,toolbar=no,width=400,height=400');
   
  // set the target to the blank window
  frm.target = 'TableAddRowNewWindow';
  
  // submit
  frm.submit();
}*/
function validateRow()
{
	//alert("ok");
 // var chkb = document.getElementById('chkValidate');
 // if (chkb.checked) {

    var tbl = document.getElementById('tblSample');
    var lastRow = tbl.rows.length - 1;
	
    var i;
    for (i=lastRow; i<=lastRow; i++) {
     
	  var aRow = document.getElementById('txtRow' + i);
      if (aRow.value.length <= 0) {
          alert('Please input data ');
        return false;
      }else{
		  //	alert (lastRow);
			document.getElementById('form1').lastid.value = lastRow;
		  }
    }
 // }

 // openInNewWindow(frm);
}

function autoTab2(obj){
/* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น รูปแบบเลขที่บัตรประชาชน
4-2215-54125-6-12 ก็สามารถกำหนดเป็น _-____-_____-_-__
รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบรหัสสินค้า
รหัสสินค้า 11-BRID-Y1207
*/
var pattern=new String("____-__-__"); // กำหนดรูปแบบในนี้ yyyy-mm-dd
var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
var returnText=new String("");
var obj_l=obj.value.length;
var obj_l2=obj_l-1;
for(i=0;i<pattern.length;i++){
if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
returnText+=obj.value+pattern_ex;
obj.value=returnText;
}
}
if(obj_l>=pattern.length){
obj.value=obj.value.substr(0,pattern.length);
}
} 

/*--------------------- END ADD ROWS------------------------------------*/
function autoTab(obj){
var pattern=new String("__-__-____"); // กำหนดรูปแบบในนี้ yyyy-mm-dd
var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
var returnText=new String("");
var obj_l=obj.value.length;
var obj_l2=obj_l-1;
for(i=0;i<pattern.length;i++){
if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
returnText+=obj.value+pattern_ex;
obj.value=returnText;
}
}
if(obj_l>=pattern.length){
obj.value=obj.value.substr(0,pattern.length);
}
} 

/*--------------------- END ADD ROWS TIME------------------------------------*/
function autoTabTime(obj){
/* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น รูปแบบเลขที่บัตรประชาชน
4-2215-54125-6-12 ก็สามารถกำหนดเป็น _-____-_____-_-__
รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบรหัสสินค้า
รหัสสินค้า 11-BRID-Y1207
*/
var pattern=new String("__-__"); // กำหนดรูปแบบในนี้ yyyy-mm-dd
var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
var returnText=new String("");
var obj_l=obj.value.length;
var obj_l2=obj_l-1;
for(i=0;i<pattern.length;i++){
if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
returnText+=obj.value+pattern_ex;
obj.value=returnText;
}
}
if(obj_l>=pattern.length){
obj.value=obj.value.substr(0,pattern.length);
}
} 

