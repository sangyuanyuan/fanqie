<?php
	#var_dump($_REQUEST);
	require_once('../../frame.php');
	$user = judge_role('admin');	
	
	$title = $_REQUEST['title'];
	$is_adopt = $_REQUEST['adopt'];
	$category_id = $_REQUEST['category'];
	
	$sql = 'select * from smg_category where category_type="zongcai" order by priority,last_edited_at desc';
	$db = get_db();
	$category = $db->query($sql);
	$sql = 'select t1.* from smg_news t1 join smg_category t2 on t1.category_id=t2.id where t2.category_type="zongcai" order by priority,last_edited_at desc';
	
	
	if($is_adopt!=''){
		$sql = $sql.' and t1.is_adopt='.$is_adopt;
	}
	if($category_id!=''){
		$sql = $sql.' and t1.category_id='.$category_id;
	}
	if($title!=''){
		$sql = $sql.' and (t1.title like "%'.trim($title).'%" or t1.short_title like "%'.trim($title).'%" or t1.keywords like "%'.trim($title).'%" or t1.description like "%'.trim($title).'%")';
	}
	$record = $db->query($sql);
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
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="6">
				　<a href="news_add.php" style="margin-right:80px">添加新闻</a>
				搜索　<input id=zc_title type="text" value="<? echo $_REQUEST['title']?>">
				<select id=category style="width:100px" class="zongcai_search">
					<option value="">所属类别</option>
					<?php for($i=0;$i<count($category);$i++){?>
					<option value="<?php echo $category[$i]->id; ?>" <?php if($category[$i]->id==$_REQUEST['category']){?>selected="selected"<? }?>><?php echo $category[$i]->name;?></option>
					<? }?>
				</select>
				<select id=adopt style="width:100px" class="zongcai_search">
					<option value="">发布状况</option>
					<option value="1" <? if($_REQUEST['adopt']=="1"){?>selected="selected"<? }?>>已发布</option>
					<option value="0" <? if($_REQUEST['adopt']=="0"){?>selected="selected"<? }?>>未发布</option>
				</select>
				<input type="button" value="搜索" id="zc_zongcai" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">

			<td width="55">删/退</td><td width="220">短标题</td><td width="100">所属类别</td><td width="120">发布时间</td><td width="200">操作</td>
		</tr>
		<?php
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<?php 
						$var_name = $record[$i]->dept_id != 7 ? "back_news[]" : "delete_news[]";
					?>
					<td><input style="width:12px;" type="checkbox" name="<?php echo $var_name;?>" value="<?php echo $record[$i]->id;?>"></td>
					<td><?php echo $record[$i]->short_title;?></td>
					<td>
						<a href="?category=<?php echo $record[$i]->category_id;?>" style="color:#0000FF"><?php echo category_name_by_id($record[$i]->category_id);?></a>
					</td>
					<td>
						<?php echo $record[$i]->created_at; ?>
					</td>								
					<td><?php if($record[$i]->is_adopt=="1"){?>
							<span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span>
						<?php }?>
						<?php if($record[$i]->is_adopt=="0"){?>
							<span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span>
						<?php }?>
						<a href="news_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
						<a href="/admin/comment/comment.php?id=<?php echo $record[$i]->id;?>&type=news" style="color:#000000; text-decoration:none">评论</a>
						<span style="cursor:pointer;color:#FF0000" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
						<input type="text" class="priority"  name="<?php echo $record[$i]->id;?>"  value="<?php if('100'!=$record[$i]->priority){echo $record[$i]->priority;};?>" style="width:40px;">
					</td>
				</tr>
		<?php
			}
			//--------------------
		?>
		<tr class="tr3">
			<td colspan=6> <?php paginate();?>　<button id=clear_priority>清空优先级</button>　<button id=edit_priority>编辑优先级</button></td>
		</tr>
		<input type="hidden" id="db_talbe" value="smg_news">

	</table>
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
