<?php   
if(!defined('IN_IWPC')) {
 	exit('Access Denied');
}
require_once LANG_PATH.$SYS_ENV['language'].'/lang_skin/admin/editor.php';

?>
<html>
<head>
<title><?php
if($IN['o'] == 'add') echo "(".$_LANG_SKIN['add'].")";
else echo "(".$_LANG_SKIN['edit'].")";

 $title = $CONTENT_MODEL_INFO[$pInfo['TableID']]['TitleField'];
  echo $pInfo[$title];
?></title>
<link type="text/css" rel="StyleSheet" href="../html/style.css" />
<link rel="stylesheet" href="../html/calendar.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style type=text/css>
<!--

 
.A	{HEIGHT:20px;BORDER:1px solid #000000;TEXT-DECORATION:none;}
.line_height {line-height: 25px;}

//-->
</style>

<script src="ui.php?sId=<?=$IN['sId']?>&o=functions.js" type="text/javascript" language="javascript"></script>
<SCRIPT language=JavaScript>
var NodeID = '<?=$IN[NodeID]?>';
var sId = '<?=$IN['sId']?>';
var IndexID = '<?=$IN[IndexID]?>';
var o = '<?=$IN[o]?>';
</script>
<script language=javascript>
	var oPopup = window.createPopup();


	function showMenu(menu, width, height)
	{
    
	var lefter = event.clientX;
	var leftoff = event.offsetX
	var topper = event.clientY;
	var topoff = event.offsetY;
	var oPopBody = oPopup.document.body;
	moveMe = 0
	elo=window.event.srcElement;

	if (menu == "tableMenu")
	{
		moveMe = 0


	}

	var HTMLContent = eval(menu).innerHTML
	oPopBody.innerHTML = HTMLContent
	oPopup.show(lefter - leftoff - 2 - moveMe, topper - topoff + 18, width, height, document.body);
	//oPopup.document.body.innerHTML =  '' ;

	return false;
	}

	function contextHilite(menu){
	    menu.runtimeStyle.backgroundColor = "Highlight";
	    if (menu.state){
	        menu.runtimeStyle.color = "GrayText";
	    } else {
	        menu.runtimeStyle.color = "HighlightText";
	    }
	}

	function contextDelite(menu){
	    menu.runtimeStyle.backgroundColor = "";
	    menu.runtimeStyle.color = "";
	}

 
function onlyNum()
{
  if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)|| event.keyCode==8 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46 || event.keyCode==190 || event.keyCode==189))
//考虑小键盘上的数字键
    event.returnValue=false;
}

function mysubmit(form)
{
with(form){
	selectValue.value=''
	var icon=head.value;
	var sep=seperator.value
	for(i=1;i<mdoc.length;i++) {
		var addtime=''
		stringToSplit=mdoc.options[i].value
		arrayOfStrings=stringToSplit.split('%@%')
		
		dateToSplit=arrayOfStrings[1]
		arrayOfDate=dateToSplit.split('-')
		if(year.options[year.selectedIndex].value=='1') {
			addtime=arrayOfDate[0]
		}

		if(month.options[month.selectedIndex].value=='1' && year.options[year.selectedIndex].value=='1') {
			addtime=addtime+sep+arrayOfDate[1]
		}else {
			addtime=arrayOfDate[1]
		
		}

		if(date.options[date.selectedIndex].value=='1' && month.options[month.selectedIndex].value=='1') {
			addtime=addtime+sep+arrayOfDate[2]
		}else {
			addtime=addtime+arrayOfDate[2]
		
		}

		if(time.options[time.selectedIndex].value=='1') {
			addtime=addtime+' '+arrayOfDate[3]+':'+arrayOfDate[4]
		}

		selectValue.value+=icon + ' <A href=\"'+arrayOfStrings[0]+'\" target=\"_blank\">'+mdoc.options[i].text+'</A>    <FONT id=\"ADDTIME\">'+addtime+'</FONT><BR>\n'
	}
		window.returnValue = selectValue.value;
		window.close();
	}

}
function moveUp(obj)
{
	with (obj){
		if(selectedIndex==0){
			options[length]=new Option(options[0].text,options[0].value)
			options[0]=null
			selectedIndex=length-1
			}
		else if(selectedIndex>0) moveG(obj,-1)
	}
}

function editContentLink(fieldName)
{

 		var leftPos = screen.availWidth / 2 
		var topPos = screen.availHeight / 2 
		var MyWIN = window.open("admin_publish.php?sId=" + sId + "&o=editContentLink&extra=ui_init&IndexID=" + IndexID + "&fieldName=" + fieldName + "&NodeID=" + NodeID,'','width=500,height=380,scrollbars=no,resizable=yes,titlebar=0,top=' + topPos + ',left=' + leftPos);
		//window.open("admin_publish.php?sId=" + sId + "&o=editContentLink&extra=ui_init&IndexID=" + IndexID + "&fieldName=" + fieldName + "&NodeID=" + NodeID);

 
}


function GoSelect(obj)
{
	with (obj){
		try {
			var IndexID = options[selectedIndex].value;
			window.open("admin_publish.php?sId=" + sId + "&o=viewpublish&IndexID=" + IndexID + "&NodeID=" + NodeID,'')
		
		} catch(e) {
		
		}
		
 	}

}

function moveDown(obj)
{
	with (obj){
		try {
			if(selectedIndex==length-1){
				var otext=options[selectedIndex].text
				var ovalue=options[selectedIndex].value
				for(i=selectedIndex; i>0; i--){
					options[i].text=options[i-1].text
					options[i].value=options[i-1].value
				}
				options[i].text=otext
				options[i].value=ovalue
				selectedIndex=0
				}
			else if(selectedIndex<length-1) moveG(obj,+1)
		
		} catch(e) {
		
		}
	}
}
function moveG(obj,offset)
{
	with (obj){
		try {
			desIndex=selectedIndex+offset
			var otext=options[desIndex].text
			var ovalue=options[desIndex].value
			options[desIndex].text=options[selectedIndex].text
			options[desIndex].value=options[selectedIndex].value
			options[selectedIndex].text=otext
			options[selectedIndex].value=ovalue
			selectedIndex=desIndex
		
		} catch(e) {
		
		}
	}
}

function setContentLinkValue(fieldName)
{
	eval("obj = document.FM.data_" + fieldName);
 	var returnValue = '';

	with(obj) {
 		for(i=0; i <  obj.length ; i++){
			if(i==0) {
				returnValue = options[i].value;
			} else {
				returnValue = returnValue + ',' + options[i].value;
			}
 		} 
 		
	}
	if(returnValue == 'undefined') {
		returnValue = '';
	}

	if(returnValue != '') {
		returnValue = ',' + returnValue + ',';
	}
 	return returnValue;

}
function add(fieldName, param_index_id,param_title) {
	eval("obj = document.FM.data_" + fieldName);
	with(obj) {
		length=obj.length
		/*if(data.length > 24) {
			var data1 = "..." + data.substr(data.length-24 ,24)
		} else {
			var data1 = data
		}*/
 
		options[length]=new Option(param_title,param_index_id)
		
	}
	
}

function del(obj1) {

	
	with(obj1) {
		try {
			options[selectedIndex]=null
			selectedIndex=length-1
		
		} catch(e) {
		
		}
	}

}

function InputPicker(action, form, element)
{
	
	switch(action) {
		case 'color':
			var arr = showMeDialog("ui.php?sId=<?=$IN['sId']?>&o=editor__color.htm","color","dialogWidth:200pt;dialogHeight:175pt;help:0;status:0");	break;
		case 'date':
			showCalendar(element, 'y-mm-dd');
			break;
		case 'upload':
			var arr = showMeDialog('upload.php?sId='+ sId +'&o=display&mode=one&type=img_picker&NodeID=' + NodeID,"color","dialogWidth:390px;dialogHeight:120px;help:0;status:0;scroll:no");
			break;
		case 'tpl':
			with(form){

				eval("var varlue1=" + element + ".value;")

			}

			var arr = showMeDialog("admin_select.php?sId=<?=$IN['sId']?>&o=tpl&tpl=" + varlue1,"color","dialogWidth:428px;dialogHeight:266px;help:0;status:0;scroll:no");
			break;	
		case 'psn':
			with(form){

				eval("var varlue1=" + element + ".value;")

			}
			
			var info = showMeDialog("admin_select.php?sId=<?=$IN['sId']?>&o=psn_picker&psn=" + varlue1 ,"color","dialogWidth:600px;dialogHeight:266px;help:0;status:0;scroll:no");
			if(info['filename'] != null) {
				var arr= '{PSN-URL:'+ info['PSNID'] + "}" +info['filename'];
			}
			break;
	}

	if(arr != null) {
		with(form){

			eval(element + ".value= '" +  arr + "'")

		}


	}

}
</script>
<STYLE type=text/css>
TD {
	FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: "MS Shell Dlg"
}
.tab {
	PADDING-RIGHT: 5px; PADDING-LEFT: 5px; FONT-SIZE: 12px; PADDING-BOTTOM: 1px; CURSOR: hand; PADDING-TOP: 5px; LETTER-SPACING: 1px
}
</STYLE>
<SCRIPT language=JavaScript>

function tabClick(idx) 
{

  
	for (i = 0; i < 3; i++) {
    

		if (i == idx) {

			var tabImgLeft = eval("document.all.tabImgLeft__" + idx);

			var tabImgRight = eval("document.all.tabImgRight__" + idx);
      
			var tabLabel = eval("document.all.tabLabel__" + idx);
      
			var tabContent = eval("document.all.tabContent__" + idx);

      
			tabImgLeft.src = "../html/images/mpc/tab_active_left.gif";
      
			tabImgRight.src = "../html/images/mpc/tab_active_right.gif";
      
			tabLabel.background = "../html/images/mpc/tab_active_bg.gif";
      
			tabContent.style.visibility = "visible";
      
			tabContent.style.display = "block";
     
		}
  else {
			var tabImgLeft = eval("document.all.tabImgLeft__" + i);
		
			var tabImgRight = eval("document.all.tabImgRight__" + i);
		
			var tabLabel = eval("document.all.tabLabel__" + i);
		
			var tabContent = eval("document.all.tabContent__" + i);

		
			tabImgLeft.src = "../html/images/mpc/tab_unactive_left.gif";
		
			tabImgRight.src = "../html/images/mpc/tab_unactive_right.gif";
		
			tabLabel.background = "../html/images/mpc/tab_unactive_bg.gif";
		
			tabContent.style.visibility = "hidden";
		
			tabContent.style.display = "none";
  
		
		}  

	}


}
function psnSelect(psn,form, psn_element,url_element) {
//showMeDialog
var arr = showMeDialog("admin_select.php?sId=<?=$IN['sId']?>&o=psn&psn=" + psn,"color","dialogWidth:428px;dialogHeight:266px;help:0;status:0;scroll:no");
if(arr != null) {
	var PSN = '{PSN:'+ arr;
	var URL = '{PSN-URL:'+ arr;
	with(form){

	eval(psn_element + ".value= '" + PSN + "'")
	eval(url_element + ".value= '" + URL + "'")

	}


}
 //window.open("admin_select.php?sId=884cef05376daade3fa77aa61d08a996&o=psn&psn=" + psn,"psnselect","toolbar=0,resizable=yes,width=415,height=235,scrollbars=no")
 // if (arr != null) format('forecolor',arr);
 // else idEdit.focus();
}


</SCRIPT>
<style type="text/css">
<!--
.bigborder {
	border-top: 0px #FFFFFF;
	border-right: 0px solid #999999;
	border-bottom: 0px solid #999999;
	border-left: 0px solid #FFFFFF;
}
-->
</style>
<script type="text/javascript" src="../html/calendar.js"></script>
<script type="text/javascript">
Calendar._DN = new Array
("<?echo $_LANG_SKIN['Sunday']; ?>",
 "<?echo $_LANG_SKIN['Monday']; ?>",
 "<?echo $_LANG_SKIN['Tuesday']; ?>",
 "<?echo $_LANG_SKIN['Wednesday']; ?>",
 "<?echo $_LANG_SKIN['Thursday']; ?>",
 "<?echo $_LANG_SKIN['Friday']; ?>",
 "<?echo $_LANG_SKIN['Saturday']; ?>",
 "<?echo $_LANG_SKIN['Sunday']; ?>");
Calendar._MN = new Array
("<?echo $_LANG_SKIN['January']; ?>",
 "<?echo $_LANG_SKIN['February']; ?>",
 "<?echo $_LANG_SKIN['March']; ?>",
 "<?echo $_LANG_SKIN['April']; ?>",
 "<?echo $_LANG_SKIN['May']; ?>",
 "<?echo $_LANG_SKIN['June']; ?>",
 "<?echo $_LANG_SKIN['July']; ?>",
 "<?echo $_LANG_SKIN['August']; ?>",
 "<?echo $_LANG_SKIN['September']; ?>",
 "<?echo $_LANG_SKIN['October']; ?>",
 "<?echo $_LANG_SKIN['November']; ?>",
 "<?echo $_LANG_SKIN['December']; ?>");

Calendar._TT = {};
Calendar._TT["TOGGLE"] = "Toggle first day of week";
Calendar._TT["PREV_YEAR"] = "<?echo $_LANG_SKIN['Last_year']; ?>  ";
Calendar._TT["PREV_MONTH"] = "<?echo $_LANG_SKIN['Last_month']; ?>  ";
Calendar._TT["GO_TODAY"] = "<?echo $_LANG_SKIN['Today']; ?>";
Calendar._TT["NEXT_MONTH"] = "<?echo $_LANG_SKIN['Next_month']; ?>  ";
Calendar._TT["NEXT_YEAR"] = "<?echo $_LANG_SKIN['Next_year']; ?>  ";
Calendar._TT["SEL_DATE"] = "<?echo $_LANG_SKIN['select_date']; ?>";
Calendar._TT["DRAG_TO_MOVE"] = "Drag to move";
Calendar._TT["PART_TODAY"] = " <?echo $_LANG_SKIN['Today1']; ?>";
Calendar._TT["MON_FIRST"] = "Display Monday first";
Calendar._TT["SUN_FIRST"] = "Display Sunday first";
Calendar._TT["CLOSE"] = "<?echo $_LANG_SKIN_GLOBAL['close']; ?>";
Calendar._TT["TODAY"] = "<?echo $_LANG_SKIN['Today']; ?>";
</script>
<script type="text/javascript">

var calendar = null; // remember the calendar object so that we reuse it and
                     // avoid creation other calendars.

// code from http://www.meyerweb.com -- change the active stylesheet.
function setActiveStyleSheet(title) {
  var i, a, main;
  for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
      a.disabled = true;
      if(a.getAttribute("title") == title) a.disabled = false;
    }
  }
  document.getElementById("style").innerHTML = title;
  return false;
}

// This function gets called when the end-user clicks on some date.
function selected(cal, date) {
  cal.sel.value = date; // just update the date in the input field.
  if (cal.sel.id == "sel1" || cal.sel.id == "sel3" || cal.sel.id == "sel5" || cal.sel.id == "sel7")
    // if we add this call we close the calendar on single-click.
    // just to exemplify both cases, we are using this only for the 1st
    // and the 3rd field, while 2nd and 4th will still require double-click.
    cal.callCloseHandler();
}

// And this gets called when the end-user clicks on the _selected_ date,
// or clicks on the "Close" button.  It just hides the calendar without
// destroying it.
function closeHandler(cal) {
  cal.hide();                        // hide the calendar

  // don't check mousedown on document anymore (used to be able to hide the
  // calendar when someone clicks outside it, see the showCalendar function).
  Calendar.removeEvent(document, "mousedown", checkCalendar);
}

// This gets called when the user presses a mouse button anywhere in the
// document, if the calendar is shown.  If the click was outside the open
// calendar this function closes it.
function checkCalendar(ev) {
  var el = Calendar.is_ie ? Calendar.getElement(ev) : Calendar.getTargetElement(ev);
  for (; el != null; el = el.parentNode)
    // FIXME: allow end-user to click some link without closing the
    // calendar.  Good to see real-time stylesheet change :)
    if (el == calendar.element || el.tagName == "A") break;
  if (el == null) {
    // calls closeHandler which should hide the calendar.
    calendar.callCloseHandler();
    Calendar.stopEvent(ev);
  }
}

// This function shows the calendar under the element having the given id.
// It takes care of catching "mousedown" signals on document and hiding the
// calendar if the click was outside.
function showCalendar(id, format) {
  var el = document.getElementById(id);
  if (calendar != null) {
    // we already have some calendar created
    calendar.hide();                 // so we hide it first.
  } else {
    // first-time call, create the calendar.
    var cal = new Calendar(true, null, selected, closeHandler);
    calendar = cal;                  // remember it in the global var
    cal.setRange(1900, 2070);        // min/max year allowed.
    cal.create();
  }
  calendar.setDateFormat(format);    // set the specified date format
  calendar.parseDate(el.value);      // try to parse the text in field
  calendar.sel = el;                 // inform it what input field we use
  calendar.showAtElement(el);        // show the calendar below it

  // catch "mousedown" on document
  Calendar.addEvent(document, "mousedown", checkCalendar);
  return false;
}

var MINUTE = 60 * 1000;
var HOUR = 60 * MINUTE;
var DAY = 24 * HOUR;
var WEEK = 7 * DAY;

// If this handler returns true then the "date" given as
// parameter will be disabled.  In this example we enable
// only days within a range of 10 days from the current
// date.
// You can use the functions date.getFullYear() -- returns the year
// as 4 digit number, date.getMonth() -- returns the month as 0..11,
// and date.getDate() -- returns the date of the month as 1..31, to
// make heavy calculations here.  However, beware that this function
// should be very fast, as it is called for each day in a month when
// the calendar is (re)constructed.
function isDisabled(date) {
  var today = new Date();
  return (Math.abs(date.getTime() - today.getTime()) / DAY) > 10;
}

function flatSelected(cal, date) {
  var el = document.getElementById("preview");
  el.innerHTML = date;
}

function showFlatCalendar() {
  var parent = document.getElementById("display");

  // construct a calendar giving only the "selected" handler.
  var cal = new Calendar(true, null, flatSelected);

  // We want some dates to be disabled; see function isDisabled above
  cal.setDisabledHandler(isDisabled);
  cal.setDateFormat("DD, M d");

  // this call must be the last as it might use data initialized above; if
  // we specify a parent, as opposite to the "showCalendar" function above,
  // then we create a flat calendar -- not popup.  Hidden, though, but...
  cal.create(parent);

  // ... we can show it here.
  cal.show();
}


function prepareSubmit()
{
	setMode(false);
	setMode(true);
	setMode(false);
	setMode(true);
	document.FM.data_Content_html.value=document.FM.SaveContent.value;
}
</script>
<script src="ui.php?sId=<?=$IN[sId]?>&o=editor__edit_source.js"></script>

<body bgcolor=threedface STYLE="margin:0pt;padding:0pt;border: 1px buttonhighlight;" onload="top.document.title=document.title">
<form action="admin_publish.php?sId=<?=$IN['sId']?>&type=main&o=<?=$IN['o']?>_submit&NodeID=<?=$IN['NodeID']?>&IndexID=<?=$pInfo['IndexID']?>" method="post" name="FM"  ><!--actionFrame-->
<!--------------------------------------------------------------------------------------------------------->
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>

<TBODY>
  <TR>
    <TD style="PADDING-LEFT: 2px; HEIGHT: 22px" 
    background="../html/images/mpc/tab_top_bg.gif">
      <TABLE cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE height=22 cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD width=3><IMG id=tabImgLeft__0 height=22 
                  src="../html/images/mpc/tab_active_left.gif" 
                  width=3></TD>
                <TD class=tab id=tabLabel__0 onclick=tabClick(0) 
                background="../html/images/mpc/tab_active_bg.gif" 
                UNSELECTABLE="on" title="内容"><label>内容</label></TD>
                <TD width=3><IMG id=tabImgRight__0 height=22 
                  src="../html/images/mpc/tab_active_right.gif" 
                  width=3></TD></TR></TBODY></TABLE></TD>
          <TD>
            <TABLE height=22 cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD width=3><IMG id=tabImgLeft__1 height=22 
                  src="../html/images/mpc/tab_unactive_left.gif" 
                  width=3></TD>
                <TD class=tab id=tabLabel__1 onclick=tabClick(1) 
                background="../html/images/mpc/tab_unactive_bg.gif" 
                UNSELECTABLE="on"><label>设置</label></TD>
                <TD width=3><IMG id=tabImgRight__1 height=22 
                  src="../html/images/mpc/tab_unactive_right.gif" 
                  width=3></TD></TR></TBODY></TABLE></TD>
           <td>
		    <TABLE height=22 cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD width=3><IMG id=tabImgLeft__2 height=22 
                  src="../html/images/mpc/tab_unactive_left.gif" 
                  width=3></TD>
                <TD class=tab id=tabLabel__2 onclick=tabClick(2) 
                background="../html/images/mpc/tab_unactive_bg.gif" 
                UNSELECTABLE="on"><label>附加资源</label></TD>
                <TD width=3><IMG id=tabImgRight__2 height=22 
                  src="../html/images/mpc/tab_unactive_right.gif" 
                  width=3></TD></TR></TBODY></TABLE></TD>
           
				  
				  </TR></TBODY></TABLE>
		   </td>
				  
				  </TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD bgcolor=menu>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD 
          style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; " 
          vAlign=top class="bigborder" >
		  
<!--1-->
<DIV id=tabContent__0 style="DISPLAY: block; VISIBILITY: visible">




<table   border=0 width=100%   cellPadding=3 cellSpacing=0 >
 
 <tr class='tablelist'> 
              <td align=right  width=60>标题:</td>
              <td valign='middle'>
					<table   border=0    cellPadding=0 cellSpacing=0 >
					<tr><td><input name='data_Title' type='text' value="<?=htmlspecialchars($pInfo[Title])?>" size=90%  > </td>
					<td >&nbsp;&nbsp;标题颜色:</td>
              <td  ><input name='data_TitleColor' size=8 type='text' value="<?=htmlspecialchars($pInfo[TitleColor])?>"   >&nbsp;<input name="button5" type='button' tabindex='13' value='...' onclick="InputPicker('color',this.form,'data_TitleColor')"> </td>
					</tr> 
					</table>
				</td>
				</tr>
<tr class='tablelist'> 
              <td align=right ><?echo $_LANG_SKIN['publish_date']; ?>:</td>
              <td >
<input name="year" type="text" class="button" id="dTime" onFocus="return showCalendar('dTime', 'y-mm-dd');"      value="<?=$output_year?>"> 
                <select name="hour">
                 <?=$output_hour?>
				  
                  
                </select>
                <?echo $_LANG_SKIN['hour']; ?>
                <select name="minute">
                 <?=$output_minute?>
                  
                </select>
                <?echo $_LANG_SKIN['minute']; ?> <select name="second">
                 <?=$output_second?>
                 
                </select>
                <?echo $_LANG_SKIN['second']; ?>			  
			  </td>
</tr>
			<tr class='tablelist'> 
              <td align=right  width=60>副标题:</td>
              <td valign='middle'><input name='data_SubTitle' type='text' value="<?=htmlspecialchars($pInfo[SubTitle])?>" size=90%> </td> </tr> 
			  <tr class='tablelist'> 
              <td align=right  width=60>新闻图片:</td>
              <td valign='middle'><input name='data_Photo' type='text' value="<?=htmlspecialchars($pInfo[Photo])?>" size=100%  >&nbsp;<!--<input name="button5" type='button'  value='...' onclick="InputPicker('upload',this.form,'data_Photo')" style="margin-right: 0px;padding-right: 0px;"> 
-->

 
 <img  style="position: relative;left:0px;top: 4px;" src="../html/images/menu_open.gif" class="Dtoolbutton" onmouseover="this.className='Dtoolbutton';" onmouseout="this.className='Dtoolbutton';" onclick="this.className='Ctoolbutton';commonInputPicker('img', 'document.FM', 'data_Photo')" title="" hspace="0" vspace="0">

</td> </tr> 
			  
			  <tr class='tablelist'> 
              <td align=right  width=60>作者:</td>
              <td valign='middle'>
			  <table   border=0    cellPadding=0 cellSpacing=0 >
					<tr><td><input name='data_Author' type='text' value="<?=htmlspecialchars($pInfo[Author])?>" size=20  > </td>
					<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;责任编辑:&nbsp;&nbsp;</td>
              <td  ><input name='data_Editor' type='text' value="<?=htmlspecialchars($pInfo[Editor])?>" size=20  > </td>
					</tr> 
					</table>

			   </td> </tr> 
			  
			   <tr class='tablelist'> 
              <td align=right  width=60>来源网站:</td>
              <td valign='middle'><input name='data_FromSite' type='text' value="<?=htmlspecialchars($pInfo[FromSite])?>" size=90%  > </td> </tr>
			  <tr class='tablelist'> 
              <td align=right  width=60>关键字:</td>
              <td valign='middle'><input name='data_Keywords' type='text' value="<?=htmlspecialchars($pInfo[Keywords])?>" size=90%  >&nbsp;多个关键字请使用逗号“,”分隔 </td> </tr>

			   <tr class='tablelist'> 
              <td align=right  width=60> </td>
              <td valign='middle'><script src="ui.php?sId=<?=$IN[sId]?>&o=editor__html.js"></script>
</script>	 </td> </tr>

			  <tr class='tablelist'> 
              <td align=right  width=60>内容:</td>
              <td valign='middle'>

 <Iframe name=EditContent      style="width:100%;height:380;border:5;" > 
                </Iframe> <textarea name="SaveContent" id="SaveContent"    style="height:350;display:none;" class='button' id='Content' style='height:300;width=100%;overflow:auto;background-color:#FFFFFF;'>
<?=htmlspecialchars($pInfo[Content])?>
			</textarea> 
 <INPUT TYPE="hidden" name="data_Content_html" id="data_Content_html">
 </td> </tr> 
 <tr class='tablelist'> 
              <td align=right  width=80>自定义相关文章:</td>
              <td valign='middle'>
			  
		<table   border=0  cellPadding=2 cellSpacing=0 ><tr><td > <select name='data_CustomLinks' name='select' size='10'>
		<?php
		
		$Links = explode(',', $pInfo['CustomLinks']);
  		if(!empty($Links)) {
			foreach($Links as $keyIn=>$varIn) {
				if(empty($varIn)) continue;
				$info = $publish->editor_getContentInfo($varIn);
				 
				$info_key = $CONTENT_MODEL_INFO[$info['TableID']]['TitleField'];
 				echo "<option  value='{$info['IndexID']}' >{$info[$info_key]}</option>";
			}
		}
		?>
		
 
		</select><INPUT TYPE='hidden' name='data_CustomLinks_value'></td> 
		<td class='line_height'>&nbsp;<input name='button5' type='button' tabindex='13' value='×' onclick="del(this.form.data_CustomLinks)" style="font:9pt;font-family: Verdana, Arial, Helvetica, sans-serif;"><br><br>&nbsp;<input name='button5' type='button' tabindex='13' value='∧' onclick=moveUp(this.form.data_CustomLinks)><br>&nbsp;<input name='button5' type='button' tabindex='13' value='∨' onclick=moveDown(this.form.data_CustomLinks)><br><br>&nbsp;<input name="button5" type='button' tabindex='13' value='...' onclick=editContentLink('CustomLinks')> 
		</td><td>&nbsp;<input name='button5' type='button' tabindex='13' value='&nbsp;Go&nbsp;' onclick=GoSelect(this.form.data_CustomLinks)></td></tr></table>			  
			  
			  
			  </td> </tr> 




			  <tr class='tablelist'> 
              <td align=right  width=60>简介:</td>
              <td valign='middle'><textarea name='data_Intro' class='button' id='Intro' style='height:100;width=100%;background-color:#FFFFFF;' ><?=htmlspecialchars($pInfo[Intro])?></textarea> </td> </tr> 
</table>
</DIV>


<!--2-->
<DIV id=tabContent__1 style="DISPLAY: none; VISIBILITY: hidden">

 <table  border=0   cellPadding=0 cellSpacing=5 >
 <?php if($IN[o] == 'add'):?>
<tr class='tablelist'> 
              <td align=right ><?echo $_LANG_SKIN['create_link']; ?></td>
              <td valign=top>
			<table>
			<tr>
			<td><?echo $_LANG_SKIN['create_solid_link']; ?></td>
			<td><?echo $_LANG_SKIN['create_index_link']; ?></td>
			</tr>
			<tr>
			<td>
<select  name="SubTargetNodeID[]" id = "SubTargetNodeID"  size="10" multiple>
<option value='' ><?echo $_LANG_SKIN['null']; ?></option>
<?php
foreach($NODE_LIST as $key=>$var) {
	if($var[TableID]!=$NodeInfo[TableID]) continue;

		echo "<option value='{$var[NodeID]}'>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";	
}

 ?>
 </select>	

</td>
			<td> 
<select  name="IndexTargetNodeID[]" id = "IndexTargetNodeID"  size="10" multiple>
<option value='' ><?echo $_LANG_SKIN['null']; ?></option>
<?php
foreach($NODE_LIST as $key=>$var) {
	if($var[TableID]!=$NodeInfo[TableID]) continue;

		echo "<option value='{$var[NodeID]}'>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";	
}

 ?>
 </select>	
</td>
			</tr>
</table>
</td>
</tr>
<?php endif;?>
 <tr class='tablelist'> 
              <td align=right ><?echo $_LANG_SKIN['top_height']; ?>:</td>
              <td >
<input name="Top" type="text" class="button" id="Top"      value="<?=$pInfo['Top']?>"> 
                
			  </td>
</tr>				
<tr class='tablelist'> 
              <td align=right ><?echo $_LANG_SKIN['pink_height']; ?>:</td>
              <td >
<input name="Pink" type="text" class="button" id="Pink"       value="<?=$pInfo['Pink']?>"> 
                
			  </td>
</tr>	

<tr>
<td align=right  ><?echo $_LANG_SKIN['self_template']; ?>:</td>
              <td ><input name='SelfTemplate' id="SelfTemplate" type='text' value='<?=$pInfo['SelfTemplate']?>' size=80%  >&nbsp;<input name="button5" type='button' tabindex='13' value='...' onclick="InputPicker('tpl',this.form,'SelfTemplate')"> </td></tr>

<tr>
<td align=right  ><?echo $_LANG_SKIN['self_publish_name']; ?>:</td>
              <td ><input name='SelfPublishFileName' id="SelfPublishFileName" type='text' value='<?=$pInfo['SelfPublishFileName']?>' size=80%  >  </td></tr>
			  
<tr>
<td align=right  ><?echo $_LANG_SKIN['self_psn']; ?>:</td>
              <td ><input name='SelfPSN' id="SelfPSN" type='text' value='<?=$pInfo['SelfPSN']?>' size=80%  >&nbsp; <input name="button6" type='button' tabindex='13' value='...' onclick="psnSelect('<?=$pInfo['SelfPSN']?>',this.form,'SelfPSN','SelfPSNURL')"> </td></tr>
<tr><td align=right  ><?echo $_LANG_SKIN['self_psn_url']; ?> :</td>
              <td ><input name='SelfPSNURL' id="SelfPSNURL" type='text' value='<?=$pInfo['SelfPSNURL']?>' size=80%  >&nbsp; </td></tr>
			  
<tr><td align=right  > </td>
              <td > &nbsp; </td></tr>

<tr><td align=right  ><?echo $_LANG_SKIN['self_url']; ?> :</td>
              <td ><input name='SelfURL' id="SelfURL" type='text' value='<?=$pInfo['SelfURL']?>' size=80%  >&nbsp; </td></tr>
			  </table>
 
 
<!--------------------------------------------------------------------------------------------------------->

</form>
</DIV>

<!--3-->
<DIV id=tabContent__2 style="DISPLAY: none; VISIBILITY: hidden">

<table border="0" cellpadding="10" cellspacing="0" align="center"  >
<tr><td>

<?php if(!empty($imgResourceInfo)) :?>

<fieldset class="search">
 	<legend><b>图片</b></legend>
<table border="0" cellpadding="0" cellspacing="0"   >
<tr><td>
<?php $i = 0;?>
<?php foreach($imgResourceInfo as $key=>$var): ?>
<?php $i++;?>
<div class="imagespacer" >
			<div class="imageholder" >
			<A HREF="<?=$SYS_ENV['ResourcePath']?>/<?=$var['Path']?>" target="_blank"><img src="automini.php?sId=<?=$IN['sId']?>&src=<?php echo  urlencode($SYS_ENV['ResourcePath'] ."/". $var['Path']);?>&pixel=160*120&cache=1&cacheTime=1000" width="160" height="120" border="0" /></A> 
			</div>

			 
</div>

<?php if($i %4 == 0): ?>
</td></tr>
<tr><td>
<?php endif;?>
<?php endforeach; ?>
</td></tr>
</table>
</fieldset>
<BR>
<?php endif;?>

<?php if(!empty($attachResourceInfo)) :?>
<fieldset class="search">
 	<legend><b>附件</b></legend>
<table border="0" cellpadding="3" cellspacing="0"   >
 <?php  foreach($attachResourceInfo as $key=>$var): ?>
<tr><td>
<?php preg_match("/\.([a-zA-Z0-9]+)$/isU" ,$var['Path'], $match); ?>
 <IMG src="<?php echo $PUBLISH_URL;?>/images/icon/<?=$match[1]?>.gif" border=0></td><td>
<A href="<?=$SYS_ENV['ResourcePath']?>/<?=$var['Path']?>" target=_blank>
<?php 
if(empty($var['Title']))  echo $var['Name'];
else echo $var['Title'];


?>

</A> 
</td><td>
 


 </td></tr>
  <?php endforeach; ?>
 </table>
</fieldset>
<?php endif;?>

<!--{{{ flash start-->
<?php if(!empty($flashResourceInfo)) :?>
<fieldset class="search">
 	<legend><b>Flash</b></legend>
<table border="0" cellpadding="3" cellspacing="0"   >
 <?php  foreach($flashResourceInfo as $key=>$var): ?>
<tr><td>
<?php preg_match("/\.([a-zA-Z0-9]+)$/isU" ,$var['Path'], $match); ?>
 <IMG src="<?php echo $PUBLISH_URL;?>/images/icon/<?=$match[1]?>.gif" border=0></td><td>
<A href="<?=$SYS_ENV['ResourcePath']?>/<?=$var['Path']?>" target=_blank>
<?php 
if(empty($var['Title']))  echo $var['Name'];
else echo $var['Title'];


?>

</A> 
</td><td>
 


 </td></tr>
  <?php endforeach; ?>
 </table>
</fieldset>
<?php endif;?>
<!--flash end }}}-->
</td></tr>
</table>

	 
</DIV>

 </TD>
       </TR></TBODY></TABLE></TD></TR>
 </TBODY></TABLE>
<script>
EditContent.document.designMode="On";
  idEdit = EditContent
   var sContents=document.all.SaveContent.value
    // var sHeader='<link href="include/editor.css" rel="stylesheet" type="text/css">'+
	 //  '<body topmargin="0" leftmargin="0">';
      idEdit.document.open()
      idEdit.document.write(sHeader+sContents)
      idEdit.document.close()
      idEdit.focus();
	  idEdit.document.body.onpaste = onPaste ;

	
	function msover(){
		event.srcElement.style.backgroundColor="#FFF6DC";
		event.srcElement.style.cursor = "hand";
	}

	function msout(){
		event.srcElement.style.backgroundColor="#FFFFFF";
		event.srcElement.style.cursor = "auto";
	}
</script>
</body>
</html>