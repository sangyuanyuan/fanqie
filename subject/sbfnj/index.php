<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>三八妇女节专题</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/index.css" type=text/css rel=stylesheet>
<?php use_jquery();
js_include_once_tag('total');
?>
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
<script>
	total("专题-三八妇女节","other");
</script>
</HEAD>
<body>
<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>

  <TBODY>
  <TR>
    <TD><IMG height=140 src="css/logotop.jpg" width=770></TD>
    </TR></TBODY></TABLE>
<div style="width:770px; margin:0 auto; margin-bottom:50px;">
<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0 >
  <tr valign=top>
  	<td id="show_video" width=275>
  		<div style="margin-top:15px; margin-left:25px; float:left;display:inline;">
  		<?php
			  $video = $db->query('select n.id,n.title,n.photo_url,n.video_url from smg_video n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="video" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="三八采访" inner join smg_subject s on c.subject_id=s.id and s.name="三八妇女节专题" order by i.priority asc, n.created_at desc limit 2');
			  show_video_player(275,203,$video[0]->photo_url,$video[0]->video_url);
			  for($i=0;$i<count($video);$i++){
			?>
			<div style="width:275px; margin-top:3px; font-size:12px; margin-left:5px; line-height:20px; float:left; display:inline;"><a target="_blank" href="/show/video.php?id=<? echo $video[$i]->id;?>"><? echo $video[$i]->title;?></a></div>
			<? }?>
		</div>
  	</td>
  	<? $news=$db->query('select n.id,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="领导寄语" inner join smg_subject s on c.subject_id=s.id and s.name="三八妇女节专题" order by i.priority asc, n.last_edited_at desc limit 1');?>
  	<td valign=top align="left" width=445 id="i_am_mcdull">
  		<div class=index_title>领 导 寄 语</div>
			<div style="width:430px; height:220px; margin-top:5px; margin-left:25px; float:left; display:inline;">
				<div style="width:230px; height:200px; margin-top:5px; font-size:16px; overflow:hidden; line-height:20px; float:left; display:inline;">
					<a target="_blank" href="/news/news/news.php?id=<? echo $news[0]->id;?>"><? echo $news[0]->description;?></a>
				</div>
				<div style="width:180px; height:200px; margin-top:5px; float:right; display:inline;"><img width=180 height=200 border=0 src="css/2.jpg"></div>
			</div>
  	</td>
  </tr>
  <tr valign=top>
  </tr>
</table>
<table  cellSpacing=0 cellPadding=0 width=770 align=center border=0>
  <tr>
  	<td valign=top id="mail_to_mcdull" width=215>
  		<div id=title1>三八妇女节祝福</div>
  		<div style="width:204px; height:305px; margin-left:10px; margin-top:5px; float:left; display:inline;">
			<? $newslist=$db->query('select * from smg_comment where resource_type="sbfnj" order by created_at desc');?>
	  		<marquee height="300" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
					<? for($i=0; $i<count($newslist); $i++){?>
						<div style="width:192px; margin-left:5px; margin-bottom:10px; word-break:break-all; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->nick_name;?></span>说：<? echo $newslist[$i]->comment;?></div>
					<? }?>
			</marquee>
		</div>
		<div id=s_right name="comment_to_mcdull">
			<form name="commentform" method="post" action="/pub/pub.post.php">
				<div id=subject_comment>昵称：<input type="text" name="post[nick_name]" id="commenter"/><br />
				<div id=comment>内容：</div><textarea id="commentcontent" name="post[comment]"></textarea></div>
				<input type="hidden" name="type" value="comment">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="sbfnj">
				<button id=btn type="submit">发　表</button>
			</form>
		</div>
  	</td>
  	<td valign=top>
  		<table>
  			<tr>
  				<td id="mcdull_news">
  						<?php $news=$db->query('select n.photo_src,n.id,n.title,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="迎世博——传媒女性在行动" inner join smg_subject s on c.subject_id=s.id and s.name="三八妇女节专题" order by i.priority asc, n.last_edited_at desc limit 1');?>
  					<div id=title3>迎世博——传媒女性在行动</div>
  					<div id="pic_box">
							<img width=208 height=208 border=0 src="css/1.jpg">
			     	</div>
  					
			  		<div id="box1">
			  			<a href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><?php echo $news[0]->description; ?></a>
						<!--<? for($i=0; $i<count($news); $i++){?>
							<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
						<? }?>-->
			     	</div>
  					
  				</td>
  			</tr>
  			<tr>
  				<td id="mcdull_information">
  					<div id=title4>精彩瞬间</div>
  					<div id="box2">
  						<div style="width:98%; height:180px; float:left; display:inline;">
			<?php
				$photo = $db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="精彩瞬间" inner join smg_subject s on c.subject_id=s.id and s.name="三八妇女节专题" order by i.priority asc,n.created_at desc limit 7');
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
					          <li style="margin-left:10px; margin-top:5px;"><a href="<? echo $photo[$i]->url;?>"><img width=170 height=170 src="<? echo $photo[$i]->src;?>"  /></a></li>
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
				  		<!--<? for($i=0; $i<count($news); $i++){?>
								<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
							<? }?>-->	
			     	</div>
			  	</td>
  			</tr>
			<tr>
  				<td id="mcdull_download">
  					<? $news=$db->query('select n.photo_src,n.id,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="相关新闻" inner join smg_subject s on c.subject_id=s.id and s.name="三八妇女节专题" order by i.priority asc, n.last_edited_at desc');?>
  					<div id=title5>相关新闻</div><div id=title5>光荣榜</div>
  					<div id="box3">
				  		<? for($i=0; $i<count($news); $i++){?>
							<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a target="_blank" href="/news/news/news.php?id=<? echo $news[$i]->id;?>"><? echo delhtml($news[$i]->short_title);?></a></div>
							<? }?>
			       </div>
			       <? $news=$db->query('select n.photo_src,n.id,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="光荣榜" inner join smg_subject s on c.subject_id=s.id and s.name="三八妇女节专题" order by i.priority asc, n.last_edited_at desc');?>
			       <div id="box4">
				  		<? for($i=0; $i<count($news); $i++){?>
							<div style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a target="_blank" href="/news/news/news.php?id=<? echo $news[$i]->id;?>"><? echo delhtml($news[$i]->short_title);?></a></div>
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
	