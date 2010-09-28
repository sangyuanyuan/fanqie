<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -FLASH游戏</title>
	<?php
  	require_once('../frame.php');
  	use_jquery();
   	css_include_tag('smg','top','bottom');
		js_include_once_tag('flash','total');
		session_start();
		setsession($_SERVER['HTTP_HOST']);
	?>
	<script  language="javascript">   
		total("FLASH游戏","subject"); 
		function score(var1)    
		{ 
			document.getElementById('score').value=var1;		
		}
		function paiming()    
		{ 
			window.open('/game/flashview.php');
		}
	</script> 
</head>
<body>
<? include('../inc/top.inc.html');?>
<div id=bodys>
 <div id=fl_left style="width:995px;">
 	<div id=content1 style="width:995px;">
 		<a href="/">首页</a>　>　FLASH游戏
 	</div>
 	<div style="width:995px; line-height:25px; margin-top:10px; text-align:center; float:left; display:inline;">
 		<span style="width:995px; color:red; font-size:20px; font-weight:bold;">游戏结束后，如果您对自己的成绩够满意的话 ，请在游戏下方提交您的姓名和联系电话！分数前三名有礼品送哦！！</span><br>
 		<embed src="test.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="650" height="600">
 			</embed><br><span style="font-weight:bold;">说明：结束游戏后请<span style="color:red;">点击“再来一次”</span>才能记录到您的成绩，当您填写完下面的姓名和电话并提交时，我们会记录您本次游戏中的最好成绩。</span>
 		</div>
		<form name="flash" method="post" action="flash.post.php" target="_blank"> 
   	<div id=content9 style="width:995px;">
	   	<input type="hidden" id="score" name="score"/>
	   	 姓名：<input type="text" id="playname" name="playname"><br><br>
	   	 电话：<input type="text" id="phone" name="phone"><br><br>  	   	
	   </div> 
	   <div class=content11 onclick="check();" style="cursor:pointer">
	   		提　交
	   	</div> 
	   	<div class=content11 onclick="chakan();" style="cursor:pointer" >
	   		排　行
	   	</div>
	  </form>
	</div>
<? include('../inc/bottom.inc.html');
?>	
</body>
</html>
