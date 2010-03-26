<?
	require_once('../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -三项教育首页</title>
	<?php css_include_tag('sxxx2');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("专题-三项学习教育","news");
</script>
</head>
<body>
<div id=bodys>
	<div id=logo><embed src="/subject/sxxx2/sxxx.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="1000" height="150"></embed></div>
	<div id=ileft>
		<div id=question></div>
		<div id=answer></div>
		<div id=answer_result></div>
	</div>
</div>
</body>
</html>