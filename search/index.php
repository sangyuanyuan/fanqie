<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-普通子页</title>	
	<?php
	include_once "../frame.php";
	
	$db = get_db();
	css_include_tag('top','bottom','search/search','jquery_ui');

	?>
</head>
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
	<div id="left_box">
		<div id="search_box">
			<form id="search_form" method="get" action="">
			<b>搜索</b>
			<input type="text" name="key" id="search_text" value="<?php echo $_REQUEST['key'];?>" style="width:100px;">
			<select name="search_type" id="search_type">
				<option <?php if($_REQUEST['search_type'] == 'smg_news') echo ' selected="selected"';?> value="smg_news">新闻</option>
				<option <?php if($_REQUEST['search_type'] == 'smg_video') echo ' selected="selected"';?> value="smg_video">视频</option>
				<option <?php if($_REQUEST['search_type'] == 'smg_images') echo ' selected="selected"';?> value="smg_images">图片</option>
			</select>
			<?php
			$dept = $db->query("select * from smg_dept");			
			?>
			<select name="dept_id" style="width:80px;">
				<option value="0">部门</option>
				<?php foreach($dept as $v) { ?>
				<option value="<?php echo $v->id;?>" <?php if($v->id == $_REQUEST['dept_id']) echo ' selected="selected"';?>><?php echo $v->name;?></option>
				<?php } ?>
			</select>
			<span id="category"></span>
			时间:<input type="text" name="start_time" class="date_jquery" value="<?php echo $_REQUEST['start_time'];?>">
			-<input type="text" name="end_time" class="date_jquery" value="<?php echo $_REQUEST['end_time'];?>">
			<span id="submit">搜索</span>
			<input type="hidden" name="category_id" id="category_id" value="<?php echo $_REQUEST['category_id'];?>">
			</form>
		</div>
		<div id="search_result">
			<?php
				if($_REQUEST['search_type']){
					$dept_id = intval($_REQUEST['dept_id']);
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
		<div><?php paginate();?></div>
	</div>
	<div id="right_box" >
		<div id="search_top10"></div>
		<div id="top10_box">
			<?php
				$top = $db->query('select * from smg_search_keys order by search_count desc limit 10');
			?>
			<?php for($i=0;$i<10;$i++){?>
				<div class="top10_item"><div class="span_left"><?php echo $i+1 .'. <a href="?search_type=smg_news&key=' .$top[$i]->search_key .'">'.$top[$i]->search_key .'</a>';?></div><div class="span_right"><?php echo $top[$i]->search_count;?></div></div>
			<?php }?>
		</div>
	</div>
</div>
<?php include('../inc/bottom.inc.php');?>
</body>
</html>