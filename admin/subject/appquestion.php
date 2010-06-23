<?php
	#var_dump($_REQUEST);
	require_once('../../frame.php');
	$user = judge_role('admin');	
	
	$title = $_REQUEST['title'];
	$db = get_db();
	if($title){
		$record = search_content($title,'smg_wxh_question','',20,'priority asc,created_at desc');
	}else{
		$news = new table_class('smg_wxh_question');
		$record = $news->paginate('all',array('conditions' => '','order' => 'priority asc,created_at desc'),20);
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
	<?php
		css_include_tag('admin');
		use_jquery();
		js_include_tag('admin_pub');	
	?>
</head>

<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="6"> 　　　
				搜索　<input id=title type="text" value="<? echo $_REQUEST['title']?>"><input type="button" value="搜索" id="search_new" style="border:1px solid #0000ff; height:21px">
			</td>
		</tr>
		<tr class="tr2">

			<td width="55">删除</td><td width="220">标题</td><td width="100">发布者姓名</td><td width="100">发布内容</td><td width="120">发布时间</td><td width="200">操作</td>
		</tr>
		<?php
			//--------------------
			for($i=0;$i<count($record);$i++){
		?>
				<tr class=tr3 id=<?php echo $record[$i]->id;?> >
					<?php 
						$var_name = "delete_news[]";
					?>
					<td><input style="width:12px;" type="checkbox" name="<?php echo $var_name;?>" value="<?php echo $record[$i]->id;?>"></td>
					<td><?php echo strip_tags($record[$i]->title);?></td>
					<td>
						<?php echo $record[$i]->nick_name; ?>
					</td>
					<td>
						<?php echo $record[$i]->content; ?>
					</td>
					<td>
						<?php echo $record[$i]->created_at; ?>
					</td>								
					<td><?php if($record[$i]->is_adopt==0){ ?><span style="color:#0000FF;cursor:pointer" class="publish" name="<?php echo $record[$i]->id;?>">发布</span><?php }else { ?><span style="color:#FF0000;cursor:pointer" class="revocation" name="<?php echo $record[$i]->id;?>">撤销</span><?php } ?>
						<span style="cursor:pointer;color:#FF0000" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
						<input type="text" class="priority"  name="<?php echo $record[$i]->id;?>"  value="<?php if('100'!=$record[$i]->priority){echo $record[$i]->priority;};?>" style="width:40px;">
					</td>
				</tr>
		<?php
			}
			//--------------------
		?>
		<tr class="tr3">
			<td colspan=6><button id="select_all">全选</button> <button id="button_delete">删除</button> <?php paginate();?>　<button id=clear_priority>清空优先级</button>　<button id=edit_priority>编辑优先级</button></td>
		</tr>
		<input type="hidden" id="db_talbe" value="smg_wxh_question">

	</table>
</body>
</html>

<script>
	$("#search").click(function(){
			window.location.href="?title="+$("#title").attr('value');
	});
	
	$('#title').keydown(function(e){
			if(e.keyCode == 13){
				window.location.href="?title="+$("#title").attr('value');
			}
	});
	$(function(){
		var all_selected = false;
		$('#select_all').click(function(){
			all_selected = !all_selected;
			$('input:checkbox').attr('checked',all_selected);
		});
		$('#button_delete').click(function(){
			if (confirm('确定删除选中新闻?')) {
				$.post('delete_news.php', $('input:checkbox').serializeArray(), function(data){
					window.location.reload();
				});
			}
		});
	});
</script>
