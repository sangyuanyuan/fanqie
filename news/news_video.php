<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-视频子页</title>
	<? 	
		css_include_tag('news_news','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t></div>
		<div id=l_b></div>
	</div>
	<div id=ibody_right>
		<div id=r_t></div>
		<div id=r_m>
			<div id=title></div>
		</div>
		<div id=r_b_t>
			<div class=title1></div><div class=title1></div><div class=title2></div>
		</div>
		<div id=r_b_b>
			<div id=title1></div><div id=title2></div>
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>