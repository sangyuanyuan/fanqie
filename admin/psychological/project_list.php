<?php
	require_once('../../frame.php');
	$project = new table_class('smg_xlcs_subject');
	$key = $_REQUEST['key'];
	if($key!=''){
		$record = $project->paginate('all',array('conditions' => 'title  like "%'.trim($key).'%"','order' => 'created_at desc'),18);
	}else{
		$record = $project->paginate('all',array('order'=> 'created_at desc'),18);
	}
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
		<tr class="tr1">
			<td colspan="5" width="795">　　　<a href="project_add.php" style="color:#0000FF">发布项目</a>
			<span style="margin-left:20px; font-size:13px"><input id="search_text1" type="text" value="<? echo $key;?>"></span>
			<input type="button" value="搜索项目" id="project_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td >项目名称</td><td>创建时间</td><td>操作</td>
		</tr>
		<? for($i=0;$i<$count;$i++){?>
		<tr class="tr3" id="<?php echo $record[$i]->id;?>">
			<td><a href="xlcs_list.php?id=<?php echo $record[$i]->id;?>"><?php echo $record[$i]->title;?></a></td>
			<td><? echo substr($record[$i]->created_at, 0, 10);?></td>
			<td><?php if($record[$i]->is_adopt=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤消</span><? }?>
				<?php if($record[$i]->is_adopt=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span><? }?>
				<span style="cursor:pointer" class="del_project" name="<?php echo $record[$i]->id;?>">删除</span>
				<a href="project_edit.php?id=<?php echo $record[$i]->id;?>">编辑</a>
				<a href="xlcs_add.php?id=<?php echo $record[$i]->id;?>" style="color:#000000; text-decoration:none">添加题目</a>
				<a href=/xlcs/xlcs.php?id=<?php echo $record[$i]->id;?>" target="_blank" style="color:#000000; text-decoration:none">预览</a>
			</td>
		</tr>
		<?  }?>
	</table>
	<input type="hidden" id="db_talbe" value="smg_xlcs">
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
	$(".del_project").click(function(){
		if(!window.confirm("确定要删除吗"))
			{
				return false;
			}
			else
			{
				$.post("project.post.php",{'del_id':$(this).attr('name'),'post_type':'del'},function(data){
					$("#"+data).remove();
				});
			}
	});
	
	$("#project_search").click(function(){
				window.location.href="?key="+$("#search_text1").attr('value');
	});
	
	$('#search_text1').keydown(function(e){
		if(e.keyCode == 13){
			window.location.href="?key="+$("#search_text1").attr('value');
		}
	});
	
</script>