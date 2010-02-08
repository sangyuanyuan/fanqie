<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-专题-华人群星</title>
  <link href="css.css" rel="stylesheet" type="text/css">
  <?php 
  	require_once('../../frame.php');
  	use_jquery();
  	js_include_once_tag('total');
  ?>
	<script>
		total("2010群星新春大联欢","other");
	</script>
</head>
<body>
<div id=ibody>
	<?php $db=get_db(); ?>
	<div id=top3></div>
	<div id=top4></div>
	<div id=top5>
		<div id="top5-left">
			<div id="t5_l_t">
				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<div id="focus_02"></div> 
					<script type="text/javascript"> 
					var pic_width1=318; //图片宽度
					var pic_height1=200; //图片高度
					
					<?php
						$gd=$db->query('select * from smg_news where category_id=188 and is_adopt=1 order by priority asc,created_at desc;');
						for($i=0;$i<count($gd);$i++){
							$picsurl[]=$gd[$i]->photo_src;
							$picslink[]='/news/news/news.php?id='.$gd[$i]->id;
							$picstext[]=$gd[$i]->short_title;
						}
					?>
					var pics1=<?php echo '"',$picsurl,'"'?>;
					var mylinks1=<?php echo '"',$picslink,'"'?>;
					var texts1=<?php echo '"',$picstext,'"'?>;			
								
					var picflash = new sohuFlash("/flash/focus.swf", "focus_02", "318", "200", "4","#FFFFFF");
					picflash.addParam('wmode','opaque');
					picflash.addVariable("picurl",pics1);
					picflash.addVariable("piclink",mylinks1);
					picflash.addVariable("pictext",texts1);				
					picflash.addVariable("pictime","5");
					picflash.addVariable("borderwidth","318");
					picflash.addVariable("borderheight","200");
					picflash.addVariable("borderw","false");
					picflash.addVariable("buttondisplay","true");
					picflash.addVariable("textheight","15");				
					picflash.addVariable("pic_width",pic_width1);
					picflash.addVariable("pic_height",pic_height1);
					picflash.write("focus_02");				
					</script>
			</div>
			<?php $video=$db->query("select * from smg_video where category_id=187 and is_adopt=1 order by priority asc,created_at desc"); ?>
			<div id="t5_l_b"><?php show_video_player('318','225',$video[0]->photo_url,$video[0]->video_url); ?></div>
		</div>
		<div id="top5-center">	
			<?php $record=$db->query('select * from smg_news where category_id=183 and is_adopt=1 order by priority asc,created_at desc');
				for($i=0;$i<count($record);$i++)
				{
			?>	
			<div class="table">	
				<ul class="tent">
					<li><a href="" class="title"><?php echo mb_substr(strip_tags($record[$i]->content),0,54,"utf-8")."......";?><a href="" class="important">详细</a></li>
				</ul>
			</div>
			<?php } ?>
			
		</div>
		<div id="top5-right">
			<div class=content>
				<div class=wicker>
					<div class=title>节目信息</div>	
				</div>
				<div style="margin-top:5px; margin-left:4px;">
					<ul>
						<li class="mark">2010年2月14日 正月初一 19:30</li>
						<li class="mark">播出:东方卫视 新浪网 SMGBB官方网站</li>
					</ul>
				</div>
			</div>
			<div class=content style="margin-top:10px;">
				<div class=wicker>
					<div class=title>投票</div>
				</div>
				<div style="margin-top:5px; margin-left:4px;">
					<?php 
						$vote = new smg_vote_class();
						$vote->find(298);
						$vote->display();
					?>	
				</div>
			</div>
			<div class=content style="margin-top:10px;">
				<div class=wicker>
					<div class=title>主题曲</div>
				</div>
				<div style="margin-top:5px; margin-left:4px;">
					
				</div>
			</div>
			
		</div>
	</div>
	<div id=top6>
		<div class=wicker>
			<div class=title>录制图片</div>	
		</div>
		<div class="picture">
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
		</div>
		<div class="picture">
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id=top6>
		<div class=wicker>
			<div class=title>花絮照片</div>
		</div>
		<div class="picture">
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
		</div>
		<div class="picture">
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id=top6>
		<div class=wicker>
			<div class=title>明星定妆照</div>	
		</div>
		<div class="picture">
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
		</div>
		<div class="picture">
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
			<div class="imgPlace">
				<img width=170 height=120 src="example.jpg"></img>
				<ul class="tent">
					<li><a href="" class="nor">成龙</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>