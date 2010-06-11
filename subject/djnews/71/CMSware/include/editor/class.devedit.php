<?php 

	/***********************************************************\
	|                                                            |
	|  DevEdit v5.0 Copyright Interspire Pty Ltd 2003	         |
	|  All rights reserved. Do NOT modify this file. If          |
	|  you attempt to do so then we canot provide support. This  |
	|  or any other DevEdit files may NOT be shared or           |
	|  distributed in any way. To purchase more licences, please |
	|  visit www.devedit.com                                     |
	|                                                            |
	\************************************************************/

	error_reporting(0);

	// Define constants for calling varions class functions
	define("DE_PATH_TYPE_FULL", 0);
	define("DE_PATH_TYPE_ABSOLUTE", 1);
	define("DE_DOC_TYPE_SNIPPET", 0);
	define("DE_DOC_TYPE_HTML_PAGE", 1);
	define("DE_IMAGE_TYPE_ROW", 0);
	define("DE_IMAGE_TYPE_THUMBNAIL", 1);
	define("DE_FLASH_TYPE_ROW", 0);
	define("DE_FLASH_TYPE_THUMBNAIL", 1);

	define("DE_AMERICAN", 1);
	define("DE_BRITISH", 2);
	define("DE_CANADIAN", 3);
	define("DE_FRENCH", 4);
	define("DE_SPANISH", 5);
	define("DE_GERMAN", 6);
	define("DE_ITALIAN", 7);
	define("DE_PORTUGESE", 8);
	define("DE_DUTCH", 9);
	define("DE_NORWEGIAN", 10);
	define("DE_SWEDISH", 11);
	define("DE_DANISH", 12);
	//for cmswarerequire_once LANG_PATH.$SYS_ENV['language'].'/lang_skin/admin/editor.php';

	if (defined('CACHE_DIR')) {
		define('_DE_LANG_PATH', '../language/'.$SYS_ENV['language'].'/');
		include_once(_DE_LANG_PATH.'charset.inc.php');
		define("_EDITOR_PATH","../include/editor/");

		//echo  'aaaaaaaaaaaaaaaaaa';
	} else {
		//define('_DE_LANG_PATH', '../language/'.$SYS_ENV['language'].'/');
		include_once("../../config.php");
		define("_EDITOR_PATH",".");
	
		define('_DE_LANG_PATH', '../../language/'.$SYS_CONFIG['language'].'/');
		include_once(_DE_LANG_PATH.'charset.inc.php');

	}



	// Check if HTTPS is enabled
	if (@$_SERVER["HTTPS"] == "on")
	{
		$GLOBALS['HTTPStr'] = "https";
	} else
	{
		$GLOBALS['HTTPStr'] = "http";
	}

	$DevEditError = false;

	if(is_numeric(strpos($_SERVER["PHP_SELF"], "class.devedit.php")))
		$DE_PATH = "";
	else
		$DE_PATH = "de/";

	function SetDevEditPath($Path)
	{
		global $DevEditPath;
		global $DevEditPath_Full;
		//echo $Path;
		$_SERVER["PATH_TRANSLATED"] = str_replace("\\\\",'/', $_SERVER["PATH_TRANSLATED"]);
		//$_SERVER["PHP_SELF"] = 
		$pathinfo =  pathinfo($_SERVER["PATH_TRANSLATED"]);
		$pathinfo1 = pathinfo($_SERVER["PHP_SELF"]);

		$pathinfo["dirname"] = str_replace($pathinfo1["dirname"], '', $pathinfo["dirname"]);
		
		$DOCUMENT_ROOT = $pathinfo["dirname"];
		$tmpPath = "";

		//Does the path contain a trailing slash? If so, remove it
		$lastChar = substr($Path, strlen($Path)-1, 1);

		if($lastChar == "/")
			$tmpPath = substr($Path, 0, strlen($Path)-1);
		else
			$tmpPath = $Path;

		//Is this a relative path?
		if(substr($tmpPath, 0, 1) != "/")
		{
			$tmpPath = strrev($_SERVER["PHP_SELF"]);
			$firstSlash = strpos($tmpPath, "/");
			$tmpPath = strrev(substr($tmpPath, $firstSlash, strlen($tmpPath)));
			$tmpPath = $tmpPath . "/" . $Path;
			$tmpPath = str_replace("//", "/", $tmpPath);
			$tmpPath = eregi_replace("/$", "", $tmpPath);
		}

		$DevEditPath = $tmpPath;
		//echo $DevEditPath_Full;
		//$DevEditPath =  $DevEditPath_Full;
		//$DevEditPath_Full = str_replace("//", "/", $DOCUMENT_ROOT . "/" . $tmpPath);
		$DevEditPath_Full = _EDITOR_PATH;
		//echo $DevEditPath_Full;
		//echo $DevEditPath_Full;

		//$DevEditPath_Full = ""
		//echo $_SERVER["SCRIPT_FILENAME"];exit;
		
		//echo $_SERVER["PHP_SELF"];
		//echo $DOCUMENT_ROOT;exit;
	
	}
	function DisplayIncludes ($file, $errorMsg)
	{
		// This function will load a .inc file and replace any
		// values that start with [sTxt using a regexp with the
		// values that were defined as constants in de_lang/language.php
		
		global $DE_PATH;
		global $DE_IMG_PATH;
		global $filePath;
		global $HTTPStr;
		global $DevEditPath;
		global $DevEditPath_Full;
		global $DevEditError;
		global $SYS_ENV;
		//alert('a');
		
		//header('Content-Type: text/html; charset='.CHARSET);
		if (!headers_sent()) {
			header('Content-Type: text/html; charset='.CHARSET);
			
		}

		$DevEditPath_Full = _EDITOR_PATH;
	
		$filePath = $DevEditPath_Full . "/de_includes/$file";
		$thePath = $DevEditPath_Full;
		
		//echo $filePath;exit;
		//print_r($GLOBALS);
		include($thePath . "/de_lang/language.php");
		//echo  LANG_PATH.$SYS_ENV['language'].'/lang_skin/admin/editor.php';
		//include LANG_PATH.$SYS_ENV['language'].'/lang_skin/admin/editor.php';
		if(@$_GET["DEP1"] != "")
			$DevEditPath = @$_GET["DEP1"];
		
		
		if(file_exists($filePath))
		{
			//echo $filePath;
			//echo _DE_LANG_PATH."lang_editor.php";
		// Workout the location of class.devedit.php
			$url = @$_SERVER["HTTP_HOST"];

			if(@$url == "")
				$url = @$_SERVER["SERVER_NAME"];

			$scriptName = "class.devedit.php";
			$scriptDir = strrev($_SERVER["PHP_SELF"]);
			$slashPos = strpos($scriptDir, "/");
			$scriptDir = strrev(substr($scriptDir, $slashPos, strlen($scriptDir)));
			$scriptName = $scriptDir . $scriptName;
			$fp = fopen($filePath, "rb");
			$fileContent = "";

			while($data = fgets($fp, 1024))
			{
				$data = str_replace("\$URL", $url, $data);
				$data = str_replace("\$SCRIPTNAME", $scriptName, $data);
				$data = str_replace("\$HTTPStr", $HTTPStr, $data);
				$data = str_replace("\$DEP", $DevEditPath, $data);
				$fileContent .= preg_replace("/\[sTxt(\w*)\]/ei","sTxt\\1", $data);
			}
			
			// Close the file pointer and output the pReg'd code
			fclose($fp);
			//header('Content-Type: text/html; charset='.CHARSET);
			//echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".CHARSET."\" />";
			echo $fileContent;
		}
		else
		{
			echo "file not found: $file";
			
			$DevEditError = true;
		}
	}
	
	// Examine the value of the ToDo argument and proceed to correct sub
	$ToDo = @$_GET["ToDo"];

	if($ToDo == "")
		$ToDo = @$_POST["ToDo"];

	if(@$DevEditPath == "")
	{
		$DevEditPath = @$_GET["DEP"];
		$DevEditPath_Full = $DevEditPath;
	}
	//add at 0924 16:02 by hawking
$DevEditPath_Full = _EDITOR_PATH;
	switch($ToDo)
	{
		case "InsertImage":
		{
			// Pass to insert image screen
			include($DevEditPath_Full . "/de_includes/insert_image.php");
			break;
		}
		case "PageInsert":

			DisplayIncludes("insert_page.php", "Insert Page");
		//include($DevEditPath_Full ."/de_includes/insert_page.php");

			break;
		case "EditImage":
		{
			// Pass to insert image screen
			//include($DevEditPath_Full . "/de_includes/edit_image.php");
			header("Location: ./photoEditor/popedit.html");
			exit;
			break;
		}
		case "DeleteImage":
		{
			include($DevEditPath_Full . "/de_includes/insert_image.php");
			break;
		}
		case "UploadImage":
		{
			include($DevEditPath_Full . "/de_includes/insert_image.php");
			break;
		}
		case "InsertFlash":
		{
			include($DevEditPath_Full . "/de_includes/insert_flash.php");
			break;
		}
		case "UploadFlash":
		{
			include($DevEditPath_Full . "/de_includes/insert_flash.php");
			break;
		}
		case "DeleteFlash":
		{
			include($DevEditPath_Full . "/de_includes/insert_flash.php");
			break;
		}
		case "IncludeImages":
		{
			DisplayIncludes("include_images.php", "Find and Replace");
			break;
		}
		case "FindReplace":
		{
			DisplayIncludes("find_replace.php", "Find and Replace");
			break;
		}
		case "SpellCheck":
		{
			DisplayIncludes("spell_check.php", "Spell Check");
			break;
		}
		case "DoSpell":
		{
			DisplayIncludes("do_spell.php", "Spell Check");
			break;
		}
		case "InsertTable":
		{
			DisplayIncludes("insert_table.php", "Insert Table");
			break;
		}
		case "ModifyTable":
		{
			DisplayIncludes("modify_table.php", "Modify Table");
			break;
		}
		case "ModifyCell":
		{
			DisplayIncludes("modify_cell.php", "Modify Cell");
			break;
		}
		case "ModifyImage":
		{
			DisplayIncludes("modify_image.php", "Modify Image");
			break;
		}
		case "InsertForm":
		{
			DisplayIncludes("insert_form.php", "Insert Form");
			break;
		}
		case "ModifyForm":
		{
			DisplayIncludes("modify_form.php", "Modify Form");
			break;
		}
		case "InsertTextField":
		{
			DisplayIncludes("insert_textfield.php", "Insert Text Field");
			break;
		}
		case "ModifyTextField":
		{
			DisplayIncludes("modify_textfield.php", "Modify Text Field");
			break;
		}
		case "InsertTextArea":
		{
			DisplayIncludes("insert_textarea.php", "Insert Text Area");
			break;
		}
		case "ModifyTextArea":
		{
			DisplayIncludes("modify_textarea.php", "Modify Text Area");
			break;
		}
		case "InsertHidden":
		{
			DisplayIncludes("insert_hidden.php", "Insert Hidden Field");
			break;
		}
		case "ModifyHidden":
		{
			DisplayIncludes("modify_hidden.php", "Modify Hidden Field");
			break;
		}
		case "InsertButton":
		{
			DisplayIncludes("insert_button.php", "Insert Button");
			break;
		}
		case "ModifyButton":
		{
			DisplayIncludes("modify_button.php", "Modify Button");
			break;
		}
		case "InsertCheckbox":
		{
			DisplayIncludes("insert_checkbox.php", "Insert Checkbox");
			break;
		}
		case "ModifyCheckbox":
		{
			DisplayIncludes("modify_checkbox.php", "Modify Checkbox");
			break;
		}
		case "InsertRadio":
		{
			DisplayIncludes("insert_radio.php", "Insert Radio");
			break;
		}
		case "ModifyRadio":
		{
			DisplayIncludes("modify_radio.php", "Modify Radio");
			break;
		}
		case "InsertSelect":
		{
			DisplayIncludes("insert_select.php", "Insert Select");
			break;
		}
		case "ModifySelect":
		{
			DisplayIncludes("modify_select.php", "Modify Select");
			break;
		}
		case "PageProperties":
		{
			DisplayIncludes("page_properties.php", "Page Properties");
			break;
		}
		// Added for v5.0
		case "Chars":
		{
			DisplayIncludes("insert_chars.php", "Insert Special Characters");
			break;
		}
		case "InsertLink":
		{
			DisplayIncludes("insert_link.php", "Insert HyperLink");
			break;
		}
		case "InsertEmail":
		{
			DisplayIncludes("insert_email.php", "Insert Email Link");
			break;
		}
		case "InsertAnchor":
		{
			DisplayIncludes("insert_anchor.php", "Insert Anchor");
			break;
		}
		case "ModifyAnchor":
		{
			DisplayIncludes("modify_anchor.php", "Modify Anchor");
			break;
		}
		case "MoreColors":
		{
			DisplayIncludes("more_colors.php", "More Colors");
			break;
		}
		case "CustomInsert":
		{
			DisplayIncludes("custom_insert.php", "Insert Custom HTML");
			break;
		}
		case "ShowHelp":
		{
			DisplayIncludes("help.php", "Help");
			break;
		}
		case "Article":
		{
			DisplayIncludes("icms_article.php", "Article");
			break;
		}
	}
	
	class DevEdit
	{
		var $__controlName;
		var $__controlWidth;
		var $__controlHeight;
		var $__initialValue;
		var $__initialValueNoBase;
		var $__langPack;
		var $__hideSave;
		var $__hideSpelling;
		var $__hideRemoveTextFormatting;
		var $__hideFullScreen;
		var $__hideBold;
		var $__hideUnderline;
		var $__hideItalic;
		var $__hideStrikethrough;
		var $__hideNumberList;
		var $__hideBulletList;
		var $__hideDecreaseIndent;
		var $__hideIncreaseIndent;
		var $__hideSuperScript;
		var $__hideSubScript;
		var $__hideLeftAlign;
		var $__hideCenterAlign;
		var $__hideRightAlign;
		var $__hideJustify;
		var $__hideHorizontalRule;
		var $__hideLink;
		var $__hideAnchor;
		var $__hideMailLink;
		var $__hideHelp;
		var $__hideFont;
		var $__hideSize;
		var $__hideFormat;
		var $__hideStyle;
		var $__hideForeColor;
		var $__hideBackColor;
		var $__hideTable;
		var $__hideForm;
		var $__hideImage;
		var $__hideFlash;
		var $__flashPath;
		var $__hideTextBox;
		var $__hideSymbols;
		var $__hideProps;
		var $__hideWord;
		var $__hideAbsolute;
		var $__hideClean;
		var $__hidePositionAbsolute;
		var $__hideGuidelines;
		var $__disableSourceMode;
		var $__disablePreviewMode;
		var $__guidelinesOnByDefault;
		var $__imagePath;
		var $__hasFlashLibraries;
		var $__flashLibsArray;
		var $__baseHref;
		var $__imagePathType;
		var $__docType;
		var $__imageDisplayType;
		var $__flashDisplayType;
		var $__disableImageUploading;
		var $__disableImageDeleting;
		var $__disableFlashUploading;
		var $__disableFlashDeleting;
		var $__enableXHTMLSupport;
		var $__useSingleLineReturn;
		var $__customInsertArray;
		var $__customLinkArray;
		var $__hasCustomInserts;
		var $__hasCustomLinks;
		var $__snippetCSS;
		var $__textareaRows;
		var $__textareaCols;
		var $__fontNameList;
		var $__fontSizeList;
		var $__hideWebImage;
		var $__hideWebFlash;
		var $__language;
		var $__imageLibsArray;
		var $__hasImageLibraries;
		
		// Keep track of how many buttons are hidden in the top row.
		// If they are all hidden, then we dont show that row of the menu.
		var $__numTopHidden;
		var $__numBottomHidden;
		
		function DevEdit()
		{
			// Set the default value of all private variables for the class
			$this->__controlName = "";
			$this->__controlWidth = 0;
			$this->__controlHeight = 0;
			$this->__initialValue = "";
			$this->__initialValueNoBase = "";
			$this->__langPack = 0;
			$this->__hideSave = 0;
			$this->__hideSpelling = 0;
			$this->__hideRemoveTextFormatting = 0;
			$this->__hideFullScreen = 0;
			$this->__hideBold = 0;
			$this->__hideUnderline = 0;
			$this->__hideItalic = 0;
			$this->__hideStrikethrough = 0;
			$this->__hideNumberList = 0;
			$this->__hideBulletList = 0;
			$this->__hideDecreaseIndent = 0;
			$this->__hideIncreaseIndent = 0;
			$this->__hideSuperScript = 0;
			$this->__hideSubScript = 0;
			$this->__hideLeftAlign = 0;
			$this->__hideCenterAlign = 0;
			$this->__hideRightAlign = 0;
			$this->__hideJustify = 0;
			$this->__hideHorizontalRule = 0;
			$this->__hideLink = 0;
			$this->__hideAnchor = 0;
			$this->__hideMailLink = 0;
			$this->__hideHelp = 0;
			$this->__hideFont = 0;
			$this->__hideSize = 0;
			$this->__hideFormat = 0;
			$this->__hideStyle = 0;
			$this->__hideForeColor = 0;
			$this->__hideBackColor = 0;
			$this->__hideTable = 0;
			$this->__hideForm = 0;
			$this->__hideImage = 0;
			$this->__hideFlash = 0;
			$this->__flashPath = "";
			$this->__hideTextBox = 0;
			$this->__hideSymbols = 0;
			$this->__hideProps = 0;
			$this->__hideWord = 0;
			$this->__hideAbsolute = 0;
			$this->__hideClean = 0;
			$this->__hideGuidelines = 0;
			$this->__hidePositionAbsolute = 0;
			$this->__disableSourceMode = 0;
			$this->__disablePreviewMode = 0;
			$this->__guidelinesOnByDefault = 0;
			$this->__imagePath = "";
			$this->__hasFlashLibraries = false;
			$this->__flashLibsArray = array();
			$this->__baseHref = "";
			$this->__numTopHidden = 0;
			$this->__numBottomHidden = 0;
			$this->__imagePathType = 0;
			$this->__docType = 0;
			$this->__imageDisplayType = 0;
			$this->__flashDisplayType = 0;
			$this->__disableImageUploading = 0;
			$this->__disableImageDeleting = 0;
			$this->__disableFlashUploading = 0;
			$this->__disableFlashDeleting = 0;
			$this->__enableXHTMLSupport = 0;
			$this->__useSingleLineReturn = 1;
			$this->__customInsertArray = array();
			$this->__customLinkArray = array();
			$this->__hasCustomInserts = false;
			$this->__hasCustomLinks = false;
			$this->__snippetCSS = "";
			$this->__textareaRows = 10;
			$this->__textareaCols = 30;
			$this->__fontNameList = array();
			$this->__fontSizeList = array();
			$this->__hideWebImage = 0;
			$this->__hideWebFlash = 0;
			$this->__language = 0;
			$this->__imageLibsArray = array();
			$this->__hasImageLibraries = false;
		}

		function SetName($CtrlName)
		{
			$this->__controlName = $CtrlName;
		}

		function SetWidth($Width)
		{
			$this->__controlWidth = $Width;
		}
		
		function SetHeight($Height)
		{
			$this->__controlHeight = $Height;
		}

		//modified for v5.0
		function SetBaseHref($BaseHref)
		{
			$this->__baseHref = $BaseHref;
		}

		function SetFlashPath($FlashPath)
		{
			$this->__flashPath = $FlashPath;
		}

		function SetValue($HTMLValue)
		{
			// modified for v5.0
			$this->__initialValueNoBase = $HTMLValue;

			if($this->__docType == DE_DOC_TYPE_SNIPPET)
			{
				if($this->__baseHref != "")
				{
					$HTMLValue = "<base href=" . $this->__baseHref . "><body>" . $HTMLValue . "</body>";
				}
				else
				{
					$HTMLValue = "<body>" . $HTMLValue . "</body>";
					$this->__initialValueNoBase = "<body>" . $this->__initialValueNoBase . "</body>";
				}
			}

			if($this->__docType == DE_DOC_TYPE_SNIPPET && $this->__snippetCSS != "")
			{
				$HTMLValue = "<link rel='stylesheet' type='text/css' href='" . $this->__snippetCSS . "'>" . $HTMLValue;
				$this->__initialValueNoBase = "<link rel='stylesheet' type='text/css' href='" . $this->__snippetCSS . "'>" . $this->__initialValueNoBase;
			}

			if($this->__docType == DE_DOC_TYPE_HTML_PAGE && !is_numeric(strpos(strtolower($HTMLValue), "<body")))
			{
				$HTMLValue = "<body>" . $HTMLValue . "</body>";
				$this->__initialValueNoBase = "<body>" . $this->__initialValueNoBase . "</body>";
			}
			// end modification

			// Format the initial text so that we can set the content of the iFrame to its value
			$this->__initialValue = $HTMLValue;

			if($this->__initialValue != "")
			{
				if($this->isIE55OrAbove())
				{
					//$this->__initialValue = str_replace("\\", "\\\\", $this->__initialValue);
					//$this->__initialValue = str_replace("'", "\'", $this->__initialValue);
					//$this->__initialValue = str_replace("&#39;", "\&#39;", $this->__initialValue);
					//$this->__initialValue = str_replace(chr(13), "", $this->__initialValue);
					//$this->__initialValue = str_replace(chr(10), "", $this->__initialValue);

					$this->__initialValueNoBase = str_replace("\\", "\\\\", $this->__initialValueNoBase);
					$this->__initialValueNoBase = str_replace("'", "\'", $this->__initialValueNoBase);
					$this->__initialValueNoBase = str_replace("&#39;", "\&#39;", $this->__initialValueNoBase);
					$this->__initialValueNoBase = str_replace(chr(13), "", $this->__initialValueNoBase);
					$this->__initialValueNoBase = str_replace(chr(10), "", $this->__initialValueNoBase);
				}
				else
				{
					$this->__initialValue = $HTMLValue;
					//$this->__initialValue = str_replace("\\'", "'", $this->__initialValue);
					//$this->__initialValue = str_replace('\\"', '"', $this->__initialValue);
				}
			}
		}
		
		function GetValue($ConvertQuotes = true)
		{
			$tmpVal = @$_POST[$this->__controlName . "_html"];

			if($ConvertQuotes == false)
			{
				$tmpVal = str_replace("\\'", "'", $tmpVal);
				$tmpVal = str_replace('\\"', '"', $tmpVal);
			}

			return $tmpVal;
		}

		function HideSaveButton()
		{
			//Hide the save button
			$this->__hideSave = true;
			$this->__numTopHidden++;
		}

		function HideSpellingButton()
		{
			// Hide the spelling button
			$this->__hideSpelling = true;
			$this->__numTopHidden++;
		}

		function HideRemoveTextFormattingButton()
		{
			// Hide the remove text formatting button
			$this->__hideRemoveTextFormatting = true;
			$this->__numTopHidden++;
		}

		function HideFullScreenButton()
		{
			// Hide the fullscreen button
			$this->__hideFullScreen = true;
			$this->__numTopHidden++;
		}

		function HideBoldButton()
		{
			// Hide the bold button
			$this->__hideBold = true;
			$this->__numTopHidden++;
		}
		
		function HideUnderlineButton()
		{
			// Hide the underline button
			$this->__hideUnderline = true;
			$this->__numTopHidden++;
		}

		function HideItalicButton()
		{
			// Hide the italic button
			$this->__hideItalic = true;
			$this->__numTopHidden++;
		}

		function HideStrikethroughButton()
		{
			// Hide the strikethrough button
			$this->__hideStrikethrough = true;
			$this->__numTopHidden++;
		}

		function HideNumberListButton()
		{
			// Hide the number list button
			$this->__hideNumberList = true;
			$this->__numTopHidden++;
		}

		function HideBulletListButton()
		{
			// Hide the bullet list button
			$this->__hideBulletList = true;
			$this->__numTopHidden++;
		}

		function HideDecreaseIndentButton()
		{
			// Hide the decrease indent button
			$this->__hideDecreaseIndent = true;
			$this->__numTopHidden++;
		}

		function HideIncreaseIndentButton()
		{
			// Hide the increase indent button
			$this->__hideIncreaseIndent = true;
			$this->__numTopHidden++;
		}
		
		function HideSuperScriptButton()
		{
			// Hide the super script button
			$this->__hideSuperScript = true;
			$this->__numTopHidden++;
		}

		function HideSubScriptButton()
		{
			// Hide the sub script button
			$this->__hideSubScript = true;
			$this->__numTopHidden++;
		}

		function HideLeftAlignButton()
		{
			// Hide the left align button
			$this->__hideLeftAlign = true;
			$this->__numTopHidden++;
		}

		function HideCenterAlignButton()
		{
			// Hide the center align button
			$this->__hideCenterAlign = true;
			$this->__numTopHidden++;
		}

		function HideRightAlignButton()
		{
			// Hide the right align button
			$this->__hideRightAlign = true;
			$this->__numTopHidden++;
		}

		function HideJustifyButton()
		{
			// Hide the justify button
			$this->__hideJustify = true;
			$this->__numTopHidden++;
		}

		function HideHorizontalRuleButton()
		{
			// Hide the horizontal rule button
			$this->__hideHorizontalRule = true;
			$this->__numTopHidden++;
		}

		function HideLinkButton()
		{
			// Hide the link button
			$this->__hideLink = true;
			$this->__numTopHidden++;
		}

		function HideAnchorButton()
		{
			// Hide the anchor button
			$this->__hideAnchor = true;
			$this->__numTopHidden++;
		}

		function HideMailLinkButton()
		{
			// Hide the mail link button
			$this->__hideMailLink = true;
			$this->__numTopHidden++;
		}

		function HideHelpButton()
		{
			// Hide the help button
			$this->__hideHelp = true;
			$this->__numTopHidden++;
		}

		function HideFontList()
		{
			// Hide the font list
			$this->__hideFont = true;
			$this->__numBottomHidden++;
		}
		
		function HideSizeList()
		{
			// Hide the size list
			$this->__hideSize = true;
			$this->__numBottomHidden++;
		}

		function HideFormatList()
		{
			// Hide the format list
			$this->__hideFormat = true;
			$this->__numBottomHidden++;
		}

		function HideStyleList()
		{
			// Hide the style list
			$this->__hideStyle = true;
			$this->__numBottomHidden++;
		}

		function HideForeColorButton()
		{
			// Hide the forecolor button
			$this->__hideForeColor = true;
			$this->__numBottomHidden++;
		}
		
		function HideBackColorButton()
		{
			// Hide the backcolor button
			$this->__hideBackColor = true;
			$this->__numBottomHidden++;
		}

		function HideTableButton()
		{
			// Hide the table button
			$this->__hideTable = true;
			$this->__numBottomHidden++;
		}

		function HideFormButton()
		{
			// Hide the form button
			$this->__hideForm = true;
			$this->__numBottomHidden++;
		}
		
		function HideImageButton()
		{
			// Hide the image button
			$this->__hideImage = true;
			$this->__numBottomHidden++;
		}

		function HideFlashButton()
		{		
			//Hide the flash button
			$this->__hideFlash = true;
			$this->__numBottomHidden++;
		}

		function HideTextBoxButton()
		{
			// Hide the image button
			$this->__hideTextBox = true;
			$this->__numBottomHidden++;
		}

		function HideSymbolButton()
		{
			// Hide the symbol button
			$this->__hideSymbols = true;
			$this->__numBottomHidden++;
		}

		function HidePropertiesButton()
		{
			// Hide the properties button
			$this->__hideProps = true;
			$this->__numBottomHidden++;
		}

		function HideCleanHTMLButton()
		{
			// Hide the clean HTML button
			$this->__hideClean = true;
			$this->__numBottomHidden++;
		}

		function HidePositionAbsoluteButton()
		{
			// Hide the position absolute button
			$this->__hidePositionAbsolute = true;
			$this->__numBottomHidden++;
		}

		function HideGuidelinesButton()
		{
			// Hide the guidelines button
			$this->__hideGuidelines = true;
			$this->__numBottomHidden++;
		}

		function DisableSourceMode()
		{
			// Hide the source mode button
			$this->__disableSourceMode = true;
		}
		
		function DisablePreviewMode()
		{
			// Hide the preview mode button
			$this->__disablePreviewMode = true;
		}

		function EnableGuidelines()
		{
			// Set the table guidelines on by default
			$this->__guidelinesOnByDefault = true;
		}

		function SetPathType($PathType)
		{
			// How do we want to include the path to the images? 0 = Full, 1 = Absolute
			$this->__imagePathType = $PathType;
		}
		
		function SetDocumentType($DocType)
		{
			// Is the user editing a full HTML document
			$this->__docType = $DocType;
		}

		function SetImageDisplayType($DisplayType)
		{
			// How should the images be displayed in the image manager? 0 = Line / 1 = Thumbnails
			$this->__imageDisplayType = $DisplayType;
		}

		function DisableImageUploading()
		{
			// Do we need to stop images being uploaded?
			$this->__disableImageUploading = 1;
		}

		function DisableImageDeleting()
		{
			// Do we need to stop images from being delete?
			$this->__disableImageDeleting = 1;
		}

		function SetFlashDisplayType($DisplayType)
		{
			//How should the flash files be displayed in the image manager? 0 = Line / 1 = Thumbnails
			$this->__flashDisplayType = $DisplayType;
		}

		function DisableFlashUploading()
		{
			//Do we need to stop flash files being uploaded?
			$this->__disableFlashUploading = 1;
		}

		function DisableFlashDeleting()
		{
			//Do we need to stop flash files from being deleted?
			$this->__disableFlashDeleting = 1;
		}

		function isIE55OrAbove()
		{
			// Is it MSIE?
			$browserCheck1 = ( is_numeric(strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")) ) ? true : false;

			// Is it NOT Opera?
			$browserCheck2 = ( !is_numeric(strpos($_SERVER["HTTP_USER_AGENT"], "Opera")) ) ? true : false;

			// Is it MSIE 5 or above?
			// Modified for v5.0 or above
			$browserCheck3 = ( is_numeric(strpos($_SERVER["HTTP_USER_AGENT"], "MSIE 5.5")) || is_numeric(strpos($_SERVER["HTTP_USER_AGENT"], "MSIE 6")) || is_numeric(strpos($_SERVER["HTTP_USER_AGENT"], "MSIE 7"))) ? true : false;

			$browserCheck4 = is_numeric(strpos($_SERVER["HTTP_USER_AGENT"], "Windows"));

			if($browserCheck4 == 0)
				$browserCheck4 = false;
			else
				$browserCheck4 = true;

			if($browserCheck1 && $browserCheck2 && $browserCheck3 && $browserCheck4)
				return true;
			else
				return false;
		}
		
		// -------------------------
		// Version 3.0 new functions
		
		function DisableXHTMLFormatting()
		{
			// Disable XHTML formatting of inline code
			$this->__enableXHTMLSupport = 0;
		}		
		
		function DisableSingleLineReturn()
		{
			// Instead of adding a <p> tag for a new line, add <br> instead
			$this->__useSingleLineReturn = 0;
		}
		
		function LoadHTMLFromMySQLQuery($DatabaseServer, $DatabaseName, $DatabaseUser, $DatabasePassword, $DatabaseQuery, &$ErrorDesc)
		{
			// Grabs a value from a MySQL database based on a SELECT query.
			// It will return a text value from the field on success, or false on failure
			
			if(!$sConn = @mysql_connect($DatabaseServer, $DatabaseUser, $DatabasePassword))
			{
				// Server connection failed
				$ErrorDesc = mysql_error();
				return false;
			}
			else
			{
				// Server connection was successful
				if(! $dConn = @mysql_select_db($DatabaseName, $sConn))
				{
					// Database connection failed
					$ErrorDesc = mysql_error();
					return false;
				}
				else
				{
					// Database connection was successful
					if(! $mResult = @mysql_query($DatabaseQuery))
					{
						// Query Failed
						$ErrorDesc = mysql_error();
						return false;
					}
					else
					{
						// Query was OK. Did it return a row?
						if(@mysql_num_rows($mResult) == 0)
						{
							// No rows returned
							$ErrorDesc = mysql_error();
							return false;
						}
						else
						{
							// Grab the first row's contents and return it
							if(! $mRow = mysql_fetch_row($mResult))
							{
								// Error returning row
								$ErrorDesc = mysql_error();
								return false;
							}
							else
							{
								// Set the contents of the DevEdit control to this value
								$this->SetValue($mRow[0]);
								return true;
							}
						}
					}
				}
			}
		}

		function LoadFromFile($FilePath, &$ErrorDesc)
		{
			// Grabs the contents of a file and sets the value
			// of the DevEdit control to the text in this file
			
			if(! $fp = @fopen($FilePath, "rb"))
			{
				// Failed to open the file
				$ErrorDesc = "Failed to open file $FilePath";
				return false;
			}
			else
			{
				// File was opened OK, read it in
				while(!feof($fp))
				{
					$data .= fgets($fp, 4096);
				}
				
				// Set the value to the contents of this file
				$this->SetValue($data);
				return true;
			}
		}

		function SaveToFile($FilePath, &$ErrorDesc)
		{
			// Writes the contents of the DevEdit control to a file
			if(strlen($this->GetValue(false)) == 0)
			{
				// No data to write to the file
				$ErrorDesc = "Cannot save an empty value to $FilePath";
				return false;
			}
			else
			{
				// The form has been submitted, save its contents
				if(! $fp = @fopen($FilePath, "w"))
				{
					// Failed to open the file
					$ErrorDesc = "Failed to open file $FilePath";
					return false;
				}
				else
				{
					// File was opened OK, write to it
					if(! is_writable($FilePath))
					{
						// Can't write to the file
						$ErrorDesc = "You do not have write permissions for $FilePath";
						return false;
					}
					else
					{
						if(! fwrite($fp, $this->GetValue(false)))
						{
							// Failed to write to the file
							$ErrorDesc = "An error occured while writing to $FilePath";
							return false;
						}
						else
						{
							// Write went OK
							return true;
						}
					}
				}
			}
		}
		
		function AddCustomInsert($InsertName, $InsertHTMLCode)
		{
			$this->__hasCustomInserts = true;
			$this->__customInsertArray[] = array("Name" => $InsertName, "HTML" => $InsertHTMLCode);
		}

		//Added for v5.0
		function AddCustomLink($LinkName, $LinkURL, $TargetWindow = "")
		{
			$this->__hasCustomLinks = true;
			$this->__customLinkArray[] = array("Name" => $LinkName, "URL" => $LinkURL, "Target" => $TargetWindow);
		}

		//Added for v5.0
		function AddImageLibrary($LibraryName, $LibraryPath)
		{
			if(!in_array($LibraryName, $this->__imageLibsArray))
			{
				$this->__hasImageLibraries = true;
				$this->__imageLibsArray[] = array($LibraryName, $LibraryPath);
			}
		}

		function AddFlashLibrary($LibraryName, $LibraryPath)
		{
			if(!in_array($LibraryName, $this->__flashLibsArray))
			{
				$this->__hasFlashLibraries = true;
				$this->__flashLibsArray[] = array($LibraryName, $LibraryPath);
			}
		}

		function __FormatCustomInsertText()
		{
			// Private Function - This function will return all of the custom inserts as JavaScript arrays
			if($this->__hasCustomInserts == true)
			{
				$ciText = "[";

				for($i = 0; $i < sizeof($this->__customInsertArray); $i++)
				{
					$name = str_replace("\r\n", "\\r\\n", str_replace("\"", "\\\"", $this->__customInsertArray[$i]["Name"]));
					$html = str_replace("\r\n", "\\r\\n", str_replace("\"", "\\\"", $this->__customInsertArray[$i]["HTML"]));
					$ciText .= "[\"" . $name . "\", \"" . $html . "\"],";
				}
			
				$ciText = substr($ciText, 0, strlen($ciText)-1);
				$ciText .= "]";
			}
			else
			{
				$ciText = "[]";
			}
			
			return $ciText;
		}

		// Added for v5.0
		function __FormatCustomLinkText()
		{
			// Private Function - This function will return all of the custom links as JavaScript arrays
			if($this->__hasCustomLinks == true)
			{
				$ciText = "[";

				for($i = 0; $i < sizeof($this->__customLinkArray); $i++)
				{
					$name = str_replace("\r\n", "\\r\\n", str_replace("\"", "\\\"", $this->__customLinkArray[$i]["Name"]));
					$url = str_replace("\r\n", "\\r\\n", str_replace("\"", "\\\"", $this->__customLinkArray[$i]["URL"]));
					$target = str_replace("\r\n", "\\r\\n", str_replace("\"", "\\\"", $this->__customLinkArray[$i]["Target"]));
					$ciText .= "[\"" . $name . "\", \"" . $url . "|" . $target . "\"],";
				}
			
				$ciText = substr($ciText, 0, strlen($ciText)-1);
				$ciText .= "]";
			}
			else
			{
				$ciText = "[]";
			}
			
			return $ciText;
		}

		// Added for v5.0
		function GetImageLibraries()
		{
			// Private Function - This function will return all of the image libraries as JavaScript arrays
			$ciText = "<option value=\"" . $this->__imagePath . "\">" . sTxtDefaultImageLibrary . "</option>";

			if($this->__hasImageLibraries == true)
			{
				for($i = 0; $i < sizeof($this->__imageLibsArray); $i++)
				{
					$name = str_replace("\r\n", "\\r\\n", str_replace("\"", "\\\"", $this->__imageLibsArray[$i][0]));
					$dir = str_replace("\r\n", "\\r\\n", str_replace("\"", "\\\"", $this->__imageLibsArray[$i][1]));
					$ciText .= "<option value=\"" . $dir . "\">" . $name . "</option>";
				}
			}
			
			return str_replace("'", "\'", $ciText);
		}

		function GetFlashLibraries()
		{
			// Private Function - This function will return all of the flash libraries as JavaScript arrays
			$ciText = "<option value=\"" . $this->__flashPath . "\">" . sTxtDefaultFlashLibrary . "</option>";

			if($this->__hasFlashLibraries == true)
			{
				for($i = 0; $i < sizeof($this->__flashLibsArray); $i++)
				{
					$name = str_replace("\r\n", "\\r\\n", str_replace("\"", "\\\"", $this->__flashLibsArray[$i][0]));
					$dir = str_replace("\r\n", "\\r\\n", str_replace("\"", "\\\"", $this->__flashLibsArray[$i][1]));
					$ciText .= "<option value=\"" . $dir . "\">" . $name . "</option>";
				}
			}
			
			return str_replace("'", "\'", $ciText);
		}

		function SetSnippetStyleSheet($StyleSheetURL)
		{
			// Sets the location of the stylesheet for a code snippet
			$this->__docType = DE_DOC_TYPE_SNIPPET;
			$this->__snippetCSS = $StyleSheetURL;
		}
		
		function SetTextAreaDimensions($Cols, $Rows)
		{
			// Sets the rows and cols attributes of the <textarea> tag that will appear
			// if the client isnt using Internet explorer
			$this->__textareaCols = $Cols;
			$this->__textareaRows = $Rows;
		}

		// End Version 3.0 new functions
		// Version 4.0 new functions

		function SetLanguage($Lang)
		{
			switch($Lang)
			{
				case "1":
				{
					$this->__language = "american";
					break;
				}
				case "2":
				{
					$this->__language = "british";
					break;
				}
				case "3":
				{
					$this->__language = "canadian";
					break;
				}
				case "4":
				{
					$this->__language = "french";
					break;
				}
				case "5":
				{
					$this->__language = "spanish";
					break;
				}
				case "6":
				{
					$this->__language = "german";
					break;
				}
				case "7":
				{
					$this->__language = "italian";
					break;
				}
				case "8":
				{
					$this->__language = "portugese";
					break;
				}
				case "9":
				{
					$this->__language = "dutch";
					break;
				}
				case "10":
				{
					$this->__language = "norwegian";
					break;
				}
				case "11":
				{
					$this->__language = "swedish";
					break;
				}
				case "12":
				{
					$this->__language = "danish";
					break;
				}
				default:
				{
					$this->__language = "american";
					break;
				}
			}
		}

		function DisableInsertImageFromWeb()
		{
			$this->__hideWebImage = 1;
		}

		function DisableInsertFlashFromWeb()
		{
			$this->__hideWebFlash = 1;
		}

		function BuildSizeList()
		{
			?><option selected><?php echo sTxtSize; ?></option><?php

			if(sizeof($this->__fontSizeList) >= 1)
			{
				// Build the list of font sizes from the list that the user has specified
				for($i = 0; $i < sizeof($this->__fontSizeList); $i++)
				{
					?><option value="<?php echo trim($this->__fontSizeList[$i]); ?>"><?php echo trim($this->__fontSizeList[$i]); ?></option><?php
				}
			}
			else
			{
				// Build the list of font sizes manually
				?>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
				<?php
			}
		}

		function BuildFontList()
		{
			?><option selected><?php echo sTxtFont; ?></option><?php

			if(sizeof($this->__fontNameList) >= 1)
			{
				// Build the list of font names from the list that the user has specified
				for($i = 0; $i < sizeof($this->__fontNameList); $i++)
				{
?><option value="<?php echo trim($this->__fontNameList[$i]); ?>"><?php echo trim($this->__fontNameList[$i]); ?></option><?php
				}
			}
			else
			{
				// Build the list of font sizes manually
				?>
<option value="Times New Roman">Default</option>
<option value="Arial">Arial</option>
<option value="Verdana">Verdana</option>
<option value="Tahoma">Tahoma</option>
<option value="Courier New">Courier New</option>
<option value="Georgia">Georgia</option>
				<?php
			}
		}

		function SetFontList($FontList)
		{
			$tmpFontList = explode(",", $FontList);

			if(is_array($tmpFontList))
				$this->__fontNameList = $tmpFontList;
		}

		function SetFontSizeList($SizeList)
		{
			$tmpSizeList = explode(",", $SizeList);

			if(is_array($tmpSizeList))
				$this->__fontSizeList = $tmpSizeList;
		}

		// End Version 4.0 new functions
		
		function ShowControl($Width, $Height, $ImagePath)
		{
			global $DE_PATH;
			global $HTTPStr;
			global $DevEditPath;
			global $DevEditPath_Full;
			global $DevEditError;

			$this->SetWidth($Width);
			$this->SetHeight($Height);
			$this->__imagePath = $ImagePath;

			// Include the DevEdit language file
			//echo $DevEditPath_Full;exit;
			@include_once($DevEditPath_Full . "/de_lang/language.php");

			if($this->__controlName == "")
			{
				echo "<b>ERROR: Must set an DevEdit control name using the SetName() function</b>";
				die();
			}

			if(@$DevEditPath == "" && $ToDo != "FindReplace")
			{
			?>
<link rel="stylesheet" href="<?php echo @$_GET["DEP"]; ?>/de_includes/de_styles.css" type="text/css">
			<?php } else { ?>
<link rel="stylesheet" href="<?php echo $DevEditPath; ?>/de_includes/de_styles.css" type="text/css">
			<?php }

			// If the browser isn't IE5.5 or above, show a <textarea> tag and die
			if(!$this->isIE55OrAbove())
			{
			?>
<span style="background-color: lightyellow"><font face="verdana" size="1" color="red"><b>Your browser must be IE5.5 or above to display the DevEdit control. A plain text box will be displayed instead.</b></font></span><br>
<textarea style="width:<?php echo $this->__controlWidth; ?>; height:<?php echo $this->__controlHeight; ?>" rows="<?php echo $this->__textareaRows; ?>" cols="<?php echo $this->__textareaCols; ?>" name="<?php echo $this->__controlName; ?>_html"><?php echo str_replace("\\'", "'", $this->__initialValue); ?></textarea>
			<?php
			}
			else
			{
					// Output the hidden textarea buffer tag which will contain the iFrame source
					echo "<textarea style=display:none id='" . $this->__controlName . "_src'>";

					?><link rel="stylesheet" href="<?php echo $DevEditPath; ?>/de_includes/de_styles.css" type="text/css"><?php
					
					// Do we need to hide the page properties button?
        			if($this->__hideProps != 0 || $this->__docType == 0)
        				$this->HidePropertiesButton();
        
					// Workout the location of class.devedit.php
					$url = @$_SERVER["HTTP_HOST"];

					if(@$url == "")
						$url = @$_SERVER["SERVER_NAME"];

					$scriptName = str_replace("//", "/", $DevEditPath . "/class.devedit.php");
        			?>

					<?php if($this->__enableXHTMLSupport == 1) { ?>
<script language="JavaScript" src="<?php echo $DevEditPath; ?>/de_includes/de_xhtml_define.js" type="text/javascript"></script>
<script language="JavaScript" src="<?php echo $DevEditPath; ?>/de_includes/de_xhtml.js" type="text/javascript"></script>
					<?php } ?>

<script>
var customInserts = <?php echo $this->__FormatCustomInsertText(); ?>;
var customLinks = <?php echo $this->__FormatCustomLinkText(); ?>;
var tableDefault = <?php echo $this->__guidelinesOnByDefault; ?>;
var useBR = <?php echo $this->__useSingleLineReturn; ?>;
var useXHTML = "<?php echo $this->__enableXHTMLSupport; ?>";
var ContextMenuWidth = <?php echo sTxtContextMenuWidth; ?>;
var URL = "<?php echo $url; ?>";
var ScriptName = "<?php echo $scriptName; ?>";
var ScriptDir = "<?php echo $scriptDir; ?>";
var sTxtGuidelines = "<?php echo sTxtGuidelines; ?>";
var sTxtOn = "<?php echo sTxtOn; ?>";
var sTxtOff = "<?php echo sTxtOff; ?>";
var sTxtClean = "<?php echo sTxtClean; ?>";
var sTxtArticleSave = "<?php echo sTxtArticleSave; ?>";
// var re2 = /href="<?php echo $HTTPStr; ?>:\/\/<?php echo $url; ?>/g
var re3 = /src="<?php echo $HTTPStr; ?>:\/\/<?php echo $url; ?>/g
var re4 = /src="<?php echo $HTTPStr; ?>:\/\/<?php echo $url; ?>/g
var re5 = /src="http:\/\/<?php echo $url; ?>/g
var isEditingHTMLPage = <?php echo $this->__docType; ?>;
var pathType = <?php echo $this->__imagePathType; ?>;
var imageDir = "<?php echo $ImagePath; ?>";
var flashDir = "<?php echo $this->__flashPath; ?>";
var showThumbnails = <?php echo $this->__imageDisplayType; ?>;
var showFlashThumbnails = <?php echo $this->__flashDisplayType; ?>;
var disableImageUploading = <?php echo $this->__disableImageUploading; ?>;
var disableImageDeleting = <?php echo $this->__disableImageDeleting; ?>;
var disableFlashUploading = <?php echo $this->__disableFlashUploading; ?>;
var disableFlashDeleting = <?php echo $this->__disableFlashDeleting; ?>;
var HideWebImage = <?php echo $this->__hideWebImage; ?>;
var HideWebFlash = <?php echo $this->__hideWebFlash; ?>;
var HTTPStr = "<?php echo $HTTPStr; ?>";
var spellLang = "<?php echo $this->__language; ?>";
var controlName = "<?php echo $this->__controlName; ?>_frame";
var imageLibs = '<?php echo $this->GetImageLibraries(); ?>';
var flashLibs = '<?php echo $this->GetFlashLibraries(); ?>';
var myBaseHref = '<?php echo $this->__baseHref; ?>';
var deveditPath = '<?php echo $DevEditPath_Full; ?>';
var deveditPath1 = '<?php echo $DevEditPath; ?>';
var AdminPath = '<?php echo $this->AdminPath; ?>';
var sId = '<?php echo $this->sId; ?>';

</script>

<script>
<?php DisplayIncludes("enc_functions.js","Javascript Functions"); ?>
</script>

<script language="JavaScript" src="<?php echo $DevEditPath; ?>/de_includes/de_functions.js" type="text/javascript"></script>
<script language="JavaScript" src="<?php echo $DevEditPath; ?>/de_includes/icms_functions.js" type="text/javascript"></script>

<!-- modified for v5.0 -->
<span id="fooContainer" style="width:100%; border:1px ridge">

<?php @include($DevEditPath_Full . "/de_includes/toolbar.php"); ?>
        
<!-- removed security=restricted to allow Flash insertion -->
<span id=divContainer style="width:100%" class=divContainer>
<iFrame onBlur="updateValue()" contenteditable id="foo" name="foo" src='' style="width:100%; border: 0px solid #D4D0C8"></iFrame>
<iFrame id="fooStyles" src='' style="display:none"></iFrame>
<iframe onBlur="updateValue()" id=previewFrame height=80% style="width=100%; display:none" style="border: 0px solid #D4D0C8"></iframe>
</span>

<script>
document.getElementById("foo").style.setExpression("height", "document.body.clientHeight - 85")
document.getElementById("previewFrame").style.setExpression("height", "document.body.clientHeight - 59")
</script>
<table cellpadding=0 cellspacing=0 width=100% style="background-color: threedface">
<tr>
<td height=22><img style="cursor:hand;" id=editTab src=<?php echo $DevEditPath; ?>/de_images/status_edit_up.gif width=98 height=22 border=0 onClick=editMe()><img style="cursor:hand; <?php if($this->__disableSourceMode == true) { ?>display:none<?php } ?>" id=sourceTab src=<?php echo $DevEditPath; ?>/de_images/status_source.gif width=98 height=22 border=0 onClick=sourceMe()><img style="cursor:hand; <?php if($this->__disablePreviewMode == true) { ?>display:none<?php } ?>" id=previewTab src=<?php echo $DevEditPath; ?>/de_images/status_preview.gif width=98 height=22 border=0 onClick=previewMe()></td><td width=100%  height=22 background=<?php echo $DevEditPath; ?>/de_images/status_border.gif>&nbsp;</td><td background=<?php echo $DevEditPath; ?>/de_images/status_border.gif id=statusbar align=right valign=bottom><img src=<?php echo $DevEditPath; ?>/de_images/button_zoom.gif width=42 height=17 valign=bottom onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" class=toolbutton onClick="showMenu('zoomMenu',65,178)"></td>
</tr>
</table>
</span>
<!--{{{ Add by Hawking(Fixed HTML tags lost bug) -->
<div id="div_initialValue" style="display:none">
<?=htmlspecialchars(htmlspecialchars($this->__initialValue))?>
</div>

<div id="div_initialValueNoBase" style="display:none">
<?=htmlspecialchars(htmlspecialchars($this->__initialValueNoBase))?>
</div>

<!--Add by Hawking(Fixed HTML tags lost bug) }}}-->


<!-- end mod -->
<script language="JavaScript">
var fooWidth = "<?php echo $this->__controlWidth; ?>";
var fooHeight = "<?php echo $this->__controlHeight; ?>";
function setValue()
{
//	alert(test_initialValueNoBase.value);
foo.document.write(div_initialValue.innerText)	;
div_initialValue.innerHTML = "";

foo.document.close();

fooStyles.document.write(div_initialValueNoBase.innerText)	;
div_initialValueNoBase.innerHTML = "";

fooStyles.document.close();
}
function updateValue(isSave)
{ 
 if (document.activeElement) {
  if ((document.activeElement.parentElement.id == "de") && (!isSave)) {
   return false;
  } else {
   if (parent.document.all.<?php echo $this->__controlName; ?>_html != null) {
	parent.document.all.<?php echo $this->__controlName; ?>_html.value = SaveHTMLPage();
   }
  }
 }
}
</script>

</textarea>
<iframe id="<?php echo $this->__controlName; ?>_frame" width="<?php echo $this->__controlWidth; ?>" height="<?php echo $this->__controlHeight; ?>" frameborder=0 scrolling=no></iframe>
<input type="hidden" name="<?php echo $this->__controlName; ?>_html">
<input type="hidden" name="<?php echo $this->__controlName; ?>_ImgAutoLocalize" value=0>

<script language="JavaScript">
<?php if ($DevEditError == true) { ?>
<?php echo $this->__controlName;?>_frame.document.write("<b>Error:</b> The value you have specified for the setDevEditPath function is invalid.")
<?php echo $this->__controlName;?>_frame.document.close()
</script>
<?php die();
	}
?>
<?php echo $this->__controlName; ?>_frame.document.write(document.getElementById("<?php echo $this->__controlName; ?>_src").value)
<?php echo $this->__controlName; ?>_frame.document.close()
<?php echo $this->__controlName; ?>_frame.document.body.style.margin = "0px";
setTimeout("doMyWidth();",100);
function doMyWidth() {
	minWidth = 0
	if (<?php echo $this->__controlName; ?>_frame.document.getElementById("toolbar1").clientWidth > <?php echo $this->__controlName; ?>_frame.document.getElementById("toolbar2").clientWidth)
		minWidth = <?php echo $this->__controlName; ?>_frame.document.getElementById("toolbar1").clientWidth
	else
		minWidth = <?php echo $this->__controlName; ?>_frame.document.getElementById("toolbar2").clientWidth

	document.getElementById("<?php echo $this->__controlName; ?>_frame").style.setExpression("width", "setFrameWidth_<?php echo $this->__controlName; ?>()")
}

function setFrameWidth_<?php echo $this->__controlName; ?> () {

frame_offsetLeft = document.getElementById("<?php echo $this->__controlName; ?>_frame").offsetLeft

	if (document.body.clientWidth > minWidth) {
		if ("<?php echo $this->__controlWidth; ?>".indexOf('%') > -1) {

			if (parseInt("<?php echo $this->__controlWidth; ?>") / 100 * document.body.clientWidth < (minWidth + frame_offsetLeft + 11))
				return minWidth + 2
			else
				return "<?php echo $this->__controlWidth; ?>"

		} else {

			if (parseInt("<?php echo $this->__controlWidth; ?>") < minWidth + 2)
				return minWidth + 2
			else
				return "<?php echo $this->__controlWidth; ?>"
		}

	} else {
		return minWidth + 2
	}
}
</script>

<?php
			}
		}
	}
?>