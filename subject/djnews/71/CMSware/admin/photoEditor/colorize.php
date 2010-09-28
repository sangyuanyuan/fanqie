<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>颜色调整</title>
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
<form method="post" name=box action="" onSubmit="return false;">  
<table width="100%" height="40" border="0">
  <tr>
    <td align="center" valign="middle">颜色转换: <select name="mode1" size="1" >
<option value="0">---请选择---</option>
<option value="3">灰度效果</option>
<option value="1">色彩反转效果</option>
<option value="2">灰度反转效果</option>
<option value="4">单色效果</option>
<option value="5">黑白沙粒效果</option>
<!--option value="6">灰度转伪彩色效果</option-->
</select>&nbsp; &nbsp; <input name="appbtn" type="button" class="btn" value=" 确 定 " onClick="m()"></td>
  
  </tr>
</table>

<input id="mode" name="mode" type="hidden" value="3">
</form>		
<div style="position:absolute;overflow:auto;border:1 solid white;left:0px; top:40px;width:100%;height:428px;background-color:threedface" align=left>
   <img id=workImage src="photoEditor/images/none.gif" style="position:absolute;top:0;left:0;">
</div></body>
</html>
