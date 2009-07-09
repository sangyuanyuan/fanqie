<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-对话全文</title>
	<? 	
		css_include_tag('zone_dialog','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_top></div>
	<div id=ibody_middle></div>
	<div id=ibody_bottom>
		<div id=b_l>
			<div id=b_l_title></div>
			<div id=b_l_b></div>
		</div>
		<div id=b_r>
			<div id=b_r_t>
				<input type="text">
				<textarea></textarea>
			</div>
			<div id=b_r_title></div>
			<div id=b_r_m></div>
			<div id=b_r_b1></div>
			<div id=b_r_title2></div>
			<?php for($i=0;$i<4;$i++){?>
				<div class=b_r_b2>
					<a target="_blank" href="#"><img border=0 width=128 height=82 src=""></a>
					<br>
					<a target="_blank" href="#">test</a>	
				</div>
			<?php }?>
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
