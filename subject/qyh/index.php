<?
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG - 三项教育 - 群英汇</title>
	<?php css_include_tag('qyh','qyh_top','qyh_bottom');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("专题-群英汇","other");
</script>
</head>
<body>
	<div id=ibody>	
		<?php include('inc/top.inc.php');?>
			<div id=qyh_index>
				<div id=index_top>
					<div class=index_t_title><a href="">风云英雄榜</a></div>
					<div id=t_l_pic>
						<a href=""><img border=0 src="images/one.jpg"></a>	
					</div>
				</div>
			</div>
		<?php include('inc/bottom.inc.php');?>
	</div>
</body>
</html>

