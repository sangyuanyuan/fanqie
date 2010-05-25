<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-首页</title>
	<? 	
		css_include_tag('user_page','top','bottom');
		use_jquery_ui();
		js_include_once_tag('zone','total');
		$db=get_db();
  ?>
<script>
	total("交流首页","zone");
</script>	
</head>
<body>
	<? require_once('../inc/top.inc.html');?>
	<div id="ibody">
		<div id="top_container">添加内容</div>
		<div id="left_container">
			<div class="model_container">
				<div class="tool">
					<div class="model_name">dsf</div>
					<div class="remove"></div>
				</div>
			</div>
			<div class="model_container">
				<div class="tool">
					<div class="model_name">dsf</div>
					<div class="remove"></div>
				</div>
			</div>
			<div class="model_container">
				<div class="tool">
					<div class="model_name">dsf</div>
					<div class="remove"></div>
				</div>
			</div>
		</div>
		<div id="center_container">
		
		</div>
		
		<div id="right_container">
		
		</div>
	</div>
	
	<? require_once('../inc/bottom.inc.php');?>
</body>
</html>