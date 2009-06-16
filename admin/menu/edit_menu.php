<?php
	require_once('../frame.php');
	css_include_tag('admin');
	use_jquery();
	validate_form("menu_form");
	$id=(int)$_REQUEST['id'];
	
	$menu = new table_class('smg_admin_menu');
	$record = $menu->find("all",array('conditions' => 'id='.$id));
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
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795" align="left">　　编辑菜单</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>名称：</td>
			<td align="left"><input type="text" name="menu[name]"  class="required" value="<?php echo $record[0]->name;?>"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>链接：</td>
			<td align="left"><input type="text" name="menu[href]" id="href" value="<?php echo $record[0]->href;?>"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>描述：</td>
			<td align="left"><input type="text" name="menu[description]"  value="<?php echo $record[0]->description;?>"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td>优先级：</td>
			<td align="left"><input type="text" name="menu[priority]" id="priority" value="<?php echo $record[0]->priority;?>"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795" align="center"><input id="submit" type="submit"  value="提 交"></td>
		</tr>
		<input type="hidden"  name="type" value="edit_menu">
		<input type="hidden"  name="id" value="<?php echo $id;?>"> 
		<input type="hidden"  name="parent_id" value="<?php echo $record[0]->parent_id?>"> 
	</from>
	<table>
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