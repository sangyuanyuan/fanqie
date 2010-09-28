<script language=JavaScript>
window.onload = doLoad

function doLoad() {
	ci = window.opener.customInserts
	// alert(document.getElementById("myCi").outerHTML)
	
	for (i = 0; i < ci.length; i++) {
		newOption = document.createElement("option");
		newOption.value = ci[i][1]
		newOption.text = ci[i][0]
		document.getElementById("myCi").add(newOption)
	}
}

re = /&lt;/g
re2 = /&gt;/g
function doPreview(myForm) {
	customHTML = myForm.customInserts.value
	previewPane = document.getElementById("p1")
	if (customHTML == "") {
		foo.document.body.innerHTML = ""
	} else {
		customHTML = customHTML.replace(re,"<")
		customHTML = customHTML.replace(re2,">")
		foo.document.body.innerHTML = customHTML
	}
}

function InsertHTML() {
	error = 0
	var sel = window.opener.foo.document.selection;
	if (sel!=null) {
		var rng = sel.createRange();
	   	if (rng!=null) {

			customHTML = foo.document.body.innerHTML

        	if (error != 1) {
				if (customHTML == "") {
					alert("[sTxtCustomInsertErr]")
					error = 1
				} else {
					rng.pasteHTML(customHTML)
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
		InsertHTML()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		InsertHTML()
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

<title>[sTxtCustomInserts]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=customForm>

<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtCustomInsertInst]</span>
</div>
<br>

<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
  <tr> 
	<td class="body" width="90" valign=top>[sTxtCustomInsert]:</td>
	<td class="body"> 
	  <select name="customInserts" id=myCi size="4" class=text220 onChange="doPreview(this.form)" style="width:300px">
	  </select>
	</td>
  </tr>
  <tr>
	<td class="body" width="90" valign=top>[sTxtPreview]:</td>
	<td class="body"><iframe id="foo" src="" border="1" style="width:300px;height:100px;"></iframe></td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertHTML" value="[sTxtOK]" class="Text75" onClick="javascript:InsertHTML();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>