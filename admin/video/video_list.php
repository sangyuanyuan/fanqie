<?php
	require_once('../../frame.php');
	$user = judge_role('admin');
	
	$title = $_REQUEST['title'];
	$category_id = $_REQUEST['category'] ? $_REQUEST['category'] : -1;
	$dept_id = $_REQUEST['dept'];
	$is_adopt = $_REQUEST['adopt'];
	$db = get_db();
	$sql = 'select * from smg_dept';
	$rows_dept = $db->query($sql);
	$c = array();
	if($category_id > 0){
		array_push($c, "category_id=$category_id");
	}
	if($dept_id!=''){
		array_push($c, "dept_id=$dept_id");
	}
	if($is_adopt!=''){
		array_push($c, "is_adopt=$is_adopt");
	}
	array_push($c, "is_recommend=1");
	if($title){
		$video_rows = search_content($title,'smg_video',implode(' and ', $c),20,'priority asc,created_at desc');
	}else{
		$video = new table_class('smg_video');
		$video_rows = $video->paginate('all',array('conditions' => implode(' and ', $c),'order' => 'priority asc,created_at desc'),12);
	}
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
		js_include_tag('admin_pub','smg_category_class');
		$category = new smg_category_class('video');
		$category->echo_jsdata();		
	?>
</head>
<body>
	<table width="795" border="0">
		<tr class="tr1">
			<td colspan="5" width="795">　<a href="video_add.php" style="color:#0000FF">发布视频</a> 　　　
			搜索　<input id=title type="text" value="<? echo $_REQUEST['title']?>"><select id=dept style="width:100px" class="select_new">
					<option value="">发表部门</option>
					<?php for($i=0;$i<count($rows_dept);$i++){?>
					<option value="<?php echo $rows_dept[$i]->id; ?>" <?php if($rows_dept[$i]->id==$_REQUEST['dept']){?>selected="selected"<? }?>><?php echo $rows_dept[$i]->name;?></option>
					<? }?>
				</select><span id="span_category"></span><select id=adopt style="width:100px" class="select_new">
					<option value="">发布状况</option>
					<option value="1" <? if($_REQUEST['adopt']=="1"){?>selected="selected"<? }?>>已发布</option>
					<option value="0" <? if($_REQUEST['adopt']=="0"){?>selected="selected"<? }?>>未发布</option></select>
				<input type="button" value="搜索" id="search_new" style="border:1px solid #0000ff; height:21px">
				<input type="hidden" value="<?php echo $category_id;?>" id="category">
			</td>
		</tr>
	</table>
	<div class="div_box">
		<?php for($i=0;$i<count($video_rows);$i++){?>
		<div class=v_box id="<?php echo $video_rows[$i]->id;?>">
			<a href="/show/video.php?id=<?php echo $video_rows[$i]->id;?>" target="_blank">
				<img src="<?php echo $video_rows[$i]->photo_url;?>" width="170" height="70" border="0">
			</a>
			<div class=content>
				<a href="/show/video.php?id=<?php echo $video_rows[$i]->id;?>" target="_blank" style="color:#000000; text-decoration:none">
					<?php echo strip_tags( $video_rows[$i]->title);?>
				</a>
			</div>
			<div class=content>
				<a href="?dept=<?php echo $video_rows[$i]->dept_id;?>" style="color:#0000FF">
					<a href="$video_rows" style="color:#0000FF"><?php echo get_dept_info($video_rows[$i]->dept_id)->name;?></a>
				</a>
			</div>
			<div class=content>
				<a href="?category=<?php echo $video_rows[$i]->category_id;?>" style="color:#0000FF">
					<a href="?category=<?php echo $video_rows[$i]->category_id;?>" style="color:#0000FF"><?php echo $category->find($video_rows[$i]->category_id)->name; ?></a>
				</a>
			</div>
			<div class=content>
				<?php echo $video_rows[$i]->created_at; ?>
			</div>
			<div class=content style="height:20px">
				<?php if($video_rows[$i]->is_adopt=="1"){?>
					<span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $video_rows[$i]->id;?>">撤消</span>
				<?php }?>
				<?php if($video_rows[$i]->is_adopt=="0"){?>
					<span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $video_rows[$i]->id;?>">发布</span>
				<?php }?>
				<a href="video_edit.php?id=<?php echo $video_rows[$i]->id;?>" style="color:#000000; text-decoration:none">编辑</a> 
				<a href="/admin/comment/comment.php?id=<?php echo $video_rows[$i]->id;?>&type=video" style="color:#000000; text-decoration:none">评论</a>
				<?php if($video_rows[$i]->dept_id!="7"){?>
					<span style="cursor:pointer;color:#ff0000;" class="return" name="<?php echo $video_rows[$i]->id;?>">退回</span>
				<?php }else{?>
					<span style="cursor:pointer;color:#ff0000;" class="del" name="<?php echo $video_rows[$i]->id;?>">删除</span>
				<?php }?>
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

<script>
	$(function(){
		category.display_select('category_select',$('#span_category'),<?php echo $category_id;?>,'', function(id){
			$('#category').val(id);
			category_id = $('.category_select:last').val();
			if (id == -1) {
				window.location.href = "?title=" + $("#title").attr('value') + "&dept=" + $("#dept").attr('value') + "&category=&adopt=" + $("#adopt").attr('value');
			}
			if (category_id != -1) {
				window.location.href = "?title=" + $("#title").attr('value') + "&dept=" + $("#dept").attr('value') + "&category=" + $("#category").attr('value') + "&adopt=" + $("#adopt").attr('value');
			}
		})
	});
</script>

