<?php
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -弹出框管理</title>
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<form id="news_add" name="news_add" enctype="multipart/form-data" action="pop.post.php" method="post">
	<div class=title>弹出框管理</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　类型</div>
		<div class=t_r>
			<select id=select name="news[dept_id]">
				<option value="0">请选择</option>
					<option value=""></option>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　高度</div>
		<div class=t_r><input type="text" name="news[height]"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　宽度</div>
		<div class=t_r><input id="news_title" type="text" name="news[width]"></div>
	</div>
	<div id=m>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　内容</div>
		<div id=m_r><?php show_fckeditor('news[content]','Admin',true,"230","","750");?></div>
	</div>
	<div id=b_button>
			<button id="button_submit">提　交</button>
	</div>
	</form>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>