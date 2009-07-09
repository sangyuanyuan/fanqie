<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-博文</title>
	<? 	
		css_include_tag('zone_blog','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t></div>
		<?php for($i=0;$i<5;$i++){ ?>
			<div class=l></div>
		<?PHP }?>
	</div>
	<div id=ibody_center>
		<div id=c_t></div>
		<div id=c_b></div>
	</div>
	<div id=ibody_right>
		<div class=r_title></div>
		<div id=r_t></div>
		<div class=r_title></div>
		<div id=r_m></div>
		<div class=r_title></div>
		<div id=r_b></div>
		<div id=r_dialog></div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>