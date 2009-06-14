<?php
	require_once('../frame.php');
	css_include_tag('admin');
	use_jquery();
	js_include_tag('menu_list');
	$db=get_db();
	$sql='select * from smg_admin_menu where parent_id=0';
	if($db->query($sql)){
		$record=$db->query($sql);
	}else{
		echo "select from smg_admin_menu found error<br>";
		echo $sql;
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
</head>
<body>
	
	<table width="795" border="0" id="list" style="font-size:14px;">
		<tr >
			<div style="padding-top:3px; padding-left:10px; "><a href="add_menu.php?id=0" style="font-weight:bold; font-size:15px; ">添加主目录</a></div>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td width="300">菜单名称</td><td width="60">优先级</td><td width="150">链接</td><td width="285">操作</td>
		</tr>
		<?php
			for($i=0;$i<count($record);$i++){
		?>
				<tr align="center" bgcolor="#f9f9f9" height="22px;" id=<?php echo $record[$i]->id;?> >
					<td><div style="margin-left:100px;float:left; display:inline;"><img onmouseover="this.style.cursor='hand'"  name="<?php echo $record[$i]->id;?>" src="/images/admin/plus.gif"></div><div style="padding-top:3px; float:left; display:inline; margin:0 auto"><?php echo $record[$i]->name;?></div></td>
					<td><?php echo $record[$i]->priority;?></td>
					<td><?php echo $record[$i]->href;?></td>
					<td><a href="add_menu.php?id=<?php echo $record[$i]->id;?>">添加子目录</a><a href="edit_menu.php?id=<?php echo $record[$i]->id;?>"  style="margin-left:30px;" target="admin_iframe">编辑</a><a  class="del" onmouseover="this.style.cursor='hand'" name="<?php echo $record[$i]->id;?>" style="margin-left:30px; color:red">删除</a></td>
				</tr>
		<?php
			$sql='select * from smg_admin_menu where parent_id>0 and parent_id="'.$record[$i]->id.'"';
			$record2=$db->query($sql);
			for($j=0;$j<count($record2);$j++){
		?>
				<tr align="center" bgcolor="#f9f9f9" height="22px;" style="display:none;" id=<?php echo $record2[$j]->id;?> name="<?php echo $record[$i]->id;?>">
					<td><div style="font-size:13px; color:blue"><li></li><?php echo $record2[$j]->name;?></li></div></td>
					<td><?php echo $record2[$j]->priority;?></td>
					<td><?php echo $record2[$j]->href;?></td>
					<td><div style="margin-left:70px;"><a href="edit_menu.php?id=<?php echo $record2[$j]->id;?>"  style="margin-left:30px;" target="admin_iframe">编辑</a><a  class="del" onmouseover="this.style.cursor='hand'" name="<?php echo $record2[$j]->id;?>" style="margin-left:30px; color:red;">删除</a></div></td>
				</tr>
		<?php
				}
			}
			close_db();
		?>
		
	</table>
</body>
</html>

