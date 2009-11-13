<?php require_once('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -电视新闻中心电子杂志</title>
	<?php css_include_tag('smg','top','bottom');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("电视新闻中心电子杂志","news");
</script>
</head>
<body>
<? 
	require_once('../inc/top.inc.html');
	$db = get_db();
	$news=$db->query('SELECT * FROM smg_news where category_id=158 and is_adopt=1 order by priority asc,created_at desc');
?>
<div id=bodys>
	<div id=fqtglist><a href="/">首页</a>　>　<a href="/news/newscenter_list.php">电视新闻中心电子杂志</a></div>
	<div id=fqtglistcount>
		<? for($i=0;$i<count($news);$i++){?>
		<div class=context>
			<div class=cl>
				<a target="_blank" href="/news/news/news.php?id=<? echo $news[$i]->id;?>"><img border=0 width=160 height=115 src="<? echo $news[$i]->photo_src;?>" /></a><br>
				<a target="_blank" href="/news/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>		
		</div>
		<? }?>
	</div>
</div>
<? include('../inc/bottom.inc.html');?>	
</body>
</html>