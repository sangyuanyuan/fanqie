<?php
	require_once('../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>新闻中心内网</title>
	<link href="css/news.css" rel="stylesheet" type="text/css">
	<?php
		use_jquery();
		js_include_tag('dept_pub');
	?>
</head>
<body>
<div id="center">
<div id="bg">	
	<?php
		include("inc/topbar.inc.php");
		include("inc/leftbar.inc.php");
		$news_id = $_REQUEST['id'];
		$news = get_dept_news($news_id);
		if($news[0]->news_type==3)//url链接类新闻
		{
			redirect($news->target_url);
			exit;
		}
		//文件新闻
		if($news[0]->news_type==2)
		{
			redirect($news->file_name);
			exit; 	
		}
	?>
	<div id="content">
		<div class="titlebox">
			<a href="index.php">首页</a>
			-&nbsp<a href="newslist.php?id=<?php echo $news[0]->dept_category_id; ?>"><?php echo $news[0]->category_name; ?></a>
		</div>
		<div class="text">
			<div id="title">
				<?php echo $news[0]->title;?>
			</div>
			<div id="count">
				浏览次数：<?php echo $news[0]->click_count;?> 时间： <?php echo $news[0]->created_at;?>
			</div>
			<div class="box">
				<?php echo $news[0]->content; ?>
			</div>
		</div>
		<div class="titlebox">
			留言：
		</div>
		<div class="text">
			<div class="box2">
				<?php 
          			$comments=get_comments($news_id,'news',5);
					//var_dump($comments);
					$count = count($comments);
					for($i=0;$i<$count;$i++){
				?>
				<font color="gray" ><?php echo $comments[$i]->nick_name.":".$comments[$i]->created_at; ?></font><br/>
				<?php echo $comments[$i]->comment."<br/>";}
				?>
			</div>
		</div>
		<div class="titlebox">
			发表评论：
		</div>
		<div class="text">
			<div class="box3">
				用户：<input type="text" id="commenter" name="commenter"><br>
	        	评论：<textarea id="comment_content" name="comment" cols="60" rows="5"></textarea></br>
	        	<input type="submit" name="Submit" id="submit_comment" value="发表">
				<input type="hidden" id="resource_id" value="<?php echo $news_id;?>">
				<input type="hidden" id="resource_type" value="news">
			</div>
		</div>
	</div>
</div>

<div id="bottom">
		上海文广新闻传媒集团  电视新闻中心 版权所有 <br/>
		建议 1024X768 浏览效果最佳<br/>
</div>
</div>
</body>
</html>
<?php close_db(); ?>