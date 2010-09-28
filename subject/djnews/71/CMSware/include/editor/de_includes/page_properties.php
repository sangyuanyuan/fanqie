<script language=javascript>

var myPage = window.opener;

var pageTitle = myPage.foo.document.title;
var pageBgColor = myPage.foo.document.body.bgColor;
var pageLinkColor = myPage.foo.document.body.link;
var pageTextColor = myPage.foo.document.body.text;
var backgroundImage = myPage.foo.document.body.background;
var metaKeywords = ""
var metaDescription = ""
var oDescription
var oKeywords

var metaData = myPage.foo.document.getElementsByTagName('META')
for (var m = 0; m < metaData.length; m++) {
	if (metaData[m].name.toUpperCase() == "KEYWORDS") {
      metaKeywords = metaData[m].content
	  oKeywords = metaData[m]
	}
	  
	if (metaData[m].name.toUpperCase() == 'DESCRIPTION') {
      metaDescription = metaData[m].content
	  oDescription = metaData[m]
	}

}

window.onload = setValues;

// Functions for color popup
var oPopup = window.createPopup();
var colorType = 0
function showColorMenu(menu, width, height) {

	lefter = event.clientX;
	leftoff = event.offsetX;
	topper = event.clientY;
	topoff = event.offsetY;

	var oPopBody = oPopup.document.body;
	moveMe = 0

	if (menu == "colorMenu3") {
		menu = "colorMenu"
		colorType = 3
	} else if (menu == "colorMenu2") {
		menu = "colorMenu"
		colorType = 2
	} else {
		colorType = 1
	}


	var HTMLContent = window.opener.eval(menu).innerHTML
	oPopBody.innerHTML = HTMLContent
	oPopup.show(lefter - leftoff - 2 - moveMe, topper - topoff + 22, width, height, document.body);

	return false;
}

function button_over(td) {
	window.opener.button_over(td)
}

function button_out(td) {
	window.opener.button_out(td)
}

function doColor(td) {
	if (td) {
		if (colorType == 3) {
			document.pageForm.linkcolor.value = td.childNodes(0).style.backgroundColor.toUpperCase()
		} else if (colorType == 2) {
			document.pageForm.textcolor.value = td.childNodes(0).style.backgroundColor.toUpperCase()
		} else {
			document.pageForm.bgColor.value = td.childNodes(0).style.backgroundColor.toUpperCase()
		}
	} else {
		if (colorType == 3) {
			document.pageForm.linkcolor.value = ''
		} else if (colorType == 2) {
			document.pageForm.textcolor.value = ''
		} else {
			document.pageForm.bgColor.value = ''
		}
	}
	oPopup.hide()
}

function doMoreColors() {
	colorWin = window.open(window.opener.popupColorWin,'','width=420,height=370,scrollbars=no,resizable=no,titlebar=0,top=' + (screen.availHeight-400) / 2 + ',left=' + (screen.availWidth-420) / 2)
}

// End functions

function setValues() {

	pageForm.pagetitle.value = pageTitle;
	pageForm.description.value = metaDescription;
	pageForm.keywords.value = metaKeywords;
	pageForm.bgImage.value = backgroundImage;
	pageForm.bgColor.value = pageBgColor;
	pageForm.linkcolor.value = pageLinkColor;
	pageForm.textcolor.value = pageTextColor;
	this.focus();
}

function doModify() {
	var bgImage = pageForm.bgImage.value
	var bgcolor = pageForm.bgColor.value
	var linkcolor = pageForm.linkcolor.value
	var textcolor = pageForm.textcolor.value

	if (bgImage != "") { myPage.foo.document.body.background = bgImage } else { myPage.foo.document.body.removeAttribute("background",0) }
	if (bgcolor != "") { myPage.foo.document.body.bgColor = bgcolor } else { myPage.foo.document.body.removeAttribute("bgColor",0) }
	if (linkcolor != "None") { myPage.foo.document.body.link = linkcolor } else { myPage.foo.document.body.removeAttribute("link",0) }
	if (textcolor != "None") { myPage.foo.document.body.text = textcolor } else { myPage.foo.document.body.removeAttribute("text",0) }

	myPage.foo.document.title = pageForm.pagetitle.value
	
	var oHead = myPage.foo.document.getElementsByTagName('HEAD')

	if (oKeywords != null) {
		oKeywords.content = pageForm.keywords.value
	} else {
		var oMetaKeywords = myPage.foo.document.createElement("META");
		oMetaKeywords.name = "Keywords"
		oMetaKeywords.content = pageForm.keywords.value
		oHead(0).appendChild(oMetaKeywords)
	}

		if (oDescription != null){
			oDescription.content = pageForm.description.value
		} else {
			var oMetaDesc= myPage.foo.document.createElement("META");
			oMetaDesc.name = "Description"
			oMetaDesc.content = pageForm.description.value
			oHead(0).appendChild(oMetaDesc);
		}

	window.close()
}

function printLinkColor() {
	if ((pageLinkColor != undefined) && (pageLinkColor != "")) {
		document.write('<option selected style="BACKGROUND-COLOR: ' + pageLinkColor + '">' + pageLinkColor)
		document.write('<option>None')
	} else {
		document.write('<option selected>None')
	}
}

function printTextColor() {
	if ((pageTextColor != undefined) && (pageTextColor != "")) {
		document.write('<option selected style="BACKGROUND-COLOR: ' + pageTextColor + '">' + pageTextColor)
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
<title>[sTxtPageProps]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=pageForm>
<div class="appOutside">

<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtPagePropsInst]</span>
</div>
<br>

<table border="0" cellspacing="0" cellpadding="5" width="92%">
	  <tr>
		<td class="body" width="100">[sTxtPageTitle]:</td>
		<td class="body">
		  <input type="text" name="pagetitle" maxlength="100" class=text220>
		</td>
	  </tr>
	  <tr>
		<td class="body" valign="top">[sTxtDescription]:</td>
		<td class="body">
		  <textarea name="description" class="text220" rows="4"></textarea>
		</td>
	  </tr>
	  <tr>
		<td class="body">[sTxtKeywords]:</td>
		<td class="body">
		  <input type="text" name="keywords" maxlength="300" class=text220>
		</td>
	  </tr>
	  <tr>
		<td class="body">[sTxtBgImage]:</td>
		<td class="body">
		  <input type="text" name="bgImage" maxlength="300" class=text220>
		  </td>
	  </tr> 
		  <tr>
		<td class="body">[sTxtBgColor]:</td>
		  <td class="body">
		  <input type="text" name="bgColor" size="2" class="text70" maxlength="7" value=""><img onClick="showColorMenu('colorMenu',157,158)" src="de_images/popups/colors.gif" width=21 height=20 hspace=5 style="position: relative; top:5px" onmouseover="window.opener.button_over(this);" onmouseout="window.opener.button_out(this);" onmousedown="window.opener.button_down(this);" class=toolbutton>
		  </td>
		  </tr>
		  <tr>
			<td class="body">[sTxtTextColor]:</td>
			<td class="body">
			  <input type="text" name="textcolor" size="2" class="text70" maxlength="7" value=""><img onClick="showColorMenu('colorMenu2',157,158)" src="de_images/popups/colors.gif" width=21 height=20 hspace=5 style="position: relative; top:5px" onmouseover="window.opener.button_over(this);" onmouseout="window.opener.button_out(this);" onmousedown="window.opener.button_down(this);" class=toolbutton>
			</td>
		  </tr>
		  <tr>
			<td class="body">[sTxtLinkColor]:</td>
			<td class="body">
			  <input type="text" name="linkcolor" size="2" class="text70" maxlength="7" value=""><img onClick="showColorMenu('colorMenu3',157,158)" src="de_images/popups/colors.gif" width=21 height=20 hspace=5 style="position: relative; top:5px" onmouseover="window.opener.button_over(this);" onmouseout="window.opener.button_out(this);" onmousedown="window.opener.button_down(this);" class=toolbutton>
			</td>
		  </tr>
	    </table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="modifyPage" value="[sTxtOK]" class="Text75" onClick="javascript:doModify();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>

</form>