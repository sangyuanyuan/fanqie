<script language=JavaScript>
var myPage = window.opener;
window.opener.doStyles()
window.onload = setValues;

var selectName = myPage.selectedSelectBox.name;
var selectValue = myPage.selectedSelectBox.innerHTML;
var selectClass = myPage.selectedSelectBox.className;
var selectSize = myPage.selectedSelectBox.size;
var selectType = myPage.selectedSelectBox.type;

function printStyleList() {
	if (window.opener.document.getElementById("sStyles") != null) {
		document.write(window.opener.document.getElementById("sStyles").outerHTML);
		document.getElementById("sStyles").className = "text70";
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

function setValues() {

	if (selectClass != "") {
		textClass = " class=" + textClass
	}

	//textForm.tmpSelect.innerHTML = selectValue;
	textForm.selectbox_name.value = selectName;
	textForm.selectSize.value = selectSize;
	//alert(selectType);
	selectType == "select-one" ? textForm.selectType.options[0].selected = true : textForm.selectType.options[1].selected = true
	this.focus();
}

var error
function InsertSelectBox() 
	{
	
	var sel = window.opener.document.selection;
	if (sel!=null) 
		{
		var rng = sel.createRange();
	   	if (rng!=null) 
			{
			name = document.textForm.selectbox_name.value
			tmpOptions = "";
			for (i=0; i < optionArray.length; ++i)
				{
				optionArray[i][2] == true ? itemSelected = " selected" : itemSelected = ""
				tmpOptions = tmpOptions + "<option value=\"" + optionArray[i][1] + "\"" + itemSelected + ">" + optionArray[i][0] + "</option>";
				}
			//alert(tmpOptions);
			styles = document.textForm.sStyles[textForm.sStyles.selectedIndex].text
			multiple = document.textForm.selectType.selectedIndex;
			size = document.textForm.selectSize.value;
			error = 0
	
			if (error != 1) 
				{
				name != "" ? name = ' name="' + name + '"' : name = ""
				multiple == 1 ? multiple = " multiple " : multiple = ""
				styles != "" ? styles = " class=" + styles : styles = ""
				size != 0 ? size = "size=" + size : size = ""
				HTMLSelectBox = "<select" + name + styles + multiple + size + ">" + tmpOptions + "</select>"	
				// window.opener.foo.focus();
				myPage.selectedSelectBox.outerHTML = HTMLSelectBox
       			//rng.pasteHTML(HTMLSelectBox)
			} // End if
		} // End if
	} // End If

	if (error != 1) {
		self.close();
	}
} // End function

document.onkeydown = function () { 
	if (event.keyCode == 13) {	// ENTER
		InsertSelectBox()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		InsertSelectBox()
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
<title>[sTxtModifySelect]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=textForm>
<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtModifySelectInst]</span>
</div>
<br>
	  
<script>
	optionArray = new Array();
	for (i=0; i < myPage.selectedSelectBox.options.length; ++i)
		{optionArray[optionArray.length] = new Array(myPage.selectedSelectBox.options[i].text, myPage.selectedSelectBox.options[i].value, myPage.selectedSelectBox.options[i].getAttribute("selected"));}
	
	function addOption(textObj,valueObj,selectObj)
		{
		if (textObj.value.replace(/[ ]/g,"") != "")
			{selectObj.options[selectObj.length] = new Option(textObj.value,valueObj.value);}
		}
	
	function editOption(optionObj,formObj)
		{
		formObj.optionText.value = optionObj[optionObj.selectedIndex].text;
		formObj.optionValue.value = optionObj[optionObj.selectedIndex].value;
		optionTag = optionObj[optionObj.selectedIndex].outerHTML.replace(optionObj[optionObj.selectedIndex].text,"");
		formObj.optionSelected.checked = optionArray[optionObj.selectedIndex][2];
		//alert(optionObj[optionObj.selectedIndex].outerHTML);
		formObj.formUpdate.disabled = false;
		formObj.removeOption.disabled = false;
		}
		
	function updateOption(textTextObj,textValueObj,selectObj)
		{
		selectObj.options[selectObj.selectedIndex].text = textTextObj.value;
		selectObj.options[selectObj.selectedIndex].value = textValueObj.value;
		selectObj.options[selectObj.options.length] = new Option();
		selectObj.options[selectObj.options.length - 1].selected = true;
		selectObj.options[selectObj.options.length - 1] = null;
		selectObj.form.removeOption.disabled = true;
		}
	
	function deleteOption(selectObj, formObj)
		{
		selectObj.options[selectObj.selectedIndex] = null;
		clearForm(formObj);
		}
		
	
	function doOption(formObj, currentAction)
		{
		if (currentAction.indexOf("add") == 0)
			{
			addOption(formObj.optionText, formObj.optionValue,formObj.tmpSelect);
			optionArray[optionArray.length] = new Array(formObj.optionText.value, formObj.optionValue.value, formObj.optionSelected.checked);
			formObj.optionText.focus();
			clearForm(formObj);
			}
		else if (currentAction.indexOf("update") == 0)
			{
			thisItem = formObj.tmpSelect.selectedIndex;
			updateOption(formObj.optionText, formObj.optionValue,formObj.tmpSelect);
			optionArray[thisItem] = new Array(formObj.optionText.value, formObj.optionValue.value, formObj.optionSelected.checked);
			clearForm(formObj);
			}
		else if (currentAction.indexOf("remove") == 0)
			{
			optionArray.splice(formObj.tmpSelect.selectedIndex,1)
			deleteOption(formObj.tmpSelect);
			clearForm(formObj);
			}
		else
			{}	
		}

	function doOption(formObj, currentAction)
		{
		if (currentAction.indexOf("add") == 0)
			{
			addOption(formObj.optionText, formObj.optionValue,formObj.tmpSelect);
			optionArray[optionArray.length] = new Array(formObj.optionText.value, formObj.optionValue.value, formObj.optionSelected.checked);
			formObj.optionText.focus();
			clearForm(formObj);
			}
		else if (currentAction.indexOf("update") == 0)
			{
			thisItem = formObj.tmpSelect.selectedIndex;
			updateOption(formObj.optionText, formObj.optionValue,formObj.tmpSelect);
			optionArray[thisItem] = new Array(formObj.optionText.value, formObj.optionValue.value, formObj.optionSelected.checked);
			clearForm(formObj);
			}
		else if (currentAction.indexOf("remove") == 0)
			{
			optionArray.splice(formObj.tmpSelect.selectedIndex,1)
			deleteOption(formObj.tmpSelect);
			clearForm(formObj);
			}
		else
			{}	
		}

	function doSize(selectObj, formObj) {
		if (selectObj.selectedIndex == 1)
			formObj.selectSize.disabled = false
		else
			formObj.selectSize.disabled = true
	}
	
	function clearForm(formObj)
		{
		formObj.optionText.value = "";
		formObj.optionValue.value = "";
		// formObj.formAction.value = "Add Option";
		formObj.optionSelected.checked = false;
		formObj.tmpSelect.selectedIndex = -1;
		formObj.formUpdate.disabled = true;
		formObj.removeOption.disabled = true;
		}
</script>	  

<table border="0" cellspacing="0" cellpadding="5" style="width:92%">
  <tr>
	<td class="body" width="85">[sTxtName]:</td>
	<td class="body" width="160"><input type="text" name="selectbox_name" size="20" class="Text150" maxlength="50"></td>
	<td>&nbsp;</td>
	<td class="body" width="85" colspan="2">[sTxtMaintainOptions]:</td>
  </tr>
  <tr><!--- Current Options --->
	<td class="body" valign="top">[sTxtCurrentOptions]:</td>
	<td class="body"><select name="tmpSelect" size="5" onchange="editOption(this, this.form);"  class=text150><script>document.write(selectValue)</script></select></td>
	<td>&nbsp;</td>
	<!--- Add / Mod Options --->
	<td class="body" valign="top" colspan="2" valign="top"rowspan=2>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td class="body" nowrap>[sTxtText]:</td>
				<td><input type="text" name="optionText" size="15" class="Text70"></td>
			</tr>
			<tr>
				<td class="body" nowrap>[sTxtValue]:</td>
				<td><input type="text" name="optionValue" size="15" class="Text70"></td>
			</tr>
			<tr>
				<td class="body" nowrap>[sTxtSelected]:</td>
				<td><input type="Checkbox" name="optionSelected"></td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td align="right"><input name="formAction" type="Button" value="[sTxtAdd]" onclick="doOption(this.form, 'add');" class=text75>&nbsp;&nbsp;</td>
				<td><input name="formUpdate" type="Button" value="[sTxtUpdate]" onclick="doOption(this.form, 'update');" class=text75 disabled>&nbsp;&nbsp;<input name="removeOption" type="Button" onclick="deleteOption(this.form.tmpSelect, this.form);" value="[sTxtDelete]" class=text75 disabled></td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
  	<td class="body">[sTxtType]:</td>
	<td><select class="Text150" name="selectType" onchange="doSize(this, this.form);"><option value="">[sTxtSingle]</option><option value="multiple">[sTxtMultiple]</option></select></td>
	<td>&nbsp;</td>
  </tr>
  <tr>
  	<td class="body">[sTxtSize]:</td>
	<td><input type="Text" class="text150" name="selectSize"></td>
	<td>&nbsp;</td>
	<td colspan="2">&nbsp;</td>
  </tr>
  <tr>
  	<td class="body">[sTxtStyle]:</td>
	<td><script>printStyleList()</script></td>
	<td>&nbsp;</td>
	<td colspan="2">&nbsp;</td>
  </tr>
</table>


</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertSelectbox" value="[sTxtOK]" class="Text75" onClick="javascript:InsertSelectBox();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>
<script>
selectObj = document.textForm.tmpSelect;
selectObj.options[selectObj.options.length] = new Option();
selectObj.options[selectObj.options.length - 1].selected = true;
selectObj.options[selectObj.options.length - 1] = null;
</script>