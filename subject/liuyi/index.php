<?php require_once('../../frame.php'); 
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -六一快乐！</title>
	<?php css_include_tag('smg','top','bottom');
		js_include_once_tag('total');
	?>
	<STYLE type=text/css>
		a{text-decoration:none;color:black}
		img{border:0}
	</STYLE>
	<script>
	total("专题-六一儿童专题","other");
</script>
</head>
<body>
<?php 
include('../../inc/top.inc.html');
?>
<div id="bg" style="width:998px; height:1400px; margin:0 auto; margin-bottom:-15px; line-height:20px; background:url(image/liuyi_bg2.jpg)">
	<div id="top_title" style="width:998px; height:165px; margin:0 auto; background:url(image/top_title.jpg)"></div>
	<div id="top_word" style="width:998px; height:30px; margin:0 auto; margin-top:10px; color:red; font-size:20px; font-weight:bold; text-align:center;">番茄网祝所有小朋友节日快乐！</div>
	
	<div id="left_box" style="width:300px; height:300px; margin-left:25px; margin-top:30px; float:left; display:inline;">
		<div id="left_pic" style="width:300px; height:225px; float:left; display:inline;">
			<a target="_blank" href="video/liuyi.php"><img src="image/baby.jpg"></a>
		</div>
		<div id="left_word" style="width:300px; height:60px; margin-top:10px; font-size:14px; font-weight:bold; float:left; display:inline;">
			<a target="_blank" href="video/liuyi.php">宝宝永远是父母心中的最爱，六一儿童节就要来了，筒子快把自己可爱宝宝的DV秀传上来秀秀吧~还能获得番茄大礼包哦~~~</a>
		</div>
	</div>
	
	<div id="center_box" style="width:300px; height:300px; margin-left:24px; margin-top:30px; float:left; display:inline;">
		<div id="center_pic" style="width:300px; height:225px; float:left; display:inline;">
			<a target="_blank" href="http://meishi.enjoyoung.cn/home/children_festival"><img src="image/eat.jpg"></a>
		</div>
		<div id="center_word" style="width:300px; height:60px; margin-top:10px; font-size:14px; float:left; font-weight:bold; display:inline;">
			<a target="_blank" href="http://meishi.enjoyoung.cn/home/children_festival">生活时尚频道人气美食栏目特别推出“欢乐儿童节，快乐寻美食”专题活动，筒子们快来给自己的宝宝寻找精致的美味吧~~~~</a>
		</div>
	</div>
	
	<div id="rignt_box" style="width:300px; height:300px; margin-right:25px; margin-top:30px; float:right; display:inline;">
		<div id="right_pic" style="width:300px; height:225px; float:left; display:inline;">
			<a target="_blank" href="/fqtg/fqtglist.php?id=1"><img src="image/shop.jpg"></a>
		</div>
		<div id="right_word" style="width:300px; height:60px; margin-top:10px; font-size:14px; float:left; font-weight:bold; display:inline;">
			<a target="_blank" href="/fqtg/fqtglist.php?id=1">快来抢番茄儿童节大礼包啊~只要参加“番茄宝宝秀”、“番茄爱墙”的活动，就有可能获得番茄网送出的番茄大礼包，绝对好礼等你来拿~~~~</a>
		</div>
	</div>
	
	<div id="dividing" style="width:998px; height:24px; margin:0 auto; background:url(image/line.gif)">
	</div>
	
	<div id="bottom_title" style="width:400px; height:92px; margin:0 auto; margin-top:30px; background:url(image/bottom_title.jpg)">
	</div>
	
	<div id="bottom_word" style="width:800px; height:30px; color:red; margin:0 auto; margin-top:30px;font-size:14px; font-weight:bold; text-align:center;">
		<a target="_blank" href="lovewall/index.php?id=1" style="color:red">六一儿童节是孩子们的节日，更是父母对孩子表示浓浓的爱的节日，番茄网特别推出“番茄爱墙”大家快为自己的孩子送上祝福，记下浓浓的爱意吧~~~~
	</div>
	<div id="bottom_pic"  style="width:800px; height:582px; margin:0 auto; margin-top:30px; background:url(image/lovewall.jpg)">
		<a target="_blank" href="lovewall/index.php?id=1"><img src="image/lovewall.jpg"></a>
	</div>
</div>
<? include('../../inc/bottom.inc.html');
?>
</body>
</html>