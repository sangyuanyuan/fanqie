<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
</head>
<?
  $lasturl = isset($_REQUEST['lasturl']) ? $_REQUEST['lasturl'] : $_SERVER['HTTP_REFERER'];
  if(!isset($lasturl)) $lasturl = "/";
?>
<form name="login" id="login" action="/login/user.post.php" method="post" style="width:100%; height:550px;background:url(/images/bg/admin_bg1.jpg) repeat-x;margin-top:0px;">
<body>
	<div id=admin_body1>
		<div id=login  style="background:none">
			<div id=title>SMG网站登录    </div>
			<span style="color:#FF0000"> <? echo $_REQUEST['errorstr'];?></span>
			<div id=box style="border:1px solid #0066FF">
				<div id=name>用户名　　<input type="text" id=admin_username name=admin_username style="width:145px; height:17px;"></div>
				<div id=pwd>密　码　　<input type="password" id=admin_password name=admin_password onKeyPress="Press_Login()" style="width:145px; height:17px;"></div>
				<div id=btn><input type="checkbox" id=nickname >昵称　　<a href="register.php" style="color:#000000; text-decoration:none">注册</a>　　<input type="button" value="登录" onClick="Admin_Login()" class="btn"></div>	
				<input type="hidden" name="lasturl" value="<?php echo $lasturl;?>">
				<div id=zhu>“番茄网”登录指南：<br>· 请使用您的“一卡通”工号与口令登录“番茄网”<br>· 如果您的Windows是用工号登录的，则登录“番茄网”的口令与Windows的登录口令一样<br>· 如果您从未使用过工号进行过登录，默认口令为“Password@1”（P大写）<br>· 如果您多次尝试还不能登录或遗忘了口令，请致电1000分机。</div>	
			</div>
			
		</div>
	</div>
	
</body>
</form>
</html>