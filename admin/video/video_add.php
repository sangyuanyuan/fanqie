<?php
	require_once('../../frame.php');
	$category = new table_class("smg_category");
	$category_menu = $category->find("all",array('conditions' => "category_type='video' and parent_id>0 and can_publish='on'"));
	//上述查询语句条件是类型是视频父类不是4种大类并且该类是可发布的
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('admin');
		validate_form("video_add");
	?>
</head>
<body style="background:#E1F0F7">
	<form id="video_add" enctype="multipart/form-data" action="video.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　添加视频</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td width="100">标　题</td><td width="695" align="left">　<input type="text" size="50" name="video[title]" class="required"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>优先级</td><td align="left">　<input type="text" size="10" id="priority" name="video[priority]">(1-100)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>开启评论</td><td align="left">　<input type="checkbox" name="video[commentable]" id="commentable" checked="checked"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>分　类</td>
			<td align="left" class="newsselect">
			<select id=select name="video[category_id]">
				<?php	
					for($i=0;$i<count($category_menu);$i++){
				?>
					<option value="<?php echo $category_menu[$i]->id;?>"><?php echo $category_menu[$i]->name;?></option>
				<? }?>
			</select>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>关键词</td><td align="left">　<input type="text" size="50" name="video[keywords]">(请用空格或者","分隔开关键词,比如:高考 升学)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>在线视频</td><td align="left">　<input type="text" size="50" name="video[online_url]">（如果本地上传视频此项请留空！）</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left"> <input type="hidden" name="MAX_FILE_SIZE" value="2097152">　<input name="image" id="image" type="file" class="required">(请上传200x160大小的图片，格式支持jpg、gif、png)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择视频</td><td align="left">　 <input type="hidden" name="MAX_FILE_SIZE" value="5000000000"> <input name="video" id="video" type="file" class="required">(请上传视频，并且不要大于500M)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1>
			<td>简短描述</td><td align="left">　<textarea cols="80" rows="8" name="video[description]" class="required"></textarea></td>
		</tr>

		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布视频"></td>
		</tr>	
	</table>
	<input type="hidden" name="video[is_adopt]" value="0">
	</form>
</body>
</html>