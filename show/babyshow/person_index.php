﻿<?php
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
	<?php require_once('person_head.php');
				$y2k = mktime(0,0,0,1,1,2020);
				@setcookie('babyshowid',$_REQUEST['id'],$y2k,'/');?>
	<div id=ibody>
		<? require_once('person_left.php');?>
		<div id=iright>
			<?php $photo=$db->query('select * from smg_babyshow_photo where user_id='.$id); ?>
				<div id=title>相册</div><div id=addphoto></div>
			 	<?php for($i=0;$i<count($photo);$i++){ ?>
			 		<div class=pic><a href="<?php echo $photo[$i]->photo_src; ?>"><img src="<?php echo $photo[$i]->photo_src; ?>"></a><div class=pictitle></div><div class=edit><?php if($id==$cookie){ ?><a href="person_addphoto.php?id=<?php echo $photo[$i]->id; ?>">编辑</a>　　<span id="photodel" param="<?php echo $photo[$i]->id; ?>">删除</span><?php } ?></div></div>
			 	<?php } ?>
		</div>
	</div>
</body>
</html>