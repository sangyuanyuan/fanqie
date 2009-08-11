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
		css_include_tag('index','top','bottom');
		use_jquery();
	  js_include_once_tag('index');
	  echo urlencode(iconv('utf-8','gbk','常用表格'));
	  echo ('<br>');
	  echo urlencode(iconv('utf-8','gbk','常用申请表'));
  ?>

</head>

<body style="line-height:20px;">
<? require_once('inc/top.inc.html');?>
<a href="/news/news_list.php?tags=<?php echo urlencode("小编加精");?>" target="_blank">小编加精</a>