<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>喜羊羊2</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/index.css" type=text/css rel=stylesheet>
<?php use_jquery(); 
js_include_once_tag('total','gd');?>
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
			$video=$db->query('select id,title from smg_video where category_id=163 and is_adopt=1 order by priority asc,created_at desc limit 6');
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
				<div class=cl><span style="color:red;">·</span><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo get_fck_content($news[$i]->title); ?></a></div>
			<?php } ?>
		</div>
	</div>
	<div id=iright>
		<?php $news=$db->query('select id,title,short_title from smg_news where category_id=167 and is_adopt=1 order by priority asc,created_at desc'); ?>
		<div id=top>
			<DIV id=a style="OVERFLOW: hidden; WIDTH: 250px; height:170px;">
				<div id=a1>
					<?php
						for($i=0;$i<count($news);$i++){
					?>
		        <div class="cl"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo get_fck_content($news[$i]->short_title); ?></a></div>
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
						var pic_height=175; //图片高度
						var pics10="<?php echo implode(',',$picsurl10);?>";
		 				var mylinks10="<?php echo implode(',',$picslink10);?>";
						var picflash = new sohuFlash("/flash/focus.swf", "focus_10", "262", "175", "6","#FFFFFF");
						picflash.addParam('wmode','opaque');
						picflash.addVariable("picurl",pics10);
						picflash.addVariable("piclink",mylinks10);		
						picflash.addVariable("pictime","5");
						picflash.addVariable("borderwidth","262");
						picflash.addVariable("borderheight","175");
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
	