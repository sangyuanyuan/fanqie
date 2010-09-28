<script language=JavaScript>
window.onload = this.focus
window.opener.doStyles()

function printStyleList() {
	if (window.opener.document.getElementById("sStyles") != null) {
		document.write(window.opener.document.getElementById("sStyles").outerHTML);
		document.getElementById("sStyles").className = "text90";
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

function getLink() {
		if (window.opener.foo.document.selection.type == "Control") {
			var oControlRange = window.opener.foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "IMG") {
				var oSel = oControlRange(0).parentNode;
			} else {
				alert("Link can only be created on an Image or Text")
			}
		} else {
			oSel = window.opener.foo.document.selection.createRange().parentElement();
		}

		if (oSel.tagName.toUpperCase() == "A")
		{
			myHref = oSel.getAttribute("href",2)
			if (myHref.indexOf("?") >-1 )
			{
				myHrefEmail = myHref.substring(7, myHref.indexOf("?"))
				myHrefSubject = myHref.substring(myHref.indexOf(myHrefEmail)+myHrefEmail.length+9, myHref.length)
			} else {
				myHrefEmail = myHref.substring(7, myHref.length)
				myHrefSubject = ""
			}

			document.emailForm.email.value = myHrefEmail
			document.emailForm.subject.value = myHrefSubject
		}
}

function InsertEmail() {
	error = 0
	var sel = window.opener.foo.document.selection;
	if (sel!=null) {
		var rng = sel.createRange();
	   	if (rng!=null) {

			if (window.opener.foo.document.selection.type == "Control")
				{
					selectedImage = window.opener.foo.document.selection.createRange()(0);
					selectedImage.width = selectedImage.width
					selectedImage.height = selectedImage.height
				}

			email = document.emailForm.email.value
			subject = document.emailForm.subject.value
			styles = document.emailForm.sStyles[emailForm.sStyles.selectedIndex].text

        	if (error != 1) {

				if (email == "") {
					alert("[sTxtEmailErr]")
					document.emailForm.email.focus
					error = 1
				} else {
					mailto = "mailto:" + email
					if (subject != "")
					{
						mailto = mailto + "?subject=" + subject
					}

					rng.execCommand("CreateLink",false,mailto)

					if (window.opener.foo.document.selection.type == "Control")
						oLink = rng(0).parentNode;
					else
						oLink = rng.parentElement()

					if (styles != "")
						oLink.className = styles
					else
						oLink.removeAttribute("className")
				}
			}
		}
	}
	
	if (error != 1) {
		// window.opener.foo.focus()
		window.opener.doToolbar()
		window.opener.showLink()
		self.close();
	}
}

function RemoveLink() {
	if (window.opener.foo.document.selection.type == "Control")
	{
		selectedImage = window.opener.foo.document.selection.createRange()(0);
		selectedImage.width = selectedImage.width
		selectedImage.height = selectedImage.height
	}

	window.opener.foo.document.execCommand("Unlink");
	// window.opener.foo.focus();
	window.opener.showLink()
	self.close();
}

document.onkeydown = function () { 
	if (event.keyCode == 13) {	// ENTER
		InsertEmail()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		InsertEmail()
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
<title>[sTxtInsertEmail]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=emailForm>
<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtInsertEmailInst]</span>
</div>
<br>

<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
	  <tr>
		    <td class="body" width="90">[sTxtEmailAddress]:</td>
			<td class="body">
			  <input type="text" name="email" size="10" class="Text150" maxlength="150">
		  </td>
		  </tr>
		  <tr>
		    <td class="body" width="80">
			[sTxtSubject]:</td>
			<td class="body">
			  <input type="text" name="subject" size="10" class="Text150">
		  </td>
		  </tr>
		  <tr>
		  <td class="body">[sTxtStyle]:</td>
		  <td class="body">
				<script>printStyleList()</script>
		  </td>
		</tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertLink" value="[sTxtInsertEmailLink]" class="Text120" onClick="javascript:InsertEmail();">
<input type="button" name="removeLink" value="[sTxtRemoveEmailLink]" class="Text120" onClick="javascript:RemoveLink();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>
</form>
<script>getLink()</script>