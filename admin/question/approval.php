<?php
	require_once('../../frame.php');
	$key = $_REQUEST['key'];
	$project_id = 0;
	if($key!=''){
		$question = new table_class('smg_question');
		$records = $question->paginate('all',array('conditions' => 'problem_id='.$project_id.' and title  like "%'.trim($key).'%"','order','theme'),18); 
	}else{
		$question = new table_class('smg_question');
		$records = $question->paginate('all',array('conditions' => 'problem_id='.$project_id,'order','theme'),18); 
	}
	$count = count($records);
	

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
		<tr class="tr1">
			<td colspan="4" width="795">　　　
			搜索	<span style="margin-left:50px; font-size:13px"><input id="search_text" type="text"></span>
			<input type="button" value="搜索题目" id="question_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2" style="font-weight:bold; font-size:13px;">
			<td width="400">问题名称</td><td width="180">创建时间</td><td width="150">操作</td>
		</tr>
		<?php for($i=0;$i<$count;$i++){?>
		<tr class="tr3" id="<?php echo $records[$i]->id;?>">
			<td><a href='/answer/answer.php?id=<?php echo $records[$i]->id;?>' target="_blank"><?php echo $records[$i]->title;?></a></td>
			<td><?php echo substr($records[$i]->create_time,0,10);?></td>
			<td><?php if($records[$i]->is_adopt=="1"){?>
					<span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $records[$i]->id;?>">撤消</span>
				<?php }?>
				<?php if($records[$i]->is_adopt=="0"){?>
					<span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $records[$i]->id;?>">发布</span>
				<?php }?>
				<span style="cursor:pointer" class="del_question" name="<?php echo $records[$i]->id;?>">删除</span>
				<a href="approval_edit.php?id=<?php echo $records[$i]->id;?>">编辑</a>
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
	<input type="hidden" id="db_talbe" value="smg_question">
</body>
</html>
<script>
	$(".del_question").click(function(){
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
	
	$("#question_search").click(function(){
				window.location.href="?key="+$("#search_text").attr('value');
	});
	
	$('#search_text').keydown(function(e){
		if(e.keyCode == 13){
			window.location.href="?key="+$("#search_text").attr('value');
		}
	});
</script>