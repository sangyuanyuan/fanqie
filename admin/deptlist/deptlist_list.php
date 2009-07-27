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
			<td colspan="4">　<a href="deptlist_add.php">添加部门列表</a></td>
		</tr>
		<tr class="tr2">
			<td width="300">部门名称</td><td width="300">链接</td><td width="195">修改</td>
		</tr>
		<?php
			$db = get_db();
			$sql="select * from smg_dept_list order by priority,id asc";
			$record=$db->paginate($sql,20);
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->name;?></td>
					<td><?php echo $record[$i]->href;?></td>
					<td><a href="deptlist_edit.php?id=<?php echo $record[$i]->id;?>" class="edit" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">编辑</a>　<a class="del" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">删除</a>　<input type="text" class="priority"  name="<?php echo $record[$i]->id;?>"  value="<?php if("100"!=$record[$i]->priority){echo $record[$i]->priority;};?>" style="width:40px;"></td>
				</tr>
		<?php
			}
			//--------------------
		?>
		<tr class="tr3">
			<td colspan=4><?php paginate('deptlist_list.php?type=a&type2=3');?>　<button id=clear_priority>清空优先级</button>　<button id=edit_priority>编辑优先级</button></td>
		</tr>
		<input type="hidden" id="db_talbe" value="smg_dept_list">

	</table>
</body>
</html>

