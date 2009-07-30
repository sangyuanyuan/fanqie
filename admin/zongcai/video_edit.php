<?php
	require_once('../../frame.php');
	$db = get_db();
	$id = $_REQUEST['id'];
	$video = new table_class('smg_video');
	$video->find($id);
	
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
	<form id="video_add" enctype="multipart/form-data" action="video.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　添加视频</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td width="100">标　题</td><td width="695" align="left"><input type="text" size="50" name="video[title]" value="<?php echo $video->title; ?>" id="title"></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>优先级</td><td align="left"><input type="text" size="10" id="priority" name="video[priority]" value="<?php if($video->priority!=100){echo $video->priority;} ?>" class="number">(1-100)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>开启评论</td><td align="left"><input type="checkbox" name="video[commentable]" id="commentable" <?php if($video->commentable=='on'){?> checked="checked" <?php } ?> ></td>
		</tr>
		
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>分　类</td>
			<td align="left">
			<select id=url_s name="video[category_id]">
				<?php
					$db = get_db();
					$sql = 'select name,id from smg_category where category_type="zongcai" and description="video"';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
					<option <?php if($records[$i]->id==$video->category_id){?> selected="selected" <?php } ?> value="<?php echo $records[$i]->id;?>"><?php echo $records[$i]->name;?></option>
				<? }?>
			</select>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>关键词</td>
			<td align="left">
				<input type="text" value="<?php echo $video->keywords; ?>" name="video[keywords]">(请用空格或者","分隔开关键词,比如:高考 升学)				
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>在线视频</td><td align="left"><input type="text" value="<?php echo $video->online_url; ?>" size="50" name="video[online_url]" id="online">（如果本地上传视频此项请留空！）</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >

			<td>选择图片</td><td align="left"><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file">(请上传小于2M的图片，格式支持jpg、gif、png)<?php if($video->photo_url!=''){?><a style="color:#0000FF" href="<?php echo $video->photo_url;?>" target="_blank">点击查看图片</a><?php } ?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择视频</td><td align="left"><input type="hidden" name="MAX_FILE_SIZE" value="5000000000"><input name="video" id="video" type="file">(请上传视频，并且不要大于500M)<?php if($video->video_url!=''){?><a style="color:#0000FF"  href="<?php echo $video->video_url;?>" target="_blank">点击下载视频</a><?php } ?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1>
			<td>简短描述</td><td align="left"><textarea cols="80" rows="8" name="video[description]" id="description" class="required"><?php echo $video->description; ?></textarea></td>
		</tr>

		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布视频"></td>
		</tr>	
	</table>
	<input type="hidden" id="u_s" value="<?php echo $video->src; ?>">
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
		}
		
		if($("#video").val()!=''){
			var upfile2 = $("#video").val();
			upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);
			if(upload_file_extension.toLowerCase()!=".flv"&&upload_file_extension.toLowerCase()!=".wmv"&&upload_file_extension.toLowerCase()!=".wav"&&upload_file_extension.toLowerCase()!=".mp3"&&upload_file_extension.toLowerCase()!=".mp4"&&upload_file_extension.toLowerCase()!=".avi"){
				upload_file_extension=upfile2.substring(upfile2.length-3,upfile2.length);
				if(upload_file_extension.toLowerCase()!=".rm"){
					alert("上传视频类型错误");
					return false;
				}
			}
		}else{
			if($("#u_s").val()==''){
				if($("#online").val()==''){
					alert('请上传一个视频或者输入在线视频地址！');
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