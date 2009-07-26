<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-首页</title>
	<? 	
		css_include_tag('zone_index','top','bottom');
		use_jquery();
		js_include_once_tag('zone');
		$db=get_db();
		$sql="select src,url from smg_images i inner join smg_category c on i.category_id=c.id and i.is_adopt=1 and c.name='HOT讨论区' and c.category_type='picture' order by i.priority asc,i.created_at desc limit 1";
		$tlqimg=$db->query($sql);	
		$sql="select n.id,n.short_title,n.title,n.platform,n.description from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and c.name='讨论区' and c.category_type='news' order by n.priority asc,n.last_edited_at desc limit 11";
		$record=$db->query($sql);	
		$sql="select n.id,n.short_title,n.title,n.platform,n.description from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and c.name='上班这点事' and c.category_type='news' order by n.priority asc,n.last_edited_at desc limit 12";
		$sbzds=$db->query($sql);	
		$sql="select src,url,title from smg_images i inner join smg_category c on i.category_id=c.id and i.is_adopt=1 and c.name='上班这点事' and c.category_type='picture' order by i.priority asc,i.created_at desc limit 2";
		$sbzdsimg=$db->query($sql);
		$sql="select n.id,n.short_title,n.title,n.platform,n.description from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and c.name='生活大杂烩' and c.category_type='news' order by n.priority asc,n.last_edited_at desc limit 12";
		$shdzh=$db->query($sql);
		$sql="select src,url,title from smg_images i inner join smg_category c on i.category_id=c.id and i.is_adopt=1 and c.name='生活大杂烩' and c.category_type='picture' order by i.priority asc,i.created_at desc limit 2";
		$shdzhimg=$db->query($sql);
		$sql="select n.id,n.short_title,n.title,n.platform,n.description from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and c.name='观点视角' and c.category_type='news' order by n.priority asc,n.last_edited_at desc limit 11";
		$gdsj=$db->query($sql);
		$sql="select src,url,title from smg_images i inner join smg_category c on i.category_id=c.id and i.is_adopt=1 and c.name='观点视角' and c.category_type='picture' order by i.priority asc,i.created_at desc limit 1";
		$gdsjimg=$db->query($sql);
		$sql="select n.id,n.short_title,n.title,n.platform,n.description from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and c.name='分享生活' and c.category_type='news' order by n.priority asc,n.last_edited_at desc limit 18";
		$fxsh=$db->query($sql);
		$sql="select src,url,title from smg_images i inner join smg_category c on i.category_id=c.id and i.is_adopt=1 and c.name='分享生活' and c.category_type='picture' order by i.priority asc,i.created_at desc limit 1";
		$fxshimg=$db->query($sql);
		$sql="select n.description from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and c.name='交流公告' and c.category_type='news' order by n.priority asc,n.last_edited_at desc limit 1";
		$gg=$db->query($sql);
		$sql="select * from smg_comment where resource_type='zone' order by created_at desc limit 4";
		$comment=$db->query($sql);
		$sql="SELECT tid,subject FROM bbs_posts where subject<>'' order by pid desc limit 10";
		$bbs=$db->query($sql);
		$sql="SELECT uid,itemid,subject FROM blog_spaceitems order by itemid desc limit 10";
		$blog=$db->query($sql);
		$sql="select src,url,title from smg_images i inner join smg_category c on i.category_id=c.id and i.is_adopt=1 and c.name='劲爆热图' and c.category_type='picture' order by i.priority asc,i.created_at desc limit 6";
		$jbrt=$db->query($sql);
		$sql="SELECT count(*) as num,p.author,m.uid FROM bbs_posts p inner join bbs_members m on p.author=m.username and p.author<>'' and p.subject<>'' group by author order by num desc limit 15";
		$bbsph=$db->query($sql);
		$sql="SELECT count(*) as num,subject,tid FROM bbs_posts where subject<>'' group by tid order by num desc limit 10";
		$bbstophot=$db->query($sql);
		$sql="SELECT uid,itemid,subject FROM blog_spaceitems order by viewnum desc limit 10";
		$blogph=$db->query($sql);
		$sql="SELECT uid,username FROM blog_userspaces b order by viewnum desc limit 15";
		$bloghotspace=$db->query($sql);
		$sql="select n.id,n.short_title,n.title,n.platform,n.description from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and c.name='博主真人秀' and c.category_type='news' order by n.priority asc,n.last_edited_at desc limit 1";
		$blogsure=$db->query($sql);
		$sql="select src,url,title from smg_images i inner join smg_category c on i.category_id=c.id and i.is_adopt=1 and c.name='博主真人秀' and c.category_type='picture' order by i.priority asc,i.created_at desc limit 1";
		$blogsureimg=$db->query($sql);
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_top>
		<div id=t_l>
			<div id=t_l_t>
				<div id=t_l_title>HOT讨论区</div>
				<div id=left>
					<div id=pic><a target="_blank" href="<?php echo $tlqimg[0]->url; ?>"><img border=0 width=230 height=122 src="<?php echo $tlqimg[0]->src; ?>"></a></div>
					<div id=title>
						<a target="_blank" href="<?php echo $tlqimg[0]->url; ?>"><?php echo delhtml($tlqimg[0]->title);?></a>
					</div>
					<div id=content>
						<a target="_blank" href="/<?php echo $record[0]->platform; ?>/news/news.php?id=<?php echo $record[0]->id;?>"><?php echo delhtml($record[0]->description);?></a>
					</div>
				</div>
				<div id=right>
					<?php for($i=1;$i< count($record);$i++){ ?>
						<div class="content">
							<?php if($i==1){?>
							<img src="/images/icon/arrow2.gif">
							<a style="color:#2C345B; font-weight:bold;" target="_blank" href="/<?php echo $record[$i]->platform; ?>/news/news.php?id=<?php echo $record[$i]->id;?>"><?php echo delhtml($record[$i]->short_title); ?></a>
							<?php }else{?>
							<img src="/images/icon/arrow1.gif">
							<a style="color:#000000;" target="_blank" href="/<?php echo $record[$i]->platform; ?>/news/news.php?id=<?php echo $record[$i]->id;?>"><?php echo delhtml($record[$i]->short_title); ?>
							</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class=t_l_b>
				<div class="t_l_b_t"><div class="title">BBS</div><div class="title_right">【上班这点事】</div></div>
				<div class=t_l_b_l>
					<?php for($i=0;$i< count($sbzds);$i++){ ?>
						<div class=content><span style="color:#cccccc;">·</span><a target="_blank" href="/<?php echo $sbzds[$i]->platform;?>/news/news.php?id=<?php echo $sbzds[$i]->id; ?>"><?php echo delhtml($sbzds[$i]->short_title); ?></a>
						</div>
					<?php }?> 
				</div>
				<div class=t_l_b_r>
					<?php for($i=0;$i< count($sbzdsimg);$i++){ ?>
						<div class=content style="margin-top:10px;">
							<a target="_blank" href="<?php echo $sbzdsimg[$i]->url;?>"><img border=0 width=113 height=81 src="<?php echo $sbzdsimg[$i]->src; ?>"><div style="width:113px; height:18px; margin-top:5px; text-decoration:none; color:#0000FF; overflow:hidden; float:left; display:inline;" ><?php echo delhtml($sbzdsimg[$i]->title);?></div></a>	
						</div>
					<?php } ?>
				</div>
			</div>
			<div class=t_l_b>
				<div class="t_l_b_t"><div class="title">BBS</div><div class="title_right">【生活大杂烩】</div></div>
				<div class=t_l_b_l1>
					<?php for($i=0;$i< count($shdzhimg);$i++){ ?>
						<div class=content style="margin-top:10px;">
							<a target="_blank" href="<?php echo $shdzhimg[$i]->url;?>"><img border=0 width=113 height=81 src="<?php echo $shdzhimg[$i]->src; ?>"><div style="width:113px; height:18px; margin-top:5px; text-decoration:none; color:#0000FF; overflow:hidden; float:left; display:inline;" ><?php echo delhtml($shdzhimg[$i]->title);?></div></a>	
						</div>
					<?php } ?>
				</div>
				<div class=t_l_b_r1>
					<?php for($i=0;$i< count($shdzh);$i++){ ?>
						<div class=content><span style="color:#cccccc;">·</span>
							<a target="_blank" href="/<?php echo $shdzh[$i]->platform;?>/news/news.php?id=<?php echo $shdzh[$i]->id; ?>"><?php echo delhtml($shdzh[$i]->title); ?></a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div id=t_c>
			<div id=t_c_t>
				<div id=title1>博客</div>
				<div id=title2>观点视角</div>
				<div id=left>
					<a target="_blank" href="<?php echo $gdsjimg[0]->url;?>"><img border=0 width=100 height=70 src="<?php echo $gdsjimg[0]->src;?>"><div style="width:100px; margin-top:5px; height:15px; text-align:center; overflow:hidden; float:left; display:inline;"><?php echo delhtml($gdsjimg[0]->title);?></div></a>
					<?php for($i=0;$i<3;$i++){?>
						<div class=content><span style="color:#cccccc;">·</span><a target="_blank" <?php if($i==0){?>style="color:#2C345B; font-weight:bold;"<?php } ?> href="/<?php echo $gdsj[$i]->platform; ?>/news/news.php?id=<?php echo $gdsj[$i]->id; ?>"><?php echo $gdsj[$i]->short_title; ?></a></div>
					<?php } ?>
				</div>
				<div id=right>
					<?php for($i=3;$i<count($gdsj);$i++){ ?>
						<div class=content><span style="color:#cccccc;">·</span><a target="_blank" <?php if($i==3){?>style="color:#2C345B; font-weight:bold;"<?php } ?> href="/<?php echo $gdsj[$i]->platform; ?>/news/news.php?id=<?php echo $gdsj[$i]->id; ?>"><?php echo delhtml($gdsj[$i]->title);?></a></div>
					<?php }?>
				</div>
			</div>
			<div id=t_c_m>
				<div id=title1>博客</div>
				<div id=title2>分享生活</div>
				<div id=left>
					<a target="_blank" href="<?php echo $fxshimg[0]->url;?>"><img border=0 width=100 height=70 src="<?php echo $fxshimg[0]->src;?>"><div style="width:100px; text-align:center; margin-top:5px; height:15px; overflow:hidden; float:left; display:inline;"><?php echo delhtml($fxshimg[0]->title);?></div></a>
					<?php for($i=0;$i<7;$i++){?>
						<div class=content><span style="color:#cccccc;">·</span><a target="_blank" <?php if($i==0){?>style="color:#2C345B; font-weight:bold;"<?php } ?> href="/<?php echo $fxsh[$i]->platform; ?>/news/news.php?id=<?php echo $fxsh[$i]->id; ?>"><?php echo $fxsh[$i]->short_title; ?></a></div>
					<?php }?>
				</div>
				<div id=right>
					<?php for($i=7;$i<count($fxsh);$i++){ ?>
						<div class=content><span style="color:#cccccc;">·</span><a target="_blank" <?php if($i==3){?>style="color:#2C345B; font-weight:bold;"<?php } ?> href="/<?php echo $fxsh[$i]->platform; ?>/news/news.php?id=<?php echo $fxsh[$i]->id; ?>"><?php echo delhtml($fxsh[$i]->title);?></a></div>
					<?php }?>
				</div>
			</div>
			<div id=t_c_b>
				<?php for($i=0;$i<count($comment);$i++){ ?>
					<div class=comment>
						<div class="top">
							<span style="color:#378EC4"><?php echo $comment[$i]->nick_name;?></span>
							<span style="color:#D2D4C6"><?php echo substr($comment[$i]->created_at,0,10); ?></1span>
						</div>
						<div class="bottom">
							<?php echo delhtml($comment[$i]->comment); ?>
						</div>
					</div>
				<?php } ?>
				<form method="post" action="/pub/pub.post.php">
					<div id="subcomment">
						<input type="text" id="commenter" name="post[nick_name]">
						<textarea name="post[comment]"></textarea>
						<input type="hidden" id="resource_type" name="post[resource_type]" value="zone">
						<input type="hidden" name="type" value="comment">
						<button type="submit">回复</button>
					</div>
				</form>
			</div>
		</div>
		<div id=t_r>
			<div id=t_r_t>
				<div id=title><img src="/images/show/show_index_l_t.jpg">　公告</div>
				<div id=content><?php echo delhtml($gg[0]->description);?></div>
			</div>
			<div id=chat><a target="_blank" href="/zone/chat_room.php"><img border=0 src="/images/zone/index_chat.jpg"></a></div>
			<div class=t_r_m>
				<div class=t_r_m_top><img src="/images/zone/index_blog.jpg"></div>
				<div class=t_r_m_title1 param=1 style="font-weight:bold; color:#FF4700; cursor:pointer;">最新博文</div><div param=2 class=t_r_m_title1 style="cursor:pointer;">最热博文</div>
				<div id=blog1 class=blog style="display:block;">
					<?php for($i=0;$i<count($blog);$i++){ ?>
						<div class=t_r_m_content><img src="/images/number/<?php echo $i+1;?>.jpg"> <a target="_blank" <?php if($i<3){?>style="color:red;"<?php } ?> href="/blog/?uid-<?php echo $blog[$i]->uid;?>-action-viewspace-itemid-<?php echo $blog[$i]->itemid;?>"><?php echo $blog[$i]->subject; ?></a></div>
					<?php } ?>
				</div>
				<div id=blog2 class=blog style="display:none;">
					<?php for($i=0;$i<count($blogph);$i++){ ?>
						<div class=t_r_m_content><img src="/images/number/<?php echo $i+1;?>.jpg"> <a target="_blank" <?php if($i<3){?>style="color:red;"<?php } ?> href="/blog/?uid-<?php echo $blogph[$i]->uid;?>-action-viewspace-itemid-<?php echo $blogph[$i]->itemid;?>"><?php echo $blogph[$i]->subject; ?></a></div>
					<?php } ?>
				</div>
			</div>
			<div class=t_r_m>
				<div class=t_r_m_top><img src="/images/zone/index_bbs.jpg"></div>
				<div class=t_r_m_title2 param=1 style="font-weight:bold; color:#FF4700; cursor:pointer;">最新帖子</div><div param=2 class=t_r_m_title2 style="cursor:pointer;">最热帖子</div>
				<div id=bbs1 class=bbs style="display:block">
					<?php for($i=0;$i<count($bbs);$i++){ ?>
						<div class=t_r_m_content><img src="/images/number/<?php echo $i+1;?>.jpg"> <a target="_blank" <?php if($i<3){?>style="color:red;"<?php } ?> href="/bbs/viewthread.php?tid=<?php echo $bbs[$i]->tid;?>"><?php echo $bbs[$i]->subject; ?></a></div>
					<?php } ?>
				</div>
				<div class=bbs id=bbs2 style="display:none">
					<?php for($i=0;$i<count($bbstophot);$i++){ ?>
						<div class=t_r_m_content><img src="/images/number/<?php echo $i+1;?>.jpg"> <a target="_blank" <?php if($i<3){?>style="color:red;"<?php } ?> href="/bbs/viewthread.php?tid=<?php echo $bbstophot[$i]->tid;?>"><?php echo $bbstophot[$i]->subject; ?></a></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div id=ibody_middle></div>
	<div id=ibody_bottom>
		<div id=b_l>
			<div id=title>劲爆热图</div>
			<?php for($i=0;$i<count($jbrt);$i++){?>
				<div class="content">
					<a target="_blank" href="<?php echo $jbrt[$i]->url;?>"><img border=0 width=132 height=90 src="<?php echo $jbrt[$i]->src;?>"><br><?php echo $jbrt[$i]->title;?></a>
				</div>
			<?php } ?>
		</div>
		<div id=b_c>
			<div id=title>博主真人秀</div>
			<div id=b_c_l>
				<div id=pic><a target="_blank" href="<?php echo $blogsureimg[0]->url; ?>"><img src="<?php echo $blogsureimg[0]->src;?>"></a></div>
				<div id=pictitle><a target="_blank" href="<?php echo $blogsureimg[0]->url;?>"><?php echo $blogsureimg[0]->title;?></a></div>
			</div>
			<div id=b_c_r>
				<div id=b_c_r_title><?php echo $blogsure[0]->short_title; ?></div>
				<div id=content><?php echo $blogsure[0]->description;?></div>
			</div>
		</div>
		<div class=b_r>
			<div class="title">热门博主列表</div>
			<?php for($i=0;$i<count($bloghotspace);$i++){ ?>
			<div class=content><a target="_blank" href="/bbs/space.php?uid-<?php echo $bloghotspace[$i]->uid?>"><?php echo $bloghotspace[$i]->username; ?></a></div>
			<?php } ?>
		</div>
		<div class=b_r style="margin-top:10px;">
			<div class="title">论坛发贴排行</div>
			<?php for($i=0;$i<count($bbsph);$i++){ ?>
			<div class=content><a target="_blank" href="/bbs/space.php?uid=<?php echo $bbsph[$i]->uid?>"><?php echo $bbsph[$i]->author; ?></a></div>
			<?php } ?>
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>