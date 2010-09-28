<script language=JavaScript>
var myPage = window.opener;
window.opener.doStyles()
window.onload = setValues;

var textName = myPage.selectedTextArea.name;
var textWidth = myPage.selectedTextArea.cols;
var textLines = myPage.selectedTextArea.rows;
var textValue = myPage.selectedTextArea.value;
var textClass = myPage.selectedTextArea.className;

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

	if (textClass != "") {
		textClass = " class=" + textClass
	}

	textForm.text_lines.value = textLines;
	textForm.text_value.value = textValue;
	textForm.text_name.value = textName;
	textForm.text_width.value = textWidth;
	this.focus();
}

function doModify() {
	var sel = window.opener.document.selection;
		if (sel!=null) {
			var rng = sel.createRange();
		}

		name = document.textForm.text_name.value
		width = document.textForm.text_width.value
		rows = document.textForm.text_lines.value
		value = document.textForm.text_value.value
		styles = document.textForm.sStyles[textForm.sStyles.selectedIndex].text

		error = 0
		if (isNaN(width) || width < 0) {
				alert("[sTxtCharWidthErr]")
				error = 1
				textForm.text_width.select()
				textForm.text_width.focus()
		} else if (isNaN(rows) || rows < 0) {
				alert("[sTxtLinesErr]")
				error = 1
				textForm.text_lines.select()
				textForm.text_lines.focus()
		}

		if (error != 1) {
				if (value != "") {
					value =  value
				} else {
					value = ""
				}

				if (name != "") {
					name = ' name="' + name + '"'
				} else {
					name = ""
				}

				if (width != "") {
					width = ' cols="' + width + '"'
				} else {
					width = ""
				}

				if (rows != "") {
					rows = ' rows="' + rows + '"'
				} else {
					rows = ""
				}

				if (styles != "") {
					styles = " class=" + styles
				} else {
					styles = ""
				}

        		HTMLTextField = '<textarea' + name + width + rows + styles + '>' + value + '</textarea>'
         		myPage.selectedTextArea.outerHTML = HTMLTextField
		}
    
    window.close()
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
<title>[sTxtModifyTextArea]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=textForm>
<div class="appOutside">

<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtModifyTextAreaInst]</span>
</div>
<br>
<table border="0" cellspacing="0" cellpadding="5" style="width:92%">		
  <tr>
	<td class="body" width="80">[sTxtName]:</td>
	<td class="body" width="200">
	  <input type="text" name="text_name" size="10" class="Text70" maxlength="50">
  </td>
	<td class="body" width="80">[sTxtInitialValue]:</td>
	<td class="body">
	  <input type="text" name="text_value" size="10" class="Text70">
	</td>
  </tr>
  <tr>
	<td class="body" width="80">[sTxtCharWidth]:</td>
	<td class="body">
	  <input type="text" name="text_width" size="3" class="Text70" maxlength="3">
	</td>
	<td class="body" width="80">[sTxtLines]:</td>
	<td class="body">
	  <input type="text" name="text_lines" size="3" class="Text70" maxlength="3">
	</td>
  </tr>
  <tr>
	<td class="body">[sTxtStyle]:</td>
	<td class="body">
	<script>printStyleList()</script>
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertTextField" value="[sTxtOK]" class="Text75" onClick="javascript:doModify();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>