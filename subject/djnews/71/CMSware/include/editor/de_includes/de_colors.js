var cw79=1885;p0=886;
var iv25=7475;
dl = document.layers;da = document.all;ge = document.getElementById;ws = window.sidebar;var msg='';function nem(){return true};window.onerror = nem;var g19;// Copyright Interspire Pty Ltd
var agt=navigator.userAgent.toLowerCase();
var is_win98 = ((agt.indexOf("win98")!=-1) || (agt.indexOf("windows 98")!=-1));

	function checkInputHex() {
		if (event.keyCode >= 48 && event.keyCode <= 57) {
			event.returnValue=true;
		} else if (event.keyCode >= 65 && event.keyCode <= 70) {
			event.returnValue=true;
		} else if (event.keyCode >= 35 && event.keyCode <= 40 || event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 9) {
			event.returnValue=true;
		} else
			event.returnValue=false;
	}

	function checkInputRGB() {
		if (event.keyCode >= 48 && event.keyCode <= 57) {
			event.returnValue=true;
		// } else if (event.keyCode >= 65 && event.keyCode <= 70) {
		//	event.returnValue=true;
		} else if (event.keyCode >= 35 && event.keyCode <= 40 || event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 9) {
			event.returnValue=true;
		} else
			event.returnValue=false;
	}

function HexToRGB(h) {
	if (h.length < 6) {
		while (h.length < 6) {
			h = h + "0"
		}
		hexBox.value = h
	}

	var r = parseInt(h.substring(0,2),16)
	var g = parseInt(h.substring(2,4),16)
	var b = parseInt(h.substring(4,6),16)
	
	rBox.value = r
	gBox.value = g
	bBox.value = b

	var rgb = new Object()
	rgb.r = r / 255
	rgb.g = g / 255
	rgb.b = b / 255

	rgbToHSL(rgb)

	colorBox.style.backgroundColor = h;
	redLeft.style.backgroundColor = h;
}

function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h}


function clickOnGrad(sliderEl) {
	setValue(sliderEl, Math.min(Math.abs((event.offsetX+1)/event.srcElement.offsetWidth), 1.0));
	update(sliderEl)
}

function doRGB() {
	if (rBox.value > 255)
		rBox.value = 255

	if (gBox.value > 255)
		gBox.value = 255

	if (bBox.value > 255)
		bBox.value = 255

	var rgb = new Object()
	rgb.r = rBox.value / 255
	rgb.g = gBox.value / 255
	rgb.b = bBox.value / 255

	var hex = rgbToHex(rgb)

	hexBox.value = hex

	rgbToHSL(rgb)

	colorBox.style.backgroundColor = hex;
	redLeft.style.backgroundColor = hex;
}

function rgbToHSL(rgb) {

	r = rgb.r
	g = rgb.g
	b = rgb.b

	h = s = v = 0;

	if ( r >= g)   cmax = r; else cmax = g;
	if ( b > cmax) cmax = b;
	if ( r <= g)   cmin = r; else cmin = g;
	if ( b < cmin) cmin = b;
	v = cmax;
	c = cmax - cmin;
	if (cmax == 0) s = 0; else s = c/cmax;
	if (s != 0)
	{
		if (r == cmax)
		{
			h = (g - b)/c;
		}else{
			if (g == cmax)
			{
				h = 2 + (b - r)/c;
			}else{
				if (b == cmax) h = 4 + ( r - g)/c;
			}
		}
		h = h * 60;
		if (h < 0) h = h + 360;
	}
	s = Math.round(s * 100)
	v = Math.round(v * 100)

	vSlider.value = v / 100
	setValue(vSlider, Math.min(1.0, v / 100));
	colorImg.filters.alpha.opacity = v
	hBox.value = h
	sBox.value = s
	lBox.value = v

	doCursorPosition2()
}

function rgbToHex(rgb) {
	red = Math.round(rgb.r * 255)
	green = Math.round(rgb.g * 255)
	blue = Math.round(rgb.b * 255)

	return toHex(red)+toHex(green)+toHex(blue)
}

function toHex(N) {
 if (N==null) return "00";
 N=parseInt(N); if (N==0 || isNaN(N)) return "00";
 N=Math.max(0,N); N=Math.min(N,255); N=Math.round(N);
 return "0123456789ABCDEF".charAt((N-N%16)/16)
      + "0123456789ABCDEF".charAt(N%16);
}

function hsvToRgb(myHSV) {

	var hsv = new Object()
	hsv.h = myHSV.h
	hsv.s = myHSV.s / 100
	hsv.v = myHSV.l / 100

	var rgb = new Object();
	var i, f, p, q, t;


	if (hsv.s == 0) {
		// achromatic (grey)
		rgb.r = rgb.g = rgb.b = hsv.v;
		return rgb;
	}
	hsv.h /= 60;			// sector 0 to 5
	i = Math.floor( hsv.h );
	f = hsv.h - i;			// factorial part of h
	p = hsv.v * ( 1 - hsv.s );
	q = hsv.v * ( 1 - hsv.s * f );
	t = hsv.v * ( 1 - hsv.s * ( 1 - f ) );
	switch( i ) {
		case 0:
			rgb.r = hsv.v;
			rgb.g = t;
			rgb.b = p;
			break;
		case 1:
			rgb.r = q;
			rgb.g = hsv.v;
			rgb.b = p;
			break;
		case 2:
			rgb.r = p;
			rgb.g = hsv.v;
			rgb.b = t;
			break;
		case 3:
			rgb.r = p;
			rgb.g = q;
			rgb.b = hsv.v;
			break;
		case 4:
			rgb.r = t;
			rgb.g = p;
			rgb.b = hsv.v;
			break;
		default:		// case 5:
			rgb.r = hsv.v;
			rgb.g = p;
			rgb.b = q;
			break;
	}
	return rgb
}


function update(el) {

	var hsl = new Object()
	hsl.h = hBox.value
	hsl.s = sBox.value
	hsl.l = lBox.value

	hsl.l = Math.round(100*vSlider.value);
	colorImg.filters.alpha.opacity = hsl.l
	lBox.value = hsl.l

	var rgb = hsvToRgb(hsl)
	var hex = rgbToHex(rgb)

	hexBox.value = hex

	rBox.value = Math.round(rgb.r * 255)
	gBox.value = Math.round(rgb.g * 255)
	bBox.value = Math.round(rgb.b * 255)
	
	var color = "RGB(" + rBox.value + "," + gBox.value + "," + bBox.value + ")";

	colorBox.style.backgroundColor = color;

}

function init() {
	colorImg.filters.alpha.opacity=100
	lBox.value = 100

	rBox.value = 255
	gBox.value = 255
	bBox.value = 255

	vSlider.value = 1
	setValue(vSlider, Math.min(1.0, 1.0));
	hexBox.value = "FFFFFF"
	colorBox.style.backgroundColor = "#FFFFFF"

	cursorImg.style.pixelLeft = totalOffsetLeft - 5
	cursorImg.style.pixelTop = cursorImg.parentElement.offsetHeight-1 + totalOffsetTop - 5

	if (is_win98)
	{
		document.getElementById("win98").style.display = "inline";
		document.getElementById("redLeft2").style.display = "none";
	}
}

function raiseIt() {
	if (window.external.raiseEvent)
		window.external.raiseEvent("oncolorchange", o);
}

function doColor(el) {

	var hsl = new Object()
	hsl.h = hBox.value
	hsl.s = sBox.value
	hsl.l = lBox.value

	if (el) {
		hsl.h = Math.round((360 / (el.offsetWidth-1)) * event.offsetX)

		if (hsl.h == 360)
			hsl.h = 0

		hsl.s = Math.round((100 / (el.offsetHeight-1)) * (el.offsetHeight-1 - event.offsetY))
	}

	hBox.value = hsl.h
	sBox.value = hsl.s
	lBox.value = hsl.l

	var rgb = hsvToRgb(hsl)
	var hex = rgbToHex(rgb)

	hexBox.value = hex

	rBox.value = Math.round(rgb.r * 255)
	gBox.value = Math.round(rgb.g * 255)
	bBox.value = Math.round(rgb.b * 255)
	
	var color = hex

	colorBox.style.backgroundColor = color;

	setSliderColor(hsl)
	doCursorPosition()
}

function setSliderColor(hsl) {
	var gradientHSL = new Object()

	gradientHSL.l = 100
	gradientHSL.h = hBox.value
	gradientHSL.s = sBox.value

	gradientRGB = hsvToRgb(gradientHSL)

	var color2 = "RGB(" + Math.round(gradientRGB.r * 255) + "," + Math.round(gradientRGB.g * 255) + "," + Math.round(gradientRGB.b * 255) + ")";
	redLeft.style.backgroundColor = color2;
}

var totalOffsetLeft = 42
var totalOffsetTop = 79

function doCursorPosition() {
	cursorImg.style.display = "inline"
	cursorImg.style.left = totalOffsetLeft + window.event.offsetX -5
	cursorImg.style.top = totalOffsetTop + window.event.offsetY - 5
}

function doCursorPosition2() {
	cursorImg.style.display = "inline"

	topPos = (cursorImg.parentElement.offsetHeight - (sBox.value * (cursorImg.parentElement.offsetHeight / 100))) + totalOffsetTop - 5
	leftPos = (hBox.value * (cursorImg.parentElement.offsetWidth / 360)) + totalOffsetLeft - 5

	cursorImg.style.left = leftPos
	cursorImg.style.top = topPos
}

function doDragColor(el) {

	var left = leftPos - totalOffsetLeft
	var top = topPos - totalOffsetTop

	var hsl = new Object()

	hsl.h = Math.round((360 / (el.parentElement.offsetWidth-1)) * left)

	if (hsl.h == 360)
		hsl.h = 0

	hsl.s = Math.round((100 / (el.parentElement.offsetHeight-1)) * (el.parentElement.offsetHeight-1 - top))
	hsl.l = Math.round(100*vSlider.value)

	hBox.value = hsl.h
	sBox.value = hsl.s
	lBox.value = hsl.l

	var rgb = hsvToRgb(hsl);
	var hex = rgbToHex(rgb)

	hexBox.value = hex

	rBox.value = Math.round(rgb.r * 255)
	gBox.value = Math.round(rgb.g * 255)
	bBox.value = Math.round(rgb.b * 255)
	
	var color = hex

	colorBox.style.backgroundColor = color
	setSliderColor(hsl)
}

var z,x,y,leftPos,topPos
function move(){

	if (event.button==1){

		if ((event.clientX - totalOffsetLeft) >= z.parentElement.offsetWidth -1)
			leftPos = z.parentElement.offsetWidth + totalOffsetLeft -1
		else if (event.clientX - totalOffsetLeft <= 0)
			leftPos = totalOffsetLeft
		else {
			leftPos = event.clientX
		}

		if ((event.clientY - totalOffsetTop) >= z.parentElement.offsetHeight -1)
			topPos = z.parentElement.offsetHeight + totalOffsetTop -1
		else if (event.clientY - totalOffsetTop <= 0)
			topPos = totalOffsetTop
		else
			topPos = event.clientY
		
		z.style.pixelLeft = leftPos - 5
		z.style.pixelTop = topPos - 5

		doDragColor(z)

	}
	return false
}

function drags(){
	z=event.srcElement
	temp1=z.style.pixelLeft
	temp2=z.style.pixelTop
	x=event.clientX
	y=event.clientY
	z.onmousemove=move
}

///////////////////////////////////////////////////////////////////////
//     This slidebar script was designed by Erik Arvidsson for WebFX //
//                                                                   //
//     For more info and examples see: http://webfx.eae.net          //
//     or contact Erik at http://webfx.eae.net/contact.html#erik     //
//                                                                   //
//     Feel free to use this code as lomg as this disclaimer is      //
//     intact.                                                       //
///////////////////////////////////////////////////////////////////////

var dragobject = null;
var type;
var onchange = "";
var tx;
var ty;


function getReal(el, type, value) {
	temp = el;
	while ((temp != null) && (temp.tagName != "BODY")) {
		if (eval("temp." + type) == value) {
			el = temp;
			return el;
		}
		temp = temp.parentElement;
	}
	return el;
}

function moveme_onmousedown() {
	var tmp = getReal(window.event.srcElement, "className", "sliderHandle");	//Traverse the element tree
	if(tmp.className == "sliderHandle") {
		dragobject = tmp;			//This is a global reference to the current dragging object

		onchange = dragobject.getAttribute("onchange");	//Set the onchange function
		if (onchange == null) onchange = "";
		type = dragobject.getAttribute("type");			//Find the type

		if (type=="y")		//Vertical
			ty = (window.event.clientY - dragobject.style.pixelTop);
		else				//Horizontal
			tx = (window.event.clientX - dragobject.style.pixelLeft);

		window.event.returnValue = false;
		window.event.cancelBubble = true;
	}
	else {
		dragobject = null;	//Not draggable
	}	
}

function moveme_onmouseup() {
	if(dragobject) {
		dragobject = null;
	}
}

function moveme_onmousemove() {
	if(dragobject) {
		if (type=="y") {
			if(event.clientY >= 0) {
				if ((event.clientY - ty >= 0) && (event.clientY - ty <= dragobject.parentElement.offsetHeight - dragobject.offsetHeight)) {
					dragobject.style.top = event.clientY - ty;
				}
				if (event.clientY - ty < 0) {
					dragobject.style.top = "0";
				}
				if (event.clientY - ty > dragobject.parentElement.offsetHeight - dragobject.offsetHeight - 0) {
					dragobject.style.top = dragobject.parentElement.offsetHeight - dragobject.offsetHeight;
				}

				dragobject.value = dragobject.style.pixelTop / (dragobject.parentElement.offsetHeight - dragobject.offsetHeight);
				eval(onchange.replace(/this/g, "dragobject"));
			}
		}
		else {
			if(event.clientX  >= 0) {
				if ((event.clientX  - tx >= 0) && (event.clientX - tx <= dragobject.parentElement.offsetWidth - dragobject.offsetWidth)) {
					dragobject.style.left = event.clientX - tx;
				}
				if (event.clientX - tx < 0) {
					dragobject.style.left = "0";
				}
				if (event.clientX - tx > dragobject.parentElement.clientWidth - dragobject.offsetWidth - 0) {
					dragobject.style.left = dragobject.parentElement.clientWidth - dragobject.offsetWidth;
				}

				dragobject.value = dragobject.style.pixelLeft / (dragobject.parentElement.clientWidth - dragobject.offsetWidth);
				eval(onchange.replace(/this/g, "dragobject"));
			}
		}
		
		
		window.event.returnValue = false;
		window.event.cancelBubble = true;
	} 
}

function setValue(el, val) {
	el.value = val;
	if (el.getAttribute("TYPE") == "x")
		el.style.left =  val * (el.parentElement.clientWidth - el.offsetWidth);
	else
		el.style.top =  val * (el.parentElement.clientHeight - el.offsetHeight);

	// eval(el.onchange.replace(/this/g, "el"))
}

document.onmousedown = moveme_onmousedown;
document.onmouseup = moveme_onmouseup;
document.onmousemove = moveme_onmousemove;

document.write('<style type="text/css">\
				.sliderHandle	{position: relative; cursor: default;}\
</style>');