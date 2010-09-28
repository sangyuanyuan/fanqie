<table width="100%" cellspacing="0" cellpadding="0" class=toolbar>
<tr>
<td class="body" height="24">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hide" align="center" id="toolbar_preview">
<tr>
  <td class="body" height="24">
  &nbsp;<img src="<?php echo $DevEditPath; ?>/de_images/popups/preview.gif" width="21" height="20" align=absmiddle>&nbsp;<?php echo sTxtHelpPModeTitle; ?>
  </td>
 </tr>
</table>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="hide" align="center" id="toolbar_code">
<tr>
  <td class="body" height="22">
  <table border="0" cellspacing="0" cellpadding="1">
  <tr id=de>
<?php if($this->__hideSave != true) { ?>
<td>
<img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_save.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='saveDevEdit();' title="<?php echo sTxtSave; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideFullScreen != true) { ?>
<td>
<img id=fullscreen2 border="0" src="<?php echo $DevEditPath; ?>/de_images/button_fullscreen.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='toggleSize();foo.focus();' title="<?php echo sTxtFullscreen; ?>" class=toolbutton></td>
<?php } ?>
<td>
  <img border="0" disabled id="toolbarCut2_off" src="<?php echo $DevEditPath; ?>/de_images/button_cut_disabled.gif" width="21" height="20" title="<?php echo sTxtCut; ?> (Ctrl+X)" class=toolbutton><img border="0" id="toolbarCut2_on" src="<?php echo $DevEditPath; ?>/de_images/button_cut.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("Cut");foo.focus();' title="<?php echo sTxtCut; ?> (Ctrl+X)" class=toolbutton style="display:none"></td>
<td>
  <img border="0" disabled id="toolbarCopy2_off" src="<?php echo $DevEditPath; ?>/de_images/button_copy_disabled.gif" width="21" height="20" title="<?php echo sTxtCopy; ?> (Ctrl+C)" class=toolbutton><img border="0" id="toolbarCopy2_on" src="<?php echo $DevEditPath; ?>/de_images/button_copy.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("Copy");foo.focus();' title="<?php echo sTxtCopy; ?> (Ctrl+C)" class=toolbutton style="display:none"></td>
<td>
  <img border="0" disabled id="toolbarPasteButton2_off" src="<?php echo $DevEditPath; ?>/de_images/button_paste_disabled.gif" width="21" height="20" title="<?php echo sTxtPaste; ?> (Ctrl+V)" class=toolbutton><img border="0" id="toolbarPasteButton2_on" src="<?php echo $DevEditPath; ?>/de_images/button_paste.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("Paste");foo.focus();' title="<?php echo sTxtPaste; ?> (Ctrl+V)" class=toolbutton style="display:none"></td>
<td>
  <img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_find.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='ShowFindDialog();foo.focus();' title="<?php echo sTxtFindReplace; ?>" class=toolbutton></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<td>
  <img border="0" disabled id="undo2_off" src="<?php echo $DevEditPath; ?>/de_images/button_undo_disabled.gif" width="21" height="20" title="<?php echo sTxtUndo; ?> (Ctrl+Z)" class=toolbutton><img border="0" id="undo2_on" src="<?php echo $DevEditPath; ?>/de_images/button_undo.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("Undo");' title="<?php echo sTxtUndo; ?> (Ctrl+Z)" class=toolbutton style="display:none"></td>
<td>
  <img border="0" disabled id="redo2_off" src="<?php echo $DevEditPath; ?>/de_images/button_redo_disabled.gif" width="21" height="20" title="<?php echo sTxtRedo; ?> (Ctrl+Y)" class=toolbutton><img border="0" id="redo2_on" src="<?php echo $DevEditPath; ?>/de_images/button_redo.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("Redo");' title="<?php echo sTxtRedo; ?> (Ctrl+Y)" class=toolbutton style="display:none"></td>
</tr>
</table>
  </td>
 </tr>
<tr>
  <td class="body" bgcolor="#808080"><img src="<?php echo $DevEditPath; ?>/de_images/1x1.gif" width="1" height="1"></td>
</tr>
<tr>
  <td class="body" bgcolor="#FFFFFF"><img src="<?php echo $DevEditPath; ?>/de_images/1x1.gif" width="1" height="1"></td>
</tr>
 <tr><td height=24>&nbsp;</td></tr>
</table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="bevel3" align="center" id="toolbar_full">
<tr>
  <td class="body" height="22">
<table border="0" cellspacing="0" cellpadding="1" id=toolbar1>
  <tr id=de>
<?php if($this->__hideSave != true) { ?>
<td>
<img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_save.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='saveDevEdit();' title="<?php echo sTxtSave; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideFullScreen != true) { ?>
<td>
<img id=fullscreen border="0" src="<?php echo $DevEditPath; ?>/de_images/button_fullscreen.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='toggleSize();foo.focus();' title="<?php echo sTxtFullscreen; ?>" class=toolbutton></td>
<?php } ?>
<td>
<img border="0" disabled id="toolbarCut_off" src="<?php echo $DevEditPath; ?>/de_images/button_cut_disabled.gif" width="21" height="20" title="<?php echo sTxtCut; ?> (Ctrl+X)" class=toolbutton><img border="0" id="toolbarCut_on" src="<?php echo $DevEditPath; ?>/de_images/button_cut.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("Cut");foo.focus();' title="<?php echo sTxtCut; ?> (Ctrl+X)" class=toolbutton style="display:none"></td>
<td>
<img border="0" disabled id="toolbarCopy_off" src="<?php echo $DevEditPath; ?>/de_images/button_copy_disabled.gif" width="21" height="20" title="<?php echo sTxtCopy; ?> (Ctrl+C)" class=toolbutton><img border="0" id="toolbarCopy_on" src="<?php echo $DevEditPath; ?>/de_images/button_copy.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("Copy");foo.focus();' title="<?php echo sTxtCopy; ?> (Ctrl+C)" class=toolbutton style="display:none"></td>
<td>
<img id=toolbarPasteButton_off disabled class=toolbutton width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_paste_disabled.gif" border=0 unselectable="on" title="<?php echo sTxtPaste; ?> (Ctrl+V)"><img id=toolbarPasteButton_on class=toolbutton onMouseDown="button_down(this);" onMouseOver="button_over(this); button_over(toolbarPasteDrop_on)" onClick="doCommand('Paste'); foo.focus()" onMouseOut="button_out(this); button_out(toolbarPasteDrop_on);" width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_paste.gif" border=0 unselectable="on" title="<?php echo sTxtPaste; ?> (Ctrl+V)" style="display:none"><img id=toolbarPasteDrop_off disabled class=toolbutton width="7" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_drop_menu_disabled.gif" border=0 unselectable="on"><img id=toolbarPasteDrop_on class=toolbutton onMouseDown="button_down(this);" onMouseOver="button_over(this); button_over(toolbarPasteButton_on)" onClick="showMenu('pasteMenu',180,42)" onMouseOut="button_out(this); button_out(toolbarPasteButton_on);" width="7" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_drop_menu.gif" border=0 unselectable="on" style="display:none"></td>
<td>
  <img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_find.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='ShowFindDialog();foo.focus();' title="<?php echo sTxtFindReplace; ?>" class=toolbutton></td>
<td>
<img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<td>
<img id="undo_off" disabled UNSELECTABLE="on" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_undo_disabled.gif" width="21" height="20" title="<?php echo sTxtUndo; ?> (Ctrl+Z)" class=toolbutton><img id="undo_on" UNSELECTABLE="on" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_undo.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='goHistory(-1);' title="<?php echo sTxtUndo; ?> (Ctrl+Z)" class=toolbutton style="display:none"></td>
<td>
<img id="redo_off" disabled UNSELECTABLE="on" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_redo_disabled.gif" width="21" height="20" title="<?php echo sTxtRedo; ?> (Ctrl+Y)" class=toolbutton><img id="redo_on" UNSELECTABLE="on" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_redo.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='goHistory(1);' title="<?php echo sTxtRedo; ?> (Ctrl+Y)" class=toolbutton style="display:none"></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>

<?php if($this->__hideSpelling != true) { ?>
<td>
<img id="toolbarSpell" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_spellcheck.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='spellCheck();' title="<?php echo sTxtCheckSpelling; ?> (F7)" class=toolbutton></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>

<?php if($this->__hideRemoveTextFormatting != true) { ?>
<td>
<img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_remove_format.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("RemoveFormat");' title="<?php echo sTxtRemoveFormatting; ?>" class=toolbutton></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>
<?php if($this->__hideBold != true) { ?>
<td>
<img id="fontBold" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_bold.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("Bold");foo.focus();' title="<?php echo sTxtBold; ?> (Ctrl+B)" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideUnderline != true) { ?>
<td>
<img id="fontUnderline" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_underline.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("Underline");foo.focus();' title="<?php echo sTxtUnderline; ?> (Ctrl+U)" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideItalic != true) { ?>
<td>
<img id="fontItalic" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_italic.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("Italic");foo.focus();' title="<?php echo sTxtItalic; ?> (Ctrl+I)" class=toolbutton></td>
<?php } ?>

<?php if($this->__hideStrikethrough != true) { ?>
<td>
<img id="fontStrikethrough" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_strikethrough.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("Strikethrough");foo.focus();' title="<?php echo sTxtStrikethrough; ?>" class=toolbutton></td>
<?php } ?>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>

<?php if($this->__hideNumberList != true) { ?>
<td>
<img id="fontInsertOrderedList" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_numbers.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("InsertOrderedList");foo.focus();' title="<?php echo sTxtNumList; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideBulletList != true) { ?>
<td>
<img id="fontInsertUnorderedList" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_bullets.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("InsertUnorderedList");foo.focus();' title="<?php echo sTxtBulletList; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideDecreaseIndent != true) { ?>
<td>
<img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_decrease_indent.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("Outdent");foo.focus();' title="<?php echo sTxtDecreaseIndent; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideIncreaseIndent != true) { ?>
<td>
<img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_increase_indent.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("Indent");foo.focus();' title="<?php echo sTxtIncreaseIndent; ?>" class=toolbutton></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>
<?php if($this->__hideSuperScript != true) { ?>
<td>
<img id="fontSuperScript" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_superscript.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("superscript");foo.focus();' title="<?php echo sTxtSuperscript; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideSubScript != true) { ?>
<td>
<img id="fontSubScript" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_subscript.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("subscript");foo.focus();' title="<?php echo sTxtSubscript; ?>" class=toolbutton></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>
<?php if($this->__hideLeftAlign != true) { ?>
<td>
<img id="fontJustifyLeft" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_align_left.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("JustifyLeft");foo.focus();' title="<?php echo sTxtAlignLeft; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideCenterAlign != true) { ?>
<td>
<img id="fontJustifyCenter" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_align_center.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("JustifyCenter");foo.focus();' title="<?php echo sTxtAlignCenter; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideRightAlign != true) { ?>
<td>
<img id="fontJustifyRight" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_align_right.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("JustifyRight");foo.focus();' title="<?php echo sTxtAlignRight; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideJustify != true) { ?>
<td>
<img id="fontJustifyFull" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_align_justify.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out2(this);" onmousedown="button_down(this);" onClick='doCommand("JustifyFull");foo.focus();' title="<?php echo sTxtAlignJustify; ?>" class=toolbutton></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>
<?php if ($this->Libtype != '99999999' && $this->__hideHelp != true) { ?>
<td>
<img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_help.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doHelp()' title="<?php echo sTxtHelp; ?>" class=toolbutton></td>
<?php } ?>

<td class="body"><INPUT TYPE="checkbox" NAME="<?php echo $this->__controlName; ?>_ImgAutoLocalize" id="<?php echo $this->__controlName; ?>_ImgAutoLocalize" value='0' onclick="enableImgAutoLocalize(this)" ><label for="<?php echo $this->__controlName; ?>_ImgAutoLocalize"><?php echo sTxtImgLocalize; ?></label>
<script language="JavaScript">
function enableImgAutoLocalize(element)
{
	if(element.checked) {
		parent.FM.<?php echo $this->__controlName; ?>_ImgAutoLocalize.value = '1';
	
	} else {
		parent.FM.<?php echo $this->__controlName; ?>_ImgAutoLocalize.value = '0';
	
	}
}
</script>
</td>
 
  </tr>
</table>
  </td>
</tr>
<tr>
  <td class="body" bgcolor="#808080"><img src="<?php echo $DevEditPath; ?>/de_images/1x1.gif" width="1" height="1"></td>
</tr>
<tr>
  <td class="body" bgcolor="#FFFFFF"><img src="<?php echo $DevEditPath; ?>/de_images/1x1.gif" width="1" height="1"></td>
</tr>
<tr>
  <td class="body" height=22>
  <table border="0" cellspacing="0" cellpadding="1" id="toolbar2">
  <tr id=de>
<?php if($this->__hideFont != true) { ?>
<td>
  <select id="fontDrop" onChange="doFont(this[this.selectedIndex].value)" class="Text120" style="border:3px solid #FFFFFF" unselectable="on">
<?php echo $this->BuildFontList(); ?>
  </select></td>
<?php } ?>
<?php if($this->__hideSize != true) { ?>
<td>
  <select id="sizeDrop" onChange="doSize(this[this.selectedIndex].value)" class=Text50 unselectable="on">
<?php echo $this->BuildSizeList(); ?>
  </select></td>
<?php } ?>
<?php if($this->__hideFormat != true) { ?>
<td>
  <select id="formatDrop" onChange="doFormat(this[this.selectedIndex].value)" class="Text70" unselectable="on">
<option selected><?php echo sTxtFormat; ?>
<option value="<P>">Normal
<option value="<H1>">Heading 1
<option value="<H2>">Heading 2
<option value="<H3>">Heading 3
<option value="<H4>">Heading 4
<option value="<H5>">Heading 5
<option value="<H6>">Heading 6
  </select></td>
<?php } ?>
<?php if($this->__hideStyle != true) { ?>
<td>
  <select id="sStyles" onChange="applyStyle(this[this.selectedIndex].value);foo.focus();this.selectedIndex=0;foo.focus();" class="Text90" unselectable="on" onmouseenter="doStyles()">
<option selected><?php echo sTxtStyle; ?></option>
<option value=""><?php echo sTxtNone; ?></option>
  </select></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>
<?php if($this->__hideForeColor != true) {

// Is the user on an XP machine?
$xp = "";

if(is_numeric(strpos($_SERVER["HTTP_USER_AGENT"], "Windows NT 5.1")))
$xp = "_xp";
elseif(is_numeric(strpos($_SERVER["HTTP_USER_AGENT"], "Windows 98")))
$xp = "_98";

?>
<?php if($this->__hideLink != true) { ?>
<td>
<img disabled id="toolbarLink_off" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_link_disabled.gif" width="21" height="20" title="<?php echo sTxtHyperLink; ?>" class=toolbutton><img id="toolbarLink_on" border="0" src="<?php echo $DevEditPath; ?>/de_images/button_link.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doLink()' title="<?php echo sTxtHyperLink; ?>" class=toolbutton style="display:none"></td>
<?php } ?>
<?php if($this->__hideMailLink != true) { ?>
<td>
<img border="0" id="toolbarEmail_off" disabled src="<?php echo $DevEditPath; ?>/de_images/button_email_disabled.gif" width="21" height="20" title="<?php echo sTxtEmail; ?>" class=toolbutton><img border="0" id="toolbarEmail_on" src="<?php echo $DevEditPath; ?>/de_images/button_email.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doEmail()' title="<?php echo sTxtEmail; ?>" class=toolbutton style="display:none"></td>
<?php } ?>
<?php if($this->__hideAnchor != true) { ?>
<td>
<img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_anchor.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doAnchor()' title="<?php echo sTxtAnchor; ?>" class=toolbutton></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>
<td><span id=fontColor><img id=toolbarFont border="0" src="<?php echo $DevEditPath; ?>/de_images/button_font_color<?php echo $xp; ?>.gif" width="21" height="20" onmouseover="button_over(this);  button_over(toolbarFontdrop)" onmouseout="button_out(this); button_out(toolbarFontdrop)" onmousedown="button_down(this);" onClick="(isAllowed()) ? doColorDirectly(1) : foo.focus()" class=toolbutton title="<?php echo sTxtColour; ?>"></span><img id=toolbarFontdrop class=toolbutton onMouseDown="button_down(this);" onMouseOver="button_over(this); button_over(toolbarFont)" onClick="(isAllowed()) ? showMenu('colorMenu',157,158) : foo.focus()" onMouseOut="button_out(this); button_out(toolbarFont);" width="7" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_drop_menu.gif" border=0 unselectable="on"></td>
<?php } ?>
<?php if($this->__hideBackColor != true) { ?>
<td><span id=fontHighlight><img id=toolbarHighlight border="0" src="<?php echo $DevEditPath; ?>/de_images/button_highlight<?php echo $xp; ?>.gif" width="21" height="20" onmouseover="button_over(this);  button_over(toolbarHighlightdrop)" onmouseout="button_out(this); button_out(toolbarHighlightdrop)" onmousedown="button_down(this);" onClick="(isAllowed()) ? doColorDirectly(2) : foo.focus()" class=toolbutton title="<?php echo sTxtBackColour; ?>"></span><img id=toolbarHighlightdrop class=toolbutton onMouseDown="button_down(this);" onMouseOver="button_over(this); button_over(toolbarHighlight)" onClick="(isAllowed()) ? showMenu('colorMenu2',157,158) : foo.focus()" onMouseOut="button_out(this); button_out(toolbarHighlight);" width="7" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_drop_menu.gif" border=0 unselectable="on"></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>
<?php if($this->__hideTable != true) { ?>
<td id=toolbarTables>
  <img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_table_down.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick="(isAllowed()) ? showMenu('tableMenu',160,262) : foo.focus()" class=toolbutton title="<?php echo sTxtTableFunctions; ?>"></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>
<?php if($this->__hideForm != true) { ?>
<td>
  <img class=toolbutton onMouseDown=button_down(this); onMouseOver=button_over(this); onClick="(isAllowed()) ? showMenu('formMenu',180,210) : foo.focus()" onMouseOut=button_out(this); type=image width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_form_down.gif" border=0 title="<?php echo sTxtFormFunctions; ?>"></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>

<?php if($this->__hideFlash != true) { ?>
<td>
  <img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_flash.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick="(isAllowed()) ? showMenu('mediaMenu',100,180) : foo.focus()" class=toolbutton title="<?php echo sTxtFlash; ?>"></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<?php } ?>

<?php if($this->__hideImage != true) { ?>
<td>
  <img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_image.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick="(isAllowed()) ? showMenu('imageMenu',100,72) : foo.focus()" class=toolbutton title="<?php echo sTxtImage; ?>"></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td>
<!--td>
  <img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_image.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick="doImage()" class=toolbutton title="<?php echo sTxtImage; ?>"></td>
<td><img src="<?php echo $DevEditPath; ?>/de_images/seperator.gif" width="2" height="21"></td-->
<?php } ?>
<?php if($this->__hideTextBox != true) { ?>
<td>
  <img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_textbox.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick="doTextbox()" class=toolbutton title="<?php echo sTxtTextbox; ?>"></td>
<?php } ?>
 <?php if($this->__hideHorizontalRule != true) { ?>
<td>
<img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_hr.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick='doCommand("InsertHorizontalRule");foo.focus();' title="<?php echo sTxtInsertHR; ?>" class=toolbutton></td>
<?php } ?>
<?php if($this->__hideSymbols != true) { ?>
<td>
  <img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_chars.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick="doChars()" class=toolbutton title="<?php echo sTxtChars; ?>"></td>
<?php } ?>
<?php if($this->__hideProps != true) { ?>
<td>
  <img border="0" src="<?php echo $DevEditPath; ?>/de_images/button_properties.gif" width="21" height="20" onmouseover="button_over(this);" onmouseout="button_out(this);" onmousedown="button_down(this);" onClick="ModifyProperties()" class=toolbutton title="<?php echo sTxtPageProperties; ?>"></td>
<?php } ?>

<?php if($this->__hideClean != true) { ?>
<td>
  <img class=toolbutton onmousedown="button_down(this);" onmouseover="button_over(this);" onClick="cleanCode()" onmouseout="button_out(this);" type=image width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_clean_code.gif" border=0 title="<?php echo sTxtCleanCode; ?>"></td>
<?php } ?>

<?php if($this->__hasCustomInserts == true) { ?>
<td>
<img class=toolbutton onmousedown="button_down(this);" onmouseover="button_over(this);" onClick="doCustomInserts()" onmouseout="button_out(this);" type=image width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_custom_inserts.gif" border=0 title="<?php echo sTxtCustomInserts; ?>"></td>
<?php } ?>

<?php if($this->__hideAbsolute != true) { ?>
<td>
<img id="fontAbsolutePosition_off" disabled class=toolbutton onmousedown="button_down(this);" onmouseover="button_over(this);" width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_absolute_disabled.gif" border=0 title="<?php echo sTxtTogglePosition; ?>"><img id="fontAbsolutePosition" class=toolbutton onmousedown="button_down(this);" onmouseover="button_over(this);" onClick="doCommand('AbsolutePosition')" onmouseout="button_out2(this);" type=image width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_absolute.gif" border=0 title="<?php echo sTxtTogglePosition; ?>" style="display:none"></td>
<?php } ?>

<?php if($this->__hideGuidelines != true) { ?>
<td>
  <img class=toolbutton onMouseDown="button_down(this);" onMouseOver="button_over(this);" onClick="toggleBorders()" onMouseOut="button_out2(this);" type=image width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_show_borders.gif" border=0 title="<?php echo sTxtToggleGuidelines; ?>" id=guidelines></td>
<?php } ?>
<td>
<!--<td><img class=toolbutton onmousedown="button_down(this);" onmouseover="button_over(this);" onClick="doArticle()" onmouseout="button_out(this);" type=image width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_article.gif" border=0 title="<?php echo sTxtArticle; ?>"></td>-->
<div class="pasteArea" id="myTempArea" contentEditable></div></td>
  </tr>
</table>
  </td>
</tr>
  </table>
</td>
  </tr> 
</table>
<!-- table menu -->
<DIV ID="tableMenu" STYLE="display:none">
<table border="0" cellspacing="0" cellpadding="0" width=160 style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: buttonshadow 2px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: buttonshadow 1px solid;" bgcolor="threedface">
  <tr onClick="parent.ShowInsertTable()" title="<?php echo sTxtTable; ?>" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" height=20> 
  &nbsp;&nbsp;<?php echo sTxtTable; ?>...&nbsp; </td>
  </tr>
  <tr onClick=parent.ModifyTable(); title="<?php echo sTxtTableModify; ?>" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" height=20 id=modifyTable> 
  &nbsp;&nbsp;<?php echo sTxtTableModify; ?>...&nbsp;</td>
  </tr>
  <tr title="<?php echo sTxtCellModify; ?>" onClick=parent.ModifyCell() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" height=20 id=modifyCell> 
&nbsp;&nbsp;<?php echo sTxtCellModify; ?>...&nbsp; </td>
  </tr>
  <tr height=10> 
<td align=center><img src="<?php echo $DevEditPath; ?>/de_images/vertical_spacer.gif" width="140" height="2"></td>
  </tr>
  <tr title="<?php echo sTxtInsertColA; ?>" onClick=parent.InsertColAfter() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=20 id=colAfter> 
  &nbsp;&nbsp;<?php echo sTxtInsertColA; ?>&nbsp;
</td>
  </tr>
  <tr title="<?php echo sTxtInsertColB; ?>" onClick=parent.InsertColBefore() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=20 id=colBefore> 
  &nbsp;&nbsp;<?php echo sTxtInsertColB; ?>&nbsp;
</td>
  </tr>
  <tr height=10> 
<td align=center><img src="<?php echo $DevEditPath; ?>/de_images/vertical_spacer.gif" width="140" height="2"></td>
  </tr>
  <tr title="<?php echo sTxtInsertRowA; ?>" onClick=parent.InsertRowAbove() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=20 id=rowAbove> 
  &nbsp;&nbsp;<?php echo sTxtInsertRowA; ?>&nbsp;
</td>
  </tr>
  <tr title="<?php echo sTxtInsertRowB; ?>" onClick=parent.InsertRowBelow() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=20 id=rowBelow> 
  &nbsp;&nbsp;<?php echo sTxtInsertRowB; ?>&nbsp;
</td>
  </tr>
  <tr height=10> 
<td align=center><img src="<?php echo $DevEditPath; ?>/de_images/vertical_spacer.gif" width="140" height="2"></td>
  </tr>
  <tr title="<?php echo sTxtDeleteRow; ?>" onClick=parent.DeleteRow() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=20 id=deleteRow>
  &nbsp;&nbsp;<?php echo sTxtDeleteRow; ?>&nbsp;
</td>
  </tr>
  <tr title="<?php echo sTxtDeleteCol; ?>" onClick=parent.DeleteCol() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=20 id=deleteCol>
  &nbsp;&nbsp;<?php echo sTxtDeleteCol; ?>&nbsp;
</td>
  </tr>
  <tr height=10> 
<td align=center><img src="<?php echo $DevEditPath; ?>/de_images/vertical_spacer.gif" width="140" height="2" tabindex=1 HIDEFOCUS></td>
  </tr>
  <tr title="<?php echo sTxtIncreaseColSpan; ?>" onClick=parent.IncreaseColspan() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=20 id=increaseSpan>
  &nbsp;&nbsp;<?php echo sTxtIncreaseColSpan; ?>&nbsp;
</td>
  </tr>
  <tr title="<?php echo sTxtDecreaseColSpan; ?>" onClick=parent.DecreaseColspan() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=20 id=decreaseSpan>
  &nbsp;&nbsp;<?php echo sTxtDecreaseColSpan; ?>&nbsp;
</td>
  </tr>
</table>
</div>
<!-- end table menu -->

<!-- form menu -->
<DIV ID="formMenu" STYLE="display:none;">
<table border="0" cellspacing="0" cellpadding="0" width=180 style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: buttonshadow 2px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: buttonshadow 1px solid;" bgcolor="threedface">
  <tr title="<?php echo sTxtForm; ?>" onClick=parent.insertForm() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22>
  <img width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_form.gif" border=0 align="absmiddle">&nbsp;<?php echo sTxtForm; ?>...&nbsp;</td>
  </tr>
  <tr title="<?php echo sTxtFormModify; ?>" onClick=parent.modifyForm() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" id="modifyForm1" height=22 class=dropDown>
  <img id="modifyForm2" width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_modify_form.gif" border=0 align="absmiddle">&nbsp;<?php echo sTxtFormModify; ?>...&nbsp;</td>
  </tr>
  <tr height=10> 
<td align=center><img src="<?php echo $DevEditPath; ?>/de_images/vertical_spacer.gif" width="140" height="2" tabindex=1 HIDEFOCUS></td>
  </tr>
  <tr title="<?php echo sTxtTextField; ?>" onClick=parent.doTextField() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22>
  <img width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_textfield.gif" border=0 align="absmiddle">&nbsp;<?php echo sTxtTextField; ?>...&nbsp;</td>
  </tr>
  <tr title="<?php echo sTxtTextArea; ?>" onClick=parent.doTextArea() onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=22>
  <img type=image width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_textarea.gif" border=0 align="absmiddle">&nbsp;<?php echo sTxtTextArea; ?>...&nbsp;</td>
  </tr>
  <tr title="<?php echo sTxtHidden; ?>" onClick=parent.doHidden(); onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
<td style="cursor: hand; font:8pt tahoma;" height=22>
  <img width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_hidden.gif" border=0 align="absmiddle">&nbsp;<?php echo sTxtHidden; ?>...&nbsp;</td>
  </tr>
  <tr title="<?php echo sTxtButton; ?>" onClick=parent.doButton(); onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22>
  <img width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_button.gif" border=0 align="absmiddle">&nbsp;<?php echo sTxtButton; ?>...&nbsp;</td>
  </tr>
  <tr title="<?php echo sTxtCheckbox; ?>" onClick=parent.doCheckbox(); onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22>
  <img width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_checkbox.gif" border=0 align="absmiddle">&nbsp;<?php echo sTxtCheckbox; ?>...&nbsp;</td>
  </tr>
  <tr title="<?php echo sTxtRadioButton; ?>" onClick=parent.doRadio(); onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22>
  <img width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_radio.gif" border=0 align="absmiddle">&nbsp;<?php echo sTxtRadioButton; ?>...&nbsp;</td>
  </tr>
  <tr title="<?php echo sTxtSelect; ?>" onClick=parent.doSelect(); onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22>
  <img width="21" height="20" src="<?php echo $DevEditPath; ?>/de_images/button_select.gif" border=0 align="absmiddle">&nbsp;<?php echo sTxtSelect; ?>...&nbsp;</td>
  </tr>
</table>
</div>
<!-- formMenu -->


<!-- image menu -->
<DIV ID="imageMenu" STYLE="display:none;">
<table border="0" cellspacing="0" cellpadding="3" width="98" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.doImageInsert();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtImageInsert1; ?>...&nbsp;</td>
  </tr>
  <tr onClick ='parent.doImagesUpload(); parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtImagesUpload; ?>...&nbsp;</td>
  </tr>
  <tr onClick ='parent.doImagesList(); parent.oPopup2.hide();'> 
   <td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtImagesList; ?>...&nbsp;</td>
  </tr>
</table>
<!--<table border="0" cellspacing="0" cellpadding="3" width="98" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.doIncludeImages(); parent.oPopup2.hide();'> 
   <td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtIncludeImages; ?>...&nbsp;</td>
  </tr>
</table>-->
</div>
<!-- imageMenu -->

<!-- mediaMenu -->

<DIV ID="mediaMenu" STYLE="display:none;">
<table border="0" cellspacing="0" cellpadding="3" width="110" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">

  <tr onClick ='parent.doFlashUpload();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtFlashUpload; ?>...&nbsp;</td>
  </tr>
   <tr onClick ='parent.doFlashInsert();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtFlashInsert; ?>...&nbsp;</td>
  </tr>

  <tr onClick ='parent.doAttachUpload();  parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtAttachUpload; ?>...&nbsp;</td>
  </tr>
   <tr onClick ='parent.doAttachInsert();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtAttachInsert; ?>...&nbsp;</td>
  </tr>


  <tr onClick ='parent.doVideoInsert(); parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtVideoInsert; ?>...&nbsp;</td>
  </tr>
  <tr onClick ='parent.doMusicInsert(); parent.oPopup2.hide();'> 
   <td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtMusicInsert; ?>...&nbsp;</td>
  </tr>
</table>

</div>
<!-- mediaMenu -->


<!-- zoom menu -->
<DIV ID="zoomMenu" STYLE="display:none;">
<table border="0" cellspacing="0" cellpadding="0" width=65 style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: buttonshadow 2px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: buttonshadow 1px solid;" bgcolor="threedface">
  <tr onClick=parent.doZoom(500) onMouseOver="parent.contextHilite(this); parent.toggleTick(zoom500_,1);" onMouseOut="parent.contextDelite(this); parent.toggleTick(zoom500_,0);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22 id="zoom500_">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;500%&nbsp;</td>
  </tr>
  <tr onClick=parent.doZoom(200) onMouseOver="parent.contextHilite(this); parent.toggleTick(zoom200_,1);" onMouseOut="parent.contextDelite(this); parent.toggleTick(zoom200_,0);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22 id="zoom200_">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;200%&nbsp;</td>
  </tr>
  <tr onClick=parent.doZoom(150) onMouseOver="parent.contextHilite(this); parent.toggleTick(zoom150_,1);" onMouseOut="parent.contextDelite(this); parent.toggleTick(zoom150_,0);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22 id="zoom150_">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;150%&nbsp;</td>
  </tr>
  <tr onClick="parent.doZoom(100)" onMouseOver="parent.contextHilite(this); parent.toggleTick(zoom100_,1);" onMouseOut="parent.contextDelite(this); parent.toggleTick(zoom100_,0)";">
<td style="cursor: hand; font:8pt tahoma;" height=22 id="zoom100_">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;100%&nbsp;</td>
  </tr>
  <tr onClick=parent.doZoom(75); onMouseOver="parent.contextHilite(this); parent.toggleTick(zoom75_,1);" onMouseOut="parent.contextDelite(this); parent.toggleTick(zoom75_,0);">
<td style="cursor: hand; font:8pt tahoma;" height=22 id="zoom75_">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;75%&nbsp;</td>
  </tr>
  <tr onClick=parent.doZoom(50); onMouseOver="parent.contextHilite(this); parent.toggleTick(zoom50_,1);" onMouseOut="parent.contextDelite(this); parent.toggleTick(zoom50_,0);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22 id="zoom50_">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;50%&nbsp;</td>
  </tr>
  <tr onClick=parent.doZoom(25); onMouseOver="parent.contextHilite(this); parent.toggleTick(zoom25_,1);" onMouseOut="parent.contextDelite(this); parent.toggleTick(zoom25_,0);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22 id="zoom25_">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;25%&nbsp;</td>
  </tr>
  <tr onClick=parent.doZoom(10); onMouseOver="parent.contextHilite(this); parent.toggleTick(zoom10_,1);" onMouseOut="parent.contextDelite(this); parent.toggleTick(zoom10_,0);"> 
<td style="cursor: hand; font:8pt tahoma;" height=22 id="zoom10_">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10%&nbsp;</td>
  </tr>
</table>
</div>
<!-- zoomMenu -->

<DIV ID="colorMenu" STYLE="display:none;">
<table cellpadding="0" cellspacing="5" style="cursor: hand;font-family: Verdana; font-size: 6px; BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: buttonshadow 2px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: buttonshadow 1px solid;" bgcolor="threedface"><tr><td>

<table cellpadding=0 cellspacing=0 style="font-size: 3px;">
  <tr>
<td colspan="10" style="border: solid 1px #d4d0c8;" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" onClick="parent.doColor()"><div style="border: solid 1px #808080; padding: 2px; margin: 2px;">
<table cellspacing=0 cellpadding=0 border=0 width=90% style="font-size:3px">
<tr><td><div style="background-color:#000000; border:solid 1px #808080; width:12px; height:12px"></div></td><td align=center style="font-size:11px"><?php echo sTxtNone; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
</table>
</div>
</td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#000000; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#993300; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#333300; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#003300; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#003366; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#000099; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#333399; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#333333; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
  </tr>
  <tr>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#990000; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FF6600; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#999900; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#009900; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#009999; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#0000FF; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#666699; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#808080; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
  </tr>
  <tr>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FF0000; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FF9900; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#99CC00; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#339966; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#33CCCC; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#3366FF; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#990099; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#999999; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
  </tr><tr>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FF00FF; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FFCC00; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FFFF00; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#00FF00; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#00FFFF; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#00CCFF; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#993366; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#CCCCCC; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
  </tr>
  <tr>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FF99CC; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FFCC99; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FFFF99; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#CCFFCC; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#CCFFFF; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#99CCFF; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#CC99FF; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
<td onClick="parent.doColor(this)" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" style="padding:2px;border:solid 1px #d4d0c8;"><div style="background-color:#FFFFFF; border:solid 1px #808080; width:12px; height:12px">&nbsp;</div></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
<td colspan="10" style="height:23px; font-family: arial; font-size:11px; border: solid 1px #d4d0c8;" onMouseOver="parent.button_over(this)" onMouseOut="parent.button_out(this)" onClick="parent.doMoreColors()" align=center>&nbsp;<?php echo sTxtMoreColors; ?>...</td>
  </tr>
</table>

</td></tr>
</table>
</DIV>


<DIV ID="contextMenu" style="display:none;">
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: buttonshadow 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: buttonshadow 1px solid;" bgcolor="threedface">
  <tr id=cmCut onClick ='parent.document.execCommand("Cut");parent.oPopup2.hide()'>
<td style="cursor:default; font:8pt tahoma; border: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtCut; ?>&nbsp;</td>
  </tr>
  <tr id=cmCopy onClick ='parent.document.execCommand("Copy");parent.oPopup2.hide()'> 
<td style="cursor:default; font:8pt tahoma; border: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtCopy; ?>&nbsp;</td>
  </tr>
  <tr id=cmPaste onClick ='parent.document.execCommand("Paste");parent.oPopup2.hide()'> 
<td style="cursor:default; font:8pt tahoma; border: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtPaste; ?>&nbsp;</td>
  </tr>
</table>
</div>

<DIV ID="cmTableMenu" style="display:none">
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: buttonshadow 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: buttonshadow 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.ModifyTable();'> 
<td style="cursor:default; font:8pt tahoma; border: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtTableModify; ?>...&nbsp;</td>
  </tr>
</table>
</DIV>

<DIV ID="cmTableFunctions" style="display:none">
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.ModifyCell();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtCellModify; ?>...&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.InsertColBefore(); parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtInsertColB; ?>&nbsp;</td>
  </tr>
  <tr onClick ='parent.InsertColAfter(); parent.oPopup2.hide();'> 
   <td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtInsertColA; ?>&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.InsertRowAbove(); parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtInsertRowA; ?>&nbsp;</td>
  </tr>
  <tr onClick ='parent.InsertRowBelow(); parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtInsertRowB; ?>&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.DeleteRow(); parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtDeleteRow; ?>&nbsp;</td>
  </tr>
  <tr onClick ='parent.DeleteCol(); parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtDeleteCol; ?>&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.IncreaseColspan(); parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtIncreaseColSpan; ?>&nbsp;</td>
  </tr>
  <tr onClick ='parent.DecreaseColspan(); parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp&nbsp;&nbsp;&nbsp&nbsp<?php echo sTxtDecreaseColSpan; ?>&nbsp;</td>
  </tr>
</table>
</DIV>

<DIV ID="cmImageMenu" style="display:none">
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.doImage();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtModifyImage; ?>...&nbsp;</td>
  </tr>
<!-- cmsware image-->
<!--  <tr onClick ='parent.doEditImage();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtEditImage; ?>...&nbsp;</td>
  </tr>-->
  <tr onClick ='parent.doGetImageLink();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtGetImageLink; ?>...&nbsp;</td>
  </tr>
<!--  <tr onClick ='parent.doTitleImage();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtTitleImage; ?></td>
  </tr>-->
<!-- cmsware image-->
</table>
</DIV>

<DIV ID="cmLinkMenu" style="display:none">
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.doLink();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtHyperLink; ?>...&nbsp;</td>
  </tr>
</table>
</DIV>




<!---插入分页符--->
<DIV ID="cmInsertPageMenu" style="display:none">
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
    <tr onClick ='parent.doPageInsert();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtInsertPage; ?>...&nbsp;</td>
  </tr>
    <tr onClick ='parent.doImageInsert();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtInsertImage; ?>...&nbsp;</td>
  </tr></table>
</DIV>

<DIV ID="cmSpellMenu" style="display:none">
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
  <tr onClick ='parent.spellCheck();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" class="parent.toolbutton" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtCheckSpelling; ?>...&nbsp;</td>
  </tr>
</table>
</DIV>

<!-- Start Paste Menu -->
<DIV ID="pasteMenu" STYLE="display:none">
<table border="0" cellspacing="0" cellpadding="0" width=180 style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: buttonshadow 2px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: buttonshadow 1px solid;" bgcolor="threedface">
  <tr onClick="parent.doCommand('Paste');"> 
<td height=20 style="cursor: hand; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
&nbsp; &nbsp; &nbsp;<?php echo sTxtPaste; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ctrl+V </td>
  </tr>
  <tr onClick="parent.pasteWord();"> 
<td height=20 style="cursor: hand; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);"> 
  &nbsp; &nbsp; &nbsp;<?php echo sTxtPasteWord; ?>&nbsp;&nbsp;&nbsp;&nbsp;Ctrl+D </td>
  </tr>
</table>
</div>
<!-- End Paste Menu -->


<DIV ID="cmswareMenu" style="display:none">
<table border="0" cellspacing="0" cellpadding="3" width="<?php echo sTxtContextMenuWidth-2; ?>" style="BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: #808080 1px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: #808080 1px solid;" bgcolor="threedface">
<!-- Start   <tr onClick ='parent.doTitle();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtTitle; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ctrl+R</td>
  </tr>
  <tr onClick ='parent.doSubTitle();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtSubTitle; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ctrl+W</td>
  </tr>
  <tr onClick ='parent.doIntroTitle();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtIntroTitle; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ctrl+D</td>
  </tr>
  <tr onClick ='parent.doAuthor();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtAuthor; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ctrl+H</td>
  </tr>
  <tr onClick ='parent.doAbstract();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtAbstract; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ctrl+Q</td>
  </tr>
  <tr onClick ='parent.doSource();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtSource; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ctrl+E</td>
  </tr>
  <tr onClick ='parent.doKeyword();parent.oPopup2.hide();'> 
<td style="cursor:default; font:8pt tahoma; BORDER-LEFT: threedface 1px solid; BORDER-RIGHT: threedface 1px solid; BORDER-TOP: threedface 1px solid; BORDER-BOTTOM: threedface 1px solid;" onMouseOver="parent.contextHilite(this);" onMouseOut="parent.contextDelite(this);">
  &nbsp; &nbsp; &nbsp;<?php echo sTxtKeyword; ?>&nbsp; &nbsp; &nbsp; Alt+W</td>
  </tr>
  -->
</table>
</DIV>
<!-- End CMSWARE Menu -->

