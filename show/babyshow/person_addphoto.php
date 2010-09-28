<?php
	require_once('../../frame.php');
	$db = get_db();
	$cookie=$_COOKIE['smg_user_nickname'];
	if($cookie=="")
	{
		alert('请登录后进行操作！');
		redirect('index.php');	
	}
	if($_REQUEST['id']!="")
	{
		$photo=$db->query('select * from smg_babyshow_photo where id='.$_REQUEST['id']);	
	}
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
				<div id=title>相册</div>
			 	<div id=content>
			 		<form id="babyshow_add" name="babyshow_add" enctype="multipart/form-data" action="person.post.php" method="post">
				 		<table>
				 			<tr>
				 				<td>标　题</td><td><input type="text" name="babyshow[title]" value="<?php echo $photo[0]->title; ?>" /></td>
				 			</tr>
				 			<tr>
				 				<td>描　述</td><td><textarea rows=15 cols="85" name="babyshow[content]"><?php echo $photo[0]->content; ?></textarea></td>
				 			</tr>
				 			<tr>
				 				<td>选择照片</td><td><input type="file" name="photo_src" id="photo_src" /><?php if($photo[0]->photo_src!=""){ ?>　<a href="<?php echo $photo[0]->photo_src;?>">查看已上传图片</a><?php } ?></td>
				 				<input type="hidden" id="babyshowtype" name="babyshowtype" value="addphoto">
				 				<input type="hidden" name="babyshow[user_id]" value="<?php echo $cookie; ?>">
				 				<input type="hidden" name="babyshowid" value="<?php echo $_REQUEST['id']; ?>">
				 			</tr>
				 			<tr>
				 				<td></td><td><button id="btnsub">开始上传</button></td>	
				 			</tr>
				 		</table>
				 	</form>
			 	</div>
		</div>
	</div>
</body>
</html>