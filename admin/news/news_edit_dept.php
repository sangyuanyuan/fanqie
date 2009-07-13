<?php
	require_once('../../frame.php');
	$role = judge_role();
	if(!$_GET['id']){
		die('非法的新闻ID号');
	}
	$dept_id = $_COOKIE['smg_user_dept'];
	$type = $_REQUEST['type'];
	$dept = new table_class("smg_dept");
	$rows_dept = $dept->find("all");
	$news = new table_class('smg_news');
	$news = $news->find($_GET['id']);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-编辑新闻</title>
	<?php 
		css_include_tag('admin','thickbox');
		use_jquery();
		validate_form("news_add");
		js_include_tag('smg_category_class.js','admin/news_add_dept','thickbox');		
	?>
</head>
<?php 
//initialize the categroy;

		if($type==""){	
			//echo $dept_id;
			$category = new smg_category_class('news',$dept_id);
			//$category->echo_jsdata('dept_category');
		}else{
			$category = new smg_category_class('news',$dept_id,$type);
			//$category->echo_jsdata('dept_category');
		}
		$category1 = new smg_category_class('news');
		$category->echo_jsdata('dept_category');
		$category1->echo_jsdata('category');
		
	
?>
<body style="background:#E1F0F7">
	<form id="news_add" enctype="multipart/form-data" action="news_dept.post.php" method="post"> 
	<table width="795" border="0">
		<tr class=tr1>
			<td colspan="6" width="795">　　编辑新闻</td>
		</tr>
		<tr class=tr3>
			<td width="130">标题/短标题</td><td width="695" align="left"><?php show_fckeditor('news[title]','Title',false,"50",$news->title,300);?>　/　<?php show_fckeditor('news[short_title]','Title',false,"50",$news->short_title,300);?><span id="max_len"></span></td>
		</tr>
		<tr class=tr3>
			<td>分　类</td>
			<td align="left" class="newsselect1" ><span id="td_category_select"></span><a href="#" id="a_add_category" style="color:blue;">添加</a></td>
		</tr>
		
		<?php if($role=='dept_admin'){?>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>是否推荐到集团首页</td><td align="left">　<input type="checkbox" id=is_recommend <?php if ($news->is_recommend) {?>  checked="checked" <?php }?>></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id="index_category" >
			<td>首页分类</td>
			<td align="left" class="newsselect1" >			
			<span id="td_category_index"></span>
			</td>
		</tr>
		<input type="hidden" name="news[dept_id]"  value="<?php echo $dept_id;?>">
		<?php }?>		
		<tr class=tr4 id=newsshow3 >
			<td>类别</td>
			<td align="left" id="td_newstype">
				<input type="radio" name="news[news_type]" value="1" checked="checked">默认
				<input type="radio" name="news[news_type]" value="2">文件
				<input type="radio" name="news[news_type]" value="3">URL
			</td>
		</tr>
		<tr class=tr4 id=newsshow3 >
			<td>标签/关键词/优先级</td>
			<td align="left">
				<select name="news[tags]">
					<option value="">请选择</option>
				<?php
				$tags = get_config('g_news_tags');
				foreach ($tags as $v) {
					echo "<option value='{$v}'>$v</option>";
				}
				?>
				</select>　　/　　
				<input type="text" size="20" name=news[keywords]>(空格分隔)　　/　　
				<input type="text" size="10" name=news[dept_priority] class="number">(0~100)</td>
		</tr>		
		
		<tr class=tr3 id=tr_file_name >
			<td>上传文件</td><td align="left"><input type="file" size="50" name=file_name></td>
		</tr>	
		
		<tr class=tr3 id=target_url>
			<td>URL</td><td align="left"><input type="text" size="50" name=news[target_url]></td>
		</tr>
				
		<tr align="center" bgcolor="#f9f9f9" height="22px;" id=newsshow3  class="normal_news">
			<td>视频</td>
			<td align="left" id="td_video">			
				视频文件<input type="file" name="video_src" id="video_src">　　	
				视频图片<input type="file" name="video_pic" id="video_pic">
			</td>
		</tr>
		<tr id=newsshow3 class="normal_news tr3">
			<td>投票</td>
			<td align="left" id="td_vote">
				<a href="add_vote.php?width=600&height=400" class="thickbox" id="a_vote_id" style="color:blue;">关联投票</a>
				<input type="hidden" name="news[vote_id]" id="vote_id">
			</td>
		</tr>
		<tr id=newsshow3  class="normal_news tr3">
			<td>所属专题</td>
			<td align="left" id="td_subject">
				<a style="color:blue;" href="assign_subject.php?width=600&height=400" class="thickbox" id="a_assign_subject">关联专题</a>
			</td>
		</tr>
		<tr id=newsshow3  class="normal_news tr4">
			<td>其他选项</td>
			<td align="left"><input type="checkbox" name="news[forbbide_copy]" value="1">禁止复制  <input type="checkbox" name="news[is_dept_adopt]" value="1">直接发布  <input type="checkbox" name="news[image_flag]" value="1">图片提示　<a style="color:blue;" href="filte_news.php?width=650&height=400" class="thickbox" id="related_news">手动关联相关新闻</a></td>
		</tr>
		<tr id=newsshow1  class="normal_news tr3">
			<td height=100>简短描述</td><td><?php show_fckeditor('news[description]','Admin',true,"100");?></td>
		</tr>
		<tr id=newsshow1 class="normal_news tr3">
			<td height=265>新闻内容</td><td><?php show_fckeditor('news[content]','Admin',true,"265");?></td>
		</tr>
		<tr class=tr3>
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布新闻"></td>
		</tr>	
	</table>
		<input type="hidden" name="news[related_news]" value="" id="hidden_related_news">
		<input type="hidden" name="news[sub_news_id]" value="" id="hidden_sub_headlines">
		<input type="hidden" name="news[category_id]" id="category_id_index">

		<input type="hidden" name="news[is_recommend]" id="hidden_is_recommend" value="0">
		<input type="hidden" name="news[dept_category_id]" id="category_id">
	
		<input type="hidden" name="category_add" id="category_add" value="">
		<input type="hidden" name="subject_id" value="" id="hidden_subject_id">
		<input type="hidden" name="subject_category_id" value="" id="hidden_subject_category_id">		
		<input type="hidden" name="delete_subject" value="0" id="hidden_delete_subject">
	</form>
</body>
</html>

<script>
	$(function(){
		//category.display_select('news_category',$('#td_category_select'),-1);
	});
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