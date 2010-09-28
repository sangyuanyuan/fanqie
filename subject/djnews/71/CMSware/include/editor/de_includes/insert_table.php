<script language=JavaScript>
window.onload = this.focus
window.opener.doStyles()

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

function setValues() {
	imageForm.image_width.value = imageWidth;
	imageForm.image_height.value = imageHeight;

	if (imageBorder == "") {
		imageBorder = "0"
	}

	imageForm.border.value = imageBorder;
	imageForm.alt_tag.value = imageAltTag;
	imageForm.hspace.value = imageHspace;
	imageForm.vspace.value = imageVspace;
	// tableForm.cell_width.value = cellWidth;
	this.focus();
}

function button_over(td) {
	window.opener.button_over(td)
}

function button_out(td) {
	window.opener.button_out(td)
}

function doColor(td) {
	if (td)
		document.tableForm.bgcolor.value = td.childNodes(0).style.backgroundColor.toUpperCase()
	else 
		document.tableForm.bgcolor.value = ''

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
		document.getElementById("sStyles").options[0] = null;
		document.getElementById("sStyles").options[0].text = "";
		document.getElementById("sStyles").onchange = null;  
		document.getElementById("sStyles").onmouseenter = null; 
	} else {
		document.write("<select id=sStyles class=text70><option selected></option></select>")
	}
}


function InsertTable() {
	error = 0
	var sel = window.opener.foo.document.selection;
	if (sel!=null) {
		var rng = sel.createRange();
	   	if (rng!=null) {
			border = document.tableForm.border.value
			columns = document.tableForm.columns.value
			padding = document.tableForm.padding.value
			rows = document.tableForm.rows.value
			spacing = document.tableForm.spacing.value
			width = document.tableForm.width.value
			height = document.tableForm.height.value
			bgcolor = document.tableForm.bgcolor.value
			align = document.tableForm.align[tableForm.align.selectedIndex].text
			styles = document.tableForm.sStyles[tableForm.sStyles.selectedIndex].text

			if (isNaN(rows) || rows < 0 || rows == "") {
			 	alert("[sTxtTableRowErr]")
				document.tableForm.rows.select()
				document.tableForm.rows.focus()
				error = 1
			} else if (isNaN(columns) || columns < 0 || columns == "") {
			 	alert("[sTxtTableColErr]")
				document.tableForm.columns.select()
				document.tableForm.columns.focus()
				error = 1
			} else if (width < 0 || width == "") {
			 	alert("[sTxtTableWidthErr]")
				document.tableForm.width.select()
				document.tableForm.width.focus()
				error = 1
			} else if (isNaN(padding) || padding < 0 || padding == "") {
			 	alert("[sTxtTablePaddingErr]")
				document.tableForm.padding.select()
				document.tableForm.padding.focus()
				error = 1
			} else if (isNaN(spacing) || spacing < 0 || spacing == "") {
			 	alert("[sTxtTableSpacingErr]")
				document.tableForm.spacing.select()
				document.tableForm.spacing.focus()
				error = 1
			} else if (isNaN(border) || border < 0 || border == "") {
			 	alert("[sTxtTableBorderErr]")
				document.tableForm.border.select()
				document.tableForm.border.focus()
				error = 1
			}
			

        		if (error != 1) {
				if (bgcolor != "None") {
					bgcolor = " bgcolor =" + bgcolor
				} else {
					bgcolor = ""
				}
				
					if (height != "") {
						height = " height=" + height
					} else {
						height = ""
					}

					if (align != "") {
						align = " align=" + align
					} else {
						align = ""
					}

					if (styles != "") {
						styles = " class=" + styles
					} else {
						styles = ""
					}

        			HTMLTable = "<Table id=ewp_element_to_style width=" + width + height + align + styles + " border=" + border + " cellpadding=" + padding + " cellspacing=" + spacing + bgcolor + ">"
        
        			for (i=0; i<rows; i++) {
        				HTMLTable = HTMLTable + "<tr>"
        				for (j=0; j<columns; j++) {
        					HTMLTable = HTMLTable + "<td>&nbsp</td>"
        				}
        			
        				HTMLTable = HTMLTable + "</tr>"
        			}
        			
        			HTMLTable = HTMLTable + "</table>"
        			rng.pasteHTML(HTMLTable)
					oTable = window.opener.foo.document.getElementById("ewp_element_to_style")
					
					if (window.opener.borderShown == "yes") {
						oTable.runtimeStyle.border = "1px dotted #BFBFBF"
	
						allRows = oTable.rows
						for (y=0; y < allRows.length; y++) {
						 	allCellsInRow = allRows[y].cells
							for (x=0; x < allCellsInRow.length; x++) {
								allCellsInRow[x].runtimeStyle.border = "1px dotted #BFBFBF"
							}
						}
					}
					oTable.removeAttribute("id")

					}
        		}
	}
	
	if (error != 1) {
		// window.opener.foo.focus();
		self.close();
	}
}

document.onkeydown = function () { 
	if (event.keyCode == 13) {	// ENTER
		InsertTable()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		InsertTable()
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
<title>[sTxtInsertTable]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=tableForm>
<div class="appOutside">
 
<!-- <span class="appInside1" style="width:100%">
	<div class="appInside2">
		<div class="appInside3" style="padding:11px"><span class="appTitle">Insert Table</span>
-->
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtInsertTableInst]</span>
</div>
<br>

<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
		<tr>
		  <td class="body">[sTxtRows]:</td>
		  <td class="body"><input type="text" name="rows" size="2" class="text70" value="1" maxlength="2">
		  </td>
		  <td class="body">[sTxtPadding]:</td>
		  <td class="body"><input type="text" name="padding" size="2" class="text70" value="2" maxlength="2">
		  </td>
		</tr>
		<tr>
		  <td class="body">[sTxtCols]:</td>
		  <td class="body">
			<input type="text" name="columns" size="2" class="text70" value="1" maxlength="2">
		  </td>
		  <td class="body">[sTxtSpacing]:</td>
		  <td class="body">
			<input type="text" name="spacing" size="2" class="text70" maxlength="2" value="2">
		  </td>
		</tr>
		<tr>
		  <td class="body">[sTxtWidth]:</td>
		  <td class="body">
			<input type="text" name="width" size="2" class="text70" maxlength="4" value="100%">
		  </td>
		  <td class="body">[sTxtHeight]:</td>
		  <td class="body">
			<input type="text" name="height" size="2" class="text70" maxlength="4" value="">
		  </td>
		</tr>
		<tr>
		  <td class="body">[sTxtBgColor]:</td>
		  <td class="body">
		  <input type="text" name="bgcolor" size="2" class="text70" maxlength="7" value=""><img onClick="showColorMenu('colorMenu',157,158)" src="de_images/popups/colors.gif" width=21 height=20 hspace=5 style="position: relative; top:5px" onmouseover="window.opener.button_over(this);" onmouseout="window.opener.button_out(this);" onmousedown="window.opener.button_down(this);" class=toolbutton>
		  </td>
		  <td class="body">[sTxtBorder]:</td>
		  <td class="body"><input type="text" name="border" size="2" class="text70" maxlength="2" value="1"></td>
		</tr>
		<tr>
		  <td class="body">[sTxtAlignment]:</td>
		  <td class="body">
			<select name="align" class="text70">
				<option value=""></option>
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

<!--	</div>
	</div>
</span>
-->

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertTable" value="[sTxtOK]" class="Text75" onClick="javascript:InsertTable();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>
</form>