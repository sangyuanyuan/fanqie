<?php
	require_once('../../frame.php');
	$role = judge_role();
	$type = $_REQUEST['type'];
	$dept_id = $_REQUEST['dept_id'];
	
	if($role=='admin'){
		$category = new table_class("smg_category");
		$url = 'video_list.php';
		if($type==""){	
			$category_menu = $category->find("all",array('conditions' => "category_type='video'","order" => "platform,priority"));
		}else{
			$category_menu = $category->find("all",array('conditions' => "category_type='video' and name='".$type."'","order" => "platform,priority"));	
		}
	}else{
		$category = new table_class("smg_category_dept");
		$url = 'video_list2.php';
		if($type==""){	
			$category_menu = $category->find("all",array('conditions' => "category_type='video' and dept_id=".$dept_id,"order" => "priority"));
		}else{
			$category_menu = $category->find("all",array('conditions' => "category_type='video' and name='".$type."' and dept_id=".$dept_id,"order" => "priority"));	
		}
		$category = new table_class("smg_category");
		$category_menu2 = $category->find("all",array('conditions' => "category_type='video'","order" => "platform,priority"));
	}
	
	$dept = new table_class("smg_dept");
	$rows_dept = $dept->find("all");
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
			<td width="100">标　题</td><td width="695" align="left"><?php show_fckeditor('title','Title',true,"80");?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>优先级</td><td align="left"><input type="text" size="10" id="priority" name="video[<?php if($role=='dept_admin'){echo 'dept_';}?>priority]" class="number">(1-100)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>开启评论</td><td align="left"><input type="checkbox" name="video[commentable]" id="commentable" checked="checked"></td>
		</tr>
		
		<?php if($role=='dept_admin'){?>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>是否推荐到集团首页</td><td align="left">　<input type="checkbox" name=is_recommend id=is_recommend></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id="index_category" style="display:none">
			<td>首页分类</td>
			<td align="left">
				<select id=select name="video[category_id]">
					<?php	
						for($i=0;$i<count($category_menu2);$i++){
					?>
						<option value="<?php echo $category_menu2[$i]->id;?>"><?php echo $category_menu2[$i]->name;?></option>
					<? }?>
				</select>
			</td>
		</tr>
		<?php }?>
		
		<?php if($role=='admin'){?>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id="index_category">
			<td>发表部门</td>
			<td align="left">
				<select id=select name="video[dept_id]">
					<option value="7" >总编室</option>
					<?php	
						for($i=0;$i<count($rows_dept);$i++){
							if($rows_dept[$i]->id!='7'){
					?>
						<option value="<?php echo $rows_dept[$i]->id;?>" ><?php echo $rows_dept[$i]->name;?></option>
					<?php } }?>
				</select>
			</td>
		</tr>
		<?php }else{?>
		<input type="hidden" name="video[dept_id]"  value="<?php echo $dept_id;?>">
		<?php } ?>
		
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>分　类</td>
			<td align="left">
			<select id=url_s name="video[<?php if($role=='dept_admin'){echo 'dept_';}?>category_id]">
				<?php	
					for($i=0;$i<count($category_menu);$i++){
				?>
					<option value="<?php echo $category_menu[$i]->id;?>"><?php echo $category_menu[$i]->name;?></option>
				<? }?>
			</select>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>标签</td>
			<td align="left">
				<select name="video[tags]">
					<option value="">请选择</option>
				<?php
				$tags = get_config('g_video_tags');
				foreach ($tags as $v) {
					echo "<option value='{$v}'>$v</option>";
				}
				?>
				</select>			
			</td>
		</tr>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>关键词</td>
			<td align="left">
				<input type="text"name="video[keywords]">(请用空格或者","分隔开关键词,比如:高考 升学)				
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>在线视频</td><td align="left"><input type="text" size="50" name="video[online_url]" id="online">（如果本地上传视频此项请留空！）</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >

			<td>选择图片</td><td align="left"><input type="hidden" name="MAX_FILE_SIZE" value="2097152"><input name="image" id="image" type="file">(请上传小于2M的图片，格式支持jpg、gif、png)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择视频</td><td align="left"><input type="hidden" name="MAX_FILE_SIZE" value="5000000000"><input name="video" id="video" type="file">(请上传视频，并且不要大于500M，格式支持flv,wma,wav,mp3,mp4,avi,rm)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1>
			<td>简短描述</td><td align="left"><textarea cols="80" rows="8" name="video[description]" id="description" class="required"></textarea></td>
		</tr>

		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布视频"></td>
		</tr>	
	</table>
	<input type="hidden" name="video[created_at]"  value="<?php echo  date("Y-m-d H:i:s")?>">
	<input type="hidden" name="url" id=url value="<?php echo $url;?>">
	<input type="hidden" name="video[is_adopt]" value="1">
	<input type="hidden" name="video[is_dept_adopt]" value="1">
	<?php if($role=='admin'){?>
	<input type="hidden" name="video[is_recommend]" id="recommend" value="1">
	<?php }else{ ?>
	<input type="hidden" name="video[is_recommend]" id="recommend" value="0">
	<?php } ?>
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
		if($("#image").val()!=''){
			var upfile1 = $("#image").val();
			var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){
				alert("上传图片类型错误");
				return false;
			}
		}else{
			alert("请上传一个图片！");
			return false;
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
			if($("#online").val()==''){
				alert('请上传一个视频或者输入在线视频地址！');
				return false;
			}
		}
		
		if($("#description").val()==''){
			alert('请输入简短描述！');
			return false;
		}
	}); 	
	
	$("#is_recommend").click(function(){
		if($(this).attr('checked')==true){
			$("#index_category").show();
			$("#recommend").attr('value','1');
		}else{
			$("#index_category").hide();
			$("#recommend").attr('value','0');
		}
	});
	
</script>