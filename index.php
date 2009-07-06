<?php
	require_once('frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG</title>
	<? 	
		css_include_tag('index');
		css_include_tag('top');
		css_include_tag('bottom');
		use_jquery();
	  js_include_once_tag('index');
  ?>
	
</head>
<body>
<? require_once('inc/top.inc.html');?>
<div id=ibody>
 <div id=ibody_top>
 		<div id=p1>
 			<div id=video>
 				<div id=menu>
 					<div class=video_item id=video_item1 style="background:url(/images/index/video_btn1.jpg)">每日之星</div>
  				<div class=video_item id=video_item2 style="background:url(/images/index/video_btn2.jpg);color:#9f9f9f;">视频新闻</div>
 					<div class=video_item id=video_item3 style="background:url(/images/index/video_btn2.jpg);color:#9f9f9f;">番茄广告</div>
				</div>	
 				<div id=flash><img src="/images/1.jpg"></div>
 				<div id=list>
 					<ul>
 						<li><img src="/images/index/arrow2.gif"> 满文军妻子被正式批捕 黄晓明疑遭封杀</li>
 						<li><img src="/images/index/arrow1.gif"> 满文军妻子被正式批捕 黄晓明疑遭封杀</li>
 						<li><img src="/images/index/arrow1.gif"> 满文军妻子被正式批捕 黄晓明疑遭封杀</li>
 						<li><img src="/images/index/arrow1.gif"> 满文军妻子被正式批捕 黄晓明疑遭封杀</li>
 					</ul>		
 				</div>
 			</div>
		</div>
		<div id=p2>
		</div>
		<div id=p3></div>
		<div id=p4></div>
				
 </div>
</div>
<? require_once('inc/bottom.inc.php');?>


</body>
</html>