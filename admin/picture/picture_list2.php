<?php
	require_once('../../frame.php');
	$user = judge_role('dept_admin');
	$dept_id = $user->dept_id;
	
	$type = $_REQUEST['type'];
	$conditions = null;
	if($_REQUEST['key1']!=""){
		$conditions[] = 'title  like "%'.trim($_REQUEST['key1']).'%"';
	}
	if($_REQUEST['key2']!=""){
		$conditions[] = "is_recommend=".$_REQUEST['key2'];
	}
	if($_REQUEST['key3']!=""){
		$conditions[] = "dept_category_id=".$_REQUEST['key3'];
	}
	if($_REQUEST['key4']!=""){
		$conditions[] = "is_dept_adopt=".$_REQUEST['key4'];
	}
	$conditions[] = "dept_id=".$dept_id;
	$image = new smg_images_class();
	//var_dump($conditions);
	if($conditions!=null){
		$conditions = implode(' and ',$conditions);
		$images = $image->paginate("all",array('conditions' => $conditions,'order' => 'dept_priority'),12);
	}else{
		$images = $image->paginate("all",array('order' => 'dept_priority'),12);
	}
	$category = new table_class("smg_category_dept");
	$rows_category = $category->find("all",array('conditions' => 'category_type="picture" and dept_id='.$dept_id));
	//上述查询语句条件是类型是图片父类不是4种大类
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
		<tr class=tr1>
			<td colspan="5" width="795">　　　<a href="picture_add.php?dept_id=<?php echo $dept_id;?>" style="color:#0000FF">发布图片</a>　　　　　　
			搜索　<input id=newskey1 type="text" value="<? echo $_REQUEST['key1']?>">
			<select id=newskey2 style="width:100px" class="select">
				<option value="">推荐状态</option>
				<option value="1" <? if($_REQUEST['key2']=="1"){?>selected="selected"<? }?>>已推荐</option>
				<option value="0" <? if($_REQUEST['key2']=="0"){?>selected="selected"<? }?>>未推荐</option>
				<option value="2" <? if($_REQUEST['key2']=="2"){?>selected="selected"<? }?>>被退回</option>
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
	<div class="div_box">
		<?php for($i=0;$i<count($images);$i++){?>
		<div class=v_box id="<?php echo $images[$i]->id;?>">
			<a href="<?php echo $images[$i]->url;?>" target="_blank"><img src="<?php echo $images[$i]->src_path('small');?>" width="170" height="70" border="0"></a>
			<div class=content><a href="<?php echo $images[$i]->url;?>" target="_blank" style="color:#000000; text-decoration:none"><?php echo $images[$i]->title;?></a></div>
			<div class=content>
				<?php if($images[$i]->is_recommend=='0'){echo '未推荐';}elseif($images[$i]->is_recommend=='1'){echo '已推荐';}elseif($images[$i]->is_recommend=='2'){echo '被退回';}?>
			</div>
			<div class=content><a href="?key3=<?php echo $images[$i]->dept_category_id;?>" style="color:#0000FF"><?php for($k=0;$k<count($rows_category);$k++){if($rows_category[$k]->id==$images[$i]->dept_category_id){echo $rows_category[$k]->name;}}?></a></div>
			<div class=content style="height:20px">
				<?php if($images[$i]->is_dept_adopt=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $images[$i]->id;?>">撤消</span><? }?>
				<?php if($images[$i]->is_dept_adopt=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $images[$i]->id;?>">发布</span><? }?>
				<a href="picture_edit.php?id=<?php echo $images[$i]->id;?>&dept_id=<?php echo $dept_id;?>" style="color:#000000; text-decoration:none">编辑</a> 
				<?php if($images[$i]->is_recommend=='1'){?><span style="color:#333333">删除</span><?}else{?><span style="cursor:pointer" class="del" name="<?php echo $images[$i]->id;?>">删除</span><?php }?>
				<a href="/admin/comment/comment.php?id=<?php echo $images[$i]->id;?>&type=picture" style="color:#000000; text-decoration:none">评论</a>
				<input type="text" class="priority" name="<?php echo $images[$i]->id;?>" value="<?php if($images[$i]->dept_priority!=100){echo $images[$i]->dept_priority;}?>" style="width:40px;">
				<input type="hidden" id="priorityh<? echo $p;?>" value="<?php echo $images[$i]->id;?>" style="width:40px;">	
			</div>
		</div>
		<?php }?>
	</div>
	<div class="div_box">
		<table width="795" border="0">
			<tr colspan="5" class=tr3>
				<td><?php paginate();?> <button id="edit_priority">编辑优先级</button> <button id="clear_priority">清空优先级</button></td>
			</tr>
		</table>
	</div>
	<input type="hidden" id="is_dept_list" value="true">
	<input type="hidden" id="db_talbe" value="smg_images">
</body>
</html>



