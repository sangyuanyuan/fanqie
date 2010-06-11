<?php   
if(!defined('IN_IWPC')) {
 	exit('Access Denied');
}
include_once(INCLUDE_PATH."editor/class.devedit.php");
require_once LANG_PATH.$SYS_ENV['language'].'/lang_skin/admin/contribution_editor.php';
?>
<html>
<head>
<title></title>
<link type="text/css" rel="StyleSheet" href="../html/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 CHARSET;?>">
</head>
<script src="ui.php?sId=<?=$IN['sId']?>&o=functions.js" type="text/javascript" language="javascript"></script>
<SCRIPT language=JavaScript>
var NodeID = '<?=$IN[NodeID]?>';
var sId = '<?=$IN['sId']?>';
</script>
<body bgcolor=threedface STYLE="margin:0pt;padding:0pt;border: 1px buttonhighlight;">
<form action="admin_contribution.php?sId=<?=$IN['sId']?>&o=<?=$IN['o']?>_submit&NodeID=<?=$IN['NodeID']?>&ContributionID=<?=$pInfo['ContributionID']?>" method="post" name="FM" ><!--actionFrame-->
<table width="100%" border=0   cellPadding=0 cellSpacing=5 >
<tr class='tablelist'> 
              <td align=right width=75><?echo $_LANG_SKIN['OwnerName']; ?>:</td>
              <td ><?=$pInfo[OwnerName]?></td>
</tr>

<tr class='tablelist'> 
              <td align=right width=75><?echo $_LANG_SKIN['TargetNodeID']; ?>:</td>
              <td ><select  name="TargetNodeID" id = "TargetNodeID">
<?php
foreach($NODE_LIST as $key=>$var) {
	if($pInfo[NodeID] == $var[NodeID]) {
		echo "<option value='{$var[NodeID]}' selected>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";
	
	} elseif($IN[o] == 'add' && $CateInfo[NodeID] ==  $var[NodeID]) {
		echo "<option value='{$var[NodeID]}' selected>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";
	
	} else {
		echo "<option value='{$var[NodeID]}'>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";	
	}
}

 ?>
 </select></td>
</tr>
<tr class='tablelist'> 
              <td align=right ><?echo $_LANG_SKIN['SubTargetNodeID']; ?>:</td>
              <td>

<table>
			<tr>
			<td><?echo $_LANG_SKIN['SubTargetSubNodeID']; ?>:</td>
			<td><?echo $_LANG_SKIN['SubTargetIndexNodeID']; ?>:</td>
			</tr>
			<tr>
			<td>
<select  name="SubTargetNodeID[]" id = "SubTargetNodeID"  size="10" multiple>
<option value='' ><?echo $_LANG_SKIN['null']; ?></option>
<?php
foreach($NODE_LIST as $key=>$var) {
	if(in_array($var[NodeID], $pInfo[SubNodeIDs])) {
		echo "<option value='{$var[NodeID]}' selected>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";
	
	} elseif($IN[o] == 'add' && in_array($var[NodeID], $CateInfo[SubNodeIDs])) {
		echo "<option value='{$var[NodeID]}' selected>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";
	
	} else {
		echo "<option value='{$var[NodeID]}'>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";	
	}
}

 ?>
 </select>			  


</td>
			<td> 




 <select  name="IndexTargetNodeID[]" id = "IndexTargetNodeID"  size="10" multiple>
<option value='' ><?echo $_LANG_SKIN['null']; ?></option>
<?php
foreach($NODE_LIST as $key=>$var) {
	if(in_array($var[NodeID], $pInfo[IndexNodeIDs])) {
		echo "<option value='{$var[NodeID]}' selected>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";
	
	} elseif($IN[o] == 'add' && in_array($var[NodeID], $CateInfo[IndexNodeIDs])) {
		echo "<option value='{$var[NodeID]}' selected>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";
	
	} else {
		echo "<option value='{$var[NodeID]}'>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $var[cHeader])." - &nbsp;{$var[Name]}</option>";	
	}
}

 ?>
 </select>			  

</td>
			</tr>
			</table>


			  
			  </td>
</tr>

<?php
//--------------------------------------------------------
foreach( $tableInfo as $key=>$var) {
	if(empty($var['EnableContribution'])) continue;
	echo " <tr class='tablelist'> 
              <td align=right width=70>{$var[FieldTitle]}:</td>
              <td >";

	if($var[FieldInput] == 'text') { //单行文本
		echo "<input name='data_{$var[FieldName]}' type='text' value='{$pInfo[$var['FieldName']]}' size=80%>";

		if(!empty($var[selectValue])) {
				echo "&nbsp;&nbsp;&nbsp;&nbsp;<select name='{$var[FieldName_select]}'  onchange=\"if(this.options[this.selectedIndex].value != '') { this.form.data_{$var[FieldName]}.value= this.options[this.selectedIndex].value;}\"> 				<option value=''>可选值:</option>";

				foreach($var[selectValue] as $var) {
					echo "<option value='$var'>$var</option>";			
				}
				echo "</select>";
		
		}

	} elseif($var[FieldInput] == 'textaera') { //多行文本

		echo "<textarea name='data_{$var[FieldName]}' class='button' id='{$var[FieldName]}' style='height:70;width=80%;overflow:auto; background-color:#FFFFFF;scrollbar-face-color: #FFFFFF;scrollbar-highlight-color: #FFFFFF;scrollbar-shadow-color: #cccccc;scrollbar-3dlight-color: #cccccc;scrollbar-arrow-color:  #cccccc;scrollbar-track-color: #FFFFFF;scrollbar-darkshadow-color: #cccccc;' >{$pInfo[$var['FieldName']]}</textarea>";

	} elseif($var[FieldInput] == 'checkbox') { //多选
		foreach($var[selectValue] as $key=>$var) {
			if(strpos('hll'.$pInfo[$var['FieldName']], $var)) {
				echo "<input type='checkbox' name='data_{$var[FieldName]}[]' value='{$var}' id='{$var[FieldName]}_{$key}' checked ><label for='{$var[FieldName]}_{$key}'>{$var}</label>";
			
			} else {
				echo "<input type='checkbox' name='data_{$var[FieldName]}[]' value='{$var}' id='{$var[FieldName]}_{$key}' ><label for='{$var[FieldName]}_{$key}'  >{$var}</label> ";
			
			}
		}
	} elseif($var[FieldInput] == 'radio') { //单选
		foreach($var[selectValue] as $key=>$var) {

			if($pInfo[$var['FieldName']] == $var) {
				echo "<input type='checkbox' name='data_{$var[FieldName]}[]' value='{$var}' id='{$var[FieldName]}_{$key}' checked ><label for='{$var[FieldName]}_{$key}'>{$var}</label>";
			
			} else {
				echo "<input type='checkbox' name='data_{$var[FieldName]}[]' value='{$var}' id='{$var[FieldName]}_{$key}' ><label for='{$var[FieldName]}_{$key}'  >{$var}</label> ";
			
			}
		}

	} elseif($var[FieldInput] == 'select') { //下拉菜单选择
		echo "<select name='data_{$var[FieldName]}'>";

		foreach($var[selectValue] as $keyIn=>$varIn) {
			if($pInfo[$var['FieldName']] == $varIn) {
				echo "<option value='{$varIn}' selected>{$varIn}</option>";
			} else {
				echo "<option value='{$varIn}'>{$varIn}</option>";
			}
		
		}

		echo "</select>";

	} elseif($var[FieldInput] == 'password') { //密码
		echo "<input name='data_{$var[FieldName]}' type='password' >";

	} elseif($var[FieldInput] == 'RichEditor') { //可视化编辑器
	$LibType = true;
	// Create a new DevEdit class object
	$myDE = new devedit;
	
	$myDE->Libtype=$LibType;
	
	// Set the name of this DevEdit class
	$myDE->SetName("data_{$var[FieldName]}");

	// Set the path to the de folder
	SetDevEditPath(INCLUDE_PATH."editor");
	$a = pathinfo($_SERVER["PHP_SELF"]);
	$myDE->AdminPath = $a[dirname];
	$myDE->sId = $IN['sId'];
 	// Set the path to the folder that contains the flash files for the flash manager
	//$myDE->SetFlashPath("/icms/site_image/$parent/flash");

	// These are the functions that you can call to hide varions buttons,
	// lists and tab buttons. By default, everything is enabled

	//$myDE->HideFullScreenButton();		//隐藏全屏按钮
	//$myDE->HideBoldButton();		隐藏粗体按钮
	//$myDE->HideUnderlineButton();		隐藏下划线按钮
	//$myDE->HideItalicButton();		隐藏斜体按钮
	//$myDE->HideStrikethroughButton();
	//$myDE->HideNumberListButton();
	//$myDE->HideBulletListButton();
	//$myDE->HideDecreaseIndentButton();
	//$myDE->HideIncreaseIndentButton();
	//$myDE->HideLeftAlignButton();
	//$myDE->HideCenterAlignButton();
	//$myDE->HideRightAlignButton();
	//$myDE->HideJustifyButton();
	//$myDE->HideHorizontalRuleButton();
	//$myDE->HideLinkButton();
	//$myDE->HideAnchorButton();
	//$myDE->HideMailLinkButton();
	//$myDE->HideHelpButton();
	//$myDE->HideFontList();
	//$myDE->HideSizeList();
	$myDE->HideSaveButton();
	//$myDE->HideFormatList();
	$myDE->HideStyleList();
	//$myDE->HideForeColorButton();
	//$myDE->HideBackColorButton();
	//$myDE->HideTableButton();
	//$myDE->HideFormButton();
	//$myDE->HideImageButton();
	//$myDE->HideFlashButton();
	//$myDE->DisableFlashUploading();
	//$myDE->DisableFlashDeleting();
	//$myDE->DisableInsertFlashFromWeb();
	//$myDE->HideTextBoxButton();
	//$myDE->HideSymbolButton();
	$myDE->HidePropertiesButton();		//隐藏页面属性按钮
	//$myDE->HideCleanHTMLButton();
	//$myDE->HidePositionAbsoluteButton();
	$myDE->HideSpellingButton();		//隐藏拼写检查按钮
	//$myDE->HideRemoveTextFormattingButton();
	//$myDE->HideSuperScriptButton();
	//$myDE->HideSubScriptButton();
	//$myDE->HideGuidelinesButton();
	//$myDE->DisableSourceMode();
	//$myDE->DisablePreviewMode();
	//$myDE->DisableImageUploading();
	//$myDE->DisableImageDeleting();
	//$myDE->DisableXHTMLFormatting();
	//$myDE->DisableSingleLineReturn();
	//$myDE->DisableInsertImageFromWeb();
	
	//If you want to use the spell checker, then you can set
	//the spelling language to DE_AMERICAN, DE_BRITISH or DE_CANADIAN,
	//DE_FRENCH, DE_SPANISH, DE_GERMAN, DE_ITALIAN, DE_PORTUGESE,
	//DE_DUTCH, DE_NORWEGIAN, DE_SWEDISH or DE_DANISH
	$myDE->SetLanguage(DE_AMERICAN);

	//We can specify a list of fonts for the font drop down. If we don't,
	//then a default list will show
	//$myDE->SetFontList("Arial,Verdana");

	//We can specify a list of font sizes for the font size drop down. If we don't,
	//then a default list will show
	//$myDE->SetFontSizeList("8,10");

	//How do we want images to be inserted into our HTML content?
	//DE_PATH_TYPE_FULL will insert a image in this format: http://www.mysite.com/test.html
	//DE_PATH_TYPE_ABSOLUTE will insert a image in this format: /myimage.gif
	$myDE->SetPathType(DE_PATH_TYPE_FULL);
	
	//Are we editing a full HTML page, or just a snippet of HTML?
	//DE_DOC_TYPE_HTML_PAGE means we're editing a complete HTML page
	//DE_DOC_TYPE_SNIPPET means we're editing a snippet of HTML
	$myDE->SetDocumentType(DE_DOC_TYPE_HTML_PAGE);
	
	//Do we want images to appear in the image manager as thumbnails or just in rows?
	//DE_IMAGE_TYPE_ROW means just list in a tabular format, without a thumbnail
	//DE_IMAGE_TYPE_THUMBNAIL means list in 4-per-line thumbnail mode
	$myDE->SetImageDisplayType(DE_IMAGE_TYPE_THUMBNAIL);
	
	//Do we want flash files to appear in the flash manager as thumbnails or just in rows?
	//DE_FLASH_TYPE_ROW means just list in a tabular format, without a thumbnail
	//DE_FLASH_TYPE_THUMBNAIL means list in 4-per-line thumbnail mode
	$myDE->SetFlashDisplayType(DE_FLASH_TYPE_THUMBNAIL);
	
	//Show table guidelines as dashed
	$myDE->EnableGuidelines();
	
	//If the user isnt running Internet Explorer, then a <textarea> tag will be shown.
	//This function will set the rows and cols of that <textarea>
	$myDE->SetTextAreaDimensions(60, 90);

	// Add some custom links that will appear in the link manager
	//$myDE->AddCustomLink("DevEdit", "http://www.devedit.com");
	//$myDE->AddCustomLink("Interspire", "http://www.interspire.com", "_new");

	$val = "";

	if($myDE->GetValue(false) == ""){
		/*$Tplsql = "SELECT TplPath FROM $tbl_article_type WHERE Parent=$parent and Id=$LibType";
		$Tplrow = DBQueryAndFetchRow($Tplsql);
		if ($Tplrow[TplPath] && !$row[Content]){
		$tpl = fopen("../templates/".$parent."_tpl/$Tplrow[TplPath]", "r");
		$tpl = fread($tpl, 200000);
		$val = $tpl;
		} else {
		$val = $row[Content];
		}*/
		$val = $pInfo[$var[FieldName]];
	}else{
		$val = $myDE->GetValue(false);
	}
	//Set the initial HTML value of our control
	$myDE->SetValue($val);
	
	// Use the LoadHTMLFromMySQLQuery function to load a value based on a query
	// $errDesc = "";
	// $myDE->LoadHTMLFromMySQLQuery("localhost", "testdatabase", "admin", "password", "select bContent from blah limit 1", $errDesc);
	// if($errDesc != "")
	// { echo "An error occured: $errDesc"; }
	
	// Use the LoadFromFile function to load a complete text file
	// $errDesc = "";
	// $myDE->LoadFromFile("mysite.html", $errDesc);
	// if($errDesc != "")
	// { echo "An error occured: $errDesc"; }
	
	// Use the SaveToFile function to save the contents of the DevEdit control to a text file
	// $errDesc = "";
	// $myDE->SaveToFile("c:\test.html", $errDesc);
	// if($errDesc != "")
	// { echo "An error occured: $errDesc"; }
	
	// Use the AddCustomInsert function to add some custom inserts
	//$myDE->AddCustomInsert("DevEdit Logo", "<img src='http://www.devedit.com/images/logo.gif'>");
	//$myDE->AddCustomInsert("Red Text", "<font face='verdana' color='red' size='3'><b>Red Text</b></font>");

	// Use the AddImageLibrary function to add image libraries
	//$myDE->AddImageLibrary("图片库 #1", "/icms/publish/test_images");
	//$myDE->AddImageLibrary("图片库 #2", "/icms/publish/test_images/sub");

	// Use the AddFlashLibrary function to add flash libraries
	//$myDE->AddFlashLibrary("Flash库 #1", "/icms/publish/test_flash");
	//$myDE->AddFlashLibrary("Flash库 #2", "/icms/publish/test_flash/sub");

	//Display the DevEdit control. This *MUST* be called between <form> and </form> tags
	$myDE->ShowControl("100%", "500",'');	
	//Display the rest of the form

	}      

}
?>
 </td>
 </tr>
</table>

</form>
</body>
</html>