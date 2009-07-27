<?php
	require_once('../../frame.php');
	$key = urldecode($_REQUEST['key']);
	$dialog = new table_class('smg_dialog');
	if($key!=''){
		$records = $dialog->paginate('all',array('conditions' => 'title  like "%'.trim($key).'%"','order' => 'id desc'));
	}else{
		$records = $dialog->paginate('all',array('order' => 'id desc'));
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
			<td colspan="5" width="795">　<a href="dialog_add.php" style="color:#0000FF">添加对话</a> 　　　
			<span style="font-size:13px">搜索　<input id="search_text" type="text" value="<? echo $key;?>"></span>
			<input type="button" value="搜索" id="dialog_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td width="365">主题</td><td width="140">开始时间</td><td width="140">结束时间</td><td width="250">操作</td>
		</tr>
		<?php for($i=0;$i<$count;$i++){?>
		<tr class="tr3" id="<?php echo $records[$i]->id;?>">
			<td><a href="/zone/dialog.php?id=<? echo $records[$i]->id;?>" style="color:#0000FF" target="_blank"><?php echo $records[$i]->title;?></a></td>
			<td><?php echo substr($records[$i]->start_time,0,10);?></td>
			<td><?php echo substr($records[$i]->end_time,0,10);?></td>
			<td><?php if($records[$i]->is_adopt=="1"){?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $records[$i]->id;?>">撤消</span><? }?>
				<?php if($records[$i]->is_adopt=="0"){?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $records[$i]->id;?>">发布</span><? }?>
				<a href="dialog_edit.php?id=<?php echo $records[$i]->id;?>" style="color:#000000; text-decoration:none">编辑</a> 
				<span style="cursor:pointer" class="del_dialog" name="<?php echo $records[$i]->id;?>">删除</span>
				<a href="/admin/comment/comment.php?id=<?php echo $records[$i]->id;?>&type=dialog" style="color:#000000; text-decoration:none">评论</a>
				<a href="dialog_question.php?id=<?php echo $records[$i]->id;?>" style="color:#000000; text-decoration:none">问题</a>
				<a href="dialog_answer.php?id=<?php echo $records[$i]->id;?>" style="color:#000000; text-decoration:none">回答</a>
			</td>
		</tr>
		<? }?>
	</table>
	<input type="hidden" id="db_talbe" value="smg_dialog">
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
	$("#dialog_search").click(function(){
				window.location.href="?key="+encodeURI($("#search_text").attr('value'));
	});
	$('#search_text').keydown(function(e){
		if(e.keyCode == 13){
			window.location.href="?key="+ encodeURI($("#search_text").attr('value'));			
		}
	});
	
	$(".del_dialog").click(function(){
			if(!window.confirm("确定要删除吗"))
			{
				return false;
			}
			else
			{	//alert($(this).attr('name'));
				$.post("dialog.post.php",{'del_id':$(this).attr('name'),'type':'del_dialog'},function(data){
					//alert(data);
					$("#"+data).remove();
				});
			}
	})
</script>