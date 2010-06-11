<?php
	require_once('frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-首页</title>
	<? 
		css_include_tag('show_babyshowindex','top','bottom');
		use_jquery();
	  js_include_once_tag('total');
  ?>
	
</head>
<script>
total("首页","other");
</script>
<body id="body">

</body>
</html>