<?php
	require_once('../../frame.php');
	require_role("admin");
	$type = $_REQUEST['type'];
	$conditions = null;
	if($_REQUEST['key1']!=""){
		$conditions[] = 'title  like "%'.$_REQUEST['key1'].'%"';
	}
	if($_REQUEST['key2']!=""){
		$conditions[] = "dept_id=".$_REQUEST['key2'];
	}
	if($_REQUEST['key3']!=""){
		$conditions[] = "category_id=".$_REQUEST['key3'];
	}
	if($_REQUEST['key4']!=""){
		$conditions[] = "is_adopt=".$_REQUEST['key4'];
	}
	$magazine = new table_class("smg_magazine");
	//var_dump($conditions);
	if($conditions!=null){
		$conditions = implode(' and ',$conditions);
		$magazine_rows = $magazine->paginate("all",array('conditions' => $conditions,'order' => 'priority desc'),10);
	}else{
		$magazine_rows = $magazine->paginate("all",array('order' => 'priority desc'),10);
	}
	$dept = new table_class("smg_dept");
	$rows_dept = $dept->find("all");
	$category = new table_class("smg_category");
	$rows_category = $category->find("all");
	#var_dump($images);
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
		js_include_tag('admin_pub');
	?>
</head>
<body>
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="5" width="795">　　　<a href="magazine_add.php" style="color:#0000FF">发布电子杂志</a>　　　　　　
			搜索　<input id=newskey1 type="text" value="<? echo $key1?>">
			<select id=newskey2 style="width:100px" class="select">
				<option value="">发表部门</option>
				<?php for($i=0;$i<count($rows_dept);$i++){?>
				<option value="<?php echo $rows_dept[$i]->deptid; ?>" <?php if($rows_dept[$i]->id==$_REQUEST['key2']){?>selected="selected"<? }?>><?php echo $rows_dept[$i]->name;?></option>
				<? }?>
			</select>
			<select id=newskey3 style="width:100px" class="select">
				<option value="">所属类别</option>
				<?php for($i=0;$i<count($rows_category);$i++){?>
				<option value="<?php echo $rows_category[$i]->id; ?>" <?php if($rows_category[$i]->id==$_REQUEST['key3']){?>selected="selected"<? }?>><?php echo $rows_category[$i]->name; ?></option>
				<? }?>
			</select>
			<select id=newskey4 style="width:100px" class="select">
				<option value="">发布状况</option>
				<option value="1" <? if($_REQUEST['key4']=="1"){?>selected="selected"<? }?>>已发布</option>
				<option value="0" <? if($_REQUEST['key4']=="0"){?>selected="selected"<? }?>>未发布</option>
			</select>
			<input type="button" value="搜索" id="search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
	</table>
	<?php for($i=0;$i<count($magazine_rows);$i++){?>
	<div class=v_box id="<?php echo $magazine_rows[$i]->id;?>">
		<a href="/magazine/magazine.php?id=<?php echo $magazine_rows[$i]->id;?>" target="_blank"><img src="<?php echo $magazine_rows[$i]->photo_url;?>" width="170" height="70" border="0"></a>
		<div class=content><a href="/magazine/magazine.php?id=<?php echo $magazine_rows[$i]->id;?>" target="_blank" style="color:#000000; text-decoration:none"><?php echo $magazine_rows[$i]->title;?></a></div>
		<div class=content><a href="?key2=<?php echo $magazine_rows[$i]->dept_id;?>" style="color:#0000FF"><?php for($j=0;$j<count($rows_dept);$j++){if($rows_dept[$j]->dept_id==$magazine_rows[$i]->dept_id){echo $rows_dept[$j]->name;}}?></a></div>
		<div class=content><a href="?key3=<?php echo $magazine_rows[$i]->category_id;?>" style="color:#0000FF"><?php for($k=0;$k<count($rows_category);$k++){if($rows_category[$k]->id==$magazine_rows[$i]->category_id){echo $rows_category[$k]->name;}}?></a></div>
		<div class=content style="height:20px">
			<?php if($magazine_rows[$i]->is_adopt=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $magazine_rows[$i]->id;?>">撤消</span><? }?>
			<?php if($magazine_rows[$i]->is_adopt=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $magazine_rows[$i]->id;?>">发布</span><? }?>
			<a href="magazine_edit.php?id=<?php echo $magazine_rows[$i]->id;?>" style="color:#000000; text-decoration:none">编辑</a> 
			<span style="cursor:pointer" class="del" name="<?php echo $magazine_rows[$i]->id;?>">删除</span>
			<a href="magazine_comment.php?id=<?php echo $magazine_rows[$i]->id;?>" style="color:#000000; text-decoration:none">评论</a>
			<input type="text" class="priority" name="<?php echo $magazine_rows[$i]->id;?>" value="<?php if($magazine_rows[$i]->priority!=100){echo $magazine_rows[$i]->priority;}?>" style="width:40px;">
			<input type="hidden" id="priorityh<? echo $p;?>" value="<?php echo $magazine_rows[$i]->id;?>" style="width:40px;">	
		</div>
	</div>
	<?php }?>
	<table width="795" border="0">
		<tr colspan="5" class=tr3>
			<td><?php paginate();?> <button id="edit_priority">编辑优先级</button> <button id="clear_priority">清空优先级</button></td>
		</tr>
	</table>
	<input type="hidden" id="db_talbe" value="smg_magazine">
</body>
</html>



