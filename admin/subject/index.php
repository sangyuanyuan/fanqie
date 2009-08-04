<?php
	require_once('../../frame.php');
	$key = $_REQUEST['key'];
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
		js_include_tag('vote_list','admin_pub');
	?>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="8">　<a style="margin-right:50px" href="subject_add.php">添加专题</a>
			<span style="margin-left:100px; font-size:13px">搜索&nbsp;&nbsp;<input id="search_text" type="text" value="<? echo $key;?>"></span>
			<input type="button" value="搜索" id="vote_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td>专题名称</td><td width="200">发布时间</td><td width="220">操作</td>
		</tr>
		<?php
			$db = get_db();
			$sql = "select * from smg_subject order by id desc";
			$record = $db->paginate($sql);
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->name;?></td>
					<td><?php echo $record[$i]->created_at;?></td>
					<td>
						<a href="subject_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
						<a href="subject_category.php?id=<?php echo $record[$i]->id;?>">分类管理</a>
						<a href="subject_content.php?subject_id=<?php echo $record[$i]->id;?>">内容管理</a>
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
	<input type="hidden" id="db_talbe" value="smg_subject">
</body>
</html>
