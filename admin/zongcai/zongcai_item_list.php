<?php
	require_once('../../frame.php');
	$zongcai_item = new table_class('smg_zongcai_item');
	$record = $zongcai_item->paginate('all',array('order' => 'create_time desc'),18);
	$count = count($record);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php
		css_include_tag('admin');
		use_jquery();
		js_include_tag('admin_pub');
	?>
</head>
<body style="background:#E1F0F7">
	<table width="795" border="0">
		<tr class="tr1" >
			<td colspan="5" width="795">
				上传作品审批
			</td>
		</tr>
		<tr class="tr2">
			<td width="235">节目名称</td><td width="110">上传者</td><td width="110">节目类别</td><td width="130">发布时间</td><td width="110">操作</td>
		</tr>
		<? for($i=0;$i<$count;$i++)
		{?>
		<tr class="tr3" id="<?php echo $record[$i]->id;?>">
			<td><a href="/zongcai/show_item.php?id=<?php echo $record[$i]->id; ?>" target="_blank"><? echo $record[$i]->name;?></a></td>
			<td><? echo $record[$i]->uploader;?></td>
			<td><select name="program_type" class="select_type" title="<?php echo $record[$i]->id;?>">
					<option value="tv_recommend" <?php if($record[$i]->program_type=="tv_recommend"){?>selected="selected"<?php }?>>电视推荐节目投票</option>
					<option value="tv_self" <?php if($record[$i]->program_type=="tv_self"){?>selected="selected"<?php }?>>电视自荐节目投票</option>
					<option value="broadcast_recommend" <?php if($record[$i]->program_type=="broadcast_recommend"){?>selected="selected"<?php }?>>广播推荐节目投票</option>
					<option value="broadcast_self" <?php if($record[$i]->program_type=="broadcast_self"){?>selected="selected"<?php }?>>广播自荐节目投票</option>
				</select>
			</td>
			<td><? echo $record[$i]->create_time;?></td>
			<td><?php if($record[$i]->state=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span><? }?>
				<?php if($record[$i]->state=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span><? }?>
			 <span style="cursor:pointer" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
			 <a href="zongcai_item_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
			</td>
		</tr>
		<? } ?>
	</table>
	<table width="795" border="0">
		<tr colspan="5" class=tr3>
			<td><?php paginate();?></td>
		</tr>
	</table>
	<input type="hidden" id="db_talbe" value="smg_zongcai_item">
	
</body>
</html>

<script>
	$(".select_type").change(function(){
		$.post("zongcai_vote.post.php",{'type':'change_type','id':$(this).attr('title'),'value':$(this).attr('value')},function(data){
			//alert(data);
		});
	});
	
</script>