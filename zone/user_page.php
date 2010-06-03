<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-首页</title>
	<? 	
		include 'helper/helper.php';
		css_include_tag('user_page','top','bottom','colorbox');
		use_jquery_ui();
		js_include_once_tag('total');
		include_once '../lib/xspace_api.php';
		include_once '../lib/uchome_api.php';
		$db=get_db();
		$user_id = intval($_COOKIE['smg_user_id']);
		if($user_id <= 0){
			alert('请先登录!');
			redirect('/login/login.php');
			die();
		}
		
		$items = get_user_models($user_id);
  ?>
<script>
	total("交流首页","zone");
</script>	
</head>
<body>
	<?php require_once('../inc/top.inc.html');
	js_include_once_tag('colorbox','zone_user_page');?>
	<div id="ibody">
		<div id="top_container"><a href="#" id="add_model">添加内容</a></div>
		<div id="left_container" class="sortable">
			<?php 
				foreach ($items as $item){
					if($item->pos_name == 'left_container')
					render_model($item);
				}
			?>
		</div>
		<div id="center_container" class="sortable">
			<?php 
				foreach ($items as $item){
					if($item->pos_name == 'center_container')
					render_model($item);
				}
			?>
		</div>
		
		<div id="right_container" class="sortable">
			<?php 
				foreach ($items as $item){
					if($item->pos_name == 'right_container')
					render_model($item);
				}
			?>
		</div>
	</div>
	
	<? require_once('../inc/bottom.inc.php');?>
</body>
</html>