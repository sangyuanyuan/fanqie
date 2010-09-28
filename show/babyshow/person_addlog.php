<?php
	require_once('../../frame.php');
	$db = get_db();
	if($_REQUEST['id']!="")
	{
		$babyshow=$db->query('select * from smg_babyshow_act where id='.$_REQUEST['id']);	
	}
	$cookie=$_COOKIE['smg_user_nickname'];
	if($cookie=="")
	{
		alert('请登录后进行操作！');
		redirect('index.php');	
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
				<div id=title1>日志</div>
			 	<div id=content>
			 		<form id="babyshow_add" name="babyshow_add" enctype="multipart/form-data" action="person.post.php" method="post">
				 		<table>
				 			<tr>
				 				<td>标　题</td><td><input type="text" id="babyshowtitle" name="babyshow[title]" value="<?php echo $babyshow[0]->title;?>" /></td>
				 			</tr>
				 			<tr>
				 				<td>内　容</td><td><?php show_fckeditor('babyshow[content]','Admin',true,"300",$babyshow[0]->content,"650");?></td>
				 				<input type="hidden" name="babyshow[user_id]" value="<?php echo $cookie; ?>">
				 				<input type="hidden" id="babyshowtype" name="babyshowtype" value="addact">
				 			</tr>
				 			<input type="hidden" name="babyshowid" value="<?php echo $_REQUEST['id']; ?>">
				 			<tr>
				 				<td></td><td><button id="btnsub">提　　交</button></td>	
				 			</tr>
				 		</table>	
				 	</form>
			 	</div>
		</div>
	</div>
</body>
</html>