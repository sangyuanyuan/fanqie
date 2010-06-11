	var imageWin
	var propWin
	var inserttableWin
	var previewWin
	var modifytableWin
	var insertFormWin
	var textFieldWin
	var hiddenWin
	var buttonWin
	var checkboxWin
	var radioWin
	var linkWin
	var emailWin
	var anchorWin
	var showHelpWin
	var customInsertWin
	var charWin

	var selectedTD
	var selectedTR
	var selectedTBODY
	var selectedTable
	var selectedImage
	var selectedForm
	var selectedTextField
	var selectedTextArea
	var selectedHidden
	var selectedbutton
	var selectedCheckbox
	var selectedRadio

	var controlName

	var doSave = 0
	var zoomSize = 100

	// URL of StyleSheet used when adding StyleSheet with CodeSnippet
	var myStyleSheet = ""

	var fileCache
	fileCache = 0

	var statusMode = ""
	var statusBorders = ""
	var toggle = "off"
	var borderShown = "no"
	var fooURL
	var reloaded
	var justSwitched = false
	reloaded = 0
	var colorType = 0

	window.onload = doLoad
	window.onerror = stopError

	var loaded = false

	function saveDevEdit() {
		if (confirm(sTxtArticleSave))
		{
		 updateValue(true)
		 parent.document.forms[0].submit()
		}else{
		 return false;
		}
	}

	function stopError() {
		return true;
	}

	function doLoad() {
		startDE()
	}

	var stylesDisplayed = 0
	function doStyles() {
		if (foo.document.styleSheets.length > 0) {
			
			if (stylesDisplayed != 1)
			{
				displayUserStyles()
				stylesDisplayed = 1
			}

		}
	}

	function initFoo() {

		var iframes = document.all.tags("IFRAME");
		el = iframes[0];

		el.frameWindow = document.frames[el.id];

		el.frameWindow.document.oncontextmenu = function () {
			if (!el.frameWindow.event.ctrlKey){
				showContextMenu(el.frameWindow.event)
				return false;
			}
		}

		el.frameWindow.document.onerror = function () {
			return true;
		}

		el.frameWindow.document.onselectionchange = function () {
			if (doSave == 0)
			{
				doToolbar();
			}
		}

		el.frameWindow.document.onkeydown = function ()
		{
			if (el.frameWindow.event.keyCode == 13)
			{
				if (useBR)
				{

					var sel = el.frameWindow.document.selection;
					if (sel.type == "Control")
						return;

					if (!el.frameWindow.event.shiftKey)
					{

						var r = sel.createRange();	
						r.pasteHTML("<BR>");
						el.frameWindow.event.cancelBubble = true; 
						el.frameWindow.event.returnValue = false; 

						r.select();
						r.moveEnd("character", 1);
						r.moveStart("character", 1);
						r.collapse(false);
						
						return false;

					} else
					{
					
						if (isCursorInList())
						{
							var r = sel.createRange();	
							r.pasteHTML("<li>&nbsp;</li>");
							el.frameWindow.event.cancelBubble = true; 
							el.frameWindow.event.returnValue = false; 
							
							r.moveStart("character", -1);
							r.collapse(true);
							r.select();

							return false;
						} else
						{
							var r = sel.createRange();	
							r.pasteHTML("<p>");
							el.frameWindow.event.cancelBubble = true; 
							el.frameWindow.event.returnValue = false; 

							r.collapse(true);
							r.select();
						
							return false;
						}
					}
				} else {
					var sel = el.frameWindow.document.selection;
					if (sourceModeOn)
					{
						var r = sel.createRange();	
						r.pasteHTML("<BR>");
						el.frameWindow.event.cancelBubble = true; 
						el.frameWindow.event.returnValue = false; 

						r.select();
						r.moveEnd("character", 1);
						r.moveStart("character", 1);
						r.collapse(false);
						
						return false;
					}
				}

			}
			
			
			if(el.frameWindow.event.ctrlKey) {
				if(el.frameWindow.event.keyCode == 90) {//Z
					if (editModeOn) {
				      goHistory(-1);
					  return false;
					}
				} else if(el.frameWindow.event.keyCode == 89) {//Y
					if (editModeOn) {
				      goHistory(1);
					  return false;
					}
			//	} else if(el.frameWindow.event.keyCode == 68) {//D
			//      pasteWord();
			//	  return false;
				} else if(el.frameWindow.event.keyCode == 66) {//B
			      doCommand("bold");
				  return false;
				} else if(el.frameWindow.event.keyCode == 85) {//U
			      doCommand("underline");
				  return false;
				} else if(el.frameWindow.event.keyCode == 73) {//I
			      doCommand("italic");
				  return false;
			//**sam**
				} else if(el.frameWindow.event.keyCode == 83) {//保存 S
			      saveDevEdit();
				  return false;
				} else if(el.frameWindow.event.keyCode == 82) { //转换为标题	R
			      doTitle();
				  return false;
				} else if(el.frameWindow.event.keyCode == 87) {//转换为副标题 W
			      doSubTitle();
				  return false;
				} else if(el.frameWindow.event.keyCode == 68) {//D
			      doIntroTitle();
				  return false;
				} else if(el.frameWindow.event.keyCode == 72) {//H
			      doAuthor();
				  return false;
				} else if(el.frameWindow.event.keyCode == 81) {//Q
			      doAbstract();
				  return false;
				} else if(el.frameWindow.event.keyCode == 69) {//E
			      doSource();
				  return false;
				} else if(el.frameWindow.event.keyCode == 09) {//Tab
			      doArticle();
				  return false;
				} else if(el.frameWindow.event.keyCode == 78) {//N 无效
				  return false;
			//**sam**
				} else if(el.frameWindow.event.keyCode == 75) {//L
					if (document.getElementById("toolbarLink_on") != null) {
				      doLink();
					  return false;
					} else {
					  return false;
					}
				}
			}

			if(!el.frameWindow.event.ctrlKey && el.frameWindow.event.keyCode != 90 && el.frameWindow.event.keyCode != 89) {
				if (el.frameWindow.event.keyCode == 32 || el.frameWindow.event.keyCode == 13)
				{
					saveHistory()
				}
			}

			if (el.frameWindow.event.keyCode == 118) {
				if (document.getElementById("toolbarSpell") != null)
				{
					spellCheck();
					return false;
				}
			}
		}

		el.frameWindow.document.onkeyup = function() {
			showCutCopyPaste()
			showPosition()
			showLink()
			showUndoRedo()
		}

		foo.document.execCommand("2D-Position",false, true)
	}

	function doColor(td) {
		if (colorType == 2) {
			myCommand = 'BackColor'
			oMenu = document.getElementById("fontHighlight")
		} else {
			myCommand = 'ForeColor'
			oMenu = document.getElementById("fontColor")
		}

		if (td)
		{
			oColor = td.childNodes(0).style.backgroundColor
			oMenu.style.backgroundColor = oColor
		} else {
			oColor = ''
			if (colorType == 2)
			{
				oMenu.style.backgroundColor = "#FFFFFF"
			} else {
				oMenu.style.backgroundColor = "#000000"
			}
		}
		
		foo.document.execCommand(myCommand,false,oColor);
		oPopup.hide()
	}

	function doColorDirectly(whichColor) {
		if (whichColor == 2) {
			myCommand = 'BackColor'
			oColor = document.getElementById("fontHighlight").style.backgroundColor
		} else {
			myCommand = 'ForeColor'
			oColor = document.getElementById("fontColor").style.backgroundColor
		}

		foo.document.execCommand(myCommand,false,oColor);
		oPopup.hide()
	}

	var oPopup = window.createPopup();

	function showMenu(menu, width, height)
	{
    
	var lefter = event.clientX;
	var leftoff = event.offsetX
	var topper = event.clientY;
	var topoff = event.offsetY;
	var oPopBody = oPopup.document.body;
	moveMe = 0

	if (menu == "pasteMenu")
	{
		moveMe = 22
	}

	if (menu == "zoomMenu")
	{
		lefter = lefter-18
		topper = topper - 203
	}

	if (menu == "colorMenu") {
		colorType = "0"
		moveMe = 22
	}

	if (menu == "colorMenu2") {
		colorType = "2"
		menu = "colorMenu"
		moveMe = 22
	}

	if (menu == "formMenu")
	{
		if (isCursorInForm()) {
			document.getElementById("modifyForm1").disabled = false
		} else {
			document.getElementById("modifyForm1").disabled = true
		}
	}

	if (menu == "tableMenu")
	{
	
		if (isCursorInTableCell() || isTableSelected()) {
			document.getElementById("modifyTable").disabled = false
		} else {
			document.getElementById("modifyTable").disabled = true
		}

		if (isCursorInTableCell())
		{
			document.getElementById("modifyCell").disabled = false
			document.getElementById("rowAbove").disabled = false
			document.getElementById("rowBelow").disabled = false
			document.getElementById("deleteRow").disabled = false
			document.getElementById("colAfter").disabled = false
			document.getElementById("colBefore").disabled = false
			document.getElementById("deleteCol").disabled = false
			document.getElementById("increaseSpan").disabled = false
			document.getElementById("decreaseSpan").disabled = false

		} else {
			document.getElementById("modifyCell").disabled = true
			document.getElementById("rowAbove").disabled = true
			document.getElementById("rowBelow").disabled = true
			document.getElementById("deleteRow").disabled = true
			document.getElementById("colAfter").disabled = true
			document.getElementById("colBefore").disabled = true
			document.getElementById("deleteCol").disabled = true
			document.getElementById("increaseSpan").disabled = true
			document.getElementById("decreaseSpan").disabled = true

		}
	}

	var HTMLContent = eval(menu).innerHTML
	oPopBody.innerHTML = HTMLContent
	oPopup.show(lefter - leftoff - 2 - moveMe, topper - topoff + 22, width, height, document.body);

	return false;
	}

	var oPopup2 = window.createPopup();
	function showContextMenu(event)
	{
    
		menu = "contextMenu"
		width = ContextMenuWidth
		height = "67"

		var lefter = event.clientX;
		var topper = event.clientY;
	
		var oPopBody = oPopup2.document.body;

		height = parseInt(height)

		if (foo.document.queryCommandEnabled("cut"))
		{
			document.getElementById("cmCut").disabled = false
		} else {
			document.getElementById("cmCut").disabled = true
		}

		if (foo.document.queryCommandEnabled("paste"))
		{
			document.getElementById("cmPaste").disabled = false
		} else {
			document.getElementById("cmPaste").disabled = true
		}

		if (foo.document.queryCommandEnabled("copy"))
		{
			document.getElementById("cmCopy").disabled = false
		} else {
			document.getElementById("cmCopy").disabled = true
		}

		var hellohawking = true;

		var HTMLContent = "<table style='BORDER-LEFT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-RIGHT: #404040 1px solid; BORDER-BOTTOM: #404040 1px solid;' cellpadding=0 cellspacing=0><tr><td>"
		HTMLContent = HTMLContent + eval(menu).innerHTML

		if (isImageSelected())
		{
			HTMLContent = HTMLContent + eval("cmImageMenu").innerHTML
			height = height + 48 //92 原高度，48 去掉两行后高度

			if (document.getElementById("toolbarLink_on") != null)
			{
			HTMLContent = HTMLContent + eval("cmLinkMenu").innerHTML
			height = height + 25
			}
			hellohawking = false;
		}

		if (isTextSelected() && (sourceModeView != true))
		{
			if (document.getElementById("toolbarLink_on") != null)
			{
			HTMLContent = HTMLContent + eval("cmLinkMenu").innerHTML
			height = height + 27  //原高 49
			}
			
			HTMLContent = HTMLContent + eval("cmswareMenu").innerHTML
			height = height  //这里可以修改文本编辑右键菜单的高度
			hellohawking = false;
		}

		if (isTableSelected() || isCursorInTableCell())
		{
			if (document.getElementById("toolbarTables") != null)
			{
				HTMLContent = HTMLContent + eval("cmTableMenu").innerHTML
				height = height + 24
			}
			hellohawking = false;
		}
		
		if (isCursorInTableCell())
		{
			if (document.getElementById("toolbarTables") != null)
			{

			HTMLContent = HTMLContent + eval("cmTableFunctions").innerHTML
			height = height + 211
			hellohawking = false;

			}
		}

		if (document.getElementById("toolbarSpell") != null)
		{
			HTMLContent = HTMLContent + eval("cmSpellMenu").innerHTML
			height = height + 24
			hellohawking = false;
		}

		if(hellohawking) {
			HTMLContent = HTMLContent + eval("cmInsertPageMenu").innerHTML
			height = height + 49
			hellohawking = false;
		
		}

		HTMLContent = HTMLContent + "</td></tr></table>"
		oPopBody.innerHTML = HTMLContent
		
		oPopup2.show(lefter + 2,topper + 2, width, height, foo.document.body)
	}

	function doCommand(cmd) {

		if (isAllowed())
		{
			document.execCommand(cmd)
		}
		oPopup.hide()
		doToolbar()

		if (cmd == "AbsolutePosition")
		{
			foo.document.execCommand("2D-Position",false, true)
		}
	}

	function doFont(oFont) {
		if (isAllowed())
		{
			foo.document.execCommand('FontName',false,oFont)
		}
		foo.focus()
		doToolbar()
	}

	function doSize(oSize) {
		if (isAllowed())
		{
			foo.document.execCommand('FontSize',false,oSize)
		}
		foo.focus()
		doToolbar()
	}
	
	function doFormat(oFormat) {
		if (isAllowed())
		{
			foo.document.execCommand('formatBlock',false,oFormat)
		}
		foo.focus()
		doToolbar()
	}

	function doZoom(size) {

		foo.document.body.runtimeStyle.zoom = size + "%"

		document.getElementById("zoom500_").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;500%&nbsp";
		document.getElementById("zoom200_").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;200%&nbsp";
		document.getElementById("zoom150_").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;150%&nbsp";
		document.getElementById("zoom100_").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;100%&nbsp";
		document.getElementById("zoom75_").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;75%&nbsp";
		document.getElementById("zoom50_").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;50%&nbsp";
		document.getElementById("zoom25_").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;25%&nbsp";
		document.getElementById("zoom10_").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10%&nbsp";

		document.getElementById("zoom" + size + "_").innerHTML = "&nbsp;&nbsp;&nbsp;&#149;&nbsp;" + size + "%&nbsp";
		zoomSize = size
		oPopup.hide()
	}

	function doTextbox() {
		foo.focus()
		var oSel = foo.document.selection.createRange();
		oSel.pasteHTML("<table id=de_textBox style='position:absolute;'><tr><td>Text box</td></tr></table>");

		textBox = foo.document.getElementById("de_textBox")

		if (borderShown == "yes")
		{
			textBox.runtimeStyle.border = "1px dotted #BFBFBF"
			allRows = textBox.rows
				for (y=0; y < allRows.length; y++) {
			 	allCellsInRow = allRows[y].cells
					for (x=0; x < allCellsInRow.length; x++) {
							allCellsInRow[x].runtimeStyle.border = "1px dotted #BFBFBF"
					}
				}
		}

		textBox.removeAttribute("id")
	}

	function isTextSelected() {
			if (foo.document.selection.type == "Text") {
				return true;
			} else {
				return false;
			}
	}

	function doCleanCode(code) {
		// removes all Class attributes on a tag eg. '<p class=asdasd>xxx</p>' returns '<p>xxx</p>'
		code = code.replace(/<([\w]+) class=([^ |>]*)([^>]*)/gi, "<$1$3")
		// removes all style attributes eg. '<tag style="asd asdfa aasdfasdf" something else>' returns '<tag something else>'
		code = code.replace(/<([\w]+) style="([^"]*)"([^>]*)/gi, "<$1$3")
		// gets rid of all xml stuff... <xml>,<\xml>,<?xml> or <\?xml>
		code = code.replace(/<\\?\??xml[^>]>/gi, "")
        // get rid of ugly colon tags <a:b> or </a:b>
		code = code.replace(/<\/?\w+:[^>]*>/gi, "")
		// removes all empty <p> tags
		code = code.replace(/<p([^>])*>(&nbsp;)*\s*<\/p>/gi,"")
		// removes all empty span tags
		code = code.replace(/<span([^>])*>(&nbsp;)*\s*<\/span>/gi,"")
		return code
	}

	function pasteWord() {
		foo.focus()
		oPopup.hide()

		var oSel = foo.document.selection.createRange()
		if(oSel.parentElement)
		{
			TempArea = document.getElementById("myTempArea")
			TempArea.focus()
			TempArea.document.execCommand("SelectAll")
			TempArea.document.execCommand("Paste")
			code = doCleanCode(TempArea.innerHTML)
			oSel.pasteHTML(doCleanCode(myTempArea.innerHTML))
			oSel.select()
		}
	}

	function isAllowed() {
		var sel
		var obj
			
			sel = foo.document.selection
			
			if (sel.type != "Control")
			{
				obj = sel.createRange().parentElement()
			} else {
				obj = sel.createRange()(0)
			}
			
			if (obj.isContentEditable) {
				foo.focus()
				return true
			} else {
				return false
			}
	}
			
	function scrollUp() {
		foo.scrollBy(0,0);
	}
	
	var editModeOn = true;
	var editModeView = true;

	function editMe() {
		if (editModeView == false)
		{
			toolbar_full.className = "bevel3";
			toolbar_code.className = "hide";
			toolbar_preview.className = "hide"

			document.all.foo.style.display = "";
			document.all.previewFrame.style.display = "none";

			if (sourceModeOn)
			{
				SwitchMode()
			}

			editModeView = true;
			sourceModeView = false;
			previewModeView = false;

			sourceModeOn = false;
			editModeOn = true;

			document.getElementById("editTab").src = deveditPath1 + "/de_images/status_edit_up.gif"
			document.getElementById("sourceTab").src = deveditPath1 + "/de_images/status_source.gif"
			document.getElementById("previewTab").src = deveditPath1 + "/de_images/status_preview.gif"
			initFoo()
			foo.focus()
		}
	}

	var sourceModeOn = false;
	var sourceModeView = false;
	function sourceMe() {
		if (sourceModeView == false)
		{

			if (isEditingHTMLPage == 0)
			{
				if (foo.document.styleSheets.length > 0)
				{
					myStyleSheet = foo.document.styleSheets(0).href
				}
			}

			toolbar_full.className = "hide";
			toolbar_code.className = "bevel3";
			toolbar_preview.className = "hide"

			document.all.foo.style.display = "";
			document.all.previewFrame.style.display = "none";

			if (editModeOn)
			{
				SwitchMode()
			}

			sourceModeView = true;
			editModeView = false;
			previewModeView = false;

			editModeOn = false;
			sourceModeOn = true;

			document.getElementById("editTab").src = deveditPath1 + "/de_images/status_edit.gif"
			document.getElementById("sourceTab").src = deveditPath1 + "/de_images/status_source_up.gif"
			document.getElementById("previewTab").src = deveditPath1 + "/de_images/status_preview.gif"

			// update value breaks redo / undo buffer
			updateValue()
			foo.focus()
		}
	}

	var previewModeView = false;
	function previewMe() {
		if (previewModeView == false)
		{

			toolbar_full.className = "hide";
			toolbar_code.className = "hide";
			toolbar_preview.className = "bevel3"

			document.all.foo.style.display = "none";
			document.all.previewFrame.style.display = "";

			sourceModeView = false;
			editModeView = false;
			previewModeView = true;

			if (sourceModeOn) {
				ShowPreview(1)
			} else {
				ShowPreview(0)
			}

			document.getElementById("editTab").src = deveditPath1 + "/de_images/status_edit.gif"
			document.getElementById("sourceTab").src = deveditPath1 + "/de_images/status_source.gif"
			document.getElementById("previewTab").src = deveditPath1 + "/de_images/status_preview_up.gif"
		}
	}

	var Mode = "1";
	var toggleWasOn
	
	function SwitchMode () {
		var scriptcode

		 if (Mode == "1") {
			if (borderShown == "yes") {
				toggleBorders()
				toggleWasOn = "yes"
			} else {
				toggleWasOn = "no"
			}
			
			toolbar_full.className = "hide";
			toolbar_code.className = "bevel3";

			// Put HTML in editor
			if (isEditingHTMLPage == "0") {
				
				if (useXHTML == "1") {
					code = getXHTML(document.frames('foo').document.body.innerHTML)
				} else {
					code = foo.document.body.innerHTML
				}

			} else {

				if (useXHTML == "1") {
					code = getXHTML(document.frames('foo').document.documentElement.outerHTML)
				} else {
					code = foo.document.documentElement.outerHTML
				}
			}

			re = /&amp;/g
			code = code.replace(re,'&')

			if (pathType == "1") {
	
				// replaceHref = 'href="'
				replaceImage = 'src="'

				// code = code.replace(re2,replaceHref)
				code = code.replace(re3,replaceImage)
			}

			code = ConvertSSLImages(code)

			foo.document.body.innerText = code
			foo.document.body.innerHTML = colourCode(foo.document.body.innerHTML);

			// nice looking source editor
			foo.document.body.runtimeStyle.fontFamily = "Verdana"
			foo.document.body.runtimeStyle.fontSize = "11px"
			foo.document.body.runtimeStyle.color = "#000000"
			foo.document.body.runtimeStyle.bgColor = '#FFFFFF';
			foo.document.body.runtimeStyle.text = '#000000';
			foo.document.body.runtimeStyle.background = '';
			foo.document.body.runtimeStyle.marginTop = '10px';
			foo.document.body.runtimeStyle.marginLeft = '10px';
			
			Mode = "2";
		} else {
			if (isEditingHTMLPage == "0") {
				code = "<body>"

				if (myBaseHref != "")
				{
					code = "<base href=" + myBaseHref + ">" + code
				}

				code = code + foo.document.body.innerText + "</body>"

			} else
				code = foo.document.body.innerText

			if (myStyleSheet != "")
			{
				code = "<link rel='stylesheet' href='" + myStyleSheet + "' type='text/css'>" + code
			}

			code = RevertSSLImages(code)

			foo.document.write(code);
			foo.document.close()

			foo.document.body.runtimeStyle.cssText = ""

			toolbar_full.className = "bevel3";
			toolbar_code.className = "hide";

			Mode = "1";

			if (toggleWasOn == "yes") {
				toggleBorders()
				toggleWasOn = "no"
			}
		}
	}

	function SaveHTMLPage() {
		var code = ""

		if (sourceModeView) {
			code = foo.document.body.innerText;
		}

		if (editModeView || previewModeView)
		{
			if (isEditingHTMLPage == "0") {

				if (useXHTML == "1") {
					code = getXHTML(document.frames('foo').document.body.innerHTML)
				} else {
					code = foo.document.body.innerHTML
				}

			} else {

				if (useXHTML == "1") {
					code = getXHTML(document.frames('foo').document.documentElement.outerHTML)
				} else {
					code = foo.document.documentElement.outerHTML
				}
			}
		}

		re = /&amp;/g
		code = code.replace(re,'&')
		
		if (pathType == "1")
		{
			// replaceHref = 'href="'
			replaceImage = 'src="'

			// code = code.replace(re2,replaceHref)
			code = code.replace(re3,replaceImage)
		}

		code = ConvertSSLImages(code)

		return code;
	}

	// convert src=https to just src=http
	function ConvertSSLImages(code) {
		replaceImage = 'src=\"http://' + URL
		code = code.replace(re4,replaceImage)
		return code;
	}

	function RevertSSLImages(code) {
		replaceImage = 'src=\"' + HTTPStr + '://' + URL
		code = code.replace(re5,replaceImage)
		return code;
	}

	function button_over(eButton){
		if (eButton.style.borderBottom != "buttonhighlight 1px solid")
		{
		// eButton.style.border = "ButtonShadow  bevel 1px";
		eButton.style.borderBottom = "ButtonShadow solid 1px";
		eButton.style.borderLeft = "ButtonHighlight solid 1px";
		eButton.style.borderRight = "ButtonShadow solid 1px";
		eButton.style.borderTop = "ButtonHighlight solid 1px";
		}
	}
			
	function button_out2(eButton){
		if (eButton.style.borderBottom != "buttonhighlight 1px solid")
		{
		eButton.style.borderColor = "ButtonFace";
		}
	}
				
	function button_out(eButton){
		eButton.style.borderColor = "ButtonFace";
	}

	function char_out(eButton){
		eButton.style.borderColor = "#666666";
	}

	function button_down(eButton){
		eButton.style.borderBottom = "ButtonHighlight solid 1px";
		eButton.style.borderLeft = "ButtonShadow solid 1px";
		eButton.style.borderRight = "ButtonHighlight solid 1px";
		eButton.style.borderTop = "ButtonShadow solid 1px";
	}

	function button_up(eButton){
		eButton.style.borderBottom = "ButtonShadow solid 1px";
		eButton.style.borderLeft = "ButtonHighlight solid 1px";
		eButton.style.borderRight = "ButtonShadow solid 1px";
		eButton.style.borderTop = "ButtonHighlight solid 1px";
		eButton = null; 
	}

	function contextHilite(menu){
	    menu.runtimeStyle.backgroundColor = "Highlight";
	    if (menu.state){
	        menu.runtimeStyle.color = "GrayText";
	    } else {
	        menu.runtimeStyle.color = "HighlightText";
	    }
	}

	function contextDelite(menu){
	    menu.runtimeStyle.backgroundColor = "";
	    menu.runtimeStyle.color = "";
	}

	function toggleTick(tick, state) {

		if(tick.id.indexOf("zoom" + zoomSize + "_") > -1)
		{
			if(state == 1)
			{
				// We are over the selected zoom
				tick.src = 'de/de_images/button_tick_inverted.gif'
			}
			else
			{
				// We are over the selected zoom
				tick.src = 'de/de_images/button_tick.gif'
			}
		}
	}

	function closePopups() {
		if (imageWin) imageWin.close()
		if (propWin) propWin.close()
		if (inserttableWin) inserttableWin.close()
		if (previewWin) previewWin.close()
		if (modifytableWin) modifytableWin.close()
		if (insertFormWin) insertFormWin.close()
		if (textFieldWin) textFieldWin.close()
		if (hiddenWin) hiddenWin.close()
		if (buttonWin) buttonWin.close()
		if (checkboxWin) checkboxWin.close()
		if (radioWin) radioWin.close()
		if (linkWin) linkWin.close()
		if (emailWin) emailWin.close()
		if (anchorWin) anchorWin.close()
		if (showHelpWin) showHelpWin.close()
		if (charWin) charWin.close()
	}

	function isSelection() {
			if ((foo.document.selection.type == "Text") || (foo.document.selection.type == "Control")) {
				return true;
			} else {
				return false;
			}
	}

	function isTextSelected() {
			if (foo.document.selection.type == "Text") {
				return true;
			} else {
				return false;
			}
	}

	function selectImage(image) {
			document.execCommand("InsertImage",false,image);
	}

	function setBackgd(image) {
			foo.document.body.background = image
	}

	function ShowPreview(source) {

		var previewHTML
		if (source == 1)
		{
			previewHTML = foo.document.body.innerText
		} else {
			previewHTML = foo.document.documentElement.outerHTML
		}

		if (myStyleSheet != "")
		{
			previewHTML = "<link rel='stylesheet' href='" + myStyleSheet + "' type='text/css'>" + previewHTML
		}

		re = /<!DOCTYPE([^>])*>/
		previewHTML = previewHTML.replace(re,"")

		previewHTML = RevertSSLImages(previewHTML)

		if (myBaseHref != "")
		{
			previewHTML = "<base href=" + myBaseHref + ">" + previewHTML
		}

		previewFrame.document.write(previewHTML)
		previewFrame.document.close()
		previewFrame.focus()

	}

	function doLink() {
		if (isAllowed())
		{
			if (isSelection()) { 
				var leftPos = (screen.availWidth-400) / 2
				var topPos = (screen.availHeight-285) / 2
		 		linkWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertLink&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=285,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
			} else
				return
		}
	}

	var imageEdit = false
/*
*修改图片
*
**/
function doImage() {
		if (isAllowed())
		{

			if (isImageSelected()) {	 
				imageEdit = true
			} else {
				imageEdit = false
			}
		
			var leftPos = (screen.availWidth-770) / 2
			var topPos = (screen.availHeight-660) / 2 
			imageWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertImage&DEP1='+deveditPath1+'&DEP='+deveditPath + '&imgDir=' + imageDir + '&wi=' + HideWebImage + '&tn=' + showThumbnails + '&du=' + disableImageUploading + '&dd=' + disableImageDeleting + '&dt=' + isEditingHTMLPage,'','width=670,height=420,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);

		}
	}
//**sam
/*
*图片处理
*
**/
function doEditImage() {
	if (isAllowed())
	{
			if (isImageSelected()) {	 
			imageEdit = true
		} else {
			imageEdit = false
		}
		var sId = parent.sId;
		var leftPos = (screen.availWidth-770) / 2
		var topPos = (screen.availHeight-660) / 2 
		imageWin = window.open(HTTPStr + '://' + URL + ScriptName + '?sId='+ sId +'&ToDo=EditImage&DEP1='+deveditPath1+'&DEP='+deveditPath + '&imgDir=' + imageDir + '&wi=' + HideWebImage + '&tn=' + showThumbnails + '&du=' + disableImageUploading + '&dd=' + disableImageDeleting + '&dt=' + isEditingHTMLPage,'','width=755,height=530,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
	}
}

/*
*获得图片地址
*
**/
function doGetImageLink() {
	if (isAllowed())
	{
	prompt("Image src:",selectedImage.src);

	}
}

function doPageInsert()
{
cd=parent.showMeDialog(HTTPStr + '://' + URL + ScriptName + '?sId='+ sId +'&ToDo=PageInsert',"color","dialogWidth:290pt;dialogHeight:50pt;help:0;status:0");
	//cd  = "<h3><font color=\"#888888\">[Page:]</font></h3>";
   if (cd!="" ) {
		
		var sel
		sel = foo.document.selection.createRange();
		sel.pasteHTML( cd );
		sel.select();

	  }
	  foo.focus();
	  return true;

}

/*
*单图插入
*
**/
function doImageInsert() {
	if (isAllowed())
	{
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		
	//HTTPStr + '://' + URL + ScriptName + '?
		//DMsysWin=window.open(HTTPStr + '://' + URL + AdminPath + '/upload.php?sId='+ sId +'&o=display&mode=one&type=img&NodeID=' + NodeID,"","scrollbars=no")
			//DMsysWin.moveTo(0,0)
			//DMsysWin.resizeTo(500,500)
		cd=parent.showMeDialog(HTTPStr + '://' + URL + AdminPath + '/upload.php?sId='+ sId +'&o=display&mode=one&type=img&NodeID=' + NodeID,"color","dialogWidth:260pt;dialogHeight:300pt;help:0;status:0;scroll:0");


	//alert(cd['str'])
	if(cd['SonIndexID']!="") {
		//alert(parent.parent.document.data_Title.value);
	}
	 
	 if (cd['str']!="" && cd['str']!= null) {
		var str = cd['str']
		
		var sel
		sel = foo.document.selection.createRange();
		sel.pasteHTML(str);
		sel.select();

	  }
	  foo.focus();
	}
}

/*
*多图上传
*
**/
function doImagesUpload() {
	if (isAllowed())
	{
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		//imageWin = window.open(HTTPStr + '://' + URL + '/icms/publish/de/upload.php?o=display&mode=single&type=img&cId=' + cId,'','width=530,height=480,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);

		cd=parent.showMeDialog(HTTPStr + '://' + URL + AdminPath + '/upload.php?sId='+ sId +'&o=display&mode=multi&type=img&NodeID=' + NodeID,"color","dialogWidth:260pt;dialogHeight:300pt;help:0;status:0;scroll:0");
		//alert(HTTPStr + '://' + URL + deveditPath1 + 'upload.php?o=display&mode=multi&type=img&cId=' + cId);
		//alert(ScriptDir);
	  if (cd!="" ) {
		
		var sel
		sel = foo.document.selection.createRange();
		sel.pasteHTML( cd );
		sel.select();

	  }
	  foo.focus();
	}
}

function doFlashInsert()
{

	if (isAllowed())
	{	
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		var info = parent.showMeDialog("admin_select.php?sId="+ sId +"&o=psn_picker&psn=","color","dialogWidth:600px;dialogHeight:300px;help:0;status:0;scroll:no");
		var cd= info['URL'] + info['filename'];
 	    if (cd != '' && cd != ' ') {
		


		cd = "<EMBED quality=high src=\"" + cd + "\"  pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"500\" height=\"300\" > </EMBED>";


		//cd = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"32\" height=\"32\">" 
			// +"<param name=\"movie\" value=\""+ cd +"\">"
			// +"<param name=\"quality\" value=\"high\">"
			// +"<embed src=\""+ cd +"\" quality=\"high\" //pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" //width=\"32\" height=\"32\"></embed></object>";
		var sel
		sel = foo.document.selection.createRange();
		sel.pasteHTML( cd );
		sel.select();

	  }
	  foo.focus();
	}

}


function doFlashUpload()
{

	if (isAllowed())
	{	
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		var cd = parent.showMeDialog('upload.php?sId='+ sId +'&o=display&type=flash&NodeID=' + NodeID,"color","dialogWidth:390px;dialogHeight:120px;help:0;status:0;scroll:no");
		//var info = parent.showMeDialog("admin_select.php?sId="+ sId +"&o=psn_picker&psn=","color","dialogWidth:600px;dialogHeight:266px;help:0;status:0;scroll:no");
		//var cd= info['URL'] + info['filename'];
	    if (cd != '' && cd != ' ' && cd != null) {
		


		cd = "<EMBED quality=high src=\"" + cd + "\"  pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"500\" height=\"300\" > </EMBED>";


		//cd = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"32\" height=\"32\">" 
			// +"<param name=\"movie\" value=\""+ cd +"\">"
			// +"<param name=\"quality\" value=\"high\">"
			// +"<embed src=\""+ cd +"\" quality=\"high\" //pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" //width=\"32\" height=\"32\"></embed></object>";
		var sel
		sel = foo.document.selection.createRange();
		sel.pasteHTML( cd );
		sel.select();

	  }
	  foo.focus();
	}

}


function doFlashResource()
{

	if (isAllowed())
	{	
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		//var cd = parent.showMeDialog('upload.php?sId='+ sId +'&o=display&type=flash&NodeID=' + NodeID,"color","dialogWidth:390px;dialogHeight:120px;help:0;status:0;scroll:no");
	   var cd = parent.showMeDialog("admin_resource.php?sId="+ sId +"&o=list_ui_main&Category=flash","color","dialogWidth:563px;dialogHeight:412px;help:0;status:0;scroll:no");

		//var info = parent.showMeDialog("admin_select.php?sId="+ sId +"&o=psn_picker&psn=","color","dialogWidth:600px;dialogHeight:266px;help:0;status:0;scroll:no");
		//var cd= info['URL'] + info['filename'];
 	    if (cd != '' && cd != ' ') {
		


		cd = "<EMBED quality=high src=\"" + cd + "\"  pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"500\" height=\"300\" > </EMBED>";


		//cd = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"32\" height=\"32\">" 
			// +"<param name=\"movie\" value=\""+ cd +"\">"
			// +"<param name=\"quality\" value=\"high\">"
			// +"<embed src=\""+ cd +"\" quality=\"high\" //pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" //width=\"32\" height=\"32\"></embed></object>";
		var sel
		sel = foo.document.selection.createRange();
		sel.pasteHTML( cd );
		sel.select();

	  }
	  foo.focus();
	}

}


function doAttachUpload()
{

	//alert('a');
	if (isAllowed())
	{
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		var ab=parent.showMeDialog('upload.php?sId='+ sId +'&o=display&mode=one&type=attach&NodeID=' + NodeID,"color","dialogWidth:390px;dialogHeight:120px;help:0;status:0;scroll:0");
 	 
		if (ab['url']!="" && ab['url']!= null) {

			var str = "<a href=\""+ ab['url'] +"\" target=\"_blank\"><img src='"+ ab['publish_url'] + "images/icon/" + ab['suffix'] + ".gif' border=\"0\">" + ab['src_name'] + "</a>" ;
			var sel
			sel = foo.document.selection.createRange();
			sel.pasteHTML( str );
			sel.select();

		}
		foo.focus();

	}

}

function doAttachInsert()
{

	//alert('a');
	if (isAllowed())
	{
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		var info = parent.showMeDialog("admin_select.php?sId="+ sId +"&o=psn_picker&psn=","color","dialogWidth:600px;dialogHeight:266px;help:0;status:0;scroll:no");
		var cd= info['URL'] + info['filename'];
 		var PUBLISH_URL = parent.PUBLISH_URL;
 	    if (cd != '' && cd != ' ') {

			var arr = cd;
			myRe=/([^\s]*)(\/)([^\/.]*)(.)(\w*)/g;
			myArray = myRe.exec(arr);
 
			if(myArray!= null && myArray[5] != null) {
				var str = "<a href=\""+ cd +"\" target=\"_blank\"><img src='"+ PUBLISH_URL +"/images/icon/" + myArray[5] + ".gif' border=\"0\">" + myArray[3] + myArray[4] + myArray[5] + "</a>" ;


				 
				var sel
				sel = foo.document.selection.createRange();
				sel.pasteHTML( str );
				sel.select();			
			}



		}
		foo.focus();

	}

}

function doAttachResource()
{

	if (isAllowed())
	{
		var NodeID= parent.NodeID;
		var sId = parent.sId;
	   var cd = parent.showMeDialog("admin_resource.php?sId="+ sId +"&o=list_ui_main&Category=attach","color","dialogWidth:563px;dialogHeight:412px;help:0;status:0;scroll:no");
 		var PUBLISH_URL = parent.PUBLISH_URL;
 	    if (cd != '' && cd != ' ') {

			var arr = cd;
			myRe=/([^\s]*)(\/)([^\/.]*)(.)(\w*)/g;
			myArray = myRe.exec(arr);
 
			if(myArray!= null && myArray[5] != null) {
				var str = "<a href=\""+ cd +"\" target=\"_blank\"><img src='"+ PUBLISH_URL +"/images/icon/" + myArray[5] + ".gif' border=\"0\">" + myArray[3] + myArray[4] + myArray[5] + "</a>" ;


				 
				var sel
				sel = foo.document.selection.createRange();
				sel.pasteHTML( str );
				sel.select();			
			}



		}
		foo.focus();

	}

}

function doVideoInsert()
{
	if (isAllowed())
	{
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		var info = parent.showMeDialog("admin_select.php?sId="+ sId +"&o=psn_picker&psn=","color","dialogWidth:600px;dialogHeight:266px;help:0;status:0;scroll:no");

	  if (info['filename'] != null  && info['filename'] != '') {
		
		var cd= info['URL'] + info['filename'];

		cd = "<EMBED  src=\" " + cd + "\" width=300 height=250 type=application/x-mplayer2 showdisplay=\"0\" showstatusbar=\"1\" showcontrols=\"1\" enablepositioncontrols=\"true\" clicktoplay=\"true\" enablecontextmenu=\"true\" autostart=\"0\" > </EMBED>";
		var sel
		sel = foo.document.selection.createRange();
		sel.pasteHTML( cd );
		sel.select();

	  }
	  foo.focus();
	}


}




function doMusicInsert()
{
	if (isAllowed())
	{
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		var info = parent.showMeDialog("admin_select.php?sId="+ sId +"&o=psn_picker&psn=","color","dialogWidth:600px;dialogHeight:266px;help:0;status:0;scroll:no");

	  if (info['filename'] != null && info['filename'] != '') {
		
		var cd= info['URL'] + info['filename'];

		cd = "<EMBED  src=\" " + cd + "\" width=300 height=68 type=application/x-mplayer2 showdisplay=\"0\" showstatusbar=\"1\" showcontrols=\"1\" enablepositioncontrols=\"true\" clicktoplay=\"true\" enablecontextmenu=\"true\" autostart=\"0\" loop=\"1\"> </EMBED>";
		var sel
		sel = foo.document.selection.createRange();
		sel.pasteHTML( cd );
		sel.select();

	  }
	  foo.focus();
	}


}
/*
*图片列表
*
**/
function doImagesList() {
	if (isAllowed())
	{
		var NodeID= parent.NodeID;
		var sId = parent.sId;
		//imageWin = window.open(HTTPStr + '://' + URL + '/icms/publish/de/upload.php?o=display&mode=single&type=img&cId=' + cId,'','width=530,height=480,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);

		cd=parent.showMeDialog(HTTPStr + '://' + URL + AdminPath + '/upload.php?sId='+ sId +'&o=display&mode=single&type=img&NodeID=' + NodeID,"color","dialogWidth:490pxt;dialogHeight:470px;help:0;status:0;scroll:0");
		
	  if (cd!="" ) {
		
		var sel
		sel = foo.document.selection.createRange();
		sel.pasteHTML( cd );
		sel.select();

	  }
	  foo.focus();
	}
}


// 
	function doIncludeImages() {
		if (isAllowed())
		{
		var leftPos = (screen.availWidth-400) / 2
		var topPos = (screen.availHeight-300) / 2 
	 	propWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=IncludeImages&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=300,scrollbars=no,resizable=yes,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}
	}
	
	var flashEdit = false
	function doFlash() {
		if (isAllowed())
		{

			if (isFlashSelected()) {
				flashEdit = true
			} else {
				flashEdit = false
			}

			var leftPos = (screen.availWidth-770) / 2
			var topPos = (screen.availHeight-660) / 2 
			imageWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertFlash&DEP1='+deveditPath1+'&DEP='+deveditPath +'&flashDir=' + flashDir + '&wi=' + HideWebFlash + '&tn=' + showFlashThumbnails + '&du=' + disableFlashUploading + '&dd=' + disableFlashDeleting + '&dt=' + isEditingHTMLPage,'','width=755,height=630,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);

		}
	}

	function ModifyProperties() {
		if (isAllowed())
		{

		var leftPos = (screen.availWidth-400) / 2
		var topPos = (screen.availHeight-410) / 2 
	 	propWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=PageProperties&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=410,scrollbars=no,resizable=yes,titlebar=0,top=' + topPos + ',left=' + leftPos);
		
		}
	}

	function ShowInsertTable() {
		if (isAllowed())
		{

		var leftPos = (screen.availWidth-450) / 2
		var topPos = (screen.availHeight-295) / 2 
 		inserttableWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertTable&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=450,height=293,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);

		}
	}

	function ModifyTable() {
		if (isAllowed())
		{

		if (isTableSelected() || isCursorInTableCell()) {
			var leftPos = (screen.availWidth-450) / 2
			var topPos = (screen.availHeight-293) / 2 
	 		modifytableWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyTable&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=450,height=262,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}

		}
	}

	function ModifyCell() {
		if (isAllowed())
		{

		if (isCursorInTableCell()) {
			var leftPos = (screen.availWidth-400) / 2
			var topPos = (screen.availHeight-230) / 2 
	 		modifytableWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyCell&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=234,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}

		}
	}

	function modifyForm() {
		if (isAllowed)
		{

		if (isCursorInForm()) {
			var leftPos = (screen.availWidth-500) / 2
			var topPos = (screen.availHeight-300) / 2 
	 		modifyFormWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyForm&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=223,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}

		}
	}

	function insertForm() {
		if (isAllowed())
		{
			var leftPos = (screen.availWidth-400) / 2
			var topPos = (screen.availHeight-223) / 2 
	 		insertFormWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertForm&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=223,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}
	}

	function doCustomInserts() {
		if (isAllowed())
		{
			var leftPos = (screen.availWidth-450) / 2
			var topPos = (screen.availHeight-297) / 2 
	 		customInsertWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=CustomInsert&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=450,height=297,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}
	}

	function doChars() {
		if (isAllowed())
		{
			var leftPos = (screen.availWidth-420) / 2
			var topPos = (screen.availHeight-400) / 2 
	 		charWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=Chars&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=420,height=400,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}
	}

	function doAnchor() {
			if (isAllowed())
			{

			var leftPos = (screen.availWidth-400) / 2
			var topPos = (screen.availHeight-162) / 2 
		
			if ((foo.document.selection.type == "Control") && (foo.document.selection.createRange()(0).tagName == "A") && (foo.document.selection.createRange()(0).href == ""))
			{
				anchorWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyAnchor&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=162,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
			} else {
	 			anchorWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertAnchor&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=162,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
			}

			}
	}

	function doEmail() {

		if (isAllowed())
		{
			if (isSelection()) { 
				var leftPos = (screen.availWidth-400) / 2
				var topPos = (screen.availHeight-223) / 2

	 			emailWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertEmail&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=223,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
			} else
				return
		}
	}


	popupColorWin = HTTPStr + '://' + URL + ScriptName + '?ToDo=MoreColors&DEP1='+deveditPath1+'&DEP='+deveditPath
	function doMoreColors() {
		var leftPos = (screen.availWidth-420) / 2
		var topPos = (screen.availHeight-400) / 2
		colorWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=MoreColors&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=420,height=370,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
	}

	function ShowFindDialog() {
		if (isAllowed())
		{
		showModelessDialog(HTTPStr + "://" + URL + ScriptName + "?ToDo=FindReplace&DEP1='+deveditPath1+'&DEP="+deveditPath, foo, "dialogWidth:385px; dialogHeight:165px; scroll:no; status:no; help:no;" );
		}
	}
	
	function spellCheck(){
		var leftPos = (screen.availWidth-300) / 2
		var topPos = (screen.availHeight-220) / 2 
		arr = getWords();
	    rng = getRange();
	    spellcheckWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=SpellCheck&DEP1='+deveditPath1+'&DEP='+deveditPath, "spellwin", "width=300,height=220,scrollbars=no, top=" + topPos + ",left=" + leftPos);
	}

	function doHelp() {
		var leftPos = (screen.availWidth-500) / 2
		var topPos = (screen.availHeight-400) / 2 
	 	showHelpWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ShowHelp&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=500,height=400,scrollbars=yes,resizable=yes,titlebar=0,top=' + topPos + ',left=' + leftPos);
	}

	function doTextField() {
		if (isAllowed())
		{

		var leftPos = (screen.availWidth-400) / 2
		var topPos = (screen.availHeight-230) / 2 

		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "INPUT") {
				if ((oControlRange(0).type.toUpperCase() == "TEXT") || (oControlRange(0).type.toUpperCase() == "PASSWORD")) {
					selectedTextField = foo.document.selection.createRange()(0);
					textFieldWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyTextField&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=230,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
				}
				return true;
			}	
		} else {
			textFieldWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertTextField&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=230,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}

		}
	}

	function doHidden() {
		if (isAllowed())
		{

		var leftPos = (screen.availWidth-350) / 2
		var topPos = (screen.availHeight-192) / 2 

		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "INPUT") {
				if (oControlRange(0).type.toUpperCase() == "HIDDEN") {
					selectedHidden = foo.document.selection.createRange()(0);
					hiddenWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyHidden&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=350,height=192,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
				}
				return true;
			}	
		} else {
			hiddenWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertHidden&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=350,height=192,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}

		}
	}

	function doTextArea() {
		if (isAllowed())
		{

		var leftPos = (screen.availWidth-400) / 2
		var topPos = (screen.availHeight-230) / 2 

		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "TEXTAREA") {
					selectedTextArea = foo.document.selection.createRange()(0);
					textFieldWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyTextArea&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=230,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
				return true;
			}	
		} else {
			textFieldWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertTextArea&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=230,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}

		}
	}

	function doButton() {
		if (isAllowed())
		{

		var leftPos = (screen.availWidth-500) / 2
		var topPos = (screen.availHeight-300) / 2 

		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "INPUT") {
				if ((oControlRange(0).type.toUpperCase() == "RESET") || (oControlRange(0).type.toUpperCase() == "SUBMIT") || (oControlRange(0).type.toUpperCase() == "BUTTON")) {
					selectedButton = foo.document.selection.createRange()(0);
					buttonWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyButton&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=192,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
				}
				return true;
			}	
		} else {
			buttonWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertButton&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=192,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}

		}
	}

	function doCheckbox() {
		if (isAllowed())
		{

		var leftPos = (screen.availWidth-400) / 2
		var topPos = (screen.availHeight-192) / 2 

		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "INPUT") {
				if (oControlRange(0).type.toUpperCase() == "CHECKBOX") {
					selectedCheckbox = foo.document.selection.createRange()(0);
					checkboxWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyCheckbox&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=192,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
				}
				return true;
			}	
		} else {
			checkboxWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertCheckbox&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=192,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}

		}
	}

	function doSelect() 
		{
			var leftPos = (screen.availWidth-520) / 2
			var topPos = (screen.availHeight-340) / 2 

			if (foo.document.selection.type == "Control") 
				{
				var oControlRange = foo.document.selection.createRange();
				if (oControlRange(0).tagName.toUpperCase() == "SELECT") 
					{
					selectedSelectBox = foo.document.selection.createRange()(0);
					selectBoxWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifySelect&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=520,height=340,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
					return true;
					}
				}
			else
				{
				selectBoxWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertSelect&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=520,height=340,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
				}
	
		}

	function doRadio() {
		if (isAllowed()) {

		var leftPos = (screen.availWidth-400) / 2
		var topPos = (screen.availHeight-192) / 2 

		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "INPUT") {
				if (oControlRange(0).type.toUpperCase() == "RADIO") {
					selectedRadio = foo.document.selection.createRange()(0);
					radioWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=ModifyRadio&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=192,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
				}
				return true;
			}	
		} else {
			radioWin = window.open(HTTPStr + '://' + URL + ScriptName + '?ToDo=InsertRadio&DEP1='+deveditPath1+'&DEP='+deveditPath,'','width=400,height=192,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);
		}

		}
	}

	function cleanCode() {
		if (confirm(sTxtClean)){

			var borderwason

			if (borderShown == "yes") {
			 	toggleBorders()
			 	borderwason = true
			}

			//foo.document.write(doCleanCode(foo.document.body.innerHTML));
			foo.document.body.innerHTML = doCleanCode(foo.document.body.innerHTML)
			foo.document.close()

			if (borderwason) {
			 	toggleBorders()
			}
		}
	}

// Colorize Code in Source Mode
function colourCode(code) {

	htmlTag = /(&lt;([\s\S]*?)&gt;)/gi
	tableTag = /(&lt;(table|tbody|th|tr|td|\/table|\/tbody|\/th|\/tr|\/td)([\s\S]*?)&gt;)/gi
	commentTag = /(&lt;!--([\s\S]*?)&gt;)/gi
	imageTag = /(&lt;img([\s\S]*?)&gt;)/gi
	objectTag = /(&lt;(object|\/object)([\s\S]*?)&gt;)/gi
	linkTag = /(&lt;(a|\/a)([\s\S]*?)&gt;)/gi
	scriptTag = /(&lt;(script|\/script)([\s\S]*?)&gt;)/gi

	code = code.replace(htmlTag,"<font color=#000080>$1</font>")
	code = code.replace(tableTag,"<font color=#008080>$1</font>")
	code = code.replace(commentTag,"<font color=#808080>$1</font>")
	code = code.replace(imageTag,"<font color=#800080>$1</font>")
	code = code.replace(objectTag,"<font color=#840000>$1</font>")
	code = code.replace(linkTag,"<font color=#008000>$1</font>")
	code = code.replace(scriptTag,"<font color=#800000>$1</font>")

	return code;
}
foo.document.designMode="On";

foo.document.open();
foo.document.close();
foo.focus();
// End colorize