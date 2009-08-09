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
			<td colspan="8">　<a style="margin-right:50px" href="vote_add.php">添加投票</a>
			<span style="margin-left:100px; font-size:13px">搜索&nbsp;&nbsp;<input id="search_text" type="text" value="<? echo $key;?>"></span>
			<input type="button" value="搜索" id="vote_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td>投票名称</td><td width=120>可选几项</td><td width=120>发布时间</td><td width=120>操作</td>
		</tr>
		<?php
			$vote = new table_class("smg_vote");
			if($key!=''){
				$record = $vote->paginate("all",array('conditions' => 'category_id=0 and name like "%'.trim($key).'%"','order' => 'created_at desc'),18);
			}else{
				$record = $vote->paginate("all",array('conditions' => 'category_id=0','order' => 'created_at desc'),18);
			}
			$count_record = count($record);
			for($i=0;$i<$count_record;$i++){
			//--------------------
				
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<td><?php echo $record[$i]->name;?></td>
					<td><?php echo $record[$i]->max_item_count;?></td>
					<td><?php echo substr($record[$i]->created_at, 0, 10);?></td>
					<td>
						<?php if($record[$i]->is_adopt=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span><? }?>
						<?php if($record[$i]->is_adopt=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span><? }?>
						<a href="approval_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
						<a class="del" name="<?php echo $record[$i]->id;?>" style="color:#ff0000; cursor:pointer;">删除</a>
						<input type="text" class="priority"  name="<?php echo $record[$i]->id;?>"  value="<?php if('100'!=$record[$i]->priority){echo $record[$i]->priority;};?>" style="width:20px;">
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
				<td><?php paginate();?><button id=clear_priority>清空优先级</button>　<button id=edit_priority>编辑优先级</button></td>
			</tr>
		</table>
	</div>
	<input type="hidden" id="db_talbe" value="smg_vote">
</body>
</html>
