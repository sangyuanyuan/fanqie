﻿<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG  -帮助</title>
	<?php css_include_tag('smg','top','bottom'); 
		$db=get_db();
	?>
</head>
<body>
<?
include('../inc/top.inc.html');
?>
<div id=bodys>
	<div class=co_title>番茄网使用帮助</div>
	<div class="title" style="color:#FF0000;font-size:16px;line-height:30px;">
	  我要怎样登陆番茄网？
	</div>
	<div>
	　　在番茄网内任何一个页面顶部，都有登录按钮，您只需点击一下，即可进入登录页面。登录时，请注意以下几点：<br>
		<li style="line-height:18px;text-indent:40px;color:blue;">请使用您的“一卡通”工号与口令登录“番茄网”</li>
		<li style="line-height:18px;text-indent:40px;color:blue;">如果您的Windows是用工号登录的，则登录“番茄网”的口令与Windows的登录口令一样</li>
		<li style="line-height:18px;text-indent:40px;color:blue;">如果您从未使用过工号进行过登录，默认口令为“Password@1”（P大写）</li>
		<li style="line-height:18px;text-indent:40px;color:blue;">如果您多次尝试还不能登录或遗忘了口令，请致电1000分机。</li>
	</div>
	<div class="title" style="color:#FF0000;font-size:16px;line-height:30px;">
	  为什么我登录？
	</div>
	<div>
	　　登录番茄网后，您可以自由进入论坛、博客，体验论坛、博客的更多精彩内容。论坛、博客部门内容，在不登录的情况下，是无法体验的，比如论坛发起投票、博客发表日志等。
	</div>
	<div class="title" style="color:#FF0000;font-size:16px;line-height:30px;">
	我要怎样注册论坛？
	</div>
	<div>
	　　番茄网论坛无需注册，您只需登录一次番茄网，系统将为您自动注册论坛。
	</div>
	<div class="title" style="color:#FF0000;font-size:16px;line-height:30px;">
	我要怎样登录论坛？
	</div>
	<div>
	　　您可以在番茄内任何地方登录,登录后,您将自动登录论坛.
	</div>	
	<div class="title" style="color:#FF0000;font-size:16px;line-height:30px;">
	我要怎样开通博客？
	</div>
	<div>
	　　当您首次登陆番茄网后，系统自动为您开通了博客。您首次登陆博客，需要升级您的博客，设置自己喜欢的博客模板后，即可体验博客的所有功能。
	</div>
	
	<div class="title" style="color:#FF0000;font-size:16px;line-height:30px;">
	我要怎样登录博客？
	</div>
	<div>
	　　您可以在番茄内任何地方登录,登录后,您将自动登录博客坛.
	</div>	
</div>
<? include('../inc/bottom.inc.html');
?>	
</body>
</html> 