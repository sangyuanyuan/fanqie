<?php
	require_once('../../frame.php');
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
	<form id="menu_form" method="post" action="/admin/pub/pub.post.php">
		<tr class=tr1>
			<td colspan="2">　添加部门列表</td>
		</tr>
		<tr class=tr3>
			<td width=150>名称：</td>
			<td width=645 align="left"><input type="text" name="post[name]" class="required"></td>
		</tr>
		<tr class=tr3>
			<td>链接：</td>
			<td align="left"><input type="text" name="post[href]"></td>
		</tr>
		<tr class=tr3>
			<td>优先级：</td>
			<td align="left"><input type="text" name="post[priority]" id="priority" class="required number"></td>
		</tr>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="db_table" value="smg_dept_list">
		<input type="hidden" name="url" value="/admin/deptlist/deptlist_list.php">
		<input type="hidden" name="post_type" value="edit">
	</form>
	</table>
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
