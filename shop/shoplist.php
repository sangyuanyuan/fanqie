<? 
	require_once('../frame.php');
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -番茄网店</title>
	<?php css_include_tag('smg');?>
	<script language="javascript" src="/js/smg.js"></script>
</head>
<body>
<? 					
	$db=get_db();
	$sql='select * from smg_shopdp order by createtime desc';
	$news = $db->paginate($sql,15);
?>
<div id=bodys>
	<div id=fqtglist><a href="/">首页</a>　>　<a href="/shop/shoplist.php">网店列表</a></div>
	<div id=fqtglistcount style="padding-top:10px;">
		<a style="margin-top:10px; margin-left:10px; font-size:16px;" target="_blank" href="createshop.php">创建网店</a>
		<? for($i=0;$i<$db->record_count;$i++){?>
		<div class=context>
			
			<div class=cl>
				<a href="/shop/splist.php?id=<? echo $news[$i]->id;?>"><img border=0 width=160 height=105 src="<? echo $news[$i]->shopurl;?>" /></a><br>
				<a href="/shop/splist.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->name;?></a></div>		
		</div>
		<? }?>
		<div id=fqtglistcount_page>
      <div class="pageurl">
         <?php  paginate("/shop/shoplist.php"); ?>
      </div>
	</div>
	</div>
</div>	
</body>
</html>