<?php
	require_once('../../frame.php');
	$id=$_REQUEST['id'];
	$category = new table_class('smg_category');
	$record = $category->find("all",array('conditions' => 'id='.$id));	
	$post_url = '/admin/category/category_list.php?type='.$record[0]->category_type;
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
			<td colspan="2">　编辑类别</td>
		</tr>
		<tr class=tr3>
			<td width=150>名称：</td>
			<td width=645 align="left"><input type="text" name="post[name]"  class="required" value="<?php echo $record[0]->name;?>"></td>
		</tr>
		<tr class=tr3>
			<td>描述：</td>
			<td align="left"><input type="text" name="post[description]"  value="<?php echo $record[0]->description;?>"></td>
		</tr>
		<tr class=tr3>
			<td>优先级：</td>
			<td align="left"><input type="text" name="post[priority]" id="priority" value="<?php if($record[0]->priority!=100){echo $record[0]->priority;}?>" class="number"></td>
		</tr>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="post[category_type]" value="<?php echo $record[0]->category_type;?>">
		<input type="hidden" name="post[parent_id]" value="<?php echo $record[0]->parent_id;?>">
		<input type="hidden" name="post[id]" value="<?php echo $id;?>">
		<input type="hidden" name="db_table" value="smg_category">
		<input type="hidden" name="url" value="<?php echo $post_url;?>">
		<input type="hidden" name="post_type" value="edit">
	</form>
	<table>
</body>
</html>