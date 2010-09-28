<script language=JavaScript>
window.onload = this.focus
var error
function InsertHiddenField() {
	var sel = window.opener.document.selection;
	if (sel!=null) {
		var rng = sel.createRange();
	   	if (rng!=null) {
			name = document.hiddenForm.hidden_name.value
			value = document.hiddenForm.hidden_value.value

		error = 0

		if (error != 1) {
				if (value != "None") {
					value = ' value="' + value + '"'
				} else {
					value = ""
				}

				if (name != "") {
					name = ' name="' + name + '"'
				} else {
					name = ""
				}

        		HTMLTextField = '<input id=ewp_element_to_style type=hidden' + name + value + '>'
         		rng.pasteHTML(HTMLTextField)

				oHidden = window.opener.foo.document.getElementById("ewp_element_to_style")
					
				if (window.opener.borderShown == "yes") {
					oHidden.runtimeStyle.border = "0px"
					oHidden.runtimeStyle.width = "20px"
					oHidden.runtimeStyle.height = "20px"
					oHidden.runtimeStyle.backgroundImage = "url($DEP/de_images/hidden.gif)"
					oHidden.runtimeStyle.fontSize = "99px"
				}

				oHidden.removeAttribute("id")


		} // End if
		} // End if
	} // End If

	if (error != 1) {
		// window.opener.foo.focus();
		self.close();
	}
} // End function

document.onkeydown = function () { 
	if (event.keyCode == 13) {	// ENTER
		InsertHiddenField()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		InsertHiddenField()
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
<title>[sTxtInsertHidden]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=hiddenForm>
<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtInsertHiddenInst]</span>
</div>
<br>

<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
  <tr>
	<td class="body" width="80">[sTxtName]:</td>
	<td class="body" width="200">
	  <input type="text" name="hidden_name" size="10" class="Text150" maxlength="50">
  </td>
  </tr>
  <tr>
	<td class="body" width="80">[sTxtInitialValue]:</td>
	<td class="body">
	  <input type="text" name="hidden_value" size="10" class="Text150">
	</td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertHiddenField" value="[sTxtOK]" class="Text75" onClick="javascript:InsertHiddenField();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>