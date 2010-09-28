<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>图像缩放</title>
<style>
body {  margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;FONT-SIZE: 9pt; LINE-HEIGHT: 18px; FONT-FAMILY: "宋体"}
form {  margin: 0px; padding: 0px; }
</style>
<script language="javascript">

function openDialog()
{
	ret = window.showModalDialog("photoEditor/scaledialog.html",window,"dialogHeight: 150px; dialogWidth: 330px; center: Yes; help: No; resizable: No; status: No;" );
	if( ret == "OK" )
		if(parent && parent.apply )
			parent.apply();
}

function setImage( filename ){
	document.all.workImage.src = filename;
	setTimeout( "setwh()", 200 );
}

function setwh(){
        document.box.w.value = document.all.workImage.width;
        document.box.h.value = document.all.workImage.height;
}

function init(){
	if( parent && parent.setWorkImage)
	    parent.setWorkImage();
	openDialog();
}
</script>
</head>

<body onload="init()"  bgcolor=threedface>
<!--div align="center"><a href="javascript:openDialog()">缩放参数设置</a></div-->
<div style="position:absolute;overflow:auto;border:1 solid white;left:0px; top:0px;width:100%;height:100%;background-color:threedface" align=left>
    <img id=workImage src="photoEditor/images/none.gif" style="position:absolute;top:0;left:0;z-index:1">
</div>
<form method="post" name=box action="" onsubmit="return false;">  
<input type="hidden" name="zoom" value="100">
<input type="hidden" name="w" value="0">
<input type="hidden" name="h" value="-1">
</form>		
</body>
</html>
