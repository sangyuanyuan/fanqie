<?php
	require_once('../frame.php');
	$db = get_db();
	
	switch($_REQUEST['type'])
	{
		case 91: $c_title="工作这点事";break;
		case 90: $c_title="生活这点事";break;
		case 92: $c_title="旅游这点事";break;
		default: $c_title="工作这点事";break;
		
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-<?php echo $c_title;?></title>
	<? 	
		css_include_tag('zone_blog','top','bottom');
		use_jquery();
		js_include_tag('total.js');
  ?>
</head>
<script>
	total("博文","zone");
</script>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t><?php echo $c_title;?></div>
		<?php
			$sql = 'select u.spacename,a.* from (select b.*,s.message from blog_spaceitems b left join blog_spaceblogs s on b.itemid=s.itemid where b.catid='.$_REQUEST['type'].' and b.type="blog" order by b.itemid desc limit 6) a left join blog_userspaces u on a.username=u.username';
			$record=$db -> query($sql);	
		?>
		<?php for($i=0;$i<6;$i++){ ?>
			<div class=l>
				<div class=name><a href="/blog/?uid-<?php echo $record[$i]->uid?>" target=_blank><?php echo $record[$i]->spacename ?></a></div>
				<img src="http://172.27.203.83:8080/ucenter/avatar.php?uid=<?php echo $record[$i]->uid ?>" class=pic />
				<div class=subject><a href="/blog/?uid-<?php echo $record[$i]->uid?>-action-viewspace-itemid-<?php echo $record[$i]->itemid?> " target=_blank><?php echo strip_tags($record[$i]->subject) ?></a></div>
				<div class=context><?php echo delhtml($record[$i]->message) ?></div>
			</div>
		<?PHP }?>
	</div>
	<div id=ibody_center>
		<div id=c_t>
			<div id=title>
				<div class=menu id=1 <?php if($_REQUEST['type']==91){echo 'style="color:#DE4900; font-weight:bold;"';  }?>>工作这点事</div>	
				<div class=menu id=2 <?php if($_REQUEST['type']==90){echo 'style="color:#DE4900; font-weight:bold;"';  }?>>生活这点事</div>	
				<div class=menu id=3 <?php if($_REQUEST['type']==92){echo 'style="color:#DE4900; font-weight:bold;"';  }?>>旅游这点事</div>	
			</div>
			<?php
				$sql = 'select b.*,u.spacename from blog_spaceitems b left join blog_userspaces u on b.username=u.username where b.catid=91 order by b.itemid desc limit 17';
				$record=$db -> query($sql);	
			?>
			<div class=content_c id=content_c1 <?php if($_REQUEST['type']<>91){echo 'style="display:none;"';  }?> >
				<?php  for($i=0;$i<17;$i++){?>
					<li>[<a href="/blog/?uid-<?php echo $record[$i]->uid?>" target=_blank><?php echo $record[$i]->spacename ?></a>] <a href="/blog/?uid-<?php echo $record[$i]->uid?>-action-viewspace-itemid-<?php echo $record[$i]->itemid?> " target=_blank  target=_blank title="<?php echo $record[$i]->subject ?>"><?php echo $record[$i]->subject ?></a></li>
				<? }?>
			</div>
			<?php
				$sql = 'select b.*,u.spacename from blog_spaceitems b left join blog_userspaces u on b.username=u.username  where b.catid=90 order by b.itemid desc limit 17';
				$record=$db -> query($sql);	
			?>
			<div class=content_c id=content_c2 <?php if($_REQUEST['type']<>90){echo 'style="display:none;"';  }?> >
				<?php  for($i=0;$i<17;$i++){?>
					<li>[<a href="/blog/?uid-<?php echo $record[$i]->uid?>" target=_blank><?php echo $record[$i]->spacename ?></a>] <a href="/blog/?uid-<?php echo $record[$i]->uid?>-action-viewspace-itemid-<?php echo $record[$i]->itemid?> " target=_blank  target=_blank title="<?php echo $record[$i]->subject ?>"><?php echo $record[$i]->subject ?></a></li>
				<? }?>
			</div>
			<?php
				$sql = 'select b.*,u.spacename from blog_spaceitems b left join blog_userspaces u on b.username=u.username  where b.catid=92 order by b.itemid desc limit 17';
				$record=$db -> query($sql);	
			?>
			<div class=content_c id=content_c3 <?php if($_REQUEST['type']<>92){echo 'style="display:none;"';  }?> >
				<?php  for($i=0;$i<17;$i++){?>
					<li>[<a href="/blog/?uid-<?php echo $record[$i]->uid?>" target=_blank><?php echo $record[$i]->spacename ?></a>] <a href="/blog/?uid-<?php echo $record[$i]->uid?>-action-viewspace-itemid-<?php echo $record[$i]->itemid?> " target=_blank title="<?php echo $record[$i]->subject ?>"><?php echo $record[$i]->subject ?></a></li>
				<? }?>
			</div>
		
		</div>
		<div id=c_b>
			<div id=title>劲酷热图</div>	
			<?php
  			$sql = 'select i.id as img_id,i.src,i.title,i.url from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="劲爆热图" and c.platform="zone" order by i.priority asc limit 3';
				$record=$db -> query($sql);	
			?>
			<?php for($i=0;$i<3;$i++){?>
			<div class=box>
				<a href="<?php echo $record[$i]->url ?>" target=_blank><img src="<?php echo $record[$i]->src?>" border=0></a>
				<div class="title"><a href="<?php echo $record[$i]->url ?>" target=_blank><?php echo $record[$i]->title?></a></div>
			</div>
			<? }?>			
			
			
		</div>
	</div>
	<div id=ibody_right>
		<div id=r>
			<div class=r_title>HOT讨论区</div>
 			<?php
  			$sql = 'select i.id as img_id,i.src,i.title,i.url from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="HOT讨论区" and c.platform="zone" order by i.priority asc limit 2';
				$record=$db -> query($sql);	
			?>
			<a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[0]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a><a href="<?php echo $record[1]->url?>" target=_blank><img src="<?php echo $record[1]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a>
			<?php
				$sql = 'select n.id as news_id,n.short_title, c.platform from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="讨论区" and c.platform="zone" order by n.priority asc limit 7';
				$record=$db -> query($sql);
			?>
			<?php for($i=0;$i<7;$i++){?>			
				<div class="content1">
					<a href="/<?php echo $record[$i]->platform ?>/news/news.php?id=<?php echo $record[$i]->news_id ?>" target=_blank>·<?php echo $record[$i]->short_title ?></a>
				</div>
			<? }?>
		</div>
		<div id=r>
			<div class=r_title>观点视角</div>
 			<?php
  			$sql = 'select i.id as img_id,i.src,i.title,i.url from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="观点视角" and c.platform="zone" order by i.priority asc limit 2';
				$record=$db -> query($sql);	
			?>
			<a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[0]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a><a href="<?php echo $record[1]->url?>" target=_blank><img src="<?php echo $record[1]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a>

			<?php
				$sql = 'select n.id as news_id,n.short_title, c.platform from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="观点视角" and c.platform="zone" order by n.priority asc limit 7';
				$record=$db -> query($sql);
			?>
			<?php for($i=0;$i<7;$i++){?>			
				<div class="content2">
					<a href="/<?php echo $record[$i]->platform ?>/news/news.php?id=<?php echo $record[$i]->news_id ?>" target=_blank>·<?php echo $record[$i]->short_title ?></a>
				</div>
			<? }?>			
			
			
		</div>
		<div id=r>
			<div class=r_title>博主真人秀</div>
 			<?php
  			$sql = 'select i.src,i.title,i.url,i.description from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="博主真人秀" and c.platform="zone" order by i.priority asc limit 1';
				$record=$db -> query($sql);	
			?>
			<div class=content3>
				<a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[0]->src?>" border=0></a>
				<div id=title><a href="<?php echo $record[0]->url?>" target=_blank><?php echo $record[0]->title?></a></div>
				<div id=description>
					<?php echo $record[0]->description ?>
				</div>
			</div>
		</div>
				

		<a href="dialog_list.php" id=r_dialog target=_ blank><img src="/images/zone/blog_r_dialog.jpg" border=0></a>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>


<script>


$(function(){
	$(".menu").mouseover(function(){
			
			var item=$(this).attr('id');
			$(".menu").css('color','#000000');
			$(".menu").css('font-weight','normal');
			$(".content_c").hide();
			
			$("#"+item).css('color','#DE4900');
			$("#"+item).css('font-weight','bold');

			$("#content_c"+item).show();
	});
		
});

</script>