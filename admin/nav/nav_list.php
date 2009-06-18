<?php
	require_once('../../frame.php');
	$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '0';
	switch($type)
	{
		case "0":  $title="综合"; break;
		case "1":  $title="新闻"; break;
		case "2":  $title="交流"; break;
		case "3":  $title="展示"; break;
		case "4":  $title="服务"; break;
		default:  $title="综合"; break;
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
		js_include_tag('nav_list');
	?>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="3">　<?php echo $title;?>导航管理</td>
		</tr>
		<tr class="tr2">
			<td width="250">导航名称</td><td width="300">链接</td><td width="245">修改</td>
		</tr>
		<?php
			$menu = new table_class(smg_nav);
			$record = $menu->find("all",array('conditions' => 'id>'.$type.'*8 and id<='.$type.'*8+8','order' => 'id'));
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><input type="text" value="<?php echo $record[$i]->name;?>"></td>
					<td><input type="text" value="<?php echo $record[$i]->href;?>"></td>
					<td><a class="edit" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">修改</a></td>
				</tr>
		<?php
			}
			//--------------------
		?>
	</table>
</body>
</html>

