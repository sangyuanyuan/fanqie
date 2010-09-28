<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -学习园地</title>
	<?php css_include_tag('smg','bottom'); 
		$db=get_db();
		js_include_once_tag('total');
	?>
<script>
	total("东方传媒学院","server");
</script>
</head>
<body>
	<div id=le_body>
		<div id=le_left>
			<? 
			$zbtj = $db->query('select s.id,s.is_photo_news,s.photo_src,s.click_count,s.title,s.description,c.platform,c.id as cid from smg_news s inner join smg_category c on s.category_id=c.id and is_adopt = 1 and c.name ="2010年新员工培训" and c.category_type="news" order by created_at desc limit 5');
			for($i=0;$i < 2 && $i<count($zbtj);$i++){?>
			<div class=top>
				<a href="/news/news.php?id=<?php echo $zbtj[$i]->id;?>"><?php echo $zbtj[$i]->title;?></a>
				<div class=clickrate>点击率：<?php echo $zbtj[$i]->click_count;?></div>
			</div>
			<? }?>
			<? for($i=2;$i<count($zbtj);$i++){?>
			<div class=middle>
				<a href="/news/news.php?id=<?php echo $zbtj[$i]->id;?>"><?php echo $zbtj[$i]->title;?></a>
			</div>
			<? }?>
			<div class=middle>
				<div id=more><a target="_blank" href="/<?php echo $zbtj[0]->c.platform;?>/news/news_list.php?id=<?php echo $zbtj[0]->cid;?>">更多...</a></div>
			</div>
			<div id=bottom>
				<a target="_blank" href="/server/">生活这点事</a><a target="_blank" href="/zone/">博客</a><a target="_blank" href="/zone/">论坛</a>
			</div>
		</div>
		<div id=le_right>
			<div id=top>
			  <?php
			  //获得重磅推荐的图片
			  if ($zbtj[0]->is_photo_news==1)
			  {
			  	$pic = $zbtj[0]->photo_src;
			  }else 
			  {
			  	$pics = $db->query('select i.src from smg_images i inner join smg_category c on i.category_id=c.id where i.is_adopt = 1 and c.name="2010年新员工培训" and c.category_type="picture" order by i.priority asc, i.created_at desc limit 1');
			  	$pic = $pics[0]->src;
			  }
			  $zbtj = $db->query('select s.id,s.is_photo_news,s.photo_src,s.click_count,s.title,s.description,c.platform,c.id as cid from smg_news s inner join smg_category c on s.category_id=c.id and is_adopt = 1 and c.name ="2010年新员工培训" and c.category_type="news" order by s.priority asc,s.created_at desc limit 1');
			  ?>
				<a target="_blank" href="/<?php echo $zbtj[0]->platform;?>/news/news.php?id=<?php echo $zbtj[0]->id;?>"><?php echo $zbtj[0]->title;?></a>
				<div id=left><img width=90 height=94 src="<?php echo $pic;?>" /><a target="_blank" href="/<?php echo $zbtj[0]->platform; ?>/news/news.php?id=<?php echo $zbtj[0]->id;?>">[点击查询详情]</a></div>
				<div id=right><?php echo $zbtj[0]->description;?></div>
			</div>
			<div id=bottom>
				<div id=left>
					<div id=top>
						<?php
						$pxzldg = $db->query('select v.id,v.title,v.photo_url,v.video_url,c.platform,c.id as cid from smg_video v inner join smg_category c on v.category_id=c.id and v.is_adopt=1 and c.name ="培训资料大观" and c.category_type="video" order by v.priority asc, v.created_at desc limit 7');
						?>		
						<div id=more><a target="_blank" href="/show/list.php?type=video&id=<?php echo $pxzldg[0]->cid; ?>">更多...</a></div>
						<div id=l><img width=80 height=94 src="<?php echo $pxzldg[0]->photo_url;?>" /><a href="/show/video.php?id=<?php echo $pxzldg[0]->id;?>"><?php echo $pxzldg[0]->title;?></a></div>
						<? 						
						for($i=1;$i<=6 && count($pxzldg);$i++){?>
						<div class=r ><a target="_blank" style="height:18px; line-height:20px;" href="/show/video.php?id=<?php echo $pxzldg[$i]->id;?>"><?php echo $pxzldg[$i]->title;?></a></div>
						<? }?>
					</div>
					<div id=bottom>
						<?php $pxalfx = $db->query('select s.id,s.photo_src,s.click_count,s.title,s.description,c.platform,c.id as cid,is_photo_news from smg_news s inner join smg_category c on s.category_id=c.id and is_adopt = 1 and c.name ="培训案例分享" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 7'); ?>
						<div id=more><a target="_blank" href="/<?php echo $pxalfx[0]->platform; ?>/news/news_list.php?id=<?php echo $pxalfx[0]->cid;?>">更多...</a></div>
						<?php
						//获得图片
						if ($pxalfx[0]->is_photo_news==1) {
							$pic = $pxalfx[0]->photo_src;
							if($pic=="")
							{
								$pic='/images/pic/px2.jpg';
							}
						}else 
						{
							$pics = $db->query('select i.src from smg_images i inner join smg_category c on i.category_id=c.id where i.is_adopt = 1 and c.name="培训案例分享" and c.category_type="picture" order by i.priority asc, i.created_at desc limit 1');
							$pic = $pics[0]->src;
							if($pic=="")
							{
								$pic='/images/pic/px2.jpg';
							}
						}
						?>
						<div id=l><img width=80 height=94 src="<?php echo $pic;?>" /><a href="/<?php echo $pxalfx[0]->platform; ?>/news/news.php?id=<?php echo $pxalfx[0]->id;?>"><?php echo $pxalfx[0]->title;?></a></div>
						<? for($i=1;$i<=6 && count($pxalfx);$i++){?>
							<div class=r><a target="_blank" href="/<?php echo $pxalfx[$i]->platform; ?>/news/news.php?id=<?php echo $pxalfx[$i]->id;?>"><?php echo $pxalfx[$i]->title;?></a></div>
						<? }?>
					</div>
				</div>
				<div id=right>
					<div id=shang>
						<?php $dsyb = $db->query('select s.id,s.photo_src,s.click_count,s.title,s.description,c.platform,c.id as cid,is_photo_news from smg_news s inner join smg_category c on s.category_id=c.id and is_adopt = 1 and c.name ="读书阅报" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 7'); ?>
						<div id=more><a target="_blank" href="/<?php echo $dsyb[0]->platform; ?>/news/news_list.php?id=<?php echo $dsyb[0]->cid;?>">更多...</a></div>
						<?php
						if($dsyb[0]->is_photo_news==1)
						{
							$pic =$dsyb[0]->photo_src;
							if($pic=="")
							{
								$pic='/images/pic/read.jpg';
							}
						}else {
							$pics = $db->query('select i.src from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt = 1 and c.name="读书阅报" and c.category_type="picture" order by i.priority asc, i.created_at desc limit 1');
							$pic = $pics[0]->src;
							if($pic=="")
							{
								$pic='/images/pic/read.jpg';
							}
						}
				
						?>
						<div id=l><img width=80 height=94 src="<?php echo $pic;?>" /><a target="_blank" href="/<?php echo $dsyb[0]->platform;?>/news/news.php?id=<?php echo $dsyb[0]->id;?>"><?php echo $dsyb[0]->title;?></a></div>
						<? for($i=1;$i < count($dsyb);$i++){?>
						<div class=r><a target="_blank" href="/<?php echo $dsyb[$i]->platform;?>/news/news.php?id=<?php echo $dsyb[$i]->id;?>"><?php echo $dsyb[$i]->title; ?> </a></div>
						<? }?>
					</div>
					<?php $yyys = $db->query('select s.id,s.photo_src,s.click_count,s.title,s.description,c.platform,c.id as cid,is_photo_news from smg_news s inner join smg_category c on s.category_id=c.id and is_adopt = 1 and c.name ="影音艺术" and c.category_type="news" order by s.priority asc,s.last_edited_at desc limit 7');?>
					<div id=xia>
						<div id=more><a href="/<?php echo $yyys[0]->platform;?>/news/news_list.php?id=<?php echo $yyys[0]->cid;?>">更多...</a></div>
						<?php
						if ($yyys[0]->isphotonews) {
							$pic = $yyys[0]->photo_url;
							if($pic=="")
							{
								$pic='/images/pic/ys.jpg';
							}
						}else {
							$pics = $db->query('select i.src from smg_images i inner join smg_category c on i.category_id=c.id where i.is_adopt = 1 and c.name="影音艺术" and c.category_type="picture" order by i.priority asc, i.created_at desc limit 1');
							$pic = $pics[0]->src;
							if($pic=="")
							{
								$pic='/images/pic/ys.jpg';
							}
						}
						?>						
						<div id=l><img width=80 height=94 src="<?php echo $pic;?>" /><a href="/news/news.php?id=<?php echo $yyys[0]->id;?>"><?php echo $yyys[0]->title;?></a></div>
						<? 
						for($i=1;$i<count($yyys);$i++){?>
						<div class=r><a target="_blank" href="/<?php echo $yyys[$i]->platform ?>/news/news.php?id=<?php echo $yyys[$i]->id;?>"><?php echo $yyys[$i]->title;?></a></div>
						<? }?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<? require_once('../inc/bottom.inc.php');?>
</body>
</html>

