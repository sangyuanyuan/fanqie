<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>麦兜专题</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/index.css" type=text/css rel=stylesheet>
<style type="text/css">
<!--
#lovexin12,#lovexin14{
   width:116px;
   height:271px;
}
html,body{
  }
#mm{
  }
-->

ul,li{margin:0px; padding:0px;list-style:none;}
.sqBorder {width:700px; height:80px; padding:10px; }
.scroll_div {width:700px; height:80px; margin:0 auto; overflow: hidden; white-space: nowrap;}
.scroll_div img{width:98px;height:80px; border: 0; margin: auto 8px;}
#scroll_begin, #scroll_end, #scroll_begin ul, #scroll_end ul, #scroll_begin ul li, #scroll_end ul li{display:inline;}/*设置ul和li横排*/
</style>
</HEAD>
<body>
<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>

  <TBODY>
  <TR>
    <TD><IMG height=140 src="css/logotop.jpg" width=770></TD>
    </TR></TBODY></TABLE>
<div style="width:770px; background:url(css/bg2.jpg) repeat-x; margin:0 auto; margin-bottom:50px;">
<TABLE style="background:url(css/bg2.jpg)" cellSpacing=0 cellPadding=0 width=770 align=center border=0 >
  <tr valign=top>
  	<td id="show_video" width=330>
  		<div style="margin-top:15px; margin-left:25px; float:left;display:inline;">
	  		<?php
				  $video = $db->query('select n.id,n.title,n.photo_url,n.video_url from smg_video n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="video" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="麦兜视频" inner join smg_subject s on c.subject_id=s.id and s.name="麦兜专题" order by n.priority asc, n.created_at desc limit 3');
				  show_video_player(305,203,$video[0]->photourl,$video[0]->videourl);
				  for($i=1;$i<count($video);$i++){
			?>
			<div style="width:305px; font-weight:bold; margin-top:3px; font-size:15px; margin-left:5px; line-height:20px; float:left; display:inline;"><a target="_blank" href="/video/video.php?id=<? echo $video[$i]->id;?>"><? echo $video[$i]->title;?></a></div>
			<? }?>
		</div>
  	</td>
  	<? $news=$db->query('select n.id,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="我是麦兜" inner join smg_subject s on c.subject_id=s.id and s.name="麦兜专题" order by n.priority asc, n.last_edited_at desc limit 1');?>
  	<td valign=top align="right" width=440 id="i_am_mcdull">
  		<div class=index_title></div>
		<div style="width:405px; height:220px; margin-top:5px; margin-left:25px; font-size:16px; overflow:hidden; color:#ec805a; background:url(css/box1.jpg); float:left; display:inline;">
			<div style="width:200px; height:220px; margin-top:5px; overflow:hidden; line-height:20px; font-weight:bold; margin-left:10px; word-break:break-all; float:left; display:inline;">
				<a target="_blank" style="TEXT-DECORATION: none" href="/news/news.php?id=<? echo $news[0]->id;?>"><? echo $news[0]->description;?></a>
			</div>
		</div>
  	</td>
  </tr>
  <tr valign=top>
  	<td align=left colspan=2 id="mcdull_picture">
  		<div class=title2></div>
  		<div style="width:98%; height:80px; float:left; display:inline;">
			<?php
				$photo = $db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="麦兜图片欣赏" inner join smg_subject s on c.subject_id=s.id and s.name="麦兜专题" order by n.priority asc,n.created_at desc limit 7');
	        ?>
	        <script type="text/javascript"> 
						function ScrollImgLeft(){
							var speed=20
							var scroll_begin = document.getElementById("scroll_begin");
							var scroll_end = document.getElementById("scroll_end");
							var scroll_div = document.getElementById("scroll_div");
							scroll_end.innerHTML=scroll_begin.innerHTML
							  function Marquee(){
							    if(scroll_end.offsetWidth-scroll_div.scrollLeft<=0)
							      scroll_div.scrollLeft-=scroll_begin.offsetWidth
							    else
							      scroll_div.scrollLeft++
							  }
							var MyMar=setInterval(Marquee,speed)
							  scroll_div.onmouseover=function() {clearInterval(MyMar)}
							  scroll_div.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
						}		
					</script> 
	        <div style="text-align:center">
					  <div class="sqBorder">
					  <!--#####滚动区域#####-->
					    <div id="scroll_div" class="scroll_div">
					      <div id="scroll_begin">
					        <ul>
					        	<? for($i=0;$i<count($photo);$i++){?>
					          <li><a href="<? echo $photo[$i]->url;?>"><img width=75 height=75 src="<? echo $photo[$i]->src;?>"  /></a></li>
					          <? }?>
					        </ul>
					      </div>
					      <div id="scroll_end"></div>
					    </div>
					  <!--#####滚动区域#####-->
					  </div>
					  <script type="text/javascript">ScrollImgLeft();</script>
					</div>
		</div>
  	</td>
  </tr>
</table>
<table  cellSpacing=0 cellPadding=0 width=770 align=center border=0>
  <tr>
  	<td id="mail_to_mcdull" width=200>
  		<div style="width:200px; height:305px; margin-left:22px; margin-top:5px; background:url(css/tomcdull.jpg); padding-top:45px;">
			<? $newslist=$db->query('select * from smg_comment where resource_type="mcdull" order by created_at desc');?>
	  		<marquee height="300" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
					<? for($i=0; $i<count($newslist); $i++){?>
						<div style="width:100%; margin-left:10px; margin-bottom:10px; overflow:hidden; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->nick_name;?></span>说：<a style="text-decoration:none; color:#000000;" target="_blank" href="/news/news.php?id=16825"><? echo $newslist[$i]->comment;?></a></div>
					<? }?>
			</marquee>
		</div>
		<div id=s_right name="comment_to_mcdull">
			<form name="commentform" method="post" action="/pub/pub.post.php">
				<div id=subject_comment>昵称：<input type="text" name="post[nick_name]" id="commenter"/><br />
				<div id=comment>内容：</div><textarea id="commentcontent" name="post[comment]"></textarea></div>
				<input type="hidden" name="type" value="comment">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="mcdull">
				<button id=btn type="submit">发　表</button>
			</form>
		</div>
  	</td>
  	<td valign=top>
  		<table>
  			<tr>
  				<td id="mcdull_news">
  					<?php $news=$db->query('select n.photo_src,n.id,n.title,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="麦兜新闻" inner join smg_subject s on c.subject_id=s.id and s.name="麦兜专题" order by n.priority asc, n.last_edited_at desc limit 10');?>
			  		<div id=title3></div>
			  		<div id="box1">
								<? for($i=0; $i<count($news); $i++){?>
									<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
								<? }?>
			     	</div>
					<div id="pic_box">
						<?php
							for ($i=0;$i<7;$i++)
							{
								$picsurl[]=$news[$i]->photo_src;
								$picslink[]="/news/news.php?id=".$news[$i]->id;
								$picstext[]=$news[$i]->short_title;
							}
						?>
						<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
						<div id="focus_01"></div> 
						<script type="text/javascript"> 
							var pic_width=210; //图片宽度
							var pic_height=180; //图片高度
							var pics="<?php echo implode(',',$picsurl);?>";
							var mylinks="<?php echo implode(',',$picslink);?>";
							
							var texts="<?php echo implode(',',$picstext);?>";
			 
							var picflash = new sohuFlash("/flash/focus.swf", "focus_01", "210", "210", "6","#FFFFFF");
							picflash.addParam('wmode','opaque');
							picflash.addVariable("picurl",pics);
							picflash.addVariable("piclink",mylinks);
							picflash.addVariable("pictext",texts);				
							picflash.addVariable("pictime","5");
							picflash.addVariable("borderwidth","210");
							picflash.addVariable("borderheight","210");
							picflash.addVariable("borderw","false");
							picflash.addVariable("buttondisplay","true");
							picflash.addVariable("textheight","20");
							picflash.addVariable("textcolor","#FF0000");	
							picflash.addVariable("pic_width",pic_width);
							picflash.addVariable("pic_height",pic_height);
							
							picflash.write("focus_01");				
						</script>
			     	</div>
  				</td>
  			</tr>
  			<tr>
  				<td id="mcdull_information">
  					<? $news=$db->query('select n.photo_src,n.id,n.description,n.title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="麦兜资料馆" inner join smg_subject s on c.subject_id=s.id and s.name="麦兜专题" order by n.priority asc, n.last_edited_at desc limit 7')?>
  					<div id=title4></div>
  					<div id="box2">
				  		<? for($i=0; $i<count($news); $i++){?>
							<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
						<? }?>
			        </div>	
			  	</td>
  			</tr>
			<tr>
  				<td id="mcdull_download">
  					<? $news=$db->query('select n.photo_src,n.id,n.description,n.title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="麦兜下载区" inner join smg_subject s on c.subject_id=s.id and s.name="麦兜专题" order by n.priority asc, n.last_edited_at desc limit 7');?>
  					<div id=title5></div>
  					<div id="box3">
				  		<? for($i=0; $i<count($news); $i++){?>
							<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
						<? }?>
			        </div>	
			  	</td>
  			</tr>
  		</table>
  	</td>
  </tr>
</table>
</div>
<div id="mm">
</div>
</body>
</html>
	