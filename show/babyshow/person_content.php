<?php
	require_once('../../frame.php');
	$db = get_db();
	$id=$_REQUEST['id'];
	$cookie=$_COOKIE['smg_user_id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-宝宝秀首页</title>
	<? 
		css_include_tag('show_person','top','bottom');
		use_jquery();
	  js_include_once_tag('total','babyshowindex');
  ?>
	
</head>
<script>
total("首页","other");
</script>
<body>
	<?php require_once('person_head.php');?>
	<div id=ibody>
		<? require_once('person_left.php');?>
		<div id=iright>
			<?php $act=$db->query('select * from smg_babyshow_act where user_id='.$id); ?>
				<div id=title>相册</div><div id=addphoto></div>
			 	<?php for($i=0;$i<count($act);$i++){ ?>
			 		<div class=listcontent></div>
			 	<?php } ?>
		</div>
	</div>
</body>
</html>