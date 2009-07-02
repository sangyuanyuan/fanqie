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
		js_include_tag('vote_list');
	?>
</head>
<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="7">　<a style="margin-right:50px" href="vote_add.php">添加投票</a>搜索&nbsp;<input type="text"></td>
		</tr>
		<tr class="tr2">
			<td width="200">投票名称</td><td width="80">登录限制</td><td width="80">票数限制</td><td width="80">投票类型</td><td width="150">发布时间</td><td width="150">到期时间</td><td width="175">操作</td>
		</tr>
		<?php
			$vote = new table_class("smg_vote");
			$record = $vote->find("all",array('conditions' => 'is_sub_vote=0','order' => 'created_at desc'));
			$count_record = count($record);
			//--------------------
			for($i=0;$i<$count_record;$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->name;?></td>
					<td><?php echo $record[$i]->limit_type;?></td>
					<td><?php echo $record[$i]->max_vote_count;?></td>
					<td><?php echo $record[$i]->vote_type;?></td>
					<td><?php echo $record[$i]->created_at;?></td>
					<td><?php echo $record[$i]->ended_at;?></td>
					<td><a href="vote_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a><a class="del" name="<?php echo $record[$i]->id;?>" style="color:#ff0000; cursor:pointer;margin-left:10px;">删除</a></td>
				</tr>
		<?php
			}
			//--------------------
		?>
	</table>
</body>
</html>
