<?php
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
				<div id=title>相册</div>
			 	<div id=content>
			 		<table>
			 			<tr>
			 				<td>标　题</td><td><input type="text" /></td>
			 			</tr>
			 			<tr>
			 				<td>描　述</td><td><textarea rows=5 ></textarea></td>
			 			</tr>
			 			<tr>
			 				<td>选择照片</td><td><input type="file" /></td>
			 			</tr>
			 			<tr>
			 				<td><button>开始上传</button></td>	
			 			</tr>
			 		</table>	
			 	</div>
		</div>
	</div>
</body>
</html>