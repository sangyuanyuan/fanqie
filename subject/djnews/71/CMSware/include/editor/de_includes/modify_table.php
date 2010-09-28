<script language=javascript>
var myTable = window.opener;
window.opener.doStyles()
window.onload = setValues;

var tableBgColor = myTable.selectedTable.bgColor;
var tableSpacing = myTable.selectedTable.cellSpacing;
var tablePadding = myTable.selectedTable.cellPadding;
var tableBorder = myTable.selectedTable.border;
var tableWidth = myTable.selectedTable.width;
var tableHeight = myTable.selectedTable.height;
var tableAlign = myTable.selectedTable.align;

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

	if (tableSpacing == "") tableSpacing = 2;
	if (tablePadding == "") tablePadding = 1;
	if (tableBorder == "") tableBorder = 0;

	tableForm.table_bgcolor.value = tableBgColor;
	tableForm.table_padding.value = tablePadding;
	tableForm.table_spacing.value = tableSpacing;
	tableForm.table_border.value = tableBorder;
	tableForm.table_width.value = tableWidth;
	tableForm.table_height.value = tableHeight;
	this.focus();
}

function doModify() {

	var error = 0;
	if (isNaN(tableForm.table_padding.value) || tableForm.table_padding.value < 0 || tableForm.table_padding.value == "") {
		alert("[sTxtTablePaddingErr]")
		error = 1
		tableForm.table_padding.select()
		tableForm.table_padding.focus()
	} else if (isNaN(tableForm.table_spacing.value) || tableForm.table_spacing.value < 0 || tableForm.table_spacing.value == "") {
		alert("[sTxtTableSpacingErr]")
		error = 1
		tableForm.table_spacing.select()
		tableForm.table_spacing.focus()
	} else if (isNaN(tableForm.table_border.value) || tableForm.table_border.value < 0 || tableForm.table_border.value == "") {
		alert("[sTxtTableBorderErr]")
		error = 1
		tableForm.table_border.select()
		tableForm.table_border.focus()
	}

	if (error != 1) {
        	myTable.selectedTable.cellPadding = tableForm.table_padding.value
        	myTable.selectedTable.cellSpacing = tableForm.table_spacing.value
        	myTable.selectedTable.border = tableForm.table_border.value
			myTable.selectedTable.width = tableForm.table_width.value
			myTable.selectedTable.height = tableForm.table_height.value

        	if (tableForm.table_bgcolor.value != "") {
        		myTable.selectedTable.bgColor = tableForm.table_bgcolor.value
        	} else {
        		myTable.selectedTable.removeAttribute('bgColor',0)
        	}

			styles = document.tableForm.sStyles[tableForm.sStyles.selectedIndex].text

			if (styles != "") {
				myTable.selectedTable.className = styles
			} else {
				myTable.selectedTable.removeAttribute('className',0)
			}
        
			if (tableForm.table_align[tableForm.table_align.selectedIndex].text != "None") {
       			myTable.selectedTable.align = tableForm.table_align[tableForm.table_align.selectedIndex].text
			} else {
       			myTable.selectedTable.removeAttribute('align',0)
			}

        	window.close()
	}
}

function printAlign() {
	if ((tableAlign != undefined) && (tableAlign != "")) {
		document.write('<option selected>' + tableAlign)
		document.write('<option>')
	} else {
		document.write('<option selected>')
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
<title>[sTxtModifyTable]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=tableForm>
<div class="appOutside">

<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtModifyTableInst]</span>
</div>
<br>
	 	  
	<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
	  <tr>
		<td class="body" width="90">[sTxtBgColor]:</td>
		<td class="body">
		  <input type="text" name="table_bgcolor" size="2" class="text70" maxlength="7" value=""><img onClick="showColorMenu('colorMenu',157,158)" src="de_images/popups/colors.gif" width=21 height=20 hspace=5 style="position: relative; top:5px" onmouseover="window.opener.button_over(this);" onmouseout="window.opener.button_out(this);" onmousedown="window.opener.button_down(this);" class=toolbutton>
		  </td>
		<td class="body" width="80">[sTxtPadding]:</td>
		<td class="body">
		  <input type="text" name="table_padding" size="2" class="text70" maxlength="2">
	  </td>
	  </tr>
	  <tr>
		<td class="body" width="80">[sTxtBorder]:</td>
		<td class="body">
		  <input type="text" name="table_border" size="2" class="text70" value="1" maxlength="2">
	  </td>
		<td class="body" width="80">[sTxtSpacing]:</td>
		<td class="body">
		  <input type="text" name="table_spacing" size="2" class="text70" value="2" maxlength="2">
	  </td>
	  </tr>
	  <tr>
		<td class="body" width="80">[sTxtWidth]:</td>
		<td class="body">
		  <input type="text" name="table_width" size="3" class="text70" value="" maxlength="4">
		</td>
		<td class="body" width="80">[sTxtHeight]:</td>
		<td class="body">
		  <input type="text" name="table_height" size="3" class="text70" value="" maxlength="4">
		</td>
	  </tr>
	  <tr>
		  <td class="body">[sTxtAlignment]:</td>
		  <td class="body">
			<select name="table_align" class="text70">
				<script>printAlign()</script>
				<option value="Left">Left</option>
				<option value="Center">Center</option>
				<option value="Right">Right</option>
			</select>
		  </td>
		  <td class="body">[sTxtStyle]:</td>
		  <td class="body">
				<script>printStyleList()</script>
		  </td>
		</tr>
	</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="modifyTable" value="[sTxtOK]" class="Text75" onClick="javascript:doModify();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>
</form>