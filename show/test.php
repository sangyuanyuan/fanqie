<?php
	require_once('../frame.php');
	$type = $_REQUEST['type'];
	if($type=='video'){
		$title = '上传视频';
	}else{
		$title = '上传图片';
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-我要上传</title>
<?php 
	use_jquery();
    validate_form("show");
?>
</head>
<body>
<?php

	
?>
<div id=ibody>
<form id="show" enctype="multipart/form-data" action="show.post.php" method="post">
	
</form>