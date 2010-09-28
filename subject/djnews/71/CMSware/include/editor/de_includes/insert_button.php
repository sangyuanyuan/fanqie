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

function InsertButton() {
	error = 0
	var sel = window.opener.foo.document.selection;
	if (sel!=null) {
		var rng = sel.createRange();
	   	if (rng!=null) {

			name = document.buttonForm.button_name.value
			value = document.buttonForm.button_value.value
			type = document.buttonForm.button_type[buttonForm.button_type.selectedIndex].text
			styles = document.buttonForm.sStyles[buttonForm.sStyles.selectedIndex].text

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

			if (styles != "") {
				styles = " class=" + styles
			} else {
				styles = ""
			}

			HTMLTextField = '<input type="' + type + '"' + name + value + styles + '>'
			rng.pasteHTML(HTMLTextField)
		} // End if
	} // End If

	if (error != 1) {
		// window.opener.foo.focus();
		self.close();
	}
} // End function

document.onkeydown = function () { 
	if (event.keyCode == 13) {	// ENTER
		InsertButton()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		InsertButton()
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
<title>[sTxtInsertButton]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=buttonForm>
<div class="appOutside">

<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtInsertButtonInst]</span>
</div>
<br>

<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
  <tr>
	<td class="body" width="80">[sTxtName]:</td>
	<td class="body" width="200">
	  <input type="text" name="button_name" size="10" class="Text70" maxlength="50">
  </td>
	<td class="body" width="90">[sTxtInitialValue]:</td>
	<td class="body">
	  <input type="text" name="button_value" size="10" class="Text70">
	</td>
  </tr>
  <tr>
	<td class="body" width="80">[sTxtType]:</td>
	<td class="body">
	  <select name="button_type" class=text70>
		<option selected>Submit
		<option>Reset
		<option>Button</option>
	  </select>
	</td>
	<td class="body">[sTxtStyle]:</td>
	<td class="body"><script>printStyleList()</script></td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertButton" value="[sTxtOK]" class="Text75" onClick="javascript:InsertButton();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>