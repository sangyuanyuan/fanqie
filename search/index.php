<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-普通子页</title>	
	<?php
	include_once "../frame.php";
	css_include_tag('top','bottom','search/search');
	?>
</head>
<body>
<?php include('../inc/top.inc.html');?>	
<div id="ibody">
	<div id="left_box">
		<div id="search_box">
			<b>搜索</b>
			<input type="text" name="key" id="search_text" value="<?php $_REQUEST['key'];?>">
			
		</div>
	</div>
	<div id="right_box">
		
	</div>
</div>
<?php include('../inc/bottom.inc.php');?>
</body>
</html>
