<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$type = $_REQUEST['type'];
	$post_url = '/admin/category/category_list.php?type='.$type;
	
	if($id==0){
		switch ($type) {
		    case "news":
		        $parent_id = 1;
		        break;
		    case "picture":
		        $parent_id = 2;
		        break;
		    case "video":
		        $parent_id = 3;
				break;
			case "magazine":
				$parent_id = 4;
				break;
			default:
				$parent_id = 0;
		}
	}else{
		$parent_id = $id;
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
			<td align="left"><input type="text" name="post[priority]" id="priority"></td>
		</tr>
		<tr class=tr3>
			<td colspan="2"><button type="submit">提 交</button></td>
		</tr>
		<input type="hidden" name="post[category_type]" value="<?php echo $type;?>">
		<input type="hidden" name="post[parent_id]" value="<?php echo $parent_id;?>">
		<input type="hidden" name="db_table" value="smg_category">
		<input type="hidden" name="url" value="<?php echo $post_url;?>">
		<input type="hidden" name="post_type" value="edit">
	</form>
	</table>
</body>
</html>
