﻿<?php
	require_once('../../frame.php');
	include_once '../../lib/xspace_api.php';
	include_once '../../lib/uchome_api.php';
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-宝宝秀首页</title>
	<? 
		css_include_tag('show_person','top','bottom');
		use_jquery();
	  js_include_once_tag('total','babyshowindex');
  ?>
	
</head>
<script>
total("首页","other");
</script>
<body>
	<?php require_once('person_head.php');?>
	<div id=ibody>
		<? require_once('person_left.php');?>
		<div id=iright>
				<div id=title>相册</div><div id=add></div>
			 	<?php for($i=0;$i<12;$i++){ ?>
			 		<div class=pic><a href=""><img src=""></a><div class=pictitle></div><div class=edit><a href="">编辑</a>　　<span>删除</span></div></div>
			 	<?php } ?>
		</div>
	</div>
</body>
</html>