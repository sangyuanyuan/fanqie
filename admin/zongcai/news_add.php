<?php
	require_once('../../frame.php');
	$role = judge_role();
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
			<td width="130">标题</td><td width="695" align="left"><input type="text" name="news[title]" id="news_title"></td>
		</tr>
		<tr class=tr3>
			<td width="130">短标题</td><td width="695" align="left"><input type="text" name="news[short_title]" id="news_short_title"><span id="max_len"></span></td>
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
					<option value="<?php echo $records[$i]->id;?>"><?php echo $records[$i]->name;?></option>
					<?php
						}
					?>
				</select>
			</td>
		</tr>
		
		<tr class=tr3>
			<td>关键词</td>
			<td align="left">
				<input type="text" size="20" id="news_keywords"  name=news[keywords]>(空格分隔)
		</tr>		
		<tr class=tr3>
			<td>优先级</td>
			<td align="left">
				<input type="text" size="10" name=news[priority] class="number">(0~100)</td>
		</tr>
		<tr class=tr3>
			<td>链接</td>
			<td align="left">
				<input type="text" size="20"  name=news[target_url]>(填写则跳转到链接页面)
		</tr>	
		<tr class="normal_news tr4">
			<td>其他选项</td>
			<td align="left">
				<input type="checkbox" name="news[forbbide_copy]" value="1">禁止复制  
					
				<!-- <input type="checkbox" name="news[image_flag]" value="1">图片提示　-->
				<input type="checkbox" id="check_box_commentable" value="1" checked="checked">开启评论 				
				<!-- <a style="color:blue;" href="related_video.php?width=600&height=400" class="thickbox" id="related_news">关联相关视频</a>
				<input type="checkbox" name="news[is_dept_adopt]" value="1" checked="checked">直接发布 
				<a style="color:blue;" href="filte_news.php?width=600&height=400" class="thickbox" id="related_news">手动关联相关新闻</a>  					 -->
			</td>
		</tr>
		<tr class="normal_news tr3">
			<td height=100>简短描述</td><td><?php show_fckeditor('news[description]','Admin',true,"100");?></td>
		</tr>
		<tr class="normal_news tr3">
			<td height=265>新闻内容</td><td><?php show_fckeditor('news[content]','Admin',true,"265");?></td>
		</tr>
		<tr class=tr3>
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布新闻"></td>
		</tr>	
	</table>
	</form>
</body>
</html>
