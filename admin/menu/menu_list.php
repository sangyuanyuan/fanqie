<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
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
		js_include_tag('menu_list');
	?>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="5">　<a href="menu_add.php?id=0">添加超级管理员菜单主目录</a></td>
		</tr>
		<tr class="tr2">
			<td width="245">菜单名称</td><td width="60">优先级</td><td width="150">链接</td><td width="150">链接方式</td><td width="200">操作</td>
		</tr>
		<?php
			$menu = new table_class("smg_admin_menu");
			$record = $menu->find("all",array('conditions' => 'parent_id=0','order' => 'priority'));
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><img style="cursor:pointer" name="<?php echo $record[$i]->id;?>" src="/images/admin/plus.gif"><?php echo $record[$i]->name;?></td>
					<td><?php echo $record[$i]->priority;?></td>
					<td><?php echo $record[$i]->href;?></td>
					<td><?php echo $record[$i]->target;?></td>
					<td><a href="menu_add.php?id=<?php echo $record[$i]->id;?>">添加子目录</a>　<a href="edit_menu.php?id=<?php echo $record[$i]->id;?>" target="admin_iframe">编辑</a>　<a class="del" name="<?php echo $record[$i]->id;?>" style="color:#ff0000; cursor:pointer">删除</a></td>
				</tr>
		<?php
				$record2 = $menu->find("all",array('conditions' => 'parent_id>0 and parent_id='.$record[$i]->id));
				//----------
				for($j=0;$j<count($record2);$j++){
		?>
				<tr class=tr3 style="display:none;" id=<?php echo $record2[$j]->id;?> name="<?php echo $record[$i]->id;?>">
					<td><li style="color:#0000ff;"><?php echo $record2[$j]->name;?></li></td>
					<td><?php echo $record2[$j]->priority;?></td>
					<td><?php echo $record2[$j]->href;?></td>
					<td><?php echo $record2[$j]->target;?></td>
					<td><a href="edit_menu.php?id=<?php echo $record2[$j]->id;?>" target="admin_iframe">编辑</a>　<a class="del" name="<?php echo $record2[$j]->id;?>" style="color:#ff0000; cursor:pointer">删除</a></td>
				</tr>
		<?php
				}
				//----------
			}
			//--------------------
		?>
		<input type="hidden" id="reload_flag" value="<?php echo $id;?>">
	</table>
</body>
</html>

