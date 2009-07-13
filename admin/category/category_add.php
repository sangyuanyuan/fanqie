<?php
	require_once('../../frame.php');
	$role = judge_role();
	$id = $_REQUEST['id'];
	$type = $_REQUEST['type'];
	$parent_id = $id;
	if($role=='admin'){
		$post_table = smg_category;
		$post_url = '/admin/category/category_list.php?type='.$type;
	}else{
		$post_table = smg_category_dept;
		$dept_id = $_REQUEST['dept_id'];
		$post_url = '/admin/category/category_list2.php?type='.$type;
	}
	
	
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin');
		validate_form("category_form");
	?>
</head>
<body>
	<table width="795" border="0" id="list">
	<form id="category_form" method="post" action="/admin/pub/pub.post.php">
		<tr class=tr1>
			<td colspan="2">　添加类别</td>
		</tr>
		<tr class=tr3>
			<td width=150>名称：</td>
			<td width=645 align="left"><input type="text" name="post[name]" class="required"></td>
		</tr>
		<tr class=tr3>
			<td>描述：</td>
			<td align="left"><input type="text" name="post[description]"></td>
		</tr>
		<tr class=tr3>
			<td>优先级：</td>
			<td align="left"><input type="text" name="post[priority]" id="priority" class="number"></td>
		</tr>
		<tr class=tr3>
			<td>平台：</td>
			<td align="left">
				<select name="post[platform]">
					<option value="news">新闻平台</option>
					<option value="zone">交流平台</option>
					<option value="show">展示平台</option>
					<option value="server">服务平台</option>
				</select>
			</td>
		</tr>		
		<?php if($type=="news"){?>
		<tr class=tr3>
			<td>短标题长度：</td>
			<td align="left"><input type="text" name="post[short_title_length]" id="short_title_length" class="number"></td>
		</tr>
		<?php }?>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<?php if($role=='dept_admin'){
		?>
		<input type="hidden" name="post[dept_id]" value="<?php echo $dept_id;?>">
		<?php } ?>	
		<input type="hidden" name="post[category_type]" value="<?php echo $type;?>">
		<input type="hidden" name="post[parent_id]" value="<?php echo $parent_id;?>">
		<input type="hidden" name="db_table" value="<?php echo $post_table;?>">
		<input type="hidden" name="url" value="<?php echo $post_url;?>">
		<input type="hidden" name="post_type" value="edit">
	</form>
	</table>
</body>
</html>
