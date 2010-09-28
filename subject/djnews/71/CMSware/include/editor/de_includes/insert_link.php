<script language=JavaScript>

window.onload = doLoad;
window.opener.doStyles();

function doLoad() {
	ci = window.opener.customLinks
	for (i = 0; i < ci.length; i++)
	{
		newOption = document.createElement("option");
		newOption.text = ci[i][0]
		val = ci[i][1];
		linkPart = ci[i][1].substring(0, ci[i][1].indexOf("|"))
		targetPart = ci[i][1].substring(ci[i][1].indexOf("|")+1, ci[i][1].length)
		newOption.value = linkPart
		newOption.id = targetPart
		document.getElementById("libraryText").add(newOption)
	}

	// If there are no custom links, hide the custom link TR
	if(ci.length == 0)
	{
		document.getElementById("trCustomLink").style.display = "none";
	}
}

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
			document.linkForm.targetWindow.value = oSel.target
			document.linkForm.link.value = oSel.getAttribute("href",2)
		}
	}

function InsertLink() {
	targetWindow = document.linkForm.targetWindow.value;
	var linkSource = document.linkForm.link.value
	styles = document.linkForm.sStyles[linkForm.sStyles.selectedIndex].text
	if (linkSource != "")
	{
	var oNewLink = window.opener.foo.document.createElement("<A>");
	oNewSelection = window.opener.foo.document.selection.createRange()

			if (window.opener.foo.document.selection.type == "Control")
			{
				selectedImage = window.opener.foo.document.selection.createRange()(0);
				selectedImage.width = selectedImage.width
				selectedImage.height = selectedImage.height
			}
				oNewSelection.execCommand("CreateLink",false,linkSource);
				if (window.opener.foo.document.selection.type == "Control")
			{
				oLink = oNewSelection(0).parentNode;
			} else
				oLink = oNewSelection.parentElement()
				if (targetWindow != "")
			{
				oLink.target = targetWindow;
			} else
				oLink.removeAttribute("target")
				if (styles != "")
				oLink.className = styles
			else
				oLink.removeAttribute("className")
				// window.opener.foo.focus();
			window.opener.doToolbar()
			window.opener.showLink()
			self.close();
		} else {
			alert("[sTxtLinkErr]")
			document.linkForm.link.focus()
		}
	}
		function CreateLink(LinkSource) {
		document.linkForm.link.value = LinkSource;
		document.linkForm.link.focus()
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

function getAnchors() {
	var allLinks = window.opener.foo.document.body.getElementsByTagName("A");
	for (a=0; a < allLinks.length; a++) {
		if (allLinks[a].href.toUpperCase() == "") {
			document.write("<option value=#" + allLinks[a].name + ">" + allLinks[a].name + "</option>")
		}
	}
}
</script>
<title>[sTxtLinkManager]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=linkForm>
<div class="appOutside">

<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtLinkManagerInst]</span>
</div>
<br>

<table border="0" cellspacing="0" cellpadding="5" width="92%">
  <tr>
	<td class=body width="100">[sTxtUrl]:</td>
	<td class=body>
	  <input type="text" name="link" value="" class="Text220">
	</td>
  </tr>
  <tr id="trCustomLink">
	<td class=body width="100">[sTxtLibraryUrl]:</td>
	<td class=body>
	  <select id="libraryText" name="libraryText" class="Text220" onChange="link.value = libraryText[libraryText.selectedIndex].value; targetWindow.value = libraryText[libraryText.selectedIndex].id; link.focus()">
	  <option value=""></option>
	  </select>
	</td>
  </tr>
  <tr>
	<td class=body>[sTxtTargetWin]:</td>
	<td class=body>
	  <input type="text" name="targetWindow" value="" class="Text90">
	  <select name="targetText" class="Text90" onChange="targetWindow.value = targetText[targetText.selectedIndex].value; targetText.value = ''; targetWindow.focus()">
	  <option value=""></option>
	  <option value="">None</option>
	  <option value=_blank>_blank</option>
	  <option value=_parent>_parent</option>
	  <option value=_self>_self</option>
	  <option value=_top>_top</option>
	  </select></td>
	</td>
  </tr>
  <tr>
  <td class=body>[sTxtAnch]:</td>
  <td class=body>
	  <select name="targetAnchor" class="Text90" onChange="link.value = targetAnchor[targetAnchor.selectedIndex].value; targetAnchor.value = ''; link.focus()">
<option value=""></option>
<script>getAnchors()</script>
	  </select></td>
  </tr>
  <tr>
  <td class="body">[sTxtStyle]:</td>
  <td class="body">
<script>printStyleList()</script>
  </td>
  </tr>
  <tr id="trFiller" style="display:none">
<td colspan="2" width="100%" height="20">
nbsp;
	</td>
	  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertLink" value="[sTxtInsertLink]" class="Text75" onClick="javascript:InsertLink();">
<input type="button" name="removeLink" value="[sTxtRemoveLink]" class="Text85" onClick="javascript:RemoveLink();">
<input type=button name="Cancel" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>
	</form>
	<script>getLink()</script>