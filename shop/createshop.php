<?
parse_str($_SERVER['QUERY_STRING']);
include('../frame.php');
$cookie=(isset($_COOKIE['smg_username']))? $_COOKIE['smg_username'] : '';
if($cookie=='')
{
	alert('请登录以后再操作！');
	redirect('/admin/');
	exit;
}
$db = get_db();
$sqlstr="select * from smg_shopdp where username='".$cookie."'";
$record=$db->query($sqlstr);
if(count($record) > 0)
{
	alert("您已经拥有一家网店，请不要重复创建！");
	redirect("/shop/shoplist.php");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php css_include_tag('smg','top','bottom');
		use_jquery();
		js_include_once_tag('shop','total');
	?>
<script>
	total("个人网店","server");
</script>
</head>
<body >
	 	<? include('../inc/top.inc.html');?>
<div id=bodys>
	<div id=n_left style="width:100%; margin-top:10px; text-align:center;">
	<form name="ldap" id="ldap" enctype="multipart/form-data" action="shop.post.php" method="post"> 
	<table border="0">
		<tr height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　创建个人店铺</td>
		</tr>

		<tr align="center"  height="25px;" style="font-size:12px">
			<td width="100">店铺名：</td><td width="695" align="left"><input type="text" id="dpname"  name="dpname"   style="width:150px"/></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="290px;" id=newsshow2>
			<td>店铺简介</td><td align="left">
			
			<?php show_fckeditor('news[content]','Admin',true,"265");?>
			</td>
		</tr>
		<tr>
			<td>商城照片：</td>
			<td align="left"><input id="upfile" name="upfile" type="file" /></td>
		</tr>
		<tr  height="30px;">
			<td colspan="2" width="795" align="center"><button id=createshop type="button" onclick="check()">创建</button></td>
		</tr>	
	</table>
			<input type="hidden" name="creater" value="<? echo $cookie;?>">
			<input type="hidden" name="type" value="insert">
	</form>
	</div>
</div>
	<? include('../inc/bottom.inc.html');
?>
</body>
</html>