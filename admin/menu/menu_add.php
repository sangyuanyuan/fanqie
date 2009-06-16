<?php
	require_once('../../frame.php');
<<<<<<< HEAD:admin/menu/menu_add.php
	#use_jquery();
=======
>>>>>>> 0346250b66509496be422d7d41f75a7330e35c1b:admin/menu/menu_add.php
	$id=$_REQUEST['id'];
	$type=$_REQUEST['type'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?
		css_include_tag('admin');
	?>
</head>
<?php
	validate_form("menu_form");
?>
<body>
	<table width="795" border="0" id="list">
	<form id="menu_form" method="post" action="menu.post.php">
		<tr class=tr1>
			<td colspan="2">　添加菜单</td>
		</tr>
		<tr class=tr3>
			<td width=150>名称：</td>
			<td width=645 align="left"><input type="text" name="menu[name]" class="required"></td>
		</tr>
		<tr class=tr3>
			<td>链接：</td>
			<td align="left"><input type="text" name="menu[href]"></td>
		</tr>
		<tr class=tr3>
			<td>链接方式:</td>
			<td align="left"><input type="text" name="menu[target]"> (admin_iframe,#,_blank)</td>
		</tr>
		<tr class=tr3>
			<td>描述：</td>
			<td align="left"><input type="text" name="menu[description]"></td>
		</tr>
		<tr class=tr3>
			<td>优先级：</td>
			<td align="left"><input type="text" name="menu[priority]" id="priority" class="required number"></td>
		</tr>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
	<input type="hidden" name="type" value="add_menu">
	<input type="hidden" name="menu[parent_id]" value="<?php echo $id;?>">
	<input type="hidden" name="menu_type" value="<?php echo $type;?>">
	</from>
	</table>
</body>
</html>
<?php
	validate_form("menu_form");
?>
<script>
	$(document).ready(function(){
		$("#submit").click(function(){
			if($("#priority").attr('value')==""){
				$("#priority").attr('value','100');
			}
		});
	});
</script>
