<?php
	require_once('../../frame.php');
	judge_role('admin');
	$item_id = $_REQUEST['item_id'];
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
		<tr class="tr2">
			<td>日期</td><td>文件名</td><td>下载</td>
		</tr>
		<?php
			$db = get_db();
			$record = $db->paginate('select * from smg_ratings where item_id='.$item_id.' order by id desc',20);
			$count_record = count($record);
			for($i=0;$i<$count_record;$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->date;?></td>
					<td><?php echo $record[$i]->file_path;?></td>
					<td><a href='<?php echo $record[$i]->file_path;?>'>下载</a>
						<a class="del" name="<?php echo $record[$i]->id;?>" style="color:#ff0000; cursor:pointer">删除</a>
					</td>
				</tr>
		<?php
			}
		?>
	</table>
	<input type="hidden" id="db_talbe" value="smg_ratings">
	<table width="795" border="0">
		<tr colspan="5" class=tr3>
			<td><?php paginate();?> </td>
		</tr>
	</table>
</body>
</html>
