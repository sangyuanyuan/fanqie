<?php
	require_once('../frame.php');
	$id=$_REQUEST['id'];
	if($id==""||$id==null){die('没有找到网页');}
	$db=get_db();
	$sql="select xlcs_id,content from smg_xlcs_item where id=".$id;
	$xlcs=$db->query($sql);
	$ip=$_SERVER['REMOTE_ADDR'];
	$sql="insert into smg_xlcs_record(ip,xlcs_id) value ('".$ip."',".$xlcs[0]->xlcs_id.")";
	$db->execute($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-心理测试答案</title>
	<?
		css_include_tag('server_xlcs','top','bottom');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("心理测试","server");	
</script>
</head>
	
<body>
<?php require_once('../inc/top.inc.php'); ?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a>
		</div>
		<div id=l_b>
			<div id=title>测试结果</div>
			<div id=content><?php  echo get_fck_content($xlcs[0]->content);?></div>
		</div>
			
	</div>
	
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>

