<?php
	require_once('../../frame.php');	
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
			<td colspan="5">　<a href="news_add.php">添加新闻</a></td>
		</tr>
		<tr class="tr2">
			<td width="300">标题</td><td width="100">新闻类型</td><td width="100">所属类别</td><td width="100">所属部门</td><td width="250">操作</td>
		</tr>
		<?php
			$db = get_db();
			$sql="select t1.*,t2.name as category_name,t3.name as dept_name from smg_news t1,smg_category t2,smg_dept t3 where t1.category_id=t2.id and t1.dept_id=t3.id order by priority,created_at desc";
			$record=$db->paginate($sql,20);
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->title;?></td>
					<td><?php if($record[$i]->news_type==1){echo '普通新闻';}elseif($record[$i]->news_type==2){echo '文件新闻';}else{echo '链接新闻';}?></td>
					<td><?php echo $record[$i]->category_name;?></td>
					<td><?php echo $record[$i]->dept_name;?></td>
					<td><?php if($record[$i]->is_adopt=="1"){?>
							<span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span>　
						<?php }?>
						<?php if($record[$i]->is_adopt=="0"){?>
							<span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span>　
						<?php }?>
						<a href="news_edit.php?id=<?php echo $record[$i]->id;?>" class="edit" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">编辑</a>　
						<a href="/admin/comment/comment.php?id=<?php echo $record[$i]->id;?>&type=news" style="color:#000000; text-decoration:none">评论</a>　
						<a class="del" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">删除</a>　
						<input type="text" class="priority"  name="<?php echo $record[$i]->id;?>"  value="<?php if('100'!=$record[$i]->priority){echo $record[$i]->priority;};?>" style="width:40px;">
					</td>
				</tr>
		<?php
			}
			//--------------------
		?>
		<tr class="tr3">
			<td colspan=5><?php paginate();?>　<button id=clear_priority>清空优先级</button>　<button id=edit_priority>编辑优先级</button></td>
		</tr>
		<input type="hidden" id="db_talbe" value="smg_news">

	</table>
</body>
</html>

