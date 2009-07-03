<?php
	require_once('../../frame.php');
	$project_id=$_REQUEST['id'];
	$project_name=$_REQUEST['name'];
	$question = new table_class('smg_question');
	$records = $question->paginate('all',array('conditions' => 'problem_id='.$project_id),18); 
	$count = count($records);
	$project = new table_class('smg_problem');
	$project->find($project_id);
	$project_name = $project->name;
	$project_type = $project->type;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php
		css_include_tag('admin');
		use_jquery();
	?>
</head>
<body style="background:#E1F0F7">
	<table width="795" border="0">
		<tr class="tr1">
			<td colspan="4" width="795">　　　<a href="question_add.php?id=<?php echo $project_id;?>&type=<?php echo $project_type;?>" style="color:#0000FF">发布问题</a>
				　　　　　　　　　所属项目：<?php echo $project_name;?>　　　　　　
			</td>
		</tr>
		<tr class="tr2" style="font-weight:bold; font-size:13px;">
			<td width="580">问题名称</td><td width="180">创建时间</td><td width="150">操作</td>
		</tr>
		<?php for($i=0;$i<$count;$i++){?>
		<tr class="tr3" id="<?php echo $records[$i]->id;?>">
			<td><?php echo $records[$i]->title;?></td>
			<td><?php echo substr($records[$i]->create_time,0,10);?></td>
			<td><span style="cursor:pointer" class="del" name="<?php echo $records[$i]->id;?>">删除</span>
				<a href="question_edit.php?id=<?php echo $records[$i]->id;?>">编辑</a>
			</td>
		</tr>
		<?  }?>
	</table>
	<div class="div_box">
		<table width="795" border="0">
			<tr colspan="5" class=tr3>
				<td><?php paginate();?></td>
			</tr>
		</table>
	</div>
</body>
</html>
<script>
	$(".del").click(function(){
		if(!window.confirm("确定要删除吗"))
			{
				return false;
			}
			else
			{
				$.post("question.post.php",{'del_id':$(this).attr('name'),'post_type':'del'},function(data){
					$("#"+data).remove();
				});
			}
	});
</script>