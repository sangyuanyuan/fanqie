<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>SMG足球联赛</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/index.css" type=text/css rel=stylesheet>
<?php js_include_once_tag('total');?>
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
	total("专题-SMG足球联赛","other");
</script>
</HEAD>
<body>
<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>

  <TBODY>
  <TR>
    <TD><IMG height=385 src="css/logotop1.jpg" width=770></TD>
    </TR></TBODY></TABLE>
<div style="width:770px; background:url(css/bg2.jpg) repeat-x; margin:0 auto; margin-bottom:50px;">
<TABLE style="background:url(css/bg2.jpg)" cellSpacing=0 cellPadding=0 width=770 align=center border=0 >
  <tr valign=top>
  	<td id="show_video" width=330>
  		<div style="width:305px; margin-top:15px; margin-left:25px; float:left;display:inline;">
	  		<?php
				  $show = $db->query('select n.id,n.title,n.src from smg_images n inner join smg_category c on c.id=n.category_id and c.name="秀一秀" where n.is_adopt=1 order by n.priority asc limit 1');
			?>
			<div style="width:305px; height:300px; over-flow:hidden; font-weight:bold; margin-top:3px; font-size:15px; margin-left:5px; line-height:20px; float:left; display:inline;"><a target="_blank" href="/show/show.php?id=<? echo $show[0]->id;?>"><img src="<?php echo $show[0]->src;?>" border=0 width="300"></a></div>
		</div>
  	</td>
  	<? $news=$db->query('select n.id,n.title,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_category c on c.id=n.category_id and c.name="看一看" where n.is_adopt=1 order by n.priority asc, n.last_edited_at desc limit 10');?>
  	<td valign=top align="right" width=440 id="i_am_mcdull">
  		<div class=index_title></div>
		<div style="width:405px; height:220px; margin-top:5px; margin-left:25px; font-size:16px; overflow:hidden; color:#ec805a; float:left; display:inline;">
			<div id="box1">
				<? for($i=0; $i<count($news); $i++){?>
					<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
				<? }?>
	     	</div>
		</div>
  	</td>
  </tr>
  <tr valign=top>
  	<td align=left colspan=2 id="mcdull_picture">
  		<div class=title2></div>
  		<div style="width:98%; height:80px; float:left; display:inline;">
			<?php
				$photo = $db->query('select n.photo_src,n.id,n.title,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_category c on c.id=n.category_id and c.name="点一点" where n.is_adopt=1 order by n.priority asc, n.last_edited_at desc limit 10');
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
					          <li><a href="/news/news.php?id=<? echo $photo[$i]->id;?>"><img width=75 height=75 src="<? echo $photo[$i]->photo_src;?>"  /></a></li>
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
			<? $newslist=$db->query('select * from smg_comment where resource_type="football" order by created_at desc');?>
	  		<marquee height="220" width="190" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
					<? for($i=0; $i<count($newslist); $i++){?>
						<div style="width:180px; margin-left:10px; margin-bottom:10px; overflow:hidden; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->nick_name;?></span>说：<a style="text-decoration:none; color:#000000;" target="_blank" href="/news/news.php?id=16825"><? echo $newslist[$i]->comment;?></a></div>
					<? }?>
			</marquee>
		</div>
		<div id=s_right name="comment_to_mcdull">
			<form name="commentform" method="post" action="/pub/pub.post.php">
				<div id=subject_comment>昵称：<input type="text" name="post[nick_name]" id="commenter"/><br />
				<div id=comment>内容：</div><textarea id="commentcontent" name="post[comment]"></textarea></div>
				<input type="hidden" name="type" value="comment">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="football">
				<button id=btn type="submit">发　表</button>
			</form>
		</div>
  	</td>
  	<td valign=top>
  		<table>
  			<tr>
  				<td id="mcdull_news">
  					<?php $news=$db->query('select n.id,n.title,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_category c on c.id=n.category_id and c.name="查一查" where n.is_adopt=1 order by n.priority asc, n.last_edited_at desc limit 10');?>
			  		<div id=title3></div>
			  		<div id="box1">
						<? for($i=0; $i<count($news); $i++){?>
							<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
						<? }?>
			     	</div>
					<div id="box3">
						
					</div>
  				</td>
  			</tr>
  			<tr>
  				<td id="mcdull_information">
  					<? $news=$db->query('select n.photo_src,n.id,n.description,n.title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="麦兜资料馆" inner join smg_subject s on c.subject_id=s.id and s.name="麦兜专题" order by i.priority asc, n.last_edited_at desc limit 7')?>
  					<div id=title4></div>
  					<div id="box2">
				  		<embed src="/flash/football.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="500" height="300">
 						</embed>
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
	