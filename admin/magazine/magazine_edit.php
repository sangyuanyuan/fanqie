<?php
	require_once('../../frame.php');
	$role = judge_role();
	$id = $_REQUEST['id'];
	$magazine = new table_class("smg_magazine");
	$magazine_record = $magazine->find("all",array('conditions' => 'id='.$id));
	
	if($role=='admin'){
		$category = new table_class("smg_category");
		$url = 'magazine_list.php';
		$priority = 'priority';
		$category_id = 'category_id';
		$category_menu = $category->find("all",array('conditions' => "category_type='magazine'","order" => "priority"));
	}else{
		$category = new table_class("smg_category_dept");
		$url = 'magazine_list2.php';
		$priority = 'dept_priority';
		$category_id = 'dept_category_id';
		$dept_id = $_REQUEST['dept_id'];
		$category_menu = $category->find("all",array('conditions' => "category_type='magazine' and dept_id=".$dept_id,"order" => "priority"));
		$category = new table_class("smg_category");
		$category_menu2 = $category->find("all",array('conditions' => "category_type='magazine'","order" => "priority"));
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
		validate_form("magazine_edit");
	?>
</head>
<body style="background:#E1F0F7">
	<form id="magazine_edit" enctype="multipart/form-data" action="magazine.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　编辑电子杂志</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td width="100">标　题</td><td width="695" align="left"><?php show_fckeditor('title','Title',true,"80",$magazine_record[0]->title);?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>优先级</td><td align="left">　<input type="text" size="10" id="priority" name="magazine[<?php echo $priority?>]" value="<?php if($magazine_record[0]->$priority!=100){echo $magazine_record[0]->$priority;}?>" class="number">(1-100)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>开启评论</td><td align="left">　<input type="checkbox" name="magazine[commentable]" id="commentable" <?php if($magazine_record[0]->commentable=="on"){?>checked="checked"<?php }?>></td>
		</tr>
		
		<?php if($role=='dept_admin'){?>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>是否推荐到集团首页</td><td align="left">　<input type="checkbox"  id=is_recommend <?php if($magazine_record[0]->is_recommend=='1'){?>checked="checked"<?php }?>></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id="index_category" <?php if($magazine_record[0]->is_recommend=='0'){?>style="display:none"<?php }?>>
			<td>首页分类</td>
			<td align="left" class="newsselect">
				<select id=select name="magazine[category_id]">
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
			<td align="left" class="newsselect">
				<select id=select name="magazine[dept_id]">
					<option value="7" >总编室</option>
					<?php	
						for($i=0;$i<count($rows_dept);$i++){
					?>
						<option value="<?php echo $rows_dept[$i]->id;?>" <?php if($rows_dept[$i]->id==$magazine_record[0]->dept_id){?>selected="selected"<?php } ?>  ><?php echo $rows_dept[$i]->name;?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<?php } ?>
		
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>分　类</td>
			<td align="left" class="newsselect">
			<select id=select name="magazine[$category_id]">
				<?php	
					for($i=0;$i<count($category_menu);$i++){
				?>
					<option value="<?php echo $category_menu[$i]->id;?>" <?php if($magazine_record[0]->$category_id==$category_menu[$i]->id){?>selected="selected"<? }?>><?php echo $category_menu[$i]->name;?></option>
				<? }?>
			</select>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>关键词</td><td align="left">　<input type="text" size="50" name="magazine[keywords]" value="<?php echo $magazine_record[0]->keywords;?>">(请用空格或者","分隔开关键词,比如:高考 升学)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>在线视频</td><td align="left">　<input type="text" size="50" name="magazine[online_url]" value="<?php echo $magazine_record[0]->online_url;?>">（如果本地上传电子杂志此项请留空！）</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择图片</td><td align="left"> <input type="hidden" name="MAX_FILE_SIZE" value="2097152">　<input name="image" id="image" type="file" >(请上传200x160大小的图片，格式支持jpg、gif、png)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>选择视频</td><td align="left">　 <input type="hidden" name="MAX_FILE_SIZE" value="5000000"> <input name="magazine" id="magazine" type="file" >(请上传电子杂志，并且不要大于50M)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1>
			<td>简短描述</td><td align="left">　<textarea cols="80" rows="8" name="magazine[description]" class="required"><?php echo $magazine_record[0]->description;?></textarea></td>
		</tr>

		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布电子杂志"></td>
		</tr>	
	</table>
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="hidden" name="type" value="edit">
	<input type="hidden" name="url"  value="<?php echo $url;?>">
	<?php if($role=='admin'){
	?>
	<input type="hidden" name="magazine[is_recommend]" id="recommend" value="1">
	<input type="hidden" name="magazine[is_adopt]" value="0">
	<?php }elseif($role=='dept_admin'){
	?>
	<input type="hidden" name="magazine[is_recommend]" id="recommend" value="<?php echo $magazine_record[0]->is_recommend;?>">
	<input type="hidden" name="magazine[is_dept_adopt]" value="0">
	<?php } ?>
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