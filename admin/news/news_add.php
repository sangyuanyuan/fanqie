<?php
	require_once('../../frame.php');
	$role = judge_role();
	$dept_id = $_REQUEST['dept_id'];
	$type = $_REQUEST['type'];
	
	
	
	$dept = new table_class("smg_dept");
	$rows_dept = $dept->find("all");
	
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
		js_include_tag('smg_category_class.js','admin/news_add','thickbox');
		
	?>
</head>
<?php 
//initialize the categroy;
	if($role=='admin'){
		$url = 'index.php';
		if($type==""){	
			$category = new smg_category_class('news');
			$category->echo_jsdata();
		}else{
			$category = new smg_category_class('news',null,$type);
			$category->echo_jsdata();
		}
	}else{
		$url = 'news_list.php';
		if($type==""){	
			$category = new smg_category_class('news',$dept_id);
			$category->echo_jsdata();
		}else{
			$category = new smg_category_class('news',$dept_id,$type);
			$category->echo_jsdata();
		}
		$category = new smg_category_class('news');
		$category->echo_jsdata('dept_category');
	}
	
?>
<body style="background:#E1F0F7">
	<form id="news_add" enctype="multipart/form-data" action="news.post.php" method="post"> 
	<table width="795" border="0">
		<tr bgcolor="#f9f9f9" height="25px;" style="font-weight:bold; font-size:13px;">
			<td colspan="6" width="795">　　添加新闻</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="22px;">
			<td  width="100">标　题</td><td colspan="5" width="695" align="left"><?php show_fckeditor('news[title]','Title',false,"50");?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="22px;">
			<td width="100">短标题</td><td colspan="5" width="695" align="left"><?php show_fckeditor('news[short_title]','Title',false,"50");?></td>
		</tr>		
		<tr align="center" bgcolor="#f9f9f9" height="22px;">
			<td >分　类</td>
			<td colspan="5" align="left" class="newsselect1" >　				
			<span id="td_category_select"></span>
			<a href="#" id="a_add_category" style="color:blue;">添加</a>
			</td>
		</tr>
		
		<?php if($role=='dept_admin'){?>
		<tr align="center" bgcolor="#f9f9f9" height="25px;">
			<td>是否推荐到集团首页</td><td colspan="5" align="left">　<input type="checkbox" name=is_recommend id=is_recommend></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id="index_category" >
			<td>首页分类</td>
			<td colspan="5" align="left" class="newsselect1" >　				
			<span id="td_category_dept"></span>
			</td>
		</tr>
		<input type="hidden" name="magazine[dept_id]"  value="<?php echo $dept_id;?>">
		<?php }else{?>
		<tr align="center" bgcolor="#f9f9f9" height="25px;" id="index_category">
			<td>发表部门</td>
			<td colspan="5" align="left" class="newsselect1">
				<select id=select name="magazine[dept_id]">
					<option value="7" >总编室</option>
					<?php	
						for($i=0;$i<count($rows_dept);$i++){
							if($rows_dept[$i]->id!='7'){
					?>
						<option value="<?php echo $rows_dept[$i]->id;?>" ><?php echo $rows_dept[$i]->name;?></option>
					<?php } }?>
				</select>
			</td>
		</tr>
		<?php }?>
		
		<tr align="center" bgcolor="#f9f9f9" height="22px;" id=newsshow3 >
			<td>新闻类别</td>
			<td colspan="5" align="left" id="td_newstype">　
				<input type="radio" name="news[news_type]" value="1" checked="checked">默认
				<input type="radio" name="news[news_type]" value="2">文件
				<input type="radio" name="news[news_type]" value="3">URL
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="22px;">
			<td>头条控制</td>
			<td colspan="5" align="left" id="td_headline_type">　
				  <input type="radio" name="news[sub_headline]" value="1" checked="checked">展示简介 <input type="radio" name="news[sub_headline]" value="2">展示子头条  <a href="sub_headline.php?width=800&height=400" style="color:blue;" class="thickbox" id="a_sub_headline">关联子头条</a>
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" id=target_url>
			<td>URL</td><td colspan="5" align="left">　<input type="text" size="50" name=news[target_url]></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" id=tr_file_name >
			<td>上传文件</td><td colspan="5" align="left">　<input type="file" size="50" name=file_name></td>
		</tr>
		
		<tr align="center" bgcolor="#f9f9f9" height="22px;" id=newsshow3 >
			<td>新闻标签</td>
			<td align="left">　
				<select name="news[tags]" style="margin-left:10px;">
					<option value="">请选择</option>
				<?php
				$tags = get_config('g_news_tags');
				foreach ($tags as $v) {
					echo "<option value='{$v}'>$v</option>";
				}
				?>
				</select>
			</td>
			<td>关键字</td><td align="left">　<input type="text" size="20" name=news[keywords]>(请用空格分隔)</td>
			<td>优先级</td><td align="left">　<input type="text" size="20" name=news[priority] class="number">(0~100)</td>
		</tr>		
	
		<tr align="center" bgcolor="#f9f9f9" height="22px;" id=newsshow3  class="normal_news">
			<td>新闻视频</td>
			<td align="left" id="td_video" colspan="5">　				
				视频文件<input type="file" name="video_src" id="video_src">	
				视频图片<input type="file" name="video_pic" id="video_pic">
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" id=newsshow3 class="normal_news">
			<td>新闻投票</td>
			<td align="left" id="td_vote" colspan="5">　
				<a href="add_vote.php?width=600&height=400" class="thickbox" id="a_vote_id" style="color:blue;">关联投票</a>
				<input type="hidden" name="news[vote_id]" id="vote_id">	
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" id=newsshow3  class="normal_news">
			<td>所属专题</td>　
			<td align="left" id="td_subject" colspan="5">　
				<a style="color:blue;" href="assign_subject.php?width=600&height=400" class="thickbox" id="a_assign_subject">关联专题</a>
				<input type="hidden" name="subject_id" value="">
				<input type="hidden" name="subject_category_id" value="">
			</td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="22px;" id=newsshow3  class="normal_news">
			<td>其他选项</td><td align="left" colspan="5">　<input type="checkbox" name="news[forbbide_copy]" value="1"> 禁止复制  <input type="checkbox" name="news[is_adopt]" value="1">直接发布 <a style="color:blue;" href="filte_news.php?width=800&height=400" class="thickbox" id="related_news">手动关联相关新闻</a></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="100px;" id=newsshow1  class="normal_news">
			<td>简短描述</td><td colspan="5"><?php show_fckeditor('news[description]','Admin',true,"100");?></td>
		</tr>
		<tr align="center" bgcolor="#f9f9f9" height="150px;" id=newsshow1 class="normal_news">
			<td>新闻内容</td><td colspan="5"><?php show_fckeditor('news[content]','Admin',true,"300");?></td>
		</tr>
		<tr bgcolor="#f9f9f9" height="30px;">
			<td colspan="6" width="795" align="center"><input id="submit" type="submit" value="发布新闻"></td>
		</tr>	
	</table>
		<input type="hidden" name="news[related_news]" value="" id="hidden_related_news">
		<input type="hidden" name="news[sub_news_id]" value="" id="hidden_sub_headlines">
		<input type="hidden" name="news[category_id]" id="category_id">
		<?php if($role=='admin'){
		?>
		<input type="hidden" name="news[is_recommend]" value="1">
		<?php
		}else{
		?>
		<input type="hidden" name="news[is_recommend]" value="0">
		<?
		} ?>	
		<input type="hidden" name="category_add" id="category_add" value="">
	</form>
</body>
</html>

<script>
	$(function(){
		category.display_select('news_category',$('#td_category_select'),-1);
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