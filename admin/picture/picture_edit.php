<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$picture = new table_class("smg_images");
	$picture_record = $picture->find("all",array('conditions' => 'id='.$id));
	$category = new table_class("smg_category");
	$category_menu = $category->find("all",array('conditions' => "category_type='picture' and parent_id>0","order" => "priority"));
	//上述查询语句条件是类型是图片父类不是4种大类并且该类是可发布的
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('admin');
		validate_form("picture_edit");
	?>
</head>
<body style="background:#E1F0F7">
	<form id="picture_edit" enctype="multipart/form-data" action="picture.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　编辑图片</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td width="100">标　题</td><td width="695" align="left">　<input type="text" size="50" name="picture[title]" class="required" value="<?php echo $picture_record[0]->title;?>" class="number"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>优先级</td><td align="left">　<input type="text" size="10" id="priority" name="picture[priority]" value="<?php if($picture_record[0]->priority!=100){echo $picture_record[0]->priority;}?>">(1-100)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>开启评论</td><td align="left">　<input type="checkbox" name="picture[commentable]" id=commentable <?php if($picture_record[0]->commentable==="on"){?>checked="checked"<?php }?> ></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>分　类</td>
			<td align="left" class="newsselect">
			<select id=selecta name="picture[category_id]">
				<?php	
					for($i=0;$i<count($category_menu);$i++){
				?>
					<option value="<?php echo $category_menu[$i]->id;?>" <?php if($category_menu[$i]->id==$picture_record[0]->category_id){?>selected="selected"<?php }?>><?php echo $category_menu[$i]->name;?></option>
				<? }?>
			</select>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>图片链接</td><td align="left">　<input type="text" size="50" name="picture[url]" value="<?php echo $picture_record[0]->url;?>"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left">　<input name="image" id="upfile" type="file">(请上传200x160大小的图片，格式支持jpg、gif、png) <input type="hidden" name="MAX_FILE_SIZE1" value="2097152"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1>
			<td>简短描述</td><td align="left">　<textarea cols="80" rows="8" name="picture[description]" class="required" ><?php echo $picture_record[0]->description;?></textarea></td>
		</tr>

		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布图片"></td>
		</tr>	
	</table>
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="hidden" name="type" value="edit">
	<input type="hidden" name="picture[is_adopt]" value="0">
	</form>
</body>
</html>