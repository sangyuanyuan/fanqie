<?php
	require_once('../../frame.php');
	$type = $_REQUEST['type'];
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-添加新闻</title>
	<?php 
		css_include_tag('admin');
		use_jquery();
		//validate_form("picture_add");
		js_include_tag('smg_category_class.js','admin/news_add');
		
	?>
</head>
<?php 
//initialize the categroy;
	$category = new smg_category_class('news');
	$category->echo_jsdata();
	
?>
<body style="background:#E1F0F7">
	<form id="news_add" enctype="multipart/form-data" action="news.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="2" width="795">　　添加新闻</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td width="100">标　题</td><td width="695" align="left"><?php show_fckeditor('news[title]','Title',false,"50");?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td width="100">短标题</td><td width="695" align="left"><?php show_fckeditor('news[short_title]','Title',false,"50");?></td>
		</tr>		
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>优先级</td><td align="left">　<input type="text" size="10" id="priority" name=news[priority] class="number">(1-100)</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>分　类</td>
			<td align="left" class="newsselect" id="category_select">
				<input type="hidden" name="news[category_id]" id="category_id">
				<select id=select name="news[category_id]">
					<option value="1">hah</option>
					<?php	

						
						for($i=count($cates)-1;$i >=0; $i<$i--){
					?>
						<option value="<?php echo $cates[$i]->id;?>"><?php echo $cates[$i]->name;?></option>
					<? }?>
				</select>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>新闻类别</td>
			<td align="left" id="td_newstype">　
				<input type="radio" name="news[news_type]" value="1" checked="checked">默认
				<input type="radio" name="news[news_type]" value="2">文件
				<input type="radio" name="news[news_type]" value="3">URL
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=target_url >
			<td>URL</td><td align="left">　<input type="text" size="50" name=news[target_url]></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=tr_file_name >
			<td>上传文件</td><td align="left">　<input type="file" size="50" name=file_name></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>关键字</td><td align="left">　<input type="text" size="50" name=news[keywords]></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>优先级</td><td align="left">　<input type="text" size="50" name=news[priority]></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>禁止复制</td><td align="left"><input type="checkbox" name="news[forbbide_copy]" value="1"> </td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>新闻投票</td><td align="left"> </td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>新闻视频</td><td align="left"> </td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id=newsshow3 >
			<td>其他选项</td><td align="left"><a style="color:blue;" href="#" id="related_subject">所属专题</a> <a style="color:blue;" href="#" id="related_news">手动关联相关新闻</a></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1>
			<td>简短描述</td><td><?php show_fckeditor('news[description]','Admin',true,"100");?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1>
			<td>新闻内容</td><td><?php show_fckeditor('news[content]','Admin',true,"300");?></td>
		</tr>
		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布图片"></td>
		</tr>	
	</table>
	<input type="hidden" name="picture[is_adopt]" value="0">
	<input type="hidden" name="special_type" value="<?php echo $type;?>">
	</form>
	<a href="#" id="test">test</a>
</body>
</html>

<script>
	$('#test').click(function(e){
		e.preventDefault();
		//category.echo_category($('#category_select'),'test',0,20);
		//category.display_select('test',$('#category_select'),30);
		alert($('#td_newstype').find('input:checked').attr('value'));
	});	
	$('#select').click(function(){
		$('#select ~ .cate').remove();
	});
	//category.echo_category($('#category_select'),'test',0,-1);
	//$('#category_select select').change(function(){
	//	category.display_select('test',$('#category_select'),$(this).attr('value'),this);
	//});
</script>