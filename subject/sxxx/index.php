﻿<?
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -三项教育首页</title>
	<?php css_include_tag('sxxx');
		use_jquery();
		js_include_once_tag('dj','total');
	?>
<script>
	total("专题-三项学习教育","other");
</script>
</head>
<body>
	<div id=bodys>
			
		<? include('inc/djtop.inc.php');?>
					<div id=right>
						<div class=gd style="background:url(/images/bg/sxxx_hdjy.jpg) no-repeat;">
							<? $news = $db->query('select n.photo_src,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="活动剪影" inner join smg_subject s on c.subject_id=s.id and s.name="三项学习教育专题" order by n.priority asc,n.last_edited_at desc limit 6');?>
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
				                <TD><a target="_blank" href="djlist.php?id=131"><img border=0 width=130 height=90 src="<? echo $news[$i]->photourl; ?>"></a></TD>
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
						<div class=title>经典论述<div class=more><a target="_blank" href="djlist.php?id=<?php echo $jdls[0]->cid; ?>">更多</a></div></div>
						<div class=title>最新动态<div class=more><a target="_blank" href="djlist.php?id=<?php echo $zxdt[0]->cid; ?>">更多</a></div></div>
						<div style="width:350px; float:left; display:inline;">
							<? 
									$photourl="";
									for($i=0;$i<count($jdls);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$jdls[$i]->photo_src;	
									 }
									}
							?>
							<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
							
								<? 	
								for($i=0;$i<count($jdls);$i++){?>
								<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $jdls[$i]->id;?>"><? echo $jdls[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div>
								<?php } }?>	
						</div>

							<?  
								$photourl="";
									for($i=0;$i<count($zxdt);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$zxdt[$i]->photo_src;	
									 }
									}
							?>
							<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
							
								<?
								for($i=0;$i<count($news);$i++){?>
									<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $zxdt[$i]->id;?>"><? echo $zxdt[$i]->short_title;?></a></div>
									<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
							
						<div class=bg>
							<div class=title style="margin-left:10px;">领导讲话<div class=more><a target="_blank" href="djlist.php?id=<?php echo $ldjh[0]->cid; ?>">更多</a></div></div>
							<div class=title style="margin-left:10px;">学习心得<div class=more><a target="_blank" href="djlist.php?id=<?php echo $xxxd[0]->cid; ?>">更多</a></div></div>
							<div style="width:350px; float:left; display:inline;">
								<? 
									$photourl="";
									for($i=0;$i<count($ldjh);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$ldjh[$i]->photo_src;	
									 }
									}
								?>
								<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
									
										<? 	
										for($i=0;$i<count($ldjh);$i++){?>
										<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<?php echo $ldjh[$i]->id;?>"><?php echo $ldjh[$i]->short_title;?></a></div>
										<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
										<? }?>
									
							</div>
						<? 
								$photourl="";
									for($i=0;$i<count($xxxd);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$xxxd[$i]->photo_src;	
									 }
									}
						?>
						<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
						
							<?
							for($i=0;$i<count($xxxd);$i++){?>
								<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $xxxd[$i]->id;?>"><? echo $xxxd[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
							<? }?>
						
						</div>
						<!--<div class=gd style="background:url(/images/bg/sxxx_wwjt.jpg) no-repeat;">
							<? $news1 = $db->query('select n.photo_src from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="我为集团献一计" inner join smg_subject s on c.subject_id=s.id and s.name="三项学习教育专题" order by n.priority asc, n.last_edited_at desc');?>
							<DIV id=Layer6>
				      <DIV id=demo3 style="OVERFLOW: hidden; WIDTH: 100%; COLOR: #ffffff">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo4 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=middle>
				              	<? for($i=0;$i<count($news1);$i++){?>
				                <TD><a target="_blank" href="djlist2.php"><? if($news1[$i]->photo_src!=""){?><img border=0 width=130 height=90 src="<? echo $news1[$i]->photo_src;?>"><? }?></a></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id=demo5 vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
												var speed1=30//速度数值越大速度越慢
												demo5.innerHTML=demo4.innerHTML
												function Marquee1(){
												if(demo5.offsetWidth-demo3.scrollLeft<=0)
													demo3.scrollLeft-=demo4.offsetWidth
												else{
													demo3.scrollLeft++
													}
												}
												var MyMar1=setInterval(Marquee1,speed1)
												demo3.onmouseover=function() {clearInterval(MyMar1)}
												demo3.onmouseout=function() {MyMar1=setInterval(Marquee1,speed1)}
												</SCRIPT>
								</DIV>
						</div>-->
						<div class=bg>
							<div class=title style="margin-left:10px;">专题讲座<div class=more><a target="_blank" href="djlist.php?id=<?php echo $ztjz[0]->cid;?>">更多</a></div></div>
							<div class=title style="margin-left:10px;">规章制度<div class=more><a target="_blank" href="djlist2.php">更多</a></div></div>	
							<div style="width:350px; height:120px; float:left; display:inline;">
								<? 
									for($i=0;$i<count($ztjz);$i++){?>
									<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline">
										<img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $ztjz[$i]->id;?>"><? echo $ztjz[$i]->short_title;?></a>
									</div>
									<? if($i<2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div>
									<? }}?>
								
							</div>
							<div style="width:330px; height:120px; float:right; display:inline">
							<? 
							 for($i=0;$i<count($ztjz);$i++){?>
								<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $ztjz[$i]->id;?>"><? echo $ztjz[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
							</div>
							<div class=title style="margin-left:10px;">我的承诺<div class=more><a target="_blank" href="djlist.php?id=<?php echo $zsbd[0]->cid;?>">更多</a></div></div>
							<div class=title style="margin-left:10px;">我的博客</div>
							<div style="width:350px; height:90px; float:left; display:inline;">
								<? 
								$comments = $db->paginate('select * from smg_comment where resource_type="sxxx" order by created_at desc',5);
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
									  <div id=plleft>承诺：</div><textarea id="commentcontent" name="post[comment]"></textarea>
								   </div>   
								   <div id=content11></div>
								   	<input type="hidden" id="resource_type" name="post[resource_type]" value="sxxx">
									<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
									<input type="hidden" name="type" value="comment">
								   <input type="hidden" value="<? echo count($data,COUNT_RECURSIVE);?>">
									<input type="hidden" value="<? echo count($deptname);?>">
								</form>
							</div>
							<? $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="我的博客" inner join smg_subject s on c.subject_id=s.id and s.name="三项学习教育专题" order by n.priority asc, n.last_edited_at desc limit 6'); ?>
							
								<? for($i=0;$i<count($news);$i++){?>
								<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a <? if($i<1){?>style="color:red; font-weight:bold;"<? }?> target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<? include('inc/djbottom.inc.php');?>
</div>
</body>
</html>
