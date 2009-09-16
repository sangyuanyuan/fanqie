<?php
	require_once('../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-寿星查询</title>
	<? 	
		css_include_tag('server_birthday','top','bottom');
		use_jquery();
		js_include_tag('total.js');
  ?>
	
</head>
<script>
	total("生日","server");
</script>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div class="l">
    	<div id="title"></div>
     	<div id="menu">
			<div id="menu2"><a href="birthday.php">我的生日</a></div>	
     		<div id="menu2"><a href="calendar.php">日历</a></div>
			<div id="menu2"><a href="today.php">今日寿星</a></div>			
			<div id="menu2"><a href="send_gift_list.php">送礼列表</a></div>
			<div id="menu2"><a href="birthday_top.php">寿星排行</a></div>
			<div id="menu1">寿星查询</div>		
     	</div>
  
        <div id="context">
        	<div style="margin-top:20px; float:left; display:inline;">
			<form action="birthday.post.php" method="post" id="form">
				请输入要查询的姓名或工号<input name=search type="text"><br><br>
				<input type="hidden" name="type" id="type">
				<button id="name">按姓名查询</button><button style="margin-left:10px;" id="number">按工号查询</button>
			</form>
			</div>
        </div>
        
  </div>
  <div class="r"></div>
</div>
<?php
	close_db();
	require_once('../inc/bottom.inc.php');
?>

</body>
</html>

<script>
	$(function(){
		$('button').click(function(){
			$('#type').attr('value',$(this).attr('id'));
			$('#form').submit();
		});
	});
</script>
