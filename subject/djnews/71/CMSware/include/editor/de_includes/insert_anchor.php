<script language=JavaScript>
window.onload = this.focus

window.onload = doLoad;

function doLoad() {
		document.anchorForm.anchor_name.focus()
}

function InsertAnchor() {
	error = 0
	var sel = window.opener.foo.document.selection;
	if (sel!=null) {
		var rng = sel.createRange();
	   	if (rng!=null) {

			name = document.anchorForm.anchor_name.value

        	if (error != 1) {
				if (name == "") {
					alert("[sTxtInsertAnchorErr]")
					document.anchorForm.anchor_name.focus
					error = 1
				} else {

					selectedText = window.opener.foo.document.selection.createRange().htmlText

					rng.pasteHTML("<a id=ewp_element_to_style name=" + anchorForm.anchor_name.value + ">" + selectedText + "</a>")
					oAnchor = window.opener.foo.document.getElementById("ewp_element_to_style")
					
					if (window.opener.borderShown == "yes") {
						oAnchor.runtimeStyle.width = "20px"
						oAnchor.runtimeStyle.height = "20px"
						oAnchor.runtimeStyle.textIndent  = "20px"
						oAnchor.runtimeStyle.backgroundRepeat  = "no-repeat"
						oAnchor.runtimeStyle.backgroundImage = "url($DEP/de_images/anchor.gif)"
					}

					oAnchor.removeAttribute("id")
				}
			}
		}
	}
	
	if (error != 1) {
		// window.opener.foo.focus()
		self.close();
	}
}

document.onkeydown = function () { 
	if (event.keyCode == 13) {	// ENTER
		InsertAnchor()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		InsertAnchor()
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
<title>[sTxtInsertAnchor]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=anchorForm>

<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtInsertAnchorInst]</span>
</div>
<br>

<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
  <tr>
	<td class="body" width="90">[sTxtInsertAnchorName]:</td>
	<td class="body">
	  <input type="text" name="anchor_name" size="10" class="Text150" maxlength="150">
  </td>
  </tr>
</table>
	
</div>
<div style="padding-top: 6px; float: right;">
	<input type="button" name="insertAnchor" value="[sTxtOK]" class="Text75" onClick="javascript:InsertAnchor();">
	<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>