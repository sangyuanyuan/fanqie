<?php
	require_once('../../frame.php');
	judge_role('admin');
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
			<td colspan="6">　<a href="ratings_add.php">添加项目</a></td>
		</tr>
		<tr class="tr2">
			<td>项目名称</td><td>操作</td>
		</tr>
		<?php
			$db = get_db();
			$record = $db->paginate('select * from smg_report_item',20);
			$count_record = count($record);
			for($i=0;$i<$count_record;$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->name;?></td>
					<td><a href="value_list.php?item_id=<?php echo $record[$i]->id;?>">查询值</a>　<a href="upload2.php?item_id=<?php echo $record[$i]->id;?>">上传值</a>　<a href="upload.php?item_id=<?php echo $record[$i]->id;?>">上传收视率</a>　<a href="ratings_edit.php?id=<?php echo $record[$i]->id;?>" target="admin_iframe">编辑</a>　<a class="del" name="<?php echo $record[$i]->id;?>" style="color:#ff0000; cursor:pointer">删除</a>　<a href="show.php?item_id=<?php echo $record[$i]->id;?>">查看</a></td>
				</tr>
		<?php
			}
		?>
	</table>
	<input type="hidden" id="db_talbe" value="smg_report_item">
	<table width="795" border="0">
		<tr colspan="5" class=tr3>
			<td><?php paginate();?> </td>
		</tr>
	</table>
</body>
</html>
