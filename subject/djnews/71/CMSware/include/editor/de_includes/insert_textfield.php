<script language=JavaScript>
window.onload = this.focus
window.opener.doStyles()

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

var error
function InsertTextField() {
	var sel = window.opener.document.selection;
	if (sel!=null) {
		var rng = sel.createRange();
	   	if (rng!=null) {
			name = document.textForm.text_name.value
			width = document.textForm.text_width.value
			max = document.textForm.text_max.value
			value = document.textForm.text_value.value
			type = document.textForm.text_type[textForm.text_type.selectedIndex].text
			styles = document.textForm.sStyles[textForm.sStyles.selectedIndex].text

		error = 0
		if (isNaN(width) || width < 0) {
				alert("[sTxtCharWidthErr]")
				error = 1
				textForm.text_width.select()
				textForm.text_width.focus()
		} else if (isNaN(max) || max < 0) {
				alert("[sTxtMaxCharsErr]")
				error = 1
				textForm.text_max.select()
				textForm.text_max.focus()
		}

		if (error != 1) {
				if (value != "") {
					value = ' value="' + value + '"'
				} else {
					value = ""
				}

				if (name != "") {
					name = ' name="' + name + '"'
				} else {
					name = ""
				}

				if (width != "") {
					width = ' size="' + width + '"'
				} else {
					width = ""
				}

				if (max != "") {
					max = ' maxlength="' + max + '"'
				} else {
					max = ""
				}

				if (styles != "") {
					styles = " class=" + styles
				} else {
					styles = ""
				}

        			HTMLTextField = '<input type="' + type + '"' + name + styles + value + width + max + '>'
					// window.opener.foo.focus();
         			rng.pasteHTML(HTMLTextField)
		} // End if
		} // End if
	} // End If

	if (error != 1) {
		self.close();
	}
} // End function

document.onkeydown = function () { 
	if (event.keyCode == 13) {	// ENTER
		InsertTextField()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		InsertTextField()
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
<title>[sTxtInsertTextField]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=textForm>
<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtInsertTextFieldInst]</span>
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
	<td class="body" width="80">[sTxtMaxChars]:</td>
	<td class="body">
	  <input type="text" name="text_max" size="3" class="Text70" maxlength="3">
	</td>
  </tr>
  <tr>
	<td class="body" width="80">[sTxtType]:</td>
	<td class="body">
	  <select name="text_type" class=text70>
	  <option selected>Text
	  <option>Password</option>
	  </select>
	</td>
	<td class="body">[sTxtStyle]:</td>
	<td class="body"><script>printStyleList()</script></td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertTextField" value="[sTxtOK]" class="Text75" onClick="javascript:InsertTextField();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>
</form>