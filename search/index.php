<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-搜索</title>	
	<?php
	include_once "../frame.php";
	
	$db = get_db();
	css_include_tag('top','bottom','search/search','jquery_ui');
	js_include_tag('total.js');
	?>
</head>
<script>
	total("搜索","news");
</script>
<body>
<?php include('../inc/top.inc.html');
	use_jquery_ui();
	js_include_tag('smg_category_class.js','search');
	$category = new smg_category_class('news');
	$category->echo_jsdata('news_category');
	$category = new smg_category_class('video');
	$category->echo_jsdata('video_category');
	$category = new smg_category_class('picture');
	$category->echo_jsdata('image_category');

?>	
<div id="ibody">
		<div id="search_box">
			<form id="search_form" method="get" action="">
				<br>
			　<input type="text" name="key" id="search_text" value="<?php echo $_REQUEST['key'];?>" style="width:200px;">
			<select name="search_type" id="search_type" style="width:100px;">
				<option <?php if($_REQUEST['search_type'] == 'smg_news') echo ' selected="selected"';?> value="smg_news">新闻</option>
				<option <?php if($_REQUEST['search_type'] == 'smg_video') echo ' selected="selected"';?> value="smg_video">视频</option>
				<option <?php if($_REQUEST['search_type'] == 'smg_images') echo ' selected="selected"';?> value="smg_images">图片</option>
			</select>
			<?php
			$dept = $db->query("select * from smg_dept");			
			?>
			<select name="dept_id" style="width:100px;">
				<option value="0">部门</option>
				<?php foreach($dept as $v) { ?>
				<option value="<?php echo $v->id;?>" <?php if($v->id == $_REQUEST['dept_id']) echo ' selected="selected"';?>><?php echo $v->name;?></option>
				<?php } ?>
			</select>
			<span id="category"></span>
			　时间　<input type="text" name="start_time" disable="disableed" class="date_jquery" value="<?php echo $_REQUEST['start_time'];?>"  style="width:100px;">
		　-　<input type="text" name="end_time" class="date_jquery" value="<?php echo $_REQUEST['end_time'];?>"  style="width:100px;">
			 　<input type="submit" id="submit" style="width:100px; height:22px;" value="搜索">
			<input type="hidden" name="category_id" id="category_id" value="<?php echo $_REQUEST['category_id'];?>">
			</form>
		</div>
		<div id="search_result">
			<?php
				if($_REQUEST['search_type']){
					$dept_id = intval($_REQUEST['dept_id']);
					$c[] = "is_adopt=1";
					if($dept_id > 0){
						$c[] = 'dept_id=' .$dept_id;
					}
					$category_id = intval($_REQUEST['category_id']);
					if($category_id > 0){
						$c[] = 'category_id=' .$category_id;
					}
					$start_time = $_REQUEST['start_time'];
					if($start_time){
						$c[] = "created_at >='" .$start_time ."'";
					}
					$end_time = $_REQUEST['end_time'];
					if($end_time){
						$c[] = "created_at <='" .$end_time ."'";
					}
					if($c) 	$conditions = implode(' and ' ,$c);
					$items = search_content($_REQUEST['key'],$_REQUEST['search_type'],$conditions,20);
				}
				if($items){
					if($_REQUEST['search_type'] == 'smg_news'){
						$url = '/news/news/news.php?id=';
					}
					if($_REQUEST['search_type'] == 'smg_video'){
						$url = '/show/video.php?id=';
					}
					if($_REQUEST['search_type'] == 'smg_images'){
						$url = '/show/show.php?id=';
					}
					foreach ($items as $v) { 					
					?>
					<li><a href="<?php echo $url .$v->id;?>" target="_blank"><?php echo $v->title;?></a>  <span><?php echo $v->created_at;?></span></li>
				<?php	}
				}
			?>
		</div>
		<div id=page><?php paginate();?></div>
</div>
<?php include('../inc/bottom.inc.php');?>
</body>
</html>
