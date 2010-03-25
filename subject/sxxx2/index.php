<?
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -三项教育首页</title>
	<?php css_include_tag('sxxx2');
		use_jquery();
		js_include_once_tag('dj','total');
	?>
<script>
	total("专题-三项学习教育","news");
</script>
</head>
<body>
<div id=bodys>
	<div id=logo><embed src="sxxx.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="1000" height="150"></embed></div>
	<div id=title>
		<div class=cl><a target="_blank" href="#">首页</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="#">报告团</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="#">群英连</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="#">学习营</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="#">交流班</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="#">最新动态</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="#">学习热点</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="#">案例提示</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="#">规章制度</a></div>
		<div class=sx></div>
		<div class=cl><a target="_blank" href="#">学习热度</a></div>
	</div>
	<?php 
  	$db=get_db();
  	$pic=$db->query('select n.photo_src,i.category_id as cid,n.id,n.short_title from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="活动剪影" order by i.priority asc, n.created_at');
  	$fcontent = '<?xml version="1.0" encoding="utf-8" ?><URL>';  
		     
		   for($i=0;$i<count($pic);$i++){  //循环生成节点，如果数据库调用出来就改这里
		   
		   $fcontent=$fcontent."<Image_Information><img_name>".mb_substr(strip_tags($pic[$i]->short_title),0,9,"utf-8")."</img_name>";
		   $fcontent=$fcontent."<img_link>/news/news/news.php?id=".$pic[$i]->id."</img_link>";
		   $fcontent=$fcontent."<thumb_image>".$pic[$i]->photo_src."</thumb_image></Image_Information>";
	  }
	  $fcontent = $fcontent."</URL>";
	  $filename = 'imglink.xml';
		$handle=fopen($filename,"wt");
		fwrite($handle,$fcontent);
		fclose($handle);
	?>
	<div id=flash><embed src="gallery.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="1000" height="256"></embed></div>
	<div id=zxdt>
		<div id=content>
			<?php for($i=0;$i<3;$i++){ ?>
				<div class=context>
					<?php for($j=0;$j<3;$j++){ ?>
						<div class=cl><a target="_blank" href="">·每日经济:小桔灯百万元图小桔灯百万万元图小桔灯</a></div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>	
	</div>
	<div id=i_m1>
		<div id=c_l>
			<div class=c_title1>
				<div class=wz><img src="/images/sxxx/1.gif"></div>
				<div class=more><a href="">more>></a></div>
			</div>
			<div id=video>
				<?php show_video_player('253','200',$record[0]->video_photo_src,$record[0]->video_src); ?>	
			</div>
			<div id=c_l_title><a target="_blank" href="">福建原社区医生校门口砍杀</a></div>
			<div id=c_l_content><a target="_blank" href="">感谢各位朋友对于小桔灯活动的关注，如果您位朋友对于小桔灯活动的关各位朋友对于小桔灯活动的关注，如果您注，如果您知道有学校需要帮助...</a></div>
			<div id=dash></div>
			<?php for($i=0;$i<3;$i++){ ?>
				<div class=cjlj><a target="_blank" href="">每日经济:小桔灯百万元图小桔灯百万万元图小桔灯</a></div>
			<?php } ?>
		</div>
		<div id=c_r>
			<div class=c_title1>
				<div class=wz><img src="/images/sxxx/2.gif"></div>
				<div class=more><a href="">more>></a></div>
			</div>
			<div id=c_r_t>
				<div id=c_r_t_l>
					<a target="_blank" href=""><img border=0 src="/images/sxxx/c_r_t_l.jpg" /></a>
				</div>
				<div id=c_r_t_r>
					<div id=c_r_t_r_title><a target="_blank" href="">提供捐助信息</a></div>
					<div id=c_r_t_r_content><a target="_blank" href="">感谢各位朋友对于小桔灯活动的关注，如果您知道有学校需要帮助感谢各位朋友对于小桔灯活动的关注，如果您知道有学校需要帮助感谢各位朋友对于小桔灯活动的关注，如果您知道有学校需要帮助...</a></div>	
				</div>
			</div>
			<div id=dash></div>
			<div id=c_r_b>
				<?php for($i=0;$i<5;$i++){ ?>
				<div class=cl><a target="_blank" href="">·新华网:小桔灯万元图小桔灯百万万元图小桔灯百万关注流注流注流动人口子女</a></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div id=i_m2>
		<div id=c_l>
			<div class=c_title1>
				<div class=wz><img src="/images/sxxx/3.gif"></div>
				<div class=more><a target="_blank" href="">more>></a></div>
			</div>
			<div id=q_title><a target="_blank" href="">提供捐助信息</a></div>
			<div id=q_time>发布时间：</div>
			<div id=q_content><a target="_blank" href="">提供捐助信息提供捐助信息提供捐助信息提供捐助信息</a></div>
			<div id=dash></div>
			<div id=answer><a target="_blank" href="">提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息提供捐助信息</a></div>
		</div>
		<div id=c_r>
			<div class=c_title1>
				<div class=wz><img src="/images/sxxx/4.gif"></div>
				<div class=more><a target="_blank" href="">more>></a></div>
			</div>
			<div id=c_r_l>
				<div id=c_r_t_l>
					<a target="_blank" href=""><img border=0 src="/images/sxxx/c_r_t_l.jpg" /></a>
				</div>
				<div id=c_r_t_r>
					<div id=c_r_t_r_title><a target="_blank" href="">提供捐助信息</a></div>
					<div id=c_r_t_r_content><a target="_blank" href="">感谢各位朋友对于小桔灯活动的关注，友对于小桔灯活动的关注，如果您知道有学校需要帮助感谢各...</a></div>	
				</div>
				<div id=c_r_b>
					<?php for($i=0;$i<5;$i++){ ?>
					<div class=cl><a target="_blank" href="">·网易:10万元图小桔灯百万万元图小桔灯百万</a></div>
					<?php } ?>
				</div>
			</div>
			<div id=sx_dash></div>
			<div id=c_r_r>
				<?php for($i=0;$i<11;$i++){ ?>
				<div class=cl><a target="_blank" href="">·天天新报:青年作万元图小桔</a></div>
				<?php } ?>
			</div>
		</div>	
	</div>
	<div id=ibottom>
		<div id=i_b1>
			<div class=b_title>
				<div class=wz>学习热点</div>
				<div class=more><a target="_blank" href="">more>></a></div>	
			</div>
			<div class=b_l>
				<a target="_blank" href=""><img border=0 src="/images/sxxx/c_r_t_l.jpg" /></a>
			</div>
			<div class=b_r>
				<div class=b_r_title><a target="_blank" href="">提供捐助信息</a></div>
				<div class=b_r_content><a target="_blank" href="">感谢各位朋友对于小桔灯活动的关注，如果您知道有学校需要帮助感谢各位朋友对于小桔灯活动的关注，如果您知道有学校需要帮助感谢各位朋友对于小桔灯活动的关注，如果您知道有学校需要帮助...</a></div>	
			</div>
			<?php for($i=0;$i<5;$i++){ ?>
			<div class=b_b><a target="_blank" href="">·网易:10万元图小桔灯百万万元图小桔灯百万</a></div>
			<?php } ?>
		</div>
		<div id=i_b2>
			<div class=b_title>
				<div class=wz>案例提示</div>
				<div class=more><a target="_blank" href="">more>></a></div>	
			</div>
			<?php for($i=0;$i<11;$i++){ ?>
			<div class=b_b><a target="_blank" href="">·网易:10万元图小桔灯百万万元图小桔灯百万</a></div>
			<?php } ?>
		</div>
		<div id=i_b3>
			<div class=b_title>
				<div class=wz>规章制度</div>
				<div class=more><a target="_blank" href="">more>></a></div>	
			</div>
			<?php for($i=0;$i<11;$i++){ ?>
			<div class=b_b><a target="_blank" href="">·网易:10万元图小桔灯百万万元图小桔灯百万</a></div>
			<?php } ?>
		</div>
		<div id=i_b4>
			<div id=b_title1>
				<div class=wz>学习热度</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
