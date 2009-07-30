<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -学习园地</title>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php	
	include('../inc/top.inc.html');
	require_once('../inc/define.inc.php');
	require_once('../libraries/sqlrecordsmanager.php');
	
	$sqlmanager = new SqlRecordsManager();
		
	?>
	<div id=le_body>
		<div id=le_left>
			<? 
			$zbtj = $sqlmanager->GetRecords('select * from smg_news where isadopt = 1 and main_cate_id =' .$zhongbangtuijian_id .' order by priority asc,pubdate desc',1,6);
			for($i=1;$i < 3 && $i<count($zbtj);$i++){?>
			<div class=top>
				<a href="/news/news.php?id=<?php echo $zbtj[$i]->id;?>"><?php echo $zbtj[$i]->title;?></a>
				<div class=clickrate>点击率：<?php echo $zbtj[$i]->clickcount;?></div>
			</div>
			<? }?>
			<? for($i=3;$i<count($zbtj);$i++){?>
			<div class=middle>
				<a href="/news/news.php?id=<?php echo $zbtj[$i]->id;?>"><?php echo $zbtj[$i]->title;?></a>
			</div>
			<? }?>
			<div class=middle>
				<div id=more><a href="/news/newslist.php?id=<?php echo $zhongbangtuijian_id;?>">更多...</a></div>
			</div>
			<div id=bottom>
				<a href="">生活这点事</a><a href="">博客</a><a href="">论坛</a>
			</div>
		</div>
		<div id=le_right>
			<div id=top>
			  <?php
			  //获得重磅推荐的图片
			  if ($zbtj[0]->isphotonews)
			  {
			  	$pic = $zbtj[0]->photourl;
			  }else 
			  {
			  	$pics = $sqlmanager->GetRecords('select * from smg_photo where isadopt = 1 and main_cate_id=' .$zhongbangtuijian_pic_id .' order by priority asc, createtime desc',1,1);
			  	$pic = $pics[0]->photourl;
			  }
			  ?>
				<a href="/news/news.php?id=<?php echo $zbtj[0]->id;?>"><?php echo $zbtj[0]->title;?></a>
				<div id=left><img width=90 height=94 src="<?php echo $pic;?>" /><a href="/news/news-4.php?id=<?php echo $zbtj[0]->id;?>">[点击查询详情]</a></div>
				<div id=right><?php echo $zbtj[0]->description;?></div>
			</div>
			<div id=bottom>
				<div id=left>
					<div id=top>			
						<div id=more><a href="/video/videolist2.php?id=<?php echo $peixunziliaodaguan_video_id;?>">更多...</a></div>
						<?php
						$pxzldg = $sqlmanager->GetRecords('select * from smg_video where isadopt=1 and main_cate_id = ' .$peixunziliaodaguan_video_id .' order by priority asc, createtime desc',1,7);
						?>
						<div id=l><img width=80 height=94 src="<?php echo $pxzldg[0]->photourl;?>" /><a href="/video/video-1.php?id=<?php echo $pxzldg[0]->id;?>"><?php echo $pxzldg[0]->title;?></a></div>
						<? 						
						for($i=1;$i<=6 && count($pxzldg);$i++){?>
						<div class=r ><a style="height:18px;line-height:20px;" href="/video/video-1.php?id=<?php echo $pxzldg[$i]->id;?>"><?php echo $pxzldg[$i]->title;?></a></div>
						<? }?>
					</div>
					<div id=bottom>
						<div id=more><a href="/news/newslist.php?id=<?php echo $anlifenxiang_id;?>">更多...</a></div>
						<?php
						//获得图片
						
						$pxalfx = $sqlmanager->GetRecords('select * from smg_news where isadopt=1 and main_cate_id = ' .$anlifenxiang_id .' order by priority asc, pubdate desc',1,7);
						if ($pxalfx[0]->isphotonews) {
							$pic = $pxalfx[0]->photourl;
							if($pic=="")
							{
								$pic='/images/pic/px2.jpg';
							}
						}else 
						{
							$pics = $sqlmanager->GetRecords('select * from smg_photo where isadopt = 1 and main_cate_id=' .$peixunanlifenxiang_pic_id .' order by priority asc, createtime desc',1,1);
							$pic = $pics[0]->photourl;
							if($pic=="")
							{
								$pic='/images/pic/px2.jpg';
							}
						}
						?>
						<div id=l><img width=80 height=94 src="<?php echo $pic;?>" /><a href="/news/news-4.php?id=<?php echo $pxalfx[0]->id;?>"><?php echo $pxalfx[0]->title;?></a></div>
						<? for($i=1;$i<=6 && count($pxalfx);$i++){?>
						<div class=r><a href="/news/news-4.php?id=<?php echo $pxalfx[$i]->id;?>"><?php echo $pxalfx[$i]->title;?></a></div>
						<? }?>
					</div>
				</div>
				<div id=right>
					<div id=shang>
						<div id=more><a href="/news/newslist.php?id=<?php echo $dushuyuebao_id;?>">更多...</a></div>
						<?php
						
						$dsyb = $sqlmanager->GetRecords('select * from smg_news where isadopt=1 and main_cate_id = ' .$dushuyuebao_id .' order by priority asc, pubdate desc',1,7);
						if($dsyb[0]->isphotonews)
						{
							$pic =$dsyb[0]->photourl;
							if($pic=="")
							{
								$pic='/images/pic/read.jpg';
							}
						}else {
							$pics = $sqlmanager->GetRecords('select * from smg_photo where isadopt = 1 and main_cate_id=' .$dushuyuebao_pic_id .' order by priority asc, createtime desc',1,1);
							$pic = $pics[0]->photourl;
							if($pic=="")
							{
								$pic='/images/pic/read.jpg';
							}
						}
				
						?>
						<div id=l><img width=80 height=94 src="<?php echo $pic;?>" /><a href="/news/news-4.php?id=<?php echo $dsyb[0]->id;?>"><?php echo $dsyb[0]->title;?></a></div>
						<? for($i=1;$i < count($dsyb);$i++){?>
						<div class=r><a href="/news/news-4.php?id=<?php echo $dsyb[$i]->id;?>"><?php echo $dsyb[$i]->title; ?> </a></div>
						<? }?>
					</div>
					<div id=xia>
						<div id=more><a href="/news/newslist.php?id=<?php echo $yingyinyishu_id;?>">更多...</a></div>
						<?php
						
						$yyys = $sqlmanager->GetRecords('select * from smg_news where isadopt=1 and main_cate_id = ' .$yingyinyishu_id .' order by priority asc, pubdate desc',1,7);
						if ($yyys[0]->isphotonews) {
							$pic = $yyys[0]->photourl;
							if($pic=="")
							{
								$pic='/images/pic/ys.jpg';
							}
						}else {
							$pics = $sqlmanager->GetRecords('select * from smg_photo where isadopt = 1 and main_cate_id=' .$yingyinyishu_pic_id .' order by priority asc, createtime desc',1,1);
							$pic = $pics[0]->photourl;
							if($pic=="")
							{
								$pic='/images/pic/ys.jpg';
							}
						}
						?>						
						<div id=l><img width=80 height=94 src="<?php echo $pic;?>" /><a href="/news/news.php?id=<?php echo $yyys[0]->id;?>"><?php echo $yyys[0]->title;?></a></div>
						<? 
						for($i=1;$i<count($yyys);$i++){?>
						<div class=r><a href="/news/news-4.php?id=<?php echo $yyys[$i]->id;?>"><?php echo $yyys[$i]->title;?></a></div>
						<? }?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<? include('../inc/bottom.inc.html');?>
</body>
</html>