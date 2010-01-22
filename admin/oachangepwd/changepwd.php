<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
</head>
<? 
	require_once("../../frame.php");
	js_include_tag("total");
	css_include_tag('login');
	validate_form('change');
	if($_REQUEST['usercode']=="")
	{
		die('没有找到网页！');	
	}
?>
<script>
	total("修改密码","other");	
</script>
<body>
<div id=main>
		<div id=login  style="background:none">
			<div id=title>SMG修改密码    </div>
			<span style="color:#FF0000"> <? echo $_REQUEST['errorstr'];?></span>
			<div id=box style="border:1px solid #0066FF; background:#CBEBFA">
	<form name="change" method="post" action="updatepwd.post.php">
	<div id=name style="margin-top:15px;" >工　　号：　<input type="text" id="userid" name="updatepwd[userid]" style="width:140px; height:17px;" value="<?php echo $_REQUEST['usercode']; ?>" readonly="true"></div>
   <div id=pwd >原密　码：　<input type="password" id="admin_password" name="updatepwd[admin_password]" style="width:140px; height:17px;" class="required">
   </div>
   <div id=pwd>新密　码：　<input type="password" id="admin_password1" name="updatepwd[admin_password1]" style="width:140px; height:17px;" class="required"></div>
   <div id=pwd>重复密码：　<input type="password" id="repwd" name="repwd" style="width:140px; height:17px;" class=”required” equalTo=”#admin_password1”></div>
   <div id=btn><input id="submit" type="submit" value="提交"></div>
   <input type="hidden" name="updatepwd[username]" id="username" value="<?php echo $cookie;?>">
   <input type="hidden" id="subtype" name="subtype" value="updatepwd">
	<div id=zhu>“番茄网”密码修改指南：<br>· 工号×××××××××。<br>· 默认口令为“Password@1”（P大写）</div>	
	</div>
			
	</div>
	</div>
	</form>			
	
</body>
</html>