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

	// DO NOT MODIFY BELOW THIS LINE
	$validImageTypes = array("image/pjpeg", "image/jpeg", "image/gif", "image/x-png", "image/tiff", "image/tif", "image/bmp", "image/x-MS-bmp");

	// Added for v5.0
	$validImageExts = array("gif","jpg","jpeg","bmp","tiff","tif","png");
	$isValidExt = false;
	
	$ImageDirectory = ereg_replace("/$", "", $_GET["imgDir"]);
	
	// echo $ImageDirectory;

	$URL = $_SERVER["HTTP_HOST"];
	$serverName = $URL;
	$scriptName = dirname($_SERVER["SCRIPT_NAME"]) . "/de/class.devedit.php";
	$HideWebImage = @$_GET["wi"];

	// Workout the location of class.devedit.php
	$url = $_SERVER["SERVER_NAME"];
	$scriptName = "class.devedit.php";
	$scriptDir = strrev(@$_SERVER["PATH_INFO"]);
	$slashPos = strpos($scriptDir, "/");
	$scriptDir = strrev(substr($scriptDir, $slashPos, strlen($scriptDir)));
	$numImages = 0;
	$numInvalid = 0;

	if(@$_GET["imgSrc"] != "")
	{
		// Delete the image
		$imgPath = str_replace("//", "/", $DOCUMENT_ROOT . "/" . $ImageDirectory . "/" . $_GET["imgSrc"]);
		$imgExt = strrev(substr(strrev($imgPath), 0, strpos(strrev($imgPath), ".")));

		// Is this a valid file type?
		if(in_array($imgExt, $validImageExts))
			$isValidExt = true;
		else
			$isValidExt = false;

		if($isValidExt)
		{
			if(@unlink($imgPath))
			{
				// Deleted OK
				$statusText = sTxtImageDeleted;
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
			$statusText = sTxtInvalidImageType;
		}
	}

	if($_GET["ToDo"] == "UploadImage")
	{
		//Data for first file upload
		$newFileName = @$_FILES["upload"]["name"];
		$newFileType = @$_FILES["upload"]["type"];
		$newFileLocation = @$_FILES["upload"]["tmp_name"];
		$newFileSize = @$_FILES["upload"]["size"];

		//Data for second file upload
		$newFileName1 = @$_FILES["upload1"]["name"];
		$newFileType1 = @$_FILES["upload1"]["type"];
		$newFileLocation1 = @$_FILES["upload1"]["tmp_name"];
		$newFileSize1 = @$_FILES["upload1"]["size"];

		//Data for third file upload
		$newFileName2 = @$_FILES["upload2"]["name"];
		$newFileType2 = @$_FILES["upload2"]["type"];
		$newFileLocation2 = @$_FILES["upload2"]["tmp_name"];
		$newFileSize2 = @$_FILES["upload2"]["size"];

		//Data for fourth file upload
		$newFileName3 = @$_FILES["upload3"]["name"];
		$newFileType3 = @$_FILES["upload3"]["type"];
		$newFileLocation3 = @$_FILES["upload3"]["tmp_name"];
		$newFileSize3 = @$_FILES["upload3"]["size"];

		//Data for fifth file upload
		$newFileName4 = @$_FILES["upload4"]["name"];
		$newFileType4 = @$_FILES["upload4"]["type"];
		$newFileLocation4 = @$_FILES["upload4"]["tmp_name"];
		$newFileSize4 = @$_FILES["upload4"]["size"];

		//---------------------------------------------------------
		//Is the first image a valid file type?

		$validFileType = false;
		$errorText = "";

		if($newFileName != "")
		{		
			// Is this file empty?
			if($newFileSize == 0)
				$numInvalid++;
			
			// Is this a valid file type?
			if(in_array($newFileType, $validImageTypes))
				$validFileType = true;
		
			if($validFileType == false)
			{
				// Invalid file type
				$statusText = sTxtImageErr;
			}
			else
			{
				$uploadSuccess = @copy($newFileLocation, $DOCUMENT_ROOT . $ImageDirectory . "/" . $newFileName);

				if($uploadSuccess)
				{
					$statusText = $newFileName . " " . sTxtUploadSuccess . "!";
					$numImages++;
				}
				else
				{
					$statusText = sTxtCantUpload;
				}
			}
		}

		//---------------------------------------------------------
		//Is the second image a valid file type?

		$validFileType = false;
		$errorText = "";

		if($newFileName1 != "")
		{		
			// Is this file empty?
			if($newFileSize1 == 0)
				$numInvalid++;

			// Is this a valid file type?
			if(in_array($newFileType1, $validImageTypes))
				$validFileType = true;
		
			if($validFileType == false)
			{
				// Invalid file type
				$statusText = sTxtImageErr;
			}
			else
			{
				$uploadSuccess = @copy($newFileLocation1, $DOCUMENT_ROOT . $ImageDirectory . "/" . $newFileName1);

				if($uploadSuccess)
				{
					$statusText = $newFileName1 . " " . sTxtUploadSuccess . "!";
					$numImages++;
				}
				else
				{
					$statusText = sTxtCantUpload;
				}
			}
		}

		//---------------------------------------------------------
		//Is the third image a valid file type?

		$validFileType = false;
		$errorText = "";

		if($newFileName2 != "")
		{		
			// Is this file empty?
			if($newFileSize2 == 0)
				$numInvalid++;

			// Is this a valid file type?
			if(in_array($newFileType2, $validImageTypes))
				$validFileType = true;
		
			if($validFileType == false)
			{
				// Invalid file type
				$statusText = sTxtImageErr;
			}
			else
			{
				$uploadSuccess = @copy($newFileLocation2, $DOCUMENT_ROOT . $ImageDirectory . "/" . $newFileName2);

				if($uploadSuccess)
				{
					$statusText = $newFileName2 . " " . sTxtUploadSuccess . "!";
					$numImages++;
				}
				else
				{
					$statusText = sTxtCantUpload;
				}
			}
		}
	
		//---------------------------------------------------------
		//Is the fourth image a valid file type?

		$validFileType = false;
		$errorText = "";

		if($newFileName3 != "")
		{		
			// Is this file empty?
			if($newFileSize3 == 0)
				$numInvalid++;

			// Is this a valid file type?
			if(in_array($newFileType3, $validImageTypes))
				$validFileType = true;
		
			if($validFileType == false)
			{
				// Invalid file type
				$statusText = sTxtImageErr;
			}
			else
			{
				$uploadSuccess = @copy($newFileLocation3, $DOCUMENT_ROOT . $ImageDirectory . "/" . $newFileName3);

				if($uploadSuccess)
				{
					$statusText = $newFileName3 . " " . sTxtUploadSuccess . "!";
					$numImages++;
				}
				else
				{
					$statusText = sTxtCantUpload;
				}
			}
		}
	
		//---------------------------------------------------------
		//Is the fifth image a valid file type?

		$validFileType = false;
		$errorText = "";

		if($newFileName4 != "")
		{		
			// Is this file empty?
			if($newFileSize4 == 0)
				$numInvalid++;

			// Is this a valid file type?
			if(in_array($newFileType4, $validImageTypes))
				$validFileType = true;
		
			if($validFileType == false)
			{
				// Invalid file type
				$statusText = sTxtImageErr;
			}
			else
			{
				$uploadSuccess = @copy($newFileLocation4, $DOCUMENT_ROOT . $ImageDirectory . "/" . $newFileName4);

				if($uploadSuccess)
				{
					$statusText = $newFileName4 . " " . sTxtUploadSuccess . "!";
					$numImages++;
				}
				else
				{
					$statusText = sTxtCantUpload;
				}
			}
		}

		if($numImages > 1)
			$statusText = sTxtImageSuccess;

		if($numInvalid > 0)
			$statusText = sTxtImageErr;
	}
//echo $DOCUMENT_ROOT . $ImageDirectory;
	$dirHandle = @opendir(realpath($DOCUMENT_ROOT . $ImageDirectory)) or die(sTxtImageDirNotConfigured);

	//Get all images into a JavaScript array so that we can workout whether or not
	//uploading an image would overwrite an existing one
	$imageJS = "var imageDir = Array(";

	while(false !== ($file = readdir($dirHandle)))
	{
		$imageJS = $imageJS . "'" . $file . "',";
	}

	//Reload the directory contents
	$dirHandle = @opendir(realpath($DOCUMENT_ROOT . $ImageDirectory)) or die(sTxtImageDirNotConfigured);

	if(substr(strrev($imageJS), 0, 1) == ",")
		$imageJS = substr($imageJS, 0, strlen($imageJS)-1);

	$imageJS = $imageJS . ")";
	$counter = 0;

	?>

		<script language=JavaScript>

		window.onload = this.focus;

		window.opener.doStyles()
		window.onerror = function() { return true; }
		var myPage = window.opener;
		var imageAlign

		<?php echo $imageJS; ?>

		if (window.opener.imageEdit) {
			imageAlign = window.opener.selectedImage.align
		}

		function toggleUploadDiv()
		{
			if(uploadDiv.style.display == "none")
			{
				document.getElementById("toggleButton").value = "》";
				document.getElementById("upload").focus();
				document.getElementById("upload").select();
				uploadDiv.style.display = "inline";
				dummyDiv.style.display = "inline";
				divList.style.height = 225;
				previewWindow.style.height = 50;
			}
			else
			{
				document.getElementById("toggleButton").value = "》";
				document.getElementById("upload").focus();
				document.getElementById("upload").select();
				uploadDiv.style.display = "none";
				dummyDiv.style.display = "none";
				divList.style.height = 325;
				previewWindow.style.height = 150;
			}
		}

		function outputImageLibraryOptions()
		{
			document.write(opener.imageLibs);

			// Loop through all of the image libraries and find the selected one
			for(i = 0; i < selImageLib.options.length; i++)
			{
				if(selImageLib.options[i].value == "<?php echo $ImageDirectory; ?>")
				{
					selImageLib.selectedIndex = i;
					break;
				}
			}
		}

		function switchImageLibrary(thePath)
		{
			// Change the path of the image library
			document.location.href = '<?php echo $HTTPStr . "://" . $url . $_SERVER["PHP_SELF"]; ?>?ToDo=InsertImage&DEP=<?php echo @$_GET["DEP"]; ?>&DEP1=<?php echo @$_GET["DEP1"]; ?>&imgDir='+thePath+'&dd=<?php echo $_GET["dd"]; ?>&du=<?php echo $_GET["du"]; ?>&wi=<?php echo $_GET["wi"]; ?>&tn=<?php echo $_GET["tn"]; ?>&dt=<?php echo $_GET["dt"]; ?>&wi=<?php echo $HideWebImage; ?>';
		}

		function previewModify() {

			var imageWidth = myPage.selectedImage.width;
			var imageHeight = myPage.selectedImage.height;
			var imageBorder = myPage.selectedImage.border;
			var imageAltTag = myPage.selectedImage.alt;
			var imageHspace = myPage.selectedImage.hspace;
			var imageVspace = myPage.selectedImage.vspace;

			document.getElementById("previewWindow").innerHTML = "<img src=" + selectedImage.replace(/ /g, "%20") + ">"

			insertButton.value = "<?php echo sTxtImageModify; ?>"
			document.title = "<?php echo sTxtModifyImage; ?>"

			if (document.getElementById("deleteButton") != null) {
				deleteButton.disabled = true
			}

			previewButton.disabled = false
			insertButton.disabled = false

			if (document.getElementById("backgdButton") != null) {
				backgdButton.disabled = false
			}

			image_width.value = imageWidth;
			image_height.value = imageHeight;

			if (imageBorder == "") {
				imageBorder = "0"
			}

			border.value = imageBorder;
			alt_tag.value = imageAltTag;
			hspace.value = imageHspace;
			vspace.value = imageVspace;
			// tableForm.cell_width.value = cellWidth;
			this.focus();
		}

		function deleteImage(imgSrc)
		{
			var delImg = confirm("<?php echo sTxtImageDelete; ?>");

			if (delImg == true) {
				document.location.href = '<?php echo $HTTPStr . "://" . $url . $_SERVER["PHP_SELF"]; ?>?ToDo=DeleteImage&DEP=<?php echo @$_GET["DEP"]; ?>&DEP1=<?php echo @$_GET["DEP1"]; ?>&imgDir=<?php echo $ImageDirectory; ?>&tn=<?php echo $_GET["tn"]; ?>&dt=<?php echo $_GET["dt"]; ?>&wi=<?php echo $HideWebImage; ?>&du=<?php echo $_GET["du"]; ?>&dd=<?php echo $dd; ?>&imgSrc='+imgSrc;
			}

		}

		function setBackground(imgSrc)
		{
			var setBg = confirm("<?php echo sTxtImageSetBackgd; ?>?");

			if (setBg == true) {
				window.opener.setBackgd(imgSrc);
				self.close();
			}
		}

		function viewImage(imgSrc)
		{
			var sWidth =  screen.availWidth;
			var sHeight = screen.availHeight;
			
			window.open(imgSrc, 'image', 'width=500, height=500,scrollbars=yes,resizable=yes,left='+(sWidth/2-250)+',top='+(sHeight/2-250));
		}

		function grey(tr) {
				tr.className = 'b4';
		}

		function ungrey(tr) {
				tr.className = '';
		}

		function insertImage(imgSrc) {

			var error = 0;
				imgSrc = document.getElementById("image_src").value
				imageWidth = image_width.value
				imageHeight = image_height.value
				imageBorder = border.value
				imageHspace = hspace.value
				imageVspace = vspace.value

				if (isNaN(imageWidth) || imageWidth < 0) {
					alert("<?php echo sTxtImageWidthErr; ?>")
					error = 1
					image_width.select()
					image_width.focus()
				} else if (isNaN(imageHeight) || imageHeight < 0) {
					alert("<?php echo sTxtImageHeightErr; ?>")
					error = 1
					image_height.select()
					image_height.focus()
				} else if (isNaN(imageBorder) || imageBorder < 0 || imageBorder == "") {
					alert("<?php echo sTxtImageBorderErr; ?>")
					error = 1
					border.select()
					border.focus()
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

							if (window.opener.imageEdit) {
								oImage = window.opener.selectedImage
								oImage.src = imgSrc
							} else { 
								HTMLTextField = '<img id="de_element_image" src="' + imgSrc + '">';
								rng.pasteHTML(HTMLTextField)

								oImage = window.opener.foo.document.getElementById("de_element_image")
							}

						if (imageWidth != "")
								oImage.width = imageWidth

						if (imageHeight != "")
								oImage.height = imageHeight

							oImage.alt = alt_tag.value
							oImage.border = border.value
							
							if (hspace.value != "") {
								oImage.hspace = hspace.value
							}

							if (vspace.value != "") {
								oImage.vspace = vspace.value
							} else {
								oImage.removeAttribute('vspace',0)
							}

							if (align[align.selectedIndex].text != "None") {
								oImage.align = align[align.selectedIndex].text
							} else {
								oImage.removeAttribute('align',0)
							}

							styles = sStyles.value

							if (styles != "") {
								oImage.className = styles
							} else {
								oImage.removeAttribute('className',0)
							}

							// window.opener.doToolbar()
							// window.opener.foo.focus();
							self.close();

							if (window.opener.imageEdit) {
								// do nothing
							} else { 
								oImage.removeAttribute("id")
							}


						} // End if
					} // End If
				}
		} // End function

		function insertExtImage() {
			selectedImage = document.getElementById("externalImage").value
			document.getElementById("image_src").value = selectedImage
			if (previousImage != null) {
				previousImage.style.border = "3px solid #FFFFFF"
			}

			document.getElementById("previewWindow").innerHTML = "<img src=" + selectedImage.replace(/ /g, "%20") + ">"

			if (document.getElementById("deleteButton") != null) {
				deleteButton.disabled = true
			}

			previewButton.disabled = false
			insertButton.disabled = false

			if (document.getElementById("backgdButton") != null) {
				backgdButton.disabled = false
			}

		} // End function

		var imageFolder = "<?php echo $ImageDirectory; ?>/"
		var previousImage
		var selectedImage
		var selectedImageEncoded
		function doSelect(oImage) {
			selectedImage = imageFolder + oImage.childNodes(0).name
			selectedImageEncoded = oImage.childNodes(0).name2
			
			oImage.style.border = "3px solid #08246B"
			currentImage = oImage
			if (previousImage != null) {
				if (previousImage != currentImage) {
					previousImage.style.border = "3px solid #FFFFFF"
				}
			}
			previousImage = currentImage

			document.getElementById("previewWindow").innerHTML = "<img src=" + selectedImage.replace(/ /g, "%20") + ">"
			previewButton.disabled = false
			insertButton.disabled = false
			
			if (document.getElementById("backgdButton") != null) {
				backgdButton.disabled = false
			}

			if (document.getElementById("deleteButton") != null) {
				deleteButton.disabled = false
			}
		}

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

		function printAlign() {
			if ((imageAlign != undefined) && (imageAlign != "")) {
				document.write('<option selected>' + imageAlign)
				document.write('<option>')
			} else {
				document.write('<option selected>')
			}
		}

		function CheckImageForm()
		{
			//upload, upload1, upload2, upload3, upload4
			var imgDir = '<?php echo $ImageDirectory; ?>';
			var u1 = document.getElementById("upload");
			var u2 = document.getElementById("upload1");
			var u3 = document.getElementById("upload2");
			var u4 = document.getElementById("upload3")
			var u5 = document.getElementById("upload4");

			// Extract just the filename from the paths of the files being uploaded
			u1_file = u1.value;
			last = u1_file.lastIndexOf ("\\", u1_file.length-1);
			u1_file = u1_file.substring (last + 1);

			u2_file = u2.value;
			last = u2_file.lastIndexOf ("\\", u2_file.length-1);
			u2_file = u2_file.substring (last + 1);

			u3_file = u3.value;
			last = u3_file.lastIndexOf ("\\", u3_file.length-1);
			u3_file = u3_file.substring (last + 1);

			u4_file = u4.value;
			last = u4_file.lastIndexOf ("\\", u4_file.length-1);
			u4_file = u4_file.substring (last + 1);

			u5_file = u5.value;
			last = u5_file.lastIndexOf ("\\", u5_file.length-1);
			u5_file = u5_file.substring (last + 1);

			if(u1_file == "" && u2_file == "" && u3_file == "" && u4_file == "" && u5_file == "")
			{
				alert('<?php echo sTxtChooseImage; ?>');
				return false;
			}

			// Loop through the imageDir array
			if(u1_file != "")
			{
				for(i = 0; i < imageDir.length; i++)
				{
					if(u1_file == imageDir[i])
					{
						if(!confirm(u1_file + ' <?php echo sTxtImageExists; ?>'))
						{
							return false;
						}
					}
				}
			}

			if(u2_file != "")
			{
				for(i = 0; i < imageDir.length; i++)
				{
					if(u2_file == imageDir[i])
					{
						if(!confirm(u2_file + ' <?php echo sTxtImageExists; ?>'))
						{
							return false;
						}
					}
				}
			}

			if(u3_file != "")
			{
				for(i = 0; i < imageDir.length; i++)
				{
					if(u3_file == imageDir[i])
					{
						if(!confirm(u3_file + ' <?php echo sTxtImageExists; ?>'))
						{
							return false;
						}
					}
				}
			}

			if(u4_file != "")
			{
				for(i = 0; i < imageDir.length; i++)
				{
					if(u4_file == imageDir[i])
					{
						if(!confirm(u4_file + ' <?php echo sTxtImageExists; ?>'))
						{
							return false;
						}
					}
				}
			}

			if(u5_file != "")
			{
				for(i = 0; i < imageDir.length; i++)
				{
					if(u5_file == imageDir[i])
					{
						if(!confirm(u5_file + ' <?php echo sTxtImageExists; ?>'))
						{
							return false;
						}
					}
				}
			}

			return true;
		}
function previewFont()
{

}

function unpreviewFont()
{
	document.getElementById("previewWindow").innerHTML = "<img src=" + document.getElementById("image_src").value + ">"
	
}
		</script>

		<title><?php echo sTxtInsertImage; ?></title>
		<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
		<body bgcolor=threedface style="border: 1px buttonhighlight;">
		<div class="appOutside">
		<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
			<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
			<span><?php echo sTxtInsertImageInst; ?></span>
		</div>
		<br>

<table  border="0" cellspacing="0" cellpadding="5">
  <tr> 
  <form enctype="multipart/form-data" action="<?php echo $HTTPStr . "://" . $url . $_SERVER["PHP_SELF"]; ?>?ToDo=UploadImage&DEP=<?php echo @$_GET["DEP"]; ?>&DEP1=<?php echo @$_GET["DEP1"]; ?>&imgDir=<?php echo $ImageDirectory; ?>&wi=<?php echo $HideWebImage; ?>&tn=<?php echo $tn; ?>&dd=<?php echo $dd; ?>&dt=<?php echo $dt; ?>&du=<?php echo $du; ?>" method="post" onSubmit="return CheckImageForm()">
    <td><?php if($HideWebImage != "1") { ?>
			<span class="appInside1" style="width:350px">
				<div class="appInside2">
					<div class="appInside3" style="padding:11px"><span class="appTitle"><?php echo sTxtExternalImage; ?></span>
						<br>
						<input type="text" name="externalImage" id="externalImage" class="Text240" value="http://">&nbsp;<input type=button value=<?php echo sTxtLoad; ?> class="Text75" onClick="insertExtImage()"><br>
						<div style="height:100; display:none" id="dummyDiv">
							&nbsp;
						</div>
					</div>
				</div>
			</span>
		<?php } else { ?>
			<span class="appInside1" style="width:3250px">
				<div class="appInside2">
					<div class="appInside3" style="padding:11px"><span class="appTitle"><font color="gray"><?php echo sTxtExternalImage; ?></font></span>
						<br>
						<input type="text" name="externalImage" id="externalImage" class="Text240" value="http://" disabled>&nbsp;<input type=button value=<?php echo sTxtLoad; ?> class="Text75" onClick="insertExtImage()" disabled>
					</div>
				</div>
			</span>
		<?php } ?>
		</td></form>
    <td rowspan="2" align=left><span class="appInside1" style="width:240px;height=210px ">
			<div class="appInside2">
				<div class="appInside3" style="padding:11px"><span class="appTitle"><?php echo sTxtPreview; ?></span><br>
					<span id="previewWindow" style="padding:10px; height:210px; width:240px; overflow: auto; border: 2px inset; background-color: #FFFFFF">
					</span><br><div  style="padding:5px" align=right>&nbsp;&nbsp;<input type="button" name="previewButton" value="<?php echo sTxtPreview; ?>" class="Text75" onClick="javascript:viewImage(selectedImage)" disabled=true >
				</div></div>
			</div>
		</span></td>
  </tr>
  <tr> 
    <td ><span class="appInside1" style="width:350px;">
			<div class="appInside2">
				<div class="appInside3" style="padding:11px"><span class="appTitle"><?php echo sTxtImageProperties; ?></span>
				<table border="0" cellspacing="0" cellpadding="5">
				  <tr>
				  <td class="body">图片地址:</td><td colspan="3" class="body"><input type="text" name="image_src" size="30" class="Text1982" onfocusin="previewFont()" onfocusout="unpreviewFont()">
				  </td>
				  <tr>
					<td class="body" width="70"><?php echo sTxtAltText; ?>:</td>
					<td class="body" width="88">
					  <input type="text" name="alt_tag" size="50" class="Text70">
					</td>
					<td class="body" width="80"><?php echo sTxtBorder; ?>:</td>
					<td class="body" width="80">
					<input type="text" name="border" size="3" class="Text70" maxlength="3" value="0">
					</td>
				  </tr>
				  <tr>
					<td class="body"><?php echo sTxtImageWidth; ?>:</td>
					<td class="body">
					  <input type="text" name="image_width" size="3" class="Text70" maxlength="3">
				  </td>
					<td class="body"><?php echo sTxtImageHeight; ?>:</td>
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
					<tr>
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
						<td class="body"><?php echo sTxtStyle; ?>:</td>
						<td class="body"><input type="text"  id=sStyles size="3" class="Text70" ></td>
					</tr>
				</table>
				</div>
			</div>
		</span></td>
  </tr>
</table>

		<div >
	
		</div>

		</div>

		<div align=right style="padding:11px">
		<input type="button" name="insertButton" value="<?php echo sTxtImageInsert; ?>" class="Text75" onClick="javascript:insertImage(selectedImage)" disabled=true>
		<input type="button" name="Submit" value="<?php echo sTxtCancel; ?>" class="Text75" onClick="javascript:window.close()">
		</div>

		</table>
<script>

		//document.img_src.value = window.opener.selectedImage.src
document.getElementById("image_src").value = window.opener.selectedImage.src;
		//alert(window.opener.selectedImage.src)
		</script>
		<script defer>

		if (window.opener.imageEdit)
		{
			selectedImage = window.opener.selectedImage.src;
			previewModify();
		}

		</script>