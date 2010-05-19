<?php require_once('../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -宝宝秀</title>
	<?php 
	css_include_tag('top','bottom');
	use_jquery();
	js_include_tag('total');
	?>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="baby.js"></script>
	<script>
		total("宝宝秀","show");	
	</script>
</head>
<body>
<? include('../inc/top.inc.html');
  
  if($_REQUEST['id']==''){die('没有找到此宝宝网页');}
  $babyshow = $db->query('select a.*,(select babyname from smg_baby_vote where id=a.babyid) as babyname from smg_baby_item a where a.babyid='.$_REQUEST['id']);
  $babyshow1 = $db->query('select photourl,babyname,content from smg_baby_vote where id='.$_REQUEST['id']);
?>
<div id=bodys>
 	<div id=baby>
 		<div class=pic2><img border=0 width=450 src="<? echo $babyshow1[0]->photourl;?>" /><div class=nd> <? echo $babyshow1[0]->babyname.'<br>'.$babyshow1[0]->content;?></div></div>
 		<? for($i=0;$i< count($babyshow);$i++){?>
 			<div class=pic2><img border=0 width=500 src="<? echo $babyshow[$i]->photourl;?>" /><div class=nd> <? echo $babyshow[$i]->babyname.'<br>'.$babyshow1[0]->content;?></div></div>
 		<?}?>
	</div>  
</div>
<? include('../inc/bottom.inc.html');?>	
</body>
</html>
