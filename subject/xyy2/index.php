<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>喜羊羊2</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/index.css" type=text/css rel=stylesheet>
<?php js_include_once_tag('total');?>
<script>
	total("专题-喜羊羊2","other");
	var startTime = new Date();
	var EndTime=new Date('2010/01/29 00:00:00');
	function GetRTime(){
		var NowTime = new Date();
		var nMS =EndTime - NowTime.getTime();
		var nD =Math.floor(nMS/(1000 * 60 * 60 * 24));
		if(nD<=0)
		{
			nD=0;	
		}
		document.getElementById("RemainD").innerHTML=nD;
		
		if(nD==0&&nH==0&&nM==0&&nS==0)
		{
			window.location.href="#";
		}
		else
		{
			setTimeout("GetRTime()",1000);
		}
	}
	window.onload=GetRTime;
</script>
</HEAD>
<body>
<div id="ibody">
	<div class="day" id="RemainD"></div>
	<div id="ileft">
		<?php 
			$db=get_db();
			$video=$db->query('select id,title from smg_video where category_id=163 order by priority asc,created_at desc limit 6');
		?>
		<div id=top>
			<iframe id=video_src src="index_video.php?id=<?php echo $video[0]->id; ?>" width=309 height=238 scrolling="no" frameborder="0"></iframe>	
		</div>
		<div id=bottom>
			<?php for($i=1;$i<count($video);$i++){ ?>
				<div class=cl param=<?php echo $video[$i]->id;?>><?php echo $video[$i]->title;?></div>
			<?php } ?>
		</div>	
	</div>
	<div id=icenter>
		<?php $news_head=$db->query('select id,title,description from smg_news where category_id=164 and is_adopt=1 order by priority asc,created_at desc limit 1'); ?>
		<div id=top>
			<div id=title>
				<a target="_blank" href="/news/news/news_head.php?id=<?php echo $news_head[0]->id; ?>"><?php echo $news_head[0]->title;?></a>
			</div>
			<div id=content>
				<a target="_blank" href="/news/news/news_head.php?id=<?php echo $news_head[0]->id; ?>"><?php echo mb_substr(strip_tags($news_head[0]->description),0,84,"utf-8").'...';?></a>
			</div>
		</div>
		<div id=bottom>
			<?php $news=$db->query('select id,title from smg_news where category_id=165 and is_adopt=1 order by priority asc,created_at desc limit 5');
				for($i=0;$i<count($news);$i++)
				{
			 ?>
				<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo get_fck_content($news[$i]->title); ?></a></div>
			<?php } ?>
		</div>
	</div>
	<div id=iright>
		<div id=top></div>	
	</div>
</div>
</body>
</html>
<script>
	$(".cl").click(function()
	{
		video_src($(this).attr('param'));
	});
	function video_src(vid)
	{
		$("#video_src").attr('src','index_video.php?id='+vid);
	}
</script>
	