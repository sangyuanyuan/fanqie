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
		js_include_tag('nav_list');
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
			$sql="select * from smg_dept_list order by priority asc";
			$dept_list=$db->paginate($sql,20);
			//--------------------
			for($i=0;$i<count($dept_list);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $dept_list[$i]->name;?></td>
					<td><?php echo $dept_list[$i]->href;?></td>
					<td><a class="edit" name="<?php echo $dept_list[$i]->id;?>" style="cursor:pointer">编辑</a>　<a class="edit" name="<?php echo $dept_list[$i]->id;?>" style="cursor:pointer">删除</a>　<input type="text" value="<?php echo $dept_list[$i]->priority;?>" style="width:40px;"></td>
				</tr>
		<?php
			}
			//--------------------
		?>
		<tr class="tr3">
			<td colspan=4><?php paginate('deptlist_list.php?type=a&type2=3');?>　<button>清空优先级</button>　<button>编辑优先级</button></td>
		</tr>
	</table>
</body>
</html>

