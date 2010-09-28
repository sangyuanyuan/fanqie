<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>图像切割</title>
<style>
body {  margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;FONT-SIZE: 9pt; LINE-HEIGHT: 18px; FONT-FAMILY: "宋体"}
form {  margin: 0px; padding: 0px; }
.movetag { cursor:move; }
.sizetag { cursor:SE-resize;background-color:#ffffff;border:1 solid black;position:absolute;left:96;top:96;width:7;height:7;z-index:3}
</style>
<script language="javascript">

var dragapproved=false;
var offx=0,offy=0;

function setImage( filename ){
	document.all.bgImage.src = filename;
	document.all.workImage.src = filename;
	setbox("xy",0,0,0);
}

function move(){
	if (event.button==1&&dragapproved){
		var z = document.all.selectbox;
		x = offx + event.clientX ;
		if(x < 0 )	x = 0;
		if(x >= document.all.workImage.width )	x = document.all.workImage.width - 2;
		y = offy + event.clientY ;
		if(y < 0 )	y = 0;
		if(y >= document.all.workImage.height )	y = document.all.workImage.height - 2;
		setbox("xy",x,y,0);
		return false;
	}
	return true;
}
function resizebox(){
	if (event.button==1&&dragapproved){
		w = offx + event.clientX;
		if(w <= 0 )	w = 1;
		h = offy + event.clientY;
		if(h <= 0 )	h = 1;
		setbox("wh",w,h,0);
		return false;
	}
	return true;
}
function setbox( field, xw, yh, whr ){
    var x=0,y=0,zw=0,zh=0;
    switch( field ){
        case "xy":
            box.x.value = x = xw;
            box.y.value = y = yh;

			box.view_x.value = box.x.value;
            box.view_y.value = box.y.value;
			//box.view_w.value = box.w.value;
			//box.view_h.value = box.h.value;
            break;
        case "whr":
            if( xw > 0 ) {
                box.w.value = xw;
				box.view_w.value = box.w.value;
				box.view_h.value = box.h.value;
			}
            if( yh > 0 ) {
                box.h.value = yh;
				box.view_h.value = box.h.value;
				box.view_w.value = box.w.value;
			}
            box.whr.value = whr;
            break;
    	case "wh":
            box.w.value = xw;
            if( eval(box.whr.value) > 0 ) {
                box.h.value = xw/eval(box.whr.value);
				box.view_h.value = box.h.value;
				box.view_w.value = box.w.value;

            } else {
				box.view_w.value = box.w.value;
                box.h.value = yh;
				box.view_h.value = box.h.value;

            }
			break;
    }
    x = eval( box.x.value );
    y = eval( box.y.value );
    zw = eval( box.w.value ) + x;
    zh = eval( box.h.value ) + y;

    document.all.boxbordor.style.width = zw - x;
    document.all.boxbordor.style.height = zh - y;
    document.all.boxbordor.style.pixelLeft = x;
    document.all.boxbordor.style.pixelTop = y;

    document.all.selectbox.style.width = zw ;
    document.all.selectbox.style.height = zh ;
    document.all.sizetag.style.pixelLeft = zw - 4;
    document.all.sizetag.style.pixelTop = zh - 4;
    document.all.selectbox.style.clip = "rect("+ y +"," + zw + "," + zh + ","+ x +")";

}

function drags(){
    if (!document.all)	return true;
    var z = event.srcElement;
    if (z.className=="movetag"){
        dragapproved=true;
        offx = eval(box.x.value) - event.clientX;
        offy = eval(box.y.value) - event.clientY;
        document.onmousemove = move;
        return false;
    }
    if (z.className=="sizetag"){
        dragapproved=true;
        offx = eval(box.w.value) - event.clientX;
        offy = eval(box.h.value) - event.clientY;
        document.onmousemove = resizebox;
        return false;
    }
    return true;
}

document.onmousedown=drags;
document.onmouseup=new Function("dragapproved=false;");

function init(){
	if( parent ){
	    parent.setWorkImage();
	    parent.setCropbox();
	}
}

function apply(){
	if( parent ){
	    parent.apply();
	}
}

function setCropbox(){
	if( parent ){
	    f = document.box.fixbox.checked;
		parent.document.all.fixbox.value = f;
		parent.setCropbox();
	}
}

</script>
<link href="photoEditor/album.css" rel="stylesheet" type="text/css">
</head>

<body onload="init()" bgcolor=threedface>
<form method="post"  name=box action="">  
    <table width="100%" height="39" border="0" cellpadding="0" cellspacing="0">
      <tr valign="middle">
        <td >&nbsp;&nbsp;&nbsp;&nbsp;	X：<input type="text" name="view_x"   value="0" size=3 disabled style="border: 0px none;">
&nbsp;Y：<input type="text" name="view_y"   value="0" size=3 disabled style="border: 0px none;">
&nbsp;长：<input type="text" name="view_w"   value="100" size=3 disabled style="border: 0px none;">
&nbsp;宽：<input type="text" name="view_h"   value="100" size=3 disabled style="border: 0px none;"></td>
        <td align="left"><input name="appbtn" type="button" class="btn" value=" 确 定 " onClick="apply()">
	</td>
      </tr>
    </table>
<input type="hidden" name="x"   value="0">
<input type="hidden" name="y"   value="0">
<input type="hidden" name="w"   value="100">
<input type="hidden" name="h"   value="100">
<input type="hidden" name="whr" value="0">
<input type="hidden" name="zoom" value="100">

</form>
<table  width="100%" border="0" cellpadding="0" cellspacing="0"  >
<tr height=2> 
	<td align=center><img src="../de_images/vertical_spacer.gif" width="100%" height="2" tabindex=1 HIDEFOCUS></td>
  </tr>
  <tr height=1> 
	<td align=center></td>
  </tr>
  </table> 
<div style="position:absolute;overflow:auto;border:0 solid white;left:0px; top:40px;width:100%;height:428px;background-color:#threedface" align=left>
    <img id=bgImage src="photoEditor/images/none.gif" style="filter:alpha(opacity:60);position:absolute;top:0;left:0;z-index:1">
    <div class="movetag" id=selectbox style="position:absolute;overflow:hidden;clip:rect(0 100 100 0);width:100;height:100;left:1; top:1;z-index:3" valign=middle align=center>
      <img class="movetag" id=workImage src="photoEditor/images/none.gif" style="position:absolute;top:0;left:0;">
      <div class="movetag" id="boxbordor" style="position:absolute;width:100;height:100;left:0; top:0;border:1 solid red;"></div>
    </div>
    <div class="sizetag" id="sizetag" title="按此处拖动鼠标改变大小"><img src="" width=2 height=2></div>
</div>
	
</body>
</html>
