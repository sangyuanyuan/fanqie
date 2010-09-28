<script language=javascript>
var myTable = window.opener;
window.opener.doStyles()
window.onload = setValues;

var cellBgColor = myTable.selectedTD.bgColor;
var cellWidth = myTable.selectedTD.width;
var cellHeight = myTable.selectedTD.height;
var cellAlign = myTable.selectedTD.align;
var cellvAlign = myTable.selectedTD.vAlign;
var tablePadding = myTable.selectedTable.cellPadding;

// Functions for color popup
var oPopup = window.createPopup();
function showColorMenu(menu, width, height) {

	lefter = event.clientX;
	leftoff = event.offsetX;
	topper = event.clientY;
	topoff = event.offsetY;

	var oPopBody = oPopup.document.body;
	moveMe = 0

	var HTMLContent = window.opener.eval(menu).innerHTML
	oPopBody.innerHTML = HTMLContent
	oPopup.show(lefter - leftoff - 2 - moveMe, topper - topoff + 22, width, height, document.body);

	return false;
}

function button_over(td) {
	window.opener.button_over(td)
}

function button_out(td) {
	window.opener.button_out(td)
}

function doColor(td) {
	if (td)
		document.tableForm.table_bgcolor.value = td.childNodes(0).style.backgroundColor.toUpperCase()
	else 
		document.tableForm.table_bgcolor.value = ''

	oPopup.hide()
}

function doMoreColors() {
	colorWin = window.open(window.opener.popupColorWin,'','width=420,height=370,scrollbars=no,resizable=no,titlebar=0,top=' + (screen.availHeight-400) / 2 + ',left=' + (screen.availWidth-420) / 2)
}

// End functions

function printStyleList() {
	if (window.opener.document.getElementById("sStyles") != null) {
		document.write(window.opener.document.getElementById("sStyles").outerHTML);
		document.getElementById("sStyles").className = "text70";
			if (document.getElementById("sStyles").options[0].text == "Style") {
				document.getElementById("sStyles").options[0] = null;
				document.getElementById("sStyles").options[0].text = "";
			} else {
				document.getElementById("sStyles").options[1].text = "";
			}

		document.getElementById("sStyles").onchange = null;  
		document.getElementById("sStyles").onmouseenter = null; 
	} else {
		document.write("<select id=sStyles class=text70><option selected></option></select>")
	}
}

function setValues() {

	tableForm.table_bgcolor.value = cellBgColor;
	tableForm.cell_width.value = cellWidth;
	tableForm.cell_height.value = cellHeight;	
	this.focus();
}

function doModify() {

	var error = 0;
	if (tableForm.cell_width.value < 0) {
		alert("[sTxtCellWidthErr]")
		error = 1
		tableForm.cell_width.select()
		tableForm.cell_width.focus()
	}


	if (tableForm.cell_height.value < 0) {
		alert("[sTxtCellHeightErr]")
		error = 1
		tableForm.cell_height.select()
		tableForm.cell_height.focus()
	}

	if (error != 1) {
        	myTable.selectedTD.width = tableForm.cell_width.value
        	myTable.selectedTD.height = tableForm.cell_height.value

			if (tableForm.table_bgcolor.value != "") {
        		myTable.selectedTD.bgColor = tableForm.table_bgcolor.value
        	} else {
        		myTable.selectedTD.removeAttribute('bgColor',0)
        	}

			styles = document.tableForm.sStyles[tableForm.sStyles.selectedIndex].text

			if (styles != "") {
				myTable.selectedTD.className = styles
			} else {
				myTable.selectedTD.removeAttribute('className',0)
			}

			if (tableForm.align[tableForm.align.selectedIndex].text != "None") {
        		myTable.selectedTD.align = tableForm.align[tableForm.align.selectedIndex].text
        	} else {
        		myTable.selectedTD.removeAttribute('align',0)
        	}

			if (tableForm.valign[tableForm.valign.selectedIndex].text != "None") {
        		myTable.selectedTD.vAlign = tableForm.valign[tableForm.valign.selectedIndex].text
        	} else {
        		myTable.selectedTD.removeAttribute('vAlign',0)
        	}
			
			window.opener.doToolbar()
        	window.close()
	}
}

function printAlign() {
	if ((cellAlign != undefined) && (cellAlign != "")) {
		document.write('<option selected>' + cellAlign)
		document.write('<option>None')
	} else {
		document.write('<option selected>None')
	}
}

function printvAlign() {
	if ((cellvAlign != undefined) && (cellvAlign != "")) {
		document.write('<option selected>' + cellvAlign)
		document.write('<option>None')
	} else {
		document.write('<option selected>None')
	}
}

document.onkeydown = function () { 
	if (event.keyCode == 13) {	// ENTER
		doModify()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		doModify()
		}
	}
};

document.onkeypress = onkeyup = function () {
	if (event.keyCode == 13) {	// ENTER
	event.cancelBubble = true;
	event.returnValue = false;
	return false;			
	}
};

</script>
<title>[sTxtModifyCell]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=tableForm>
<div class="appOutside">

<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtModifyCellInst]</span>
</div>
<br>
	 	  
<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
  <tr> 
	<td class="body" width="90">[sTxtBgColor]:</td>
		<td class="body">
		  <input type="text" name="table_bgcolor" size="2" class="text70" maxlength="7" value=""><img onClick="showColorMenu('colorMenu',157,158)" src="de_images/popups/colors.gif" width=21 height=20 hspace=5 style="position: relative; top:5px" onmouseover="window.opener.button_over(this);" onmouseout="window.opener.button_out(this);" onmousedown="window.opener.button_down(this);" class=toolbutton>
		  </td>
	<td class="body" width="80">[sTxtCellWidth]:</td>
	<td class="body"> 
	  <input type="text" name="cell_width" size="3" class="Text70" maxlength="3">
	</td>
  </tr>
  <tr> 
	<td class="body" width="80">[sTxtHorizontalAlign]:</td>
	<td class="body"> 
	  <SELECT class=text70 name=align>
		<script>printAlign()</script>
		<option>Left 
		<option>Center 
		<option>Right</option>
	  </select>
	</td>
	<td class="body" width="80">[sTxtCellHeight]:</td>
	<td class="body"> 
	  <input type="text" name="cell_height" size="3" class="Text70" maxlength="3">
	</td>
  </tr>
  <tr> 
	<td class="body" width="80">[sTxtVerticalAlign]:</td>
	<td class="body"> 
	  <select class=text70 name=valign>
		<script>printvAlign()</script>
		<option>Top 
		<option>Middle 
		<option>Bottom</option>
	  </select>
	</td>
	<td class="body">[sTxtStyle]:</td>
	<td class="body"><script>printStyleList()</script>
	</td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="modifyCell" value="[sTxtOK]" class="Text75" onClick="javascript:doModify();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>