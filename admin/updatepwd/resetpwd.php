<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<link href="/css/login.css" rel="stylesheet" type="text/css">
	<title>SMG</title>
</head>
<? 
	require_once("../../frame.php");
	js_include_tag("total");
	validate_form('login');
	$cookie= (isset($_COOKIE['smg_role'])) ? $_COOKIE['smg_role'] : 0;
	if($cookie==0)
	{
			redirect('resetpwdlogin.php','js');
	}
?>
<script>
	total("重置密码","other");	
</script>
<body>
<div id=main>
	<div id=login>
		<div id=title>SMG重置密码    </div>
		<form name=login id=login method="post" action="updatepwd.post.php">
			<div id=box style="border:1px solid #0066FF; background:#CBEBFA">
				<div id=name style="margin-top:15px;" >工　　号：　<input type="text" name="updatepwd[userid]" style="width:140px; height:17px;" class="required"></div>
				<div id=pwd >联系方式：　<input style="width:140px; height:17px;" type="text" name="updatepwd[phone]" class="required"></div>
				<div id=btn><button type="submit">重置密码</button></div>
				<input type="hidden" name="updatepwd[subtype]" value="resetpwd">
				<div id=zhu>“番茄网”重置密码指南：<br>· 输入需要修改员工工号×××××××××。<br>· 输入联系方式</div>	
			</div>
		</form>	
	</div>
</div>
</body>
</form>
</html>