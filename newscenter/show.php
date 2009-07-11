<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>新闻中心内网</title>
<link href="css/list.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="center">
<div id="bg">	
	<?php 
		require_once('../frame.php');
		include("inc/topbar.inc.php");
		include("inc/leftbar.inc.php");
	?>
	
	<div id="content">
		<div id="titlebox">
			<a href="index.php">首页</a>
			-&nbsp我型我秀
		</div>
		<div id="text">
			<?php
				$picture = new table_class('smg_images');
				$records = $picture->show_content('电视新闻中心','我型我秀',10);
				$count = count($records);
	   	 	?>
	    	<?php for($i=0;$i<$count;$i++){?>         					
				<div class="show">
					<a target="_blank" href="/photo/showphoto.php?id=<? echo $records[$i]->id;?>"><img border="0" src="<? echo $records[$i]->src;?>" width="200" height="160"></a></br>
					<div style='width:200px; text-align:center; float:left;display:inline;'><a target="_blank" href="/photo/showphoto.php?id=<? echo $records[$i]->id;?>" style='font-size:15px;'><?php echo $records[$i]->title; ?></a></div>
				</div>
	 		<? }?>
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