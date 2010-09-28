<script type="text/javascript" src="de_includes/de_colors.js"></script>
<script language=javascript>
var myPage = window.opener;

document.onkeydown = function () { 
	if (event.keyCode == 13) {	// ENTER
		doColors()
	}
	if(event.ctrlKey) {
		if(event.keyCode == 09 || event.keyCode == 90) {	//Ctrl+Tab
		window.close()
		}
	}
	if(event.ctrlKey) {
		if(event.keyCode == 83) {	//Ctrl+S
		doColors()
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

function doColors() {
	window.opener.doColor(myColor);
	self.close();
}

</script>

<style>
.outerSlideContainer	{width: 210; height: 14;  margin-top: 3px; margin-bottom: 0; border: 0px solid #FFFFFF; position:relative; }
.gradContainer			{width: 200; height: 14; position: absolute; z-index: 4; font-size: 1; overflow: hidden; margin-left: 4px;}
.sliderHandle			{width: 9; height: 12; cursor: hand; border: 0 outset white; overflow: hidden; z-index: 5;}
.lineContainer1			{width: 199; height: 6; z-index: 0; margin-left: 5px;}
.lineContainer2			{width: 66; height: 6; z-index: 0; }
.line1				{width: 199; height: 14; z-index: 0; overflow: hidden; filter: alpha(style=1)}
.line2				{width: 66; height: 14; z-index: 0; overflow: hidden; filter: alpha(style=1)}
#colorBox			{width: 20; height: 20; border: 1 inset window; margin-left: 2px;}
#colorImage			{width: 164; height: 20; border: 1px inset window; cursor: hand;}
body	{ margin: 10px;}
</style>

<title>[sTxtColors]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;" onload="init()">
<div class="appOutside">

<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtColorsInst]</span>
</div>
<br>
	 	  
<table border="0" cellspacing="0" cellpadding="0" style="width:93%">
  <tr> 
	<td class="body">

<span class="appInside1" style="width:235px; height:100%">
	<div class="appInside2">
		<div class="appInside3" style="padding:11px"><span class="appTitle"></span>

<span style="background-color: #000000; width:200px; height:200px; border: 0px solid #000000"><img id=colorImg galleryimg="no" src="de_images/popups/color.jpg" width=200 height=200 onClick="doColor(this)" style="filter:alpha(opacity=100);"><img id=cursorImg width=11 height=11 src="de_images/popups/cursor.gif" style="position:absolute;" onmousedown="drags()" galleryimg="no"></span>
<span class="outerSlideContainer">
	<div class="gradContainer" onclick="clickOnGrad(vSlider)"></div>
	<span class="lineContainer1" id="redLeft" style="background: RGB(255, 255, 255);">
		<div class="line1" id="redLeft2" style="background: RGB(0,0,0);"></div>
		<div id=win98 style="display:none"><img src="de_images/popups/win98_transition.jpg" width=199 height=14></div>
	</span>
	<div class="sliderHandle" id="vSlider" type="x" value="0" onchange="update(this)"><img src="de_images/popups/arrow.gif" width=9 height=12></div>
</span>
<input type=hidden id=hBox value="0">
<input type=hidden id=sBox value="0">
<input type=hidden id=lBox value="0">

</div>
</div>
</span>

</td>
	<td class=body align=right>
<span class="appInside1" style="width:100px; height:100%;">
	<div class="appInside2">
		<div class="appInside3" style="padding:11px">
		<table cellspacing=0 cellpadding=5 border=0>
		<tr>
		<td class=body>Red:</td>
		<td><input type=text id=rBox onkeydown="checkInputRGB()" maxlength=3 onChange="doRGB()" class=Text50></td>
		</tr>
		<tr>
		<td class=body>Green:</td>
		<td><input type=text id=gBox onkeydown="checkInputRGB()" maxlength=3 onChange="doRGB()" class=Text50></td>
		<tr>
		<td class=body>Blue:</td>
		<td><input type=text id=bBox onkeydown="checkInputRGB()" maxlength=3 onChange="doRGB()" class=Text50></td>
		</tr>
		<tr>
		<td class=body>HEX:</td>
		<td class=body><input type=text id=hexBox onChange="HexToRGB(this.value)" onkeydown="checkInputHex()" maxlength=6 class=Text50></td>
		</tr>
		</table>
		<br>
		<div id=myColor><div id=colorBox style="width:100px; height:90px; border: 1px solid #000000"></div></div>
		</div>
	</div>
</span>

	</td>
  </tr>
</table>

</div>
<div style="padding-top: 6px; float: right;">
<input type="button" name="doColors" value="[sTxtOK]" class="Text75" onClick="javascript:doColors();">
<input type="button" name="Submit" value="[sTxtCancel]" class="Text75" onClick="javascript:window.close()">
</div>