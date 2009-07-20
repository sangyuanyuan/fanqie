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
		$db=get_db();
		$sql="select n.* from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and c.name='HOT讨论区' order by priority asc,n.last_edit_at desc";
		$record=$db->query($sql);
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
					<div id=pic><a target="_blank" href="/<?php echo $record[0]->platform; ?>/news/news.php?id=<?php echo $record[0]->id;?>"><img border=0 width=230 height=122 src="<?php echo $record[0]->photo_src; ?>"></a></div>
					<div id=title>
						<a target="_blank" href="/<?php echo $record[0]->platform; ?>/news/news.php?id=<?php echo $record[0]->id; ?>">testettttttttttttttttttttttttttttttttttttttttttttttttt<?php echo delhtml($record[0]->title);?></a>
					</div>
					<div id=content>
						<a target="_blank" href="/<?php echo $record[0]->platform; ?>/news/news.php?id=<?php echo $record[0]->id;?>">testestttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt<?php echo delhtml($record[0]->description);?></a>
					</div>
				</div>
				<div id=right>
					<?php for($i=1;$i< 11;$i++){ ?>
						<div class="content">
							<?php if($i==1){?>
							<img src="/images/icon/arrow2.gif">
							<a style="color:#2C345B; font-weight:bold; text-decoration:none;" target="_blank" href="/<?php echo $record[$i]->platform; ?>/news/news.php?id=<?php echo $record[$i]->id;?>"><span style="color:#cccccc;">·</span>tttttttttttttt<?php echo delhtml($record[$i]->short_title); ?></a>
							<?php }else{?>
							<img src="/images/icon/arrow1.gif">
							<a style="color:#000000; text-decoration:none;" target="_blank" href="/<?php echo $record[$i]->platform; ?>/news/news.php?id=<?php echo $record[$i]->id;?>"><span style="color:#cccccc;">·</span>ttttttttttttttttttt<?php echo delhtml($record[$i]->short_title); ?></a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class=t_l_b>
				<div class="title">BBS</div><div class="title_right">【上班这点事】</div>
			</div>
			<div class=t_l_b>
				<div class="title">BBS</div><div class="title_right">【生活大杂烩】</div>
			</div>
		</div>
		<div id=t_c>
			<div id=t_c_t></div>
			<div id=t_c_m></div>
			<div id=t_c_b></div>
		</div>
		<div id=t_r>
			<div id=t_r_t>
				<div id=title><img src="/images/show/show_index_l_t.jpg">　公告</div>
			</div>
			<div id=chat></div>
			<div class=t_r_m></div>
			<div class=t_r_m></div>
		</div>
	</div>
	<div id=ibody_middle></div>
	<div id=ibody_bottom>
		<div id=b_l></div>
		<div id=b_c></div>
		<div class=b_r></div>
		<div class=b_r style="margin-top:10px;"></div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>