<?php
	require_once('../../frame.php');
	$user = judge_role('dept_admin');
	$dept_id = $user->dept_id;
	
	$title = $_REQUEST['title'];
	$category_id = $_REQUEST['category'] ? $_REQUEST['category'] : -1;
	$is_adopt = $_REQUEST['adopt'];
	$db = get_db();
	$sql = 'select * from smg_dept';
	$rows_dept = $db->query($sql);
	$c = array();
	if($title!= ''){
		array_push($c, "title like '%".trim($title)."%' or keywords like '%".trim($title)."%' or description like '%".trim($title)."%'");
	}
	if($category_id > 0){
		array_push($c, "dept_category_id=$category_id");
	}
	if($is_recommend!=''){
		array_push($c, "is_recommend=$is_recommend");
	}
	if($is_adopt!=''){
		array_push($c, "is_dept_adopt=$is_adopt");
	}
	array_push($c, "dept_id=$dept_id");
	$image = new smg_images_class();
	$images = $image->paginate('all',array('conditions' => implode(' and ', $c),'order' => 'dept_priority asc,created_at desc'),12);
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
		$category = new smg_category_class('picture',$dept_id);
		$category->echo_jsdata();		
	?>
</head>
<body>
	<table width="795" border="0">
		<tr class=tr1>
			<td colspan="5" width="795">　<a href="picture_add.php?dept_id=<?php echo $dept_id;?>" style="color:#0000FF">发布图片</a> 　　　
			搜索　<input id=title type="text" value="<? echo $_REQUEST['title']?>"><select id=recommend style="width:100px" class="select_new">
				<option value="">推荐状态</option>
				<option value="1" <? if($_REQUEST['recommend']=="1"){?>selected="selected"<? }?>>已推荐</option>
				<option value="0" <? if($_REQUEST['recommend']=="0"){?>selected="selected"<? }?>>未推荐</option>
				<option value="2" <? if($_REQUEST['recommend']=="2"){?>selected="selected"<? }?>>被退回</option>
			</select><span id="span_category"></span><select id=adopt style="width:90px" class="select_new">
				<option value="">发布状况</option>
				<option value="1" <? if($_REQUEST['adopt']=="1"){?>selected="selected"<? }?>>已发布</option>
				<option value="0" <? if($_REQUEST['adopt']=="0"){?>selected="selected"<? }?>>未发布</option>
			</select>
			<input type="button" value="搜索" id="search_new" style="border:1px solid #0000ff; height:21px">
			<input type="hidden" value="<?php echo $category_id;?>" id="category">
			</td>
		</tr>
	</table>
	<div class="div_box">
		<?php for($i=0;$i<count($images);$i++){?>
		<div class=v_box id="<?php echo $images[$i]->id;?>">
			<a href="/show/show.php?id=<?php echo $images[$i]->id;?>" target="_blank"><img src="<?php echo $images[$i]->src_path('small');?>" width="170" height="70" border="0"></a>
			<div class=content><a href="/show/show.php?id=<?php echo $images[$i]->id;?>" target="_blank" style="color:#000000; text-decoration:none"><?php echo $images[$i]->title;?></a></div>
			<div class=content>
				<?php if($images[$i]->is_recommend=='0'){echo '未推荐';}elseif($images[$i]->is_recommend=='1'){echo '已推荐';}elseif($images[$i]->is_recommend=='2'){echo '被退回';}?>
			</div>
			<div class=content><a href="?category=<?php echo $images[$i]->dept_category_id;?>" style="color:#0000FF"><?php echo $category->find($images[$i]->dept_category_id)->name; ?></a></a></div>
			<div class=content>
				<?php echo $images[$i]->created_at; ?>
			</div>
			<div class=content style="height:20px">
				<?php if($images[$i]->is_dept_adopt=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $images[$i]->id;?>">撤消</span><? }?>
				<?php if($images[$i]->is_dept_adopt=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $images[$i]->id;?>">发布</span><? }?>
				<a href="picture_edit.php?id=<?php echo $images[$i]->id;?>&dept_id=<?php echo $dept_id;?>" style="color:#000000; text-decoration:none">编辑</a> 
				<?php if($images[$i]->is_recommend=='1'){?><span style="color:#333333">删除</span><?}else{?><span style="cursor:pointer; color:#FF0000"" class="del" name="<?php echo $images[$i]->id;?>">删除</span><?php }?>
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

<script>
	$(function(){
		category.display_select('category_select',$('#span_category'),<?php echo $category_id;?>,'',function(id){
			$('#category').val(id);
			category_id = $('.category_select:last').val();
			if(id==-1){
				window.location.href="?title="+$("#title").attr('value')+"&recommend="+$("#recommend").attr('value')+"&category=&adopt="+$("#adopt").attr('value');
			}
			if(category_id != -1){
				window.location.href="?title="+$("#title").attr('value')+"&recommend="+$("#recommend").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
			}
		
		});
		
		
	});
</script>


