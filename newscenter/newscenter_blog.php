<?
	require_once('../frame.php');
  $db = get_db();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -新闻中心博客首页</title>
	<?php css_include_tag('newscenter_blog');
		use_jquery();
		js_include_once_tag('dj','total');
	?>
	<script>
	total("SMG-新闻中心博客首页","news");
</script>
</head>
<body>
	<div id=bodys>
		<div id=logo></div>
		<div id=title><div class="cl"><a target="_blank" href="index.php">首页</a></div><div class="cl"><a target="_blank" href="http://172.27.203.81:8080/blog/?uid-3366-action-spacelist-type-blog-itemtypeid-140">记者手记</a></div><div class="cl"><a target="_blank" href="http://172.27.203.81:8080/blog/?uid-3366-action-spacelist-type-blog-itemtypeid-141">美丽新闻人</a></div><div class="cl"><a target="_blank" href="http://172.27.203.81:8080/blog/?uid-3366-action-spacelist-type-blog-itemtypeid-142">节目推介</a></div><div class="cl"><a target="_blank" href="/news/news_list.php?id=220">世博行动</a></div></div>
			<div style="width:1002px; background:#339900;">
				<div id=content>
					<div id=context>
					<div id=right>
						<div class=gd>
							<? $news = $db->query('select n.id,n.photo_src,n.short_title from smg_news n where n.category_id=219 and is_adopt=1 order by n.priority asc,n.created_at desc');?>
					<DIV id=Layer5>
				      <DIV id=demo style="OVERFLOW: hidden; WIDTH: 100%; COLOR: #ffffff">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo1 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=middle>
				              	<? for($i=0;$i<count($news);$i++){?>
				                <TD><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><img border=0 width=130 height=90 src="<? echo $news[$i]->photo_src; ?>"></a><br><a style="width:130px; height:30px; line-height:15px; margin-bottom:10px; overflow:hidden; float:left; display:inline;" target="_blank" href=""><?php echo $news[$i]->short_title; ?></a></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id=demo2 vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
										var speed=30//速度数值越大速度越慢
										demo2.innerHTML=demo1.innerHTML
										function Marquee(){
										if(demo2.offsetWidth-demo.scrollLeft<=0)
										demo.scrollLeft-=demo1.offsetWidth
										else{
										demo.scrollLeft++
										}
										}
										var MyMar=setInterval(Marquee,speed)
										demo.onmouseover=function() {clearInterval(MyMar)}
										demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
									 </SCRIPT>
								</DIV>
						</div>
						<div class=bg>
							<div class=title>记者手记<div class=more><a target="_blank" href="http://172.27.203.81:8080/blog/?uid-3366-action-spacelist-type-blog-itemtypeid-140">更多</a></div></div>
							<div class=title>美丽新闻人<div class=more><a target="_blank" href="/news/news_list.php?id=221">更多</a></div></div>
							<div style="width:470px; float:left; display:inline;">
								<?php $news=$db->query('select itemid,subject from blog_spaceitems where uid=3366 and itemtypeid=140 order by dateline desc limit 6') ?>
								<div class=pic><img border=0 width=98 height=90 src="/images/newscenter/1.jpg"></div>
									<? 	
									for($i=0;$i<count($news);$i++){?>
									<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="http://172.27.203.81:8080/blog/?uid-3366-action-viewspace-itemid-<? echo $news[$i]->itemid;?>"><? echo $news[$i]->subject;?></a></div>
									<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
									<? }?>
								
							</div>
							<? $news = $db->query('select n.id,n.photo_src,n.short_title from smg_news n where n.category_id=221 and is_adopt=1 order by n.priority asc,n.created_at desc limit 6');?>
								<div class=pic><img border=0 width=98 height=90 src="/images/newscenter/2.jpg"></div>
							<?
							for($i=0;$i<count($news);$i++){?>
								<div style="width:290px;height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="/news/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
							<? }?>
						</div>
						<div class=bg>
							<div class=title>节目推介<div class=more><a target="_blank" href="http://172.27.203.81:8080/blog/?uid-3366-action-spacelist-type-blog-itemtypeid-142">更多</a></div></div>
							<div class=title>世博行动<div class=more><a target="_blank" href="/news/news_list.php?id=220">更多</a></div></div>
							<div style="width:470px; float:left; display:inline;">
								<?php $news=$db->query('select itemid,subject from blog_spaceitems where uid=3366 and itemtypeid=142 order by dateline desc limit 6') ?>
								<div class=pic><img border=0 width=98 height=90 src="/images/newscenter/3.jpg"></div>
										<? 	
										for($i=0;$i<count($news);$i++){?>
										<div style="width:285px;height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="http://172.27.203.81:8080/blog/?uid-3366-action-viewspace-itemid-<? echo $news[$i]->itemid;?>"><? echo $news[$i]->subject;?></a></div>
										<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
										<? }?>
									
							</div>
							<? $news = $db->query('select n.id,n.photo_src,n.short_title from smg_news n where n.category_id=220 and is_adopt=1 order by n.priority asc,n.created_at desc limit 6');?>
							<div class=pic><img border=0 width=98 height=90 src="/images/newscenter/4.jpg"></div>
							<?
							for($i=0;$i<count($news);$i++){?>
								<div style="width:290px;height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="/news/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
							<? }?>
						
						</div>
						<div class=bg>
							<div class=title>宣传动态<div class=more><a target="_blank" href="/news/news_list.php?id=224">更多</a></div></div>
							<div class=title>党员先锋</div>
							<div style="width:470px; float:left; display:inline;">
								<?php $news=$db->query('select n.id,n.photo_src,n.short_title from smg_news n where n.category_id=224 and is_adopt=1 order by n.priority asc,n.created_at desc limit 6') ?>
								<div class=pic><img border=0 width=98 height=90 src="/images/newscenter/5.jpg"></div>
										<? 	
										for($i=0;$i<count($news);$i++){?>
										<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="/news/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a></div>
										<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div>
										<? }}?>		
							</div>
							<? $news = $db->query('select n.id,n.photo_src,n.short_title from smg_news n where n.category_id=228 and is_adopt=1 order by n.priority asc,n.created_at desc limit 6');?>
							<div class=pic><img border=0 width=98 height=90 src="/images/newscenter/6.jpg"></div>
							<?
							for($i=0;$i<count($news);$i++){?>
								<div style="width:290px;height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="/news/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
							<? }?>
						</div>
						
						<div class=bg>
						<div id=contenttitle style="margin-left:8px;">网友留言</div>
							<? 
							$comments = $db->paginate('select * from smg_comment where resource_type="newscenter_blog" order by created_at desc',5);
							for($i=0;$i<count($comments);$i++){?>
								<div class=content7>
									<div class=name><a href="#"><?php echo $comments[$i]->nick_name; ?></a></div>	
									<div class=time><?php echo $comments[$i]->created_at; ?></div>	
									<div class=context><?php echo strfck($comments[$i]->comment); ?></div>	
								</div>
								<? }?>						
							  <div class="pageurl">
							     <? paginate('');?>
							  </div>
							<form name="commentform" id="commentform" method="post" action="/pub/pub.post.php">
							   <div id=content9>
								   用户：<input type="text" value="" id="commenter" name="post[nick_name]">   	
							   </div>
							   <div id=content10>
								  <div id=plleft>意见：</div><textarea id="commentcontent" name="post[comment]"></textarea>
							   </div>   
							   <div id=content11></div>
							   	<input type="hidden" id="resource_type" name="post[resource_type]" value="newscenter_blog">
								<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
								<input type="hidden" name="type" value="comment">
							   <input type="hidden" value="<? echo count($data,COUNT_RECURSIVE);?>">
								<input type="hidden" value="<? echo count($deptname);?>">
							</form>
						</div>
					</div>
				</div>

</body>
</html>

