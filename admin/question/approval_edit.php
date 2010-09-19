<?php
	require_once('../../frame.php');
	judge_role('admin');
	$id = $_REQUEST['id'];
	$question = new table_class('smg_question');
	$question->find($id);
	$question_item = new table_class('smg_question_item');
	$records = $question_item->find('all',array('conditions' => 'question_id='.$id));
	$count = count($records);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php
		css_include_tag('admin');
		use_jquery();
		validate_form("question_add");
	?>
</head>
<body style="background:#E1F0F7">
	<form id="question_add"  action="question.post.php" method="post"> 
	<table width="795" border="0" style="font-size:12px;">
		<tr class="tr2">
			<td colspan="2" width="795">　　编辑题目</td>
		</tr>
		<tr class="tr3">
			<td width="100">题　目</td>
			<td align="left"><input type="text" name="question[title]" value="<?php echo $question->title;?>" class="required"></td>
		</tr>
		<tr class="tr3">
			<td width="100">昵　称</td>
			<td align="left"><input type="text" name="question[nick_name]" value="<?php echo $question->nick_name;?>" class="required"></td>
		</tr>
		<tr class="tr3">
			<td width="100">答题说明</td>
			<td align="left"><textarea cols="80" rows="4" name="question[description]"><?php echo $question->description; ?></textarea></td>
		</tr>
		<?php
				for($i=1;$i<=2;$i++){
		?>
		<tr class="tr3" >
			<td>答案选项</td>
			<td align="left">
			<input type="text" name="item<?php echo $i;?>[name]" value="<?php echo $records[$i-1]->name;?>" class="required"><input class="check" type="checkbox" <?php if($records[$i-1]->attribute=='1'){?>checked="checked"<?php }?> name="check<?php echo $i;?>">
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
			<input type="text" name="item<?php echo $i;?>[name]" value="<?php echo $records[$i-1]->name;?>" class="required"><input class="check" type="checkbox" <?php if($records[$i-1]->attribute=='1'){?>checked="checked"<?php }?> name="check<?php echo $i;?>">
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
		<input type="hidden" name="question_id" value="<?php echo $id;?>">
		<input type="hidden" name="url" value="approval.php">
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
			$(this).parent().parent().next().after('<tr class="tr3" ><td>答案选项</td><td align="left"><input type="text" name="item'+num+'[name]" class="required"><input type="checkbox" class="check" name="check'+num+'"><a class="del_item" id='+num+' style="cursor:pointer;">删除</a></td></tr>');
			$("#num").attr('value',num);
			$(".del_item").click(function(){
				$(this).parent().parent().remove();
				num--;
				$("#num").attr('value',num);
			});
		});
		
		$("#submit").click(function(){
			$("input[type=checkbox]").each(function(){
				if($(this).attr('checked'))flag=$(this).attr('checked');
			});
			
			if(!flag){
				alert('请至少选择一个正确答案！');
				return false;
			}
			$("#question_add").submit();
		});
		
		$(".del_item").click(function(){
			$.post("question.post.php",{'del_id':$(this).attr('name'),'post_type':'del_item'})
			$(this).parent().parent().remove();
			num--;
			$("#num").attr('value',num);
		});
	});	
</script>