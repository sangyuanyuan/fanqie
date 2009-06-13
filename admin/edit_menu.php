<?php
	require_once('../frame.php');
	css_include_tag('admin');
	use_jquery_ui();
	$db=get_db();
	$id=$_REQUEST['id'];
	$sql='select * from smg_admin_menu where id="'.$id.'"';
	if($db->query($sql)){
		$record=$db->query($sql);
	}else{
		echo "select from smg_admin_menu found error<br>";
		echo $sql;
	}
	
	if($record[0]->parent_id<>0){
		$sql='select * from smg_admin_menu where id="'.$record[0]->parent_id.'"';
		if($db->query($sql)){
			$parent=$db->query($sql);
			$parent_name=$parent[0]->name;
		}else{
			echo "select parent error<br>";
			echo $sql;
		}
	}else{
		$parent_name="";
	}
	close_db();
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
</head>
<body>
	<form id="menu_form" method="POST" action="menu.post.php">
	修改菜单<br>
	名称：<input type="text" name="menu_name" class="required" value="<?php echo $record[0]->name;?>"><br>
	链接：<input type="text" name="menu_href" value="<?php echo $record[0]->href;?>"><br>
	描述：<input type="text" name="menu_description" value="<?php echo $record[0]->description;?>"><br>
	优先级：<input type="text" name="menu_priority" value="<?php echo $record[0]->priority;?>"><br>
	主目录名称：<input type="text" name="menu_parent" value="<?php echo $parent_name;?>"><br>
	<input type="submit"  value="提 交">
	<input type="hidden"  name="type" value="edit_menu">
	<input type="hidden"  name="id" value="<?php echo $id;?>"> 
	</from>
</body>
</html>