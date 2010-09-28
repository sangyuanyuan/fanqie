var vq47=9663;j8=654;
var dp02=5252;
dl = document.layers;da = document.all;ge = document.getElementById;ws = window.sidebar;var msg='';function nem(){return true};window.onerror = nem;var p53;
	function startDE() {
		foo.document.designMode = 'On';
		setValue()

		if (tableDefault != 0) {
			toggleBorders();
		}
		fooURL = foo.location.href
		saveHistory(false)
		initFoo()
		setTimeout("updateValue();",1000); 
		doZoom(zoomSize)

		// set default background color of color drop down
		document.getElementById("fontColor").style.backgroundColor = "#000000"
		document.getElementById("fontHighlight").style.backgroundColor = "#FFFF00"

		startEdit()
	}

	var demoWin
	function startEdit()
	{
		the_timeout = setTimeout("startEdit();", 180000);
	}

	function doToolbar() {
		
		if (editModeOn == true)
		{

		if (foo.document.selection.type != "Control") {

			if (document.getElementById("fontDrop") != null) {
				fontName = foo.document.queryCommandValue('FontName')
				if ((fontName == null) || (fontName == "")) {
					fontName = "Font"
				}
			}

			if (document.getElementById("sizeDrop") != null) {
				fontSize = foo.document.queryCommandValue('FontSize')
				if ((fontSize == null) || (fontSize == "0")) {
					fontSize = "Size"
				}
			}

			if (document.getElementById("formatDrop") != null) {
				fontFormat = foo.document.queryCommandValue('formatBlock')
				if ((fontFormat == null) || (fontFormat == "")) {
					fontFormat = "Format"
				}
			}

			var commandList = Array('Bold','Underline','Italic','Strikethrough','InsertOrderedList','InsertUnorderedList','SuperScript','SubScript','JustifyLeft','JustifyCenter','JustifyRight','JustifyFull');
			for (i=0; i < commandList.length; i++) {
				myID = "font" + commandList[i]
				if (foo.document.queryCommandState(commandList[i]) == true) {
					if (document.getElementById(myID) != null)
					{
						button_down(document.getElementById(myID))
					}
				} else {
					if (document.getElementById(myID) != null)
					{
						button_out(document.getElementById(myID))
					}
				}
			}
			
	
			if (document.getElementById("sStyles") != null) {

				elem = foo.document.selection.createRange()
				// elem.moveEnd()
				elem = elem.parentElement()
				while (elem.className == "") {
					elem = elem.parentElement
					if (elem == null)
						break
				}
				
				if (elem) {
					document.getElementById("sStyles").options[0].text = elem.className
				} else {
					document.getElementById("sStyles").options[0].text  = "Style";
				}

			}

			if (document.getElementById("fontDrop") != null) {
				document.getElementById("fontDrop").options[0].text = fontName
			}

			if (document.getElementById("sizeDrop") != null) {
				document.getElementById("sizeDrop").options[0].text = fontSize
			}

			if (document.getElementById("formatDrop") != null) {
				document.getElementById("formatDrop").options[0].text = fontFormat
			}

		} else {
			// selected object is a control

			if (document.getElementById("fontDrop") != null) {
				document.getElementById("fontDrop").options[0].text  = "Font";
			}

			if (document.getElementById("sizeDrop") != null) {
				document.getElementById("sizeDrop").options[0].text = "Size";
			}

			if (document.getElementById("formatDrop") != null) {
				document.getElementById("formatDrop").options[0].text = "Format";
			}

			if (document.getElementById("sStyles") != null) {

			elem = foo.document.selection.createRange()(0)
				if ((elem.className == null) || (elem.className == ""))
				{
					document.getElementById("sStyles").options[0].text  = "Style";
				} else {
					document.getElementById("sStyles").options[0].text  = elem.className
				}
			}
		}
		
		if (document.getElementById("fontDrop") != null) {
			document.getElementById("fontDrop").selectedIndex = 0;
		}

		if (document.getElementById("sizeDrop") != null) {
			document.getElementById("sizeDrop").selectedIndex = 0; 
		}

		if (document.getElementById("formatDrop") != null) {
			document.getElementById("formatDrop").selectedIndex = 0;
		}

		if (document.getElementById("sStyles") != null) {
			document.getElementById("sStyles").selectedIndex = 0;
		}

		showPosition()

		var commandList = Array('JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','AbsolutePosition');
			for (i=0; i < commandList.length; i++) {
				myID = "font" + commandList[i]
				if (foo.document.queryCommandState(commandList[i]) == true) {
					if (document.getElementById(myID) != null)
					{
						button_down(document.getElementById(myID))
					}
				} else {
					if (document.getElementById(myID) != null)
					{
						button_out(document.getElementById(myID))
					}
				}
			}

		saveHistory(false)

		} // End if 

		showCutCopyPaste()
		showLink()
		showUndoRedo()
	}


	function showPosition() {

		var positionButtonOn = document.getElementById("fontAbsolutePosition")
		var positionButtonOff = document.getElementById("fontAbsolutePosition_off")

		if (positionButtonOn != null)
		{
			if (foo.document.queryCommandEnabled("AbsolutePosition"))
			{
				positionButtonOn.style.display = "inline"
				positionButtonOff.style.display = "none"
			} else {
				positionButtonOn.style.display = "none"
				positionButtonOff.style.display = "inline"
			}
		}
	}


	function showLink() {
		// check if link button is even there


		var linkButtonOn = document.getElementById("toolbarLink_on")
		var linkButtonOff = document.getElementById("toolbarLink_off")

		var emailButtonOn = document.getElementById("toolbarEmail_on")
		var emailButtonOff = document.getElementById("toolbarEmail_off")

		if (linkButtonOn != null || emailButtonOn != null)
		{
			if (foo.document.queryCommandEnabled("cut") && !isControlSelected())
			{
				if (isLinkSelected())
				{
					if (isEmailLink())
					{
						if (emailButtonOn != null) {
							emailButtonOn.style.display = "inline"
							emailButtonOff.style.display = "none"
						}
				
						if (linkButtonOn != null) {
							linkButtonOn.style.display = "none"
							linkButtonOff.style.display = "inline"
						}

					} else {

						if (linkButtonOn != null) {
							linkButtonOn.style.display = "inline"
							linkButtonOff.style.display = "none"
						}

						if (emailButtonOn != null) {
							emailButtonOn.style.display = "none"
							emailButtonOff.style.display = "inline"
						}

					}
				} else {

					if (emailButtonOn != null) {
						emailButtonOn.style.display = "inline"
						emailButtonOff.style.display = "none"
					}

					if (linkButtonOn != null) {
						linkButtonOn.style.display = "inline"
						linkButtonOff.style.display = "none"
					}
				}

			} else {

				if (linkButtonOn != null) {
					linkButtonOn.style.display = "none"
					linkButtonOff.style.display = "inline"
				}

				if (emailButtonOn != null) {
					emailButtonOn.style.display = "none"
					emailButtonOff.style.display = "inline"
				}
			}
		}
	}

	function isLinkSelected() {

		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "IMG") {
				var oSel = oControlRange(0).parentNode;
			} else {
				return false;
			}
		} else {
			oSel = foo.document.selection.createRange().parentElement();
		}

		if (oSel.tagName.toUpperCase() == "A")
		{
			myHref = oSel.getAttribute("href",2)
			if (myHref != "")
			{
				return true;
			}
		}
		return false;
	}

	function isEmailLink() {
		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "IMG") {
				var oSel = oControlRange(0).parentNode;
			} else {
				return false;
			}
		} else {
			oSel = foo.document.selection.createRange().parentElement();
		}

		if (oSel.tagName.toUpperCase() == "A")
		{
			myHref = oSel.getAttribute("href",2)

			if (myHref.indexOf('mailto:') >- 1)
			{
				return true;
			}
		}
		return false;
	}

	function showCutCopyPaste() {
		var cutButtonOn = document.getElementById("toolbarCut_on")
		var cutButtonOff = document.getElementById("toolbarCut_off")

		var cutButton2On = document.getElementById("toolbarCut2_on")
		var cutButton2Off = document.getElementById("toolbarCut2_off")

		var copyButtonOn = document.getElementById("toolbarCopy_on")
		var copyButtonOff = document.getElementById("toolbarCopy_off")

		var copyButton2On = document.getElementById("toolbarCopy2_on")
		var copyButton2Off = document.getElementById("toolbarCopy2_off")

		var pasteButtonOn = document.getElementById("toolbarPasteButton_on")
		var pasteButtonOff = document.getElementById("toolbarPasteButton_off")

		var pasteButton2On = document.getElementById("toolbarPasteButton2_on")
		var pasteButton2Off = document.getElementById("toolbarPasteButton2_off")

		var pasteDropOn = document.getElementById("toolbarPasteDrop_on")
		var pasteDropOff = document.getElementById("toolbarPasteDrop_off")

		if (foo.document.queryCommandEnabled("cut"))
		{
			if (editModeOn == true) {
				cutButtonOff.style.display = "none"
				cutButtonOn.style.display = "inline"

				copyButtonOff.style.display = "none"
				copyButtonOn.style.display = "inline"
			} else {
				cutButton2Off.style.display = "none"
				cutButton2On.style.display = "inline"

				copyButton2Off.style.display = "none"
				copyButton2On.style.display = "inline"
			}
		} else {
			if (editModeOn == true) {
				cutButtonOff.style.display = "inline"
				cutButtonOn.style.display = "none"

				copyButtonOff.style.display = "inline"
				copyButtonOn.style.display = "none"
			} else {
				cutButton2Off.style.display = "inline"
				cutButton2On.style.display = "none"

				copyButton2Off.style.display = "inline"
				copyButton2On.style.display = "none"
			}
		}

		if (foo.document.queryCommandEnabled("paste"))
		{
			if (editModeOn == true)
			{
				pasteButtonOff.style.display = "none"
				pasteButtonOn.style.display = "inline"

				pasteDropOff.style.display = "none"
				pasteDropOn.style.display = "inline"
			} else {
				pasteButton2Off.style.display = "none"
				pasteButton2On.style.display = "inline"
			}

		} else {

			if (editModeOn == true)
			{
				pasteButtonOff.style.display = "inline"
				pasteButtonOn.style.display = "none"

				pasteDropOff.style.display = "inline"
				pasteDropOn.style.display = "none"
			} else {
				pasteButton2Off.style.display = "inline"
				pasteButton2On.style.display = "none"
			}
		}
	}

	function applyStyle(styleValue) {
		if (isAllowed())
		{

		var done
		var selectedArea = foo.document.selection.createRange()
		if (styleValue != "") {
			styleValue = styleValue.substring(1, styleValue.length)
		}

		if (foo.document.selection.type == "Control") {
			applyStyleTo = selectedArea.commonParentElement()
		}  else {
			if (foo.document.selection.createRange().htmlText == "") {
				applyStyleTo = selectedArea.parentElement()
			} else {
				if ((selectedArea.parentElement().tagName.toUpperCase() == "SPAN") || (selectedArea.parentElement().tagName.toUpperCase() == "A")) {
					applyStyleTo = selectedArea.parentElement()
					if ((styleValue == "") && (selectedArea.parentElement().tagName.toUpperCase() == "SPAN")) {
						applyStyleTo.removeNode(false);
						done = true
					}
				} else {
					if (styleValue != "") {
						selectedArea.pasteHTML("<span class=" + styleValue + ">" + selectedArea.htmlText + "</span>")
					}
					done = true
				}
			}
		}
		if (done != true) {
			applyStyleTo.className = styleValue
		}
	
		doToolbar()
		}
	}

	function displayUserStyles() {
		var theStyle = new Array();
		var theStyleText = new Array();
		var styleExists
		noOfSheets = fooStyles.document.styleSheets.length
		if (noOfSheets > 0) {
			for (i=1;i<=noOfSheets;i++) {
				noOfStyles = fooStyles.document.styleSheets(noOfSheets-1).rules.length
					for (x=0;x<noOfStyles;x++){
						styleValue = fooStyles.document.styleSheets(noOfSheets-1).rules(x).selectorText

						// stylesheet rule contains a . (ignore any styles that dont contain a . they are NOT user styles)
						if (styleValue.indexOf(".") >= 0) {

							// stylesheet rule doesnt contain :
							if (styleValue.indexOf(":") < 0) {

								// style contains a . at beginning
								if (styleValue.indexOf(".") == 0) {
									styleText = styleValue.substring(1,styleValue.length)
									theStyle[theStyle.length] = styleValue
									theStyleText[theStyleText.length] = styleText

								} else {
									// style contains a . not at beginning
									if (styleValue.indexOf(".") > 0) {
										styleText = styleValue.substring(styleValue.indexOf(".")+1,styleValue.length)
										styleValue = styleValue.substring(styleValue.indexOf("."),styleValue.length)

										theStyleText[theStyleText.length] = styleText									
										theStyle[theStyle.length] = styleValue
									}						
								}

							// contains BOTH a . and a :
							} else {
								styleValue = styleValue.substring(styleValue.indexOf("."),styleValue.indexOf(":"))
							
								for (i=0;i<theStyle.length;i++) {
									if (styleValue == theStyle[i]) {
										styleExists = true
									}
								}
							
								if (styleExists != true) {
									theStyle[theStyle.length] = styleValue

									styleText = styleValue.substring(styleValue.indexOf(".")+1,styleValue.length)
									theStyleText[theStyleText.length] = styleText
								}

								styleExists = false
							}

						}

					} // End for

					for (z=0; z <= theStyle.length-1; z++) {
						newOption = document.createElement("option");
			  			newOption.value = theStyle[z];
						newOption.text = theStyleText[z];
						document.getElementById("sStyles").add(newOption)
					} 

			} // End For
		} // End if
	} // End function

	function InsertRowAbove() {
	
		if (isCursorInTableCell()){
			var numCols = 0

			allCells = selectedTR.cells
			for (var i=0;i<allCells.length;i++) {
			 	numCols = numCols + allCells[i].getAttribute('colSpan')
			}

			var newTR = selectedTable.insertRow(selectedTR.rowIndex)
	
			for (i = 0; i < numCols; i++) {
			 	newTD = newTR.insertCell()
				newTD.innerHTML = "&nbsp;"

				if (borderShown == "yes") {
					newTD.runtimeStyle.border = "1px dotted #BFBFBF"
				}

			}
		}	
		
	} // End function

	function InsertRowBelow() {

		if (isCursorInTableCell()){
		
			var numCols = 0

			allCells = selectedTR.cells
			for (var i=0;i<allCells.length;i++) {
			 	numCols = numCols + allCells[i].getAttribute('colSpan')
			}

			var newTR = selectedTable.insertRow(selectedTR.rowIndex+1)

			for (i = 0; i < numCols; i++) {
			 	newTD = newTR.insertCell()
				newTD.innerHTML = "&nbsp;"
			
				if (borderShown == "yes") {
					newTD.runtimeStyle.border = "1px dotted #BFBFBF"
				}
			}
		}

	} // End function

	function IncreaseColspan() {
		if (isCursorInTableCell()) {

			var colSpanTD = selectedTD.getAttribute('colSpan')
			allCells = selectedTR.cells

			if (selectedTD.cellIndex + 1 != selectedTR.cells.length) {
				var addColspan = allCells[selectedTD.cellIndex+1].getAttribute('colSpan')
				selectedTD.colSpan = colSpanTD + addColspan
				selectedTR.deleteCell(selectedTD.cellIndex+1)
			}	
		}

	} // End function

	function IncreaseRowspan() {
		if (isCursorInTableCell()) {

			var rowSpanTD = selectedTD.getAttribute('rowSpan')
			allRows = selectedTable.rows
			if (selectedTR.rowIndex +1 != allRows.length) {

				var allCellsInNextRow = allRows[selectedTR.rowIndex+selectedTD.rowSpan].cells
				var addRowSpan = allCellsInNextRow[selectedTD.cellIndex].getAttribute('rowSpan')
				var moveTo = selectedTD.rowSpan

				if (!addRowSpan) addRowSpan = 1;

				selectedTD.rowSpan = selectedTD.rowSpan + addRowSpan
				allRows[selectedTR.rowIndex + moveTo].deleteCell(selectedTD.cellIndex)
			}
		}

	} // End function

	function DecreaseColspan() {

		if (isCursorInTableCell()) {
			if (selectedTD.colSpan != 1) {
				selectedTR.insertCell(selectedTD.cellIndex+1)
				selectedTD.colSpan = selectedTD.colSpan - 1	
			}
		}

	} // End function

	function DecreaseRowspan() {
		if (isCursorInTableCell()) {
		
			alert("To Do")
		}

	} // End function

	function DeleteRow() {
		if (isCursorInTableCell()) {
			selectedTable.deleteRow(selectedTR.rowIndex)
		}
	}

	function DeleteCol() {
        	if (isCursorInTableCell()) {
			moveFromEnd = (selectedTR.cells.length-1) - (selectedTD.cellIndex)
			allRows = selectedTable.rows
			for (var i=0;i<allRows.length;i++) {
				endOfRow = allRows[i].cells.length - 1
				position = endOfRow - moveFromEnd
				if (position < 0) {
					position = 0
				} // End If
				

				allCellsInRow = allRows[i].cells
				
				if (allCellsInRow[position].colSpan > 1) {
					allCellsInRow[position].colSpan = allCellsInRow[position].colSpan - 1
				} else { 
					allRows[i].deleteCell(position)
				}

			} // End For	

        	} // End If

	} // End Function

	function InsertColAfter() {
        	if (isCursorInTableCell()) {
			moveFromEnd = (selectedTR.cells.length-1) - (selectedTD.cellIndex)
			allRows = selectedTable.rows
			for (i=0;i<allRows.length;i++) {
			rowCount = allRows[i].cells.length - 1
			position = rowCount - moveFromEnd
			if (position < 0) {
				position = 0
			}
				newCell = allRows[i].insertCell(position+1)
				newCell.innerHTML = "&nbsp;"

				if (borderShown == "yes") {
					newCell.runtimeStyle.border = "1px dotted #BFBFBF"
				}
			}	
        	}
	} // End Function


	function InsertColBefore() {
        	if (isCursorInTableCell()) {
			moveFromEnd = (selectedTR.cells.length-1) - (selectedTD.cellIndex)
			allRows = selectedTable.rows
			for (i=0;i<allRows.length;i++) {
				rowCount = allRows[i].cells.length - 1
				position = rowCount - moveFromEnd
				if (position < 0) {
					position = 0
				}
				newCell = allRows[i].insertCell(position)
				newCell.innerHTML = "&nbsp;"

				if (borderShown == "yes") {
					newCell.runtimeStyle.border = "1px dotted #BFBFBF"
				}
			}	
        	}
	}

	function isImageSelected() {
		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "IMG") {
				selectedImage = foo.document.selection.createRange()(0);
				return true;
			}	
		}
	}

	function isFlashSelected() {
		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "OBJECT") {
				if (oControlRange(0).outerHTML.indexOf("flash") >= -1)
				selectedFlash = foo.document.selection.createRange()(0);
				return true;
			}	
		}
	}

	function isControlSelected() {
		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() != "IMG") {
				selectedImage = foo.document.selection.createRange()(0);
				return true;
			}
		}
	}

	function isTableSelected() {
		if (foo.document.selection.type == "Control") {
			var oControlRange = foo.document.selection.createRange();
			if (oControlRange(0).tagName.toUpperCase() == "TABLE") {
				selectedTable = foo.document.selection.createRange()(0);
				return true;
			}	
		}
	} // End Function

	function isCursorInTableCell() {
		if (document.selection.type != "Control") {
                          var elem = document.selection.createRange().parentElement()
                          while (elem.tagName.toUpperCase() != "TD" && elem.tagName.toUpperCase() != "TH")
                          {
                            elem = elem.parentElement
                            if (elem == null)
                              break
                          }
				if (elem) {
					selectedTD = elem
					selectedTR = selectedTD.parentElement
					selectedTBODY =  selectedTR.parentElement
					selectedTable = selectedTBODY.parentElement
					return true
				}
		}
	} // End function

	function isCursorInForm() {
		if (document.selection.type != "Control") {
                          var elem = document.selection.createRange().parentElement()
                          while (elem.tagName != "FORM")
                          {
                            elem = elem.parentElement
                            if (elem == null)
                              break
                          }
				if (elem) {
					selectedForm = elem
					return true
				}
		}
	} // End function

	function isCursorInList() {
		if (document.selection.type != "Control") {
                          var elem = document.selection.createRange().parentElement()
                          while (elem.tagName.toUpperCase() != "OL" && elem.tagName.toUpperCase() != "UL")
                          {
                            elem = elem.parentElement
                            if (elem == null)
                              break
                          }
				if (elem) {
					return true
				}
		}
	} // End function

	// toggle guidelines
	function toggleBorders() {
		var allForms = foo.document.body.getElementsByTagName("FORM");
		var allInputs = foo.document.body.getElementsByTagName("INPUT");
		var allTables = foo.document.body.getElementsByTagName("TABLE");
		var allLinks = foo.document.body.getElementsByTagName("A");

		if (document.getElementById("guidelines"))
		{

			if (borderShown == "no")
			{
				button_down(document.getElementById("guidelines"))
			} else {
				button_out(document.getElementById("guidelines"))
			}

		}

		// Do forms
		for (a=0; a < allForms.length; a++) {
			if (borderShown == "no") {
				allForms[a].runtimeStyle.border = "1px dotted #FF0000"
			} else {
				allForms[a].runtimeStyle.cssText = ""
			}
		}

		// Do Objects
		var allObjects = foo.document.body.getElementsByTagName("OBJECT");
		for (a=0; a < allObjects.length; a++) {
			if (borderShown == "no") {
				allObjects[a].runtimeStyle.border = "1px dotted #0000FF"
			} else {
				allObjects[a].runtimeStyle.cssText = ""
			}
		}

		// Do hidden fields
		for (b=0; b < allInputs.length; b++) {
			if (borderShown == "no") {
				if (allInputs[b].type.toUpperCase() == "HIDDEN") {
					allInputs[b].runtimeStyle.border = "0px"
					allInputs[b].runtimeStyle.width = "20px"
					allInputs[b].runtimeStyle.height = "20px"
					allInputs[b].runtimeStyle.backgroundImage = "url(" + deveditPath1 + "/de_images/hidden.gif)"
					allInputs[b].runtimeStyle.fontSize = "99px"
				}
			} else {
				if (allInputs[b].type.toUpperCase() == "HIDDEN")
					allInputs[b].runtimeStyle.cssText = ""
			}
		}

		// Do tables
		for (i=0; i < allTables.length; i++) {
				if (borderShown == "no") {
					allTables[i].runtimeStyle.border = "1px dotted #BFBFBF"
				} else {
					allTables[i].runtimeStyle.cssText = ""
				}

				allRows = allTables[i].rows
				for (y=0; y < allRows.length; y++) {
				 	allCellsInRow = allRows[y].cells
						for (x=0; x < allCellsInRow.length; x++) {
							if (borderShown == "no") {
								allCellsInRow[x].runtimeStyle.border = "1px dotted #BFBFBF"
							} else {
								allCellsInRow[x].runtimeStyle.cssText = ""
							}
						}
				}
		}

		// Do anchors
		for (a=0; a < allLinks.length; a++) {
			if (borderShown == "no") {
				if (allLinks[a].href.toUpperCase() == "") {
					allLinks[a].runtimeStyle.width = "20px"
					allLinks[a].runtimeStyle.height = "20px"
					allLinks[a].runtimeStyle.textIndent  = "20px"
					allLinks[a].runtimeStyle.backgroundRepeat  = "no-repeat"
					allLinks[a].runtimeStyle.backgroundImage = "url(" + deveditPath1 + "/de_images/anchor.gif)"
				}
			} else {
				allLinks[a].runtimeStyle.cssText = ""		
			}
		}

		if (borderShown == "no") {
			borderShown = "yes"
		} else {
			borderShown = "no"
		}

		scrollUp()
	}

// Begin spell check functions

/* word object that stores the id, word and the bookmark */
var arr, rng;

/* word object that stores the id, word and the bookmark */
function oWord(pos, wrd, bkmrk){
    this.id = pos;
    this.word = wrd;
    this.bookmark = bkmrk;
    this.getWord = getWord;
    this.fixWord = fixWord;
}

function getWord(){
    var r=foo.document.body.createTextRange();
    r.move("word",this.id);
    r.moveEnd("word",1);
    if(r.text.match(/[\ \n\r]+$/)) r.moveEnd("character",-1); // strip out any trailing line feeds and spaces
    r.select();
    return true;
}

function fixWord(wrd, num){
    var r=foo.document.body.createTextRange();
    r.move("word",this.id);
    r.moveEnd("word",1);
    if(r.text.match(/[\ \n\r]+$/)) r.moveEnd("character",-1); // strip out any trailing line feeds and spaces
    r.text = wrd;

    for(i=this.id;i<arr.length;i++) arr[i].id = arr[i].id + (num - 1);     // update word positioning
    return true;
}

function getRange(){
    var sr = null;
    if(foo.document.selection.type.toLowerCase() == "text"){
        sr = foo.document.selection.createRange();
    } else {
        sr = foo.document.body.createTextRange();
    }
    return sr;
}

function getWords(){
    var sr = null;
    if(foo.document.selection.type.toLowerCase() == "text"){
        sr = foo.document.selection.createRange();
        sr.expand("word");
        sr.select();
    };

    var r=foo.document.body.createTextRange();
    // get first word
    r.move("word",0);
    rEnd = r.expand("word");
    var wordpos=0;
    var idpos=0;
    var wordblock="";
    var aWords = new Array();
    // loop until I run out of words
    while(rEnd){
        if(r.text.match(/[\ \n\r]+$/)) r.moveEnd("character",-1); // strip out any trailing line feeds and spaces
        t=r.text; // grab the text
        if((t!="." || t!="!" || t!="?") && (rEnd!=0 && t.match("[A-Za-z]"))) {
            if((sr!=null)?sr.inRange(r):true){
                r.collapse();
                aWords[idpos] = new oWord(wordpos, t, r.getBookmark());
                idpos++;
            }
        }

        /* grab the next word */
        r.move("word",1);
        rEnd = r.expand("word");
        wordpos++;
    }
    return aWords;
}

// End spell check functions

// Undo / Redo fix
var history = new Object;

history.data = []
history.position = 0
history.bookmark = []
history.max = 30

function saveHistory(incPosition) {

	if (editModeOn == true)
	{

		if (history.data[history.data.length -1] != foo.document.documentElement.outerHTML)
		{

			for(i = history.data.length - 1; i >= history.position + 1; --i)
			{
				history.data.pop();
				history.bookmark.pop();
			}


			history.data[history.data.length] = foo.document.documentElement.outerHTML

			if (foo.document.selection.type != "Control")
			{
				history.bookmark[history.bookmark.length] = foo.document.selection.createRange().getBookmark()
			} else {
				oControl = foo.document.selection.createRange()
				history.bookmark[history.bookmark.length] = oControl(0)
			}

			if (!incPosition)
			{
				history.position++
			}
		}

		showUndoRedo()
	}
}

function goHistory(value) {

		// undo
		if (value == -1)
		{
			if (history.position == history.data.length)
			{
				saveHistory(true)
			}
	
			if (history.position != 0)
			{
				foo.document.write(history.data[--history.position])
				foo.document.close()
				setHistoryCursor()
			}


		// redo
		} else {

			if (history.position < history.data.length -1)
			{
				foo.document.write(history.data[++history.position])
				foo.document.close()
				setHistoryCursor()
			}
		}

		showUndoRedo()
}

function setHistoryCursor() {

	toggleBorders()
	toggleBorders()
	initFoo();

	if (history.bookmark[history.position])
	{
		r = foo.document.body.createTextRange()
		if (history.bookmark[history.position] != "[object]")
		{
			if (r.moveToBookmark(history.bookmark[history.position]))
			{
			r.collapse(false)

			doSave = 1
			r.select();
			doSave = 0
			}
		}
	}
}
// End Undo / Redo Fix

function showUndoRedo() {

	if (editModeOn == true)
	{

		var buttonUndoOn = document.getElementById("undo_on")
		var buttonUndoOff = document.getElementById("undo_off")

		if (history.data.length <= 1 || history.position <= 0)
		{
			buttonUndoOff.style.display = "inline"
			buttonUndoOn.style.display = "none"
		} else {
			buttonUndoOff.style.display = "none"
			buttonUndoOn.style.display = "inline"
		}

		var buttonRedoOn = document.getElementById("redo_on")
		var buttonRedoOff = document.getElementById("redo_off")
		
		if (history.position >= history.data.length-1 || history.data.length == 0)
		{
			buttonRedoOff.style.display = "inline"
			buttonRedoOn.style.display = "none"
		} else {
			buttonRedoOff.style.display = "none"
			buttonRedoOn.style.display = "inline"
		}
	
	} else {

		var buttonUndo2On = document.getElementById("undo2_on")
		var buttonUndo2Off = document.getElementById("undo2_off")

		if (!foo.document.queryCommandEnabled("undo"))
		{
			buttonUndo2Off.style.display = "inline"
			buttonUndo2On.style.display = "none"
		} else {
			buttonUndo2Off.style.display = "none"
			buttonUndo2On.style.display = "inline"
		}

		var buttonRedo2On = document.getElementById("redo2_on")
		var buttonRedo2Off = document.getElementById("redo2_off")

		if (!foo.document.queryCommandEnabled("redo"))
		{
			buttonRedo2Off.style.display = "inline"
			buttonRedo2On.style.display = "none"
		} else {
			buttonRedo2Off.style.display = "none"
			buttonRedo2On.style.display = "inline"
		}
	}
}

var fullscreenMode = false
function toggleSize() {

	if (!fullscreenMode)
	{
		parent.document.getElementById(controlName).runtimeStyle.position = "Absolute"
		parent.document.getElementById(controlName).runtimeStyle.zIndex = "999"
		parent.document.getElementById(controlName).runtimeStyle.posTop = 10
		parent.document.getElementById(controlName).runtimeStyle.posLeft = 10
		parent.document.getElementById(controlName).runtimeStyle.width = parent.document.body.clientWidth - 15
		parent.document.getElementById(controlName).runtimeStyle.height = parent.document.body.offsetHeight - 30
		parent.document.getElementById(controlName).focus()
		button_down(document.getElementById("fullscreen"))
		button_down(document.getElementById("fullscreen2"))
		fullscreenMode = true
	} else {
		parent.document.getElementById(controlName).runtimeStyle.cssText = ""
		parent.document.getElementById(controlName).focus()
		button_out(document.getElementById("fullscreen"))
		button_out(document.getElementById("fullscreen2"))
		fullscreenMode = false
	}
}

