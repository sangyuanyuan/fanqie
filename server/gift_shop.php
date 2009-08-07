<?php
	require_once('../frame.php');
	$today = $_REQUEST['date'] ? $_REQUEST['date'] : date('m-d');
	session_start();
	if($_REQUEST['nickname']){
		$_SESSION['smg_gift_nickname'] = $_REQUEST['nickname'];
	}
	if($_REQUEST['loginname']){
		$_SESSION['smg_gift_loginname'] = $_REQUEST['loginname'];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-礼物商店</title>
	<? 	
		css_include_tag('server_calendar','top','bottom','thickbox');
		use_jquery();
  ?>
	
</head>
<body>
	
<? require_once('../inc/top.inc.html');
	js_include_tag('service/calendar','thickbox');
?>
<script language="JavaScript">
<!--
var isInternetExplorer = navigator.appName.indexOf("Microsoft") != -1;
// 处理 Flash 影片中的所有 FSCommand 消息
function cs_DoFSCommand(command, args) {
	var csObj = isInternetExplorer ? document.all.cs : document.cs;
    	if (command == "show")    
    	{    
			tb_show('购买礼物','gift_list.php?width=600&height=400&cid='+ encodeURI(args));    
    	}else if(command == 'checkout'){
			checkout();
		} 
		
}
// Internet Explorer 的挂钩
if (navigator.appName && navigator.appName.indexOf("Microsoft") != -1 && navigator.userAgent.indexOf("Windows") != -1 && navigator.userAgent.indexOf("Windows 3.1") == -1) {
	document.write('<script language=\"VBScript\"\>\n');
	document.write('On Error Resume Next\n');
	document.write('Sub cs_FSCommand(ByVal command, ByVal args)\n');
	document.write('	Call cs_DoFSCommand(command, args)\n');
	document.write('End Sub\n');
	document.write('</script\>\n');
}
//-->
</script>
<div id=ibody>
	<div class="l">
    		<div id="title"></div>
     	  <div id="menu">
     	  	<div id=date>礼品商店</div>
     	  </div>        
        <div id="context">
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" id="cs" width="640" height="520" align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
			   	<param name="wmode" value="opaque"> 
				<param name="movie" value="cs.swf" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffcccc" />
				<embed src="cs.swf" quality="high" bgcolor="#ffcccc" width="640" height="520" swLiveConnect=true id="cs" name="cs" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>
        </div>
        <div style="line-height:25px;margin-left:20px; margin-top:20px; font-size:larger;" id="gift_count">您还未购买任何礼物</div>
  </div>
  <div class="r"></div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
<script>
	var gift_ids = new Array();
	function show_gift(id){
		tb_show('购买礼物','gift_list.php?width=600&height=400&cid='+id);
	}
	function checkout(){
		//alert(gift_ids.join(','));
		if(confirm('您购买了' + gift_ids.length+'件礼物,结束购物吗?')){
			document.location.href="send_gift.php?gift_ids="+gift_ids.join(',');
		}
	}
	function refresh_gift_counts(){
		if (gift_ids.length <=0 )	{
			$('#gift_count').html('您还未购买任何礼物');
		}else{
			$('#gift_count').html('您已购买购买 '+gift_ids.length +' 件礼物');
		}
	}
</script>