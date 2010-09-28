<script language=JavaScript>
window.onload = this.focus

function InsertForm() {
	error = 0
	var sel = window.opener.document.selection;
	if (sel!=null) {
		var rng = sel.createRange();
	   	if (rng!=null) {
			name = document.formForm.form_name.value
			action = document.formForm.form_action.value
			method = document.formForm.form_method[formForm.form_method.selectedIndex].text

        		if (error != 1) {

				if (method != "None") {
					method = ' method="' + method + '"'
				} else {
					method = ""
				}

				if (name != "") {
					name = ' name="' + name + '"'
				} else {
					name = ""
				}

				if (action != "") {
					action = ' action="' + action + '"'
				} else {
					action = ""
				}

        			HTMLForm = "<form id=ewp_element_to_style" + name + action + method +">&nbsp;</form>"
         			rng.pasteHTML(HTMLForm)

					oForm = window.opener.foo.document.getElementById("ewp_element_to_style")
					
					if (window.opener.borderShown == "yes") {
						oForm.runtimeStyle.border = "1px dotted #FF0000"
					}

					oForm.removeAttribute("id")


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
		InsertForm()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		InsertForm()
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
<title>[sTxtInsertForm]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=formForm>
<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtInsertFormInst]</span>
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
	  <select class=text70 name=form_method>
		<option selected>None
		<option>Post
		<option>Get</option>
		</select>
	</td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertForm" value="[sTxtOK]" class="Text75" onClick="javascript:InsertForm();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>