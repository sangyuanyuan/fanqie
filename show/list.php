﻿<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-列表</title>
	<? 	
		css_include_tag('show_list');
		css_include_tag('top');
		css_include_tag('bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	 <div id=ibody_left>
     <!-- start left_top !-->
 	 	 <div id=l_t>
 	 	 		<img src="/images/2.jpg">
 	 	 </div>
 	   <!-- end -->
 	 
     <!-- start left_middle !-->
 	 	 <div id=l_m>
 	 	 		<img src="/images/3.jpg">
 	 	 </div>
 	   <!-- end -->
 	   
     <!-- start left_bottom !-->
 	 	 <div class=l_b>
 	 	 </div>
 	   <!-- end --> 	   
 	   
     <!-- start left_bottom !-->
 	 	 <div class=l_b>
 	 	 </div>
 	   <!-- end --> 	
 	 </div>
	 <div id=ibody_right>
     <!-- start right !-->
 	 	 <div id=r>
 	 	 </div>
 	   <!-- end --> 		 	
	 </div>  	 
 
</div>
<? require_once('../inc/bottom.inc.php');?>


</body>
</html>