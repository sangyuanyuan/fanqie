<?php
	require_once('../../frame.php');
	$user = judge_role('dept_admin');
	$dept_id = $user->dept_id;
	$category = new table_class('smg_category_dept');
	$records = $category->find('all',array('conditions' => 'dept_id='.$dept_id.' and category_type="link"'));
	$count = count($records);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin');
	?>
</head>
<?php
	validate_form("link_form");
?>
<body>
	<table width="795" border="0" id="list">
	<form id="link_form" method="post" action="/admin/pub/pub.post.php">
		<tr class=tr1>
			<td colspan="2">　添加菜单</td>
		</tr>
		<tr class=tr3>
			<td width=150>名称：</td>
			<td width=645 align="left"><input type="text" name="post[name]" class="required"></td>
		</tr>
		<tr class=tr3>
			<td>分　类</td>
			<td align="left">
				<select id=select name="post[category_id]">
					<?php	
						for($i=0;$i<$count;$i++){
					?>
						<option value="<?php echo $records[$i]->id;?>"><?php echo $records[$i]->name;?></option>
					<? }?>
				</select>
			</td>
		</tr>
		<tr class=tr3>
			<td>跳转方式</td>
			<td align="left">
				<select id=select name="post[target]">
					<option value="_self">自身</option>
					<option value="_blank">新开</option>
				</select>
			</td>
		</tr>
		<tr class=tr3>
			<td>链接：</td>
			<td align="left"><input type="text" name="post[link]" class="required"></td>
		</tr>
		<tr class=tr3>
			<td>优先级：</td>
			<td align="left"><input type="text" name="post[priority]" id="priority" class="number"></td>
		</tr>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="db_table" value="smg_link">
		<input type="hidden" name="post[dept_id]" value="<?php echo $dept_id;?>">
		<input type="hidden" name="url" value="/admin/link/link_list.php">
		<input type="hidden" name="post_type" value="edit">
	</form>
	</table>
</body>
</html>
