<?
parse_str($_SERVER['QUERY_STRING']);
$cookie=(isset($_COOKIE['smg_username']))? $_COOKIE['smg_username'] : '';
if($cookie=='')
{
	echo '<script language=javascript>alert("请登录以后再操作")</script>';
	echo '<script language=javascript>window.location.href="/admin/";</script>';
	exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script src="/js/pubfun.js"></script>
	<script language="javascript" src="/js/smg.js"></script>
	<script language="javascript" src="shop.js"></script>
</head>
<body >
	 	<? include('../inc/top.inc.html');
	 	require_once('../libraries/sqlrecordsmanager.php');
	 	$sqlmanager = new SqlRecordsManager();
	 	$shopid=$_REQUEST['id'];
	 	?>
	 	
<div id=bodys>
	<div id=n_left style="width:100%; margin-top:10px; text-align:center;">
	<? $shop = $sqlmanager->GetRecords('SELECT * FROM smg_shopdp where id='.$shopid);?>
	<form name="ldap" id="ldap" enctype="multipart/form-data" action="shop.post.php" method="post"> 
	<table border="0">
		<tr height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　编辑个人店铺</td>
		</tr>

		<tr align="center"  height="25px;" style="font-size:12px">
			<td width="100">店铺名：</td><td width="695" align="left">
				<input type="text" id="dpname"  name="dpname" value="<? echo $shop[0]->name;?>"  style="width:150px"/>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="290px;" id=newsshow2>
			<td>店铺简介</td><td align="left">
			
			<input type="hidden" id="content" name="content" value="" style="display:none" /><input type="hidden" id="content___Config" value="" style="display:none" /><iframe id="content___Frame" src="/admin/FCKeditor/editor/fckeditor.html?InstanceName=content&amp;Toolbar=Default" width="98%" height="280" frameborder="0" scrolling="no"></iframe>
			</td>
		</tr>
		<tr>
			<td>商城照片：</td>
			<td align="left"><input id="upfile" name="upfile" type="file" /></td>
		</tr>
		<tr  height="30px;">
			<td colspan="2" width="795" align="center"><button type="button" onClick="check()">更新</button></td>
		</tr>	
	</table>
	<input type="hidden" name="type" value="update">
	<input type="hidden" name="shopid" value="<? echo $shopid;?>">
	</form>
	</div>
</div>
	<? include('../inc/bottom.inc.html');
?>
</body>
</html>