<script language=JavaScript>
var myPage = window.opener;
window.opener.doStyles()
window.onload = setValues;

var checkboxName = myPage.selectedCheckbox.name;
var checkboxValue = myPage.selectedCheckbox.value;
var checkboxType = myPage.selectedCheckbox.checked; // true or false
var checkboxClass = myPage.selectedCheckbox.className;

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

	if (checkboxClass != "") {
		checkboxClass = " class=" + checkboxClass
	}

	checkboxForm.checkbox_value.value = checkboxValue;
	checkboxForm.checkbox_name.value = checkboxName;
	this.focus();
}

function doModify() {
	var sel = window.opener.document.selection;
		if (sel!=null) {
			var rng = sel.createRange();
		}

		name = document.checkboxForm.checkbox_name.value
		value = document.checkboxForm.checkbox_value.value
		type = document.checkboxForm.checkbox_type[checkboxForm.checkbox_type.selectedIndex].text
		styles = document.checkboxForm.sStyles[checkboxForm.sStyles.selectedIndex].text

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

   		HTMLTextField = '<input type=checkbox' + name + value + type + styles + '>'
   		myPage.selectedCheckbox.outerHTML = HTMLTextField
    
    window.close()
}

function printType() {
	if ((checkboxType != undefined) || (checkboxType != "")) {
		if (checkboxType == false) { 
			checkboxType = "Unchecked"
		}

		if (checkboxType == true) {
			checkboxType = "Checked"
		}

		document.write('<option selected>' + checkboxType)
		document.write('<option>Checked')
		document.write('<option>Unchecked</option>')
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
<title>[sTxtModifyCheckBox]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=checkboxForm>
<div class="appOutside">

<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtModifyCheckBoxInst]</span>
</div>
<br>
<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
  <tr>
	<td class="body" width="80">[sTxtName]:</td>
	<td class="body" width="190">
	  <input type="text" name="checkbox_name" size="10" class="Text70" maxlength="50">
  </td>
	<td class="body" width="90">[sTxtInitialValue]:</td>
	<td class="body">
	  <input type="text" name="checkbox_value" size="10" class="Text70">
	</td>
  </tr>
  
  <tr>
	<td class="body" width="90">[sTxtInitialState]:</td>
	<td class="body">
	  <select name="checkbox_type" class=text70>
		<script>printType()</script>
	  </select>
	</td>
	<td class="body">[sTxtStyle]:</td>
	<td class="body">
	<script>printStyleList()</script></td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="modifyCheckbox" value="[sTxtOK]" class="Text75" onClick="javascript:doModify();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>