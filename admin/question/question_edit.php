<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$question = new table_class('smg_question');
	$question->find($id);
	$problem_id = $question->problem_id;
	$problem = new table_class('smg_problem');
	$problem->find($problem_id);
	$project_type = $problem->type;
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
			<td align="left"><?php show_fckeditor('title','Title',true,"80",$question->title);?><?php if($project_type!='judge'){?></>请在正确的选项后面打勾<?php }?></td>
		</tr>
		<?php if($project_type=='judge'){?>
		<tr class="tr3">
			<td>是非题选择</td>
			<td align="left">
				　<select name="item[attribute]">
					<option value="1" <?php if($records[0]->attribute=='1'){?>selected="selected"<?php }?> >对</option>
					<option value="0" <?php if($records[0]->attribute=='0'){?>selected="selected"<?php }?> >错</option> 
				</select>
			</td>
		</tr>
		<tr class="tr3">
			<td>说明(选填)</td>
			<td align="left">　<input type="text" name="item[name]" value="<?php echo $records[0]->name;?>">正确的说法是
			</td>
		</tr>
		<input type="hidden" name="item_num" value="1">
		<?php 
			}else{	
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
		<?php
			}
		?>
		<tr class="tr3">
			<td colspan="2" width="795" align="center"><button type="submit" id="submit">发布题目</button></td>
		</tr>	
		<input type="hidden" name="question_id" value="<?php echo $id;?>">
	</table>
	</form>
</body>
</html>

<script>
	$(function(){
		var num = $("#num").attr('value');
		
		$("#add_item").click(function(){
			num++;
			$(this).parent().parent().next().after('<tr class="tr3" ><td>答案选项</td><td align="left">　<input type="text" name="item'+num+'[name]" class="required"><input type="checkbox" class="check" name="check'+num+'"><a class="del_item" id='+num+' style="cursor:pointer;">删除</a></td></tr>');
			$("#num").attr('value',num);
			$(".del_item").click(function(){
				$(this).parent().parent().remove();
				num--;
				$("#num").attr('value',num);
			});
		});
		
		$("#submit").click(function(){
			var oEditor = FCKeditorAPI.GetInstance('title') ;
			var title = oEditor.GetHTML();
			if(title==""){
				alert("请输入标题！");
				return false;
			}
		});
		
		$(".del_item").click(function(){
			$.post("question.post.php",{'del_id':$(this).attr('name'),'post_type':'del_item'})
			$(this).parent().parent().remove();
			num--;
			$("#num").attr('value',num);
		});
	});	
</script>