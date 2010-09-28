<script language=JavaScript>
var myPage = window.opener;
window.opener.doStyles()
window.onload = setValues;

var radioName = myPage.selectedRadio.name;
var radioValue = myPage.selectedRadio.value;
var radioType = myPage.selectedRadio.checked; // true or false

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

	radioForm.radio_value.value = radioValue;
	radioForm.radio_name.value = radioName;
	this.focus();
}

function doModify() {
	var sel = window.opener.document.selection;
		if (sel!=null) {
			var rng = sel.createRange();
		}

		name = document.radioForm.radio_name.value
		value = document.radioForm.radio_value.value
		type = document.radioForm.radio_type[radioForm.radio_type.selectedIndex].text
		styles = document.radioForm.sStyles[radioForm.sStyles.selectedIndex].text

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

   		HTMLTextField = '<input type=radio' + name + value + type + styles + '>'
   		myPage.selectedRadio.outerHTML = HTMLTextField
    
    window.close()
}

function printType() {
	if ((radioType != undefined) || (radioType != "")) {
		if (radioType == false) { 
			radioType = "Unchecked"
		}

		if (radioType == true) {
			radioType = "Checked"
		}

		document.write('<option selected>' + radioType)
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
<title>[sTxtModifyRadio]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=radioForm>
<div class="appOutside">

<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtModifyRadioInst]</span>
</div>
<br>
<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
  <tr>
	<td class="body" width="90">[sTxtName]:</td>
	<td class="body" width="190">
	  <input type="text" name="radio_name" size="10" class="Text70" maxlength="50">
  </td>
	<td class="body" width="90">[sTxtInitialValue]:</td>
	<td class="body">
	  <input type="text" name="radio_value" size="10" class="Text70">
	</td>
  </tr>
  
  <tr>
	<td class="body" width="90">[sTxtInitialState]:</td>
	<td class="body">
	  <select name="radio_type" class=text70>
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
<input type="button" name="modifyRadio" value="[sTxtOK]" class="Text75" onClick="javascript:doModify();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>