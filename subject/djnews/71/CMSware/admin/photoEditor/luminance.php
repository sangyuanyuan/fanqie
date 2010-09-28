<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>亮度调整</title>
<link href="photoEditor/album.css" rel="stylesheet" type="text/css">
<script language="javascript">
function setImage( filename ){
	document.all.workImage.src = filename;
}
function m( offset ){
	currentControl = box.level;
	currentControl.value = eval(currentControl.value) + offset;
	if(currentControl.value < 1 )
		currentControl.value = 1;
	if(currentControl.value > 100)
		currentControl.value = 100;
}

function init(){
	if( parent )
	    parent.setWorkImage();
}
var offx,offy;

function dragHandler( obj, minval, maxval)
{                 
	var dragobj = event.srcElement;
	if( event.type == "dragstart"){
		offx = dragobj.style.pixelLeft - event.clientX;
	}
	else if( event.type == "drag" ){
		dragobj.style.pixelLeft = offx + event.clientX;
		if(dragobj.style.pixelLeft< -190)	dragobj.style.pixelLeft = -190;
		if(dragobj.style.pixelLeft > -14 ) dragobj.style.pixelLeft = -14;
        obj.value = Math.ceil((maxval-minval)*(190+ dragobj.style.pixelLeft)/176) + minval;
	}
	//window.status = dragobj.style.pixelLeft +":"+ event.clientX;
}
function setDefault(){
	document.all.level.value=0;
	document.all.level_bar.style.pixelLeft = -102;
}
function apply(){
	if( parent ){
	    parent.apply();
	}
}
</script>
</head>

<body onload="init()" bgcolor=threedface>
<div style="position:absolute;overflow:auto;border:1 solid white;left:0px; top:40px;width:100%;height:428px;background-color:threedface" align=left>
   <img id=workImage src="photoEditor/images/none.gif" style="position:absolute;top:0;left:0;">
</div>
<form method="post" name=box action="" onsubmit="return false;">  
<table width="440" border="0">
  <tr>
    <td width="30" nowrap>亮度:</td>
    <td width="210" ><img src="photoEditor/images/slidebar.gif" width="195" height="37"><img id="level_bar" class="bSlideMove" src="photoEditor/images/slidemove.gif" width="11" height="21" style="position:relative;left:-102px;top:-2px" ondragstart="dragHandler()" ondrag="dragHandler(document.all.level,-50,50)" ></td>
    <td align="left"><input name="level" type="text" disabled="true" class="textform" id="level" value="0" size="3" style="width:27">
        <input name="Button" type="button" class="btn" value="缺省值" onClick="setDefault()"> &nbsp;
		<input name="Button" type="button" class="btn" value="确 定" onClick="apply()"></td>
  </tr>
</table>

 
</form>		
</body>
</html>
