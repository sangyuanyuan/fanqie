<?php
	#var_dump($_REQUEST);
	require_once('../../frame.php');
	$user = judge_role('admin');	
	
	$title = $_REQUEST['title'];
	$is_adopt = $_REQUEST['adopt'];
	$category_id = $_REQUEST['$category'];
	
	$db = get_db();
	$sql = 'select t1.* from smg_news t1 join smg_category t2 on t1.category_id=t2.id where t2.category_type="zongcai"';
	
	
	if($is_adopt!=''){
		$sql = $sql.' and t1.is_adopt='.$is_adopt;
	}
	if($category_id!=''){
		$sql = $sql.' and t1.category_id='.$category_id;
	}
	if($title){
		$sql = $sql.' and t1.title like '%".trim($title)."%' or short_title like '%".trim($title)."%' or keywords like '%".trim($title)."%' or description like '%".trim($title)."%'"';
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
				搜索　<input id=title type="text" value="<? echo $_REQUEST['title']?>">
				<select id=dept style="width:100px" class="select_new">
					<option value="">所属类别</option>
					<?php for($i=0;$i<count($rows_dept);$i++){?>
					<option value="<?php echo $rows_dept[$i]->id; ?>" <?php if($rows_dept[$i]->id==$_REQUEST['dept']){?>selected="selected"<? }?>><?php echo $rows_dept[$i]->name;?></option>
					<? }?>
				</select>
				<select id=adopt style="width:100px" class="select_new">
					<option value="">发布状况</option>
					<option value="1" <? if($_REQUEST['adopt']=="1"){?>selected="selected"<? }?>>已发布</option>
					<option value="0" <? if($_REQUEST['adopt']=="0"){?>selected="selected"<? }?>>未发布</option>
				</select>
				<input type="button" value="搜索" id="search_new" style="border:1px solid #0000ff; height:21px">
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
						<a href="?dept=<?php echo $record[$i]->dept_id;?>" style="color:#0000FF"><?php echo get_dept_info($record[$i]->dept_id)->name;?></a>
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
						<a href="news_edit.php?id=<?php echo $record[$i]->id;?>" class="edit" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">编辑</a>
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
			<td colspan=6><button id="select_all">全选</button> <button id="button_delete">删除/退回</button> <?php paginate();?>　<button id=clear_priority>清空优先级</button>　<button id=edit_priority>编辑优先级</button></td>
		</tr>
		<input type="hidden" id="db_talbe" value="smg_news">

	</table>
</body>
</html>

<script>
	$("#search").click(function(){
			window.location.href="?title="+$("#title").attr('value')+"&dept="+$("#dept").attr('value')+"&adopt="+$("#adopt").attr('value');
	});
	
	$(".select").change(function(){
		window.location.href="?title="+$("#title").attr('value')+"&dept="+$("#dept").attr('value')+"&adopt="+$("#adopt").attr('value');
	});
	$('#title').keydown(function(e){
			if(e.keyCode == 13){
				window.location.href="?title="+$("#title").attr('value')+"&dept="+$("#dept").attr('value')+"&adopt="+$("#adopt").attr('value');
			}
	});
	$(function(){
		var all_selected = false;
		$('#select_all').click(function(){
			all_selected = !all_selected;
			$('input:checkbox').attr('checked',all_selected);
		});
		$('#button_delete').click(function(){
			if (confirm('确定删除/退回选中新闻?')) {
				$.post('delete_news.php', $('input:checkbox').serializeArray(), function(data){
					window.location.reload();
				});
			}
		});
	});
</script>
