<?php
	require_once('../frame.php');
	css_include_tag('admin');
	validate_form("menu_form");
	$id=$_REQUEST['id'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
</head>
<body>
	<table width="795" border="0" id="list" style="font-size:14px;">
	<form id="menu_form" method="POST" action="menu.post.php">
	<?php if($id==0){?>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795" align="left">　　添加主菜单</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>名称：</td>
			<td align="left"><input type="text" name="menu[name]" class="required"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>链接：</td>
			<td align="left"><input type="text" name="menu[href]" id="href"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>描述：</td>
			<td align="left"><input type="text" name="menu[description]"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>优先级：</td>
			<td align="left"><input type="text" name="menu[priority]" id="priority"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795" align="center"><input type="submit" id="submit" value="提 交"></td>
		</tr>
	<?php }else{?>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795" align="left">　　添加子菜单</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>名称：</td>
			<td align="left"><input type="text" name="menu[name]" class="required"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>链接：</td>
			<td align="left"><input type="text" name="menu[href]" id="href"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>描述：</td>
			<td align="left"><input type="text" name="menu[description]"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>优先级：</td>
			<td align="left"><input type="text" name="menu[priority]" id="priority"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795" align="center"><input type="submit" id="submit" value="提 交"></td>
		</tr>
	<?php }?>
	<input type="hidden"  name="type" value="add_menu">
	<input type="hidden" name="menu[parent_id]" value="<?php echo $id;?>">
	</from>
	</table>
</body>
</html>

<script>
	$(document).ready(function(){
		$("#submit").click(function(){
			if($("#href").attr('value')==""){
				$("#href").attr('value','#');
			}
			if($("#priority").attr('value')==""){
				$("#priority").attr('value','100');
			}
		});
	});
</script>