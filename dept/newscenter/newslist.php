<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻中心内网</title>
<?php 
	js_include_once_tag('total');
?>
<link href="css/list.css" rel="stylesheet" type="text/css">
</head>
<script>
	total("新闻中心新闻列表","news");	
</script>
<body>
<div id="center">
<div id="bg">	
	<?php 
	    include("inc/topbar.inc.php");
		include("inc/leftbar.inc.php");
		$dept_cate_id=$_REQUEST['id'];
		$dept_id = get_dept_info("电视新闻中心")->id;
		$news_list = get_dept_list('smg_news',$dept_cate_id,$dept_id);
		$count = count($news_list);
	?>
	<div id="content">
		<div id="titlebox">
			<a href="index.php">首页</a>
			-&nbsp<?php echo $news_list[0]->category_name;?>
		</div>
		<div id="text">
			<div id="title1">
				<?php echo $news_list[0]->category_name; ?>
			</div>
			<div id="title2">
				浏览量
			</div>
			<div id="title3">
				发布时间
			</div>
			<div id="tcd">
			 <?php
				for($i=0;$i<$count;$i++){?>
				<div class="title"><a href="news.php?id=<?php echo $news_list[$i]->id;?>" title="<?php $news_list[$i]->title;?>"><?php echo $news_list[$i]->short_title;?></a></div>
				<div class="count"><? echo $news_list[$i]->click_count;?></div>
				<div class="date"><? echo $news_list[$i]->created_at;?></div>
			<?php } ?>
			</div>
			<div id="page_sel">
				<?php paginate(); ?>
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
