<?
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG - 三项教育 - 群英汇</title>
	<?php css_include_tag('qyh','qyh_top','qyh_bottom');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("专题-群英汇","other");
</script>
</head>
<body>
	<div id=ibody>	
		<?php include('inc/top.inc.php');?>
			<div id=qyh_index>
				<div id=index_top>
					<div class=index_t_title>风云英雄榜</div>
					<div id=t_l_pic>
						<a target="_blank" href=""><img border=0 src="images/one.jpg"></a>	
					</div>
					<div class=t_r_pic>
						<div class="t_r_picimg"><a target="_blank" href=""><img border=0 src="images/two.jpg"></a></div>
						<div class="t_r_picimg" style="margin-left:38px;"><a target="_blank" href=""><img border=0 src="images/two.jpg"></a></div>
						<div class="t_r_picimg" style="margin-left:32px;><a target="_blank" href=""><img border=0 src="images/two.jpg"></a></div>
						<div class="t_r_pictitle"><a target="_blank" href="">长江韬奋奖 袁雷</a></div>
						<div class="t_r_pictitle" style="margin-left:38px;"><a target="_blank" href="">长江韬奋奖 袁雷</a></div>
						<div class="t_r_pictitle" style="margin-left:32px;><a target="_blank" href="">长江韬奋奖 袁雷</a></div>
					</div>
					<div class=t_r_pic>
						<div class="t_r_picimg"><a target="_blank" href=""><img border=0 src="images/two.jpg"></a></div>
						<div class="t_r_picimg" style="margin-left:38px;"><a target="_blank" href=""><img border=0 src="images/two.jpg"></a></div>
						<div class="t_r_picimg" style="margin-left:32px;><a target="_blank" href=""><img border=0 src="images/two.jpg"></a></div>
						<div class="t_r_pictitle"><a target="_blank" href="">长江韬奋奖 袁雷</a></div>
						<div class="t_r_pictitle" style="margin-left:38px;"><a target="_blank" href="">长江韬奋奖 袁雷</a></div>
						<div class="t_r_pictitle" style="margin-left:32px;><a target="_blank" href="">长江韬奋奖 袁雷</a></div>
					</div>
					<div class=index_t_title>群英汇介绍</div>
					<div id=t_l_content><a target="_blank" href="">名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍名人堂介绍人堂介绍名人堂介绍人堂介绍名人堂介绍</a></div>
				</div>
				<div id=index_mid_l>
					<div id=title>心灵之光</div>
					<?php for($i=0;$i<6;$i++){ ?>
						<div class=m_l_content>
							<div class=pic><a target="_blank" href=""><img border=0 src="images/three.jpg"></a></div>
							<div class=piccontent><a target="_blank" href="">德艺双馨  骆新</a><br><a target="_blank" href="">留言留言留言留言留言</a></div>
							<div class=ly><a target="_blank" href="">[欢迎留言]</a></div>
						</div>
					<?php } ?>
				</div>
				<div id=index_mid_r_t>
					<div id=title>
						<div id=wz>对话群英</div>
						<div id=more><a target="_blank" href="">>> 进入留言板</a></div>
					</div>
					<div class=pic>
						<a target="_blank" href=""><img border=0 src="images/four.jpg"></a>	
					</div>
					<div id=dialogname>
						<div class=name style="height:31px; background:url('images/index_r_t_bg.jpg') no-repeat; line-height:31px;"><a style="color:#ab6821;" href="">骆新</a></div>
						<div class=name><a href="">骆新</a></div>
						<div class=name><a href="">骆新</a></div>
						<div class=name><a href="">骆新</a></div>
						<div class=name><a href="">骆新</a></div>
					</div>
				</div>
				<div id=index_mid_r_b><a target="_blank" href=""><img border=0 src="images/index_m_r_b.jpg"></a></div>
				<div id=index_b1>
					<div id=title>群英闪烁</div>
					<?php for($i=0;$i<5;$i++){ ?>
						<div class=pic><a target="_blank" href=""><img border=0 src="images/five.jpg"></a></div>
					<?php } ?>
					<div id=jiangxiang>
						<div class=jx>
							<div class=wz><a href="">长江韬奋奖</a></div>
						</div>
						<div class=jx>
							<div class=wz><a href="">长江韬奋奖</a></div>
						</div>	
						<div class=jx>
							<div class=wz><a href="">长江韬奋奖</a></div>
						</div>	
						<div class=jx>
							<div class=wz><a href="">长江韬奋奖</a></div>
						</div>
					</div>
				</div>
				<div class=index_b_l>
					<div class=title>群英们的故事</div>
					<div class=content_l>
						<div class=pic><a target="_blank" href=""><img border=0 src="/subject/qyh/images/six.jpg"></a></div>
						<div class=piccontent><a target="_blank" href="">全国德艺双馨电视艺术工作者骆新、全国暨上海优秀新闻工作者王勇获表彰喜逐颜开</a></div>	
					</div>
					<div class=content_r>
						<?php for($i=0;$i<6;$i++){ ?>
						<div class=b_l_c>
							<div class=pic><a target="_blank" href=""><img border=0 src="images/three.jpg"></a></div>
							<div class=piccontent><a target="_blank" href="">“金帆奖”、“金鹿奖”获奖代表颁奖</a></div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class=index_b_r>
					<div class=title>奖项介绍</div>
					<div class=content>
						<?php for($i=0;$i<12;$i++){ ?>
						<div class=cl><a href="">·全国长江韬奋奖</a></div>
						<?php } ?>
					</div>
				</div>
				<div class=index_b_l>
					<div class=title>群英们的足迹</div>	
						<div class=content_l>
						<div class=pic><a target="_blank" href=""><img border=0 src="/subject/qyh/images/six.jpg"></a></div>
						<div class=piccontent><a target="_blank" href="">全国德艺双馨电视艺术工作者骆新、全国暨上海优秀新闻工作者王勇获表彰喜逐颜开</a></div>	
					</div>
					<div class=content_r>
						<?php for($i=0;$i<6;$i++){ ?>
						<div class=b_l_c>
							<div class=pic><a target="_blank" href=""><img border=0 src="images/three.jpg"></a></div>
							<div class=piccontent><a target="_blank" href="">“金帆奖”、“金鹿奖”获奖代表颁奖</a></div>
						</div>
						<?php } ?>
					</div>
				</div>
				
				<div class=index_b_r>
					<div class=title>相关视频</div>
					<div class=content>
						<?php for($i=0;$i<12;$i++){ ?>
						<div class=cl><a href="">·全国长江韬奋奖</a></div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php include('inc/bottom.inc.php');?>
	</div>
</body>
</html>

