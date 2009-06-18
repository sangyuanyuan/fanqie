<?php
	require_once('../../frame.php');
	$type = $_REQUEST['type'];
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
		js_include_tag('picture_list');
	?>
</head>
<body>
	<?php
		$image = new smg_images_class();
		$images = $image->paginate("all",null,4);
		$dept = new table_class("smg_dept");
		$rows_dept = $dept->find("all");
		$category = new table_class("smg_category");
		$rows_category = $category->find("all");
		#var_dump($images);
	?>
	
		<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="5" width="795">　　　<a href="picture_add.php" style="color:#0000FF">发布图片</a>　　　　　　
			搜索　<input id=newskey1 type="text" value="<? echo $key1?>" onKeyPress="newskeypress()">
			<select id=newskey2 style="width:100px" class="select">
				<option value="">发表部门</option>
				<?php for($i=0;$i<count($rows_dept);$i++){?>
				<option value="<?php echo $rows_dept[$i]->name; ?>" <?php if($rows_dept[$i]->id==$key2){?>selected="selected"<? }?>><?php echo $rows_dept[$i]->name;?></option>
				<? }?>
			</select>
			<select id=newskey3 style="width:100px" class="select">
				<option value="">所属类别</option>
				<?php for($i=0;$i<count($rows_category);$i++){?>
				<option value="<?php echo $rows_category[$i]->name; ?>" <?php if($rows_category[$i]->id==$key3){?>selected="selected"<? }?>><?php echo $rows_category[$i]->name; ?></option>
				<? }?>
			</select>
			<select id=newskey4 style="width:100px" class="select">
				<option value="">发布状况</option>
				<option value="1" <? if($key4=="1"){?>selected="selected"<? }?>>已发布</option>
				<option value="0" <? if($key4=="0"){?>selected="selected"<? }?>>未发布</option>
			</select>
			<input type="button" value="搜索" style="border:1px solid #0000ff; height:21px" onClick="newskey()">
			</td>
		</tr>
	</table>
	<?php for($i=0;$i<count($images);$i++){?>
	<div class=v_box id="<?php echo $images[$i]->id;?>">
		<a href="<?php echo $images[$i]->url;?>" target="_blank"><img src="<?php echo $images[$i]->src_path('small');?>" width="170" height="70" border="0"></a>
		<div class=content><a href="<?php echo $images[$i]->url;?>" target="_blank" style="color:#000000; text-decoration:none"><?php echo $images[$i]->title;?></a></div>
		<div class=content><a href="?key2=<?php echo $images[$i]->dept_id;?>" style="color:#0000FF"><?php for($j=0;$j<count($rows_dept);$j++){if($rows_dept[$j]->deptid==$images[$i]->dept_id){echo $rows_dept[$j]->name;}}?></a></div>
		<div class=content><a href="?key3=<?php echo $images[$i]->category_id;?>" style="color:#0000FF"><?php for($k=0;$k<count($rows_category);$k++){if($rows_category[$k]->id==$images[$i]->category_id){echo $rows_category[$k]->name;}}?></a></div>
		<div class=content style="height:20px">
			<?php if($images[$i]->is_adopt=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $images[$i]->id;?>">撤消</span><? }?>
			<?php if($images[$i]->is_adopt=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $images[$i]->id;?>">发布</span><? }?>
			<a href="picture_edit.php?id=<?php echo $images[$i]->id;?>" style="color:#000000; text-decoration:none">编辑</a> 
			<span style="cursor:pointer" class="del" name="<?php echo $images[$i]->id;?>">删除</span>
			<a href="picture_comment.php?id=<?php echo $images[$i]->id;?>" style="color:#000000; text-decoration:none">评论</a>
			<input type="text" id=priority<? echo $p;?> value="<?php if($images[$i]->priority!=100){echo $images[$i]->priority;}?>" style="width:40px;">
			<input type="hidden" id=priorityh<? echo $p;?> value="<?php echo $images[$i]->id;?>" style="width:40px;">	
		</div>
	</div>
	<?php }?>
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td><?php paginate();?></td>
		</tr>
	</table>
</body>
</html>



