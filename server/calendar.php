<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-生日</title>
	<? 	
		css_include_tag('server_calendar','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div class="l">
    		<div id="title"></div>
     	  <div id="menu">
     	  	<div id="menu1">我的生日</div>	
     	  	<div id="menu2">日历</div>
     	  	<div id=date>TODAY 2009-10-10</div>
     	  </div>
        <div id="month">
        	<a href="#"><img src="/images/server/btn2.jpg" width="30" height="20" border="0" /></a>
        	七月2009
        	<a href="#"><img src="/images/server/btn1.jpg" width="30" height="20" border="0" /></a> 
        </div>
        <div id="week">
          	<div class="weeks">星期天</div>
            <div class="weeks">星期一</div>
            <div class="weeks">星期二</div>
            <div class="weeks">星期三</div>
            <div class="weeks">星期四</div>
            <div class="weeks">星期五</div>
            <div class="weeks">星期六</div>
        </div>  
        <div id="context">
        	<?php for($i=0;$i<=5;$i++){?>
           	<div class="bg1"></div>
            <div class="bg2"></div>
            <div class="bg3"></div>
            <div class="bg4"></div>
            <div class="bg5"></div>
            <div class="bg6"></div>
            <div class="bg7"></div>       
     	   <? }?>
     	
        </div>
        
  </div>
  <div class="r"></div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
