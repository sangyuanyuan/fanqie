<?php
	require_once('../../frame.php');
	$db = get_db();
	$id=urldecode($_REQUEST['id']);
	$name=urldecode($_REQUEST['name']);
	$cookie=$_COOKIE['smg_user_nickname'];
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
total("宝宝秀","show");
</script>
<body>
	<?php require_once('person_head.php');?>
	<div id=ibody>
		<? require_once('person_left.php');?>
		<div id=iright>
			<?php
			$friend=$db->query('select friend_id from smg_user where nick_name like "%'.$cookie.'%"');
			if($name=="")
			{
				$photo=$db->query('select nick_name,head_photo from smg_user where nick_name in ('.$friend[0]->friend_id.')'); 
			}
			else
			{
				$photo=$db->query('select nick_name,head_photo from smg_user where nick_name like "%'.$name.'%"');	
			}	
			?>
			<div id=title2>好友</div>
		 	<?php for($i=0;$i<count($photo);$i++){ ?>
		 		<div class=pic><a target="_blank" href="person_index.php?id=<?php echo urlencode($photo[$i]->nick_name); ?>"><img src="<?php echo $photo[$i]->head_photo; ?>"></a><br><?php echo $photo[$i]->nick_name; ?></div>
		 	<?php } ?>
		</div>
	</div>
</body>
</html>