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
	<?php
		use_jquery();
		js_include_tag('total.js');		
	?>
</head>
<script>
	total("修改密码","other");
</script>
<body>
<div id=admin_body1>
		<div id=login  style="background:none">
			<div id=title>SMG修改密码    </div>
			<span style="color:#FF0000"> </span>
			<div id=box style="border:1px solid #0066FF; background:#CBEBFA">
	<div id=name style="margin-top:15px;" >工　　号：<input type="text" id=admin_username name=admin_username style="width:145px; height:17px;"></div>
				<div id=pwd >原密　码：<input type="password" id=admin_password name=admin_password  style="width:145px; height:17px;"></div>
				<div id=pwd >新密　码：<input type="password" id=admin_password2 name=admin_password2  style="width:145px; height:17px;"></div>
				<div id=pwd >重复密码：<input type="password" id=admin_password3 name=admin_password2  style="width:145px; height:17px;"></div>
				<div id=btn><input type="button" value="修改" onClick="Admin_Reg()" class="btn"></div>	
				<input type="hidden" name="lasturl" value="<?php echo $lasturl;?>">
	<div id=zhu>“番茄网”密码修改指南：<br>・ 工号×××××××××。<br>・ 默认口令为“Password@1”（P大写）</div>	
			</div>
			
		</div>
	</div>
	
</body>
</form>
</html>