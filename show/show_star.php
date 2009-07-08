<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-每日之星</title>
	<? 	
		css_include_tag('show_star','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>	
 	  <div id=ibody_left>
 	  	<div class=l_m>
			<div class=title><div class=left>每日之星排行榜</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
			<? for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="#"><img border=0 width=40 height=40 src=""></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="#">test</a></div>
						<div class=bottom><a target="_blank" href="#">test</a></div>
					</div>
				</div>
			<? }?>
		</div>
 	  	
		<div class=l_m>
			<div class=title><div class=left>视频排行榜</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
			<? for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="#"><img border=0 width=40 height=40 src=""></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="#">test</a></div>
						<div class=bottom><a target="_blank" href="#">test</a></div>
					</div>
				</div>
			<? }?>
		</div>
		<div class=l_m>
			<div class=title><div class=left>我型我秀排行榜</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
			<? for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="#"><img border=0 width=40 height=40 src=""></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="#">test</a></div>
						<div class=bottom><a target="_blank" href="#">test</a></div>
					</div>
				</div>
			<? }?>
		</div>
		
	  </div>
	  <div id=ibody_right>
	  	
	  </div>

</div>
<? require_once('../inc/bottom.inc.php');?>


</body>
</html>