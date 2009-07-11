<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-我要报料</title>
	<? 	
		css_include_tag('news_sub','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div class=t></div>
	<div class=t>
		<div class=l></div>
		<div class=t_r><select></select></div>
	</div>
	<div class=t>
		<div class=l></div>
		<div class=t_r><input type="text"></div>
	</div>
	<div class=t>
		<div class=l></div>
		<div class=t_r><input type="text"></div>
	</div>
	<div id=m>
		<div class=l></div>
		<div id=m_r></div>
	</div>
	<div class=t></div>
	<div id=b>
		<div class=l></div>
		<div class=t_r>
			<input type="file">
		</div>
		<div class=l></div>
		<div class=t_r>
			<input type="file">
		</div>
	</div>
	<div id=b_button>
			<button>提　交</button>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>