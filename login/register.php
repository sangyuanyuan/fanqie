<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-用户注册</title>
	<?php 
		use_jquery();
		js_include_tag('total.js');
	?>
	<link href="/css/admin.css" rel="stylesheet" type="text/css">
</head>
<script>
	total("注册","other");
</script>
<form name="login" id="login" action="register.post.php" method="post" style="width:100%; height:550px;background:url(/images/bg/admin_bg1.jpg) repeat-x;margin-top:0px;">
<body>
	<div id=admin_body1>
		<div id=login  style="background:none">
			<div id=title>SMG用户注册    </div>
			<span style="color:#FF0000"> <? echo $_REQUEST['errorstr'];?></span>
			<div id=box style="border:1px solid #0066FF; background:#CBEBFA">
				<div id=name style="margin-top:15px;" >昵　称　　<input type="text" id=admin_username name=user[name] style="width:145px; height:17px;" value="<?php echo urldecode($_REQUEST['name']);?>"></div>
				<div id=pwd >密　码　　<input type="password" id=admin_password name=user[password]  style="width:145px; height:17px;"></div>
				<div id=pwd >重复密码　<input type="password" id=admin_password2 name=admin_password2  style="width:145px; height:17px;"></div>
				<div id=pwd >邮　箱　　<input type="text" id=admin_email name=email style="width:145px; height:17px;" value="<?php echo urldecode($_REQUEST['email']);?>"></div>
				<div id=btn><input type="submit" value="注册" id="button_register" class="btn"></div>	
				<input type="hidden" name="lasturl" value="<?php echo $lasturl;?>">
			</div>
		</div>
	</div>
	
</body>
</form>
</html>
<script>
	$(function(){
		$('#button_register').click(function(){
			if($('#admin_username').val() == ''){
				alert('请输入昵称');
				return false;
			}
			if($('#admin_password').val()==''){
				alert('请设置您的密码!');
				return false;
			}
			if($('#admin_password').val() != $('#admin_password2').val()){
				alert('两次密码不一致,请重新输入!');
				return false;				
			}
			if($('#admin_email').val() == ''){
				alert('请输入邮箱!');
				return false;				
			}
			return true;
		});
	});
</script>