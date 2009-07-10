<?php
	require_once('../../frame.php');
	$user = judge_role('admin');
	$dept_id = 7;
	
	$sql = 'select t1.*,t2.name as dept_name,t3.name as category_name from smg_video t1,smg_dept t2,smg_category t3 where t1.dept_id=t2.id and t1.category_id=t3.id';
	if($_REQUEST['key1']!=""){
		$sql = $sql.' and title  like "%'.trim($_REQUEST['key1']).'%"';
	}
	if($_REQUEST['key2']!=""){
		$sql = $sql." and dept_id=".$_REQUEST['key2'];
	}
	if($_REQUEST['key3']!=""){
		$sql = $sql." and category_id=".$_REQUEST['key3'];
	}
	if($_REQUEST['key4']!=""){
		$sql = $sql." and is_adopt=".$_REQUEST['key4'];
	}
	$sql = $sql.' and is_recommend=1 order by priority';
	
	$db = get_db();
	$video_rows = $db->paginate($sql,10);
	close_db();
	
	
	$dept = new table_class("smg_dept");
	$rows_dept = $dept->find("all");
	$category = new table_class("smg_category");
	$rows_category = $category->find("all",array('conditions' => "category_type='video'"));
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
		<tr class="tr1">
			<td colspan="5" width="795">　　　<a href="video_add.php" style="color:#0000FF">发布视频</a>　　　　　　
			搜索　<input id=newskey1 type="text" value="<? echo $_REQUEST['key1']?>">
			<select id=newskey2 style="width:100px" class="select">
				<option value="">发表部门</option>
				<?php for($i=0;$i<count($rows_dept);$i++){?>
				<option value="<?php echo $rows_dept[$i]->id; ?>" <?php if($rows_dept[$i]->id==$_REQUEST['key2']){?>selected="selected"<? }?>><?php echo $rows_dept[$i]->name;?></option>
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
	<div class="div_box">
		<?php for($i=0;$i<count($video_rows);$i++){?>
		<div class=v_box id="<?php echo $video_rows[$i]->id;?>">
			<a href="/video/video.php?id=<?php echo $video_rows[$i]->id;?>" target="_blank">
				<img src="<?php echo $video_rows[$i]->photo_url;?>" width="170" height="70" border="0">
			</a>
			<div class=content>
				<a href="/video/video.php?id=<?php echo $video_rows[$i]->id;?>" target="_blank" style="color:#000000; text-decoration:none">
					<?php echo $video_rows[$i]->title;?>
				</a>
			</div>
			<div class=content>
				<a href="?key2=<?php echo $video_rows[$i]->dept_id;?>" style="color:#0000FF">
					<?php echo $video_rows[$i]->dept_name;?>
				</a>
			</div>
			<div class=content>
				<a href="?key3=<?php echo $video_rows[$i]->category_id;?>" style="color:#0000FF">
					<?php echo $video_rows[$i]->category_name;?>
				</a>
			</div>
			<div class=content style="height:20px">
				<?php if($video_rows[$i]->is_adopt=="1"){?>
					<span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $video_rows[$i]->id;?>">撤消</span>
				<?php }?>
				<?php if($video_rows[$i]->is_adopt=="0"){?>
					<span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $video_rows[$i]->id;?>">发布</span>
				<?php }?>
				<a href="video_edit.php?id=<?php echo $video_rows[$i]->id;?>" style="color:#000000; text-decoration:none">编辑</a> 
				<?php if($video_rows[$i]->dept_id!="7"){?>
					<span style="cursor:pointer" class="return" name="<?php echo $video_rows[$i]->id;?>">退回</span>
				<?php }else{?>
					<span style="cursor:pointer" class="del" name="<?php echo $video_rows[$i]->id;?>">删除</span>
				<?php }?>
				<a href="/admin/comment/comment.php?id=<?php echo $video_rows[$i]->id;?>&type=video" style="color:#000000; text-decoration:none">评论</a>
				<input type="text" class="priority" name="<?php echo $video_rows[$i]->id;?>" value="<?php if($video_rows[$i]->priority!=100){echo $video_rows[$i]->priority;}?>" style="width:40px;">
				<input type="hidden" id="priorityh<? echo $p;?>" value="<?php echo $video_rows[$i]->id;?>" style="width:40px;">	
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
	<input type="hidden" id="db_talbe" value="smg_video">
</body>
</html>



