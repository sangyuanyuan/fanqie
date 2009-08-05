<?php
	 require_once('../../frame.php');
	 $dept_cate_id=$_REQUEST['id'];
	 $c_name = dept_category_name_by_id($dept_cate_id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>精神文明办内网</title>
	<link href="jswmb.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id=jswm_body>
		<?php 
			include('inc/top.inc.php'); 
		 	include('inc/right.inc.php');
		?>
		<div id="titlebox">
			<a href="index.php">首页</a>
			-&nbsp<?php echo $c_name;?>
		</div>
		<div id="text">
			<div id="title1">
				<?php echo $c_name; ?>
			</div>
			<div id="title2">
				浏览量
			</div>
			<div id="title3">
				发布时间
			</div>
			<div id="tcd">
			 <?php
			 	$db = get_db();
				$sql = 'select * from smg_news where dept_category_id='.$dept_cate_id.' and is_dept_adopt=1 order by dept_priority,created_at desc';
				$news_list = $db->paginate($sql,25);
				$count = count($news_list);
				for($i=0;$i<$count;$i++){
			?>
				<div class="title"><a href="content.php?id=<?php echo $news_list[$i]->id;?>" title="<?php echo $news_list[$i]->title;?>">
					<?php echo $news_list[$i]->short_title?></a>
				</div>
				<div class="count"><? echo $news_list[$i]->click_count;?></div>
				<div class="date"><? echo $news_list[$i]->created_at;?></div>
			<?php } ?>
			</div>
		</div>
		
		<div id="page_sel">
			<?php paginate(); ?>
		</div>
			
		<? include('inc/bottom.inc.php'); ?>
	</div>
</body>
</html>
