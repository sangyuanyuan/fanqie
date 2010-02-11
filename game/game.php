<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -FLASH游戏</title>
	<?php
  	require_once('../frame.php');
   	css_include_tag('smg','top','bottom');
		js_include_once_tag('flash');
	?>
	<script  language="javascript">    
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
 		<span style="width:995px; color:red; font-size:20px; font-weight:bold;">游戏结束后，如果您对自己的成绩够满意的话 ，请在游戏下方提交您的姓名和联系电话！只要提交就有礼品送哦！！</span><br>
 		<embed src="flash.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="650" height="600">
 			</embed><br><span style="font-weight:bold;">说明：鼠标控制，按住左键续力，松开发射，只能打老虎，如果打到人就会被扣分，注意。</span>
 		</div>
		<form name="flash" method="post" action="flash.post.php"> 
   	<div id=content9 style="width:995px;">
	   	<input type="hidden" id="score" name="score"/>
	   	 姓名：<input type="text" id="playname" name="playname"><br><br>
	   	 电话：<input type="text" id="phone" name="phone"><br><br>  	   	
	   </div> 
	   <div class=content11 onclick="check();" >
	   		提　交
	   	</div> 
	   	<div class=content11 onclick="chakan();" >
	   		查　看
	   	</div>
	  </form>
	</div>
<? include('../inc/bottom.inc.html');
?>	
</body>
</html>
