<?php
	require_once('../frame.php');
	css_include_tag('admin');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
</head>
<body>
	<form id="menu_form" method="POST" action="menu.post.php">
	<a href="">添加一级菜单</a><br>
	名称：<input type="text" name="main_menu_name"><br>
	链接：<input type="text" name="main_menu_link"><br>
	描述：<input type="text" name="main_menu_description"><br>
	优先级：<input type="text" name="main_menu_priority"><br>
	<a href="">添加二级菜单</a><br>
	名称：<input type="text" name="child_menu_name"><br>
	链接：<input type="text" name="child_menu_link"><br>
	描述：<input type="text" name="child_menu_description"><br>
	优先级：<input type="text" name="child_menu_priority"><br>
	主目录名称：<input type="text" name="child_menu_parent"><br>
	<input type="submit"  value="提 交">
	<input type="hidden"  name="type" value="add_menu">
	</from>
</body>
</html>