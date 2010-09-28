<script language=javascript>
var myPage = window.opener;
window.onload = setValues;

var formName = myPage.selectedForm.name;
var formAction = myPage.selectedForm.action;
var formMethod = myPage.selectedForm.method;

function setValues() {

	formForm.form_name.value = formName;
	formForm.form_action.value = formAction;
	this.focus();
}

function doModify() {

	if (formForm.form_name.value != "") {
		myPage.selectedForm.name = formForm.form_name.value
	} else {
		myPage.selectedForm.removeAttribute('name',0)
	}

	if (formForm.form_action.value != "") {
		myPage.selectedForm.action = formForm.form_action.value
	} else {
		myPage.selectedForm.removeAttribute('action',0)
	}

	if (formForm.method[formForm.method.selectedIndex].text != "None") {
    	myPage.selectedForm.method = formForm.method[formForm.method.selectedIndex].text
    } else {
		myPage.selectedForm.removeAttribute('method',0)
    }
        
    window.close()
}

function printMethod() {
	if ((formMethod != undefined) && (formMethod != "")) {
		document.write('<option selected>' + formMethod)
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
<title>[sTxtModifyForm]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=formForm>
<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtModifyFormInst]</span>
</div>
<br>

<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
  <tr>
	<td class="body" width="80">[sTxtName]:</td>
	<td class="body">
	  <input type="text" name="form_name" size="10" class="Text70" maxlength="50">
  </td>
  </tr>
  <tr>
	<td class="body" width="80">[sTxtAction]:</td>
	<td class="body">
	  <input type="text" name="form_action" size="50" class="Text250">
  </td>
  </tr>
  <tr>
	<td class="body" width="80">[sTxtMethod]:</td>
	<td class="body">
	  <SELECT class=text70 name=method>
		<script>printMethod()</script>
		<option>Post
		<option>Get</option>
	  </select>
  </td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="modifyForm" value="[sTxtOK]" class="Text75" onClick="javascript:doModify();">
<input type="button" name="Submit" value="Cancel" class="Text75" onClick="javascript:window.close()">
</div>

</form>