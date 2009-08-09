<?php require_once('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -店铺列表</title>
	<?php
		css_include_tag('smg','top','bottom');
		use_jquery();
		js_include_once_tag('total');
	 ?>
<script>
	total("个人网店","server");
</script>
</head>
<body>
<? 
	include('../inc/top.inc.html');
	$db=get_db();
	$cookie=(isset($_COOKIE['smg_username']))? $_COOKIE['smg_username'] : '';
	$news=$db->paginate('SELECT * FROM smg_shop where shopdpid='.$_REQUEST['id'].' and isadopt=1 order by createtime desc',16);
	$name=$db->query('select * from smg_shopdp where id='.$_REQUEST['id']);
	
?>
<div id=bodys>
	<div id=fqtglist><a href="/">首页</a>　>　<a href="/shop/shoplist.php">店铺列表</a>　>　<a href="/shop/splist.php?id=<? echo $_REQUEST['id'];?>">商品列表</a></div>
	<div id=fqtglistcount style="padding-top:10px;">
		<? if($name[0]->username==$cookie){?>
		<a style="margin-top:10px; margin-left:10px; font-size:16px;" target="_blank" href="/admin/shop/shop.php">商品管理</a><a style="margin-top:10px; margin-left:10px; font-size:16px;" target="_blank" href="updateshop.php?id=<? echo $_REQUEST['id'];?>">更新店铺</a>
		<div style="margin-left:10px;">
			<!-- remark  --> 
			<?php echo $name[0]->remark;?>
		</div>		
		<? }
		for($i=0;$i< count($news);$i++){
			if($news[$i]->isadopt==1){
			?>		
		<div class=context>
			<div class=cl>
				<a target="_blank" href="/shop/spinfo.php?id=<? echo $news[$i]->id;?>"><img border=0 width=160 height=105 src="<? echo $news[$i]->photourl;?>" /></a><br>
				<a target="_blank" href="/shop/spinfo.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a>
			</div>		
		</div>
		<? }}?>
		
	</div>
	<div id=fqtglistcount_page>
       <?php paginate(""); ?>
	</div>
</div>
<? include('../inc/bottom.inc.html');?>	
</body>
</html>