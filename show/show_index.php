<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-我型我秀主页</title>
	<? 	
		css_include_tag('show_show_index','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	 <div id=ibody_top>
	 	  <div id=t_l>
	  		<?php for($i=0; $i<12;$i++){ ?>
				<img border=0 width=114 height=75 src="">
			  <?php }?>
	 	  </div>
	 		<div id=t_r><img border=0 src="/images/pic/wxwxtr.jpg"></div>
	 </div>	
	 <div id=ibody_left>
	 	  <div id=l_t>
	 	  		<div id=top><img src="/images/show/show_index_l_t.jpg">　公告</div>
	 	  </div>
		  	<a target="_blank" href="#"><img border=0 src="/images/show/show_l_t.jpg"></a>
			<div class=l_m>
				<div class=title><div class=left>热门标签</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
				<div class=content style="border-bottom:none;"></div>
			</div>
			<a target="_blank" style="margin-left:5px;" href="#"><img border=0 width=140 height=70 src=""></a><a style="margin-left:5px;" target="_blank" href="#"><img border=0  width=140 height=70 src=""></a>
			<a target="_blank" style="margin-left:5px;" href="#"><img border=0  width=140 height=70 src=""></a><a style="margin-left:5px;" target="_blank" href="#"><img border=0  width=140 height=70 src=""></a>
		  	<div class=l_m>
				<div class=title><div class=left>用户排行榜</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
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
		  	<div id=r_t>
		  		<div class=left>边走边播</div>
				<div class=more><a target="_blank" href="#">更多</a></div>
		  	</div>
			<?php for($i=0;$i<24;$i++){ ?>
				<div class=r_b>
					<a target="_blank" href="#"><div class=pic><img border=0 width=130 height=85 src=""></div></a><br>
					<a target="_blank" href="#">少年大清差</a><br>
					<a style="color:#FF9900; text-decoration:none;" target="_blank" href="#">[电视剧/大陆喜剧]</a>
				</div>
			<?php } ?>
		</div>

</div>
<? require_once('../inc/bottom.inc.php');?>


</body>
</html>