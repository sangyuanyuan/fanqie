<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$key1 = $_REQUEST['key1'];
	$db = get_db();
	if($key1!=''){
		$sql = 'SELECT t1.*,t2.title FROM  smg_dialog_question t1,smg_dialog t2 where t1.dialog_id = t2.id and t1.dialog_id='.$id.' and t1.content like "%'.trim($key1).'%" order by create_time desc';
	}else{
		$sql = 'SELECT t1.*,t2.title FROM  smg_dialog_question t1,smg_dialog t2 where t1.dialog_id = t2.id and t1.dialog_id='.$id.' order by create_time desc';
	}
	$records = $db->paginate($sql,18);
	close_db();
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
			<td colspan="6" width="795"><span style="margin-left:20px; font-size:13px">内容搜索&nbsp;&nbsp;<input id="search_text" type="text" value="<? echo $key1;?>"></span>
			<input type="button" value="搜索" id="dialog_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td width="395">内容</td><td width="100">发布人</td><td width="100">所属对话</td><td width="100">创建时间</td><td width="100">操作</td>
		</tr>
		<?php for($i=0;$i<$count;$i++){?>
		<tr class="tr3" id="<?php echo $records[$i]->id;?>">
			<td><?php echo $records[$i]->content;?></td>
			<td><?php echo $records[$i]->writer;?></td>
			<td><?php echo $records[$i]->title;?></td>
			<td><?php echo substr($records[$i]->create_time, 0, 10);$records[$i]->create_time;?></td>
			<td>
				<a href="/admin/comment/comment.php?id=<?php echo $records[$i]->id;?>&type=dialog" style="color:#000000; text-decoration:none">评论</a>
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
	$("#dialog_search").click(function(){
				window.location.href="?id=<?php echo $id;?>&key1="+$("#search_text").attr('value');
	});
	
	$("#search_text").keypress(function(event){
			if(event.keyCode==13){
				window.location.href="?id=<?php echo $id;?>&key1="+$("#search_text").attr('value');
			}
	});
</script>