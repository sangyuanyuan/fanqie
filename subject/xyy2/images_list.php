<?php require_once('../../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -喜羊羊与灰太郎之虎虎生威</title>
	<?php css_include_tag('xyy2','top','bottom');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("喜羊羊2专题","server");
</script>
</head>
<body>
<? 
	require_once('../../inc/top.inc.html');
	$db = get_db();
	$news=$db->query('SELECT * FROM smg_images where is_adopt=1 and category_id=166 order by priority asc,created_at desc');
?>
<div id=bodys>
	<div id=fqtglist><a href="/">首页</a>　>　<a href="/subject/xyy2/">喜羊羊2专题</a></div>
	<div id=fqtglistcount>
		<? for($i=0;$i<count($news);$i++){?>
		<div class=context>
			<div class=cl>
				<a target="_blank" href="/show/show.php?id=<? echo $news[$i]->id;?>"><img border=0 width=300 height=168 src="<? echo $news[$i]->src;?>" /></a><br>
				<a target="_blank" href="/show/show.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>		
		</div>
		<? }?>
	</div>
</div>
<? include('../../inc/bottom.inc.html');?>	
</body>
</html>