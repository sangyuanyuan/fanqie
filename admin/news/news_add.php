<?php
	require_once('../../frame.php');
	$type = $_REQUEST['type'];
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-添加新闻</title>
	<?php 
		css_include_tag('admin');
		use_jquery();
		validate_form("picture_add");
		js_include_tag('smg_category_class.js');
		
	?>
</head>
<?php 
//initialize the categroy;
	$category = new smg_category_class('news');
	$category->echo_jsdata();
	
?>
<body style="background:#E1F0F7">
	<form id="picture_add" enctype="multipart/form-data" action="picture.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　添加新闻</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td width="100">标　题</td><td width="695" align="left"><?php show_fckeditor('news[title]','Title',false,"50");?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td width="100">短标题</td><td width="695" align="left"><?php show_fckeditor('news[title]','Title',false,"50");?></td>
		</tr>		
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>优先级</td><td align="left">　<input type="text" size="10" id="priority" name=news[priority] class="number">(1-100)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>开启评论</td><td align="left">　<input type="checkbox" name=news[commentable] id=commentable checked="checked"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>分　类</td>
			<td align="left" class="newsselect" id="category_select">
				<select id=select name="news[category_id]">
					<?php	

						
						for($i=count($cates)-1;$i >=0; $i<$i--){
					?>
						<option value="<?php echo $cates[$i]->id;?>"><?php echo $cates[$i]->name;?></option>
					<? }?>
				</select>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>图片链接</td><td align="left">　<input type="text" size="50" name=picture[url]></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left">　<input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file" class="required">(请上传200x160大小的图片，格式支持jpg、gif、png) </td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1>
			<td>简短描述</td><td align="left">　<textarea cols="80" rows="8" name="picture[description]" class="required"></textarea></td>
		</tr>

		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布图片"></td>
		</tr>	
	</table>
	<input type="hidden" name="picture[is_adopt]" value="0">
	<input type="hidden" name="special_type" value="<?php echo $type;?>">
	</form>
</body>
</html>

<script>
	$("#submit").click(function(){
		var oEditor = FCKeditorAPI.GetInstance('title') ;
		var title = oEditor.GetHTML();
		if(title==""){
			alert("请输入标题！");
			return false;
		}
	}); 
	category.echo_select('tegst',$('#category_select'));
</script>