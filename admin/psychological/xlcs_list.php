<?php
	require_once('../../frame.php');
	$key = $_REQUEST['key'];
	$project_id=$_REQUEST['id'];
	if($project_id!=''){
		if($key!=''){
			$question = new table_class('smg_xlcs');
			$records = $question->paginate('all',array('conditions' => 'project_id='.$project_id.' and title  like "%'.trim($key).'%"','order' => 'priority asc,created_at desc'),18); 
		}else{
			$question = new table_class('smg_xlcs');
			$records = $question->paginate('all',array('conditions' => 'project_id='.$project_id,'order' => 'priority asc,created_at desc'),18); 
		}
		$project = new table_class('smg_xlcs_subject');
		$project->find($project_id);
		$project_name = $project->title;
	}else{
		if($key!=''){
			$question = new table_class('smg_xlcs');
			$records = $question->paginate('all',array('conditions' => 'title  like "%'.trim($key).'%" and project_id='.$project_id,18)); 
		}
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
		js_include_once_tag('admin_pub');
	?>
</head>
<body style="background:#E1F0F7">
	<table width="795" border="0">
		<tr class="tr1">
			<td colspan="4" width="795">　　　<a href="xlcs_add.php" style="color:#0000FF">发布心理测试题</a>
				<span style="margin-left:50px; font-size:13px"><input id="search_text2" type="text"></span>
			<input type="button" value="搜索题目" id="question_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<?php if($project_name!=''){
		?>
		<tr class="tr1">
			<td colspan="4" align="center">所属项目：<?php echo $project_name;?></td>
		</tr>
		<?php 
		} ?>
		<tr class="tr2" style="font-weight:bold; font-size:13px;">
			<td width="500">问题名称</td><td width="180">创建时间</td><td width="200">操作</td>
		</tr>
		<?php for($i=0;$i<$count;$i++){?>
		<tr class="tr3" id="<?php echo $records[$i]->id;?>">
			<td><?php echo $records[$i]->title;?></td>
			<td><?php echo substr($records[$i]->created_at,0,10);?></td>
			<td><? if($records[$i]->is_adopt=="1"){?><span class="xlcscan" style="color:#FF0000;cursor:pointer">撤消</span><input type="hidden" value="<?php echo $records[$i]->id;?>"><? }?>
				<? if($records[$i]->is_adopt=="0"){?><span class="xlcspub" style="color:#0000FF;cursor:pointer">发布</span><input type="hidden" value="<?php echo $records[$i]->id;?>"><? }?>
				 <a href="xlcs_edit.php?id=<? echo $records[$i]->id;?>" style="color:#000000; text-decoration:none">编辑</a> 
				 <span style="cursor:pointer" class="xlcsdel">删除</span><input type="hidden" value="<?php echo $records[$i]->id;?>">
				<input type="text" class="priority"  name="<?php echo $records[$i]->id;?>"  value="<?php if('100'!=$records[$i]->priority){echo $records[$i]->priority;};?>" style="width:40px;">
			</td>
		</tr>
		<?  }?>
		<tr class="tr3">
			<td colspan=6><?php paginate();?><button id=clear_priority>清空优先级</button><button id=edit_priority>编辑优先级</button></td>
		</tr>
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
				$.post("xlcs.post.php",{'del_id':$(this).attr('name'),'post_type':'del'},function(data){
					$("#"+data).remove();
				});
			}
	});
	
	$("#question_search").click(function(){
				window.location.href="xlcs_list.php?<?php if($project_id!='')echo 'id='.$project_id.'&';?>key="+$("#search_text2").attr('value');
	});
	
	$('#search_text2').keydown(function(e){
		if(e.keyCode == 13){
			window.location.href="xlcs_list.php?<?php if($project_id!='')echo 'id='.$project_id.'&';?>key="+$("#search_text2").attr('value');
		}
	});
	$(".xlcscan").click(function(){
			$.post('xlcscz.post.php',{'id':$(this).next().attr('value'),'type':'xlcscan'},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		});
		$(".xlcspub").click(function(){
			$.post('xlcscz.post.php',{
				'id': $(this).next().attr('value'),
				'type': 'xlcspub'
			},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		});
		$(".xlcsdel").click(function(){
			if(!window.confirm("确定要删除吗")){return false;};
			$.post('xlcscz.post.php',{'id':$(this).next().attr('value'),'type':'xlcsdel'},function(data){
				 if(data=="OK")
				  location.reload();
				}
			)
		});
</script>