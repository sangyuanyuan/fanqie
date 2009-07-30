<?php
	require_once('../../frame.php');
	$db = get_db();
	$id = $_REQUEST['id'];
	$image = new table_class('smg_images');
	$image->find($id);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('admin');
		use_jquery();
	?>
</head>
<body style="background:#E1F0F7">
	<form id="picture_add" enctype="multipart/form-data" action="picture.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　编辑图片</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td width="100">标　题</td><td width="695" align="left"><input size="50" type="text" name="picture[title]" value="<?php echo $image->title; ?>" id=title></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>优先级</td><td align="left"><input type="text" size="10" id="priority" name="picture[priority]" value="<?php if($image->priority!=100){echo $image->priority;}?>" class="number">(1-100)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>关键词</td><td align="left"><input type="text" size="50" value="<?php echo $image->keywords; ?>" name="picture[keywords]">(请用空格或者","分隔开关键词,比如:高考 升学)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>开启评论</td><td align="left"><input type="checkbox" name=picture[commentable] id=commentable <?php if($image->commentable=='on'){?> checked="checked" <?php } ?>></td>
		</tr>
		
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>分　类</td>
			<td align="left">
				<select id=url_s name="picture[category_id]">
					<?php
						$db = get_db();
						$sql = 'select name,id from smg_category where category_type="zongcai" and description="image"';
						$records = $db->query($sql);
						$count = count($records);
						for($i=0;$i<$count;$i++){
					?>
						<option <?php if($records[$i]->id==$image->category_id){?> selected="selected" <?php } ?> value="<?php echo $records[$i]->id;?>"><?php echo $records[$i]->name;?></option>
					<? }?>
				</select>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>图片链接</td><td align="left"><input type="text" size="50" id="online" value="<?php echo $image->url; ?>" name=picture[url]></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left"><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file">(请上传小于2M的图片，格式支持jpg、gif、png)<?php if($image->src!=''){?><a href="<?php echo $image->src;?>" target="_blank" style="color:#0000FF">点击查看图片</a><?php } ?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1>
			<td>简短描述</td><td align="left"><textarea cols="76" rows="8" name="picture[description]" value="<?php echo $image->description;?>" id="description"><?php echo $image->description;?></textarea></td>
		</tr>

		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布图片"></td>
		</tr>	
	</table>
	<input type="hidden" id="u_s" value="<?php echo $image->src; ?>">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	</form>
</body>
</html>

<script>
	$("#submit").click(function(){
		if($("#title").val()==''){
			alert('请输入标题！');
			return false;
		}
		
		if($("#image").val()!=''){
			var upfile1 = $("#image").val();
			var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){
				alert("上传图片类型错误");
				return false;
			}
		}else{
			if($("#u_s").val()==''){
				if($("#online").val()==''){
					alert("请上传一个图片或者输入链接地址");
					return false;
				}
			}
		}
		if($("#description").val()==''){
			alert('请输入简短描述！');
			return false;
		}
	}); 
</script>