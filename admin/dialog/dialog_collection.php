<?php
	require_once('../../frame.php');
	$key = $_REQUEST['key'];
	$dialog_collection = new table_class('smg_dialog_collection');
	if($key!=''){
		$records = $dialog_collection->paginate('all',array('conditions' => 'title  like "%'.trim($key).'%"'));
	}else{
		$records = $dialog_collection->paginate('all');
	}
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
			<td colspan="5" width="795"><span style="margin-left:20px; font-size:13px">搜索&nbsp;&nbsp;<input id="search_text" type="text" value="<? echo $key;?>"></span>
			<input type="button" value="搜索" id="dialog_search" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">
			<td width="365">主题</td><td width="140">创建时间</td><td width="250">操作</td>
		</tr>
		<?php for($i=0;$i<$count;$i++){?>
		<tr class="tr3" id="<?php echo $records[$i]->id;?>">
			<td><?php echo $records[$i]->content;?></td>
			<td><?php echo substr($records[$i]->create_time,0,10);?></td>
			<td><?php if($records[$i]->is_used=='1'){?><font color='#FF0000'>已采纳</font><?php }else{?><a href="dialog_add.php?id=<?php echo $records[$i]->id;?>&title=<?php echo $records[$i]->content;?>" style="color:#0000FF; text-decoration:none">采纳</a><?php }?>
				<span style="cursor:pointer" class="del" name="<?php echo $records[$i]->id;?>">删除</span>
			</td>
		</tr>
		<? }?>
	</table>
	<input type="hidden" id="db_talbe" value="smg_dialog_collection">
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
				window.location.href="?key="+$("#search_text").attr('value');
	});
</script>