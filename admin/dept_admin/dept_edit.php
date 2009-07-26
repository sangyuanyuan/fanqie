<?php
	require_once('../../frame.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin');
		use_jquery();
		$dept = new table_class('smg_dept');
		$dept= $dept->find($_REQUEST['dept_id']);
	?>
	<form method="post" action="dept.post.php">
		<table width="795" border="0" id="list">
			<tr class="tr1">
				<td colspan="4" align=left>　编辑部门</td>
			</tr>
			<tr class="tr2">
				<td width="100">部门名称</td><td  align=left><input type="text" name="dept[name]" value="<?php echo $dept->name;?>"></td>
			</tr>
			<tr class="tr2">
				<td width="100">优先级</td><td align=left><input type="text" name="dept[priority]" value="<?php echo $dept->priority;?>"></td>
			</tr>
			<tr class="tr2">
				<td width="100">部门代码</td><td align=left><input type="text" name="dept[code]" value="<?php echo $dept->code;?>"></td>
			</tr>
			<tr class="tr2">
				<td width="100">部门链接</td><td align=left><input type="text" name="dept[url]" value="<?php echo $dept->url;?>"></td>
			</tr>
			<tr class="tr2">
				<td width="100">简短描述</td><td align=left><textarea name="dept[name]"><?php echo $dept->description;?></textarea></td>
			</tr>
			<tr class="tr2">
				<td width="100" colspan=2><input type="submit" value="提交"></td>
			</tr>
		</table>
	</form>
</body>
</html>

