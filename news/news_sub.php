<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-我要报料</title>
	<? 	
		css_include_tag('news_sub','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<form id="news_add" name="news_add" enctype="multipart/form-data" action="news.post.php" method="post">
	<div class=title>我要报料</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　部门</div>
		<div class=t_r>
			<select id=select name="news[dept_id]">
				<?php 
				$sql="SELECT * FROM smg_dept";
				$db = get_db();
				$dept=$db->query($sql);
				for($i=0;$i<count($dept);$i++){ ?>
					<option <?php if($i==6){?>selected=selected<?php } ?> value="<?php echo $dept[$i]->id;?>" ><?php echo $dept[$i]->name;?></option>
				<?php }?>
			</select>
		</div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　工号</div>
		<div class=t_r><input type="text" name="news[publisher_id]"></div>
	</div>
	<div class=t>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　标题</div>
		<div class=t_r><input type="text" name="news[title]"></div>
	</div>
	<div id=m>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　内容</div>
		<div id=m_r><?php show_fckeditor('news[content]','Admin',true,"270","750");?></div>
	</div>
	<div class=title>视频上传</div>
	<div id=b>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　视频照片</div>
		<div class=t_r>
			<input type="file" name="video_pic" id="video_pic">
		</div>
		<div class=l><img src="/images/news/news_sub_icon.jpg">　选择视频</div>
		<div class=t_r>
			<input type="file" name="video_src" id="video_src">
		</div>
	</div>
	<div id=b_button>
			<button onclick="tj()">提　交</button>
	</div>
	</form>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
<script>
	function tj(){ document.news_add.submit();}
</script>