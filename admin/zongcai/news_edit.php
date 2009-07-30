<?php
	require_once('../../frame.php');
	$role = judge_role();
	$id = $_REQUEST['id'];
	$news = new table_class('smg_news');
	$news->find($id);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-添加新闻</title>
	<?php 
		css_include_tag('admin','thickbox');
		use_jquery();
		validate_form("news_add");
	?>
</head>
<body style="background:#E1F0F7">
	<form id="news_add" enctype="multipart/form-data" action="news.post.php" method="post"> 
	<table width="795" border="0">
		<tr class=tr1>
			<td colspan="6" width="795">　　添加新闻</td>
		</tr>
		<tr class=tr3>
			<td width="130">标题</td><td width="695" align="left"><input value="<?php echo $news->title; ?>" type="text" name="news[title]" id="news_title"></td>
		</tr>
		<tr class=tr3>
			<td width="130">短标题</td><td width="695" align="left"><input value="<?php echo $news->short_title; ?>" type="text" name="news[short_title]" id="news_short_title"><span id="max_len"></span></td>
		</tr>
		<tr class=tr3>
			<td>分　类</td>
			<td align="left">
				<select name="news[category_id]">
					<?php 
						$db = get_db();
						$sql = 'select name,id from smg_category where category_type="zongcai" and description="news"';
						$records = $db->query($sql);
						$count = count($records);
						for($i=0;$i<$count;$i++){
					?>
					<option <?php if($records[$i]->id==$news->category_id){?> selected="selected" <?php } ?> value="<?php echo $records[$i]->id;?>"><?php echo $records[$i]->name;?></option>
					<?php
						}
					?>
				</select>
			</td>
		</tr>
		
		<tr class=tr3>
			<td>关键词</td>
			<td align="left">
				<input type="text" size="20" id="news_keywords" value="<?php echo $news->keywords; ?>" name=news[keywords]>(空格分隔)
		</tr>		
		<tr class=tr3>
			<td>优先级</td>
			<td align="left">
				<input type="text" size="10"  value="<?php echo $news->priority;?>" name=news[priority] class="number">(0~100)</td>
		</tr>
		<tr class=tr3>
			<td>链接</td>
			<td align="left">
				<input type="text" size="20"  value="<?php echo $news->target_url;?>"  name=news[target_url]>(填写则跳转到链接页面)
		</tr>	
		<tr class="normal_news tr4">
			<td>其他选项</td>
			<td align="left">
				<input type="checkbox" <?php if($news->forbbide_copy==1){?> checked="checked" <?php } ?> name="news[forbbide_copy]" value="1">禁止复制  
				<input type="checkbox" <?php if($news->forbbide_copy==1){?> checked="checked" <?php } ?> id="check_box_commentable" value="1" checked="checked">开启评论 				
			</td>
		</tr>
		<tr class="normal_news tr3">
			<td height=100>简短描述</td><td><?php show_fckeditor('news[description]','Admin',true,"100",$news->description);?></td>
		</tr>
		<tr class="normal_news tr3">
			<td height=265>新闻内容</td><td><?php show_fckeditor('news[content]','Admin',true,"265",$news->content);?></td>
		</tr>
		<tr class=tr3>
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布新闻"></td>
		</tr>	
	</table>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	</form>
</body>
</html>
