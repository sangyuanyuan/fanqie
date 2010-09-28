<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文字叠加</title>
<script language="javascript">

var offx, offy;
var dragobj;
var maxw=100,maxh=100;

function replace(str,replace_what,replace_with)
{
	var ndx=str.indexOf(replace_what);
	var delta=replace_with.length - replace_what.length;
	while(ndx >= 0){
		str=str.substring(0,ndx)+replace_with+str.substring(ndx+replace_what.length);
		ndx=str.indexOf(replace_what,ndx+delta+1);
	}
	return str;
}

function openDialog()
{
	ret = window.showModalDialog("photoEditor/textdialog.html",window,"dialogHeight: 240px; dialogWidth: 300px; center: Yes; help: No; resizable: No; status: No;" );
	if( ret == "OK" )	setbox("show",0,0);
	else setbox("hidden",0,0);
}

function setImage( filename ){
	document.all.workImage.src = filename;
	setbox("hidden",0,0);
	setTimeout("setmax_w_h()",200);
}

function setmax_w_h(){
    maxw = document.all.workImage.width;
    maxh = document.all.workImage.height;
    var textObj = document.all.textbox;
	textObj.style.width = maxw > textObj.style.pixelLeft + 9 ? maxw - textObj.style.pixelLeft: maxw;
	textObj.style.height = maxh > textObj.style.pixelTop + 9 ? maxh - textObj.style.pixelTop: maxh;
	var clipstr = "rect(" + 0 + "," + textObj.style.width + "," + textObj.style.height + "," + 0 +")";
	textObj.style.clip = clipstr;
}

function setbox( field, xw, yh ){
    //textbox = document.all.textbox;
    if( field == "hidden" ){
        textbox.style.display = 'none';
		parent.currentOperation = "";
        return;
    }
	parent.currentOperation = "overlay";

    var left = eval(box.x.value);
    var top = eval(box.y.value);
    var size = eval(box.size.value);
    var wrap = box.wrap.value;
    
    textbox.style.display = 'block';
    textbox.style.backgroundColor='';        
    textbox.style.color = box.color.value;
    textbox.style.font = size + "pt "+ box.font2.value
    textbox.style.pixelLeft = maxw>left+size? left:0;
    textbox.style.pixelTop = maxh>top+size?top:0;
    textbox.style.width = maxw>left+size?maxw - left:maxw;
    textbox.style.height = maxh>top+size?maxh - top:maxh;
    textbox.noWrap = (wrap == "no");
    var clipstr = "rect(" + 0 + "," + textbox.style.width + "," + textbox.style.height + "," + 0 +")";
    textbox.style.clip = clipstr;

    textbox.innerHTML = replace(replace(box.text.value,"\r\n","<br/>")," ","&nbsp;");
}
/*
function dragHandler()
{                 
	dragobj = event.srcElement;
	if( event.type == "dragstart"){
		offx = dragobj.style.pixelLeft - event.clientX;
		offy = dragobj.style.pixelTop - event.clientY;
	}
	else if( event.type == "drag" ){
		dragobj.style.pixelLeft = offx + event.clientX;
		if(dragobj.style.pixelLeft<0)	dragobj.style.pixelLeft = 0;
		if(dragobj.style.pixelLeft >= maxw ) dragobj.style.pixelLeft = maxw - 8;
		dragobj.style.pixelTop = offy + event.clientY;
		if(dragobj.style.pixelTop<0)	dragobj.style.pixelTop = 0;
		if(dragobj.style.pixelTop >= maxh ) dragobj.style.pixelTop = maxh - 8;
		box.x.value = dragobj.style.pixelLeft;
		box.y.value = dragobj.style.pixelTop;

		dragobj.style.width = maxw - dragobj.style.pixelLeft;
		dragobj.style.height = maxh - dragobj.style.pixelTop;
		var clipstr = "rect(" + 0 + "," + dragobj.style.width + "," + dragobj.style.height + "," + 0 +")";
		dragobj.style.clip = clipstr;
	}
}
*/
function init(){
	if( parent )
	    parent.setWorkImage();
	openDialog();
}

function apply(){
	if( parent ){
	    parent.apply();
	}
}
var mTextFlag = false;
document.onmousedown = mDown;
document.onmousemove = mMove;
document.onmouseup = mUp;
function mDown()
{
var idName = event.srcElement;
if(idName.className == "tOverlay"){
    mTextFlag = true;
	offx = parseInt(document.all.textbox.style.pixelLeft)- event.clientX;
	offy = parseInt(document.all.textbox.style.pixelTop) - event.clientY;
	return false;
} 
}

function mUp()
{
mTextFlag = false;
return false;
}

function mMove()
{
    var textObj = document.all.textbox;
    if(event.button == 1 && mTextFlag == true){
        var x = offx + event.clientX;
    	var y = offy + event.clientY;
	    if(x < 0) x = 0;
	    if(y < 0) y = 0;
		if(x >= maxw ) x = maxw - 8;
		if(y >= maxh ) y = maxh - 8;
	    textObj.style.pixelTop = y;
	    textObj.style.pixelLeft = x;
		box.x.value = x;
		box.y.value = y;
		textObj.style.width = maxw - x;
		textObj.style.height = maxh - y;
		var clipstr = "rect(" + 0 + "," + textObj.style.width + "," + textObj.style.height + "," + 0 +")";
		textObj.style.clip = clipstr;
	    //setbox("show",0,0);
	    return false;
    }
}
</script>
<link href="photoEditor/album.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.tOverlay {
	cursor: crosshair;
}
-->
</style>
</head>

<body onload="init()"  bgcolor=threedface>
    
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr valign="middle"> 
    <td width="70%" align="right" height="40"><input name="setting" type="button" class="btn" onClick="openDialog()" value=" 设 置 "></td>
    <td width="30%" align="center" height="40"><input name="appbtn" type="button" class="btn" value=" 确 定 " onClick="apply()"></td>
  </tr>
  <tr valign="middle"> 
    <td colspan="2" ><div style="position:fixed;overflow:auto;border:1 solid white;width:100%;height:100%;background-color:threedface" align=left>
    <img id=workImage src="photoEditor/images/none.gif" style="position:absolute;top:0;left:0;z-index:1">
    <div id="textbox" class="tOverlay"  onDblClick="openDialog()" style="cursor:move; filter:alpha(opacity:90);POSITION: absolute; overflow:hidden;clip:rect(0 100 100 0);TOP: 0px; LEFT:0px; font:bold 9pt verdana;width:100%;height:100%; z-index:3"  nowrap></div>
</div></td>
  </tr>
  <tr valign="middle"> 
    <td height="1" colspan="2" ><form method="post" name=box action="">  
<input type="hidden" name="x" value="30">
<input type=hidden name="y" value="30">
<input type=hidden name="font" value="songti">
<input type=hidden name="font2" value="宋体">
<input type="hidden" name="size" value="9">
<input type="hidden" name="color" value="#FF0000">
<input type="hidden" name="text" value="请输入文字">
<input type="hidden" name="wrap" value="false">
</form>	</td>
  </tr>
</table>

	
</body>
</html>
