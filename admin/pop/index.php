<?php
	require_once('../../frame.php');
	$db=get_db();
	$record=$db->query('select t.*,h.user from smg_pop_task t left join smg_pop_history h on t.id=h.task_id order by created_at desc');
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
		js_include_tag('admin_pub',,'total');	
	?>
	<script>
			total("后台","other");
	</script>
</head>

<body>
	<table width="795" border="0" id="list">
		<tr class="tr2">

			<td width="55">删除</td><td width="220">发表人</td><td width="100">发表内容</td><td width="120">发布时间</td><td width="200">操作</td>
		</tr>
		<?php
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3>
					<td><input style="width:12px;" type="checkbox" name="delete_news[]" value="<?php echo $record[$i]->id;?>"></td>
					<td><?php echo $record[$i]->user; ?></td>
					<td>
						<?php echo $record[$i]->content; ?>
					</td>
					<td>
						<?php echo $record[$i]->created_at; ?>
					</td>								
					<td><?php if($record[$i]->is_adopt=="1"){?>
							<span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span>
						<?php }?>
						<?php if($record[$i]->is_adopt=="0"){?>
							<span style="color:#0000FF;cursor:pointer" class="publish" param="<?php echo $record[$i]->phone;?>" name="<?php echo $record[$i]->id;?>">发布</span>
						<?php }?>
						<a href="news_edit.php?id=<?php echo $record[$i]->id;?>" class="edit" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">编辑</a>
						<span style="cursor:pointer;color:#FF0000" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
					</td>
				</tr>
		<?php
			}
			//--------------------
		?>
		<iframe id="senddx" style="display:none;"></iframe>
		<tr class="tr3">
			<td colspan=6><button id="select_all">全选</button><button id="button_delete">删除</button></td>
		</tr>
		<input type="hidden" id="db_talbe" value="smg_pop_task">

	</table>
</body>
</html>

<script>
	
	$(function(){
		
		var all_selected = false;
		$('#select_all').click(function(){
			all_selected = !all_selected;
			$('input:checkbox').attr('checked',all_selected);
		});

		$('#button_delete').click(function(){
			if (confirm('确定删除选中的内容?')) {
				$.post('delete_news.php', $('input:checkbox').serializeArray(), function(data){
					window.location.reload();
				});
			}
		});
	});
</script>
