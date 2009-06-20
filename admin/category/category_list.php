<?php
	require_once('../../frame.php');
	$type = $_REQUEST['type'];
	switch($type){
		case "news":
	        $category_name = "新闻";
	        break;
	    case "picture":
	        $category_name = "图片";
	        break;
	    case "video":
	        $category_name = "视频";
			break;
		case "magazine":
			$category_name = "电子杂志";
			break;
		default:
			$category_name = "其他";
	}
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
			<td colspan="5">　<a href="category_add.php?id=0&type=<?php echo $type;?>">添加超类</a></td>
		</tr>
		<tr class="tr2">
			<td width="200">菜单名称</td><td width="50">优先级</td><td width="">父类</td><td width="180">所属类别</td><td width="175">操作</td>
		</tr>
		<?php
			$category = new table_class("smg_category");
			$record = $category->find("all",array('conditions' => 'category_type="'.$type.'" and parent_id>0','order' => 'priority desc'));
			$count_record = count($record);
			//--------------------
			for($i=0;$i<$count_record;$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->name;?></td>
					<td><input type="text" class="priority" name="<?php echo $record[$i]->id;?>" value="<?php if($record[$i]->priority!=100){echo $record[$i]->priority;}?>" style="width:30px;"></td>
					<td><?php for($j=0;$j<$count_record;$j++){if($record[$j]->id==$record[$i]->parent_id){echo $record[$j]->name;break;}}?></td>
					<td><?php echo $category_name;?></td>
					<td><a href="category_add.php?id=<?php echo $record[$i]->id;?>&type=<?php echo $type?>">添加子类别</a>　<a href="category_edit.php?id=<?php echo $record[$i]->id;?>" target="admin_iframe">编辑</a>　<a class="del" name="<?php echo $record[$i]->id;?>" style="color:#ff0000; cursor:pointer">删除</a></td>
				</tr>
		<?php
			}
			//--------------------
		?>
		<input type="hidden" id="db_talbe" value="smg_category">
	</table>
	<table width="795" border="0">
		<tr colspan="5" class=tr3>
			<td><?php paginate();?> <button id="edit_priority">编辑优先级</button> <button id="clear_priority">清空优先级</button></td>
		</tr>
	</table>
</body>
</html>

