<?php
	 require_once('../../frame.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻中心内网</title>
<link href="css/list.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="center">
<div id="bg">	
	<?php 
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
				$dept_id = get_dept_info('电视新闻中心')->id;
				$category_id = dept_category_id_by_name('我型我秀','电视新闻中心','picture');
				$db = get_db();
				$sql = 'select * from smg_images where dept_id='.$dept_id.' and dept_category_id='.$category_id;
				$records = $db->query($sql);
				$count = count($records);
	   	 	?>
	    	<?php for($i=0;$i<$count;$i++){?>         					
				<div class="show" style="margin-left:50px;">
					<a target="_blank" href="/show/show.php?id=<? echo $records[$i]->id;?>"><img border="0" src="<? echo $records[$i]->src;?>" width="200" height="160"></a></br>
					<div style='width:200px; text-align:center; float:left;display:inline;'><a target="_blank" href="/show/show.php?id=<? echo $records[$i]->id;?>" style='font-size:15px;'><?php echo $records[$i]->title; ?></a></div>
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