<?php
	require_once('../../frame.php');
	$key1 = $_REQUEST['key1'];
	$db = get_db();
	if($key1!=''){
		$sql = 'SELECT t1.*,t2.title FROM  smg_dialog_question t1,smg_dialog t2 where t1.dialog_id = t2.id and t1.content like "%'.trim($key1).'%"';
	}else{
		$sql = 'SELECT t1.*,t2.title FROM  smg_dialog_question t1,smg_dialog t2 where t1.dialog_id = t2.id';
	}
	$records = $db->paginate($sql,18);
	close_db();
	$count = count($records);
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
		js_include_tag('admin_pub');
	?>
</head>
<body style="background:#E1F0F7">
	<table width="795" border="0">
		<tr class="tr1">
			<td colspan="6" width="795"><span style="margin-left:20px; font-size:13px">内容搜索&nbsp;&nbsp;<input id="search_text" type="text" value="<? echo $key1;?>"></span>
			<input type="button" value="搜索" id="dialog_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td width="365">内容</td><td width="140">发布人</td><td width="140">所属对话</td><td width="140">创建时间</td><td width="250">操作</td>
		</tr>
		<?php for($i=0;$i<$count;$i++){?>
		<tr class="tr3" id="<?php echo $records[$i]->id;?>">
			<td><textarea cols="25" rows="3" class="content"><?php echo $records[$i]->content;?></textarea></td>
			<td><?php echo $records[$i]->writer;?></td>
			<td><?php echo $records[$i]->title;?></td>
			<td><?php echo substr($records[$i]->create_time, 0, 10);$records[$i]->create_time;?></td>
			<td><a class="edit" value="<?php echo $records[$i]->id;?>" style="color:#000000; text-decoration:none; cursor:pointer">编辑</a>
				<span style="color:#FF0000; cursor:pointer" class="del" name="<?php echo $records[$i]->id;?>">删除</span>
			</td>
		</tr>
		<? }?>
	</table>
	<input type="hidden" id="db_talbe" value="smg_dialog_question">
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
	$(".edit").click(function(){
		if(!window.confirm("编辑评论内容")){return false;}
		$.post("dialog.post.php",{'id':$(this).attr('value'),'content':$(".content").attr('value'),'type':'edit_content','db_table':'smg_dialog_question'},function(data){
			if(""==data){window.location.reload();}
		});	
	});
	
	$("#dialog_search").click(function(){
				window.location.href="?key1="+$("#search_text").attr('value');
	});
</script>