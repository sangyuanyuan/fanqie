<?php require_once('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -番茄团购列表</title>
	<?php css_include_tag('smg','top','bottom');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("番茄团购","server");
</script>
</head>
<body>
<? 
	require_once('../inc/top.inc.html');
	$db = get_db();
	$news=$db->query('SELECT * FROM smg_tg where isadopt=1 order by createtime desc');
	$fhtg=$db->query('select * from smg_fhtg where is_adopt=1  order by created_at desc');
?>
<div id=bodys>
	<div id=fqtglist><a href="/">首页</a>　>　<a href="/fqtg/fqtglist.php">番茄团购列表</a></div>
	<div id=fqtglistcount>
		<div style="width:980px; font-size:14px; margin-top:10px; margin-left:10px; font-weight:bold; color:red; float:left; display:inline;">小番茄郑重承诺：番茄团购的宗旨就是为大家服务！团购的商品都是直接跟供应商联系，我们会尽力为大家争取到最低价格，在团购过程中番茄网绝不加价从中赚取利益！请大家监督！如果员工有什么渠道可以为大家提供产品团购，也欢迎联系我们！</div><br>
		<?php for($i=0;$i<count($fhtg);$i++){ ?>
		<div class=context>
			<div class=cl>
				<a target="_blank" href="/fqtg/fhfqtg.php?id=<? echo $fhtg[$i]->id;?>"><img border=0 width=160 height=105 src="<? echo $fhtg[$i]->src;?>" /></a><br>
				<a target="_blank" href="/fqtg/fhfqtg.php?id=<? echo $fhtg[$i]->id;?>"><? echo $fhtg[$i]->title;?></a></div>		
		</div>
		<? }for($i=0;$i<count($news);$i++){?>
		<div class=context>
			<div class=cl>
				<a target="_blank" href="/fqtg/fqtg.php?id=<? echo $news[$i]->id;?>"><img border=0 width=160 height=105 src="<? echo $news[$i]->photourl;?>" /></a><br>
				<a target="_blank" href="/fqtg/fqtg.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>		
		</div>
		<? }?>
	</div>
</div>
<? include('../inc/bottom.inc.html');?>	
</body>
</html>