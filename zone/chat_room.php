<?php
	require_once('../frame.php');
	$y2k = mktime(0,0,0,1,1,2020); 
	if(!$_COOKIE['smg_chat_id']){
		@SetCookie('smg_chat_id',rand_str(30),$y2k,'/');
	}
	@SetCookie('smg_chat_status',$_SESSION['smg_chat_status'],$y2k,'/');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-匿名聊天</title>
	<?php 
	css_include_tag('zone_chat_room','top','bottom');
	use_jquery();
	js_include_tag('pubfun.js','jquery.cookie.js','chat_room');
	?>
</head>
<body>
<? require_once('../inc/top.inc.html');	?>
<div id="ibody">
	<div id="t"></div>
	<div id="chat_content_box"></div>
	<div id="tool_box">
			<div id="connect_msg">&nbsp;</div>
			<div id="fck_box">
					<?php show_fckeditor('fck_content','Title',false,95,'',945);?>
			</div>
			<div id="emotion"></div>
			<button id="submit">发送</button>　
			<button id="find_chater" style="width:100px;">寻找陌生人</button>
			<button id="clear">清屏</button>
	</div>
</div>
<div id="ajax_result"></div>
<? require_once('../inc/bottom.inc.php');?>
</body>
</html>