<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>图像旋转</title>

<script language="javascript">
function setImage( filename ){
	document.all.workImage.src = filename;
}
function m(){
	c = box.mode1;
	if( c.selectedIndex == 0 ) return;
	box.mode.value = c.options[c.selectedIndex].value;
	if( parent )
	    parent.apply();
}

function init(){
	if( parent )
	    parent.setWorkImage();
}
</script>
<link href="photoEditor/album.css" rel="stylesheet" type="text/css">
</head>

<body onload="init()"  bgcolor=threedface>
<div style="position:absolute;overflow:auto;border:1 solid white;left:0px; top:40px;width:100%;height:428px;background-color:threedface" align=left>
   <img id=workImage src="photoEditor/images/none.gif" style="position:absolute;top:0;left:0;">
</div>
<form method="post" name=box action="">  
<table width="100%" height="40" border="0">
  <tr>
    <td align="center" valign="middle">旋转: <select id="mode1" name="mode1" size="1" >
<option value="0">----------请选择方式----------</option>
<option value="1">逆时针旋转90&deg;</option>
<option value="2">顺时针旋转90&deg;</option>
<option value="3">旋转180&deg;</option>
<option value="4">水平镜像</option>
<option value="5">垂直镜像</option>
<option value="6">右翻转(逆时针旋转90&deg;+ 水平镜像)</option>
<option value="7">左翻转(顺时针旋转90&deg;+ 水平镜像)</option>
</select> &nbsp; &nbsp; <input name="appbtn" type="button" class="btn" value=" 确 定 " onClick="m()"></td>
  </tr>
</table>
<input id="mode" name="mode" type="hidden" value="1">
</form>		
</body>
</html>
