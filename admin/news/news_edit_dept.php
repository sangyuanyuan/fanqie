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
		js_include_tag('smg_category_class.js','admin/news_pub', 'admin/news_edit_dept','thickbox','total');
				
	?>
	<script>
			total("后台","other");
	</script>
</head>
<?php 
//initialize the categroy;
		if($type==""){	
			$category = new smg_category_class('news',$dept_id);
		}else{
			$category = new smg_category_class('news',$dept_id,$type);
		}
		$category->echo_jsdata('category');
		$category1 = new smg_category_class('news');		
		$category1->echo_jsdata('category_index');			
?>
<body style="background:#E1F0F7">
	<form id="news_add" enctype="multipart/form-data" action="news_dept.post.php" method="post"> 
	<table width="795" border="0">
		<tr class=tr1>
			<td colspan="6" width="795">　　编辑新闻</td>
		</tr>
		<tr class=tr3>
			<td width="130">标题</td><td width="695" align="left"><?php show_fckeditor('news[title]','Title',false,"50",$news->title,300);?></td>
		</tr>
		<tr class=tr3>
			<td width="130">短标题</td><td width="695" align="left"><?php show_fckeditor('news[short_title]','Title',false,"50",$news->short_title,300);?><span id="max_len"></span></td>
		</tr>
		<tr class=tr3>
			<td>分　类</td>
			<td align="left" class="newsselect1" ><span id="td_category_select"></span></td> <!-- <a href="#" id="a_add_category" style="color:blue;">添加</a></td>-->
		</tr>
		
		<?php if($role=='dept_admin'){?>
		<tr  class=tr4>
			<td>是否推荐到集团首页</td><td align=left><input type="checkbox" id=is_recommend <?php if ($news->is_recommend) {?>  checked="checked" <?php }?>></td>
		</tr>
		<tr class=tr3 id="index_category" >
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
				<input type="radio" name="news[news_type]" value="1" <?php if($news->news_type==1){ ?>checked="checked"<?php } ?>>默认
				<input type="radio" name="news[news_type]" value="2" <?php if($news->news_type==2){ ?>checked="checked"<?php } ?>>文件
				<input type="radio" name="news[news_type]" value="3" <?php if($news->news_type==3){ ?>checked="checked"<?php } ?>>URL
			</td>
		</tr>
		<tr class=tr4 id=newsshow3 >
			<td>关键词</td>
			<td align="left">
				<input type="text" size="20" name=news[keywords] id="news_keywords"  value="<?php echo $news->keywords;?>">(空格分隔)
			</td>
		</tr>		
		<tr class=tr4 id=newsshow3 >
			<td>优先级</td>
			<td align="left">
				<input type="text" size="10" name=news[dept_priority] class="number" value="<?php echo $news->dept_priority;?>">(0~100)</td>
		</tr>
		<tr class=tr3 id=tr_file_name >
			<td>上传文件</td>
			<td align="left" id="tr_file_name">
				<input type="file" name=file_name id="file_name" value="<?php echo $news->file_name;?>">
				<?php
					if($news->news_type == 2 && $news->file_name){
						?>
						　<a href="<?php echo $news->file_name;?>" target="_blank" style="color:blue;">查看</a>
						<?php
					}
				?>
			</td>
		</tr>	
		
		<tr class=tr3 id=target_url>
			<td>URL</td><td align="left"><input type="text" size="50" name=news[target_url] value="<?php echo $news->target_url; ?>"></td>
		</tr>
				
		<tr id=newsshow3  class="normal_news tr4">
			<td>视频</td>
			<td align="left" id="td_video">			
				视频<input type="file" name="video_src" id="video_src">　	
				<?php 
				if($news->video_src){
						echo "<a href=\"{$news->video_src}\" target=\"_blank\">查看</a>";
					}
				?>
				缩略图<input type="file" name="video_pic" id="video_pic">　
				<?php					
					if($news->video_photo_src){
						echo "<a href=\"{$news->video_photo_src}\" target=\"_blank\">查看</a>";
					}
				?>
				<input type="checkbox" id="ch_low_quality" <?php if($news->low_quality) echo ' checked="checked"';?>>低清
				<input type="hidden" name="news[low_quality]" id="hidden_low_quality" value="<?php echo $news->low_quality?>">
			</td>
		</tr>
		<tr id=newsshow3 class="normal_news tr3">
			<td>投票</td>
			<td align="left" id="td_vote">
				<?php
					if($news->vote_id){
						$vote = new table_class('smg_vote');
						$vote->find($news->vote_id);
						echo $vote->name;
				?>
				<a href="#" id="delete_vote" style="color:blue">删除</a>				
				<?php
					}else{
				?>
				<a href="add_vote.php?width=600&height=400&dept_id=<?php echo $dept_id;?>" class="thickbox" id="a_vote_id" style="color:blue;">关联投票</a>	
				<?php	
					} 
				?>	
			</td>
		</tr>
		<tr id=newsshow3  class="normal_news tr3">
			<td>所属专题</td>
			<td align="left" id="td_subject">
				<?php
					$subject_item = new table_class('smg_subject_items');
					$record = $subject_item->find('all',array('conditions' => 'category_type="news" and resource_id='.$news->id));
					
					if(count($record)>0){
						$subject = new table_class('smg_subject');
						$subject->find($record[0]->subject_id);
						echo $subject->name;
				?>
				<a href="#" id="delete_subject" style="color:blue">删除</a>
				<?php
					}else{
				?>
				<a style="color:blue;" href="assign_subject.php?width=600&height=400" class="thickbox" id="a_assign_subject">关联专题</a>
				<?php
					}
				?>
			</td>
		</tr>
		<tr id=newsshow3  class="normal_news tr4">
			<td>其他选项</td>
			<td align="left">
				<input type="checkbox" name="news[forbbide_copy]" value="1" <?php if($news->forbbide_copy==1){?>checked="checked" <?php } ?>>禁止复制   				
				<!-- <input type="checkbox" name="news[image_flag]" value="1" <?php if($news->image_flag == 1) echo "checked=\"checked\"";?>>图片提示　-->
				<input type="checkbox" id="check_box_commentable" <?php if($news->is_commentable) echo 'checked="checked"';?>>开启评论  
				<!-- <a style="color:blue;" href="filte_news.php?width=600&height=400" class="thickbox" id="related_news">手动关联相关新闻</a>
								<input type="checkbox" name="news[is_dept_adopt]" value="1">直接发布 
				<a style="color:blue;" href="related_video.php?width=600&height=400" class="thickbox" id="related_news">关联相关视频</a>-->
			</td>
		</tr>
		<tr id=newsshow1  class="normal_news tr3">
			<td height=100>简短描述</td><td><?php show_fckeditor('news[description]','Admin',true,"100",$news->description);?></td>
		</tr>
		<tr id=newsshow1 class="normal_news tr3">
			<td height=265>新闻内容</td><td><?php show_fckeditor('news[content]','Admin',true,"265",$news->content);?></td>
		</tr>
		<tr class=tr3>
			<td colspan="2" width="795" align="center"><input id="submit" type="submit" value="发布新闻"></td>
		</tr>	
	</table>
		<input type="hidden" name="news[related_news]"  value="<?php echo $news->related_news?>" id="hidden_related_news">

		<input type="hidden" name="news[category_id]" id="category_id_index" value="<?php echo $news->category_id;?>">

		<input type="hidden" name="news[is_recommend]" id="hidden_is_recommend" value="<?php echo $news->is_recommed;?>">
		<input type="hidden" name="news[dept_category_id]" id="category_id" value="<?php echo $news->dept_category_id;?>">
	
		<input type="hidden" name="category_add" id="category_add" value="">
		<input type="hidden" name="news[vote_id]"  id="vote_id" value="<?php echo $news->vote_id; ?>">		
		<input type="hidden" name="subject_id" value="<?php echo $subject->id;?>" id="hidden_subject_id">
		<input type="hidden" name="subject_category_id" value="'<?php echo $record[0]->category_id;?>'" id="hidden_subject_category_id">		
		<input type="hidden" name="delete_subject" value="0" id="hidden_delete_subject">
		<input type="hidden" name="id" value="<?php echo $news->id;?>">
		<input type="hidden" name="news[related_videos]" value="<?php echo $news->related_videos;?>" id="hidden_related_videos">
		<input type="hidden" name="news[is_commentable]" value="<?php echo $news->is_commentable;?>" id="hidden_is_commentable">
	</form>
</body>
</html>

<script>
	$(function(){
		$('#delete_vote').click(function(e){
			e.preventDefault();
			str = '<a href="add_vote.php?width=600&height=400&dept_id=<?php echo $_COOKIE["smg_user_dept"];?>" class="thickbox" id="a_vote_id" style="color:blue;">关联投票</a>';
			$('#td_vote').html(str);
			$('#vote_id').val('0');
			tb_init('#a_vote_id');
		});
		
		$('#delete_subject').click(function(e){
			e.preventDefault();
			str = '<a style="color:blue;" href="assign_subject.php?width600&height=400" class="thickbox" id="a_assign_subject">关联专题</a>';
			$('#td_subject').html(str);
			tb_init('#a_assign_subject');
			$('#hidden_delete_subject').val('2');
		});
		if( $('#hidden_sub_headlines').attr('value')){
			sub_headlines = $('#hidden_sub_headlines').attr('value').split(",");
		}
		if($('#hidden_related_news').attr('value')){
			related_news = $('#hidden_related_news').attr('value').split(",");
		}	
		if($('#hidden_related_videos').attr('value')){
			related_videos = $('#hidden_related_videos').attr('value').split(",");
		}	
	});
</script>