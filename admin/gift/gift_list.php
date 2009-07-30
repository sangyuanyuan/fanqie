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
		$category_id = $_REQUEST['category_id'];
		js_include_tag('admin_pub');
	?>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="8">　<a style="margin-right:50px" href="gift_edit.php?category_id=<?php echo $_REQUEST['category_id'];?>">添加礼物</a>			
			</td>
		</tr>
		<tr class="tr2">
			<td>礼物名称</td><td width="200">礼物图片</td><td width="120">操作</td>
		</tr>
		<?php
			$db = get_db();
			$sql = "select * from smg_gift where category_id=$category_id order by id desc";
			$record = $db->paginate($sql);
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3>
					<td><?php echo $record[$i]->name;?></td>
					<td><img width=50 heigth=50 src="<?php echo $record[$i]->img_src;?>" border=0></td>
					<td>
						<a href="gift_edit.php?gift_id=<?php echo $record[$i]->id;?>&category_id=<?php echo $record[$i]->category_id;?>">编辑</a>
						<a class="del" name="<?php echo $record[$i]->id;?>" style="color:#ff0000; cursor:pointer;">删除</a>
					</td>
				</tr>
		<?php
			}
			//--------------------
		?>
	</table>
	<div class="div_box">
		<table width="795" border="0">
			<tr colspan="5" class=tr3>
				<td><?php paginate();?></td>
			</tr>
		</table>
	</div>
	<input type="hidden" id="db_talbe" value="smg_gift">
	
</body>
</html>
