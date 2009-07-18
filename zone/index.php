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
		css_include_tag('zone_index','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_top>
		<div id=t_l>
			<div id=t_l_t>hot讨论区</div>
			<div class=t_l_b></div>
			<div class=t_l_b></div>
		</div>
		<div id=t_c>
			<div id=t_c_t></div>
			<div id=t_c_m></div>
			<div id=t_c_b></div>
		</div>
		<div id=t_r>
			<div id=t_r_t>
				<div id=title><img src="/images/show/show_index_l_t.jpg">　公告</div>
			</div>
			<div id=chat></div>
			<div class=t_r_m></div>
			<div class=t_r_m></div>
		</div>
	</div>
	<div id=ibody_middle></div>
	<div id=ibody_bottom>
		<div id=b_l></div>
		<div id=b_c></div>
		<div class=b_r></div>
		<div class=b_r style="margin-top:10px;"></div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>