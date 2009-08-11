<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
</head>
<? 
	require_once("../../frame.php");
	js_include_tag("defalut","admin.js");
	css_include_tag('admin');
	$cookie= (isset($_COOKIE['smg_userid'])) ? $_COOKIE['smg_userid'] : 0;
	if($cookie==0)
	{
		alert("请登录以后再进入重置密码页面!");
		redirect("/admin/");
	}
?>
<body>
<div id=admin_body1>
		<div id=login  style="background:none">
			<div id=title>SMG修改密码    </div>
			<span style="color:#FF0000"> <? echo $_REQUEST['errorstr'];?></span>
			<div id=box style="border:1px solid #0066FF; background:#CBEBFA">
	<form name="change" action="/admin/updatepwd.post.php">
	<div id=name style="margin-top:15px;" >工　　号：　<input type="text" name="loginame" id="loginname" style="width:140px; height:17px;"></div>
   <div id=pwd >原密　码：　<input type="password" id="oldpwd" name="oldpwd" style="width:140px; height:17px;">
   </div>
   <div id=pwd>新密　码：　<input type="password" id="newpwd" name="newpwd" style="width:140px; height:17px;"></div>
   <div id=pwd>重复密码：　<input type="password" id="renewpwd" name="renewpwd" style="width:140px; height:17px;"></div>
   <div id=btn><button id="submit">提交</button></div>
   <input type="hidden" name="username" id="username" value="<?php echo $cookie;?>">
   <input type="hidden" id="subtype" name="subtype" value="updatepwd">
	<div id=zhu>“番茄网”密码修改指南：<br>· 工号×××××××××。<br>· 默认口令为“Password@1”（P大写）</div>	
	</div>
			
	</div>
	</div>
	</form>			
	
</body>
</form>
</html>