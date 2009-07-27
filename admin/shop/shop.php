<?
require_once('../../frame.php');
$db=get_db();
$cookie= (isset($_COOKIE['smg_username'])) ? $_COOKIE['smg_username'] : '';
if($cookie=='')
{
	echo '<script language="javascript">window.location.href="/admin/";</script>'; 
}
$sqlstr="select * from smg_shopdp where username='".$cookie."'";
$record=$db->query($sqlstr);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php css_include_tag('admin');
		use_jquery(); 
		js_include_once_tag('admin');
	?>
</head>
<script language="javascript" charset="utf-8">
function get_cookie(name)
{
var result = null;
var myCookie = document.cookie + ";";
var searchName = name + "=";
var startOfCookie = myCookie.indexOf(searchName);
var endOfCookie;
if (startOfCookie != -1)
{
   startOfCookie += searchName.length;
   endOfCookie = myCookie.indexOf(";",startOfCookie);
   result = unescape(myCookie.substring(startOfCookie, endOfCookie)); 
}
return result;
}
</script>

<body style="background:url(/images/bg/admin_bg2.jpg) repeat-x;">
	<div id=admin_body2>
	 <div id=part1>
	 	<? $cookie= (isset($_COOKIE['smg_admin'])) ? $_COOKIE['smg_admin'] : 0;?>
		<div id=nav>欢迎 <? echo $record[0]->name;?> | <a href="/">返回主页</a> |　<? if($cookie=="7"||$cookie=="47"){?><a href="/admin/updatepwdlist.php">修改密码列表</a><? }?> |　<span style="cursor:pointer" onClick="Admin_Logout()">退出</span></div>
		<div id=title>SMG商品管理系统</div>
		<div id=index><a href="/index.php" target="_blank">动态主页</a></div>
	 </div>
	 <div id=part2>	
		<div class=menu1 onClick="show_menu1(2)">店铺管理</div>
		  <div id=menus2 class=menus>
				<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='shopindex.php'">.商品管理</div>
			</div>
	 </div>
	 <div id=part3>
	  <iframe id=admin_iframe scrolling="yes" src="shopindex.php" width="99%" height="700"></iframe>
	 </div>
	 <div id=part4></div>
	</div>
</body>
</html>