<?php
	require_once('../frame.php');
	$db = get_db();

?>
<!-- saved from url=(0013)about:internet -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>ceshi</title>
	<? 	
		css_include_tag('thickbox');
		use_jquery();
  ?>


</head>
<body bgcolor="#ffffff">
<script language="JavaScript">
<!--
var isInternetExplorer = navigator.appName.indexOf("Microsoft") != -1;
// 处理 Flash 影片中的所有 FSCommand 消息
function ceshi_DoFSCommand(command, args) {   
    var ceshiObj = isInternetExplorer ? document.all.ceshi : document.ceshi;   
    if (command == "show")    
    {    
        alert("123");   
    }   
} 
// Internet Explorer 的挂钩
if (navigator.appName && navigator.appName.indexOf("Microsoft") != -1 && navigator.userAgent.indexOf("Windows") != -1 && navigator.userAgent.indexOf("Windows 3.1") == -1) {
	document.write('<script language=\"VBScript\"\>\n');
	document.write('On Error Resume Next\n');
	document.write('Sub ceshi_FSCommand(ByVal command, ByVal args)\n');
	document.write('	Call ceshi_DoFSCommand(command, args)\n');
	document.write('End Sub\n');
	document.write('</script\>\n');
}
//-->
</script>
<!--影片中使用的 URL-->
<!--影片中使用的文本-->
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" id="ceshi" width="550" height="400" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="ceshi.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="ceshi.swf" quality="high" bgcolor="#ffffff" width="550" height="400" swLiveConnect=true id="ceshi" name="ceshi" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</body>
</html>
