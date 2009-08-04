<?php
	#var_dump($_REQUEST);
	require_once('../../frame.php');
	$user = judge_role('admin');	
	
	$title = $_REQUEST['title'];
	$is_adopt = $_REQUEST['adopt'];
	$category_id = $_REQUEST['category'];
	
	$sql = 'select * from smg_category where category_type="zongcai" and description="image"';
	$db = get_db();
	$category = $db->query($sql);
	$sql = 'select t1.* from smg_images t1 join smg_category t2 on t1.category_id=t2.id where t2.category_type="zongcai" and t2.description="image"';
	
	
	if($is_adopt!=''){
		$sql = $sql.' and t1.is_adopt='.$is_adopt;
	}
	if($category_id!=''){
		$sql = $sql.' and t1.category_id='.$category_id;
	}
	if($title!=''){
		$sql = $sql.' and (t1.title like "%'.trim($title).'%" or t1.keywords like "%'.trim($title).'%" or t1.description like "%'.trim($title).'%")';
	}
	$sql = $sql.' order by priority,created_at desc';
	$images = $db->query($sql);
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
			<td colspan="5" width="795">　<a href="picture_add.php" style="color:#0000FF">发布图片</a> 　　　
			搜索　<input id=zc_title type="text" value="<? echo $_REQUEST['title']?>"><select id=category style="width:100px" class="zongcai_search">
					<option value="">所属类别</option>
					<?php for($i=0;$i<count($category);$i++){?>
					<option value="<?php echo $category[$i]->id; ?>" <?php if($category[$i]->id==$_REQUEST['category']){?>selected="selected"<? }?>><?php echo $category[$i]->name;?></option>
					<? }?>
				</select><select id=adopt style="width:100px" class="zongcai_search">
					<option value="">发布状况</option>
					<option value="1" <? if($_REQUEST['adopt']=="1"){?>selected="selected"<? }?>>已发布</option>
					<option value="0" <? if($_REQUEST['adopt']=="0"){?>selected="selected"<? }?>>未发布</option>
				</select>
				<input type="button" value="搜索" id="zc_zongcai" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
	</table>
	<div class="div_box">
		<?php for($i=0;$i<count($images);$i++){?>
		<div class=v_box id="<?php echo $images[$i]->id;?>">
			<a href="/show/show.php?id=<?php echo $images[$i]->id; ?>" target="_blank"><img src="<?php echo $images[$i]->src;?>" width="170" height="70" border="0"></a>
			<div class=content><a href="/show/show.php?id=<?php echo $images[$i]->id; ?>" target="_blank" style="color:#000000; text-decoration:none"><?php echo $images[$i]->title;?></a></div>
			<div class=content>
				<a href="?category=<?php echo $images[$i]->category_id;?>" style="color:#0000FF">
					<a href="?category=<?php echo $images[$i]->category_id;?>" style="color:#0000FF"><?php echo category_name_by_id($images[$i]->category_id); ?></a>
				</a>
			</div>
			<div class=content style="height:20px">
				<?php if($images[$i]->is_adopt=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $images[$i]->id;?>">撤消</span><? }?>
				<?php if($images[$i]->is_adopt=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $images[$i]->id;?>">发布</span><? }?>
				<a href="picture_edit.php?id=<?php echo $images[$i]->id;?>" style="color:#000000; text-decoration:none">编辑</a> 
				<span style="cursor:pointer; color:#FF0000;" class="del" name="<?php echo $images[$i]->id;?>">删除</span>
				<a href="/admin/comment/comment.php?id=<?php echo $images[$i]->id;?>&type=picture" style="color:#000000; text-decoration:none">评论</a>
				<input type="text" class="priority" name="<?php echo $images[$i]->id;?>" value="<?php if($images[$i]->priority!=100){echo $images[$i]->priority;}?>" style="width:40px;">
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
	<input type="hidden" id="db_talbe" value="smg_images">
</body>
</html>

<script>
	$("#zc_zongcai").click(function(){
			window.location.href="?title="+$("#zc_title").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
	});
	
	$(".zongcai_search").change(function(){
		window.location.href="?title="+$("#zc_title").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
	});
	$('#zc_title').keydown(function(e){
			if(e.keyCode == 13){
				window.location.href="?title="+$("#zc_title").attr('value')+"&category="+$("#category").attr('value')+"&adopt="+$("#adopt").attr('value');
			}
	});
</script>

