<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<link href="/css/admin.css" rel="stylesheet" type="text/css">
</head>
<form name="login" id="login" action="checkreg.php" method="post" style="width:100%; height:550px;background:url(/images/bg/admin_bg1.jpg) repeat-x;margin-top:0px;">
<body>
	<div id=admin_body1>
		<div id=login  style="background:none">
			<div id=title>SMG用户注册    </div>
			<span style="color:#FF0000"> <? echo $_REQUEST['errorstr'];?></span>
			<div id=box style="border:1px solid #0066FF; background:#CBEBFA">
				<div id=name style="margin-top:15px;" >昵　称　　<input type="text" id=admin_username name=admin_username style="width:145px; height:17px;"></div>
				<div id=pwd >密　码　　<input type="password" id=admin_password name=admin_password  style="width:145px; height:17px;"></div>
				<div id=pwd >重复密码　<input type="password" id=admin_password2 name=admin_password2  style="width:145px; height:17px;"></div>
				<div id=pwd >邮　箱　　<input type="text" id=admin_email name=admin_email onKeyPress="Press_Login()" style="width:145px; height:17px;"></div>
				<div id=btn><input type="button" value="注册" onClick="Admin_Reg()" class="btn"></div>	
				<input type="hidden" name="lasturl" value="<?php echo $lasturl;?>">
				<div id=zhu>“番茄网”注册指南：<br>・ 工号注册×××××××××。</div>	
			</div>
			
		</div>
	</div>
	
</body>
</form>
</html>