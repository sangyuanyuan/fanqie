<?php
	require_once('../frame.php');
	$y2k = mktime(0,0,0,1,1,2020); 
	if(!$_COOKIE['smg_chat_id']){
		@SetCookie('smg_chat_id',rand_str(30),$y2k,'/');
	}
	@SetCookie('smg_chat_status',$_SESSION['smg_chat_status'],$y2k,'/');
	$gender = $_COOKIE['smg_chat_gender'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-匿名聊天</title>
	<?php 
	css_include_tag('zone_chat_room','top','bottom');
	use_jquery();
	js_include_tag('pubfun.js','jquery.cookie.js','total.js');
	?>
</head>
<script>
	total("聊天室","zone");
</script>
<body>
<? require_once('../inc/top.inc.html');	?>
<div id="ibody">
	<div id="t"><span id="waiter"></span></div>
	<div id="chat_content_box">
		<div style="width:700px;font-size:16px;margin-left:140px;margin-top:10px;">
			欢迎您进入番茄网匿名聊天室!请选择您的性别后，点击‘<span style="color:red;"><b>开始聊天</b></span>’后，系统就会随机抽选一个在线的用户成为你的聊天搭档，并为你构建一个<span style="color:red;"><b>一对一</b></span>的二人聊天室，在这里，当然你不会知道对方的名字、部门、年龄，所有的信息被的红‘<span style="color:red;"><b>陌生人</b></span>’一词代替，对方也许就坐在你对面的同事，也许是个美女，也许是个明星，除了在接下来的坦诚的聊天中外你无从得知。陌生的人，形形色色的身份，在这样一个陌生的虚拟世界，尽情的聊天。 
		</div>
		<div style="text-align:center">
			<form method="get" action="chat_room.php">
				<input type="radio" name="gender" value="boy" <?php if($gender == 'boy') echo 'checked="checked"';?>>男
				<input type="radio" name="gender" value="girl" <?php if($gender == 'girl') echo 'checked="checked"';?>>女
				<input type="submit" id="submit_start" value="开始聊天">
			</form>
		</div>
	</div>
</div>
<div id="ajax_result"></div>
<? require_once('../inc/bottom.inc.php');?>
</body>
</html>
<script>
	$(function(){
		$('#submit_start').click(function(){
			if($('input:checked').length<0){
				alert('请选择您的性别!');
				return false;
			}
			$.cookie('smg_chat_gender',$('input:checked').val());
			return true;
		});
	});
</script>