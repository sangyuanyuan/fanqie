<?php
	require_once('../../frame.php');
	$role = judge_role();
	$id=$_REQUEST['id'];
	if($role=='admin'){
		$category = new table_class('smg_category');
		$record = $category->find("all",array('conditions' => 'id='.$id));	
		$post_url = '/admin/category/category_list.php?type='.$record[0]->category_type;
		$post_table = 'smg_category';
	}else{
		$category = new table_class('smg_category_dept');
		$record = $category->find("all",array('conditions' => 'id='.$id));	
		$post_url = '/admin/category/category_list2.php?type='.$record[0]->category_type;
		$post_table = 'smg_category_dept';
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
			<td>平台：</td>
			<td align="left">
				<select name="post[platform]">
					<option value="news" <?php if($record[0]->platform == 'news') {?>  selected="selected" <?php }?>>新闻平台</option>
					<option value="zone" <?php if($record[0]->platform == 'zone') {?>  selected="selected" <?php }?>>交流平台</option>
					<option value="show" <?php if($record[0]->platform == 'show') {?>  selected="selected" <?php }?>>展示平台</option>
					<option value="server" <?php if($record[0]->platform == 'server') {?>  selected="selected" <?php }?>>服务平台</option>
					<option value="subject" <?php if($record[0]->platform == 'subject') {?>  selected="selected" <?php }?>>专题平台</option>
				</select>
			</td>
		</tr>
		<?php if($record[0]->category_type=="news"){?>
		<tr class=tr3>
			<td>短标题长度：</td>
			<td align="left"><input type="text" name="post[short_title_length]" id="short_title_length" value="<?php echo $record[0]->short_title_length;?>"class="number"></td>
		</tr>
		<?php }?>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="hidden" name="db_table" value="<?php echo $post_table;?>">
		<input type="hidden" name="url" value="<?php echo $post_url;?>">
		<input type="hidden" name="post_type" value="edit">
	</form>
	<table>
</body>
</html>