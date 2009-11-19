<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$question = new table_class('smg_xlcs');
	$question->find($id);
	$project_id = $question->project_id;
	$problem = new table_class('smg_xlcs_subject');
	$problem->find($project_id);
	$project_type = $problem->type;
	$question_item = new table_class('smg_xlcs_item');
	$records = $question_item->find('all',array('conditions' => 'xlcs_id='.$id));
	$count = count($records);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php
		css_include_tag('admin','thickbox');
		use_jquery();
		validate_form("question_add");
		js_include_once_tag('total','thickbox','My97DatePicker/WdatePicker.js');
	?>
</head>
<body style="background:#E1F0F7">
	<form id="xlcs_add"  action="xlcs.post.php" method="post"> 
	<table width="795" border="0" style="font-size:12px;">
		<tr class="tr2">
			<td colspan="2" width="795">　　编辑题目</td>
		</tr>
		<tr class="tr3">
			<td width="100">题　目</td>
			<td align="left"><input type="text" name="xlcs[title]" value="<?php echo $question->title;?>" class="required"></td>
		</tr>
		<tr class="tr3">
			<td width="100">优先级</td>
			<td align="left"><input type="text" name="xlcs[priority]" value="<?php echo $question->priority; ?>"></td>
		</tr>
		<tr class="tr3">
			<td width="100">内　容</td>
			<td align="left"><?php show_fckeditor('xlcs[content]','Admin',true,"256",$question->content); ?></td>
		</tr>
		<input type="hidden" name="item_num" value="1">
		<?php 
				for($i=1;$i<=2;$i++){
		?>
		<tr class="tr3" >
			<td>答案选项</td>
			<td align="left">
			<input type="text" name="item<?php echo $i;?>[name]" value="<?php echo $records[$i-1]->name;?>" class="required"><div style="display:none;"><?php show_fckeditor('item'.$i.'[content]','Title',false,"160",$records[$i-1]->content,"300"); ?></div><a class="thickbox" title="测试结果" href="xlcs_result.php?height=270&width=350&id=<?php echo $i;?>">测试结果</a>　
			<input type="hidden" id="item<?php echo $i;?>child_id" name="item<?php echo $i;?>[child_id]" value="<?php echo $records[$i-1]->child_id; ?>"><span id="td_xlcs<?php echo $i;?>"><a id="child<?php echo $i;?>" class="thickbox" title="关联下一题" href="xlcs_child.php?height=500&width=600&id=<?php echo $i;?>">关联下一题</a></span>
			<input type="hidden" name="item<?php echo $i;?>_id" value="<?php echo $records[$i-1]->id;?>">
			<?php if($i==1){?>
			<button type="button"  id="add_item">继续添加</button>
			<?php }?>
		　	</td>
		</tr>
		<?php
				}
				if($count>2){for($i=3;$i<=$count;$i++){
		?>
		<tr class="tr3" >
			<td>答案选项</td>
			<td align="left">
			<input type="text" name="item<?php echo $i;?>[name]" value="<?php echo $records[$i-1]->name;?>" class="required"><div style="display:none;"><?php show_fckeditor('item'.$i.'[content]','Title',false,"160",$records[$i-1]->content,"300"); ?></div><a class="thickbox" title="测试结果" href="xlcs_result.php?height=270&width=350&id=<?php echo $i;?>">测试结果</a>　
			<input type="hidden" id="item<?php echo $i;?>[child_id]" name="item<?php echo $i;?>[child_id]" value="<?php echo $records[$i-1]->child_id; ?>"><span id="td_xlcs<?php echo $i;?>"><a id="child<?php echo $i;?>" class="thickbox" title="关联下一题" href="xlcs_child.php?height=500&width=600&id=<?php echo $i;?>">关联下一题</a></span>
			  <a class="del_item"  name="<?php echo $records[$i-1]->id;?>" style="cursor:pointer;">删除</a>
			 <input type="hidden" name="item<?php echo $i;?>_id" value="<?php echo $records[$i-1]->id;?>">
		　	</td>
		</tr>
		<?php 
				}}
		?>
		<input type="hidden" name="item_num" id="num" value="<?php echo $count;?>">
		<tr class="tr3">
			<td colspan="2" width="795" align="center"><button type="submit" id="submit">发布题目</button></td>
		</tr>	
		<input type="hidden" name="xlcs_id" value="<?php echo $id;?>">
	</table>
	</form>
</body>
</html>

<script>
	$(function(){
		var flag = false;
		var num = $("#num").attr('value');
		
		$("#add_item").click(function(){
			num++;
			$(this).parent().parent().next().after('<tr class="tr3" ><td>答案选项</td><td align="left"><input type="text" name="item'+num+'[name]" class="required"><div style="display:none;"><?php show_fckeditor("item'+num+'[content]","Title",false,"160","","300"); ?></div><a class="thickbox" id="csresult'+num+'" title="测试结果" href="xlcs_result.php?height=270&width=350&id='+num+'">测试结果</a>　<input type="hidden" id="item'+num+'child_id" name="item'+num+'[child_id]"><span id="td_xlcs'+num+'"><a class="thickbox" id="glnext'+num+'" title="关联下一题" href="xlcs_child.php?height=500&width=600&id='+num+'">关联下一题</a></span>　<a class="del_item" id='+num+' style="cursor:pointer;">删除</a></td></tr>');
			tb_init('#csresult'+num,'#glnext'+num);
			$("#num").attr('value',num);
			$(".del_item").click(function(){
				$(this).parent().parent().remove();
				num--;
				$("#num").attr('value',num);
			});
		});
		
		$("#submit").click(function(){
			$("#xlcs_add").submit();
		});
		
		$(".del_item").click(function(){
			$.post("xlcs.post.php",{'del_id':$(this).attr('name'),'post_type':'del_item'})
			$(this).parent().parent().remove();
			num--;
			$("#num").attr('value',num);
		});
	});	
</script>