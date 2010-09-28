<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<TITLE>SMG足球联赛</TITLE>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<? css_include_tag('show_vote.css'); ?>
<LINK href="css/index.css" type=text/css rel=stylesheet>
<?php 
	js_include_once_tag('total');
	use_jquery();
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
	total("专题-SMG足球联赛","other");
</script>
</HEAD>
<body>
<TABLE cellSpacing=0 cellPadding=0 width=770 align=center border=0>

  <TBODY>
  <TR>
    <TD><IMG height=385 src="css/logotop1.jpg" width=770></TD>
    </TR></TBODY></TABLE>
<div style="width:770px; background:#ffffff; margin:0 auto; margin-bottom:50px;">
<TABLE style="background:#ffffff" cellSpacing=0 cellPadding=0 width=770 align=center border=0 >
  <tr valign=top>
  	<td id="show_video" width=340>
  		<?php
			  $show = $db->query('select n.id,n.title,n.src,n.category_id from smg_images n inner join smg_category c on c.id=n.category_id and c.name="秀一秀" where n.is_adopt=1 order by n.dept_priority asc limit 1');
		?>
		<div style="width:330px; height:250px; float:left; display:inline;">
  		<div class=index_title2><div class="more"><a href="football_list.php">更多</a></div></div>
  		<div style="width:305px; margin-top:15px; margin-left:25px; float:left;display:inline;">
			<?php 
	$sql = 'select i.id as img_id,i.title,i.src,i.priority as ipriority from smg_images i left join smg_category c on i.category_id=c.id where i.is_dept_adopt=1 and c.name="秀一秀" order by i.dept_priority asc,i.created_at desc limit 4';
	$record_ad=$db -> query($sql);
	$count = count($record_ad);
	for($i=0;$i<$count;$i++){
		$picsurl[]=$record_ad[$i]->src;
		$picslink[]='/show/show.php?id='.$record_ad[$i]->img_id;
		$picstext[]=flash_str_replace($record_ad[$i]->title);
	}
?>

<?php if($count==1){?>
	<a href="/show/show.php?id=<?php echo $record_ad[0]->img_id?>" target=_blank><img src="<?php echo $record_ad[0]->src?>" width=270px; height=180px; border=0></a>
<? }else{?>
	<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
	<div id="focus_02"></div> 
	<script type="text/javascript"> 
	var pic_width1=300; //图片宽度
	var pic_height1=180; //图片高度
	var pics="<?php echo implode(',',$picsurl);?>";
	var mylinks="<?php echo implode(',',$picslink);?>";
	var texts="<?php echo implode(',',$picstext);?>";
	
	var picflash = new sohuFlash("/flash/focus.swf", "focus_02", pic_width1, pic_height1, "4","#FFFFFF");
	picflash.addParam('wmode','opaque');
	picflash.addVariable("picurl",pics);
	picflash.addVariable("piclink",mylinks);
	picflash.addVariable("pictext",texts);
	picflash.addVariable("pictime","5");
	picflash.addVariable("borderwidth",pic_width1);
	picflash.addVariable("borderheight",pic_height1);
	picflash.addVariable("borderw","false");
	picflash.addVariable("buttondisplay","true");
	picflash.addVariable("textheight","15");
	picflash.addVariable("pic_width",pic_width1);
	picflash.addVariable("pic_height",pic_height1);
	picflash.write("focus_02");
	</script>
<? }?>
		</div>
		</div>
  	</td>
  	<? $news=$db->query('select n.id,n.title,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_category c on c.id=n.category_id and c.name="看一看" where n.is_adopt=1 order by n.priority asc, n.last_edited_at desc limit 10');?>
  	<td valign=top align="right" width=430 id="i_am_mcdull">
  		<div style="width:430px; height:230px; float:left; display:inline;">
  		<div class=index_title><div class="more" style="margin-right:25px;"><a href="/news/news_list.php?id=<? echo $news[0]->cid;?>">更多</a></div></div>
		<div style="width:405px; height:220px; margin-top:5px; margin-left:25px; font-size:16px; overflow:hidden; color:#ec805a; float:left; display:inline;">
			<div id="box1">
				<? for($i=0; $i<count($news); $i++){?>
					<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
				<? }?>
	     	</div>
		</div>
		</div>
  	</td>
  </tr>
  <tr valign=top>
  	<td align=left colspan=2 id="mcdull_picture">
  		<div class=title2></div>
  		<div style="width:100%; height:90px; float:left; display:inline;">
		<DIV id=Layer5 style="margin-left:35px; width:100%; float:left; display:inline;">
				      <DIV id=demo6 style="OVERFLOW: hidden; WIDTH: 95%; float:left; display:inline;">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo7 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=left>
				              	<?php
									$marry=$db->query('select n.photo_src,n.id,n.title,n.description,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_category c on c.id=n.category_id and c.name="点一点" where n.is_adopt=1 order by n.priority asc, n.last_edited_at desc');
									for($i=0;$i<count($marry);$i++){
								?>
				                <TD><div class=content>
							<div class=pic><a target="_blank" href="/news/news.php?id=<? echo $marry[$i]->id;?>"><img border=0 width=100 height=70 src="<?php echo $marry[$i]->photo_src;?>"></a></div>
							<div class=context style="text-align:center"><a target="_blank" href="/news/news.php?id=<? echo $marry[$i]->id;?>"><?php echo $marry[$i]->title;?></a><br></div>
						</div></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id="demo8" vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								        var demo6 = document.getElementById('demo6');
										var demo7 = document.getElementById('demo7');
										var demo8 = document.getElementById('demo8');  
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo8.innerHTML=demo7.innerHTML
											function Marquee(){
											if(demo8.offsetWidth-demo6.scrollLeft<=0)
											demo6.scrollLeft-=demo7.offsetWidth
											else{
											demo6.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo6.onmouseover=function() {clearInterval(MyMar)}
											demo6.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
				</DIV>
		</div>
  	</td>
  </tr>
</table>
<table  cellSpacing=0 cellPadding=0 width=770 align=center border=0>
  <tr>
  	<td id="mail_to_mcdull" width=200>
  		<div style="width:200px; height:295px; margin-left:22px; background:url(css/tomcdull.jpg); padding-top:55px;">
			<? $newslist=$db->query('select * from smg_comment where resource_type="football" order by created_at desc');?>
	  		<marquee height="210" width="190" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
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
			  		<div id="box1" style="width:55%">
						<? for($i=0; $i<count($news); $i++){?>
							<div align=left style="width:100%; height:20px; margin-left:15px; line-height:20px; overflow:hidden; float:left; display:inline;"><img src="/images/index/icon03.gif" /><a style="font-weight:bold;" target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a></div>
						<? }?>
			     	</div>
					<div id="box3">
						<a href="sub.php?type=show" target="_blank"><img border=0 src="css/sh.jpg"></a>
					</div>
  				</td>
  			</tr>
  			<tr>
  				<td id="mcdull_information">
  					<? $news=$db->query('select n.photo_src,n.id,n.description,n.title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="麦兜资料馆" inner join smg_subject s on c.subject_id=s.id and s.name="麦兜专题" order by i.priority asc, n.last_edited_at desc limit 7')?>
  					<div id=title4></div>
  					<div id="box2">
  						<!--<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="500" height="300">
					      <param name=movie value="/flash/football1.swf">
					      <param name=quality value=high>
					      <param name="wmode" value="transparent">
					      <embed src="/flash/football1.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="500" height="300" wmode="transparent"></embed>
					    </object>-->
								<?	
									$vote = new smg_vote_class();
									$vote->find(268);
									$vote->display(array("target"=>"_blank",'submit_src'=>'/images/news/news_vote_button.jpg','view_src'=>'/images/news/news_view_button.jpg'));
								?>
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
	