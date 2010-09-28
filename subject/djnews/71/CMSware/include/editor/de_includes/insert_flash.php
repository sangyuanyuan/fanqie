<?php

	error_reporting(0);
	require_once("de_lang/language.php");

	/*//////////////////////////////////////////////////////
	/                                                      /
	/ The $DOCUMENT_ROOT variable is used to specify the   /
	/ location of the image directory. If you are having   /
	/ problems uploading or deleting images, then you      /
	/ will need to change the variable below to the full   /
	/ path to your document root on your web server, such  /
	/ as /htdocs/www/jdoe                                  /
	/                                                      /
	//////////////////////////////////////////////////////*/

	$DOCUMENT_ROOT = @$_SERVER["DOCUMENT_ROOT"];
	$statusText = "";

	$dt = @$_REQUEST["dt"];
	$tn = @$_REQUEST["tn"];
	$dd = @$_REQUEST["dd"];
	$du = @$_REQUEST["du"];

	$validFlashTypes = array("application/x-shockwave-flash");

	// Added for v5.0
	$validFlashExts = array("swf");
	$isValidExt = false;

	$FlashDirectory = @$_REQUEST["flashDir"];
	$HideWebFlash = $_REQUEST["wi"];
	$URL = $_SERVER["HTTP_HOST"];
	$scriptName = dirname($_SERVER["SCRIPT_NAME"]) . "/de/class.devedit.php";

	// Workout the location of class.devedit.php
	$url = $_SERVER["SERVER_NAME"];
	$scriptName = "class.devedit.php";
	$scriptDir = strrev(@$_SERVER["PATH_INFO"]);
	$slashPos = strpos($scriptDir, "/");
	$scriptDir = strrev(substr($scriptDir, $slashPos, strlen($scriptDir)));

	if(@$_GET["flashSrc"] != "")
	{
		// Delete the flash file
		$flashPath = str_replace("//", "/", $DOCUMENT_ROOT . "/" . $FlashDirectory . "/" . $_GET["flashSrc"]);
		$flashExt = strrev(substr(strrev($flashPath), 0, strpos(strrev($flashPath), ".")));

		// Is this a valid file type?
		if(in_array($flashExt, $validFlashExts))
			$isValidExt = true;
		else
			$isValidExt = false;

		if($isValidExt)
		{
			if(@unlink($flashPath))
			{
				// Deleted OK
				$statusText = sTxtFlashDeleted;
			}
			else
			{
				// Couldn't delete the imagefile
				$statusText = sTxtCantDelete;
			}
		}
		else
		{
			// Invalid file type
			$statusText = sTxtFlashErr;
		}
	}
	
	if(@$_GET["ToDo"] == "UploadFlash")
	{
		//Data for first file upload
		$newFileName = @$_FILES["upload"]["name"];
		$newFileType = @$_FILES["upload"]["type"];
		$newFileLocation = @$_FILES["upload"]["tmp_name"];
		$newFileSize = @$_FILES["upload"]["size"];

		//---------------------------------------------------------
		//Is the first image a valid file type?

		$validFileType = false;
		$errorText = "";

		if($newFileName != "")
		{		
			// Is this a valid file type?
			if(in_array($newFileType, $validFlashTypes))
				$validFileType = true;
		
			if($validFileType == false)
			{
				// Invalid file type
				$statusText = sTxtFlashErr;
			}
			else
			{
				$uploadSuccess = @copy($newFileLocation, $DOCUMENT_ROOT . $FlashDirectory . "/" . $newFileName);

				if($uploadSuccess)
				{
					$statusText = $newFileName . " " . sTxtUploadSuccess . "!";
				}
				else
				{
					$statusText = sTxtCantUpload;
				}
			}
		}
	}

	$dirHandle = @opendir(realpath($DOCUMENT_ROOT . $FlashDirectory)) or die(sTxtFlashDirNotConfigured);

	//Get all flash files into a JavaScript array so that we can workout whether or not
	//uploading an image would overwrite an existing one
	$flashJS = "var flashFiles = Array(";

	while(false !== ($file = readdir($dirHandle)))
	{
		$flashJS = $flashJS . "'" . $file . "',";
	}

	//Reload the directory contents
	$dirHandle = @opendir(realpath($DOCUMENT_ROOT . $FlashDirectory)) or die(sTxtFlashDirNotConfigured);

	if(substr(strrev($flashJS), 0, 1) == ",")
		$flashJS = substr($flashJS, 0, strlen($flashJS)-1);

	$flashJS = $flashJS . ")";
	$counter = 0;

?>

<title><?php echo sTxtInsertFlash; ?></title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">

<script defer>
if (window.opener.flashEdit) {
	selectedFlash = window.opener.selectedFlash
	previewModify()

}
</script>

<script language=JavaScript>
window.onload = this.focus

var selectedFlash
var selectedFlashFile
var flashAlign
var flashLoop

<?php echo $flashJS; ?>

if (window.opener.flashEdit) {
	flashAlign = window.opener.selectedFlash.align
	flashLoop = window.opener.selectedFlash.loop
}

function outputFlashLibraryOptions()
{
	document.write(opener.flashLibs);

	// Loop through all of the image libraries and find the selected one
	for(i = 0; i < selFlashLib.options.length; i++)
	{
		if(selFlashLib.options[i].value == "<?php echo $FlashDirectory; ?>")
		{
			selFlashLib.selectedIndex = i;
			break;
		}
	}
}

function switchFlashLibrary(thePath)
{
	// Change the path of the flash library
	document.location.href = '<?php echo $HTTPStr . "://" . $url . $_SERVER["PHP_SELF"]; ?>?ToDo=InsertFlash&DEP=<?php echo @$_GET["DEP"]; ?>&DEP1=<?php echo @$_GET["DEP1"]; ?>&flashDir='+thePath+'&dd=<?php echo $_GET["dd"]; ?>&du=<?php echo $_GET["du"]; ?>&wi=<?php echo $_GET["wi"]; ?>&tn=<?php echo $_GET["tn"]; ?>&dt=<?php echo $_GET["dt"]; ?>&wi=<?php echo $HideWebFlash; ?>';
}

function printAlign() {
	if ((flashAlign != undefined) && (flashAlign != "")) {
		document.write('<option selected>' + flashAlign)
		document.write('<option>')
	} else {
		document.write('<option selected>')
	}
}

function printLoop() {
	if (flashLoop != undefined) {
		document.write('<option value="' + flashLoop + '" selected>' + flashLoop + '</option>')
		document.write('<option value=""></option>')
	}
}

var selectedFlashEmbed
function previewModify() {

	objectTag = /(<(object|\/object)([\s\S]*?)>)/gi
	paramTag = /(<param([\s\S]*?)>)/gi

	code = selectedFlash.outerHTML.replace(objectTag,"")
	code = code.replace(paramTag,"")
	tempFrame.document.write("<html><head></head><body>" + code + "</body></html>")
	tempFrame.document.close()
	selectedFlashEmbed = tempFrame.document.embeds[0]
	selectedFlashFile = selectedFlash.movie

	document.getElementById("previewWindow").innerHTML = "<embed src='" + selectedFlash.movie + "' quality='high' pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='236' height='176' bgcolor='#009933' WMODE=transparent></embed>"

	image_width.value = selectedFlash.width
	image_height.value = selectedFlash.height
	hspace.value = selectedFlash.hspace
	vspace.value = selectedFlash.vspace

	insertButton.value = "<?php echo sTxtImageModify; ?>"
	document.title = "<?php echo sTxtModifyFlash; ?>"
	previewButton.disabled = false
	insertButton.disabled = false

}

function deleteFlash(flashSrc)
{
	var delImg = confirm("<?php echo sTxtImageDelete; ?>");

	if (delImg == true) {
		document.location.href = '<?php echo $HTTPStr . "://" . $url . $_SERVER["PHP_SELF"]; ?>?ToDo=DeleteFlash&DEP=<?php echo @$_GET["DEP"]; ?>&DEP1=<?php echo @$_GET["DEP1"]; ?>&flashDir=<?php echo $FlashDirectory; ?>&tn=<?php echo $_GET["tn"]; ?>&dt=<?php echo $_GET["dt"]; ?>&wi=<?php echo $HideWebFlash; ?>&du=<?php echo $_GET["du"]; ?>&dd=<?php echo $dd; ?>&flashSrc='+flashSrc;
	}

}

function viewImage(flashSrc)
{
	var sWidth =  screen.availWidth;
	var sHeight = screen.availHeight;
	
	window.open(flashSrc, 'image', 'width=500, height=500,scrollbars=yes,resizable=yes,left='+(sWidth/2-250)+',top='+(sHeight/2-250));
}

function grey(tr) {
		tr.className = 'b4';
}

function ungrey(tr) {
		tr.className = '';
}

function insertImage(flashSrc) {

	var error = 0;

		imageWidth = image_width.value
		imageHeight = image_height.value
		imageHspace = hspace.value
		imageVspace = vspace.value

		if (isNaN(imageWidth) || imageWidth < 0) {
			alert("<?php echo sTxtFlashWidthErr; ?>")
			error = 1
			image_width.select()
			image_width.focus()
		} else if (isNaN(imageHeight) || imageHeight < 0) {
			alert("<?php echo sTxtFlashHeightErr; ?>")
			error = 1
			image_height.select()
			image_height.focus()
		} else if (isNaN(imageHspace) || imageHspace < 0) {
			alert("<?php echo sTxtHorizontalSpacingErr; ?>")
			error = 1
			hspace.select()
			hspace.focus()
		} else if (isNaN(vspace.value) || vspace.value < 0) {
			alert("<?php echo sTxtVerticalSpacingErr; ?>")
			error = 1
			vspace.select()
			vspace.focus()
		}

		if (error != 1) {

			var sel = window.opener.foo.document.selection;
			if (sel!=null) {
				var rng = sel.createRange();
				if (rng!=null) {

					// Are we modifying or inserting?
					if (window.opener.flashEdit) {

						if (imageWidth != "") {
							selectedFlash.width = imageWidth
							selectedFlashEmbed.width = imageWidth
						} else {
							selectedFlash.removeAttribute("width")
							selectedFlashEmbed.removeAttribute("width")
						}

						if (imageHeight != "") {
							selectedFlash.height = imageHeight
							selectedFlashEmbed.height = imageHeight
						} else {
							selectedFlash.removeAttribute("height")
							selectedFlashEmbed.removeAttribute("height")
						}


						if (vspace.value != "") {
							selectedFlash.vspace = vspace.value
							selectedFlashEmbed.vspace = vspace.value
						} else {
							selectedFlash.removeAttribute("vspace")
							selectedFlashEmbed.removeAttribute("vspace")
						}

						if (hspace .value != "") {
							selectedFlash.hspace = hspace.value
							selectedFlashEmbed.hspace = vspace.value
						} else {
							selectedFlash.removeAttribute("hspace")
							selectedFlashEmbed.removeAttribute("hspace")
						}

						if (align[align.selectedIndex].text != "") {
							selectedFlash.align = align[align.selectedIndex].text
						} else {
							selectedFlash.removeAttribute("align")
						}


						selectedFlash.movie = flashSrc

						if (loop[loop.selectedIndex].value != "") {
							selectedFlash.loop =  loop[loop.selectedIndex].value
							selectedFlashEmbed.loop =  loop[loop.selectedIndex].value
						} else {
							selectedFlash.removeAttribute("loop")
							selectedFlashEmbed.removeAttribute("loop")
						}

						embedTag = /(<embed([\s\S]*?)>)/gi
						closeEmbedTag = /(<\/embed([\s\S]*?)>)/gi

						originalFlash = selectedFlash.outerHTML

						code = originalFlash.replace(closeEmbedTag, "")
						code = code.replace(embedTag, selectedFlashEmbed.outerHTML + "</embed>")
						selectedFlash.outerHTML = code

						selectedFlash.runtimeStyle.backgroundImage = "url(<?php echo @$_GET["DEP"]; ?>/de_images/hidden.gif)"

					} else {

						if (imageWidth != "")
							imageWidth = ' width=' + imageWidth + '" '
						else
							imageWidth = ''

						if (imageHeight != "")
							imageHeight = ' height=' + imageHeight + '" '
						else
							imageHeight = ''

						if (vspace.value != "")
							vSpace = ' vspace=' + vspace.value + '" '
						else
							vSpace = ''

						if (hspace.value != "")
							hSpace = ' hspace=' + hspace.value + '" '
						else
							hSpace = ''

						if (align[align.selectedIndex].text != "")
							falign = ' align="' + align[align.selectedIndex].text + '" '
						else
							falign = ''

						HTMLTextField = 
						'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0"' + imageHeight + imageWidth + vSpace + hSpace + falign + '>' +
						'<param name=movie value="' + flashSrc + '">' +
						'<param name="LOOP" value="' + loop[loop.selectedIndex].value + '">' + 
						'<embed src="' + flashSrc +
						'" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"' 
						+ imageWidth + imageHeight + vSpace + hSpace + falign + ' loop="' + loop[loop.selectedIndex].value + '"></embed></object>'

						rng.pasteHTML(HTMLTextField)
					}	
				

					//window.opener.foo.focus();
					self.close();

					// oFlash.removeAttribute("id")


				} // End if
			} // End If
		}
} // End function

function insertExtFlash() {
	selectedFlashFile = document.getElementById("externalFlash").value
	
	if (previousFlash != null) {
		previousFlash.style.border = "3px solid #FFFFFF"
	}

	document.getElementById("previewWindow").innerHTML = "<embed src='" + selectedFlashFile.replace(/ /g, "%20") + "' quality='high' pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='236' height='176' bgcolor='#009933' WMODE=transparent></embed>"

	if (document.getElementById("deleteButton") != null) {
	deleteButton.disabled = true
	}

	previewButton.disabled = false
	insertButton.disabled = false

} // End function

var flashFolder = "<?php echo $FlashDirectory; ?>/"
var previousFlash
var selectedFlashEncoded
function doSelect(oFlash) {
	selectedFlashFile = flashFolder + oFlash.childNodes(0).name
	selectedFlashEncoded = oFlash.childNodes(0).name2
	
	oFlash.style.border = "3px solid #08246B"
	currentFlash = oFlash
	if (previousFlash != null) {
		if (previousFlash != currentFlash) {
			previousFlash.style.border = "3px solid #FFFFFF"
		}
	}
	previousFlash = currentFlash

	document.getElementById("previewWindow").innerHTML = "<embed src='" + selectedFlashFile.replace(/ /g, "%20") + "' quality='high' pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='236' height='176' bgcolor='#009933' WMODE=transparent></embed>"

	previewButton.disabled = false
	insertButton.disabled = false

	if (document.getElementById("deleteButton") != null) {
	deleteButton.disabled = false
	}
}

function CheckFlashForm()
{
	//upload, upload1, upload2, upload3, upload4
	var flashDir = '<?php echo $FlashDirectory; ?>';
	var f1 = document.getElementById("upload");

	// Extract just the filename from the paths of the files being uploaded
	f1_file = f1.value;
	last = f1_file.lastIndexOf ("\\", f1_file.length-1);
	f1_file = f1_file.substring (last + 1);

	if(f1_file == "")
	{
		alert('<?php echo sTxtChooseFlash; ?>');
		return false;
	}

	// Loop through the flashDir array
	if(f1_file != "")
	{
		for(i = 0; i < flashFiles.length; i++)
		{
			if(f1_file == flashFiles[i])
			{
				if(!confirm(f1_file + ' <?php echo sTxtFlashExists; ?>'))
				{
					return false;
				}
			}
		}
	}

	return true;
}

</script>
<title><?php echo sTxtInsertFlash; ?></title>

<body bgcolor=threedface style="border: 1px buttonhighlight;">
<iframe id=tempFrame style="display:none"></iframe>
<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span><?php echo sTxtInsertFlashInst; ?></span>
</div>
<br>

<form enctype="multipart/form-data" action="<?php echo $HTTPStr . "://" . $url . $_SERVER["PHP_SELF"]; ?>?ToDo=UploadFlash&DEP=<?php echo @$_GET["DEP"]; ?>&DEP1=<?php echo @$_GET["DEP1"]; ?>&flashDir=<?php echo $FlashDirectory; ?>&wi=<?php echo $HideWebFlash; ?>&tn=<?php echo $tn; ?>&dd=<?php echo $dd; ?>&dt=<?php echo $dt; ?>&du=<?php echo $du; ?>" method="post" onSubmit="return CheckFlashForm()">
<span class="appInside1" style="width:350px">
	<div class="appInside2">
	<?php if($du != "1") { ?>
		<div class="appInside3" style="padding:11px"><span class="appTitle"><?php echo sTxtUploadFlash; ?></span>
			<br>
				<input type="file" name="upload" class="Text240"> <input type="submit" value="<?php echo sTxtUpload; ?>" class="Text75">
				<span class="err" style="position:absolute; left:40; top:86;"><?php echo $statusText; ?></span>
	<?php } else { ?>
		<div class="appInside3" style="padding:11px"><span class="appTitle"><font color="gray"><?php echo sTxtUploadFlash; ?></font></span>
			<br>
				<input type="file" name="upload" class="Text240" disabled> <input type="submit" value="Upload" class="Text75" disabled>
	<?php } ?>
		</div>
	</div>
</span>
&nbsp;
 <?php if($HideWebFlash != "1") { ?>
<span class="appInside1" style="width:350px">
	<div class="appInside2">
		<div class="appInside3" style="padding:11px"><span class="appTitle"><?php echo sTxtExternalFlash; ?></span>
			<br>
			<input type="text" name="externalFlash" id="externalFlash" class="Text240" value="http://">&nbsp;<input type=button value=<?php echo sTxtLoad; ?> class="Text75" onClick="insertExtFlash()">
		</div>
	</div>
</span>
<?php } else { ?>
<span class="appInside1" style="width:350px">
	<div class="appInside2">
		<div class="appInside3" style="padding:11px"><span class="appTitle"><font color="gray"><?php echo sTxtExternalFlash; ?></font></span>
			<br>
			<input type="text" name="externalFlash" id="externalFlash" class="Text240" value="http://" disabled>&nbsp;<input type=button value=<?php echo sTxtLoad; ?> class="Text75" onClick="insertExtFlash()" disabled>
		</div>
	</div>
</span>
<?php } ?>
</form>

<span class="appInside1" style="width:350px">
	<div class="appInside2">
		<div class="appInside3" style="padding:11px"><span class="appTitle"><?php echo sTxtInternalFlash; ?></span>
			<table border=0 cellspacing=0 cellpadding=0 style="padding-bottom:5px">
			<tr><td><select style="width:242px; font-size:11px; font-family:Arial;" name="selFlashLib">
				<script>outputFlashLibraryOptions();</script>
			</select>
			</td><td><input type=button value="<?php echo sTxtSwitch; ?>" class=text75 onClick="switchFlashLibrary(selFlashLib.value)"></td></tr>
			</table>
	<div style="height:325px; width:325px; overflow: auto; border: 2px inset; background-color: #FFFFFF">
	<?php if(@$_GET["tn"] == 1) { ?>
		<table border="0" cellspacing="0" cellpadding="5" style="width:100%">
	<?php } else { ?>
		<table border="0" cellspacing="0" cellpadding="3" style="width:100%">
	<?php } ?>
		  <tr>
		<?php

		$counter = 0;

		if(@$_GET["tn"] == 1)
		{
			while(false !== ($file = readdir($dirHandle)))
			{
				$flashExt = strrev(substr(strrev($file), 0, strpos(strrev($file), ".")));
				if($file != "." && $file != ".." && in_array($flashExt, $validFlashExts))
				{
					$counter++;
				?>
					<td width="25%">
						<span class="body">&nbsp;<?php echo $file; ?><br></span>
						<div onclick="doSelect(this)" style="border: 3px solid #FFFFFF; background-color:#FFFFFF" style="width:80px">
						<img src="de_images/popups/flash.gif" width="80" height="80" border=1 name="<?php echo $file; ?>" name2="<?php echo urlencode($file); ?>"></div>
					</td>
				<?php
				}
				
				if($counter % 3 == 0)
					echo "</tr><tr>";
			}
		}
		else
		{
			$dirHandle = @opendir(realpath($DOCUMENT_ROOT . $FlashDirectory)) or die(sTxtFlashDirNotConfigured);
			while(false !== ($file = readdir($dirHandle)))
			{
				$flashExt = strrev(substr(strrev($file), 0, strpos(strrev($file), ".")));
				if($file != "." && $file != ".." && in_array($flashExt, $validFlashExts))
				{
					$counter++;
					$filePath = @str_replace("//", "/", $DOCUMENT_ROOT . $FlashDirectory . "/" . $file);
				?>
					<tr style="cursor:hand">
						<td width="40%" class="body" >
							<div onClick=doSelect(this) style="border: solid 3px #FFFFFF">
							<img src="de_images/popups/flash.gif" width=16 height=16 align=absmiddle name="<?php echo $file; ?>" name2="<?php echo urlencode($file); ?>">&nbsp;<?php echo $file; ?>
							<span style="position:absolute; left=200"><?php echo filesize($filePath); ?> <?php echo sTxtBytes; ?></span>
							</div>
						</td>
					</tr>
			<?php
				}
			}
		}

		if($counter == 0)
		{
		?>
			<tr>
				<td width="100%" class="body" >
					<font color="gray"><?php echo sTxtEmptyFlashLibrary; ?></font>
				</td>
			</tr>
		<?php
		}
		?>
		</table>
		</div>
		</div>
	</div>
</span>
&nbsp;
<span class="appInside1" style="width:350px; position:absolute">
	<div class="appInside2">
		<div class="appInside3" style="padding:11px"><span class="appTitle"><?php echo sTxtPreview; ?></span><br>
			<span id="previewWindow" style="height:180px; width:240px; overflow: auto; border: 2px inset; background-color: #FFFFFF">
			</span><input type="button" name="previewButton" value="<?php echo sTxtPreview; ?>" class="Text75" onClick="javascript:viewImage(selectedFlashFile)" disabled=true style="position:absolute; left:257px;">
		</div>
	</div>
</span>

<span class="appInside1" style="width:350px; padding-top:5px;">
	<div class="appInside2">
		<div class="appInside3" style="padding:11px"><span class="appTitle"><?php echo sTxtFlashProperties; ?></span>
		<table border="0" cellspacing="0" cellpadding="5">
		  <tr>
			<td class="body" width="70"><?php echo sTxtLoop; ?>:</td>
			<td class="body" width="88">
				<select class="Text70" name=loop>
					<script>printLoop()</script>
					<option value="true">True</option>
					<option value="false">False</option>
				</select>
			</td>
			<td class="body"><?php echo sTxtAlignment; ?>:</td>
				<td class="body">
				  <SELECT class=text70 name=align>
					<script>printAlign()</script>
					<option>Baseline
					<option>Top
					<option>Middle
					<option>Bottom
					<option>TextTop
					<option>ABSMiddle
					<option>ABSBottom
					<option>Left
					<option>Right</option>
				  </select>
				</td>
		  </tr>
		  <tr>
			<td class="body"><?php echo sTxtFlashWidth; ?>:</td>
			<td class="body">
			  <input type="text" name="image_width" size="3" class="Text70" maxlength="3">
		  </td>
			<td class="body"><?php echo sTxtFlashHeight; ?>:</td>
			<td class="body">
			  <input type="text" name="image_height" size="3" class="Text70" maxlength="3">
			</td>
		  </tr>
		  <tr>
			<td class="body"><?php echo sTxtHorizontalSpacing; ?>:</td>
			<td class="body">
			  <input type="text" name="hspace" size="3" class="Text70" maxlength="3">
			</td>
			<td class="body"><?php echo sTxtVerticalSpacing; ?>:</td>
			<td class="body">
			  <input type="text" name="vspace" size="3" class="Text70" maxlength="3">
			</td>
		  </tr>
		</table>
		</div>
	</div>
</span>

<div style="padding-top: 6px;">
<input type="button" name="deleteButton" value="<?php echo sTxtImageDel; ?>" class="Text75" onClick="javascript:deleteFlash(selectedFlashEncoded)" <?php if($dd == "1") { ?> style=display:none <? } ?> disabled>
</div>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="insertButton" value="<?php echo sTxtImageInsert; ?>" class="Text75" onClick="javascript:insertImage(selectedFlashFile)" disabled=true>
<input type="button" name="Submit" value="<?php echo sTxtCancel; ?>" class="Text75" onClick="javascript:window.close()">
</div>

</table>

<script defer>

if (window.opener.imageEdit)
{
	selectedImage = window.opener.selectedImage.src;
	previewModify();
}

</script>

