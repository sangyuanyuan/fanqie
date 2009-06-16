<?php
	require_once('../../frame.php');
	$id=(int)$_REQUEST['id'];
	$type=$_REQUEST['type'];
	if("admin"==$type) {$menu = new table_class('smg_admin_menu');}
	else if("dept"==$type) {$menu = new table_class('smg_admin_menu_dept');}	
	$record = $menu->find("all",array('conditions' => 'id='.$id));
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?
		css_include_tag('admin');
	  use_jquery();
	?>
</head>
<body>
<?php
	validate_form("menu_form");
?>
	<table width="795" border="0" id="list">
	<form id="menu_form" method="post" action="menu.post.php">
		<tr class=tr1>
			<td colspan="2">　编辑菜单</td>
		</tr>
		<tr class=tr3>
			<td width=150>名称：</td>
			<td width=645 align="left"><input type="text" name="menu[name]"  class="required" value="<?php echo $record[0]->name;?>"></td>
		</tr>
		<tr class=tr3>
			<td>链接：</td>
			<td align="left"><input type="text" name="menu[href]" id="href" value="<?php echo $record[0]->href;?>"></td>
		</tr>
		<tr class=tr3>
			<td>链接方式:</td>
			<td align="left"><input type="text" name="menu[target]" value="<?php echo $record[0]->target;?>"> (admin_iframe,#,_blank)</td>
		</tr>
		<tr class=tr3>
			<td>描述：</td>
			<td align="left"><input type="text" name="menu[description]"  value="<?php echo $record[0]->description;?>"></td>
		</tr>
		<tr class=tr3>
			<td>优先级：</td>
			<td align="left"><input type="text" name="menu[priority]" id="priority" value="<?php echo $record[0]->priority;?>"></td>
		</tr>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden"  name="type" value="edit_menu">
		<input type="hidden"  name="id" value="<?php echo $id;?>"> 
		<input type="hidden"  name="parent_id" value="<?php echo $record[0]->parent_id?>"> 
		<input type="hidden" name="menu_type" value="<?php echo $type;?>">
	</from>
	<table>
</body>
</html>

<script>
	$(document).ready(function(){
		$("#submit").click(function(){
			if($("#priority").attr('value')==""){
				$("#priority").attr('value','100');
			}
		});
	});
</script>