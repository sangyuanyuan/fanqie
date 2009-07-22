<?php require_once ('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -店铺列表</title>
	<?php css_include_tag('smg','top','bottom');
		use_jquery(); ?>
</head>
<body>
<? 
	require_once('../inc/top.inc.html');

	$db=get_db();
	$news=$db->paginate('SELECT * FROM smg_shopdp order by createtime',16);
?>
<div id=bodys>
	<div id=fqtglist><a href="/">首页</a>　>　<a href="/shop/shoplist.php">店铺列表</a></div>
	<div id=fqtglistcount style="padding-top:10px;">
		<a style="margin-left:10px; font-size:16px;" target="_blank" href="createshop.php">创建店铺</a>
		<? for($i=0;$i<count($news);$i++){?>
		<div class=context>
			
			<div class=cl>
				<a target="_blank" href="/shop/splist.php?id=<? echo $news[$i]->id;?>"><img border=0 width=160 height=105 src="<? echo $news[$i]->shopurl;?>" /></a><br>
				<a target="_blank" href="/shop/splist.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->name;?></a></div>		
		</div>
		<? }?>
		
	</div>
	<div id=fqtglistcount_page>
 			<?php paginate('shoplist.php');?>
	</div>
</div>
<? require_once('../inc/bottom.inc.html');?>	
</body>
</html>