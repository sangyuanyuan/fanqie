<?php
	require_once('../../frame.php');
	$user = judge_role('dept_admin');
	$dept_id = $user->dept_id;
	
	$db = get_db();
	$sql = 'select t1.*,t2.name as category_name from smg_link t1,smg_category_dept t2 where t1.category_id=t2.id and t1.dept_id='.$dept_id.' order by priority';
	$records = $db->paginate($sql,18);
	$count = count($records);
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
			<td colspan="6">　<a href="link_add.php?">添加链接</a></td>
		</tr>
		<tr class="tr2">
			<td width="200">链接名称</td><td width="50">优先级</td><td width="285">链接</td><td width="100">跳转方式</td><td width="100">所属类别</td><td width="175">操作</td>
		</tr>
		<?php
			for($i=0;$i<$count;$i++){
		?>
				<tr class=tr3 id="<?php echo $records[$i]->id;?>" >
					<td><?php echo $records[$i]->name;?></td>
					<td><input type="text" class="priority" name="<?php echo $records[$i]->id;?>" value="<?php if($records[$i]->priority!=100){echo $records[$i]->priority;}?>" style="width:30px;"></td>
					<td><?php echo $records[$i]->link;?></td>
					<td><?php if($records[$i]->target==_self){echo '自身';}elseif($records[$i]->target==_blank){echo '新开';}?></td>
					<td><?php echo $records[$i]->category_name;?></td>
					<td><a href="link_edit.php?id=<?php echo $records[$i]->id;?>">编辑</a>　<a class="del" name="<?php echo $records[$i]->id;?>" style="color:#ff0000; cursor:pointer">删除</a></td>
				</tr>
		<?php }?>
		<input type="hidden" id="db_talbe" value="smg_link">
	</table>
	<table width="795" border="0">
		<tr colspan="5" class=tr3>
			<td><?php paginate();?> <button id="edit_priority">编辑优先级</button> <button id="clear_priority">清空优先级</button></td>
		</tr>
	</table>
</body>
</html>

