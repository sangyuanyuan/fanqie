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
		validate_form('dept_form');
		$category = new table_class('smg_gift_category');
		$category= $category->find($_REQUEST['category_id']);
	?>
	<form id="dept_form" method="post"  enctype="multipart/form-data"  action="gift_category.post.php">
		<table width="795" border="0" id="list">
			<tr class="tr1">
				<td colspan="4" align=left>　<?php if($_REQUEST['category_id']) echo '编辑礼物商店'; else echo '新添礼物商店';?></td>
			</tr>
			<tr class="tr3">
				<td width="100">礼物商店名称</td><td  align=left><input type="text" name="category[name]" class="required" value="<?php echo $category->name;?>"></td>
			</tr>
			<tr class="tr3">
				<td width="100">封面图片</td><td align=left><input type="file" name="img_file"> <?php if($category->img_src) { ?> <a href="<?php echo $category->img_src;?>" target="_blank">查看</a><?php } ?></td>
			</tr>
			<tr class="tr3">
				<td width="100" height="70">简短描述</td><td align=left><textarea name="category[description]" style="width:300px; height:50px;"><?php echo $category->description;?></textarea></td>
			</tr>
			<tr class="tr2">
				<td height=30 colspan=2><input type="submit" value="提交" style="width:100px;"></td>
			</tr>
		</table>
		<input type="hidden" name="category_id" value="<?php echo $_REQUEST['category_id'];?>">
	</form>
</body>
</html>

