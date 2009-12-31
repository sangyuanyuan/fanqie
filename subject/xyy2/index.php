<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>喜羊羊2</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/index.css" type=text/css rel=stylesheet>
<?php 
	use_jquery(); 
	js_include_once_tag('total','gd');
	function daysInSpan($start,$end)
		{
		 $dayTicks=ticksInDay();
		 return ($end-$start)/$dayTicks;
		}
		 
	function ticksInDay()
	{
	 $today=getdate();
	 $yesterday=mktime(0,0,0,$today[mon],$today[mday]-1,$today[year]);
	 $today=mktime(0,0,0,$today[mon],$today[mday],$today[year]);
	 return $today-$yesterday;
	}
	
?>
<script>
	total("专题-喜羊羊2","other");
	 colors2 = new Array(2); 
	 colors2[0]="#FF0000";
	 colors2[1]="#FF00CC";
	
	 var i=0;
	 function fLi2() {
	  if (i<7) {
	     //line2.style.color = colors2[i];
	     line3.style.color = colors2[i];
	     i++;
	     timerID2 = setTimeout( "fLi2()", 200);
	   }
	   else {
	     i=0;
	     TimerID2=setTimeout("fLi2()",500);
	   }
	  }
</script>
</HEAD>
<body onload="TimerID2=setTimeout('fLi2()',1000);">
<div id="ibody">
	<div class="day" id="RemainD"><?php $days=daysInSpan(mktime(0,0,0,date('m'),date('d'),date('Y')),mktime(0,0,0,01,29,2010)); if(($days)>=1){?><img src="images/<?php echo $days.'.gif';?>"><?php } ?></div>
	<div id="ileft">
		<?php 
			$db=get_db();
			$video=$db->query('select id,title from smg_video where category_id=163 and is_adopt=1 order by priority asc,created_at desc limit 4');
		?>
		<div id=top>
			<iframe id=video_src src="index_video.php?id=<?php echo $video[0]->id; ?>" width=305 height=220 scrolling="no" frameborder="0"></iframe>	
		</div>
		<div id=bottom>
			<?php for($i=0;$i<count($video);$i++){ ?>
				<div class=cl param=<?php echo $video[$i]->id;?>><?php echo $video[$i]->title;?></div>
			<?php } ?>
		</div>	
	</div>
	<div id=icenter>
		<?php $news_head=$db->query('select id,title,description from smg_news where category_id=164 and is_adopt=1 order by priority asc,created_at desc limit 1'); ?>
		<div id=top>
			<div id=title>
				<a id=line3 target="_blank" href="/news/news/news_head.php?id=<?php echo $news_head[0]->id; ?>"><?php echo get_fck_content($news_head[0]->title);?></a>
			</div>
			<div id=content>
				<a target="_blank" href="/news/news/news_head.php?id=<?php echo $news_head[0]->id; ?>"><?php echo mb_substr(strip_tags(get_fck_content($news_head[0]->description)),0,120,"utf-8").'...';?></a>
			</div>
		</div>
		<div id=middle>
			<?php $news=$db->query('select id,title from smg_news where category_id=165 and is_adopt=1 order by priority asc,created_at desc limit 5');
				for($i=0;$i<count($news);$i++)
				{
			 ?>
				<div class=cl><span style="color:red;">·</span><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo get_fck_content($news[$i]->title); ?></a>　<?php if($i<2){ ?><img src="/images/new.gif"><?php } ?></div>
			<?php } ?>
		</div>
		<div id=bottom>
			<?php $news=$db->query('select id,title from smg_news where category_id=169 and is_adopt=1 order by priority asc,created_at desc limit 3');
				for($i=0;$i<count($news);$i++)
				{
			 ?>
				<div class=cl><span style="color:red;">·</span><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo get_fck_content($news[$i]->title); ?></a>　<?php if($i<1){ ?><img src="/images/new.gif"><?php } ?></div>
			<?php } ?>
		</div>
	</div>
	<div id=iright>
		<?php $news=$db->query('select content from smg_news where category_id=167 and is_adopt=1 order by priority asc,created_at desc limit 1'); ?>
		<div id=top>
			<DIV id=a style="OVERFLOW: hidden; WIDTH: 250px; height:150px;">
				<div id=a1>
					<?php
						for($i=0;$i<count($news);$i++){
					?>
		        <div class="cl"><?php echo get_fck_content($news[$i]->content); ?></div>
		      <? }?>
		    </div>
		    <div id="a2"></div>
			</DIV>
		  <SCRIPT>
		    boxmove("a","a1","a2",1); 
			</SCRIPT>	
		</div>
		<div id=bottom>
			<?php 
						$record_import_b=$db->query('select * from smg_images where category_id=166 and is_adopt=1 order by priority asc,created_at desc');
	 					$picsurl10 = array();
						$picslink10 = array();
						$picstext10 = array();
						for ($i=0;$i<count($record_import_b);$i++)
						{
							$picsurl10[]=$record_import_b[$i]->src;
							$picslink10[]='images_list.php';
						}
					?>
 					<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
					<div id="focus_10"></div> 
					<script type="text/javascript"> 
						var pic_width=262; //图片宽度
						var pic_height=140; //图片高度
						var pics10="<?php echo implode(',',$picsurl10);?>";
		 				var mylinks10="<?php echo implode(',',$picslink10);?>";
						var picflash = new sohuFlash("/flash/focus.swf", "focus_10", "262", "140", "6","#FFFFFF");
						picflash.addParam('wmode','opaque');
						picflash.addVariable("picurl",pics10);
						picflash.addVariable("piclink",mylinks10);		
						picflash.addVariable("pictime","5");
						picflash.addVariable("borderwidth","262");
						picflash.addVariable("borderheight","140");
						picflash.addVariable("borderw","false");
						picflash.addVariable("buttondisplay","false");
						picflash.addVariable("textheight","0");
						picflash.addVariable("textcolor","#FF0000");
						picflash.addVariable("pic_width",pic_width);
						picflash.addVariable("pic_height",pic_height);
						
						picflash.write("focus_10");				
					</script>	
		</div>
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
	