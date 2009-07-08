<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-视频子页</title>
	<? 	
		css_include_tag('show_video','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	  <div id=ibody_t>
	  	<div id=ibody_t_l></div>
		<div id=ibody_t_c><img src="/images/pic/show_video.jpg"></div>
		<div id=ibody_t_r></div>
	  </div>
	  <div id=#ibody_b>
	 	  <div id=ibody_left>
	 	  	<div id=l_t>
	 	  		<div id=content></div>
	 	  	</div>
			<div id=l_b>
				<div id=content></div>
				<div id=backtop><a target="_blank" href="#">↑ 返回顶部</a></div>
			</div>
		  </div>
			
		  <div id=ibody_right>
		  	<?php for($i=0;$i<2;$i++){?>
			  	<div class=r_t>
			  		<div class=content></div>
			  	</div>
			<?php }?>
		  </div>
	  </div>

</div>
<? require_once('../inc/bottom.inc.php');?>


</body>
</html>