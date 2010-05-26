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
		css_include_tag('user_page','top','bottom');
		use_jquery_ui();
		js_include_once_tag('zone_user_page','total');
		$db=get_db();
  ?>
<script>
	total("交流首页","zone");
</script>	
</head>
<body>
	<?php require_once('../inc/top.inc.html');?>
	<div id="ibody">
		<div id="top_container">添加内容</div>
		<div id="left_container" class="sortable">
			<div class="model_container">
				<div class="tool">
					<div class="model_name">上班这点事</div>
					<div class="remove"></div>
				</div>
				<div class="content">
				<?php 
					$sql="select n.id,n.short_title,n.title,n.platform,n.description from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name='上班这点事' and c.category_type='news' and is_recommend=1 order by n.priority asc,n.id desc limit 12";
					$sbzds=$db->query($sql);
					$sql="select src,url,title from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name='上班这点事' and c.category_type='picture' and is_recommend=1 order by i.priority asc,i.created_at desc limit 2";
					$sbzdsimg=$db->query($sql);
				?>
				</div>
			</div>
			<div class="model_container">
				<div class="tool">
					<div class="model_name">生活大杂烩</div>
					<div class="remove"></div>
				</div>
			</div>
			<div class="model_container">
				<div class="tool">
					<div class="model_name">观点视角</div>
					<div class="remove"></div>
				</div>
			</div>
		</div>
		<div id="center_container" class="sortable">
			<div class="model_container">
				<div class="tool">
					<div class="model_name">分享生活</div>
					<div class="remove"></div>
				</div>
			</div>
			<div class="model_container">
				<div class="tool">
					<div class="model_name">番茄家园</div>
					<div class="remove"></div>
				</div>
			</div>
		</div>
		
		<div id="right_container" class="sortable">
			<div class="model_container">
				<div class="tool">
					<div class="model_name">劲爆热图</div>
					<div class="remove"></div>
				</div>
			</div>
			<div class="model_container">
				<div class="tool">
					<div class="model_name">博主秀</div>
					<div class="remove"></div>
				</div>
			</div>
		</div>
	</div>
	
	<? require_once('../inc/bottom.inc.php');?>
</body>
</html>