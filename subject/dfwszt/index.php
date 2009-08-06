<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>东方卫视改版专题</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<META content=东方卫视 name=description 东方卫视>
<META content="" name=keywords>
<META http-equiv=refresh content=null>
<LINK href="dw2_files/2007sanmod.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.5730.13" name=GENERATOR>
<STYLE type=text/css>
.STYLE3 {
	FONT-WEIGHT: bold; FONT-SIZE: 14px
}
.STYLE7 {
	COLOR: #336633
}
.STYLE10 {
	COLOR: #cc6666
}
.STYLE11 {
	COLOR: #0000ff
}
.STYLE12 {
	COLOR: #9900cc
}
.STYLE13 {
	COLOR: #ff0000
}
.STYLE14 {
	COLOR: #993333
}
</STYLE>
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
<BODY style="background:url('beijing.jpg');">
	
<TABLE cellSpacing=0 cellPadding=0 width=770 border=0>
  <TBODY>
  	
  <TR>
    <TD width=630 height=1></TD></TR></TBODY></TABLE>

<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>

  <TBODY>
  <TR>
    <TD><IMG height=140 src="logo.jpg" width=770></TD>
    </TR></TBODY></TABLE>
<TABLE bgColor=#e9f2d9 cellSpacing=0 cellPadding=0 width=770 align=center border=0 >
  <tr valign=top>
  	<td width="25%" height=200>
  		<div style="margin-top:10px; margin-left:10px;">
  		<?php
				  $video = $db->query('select n.id,n.title,n.photo_url,n.video_url from smg_video n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="video" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="风从东方来" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc, n.created_at desc limit 1');
				  show_video_player(216,160,$video[0]->photo_url,$video[0]->video_url);		  
				?>
			</div>
  	</td>
  	<td valign=top height=200>
  		<? $news=$db->query('select n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="东方风范" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc, n.last_edited_at desc limit 7')?>
  		<div class=index_title>东方风范<a target="_blank" href="/news/news_list.php?type=dfwszt&id=<?php echo $news[0]->cid;?>">更多</a></div>
			  		<div style="width:50%; margin-top:10px; margin-left:10px; float:left; display:inline;">
			  		<? for($i=0;$i<count($news);$i++){?>
			      <DIV align=left style="width:100%; height:20px; margin-left:10px; line-height:20px; overflow:hidden; float:left; display:inline;"><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div><? }?></div>
			      <DIV style="width:40%; margin-top:10px; margin-left:10px; float:left; display:inline;">
			          <? for($i=0;$i<count($news);$i++){if($news[$i]->photourl!=""){?><A href="/news/news.php?id=<? echo $news[$i]->id;?>" target=_blank><IMG border=0 height=140 src="<? echo $news[$i]->photourl;?>" width=200 border=0 style="margin-left:5px;"></A><? break;}}?>
			      </DIV>
  	</td>
  </tr>
  <tr valign=top>
  	<td height=100>
  		<? $news=$db->query('select n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="东方风格" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc, n.last_edited_at desc limit 7');?>
  		<div class=title1>东方风格<a target="_blank" href="/news/news_list.php?type=dfwszt&id=<?php echo $news[0]->cid;?>">更多</a></div>
  		<div style="margin-top:10px; line-height:20px;">
	  		<? for($i=0;$i<count($news);$i++){?>
		  		<div style="width:200px; height:20px; margin-left:16px; float:left; display:inline">		
		  				<a target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a>
		  		</div>
	  		<? }?>
  		</div>
  	</td>
  	<td height=100>
  		<? $news=$db->query('select n.photo_src,n.title,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="东方风景" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc, n.last_edited_at desc limit 7');?>
  		<div class=index_title>东方风景<a target="_blank" href="/news/news_list.php?type=dfwszt&id=<?php echo $news[0]->cid;?>">更多</a></div>
      <DIV style="width:40%; margin-top:10px; margin-left:15px; float:left; display:inline;">
          <? for($i=0;$i<count($news);$i++){if($news[$i]->photo_src!=""){?><A target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>" target=_blank><IMG border=0 height=140 src="<? echo $news[$i]->photo_src;?>" width=200 border=0 ></A><? break;}}?>
      </DIV>
      <div style="width:50%; margin-top:10px; float:left; display:inline;">
  		<? for($i=0;$i<count($news);$i++){?>
      <DIV align=left style="width:100%; height:20px; margin-left:10px; line-height:20px; overflow:hidden; float:left; display:inline;"><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div><? }?></div>
  	</td>
  </tr>
  <tr>
  	<td align=left colspan=2>
  		<? $photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="群星耀东方" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc,n.created_at desc limit 7');?>
  		<div class=index_title1>群星耀东方</div>
  		<? for($i=0;$i<count($photo);$i++){?>
  			<a target="_blank" href="<? echo $photo[$i]->url;?>"><img style="margin-top:5px; margin-left:5px;" width=98 height=80 border=0 src="<? echo $photo[$i]->src;?>"></a>
  		<? }?>
  	</td>
  </tr>
  <tr>
  	<td>
  		<div class=title1>东方人来风</div>
  		<? $newslist=$db->query('select * from smg_comment where resource_type="dfwszt" order by created_at desc');?>
  		<marquee height="100" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
				<? for($i=0; $i<count($newslist); $i++){?>
				<div style="width:100%; margin-left:10px; margin-bottom:10px; overflow:hidden; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->nick_name;?></span>说：<a style="text-decoration:none; color:#000000;" target="_blank" href="/news/news.php?id=16825"><? echo $newslist[$i]->comment;?></a></div>
				<? }?>
			</marquee>
			<div id=s_right>
				<div class="title"><span style="font-size:14px; color:red;">东方人来风</span></div>
				<form name="commentform" method="post" action="/pub/pub.post.php">
					<div id=subject_comment>昵称：<input type="text" name="post[nick_name]" id="commenter"/><br />
					<div id=comment>内容：</div><textarea id="commentcontent" name="post[comment]"></textarea></div>
					<input type="hidden" name="type" value="comment">
					<input type="hidden" id="resource_type" name="post[resource_type]" value="dfwszt">
					<button id=btn type="submit">发　表</button>
				</form>
			</div>
  	</td>
  	<td valign=top>
  		<table>
  			<tr>
  				<td >
  					<? $news=$db->query('select n.photo_src,n.title,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="东方风潮" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc, n.last_edited_at desc limit 7');?>
			  		<div class=index_title style="margin-top:0px;" >东方风潮<a target="_blank" href="/news/newslist.php?type=dfwszt&id=<?php echo $news[0]->cid;?>">更多</a></div>
			  		<DIV style="width:40%; margin-top:10px; margin-left:10px; float:left; display:inline;">
			          <? for($i=0;$i<count($news);$i++){if($news[$i]->photo_src!=""){?><A href="/news/news.php?id=<? echo $news[$i]->id;?>" target=_blank><IMG border=0 height=140 src="<? echo $news[$i]->photo_src;?>" width=200 border=0 style="margin-left:5px;"></A><? break;}}?>
			      </DIV>
			  		<div style="width:50%; margin-top:10px; float:left; display:inline;">
			  		<? for($i=0;$i<count($news);$i++){?>
			      <DIV align=left style="width:100%; height:20px; margin-left:20px; line-height:20px; overflow:hidden; float:left; display:inline;"><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div><? }?></div>
			      	
  				</td>
  			</tr>
  			<tr>
  				<td>
  					<? $news=$db->query('select n.photo_src,n.title,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="东方风尚" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc, n.last_edited_at desc limit 7');?>
  					<div class=index_title style="margin-top:0px;" >东方风尚<a target="_blank" href="/news/newslist.php?type=dfwszt&id=<?php echo $news[0]->cid; ?>">更多</a></div>
  					<div style="width:50%; margin-top:10px; float:left; display:inline;">
			  		<? for($i=0;$i<count($news);$i++){?>
			      <DIV align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div><? }?></div>
			      <DIV style="width:40%; margin-top:10px; margin-right:25px; float:left; display:inline;">
			          <? for($i=0;$i<count($news);$i++){if($news[$i]->photo_src!=""){?><A href="/news/news.php?id=<? echo $news[$i]->id;?>" target=_blank><IMG border=0 height=140 src="<? echo $news[$i]->photo_src;?>" width=200 border=0 style="margin-left:5px;"></A><? break;}}?>
			      </DIV>	
			  	</td>
  			</tr>
  		</table>
  	</td>
  </tr>
  <tr>
  	<td colspan=2>
  		<script language="javascript">
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
		  	<? $photo=$db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="东方传统品牌" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc,n.created_at desc')?>
		  <!--#####滚动区域#####-->
		    <div id="scroll_div" class="scroll_div">
		      <div id="scroll_begin">
		        <ul>
		        	<? for($i=0;$i<count($photo);$i++){?>
		          <li><a href="<? echo $photo[$i]->url;?>"><img width=98 height=80 src="<? echo $photo[$i]->src;?>"  /></a></li>
		          <? }?>
		        </ul>
		      </div>
		      <div id="scroll_end"></div>
		    </div>
		  <!--#####滚动区域#####-->
		  </div>
		  <script type="text/javascript">ScrollImgLeft();</script>
		</div>

  	</td>
  </tr>
  <tr>
  	<td valign=top>
  		<table>
  			<tr>
  				<td valign=top>
  					<div style="margin-top:10px; margin-left:10px;">
						<? $photo = $db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="东方发展观" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc,n.created_at desc limit 8');
							$picsurl10 = array();
							$picslink10 = array();
							$picstext10 = array();
							for ($i=0;$i<count($photo);$i++)
							{
								$picsurl10[]=$photo[$i]->url;
								$picslink10[]=$photo[$i]->src;
								$picstext10[]=$photo[$i]->short_title;
							}
							?>
							<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
							<div id="focus_10"></div> 
							<script type="text/javascript"> 
								var pic_width=216; //图片宽度
								var pic_height=180; //图片高度
								var pics10="<?php echo implode(',',$picsurl10);?>";
								var mylinks10="<?php echo implode(',',$picslink10);?>";								
								var texts10="<?php echo implode(',',$picstext10);?>";				 
								var picflash = new sohuFlash("/flash/focus.swf", "focus_10", "216", "180", "8","#FFFFFF");
								picflash.addParam('wmode','opaque');
								picflash.addVariable("picurl",pics10);
								picflash.addVariable("piclink",mylinks10);
								picflash.addVariable("pictext",texts10);				
								picflash.addVariable("pictime","5000");
								picflash.addVariable("borderwidth","216");
								picflash.addVariable("borderheight","180");
								picflash.addVariable("borderw","false");
								picflash.addVariable("buttondisplay","true");
								picflash.addVariable("textheight","20");
								picflash.addVariable("textcolor","#FF0000");	
								picflash.addVariable("pic_width",pic_width);
								picflash.addVariable("pic_height",pic_height);								
								picflash.write("focus_10");				
							</script>
						</div>
  				</td>
  			</tr>
  		</table>
  	</td>
  	<td valign=top>
  		<? $news=$db->query('select n.photo_src,n.title,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="东方风采" inner join smg_subject s on c.subject_id=s.id and s.name="东方卫视改版专题" order by n.priority asc, n.last_edited_at desc limit 10');?>
  		<div class=index_title ><span style=color:red; font-weight:bold;">东方风采</span><a target="_blank" href="/news/newslist.php?type=dfwszt&id=<?php echo $news[0]->cid;?>">更多</a></div>
  		<DIV style="width:48%; margin-top:10px; margin-left:20px; float:left; display:inline;">
		<? for($i=0;$i<5;$i++){?>
	      <DIV align=left style="width:100%; height:20px; line-height:25px; overflow:hidden; float:left; display:inline;"><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
		  <? }?>
	      </DIV>
	  		<div style="width:48%; margin-top:10px; float:left; display:inline;">
	  		<? for($i=5;$i<count($news);$i++){?>
	      <DIV align=left style="width:100%; height:20px;  line-height:25px; overflow:hidden; float:left; display:inline;"><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div><? }?></div>
		  <div class=index_title>外网链接</div>
  					<div style="width:100%; height:20px; line-height:20px; margin-left:10px; float:left; display:inline;"><a target="_blank" href="http://www.dragontv.cn/">东方卫视官方网站</a></div>
	</td>
  </tr>
</TABLE>
<div id="mm">
</div>
</BODY></HTML>
