<?
	require_once('../libraries/tablemanager.class.php');
  require_once('../libraries/sqlrecordsmanager.php');
  require_once('../inc/pubfun.inc.php');
  $sqlmanager = new SqlRecordsManager();
  $pageindex = isset($_REQUEST['pageindex']) ? $_REQUEST['pageindex']: 1;
	$deptsort=$sqlmanager->GetRecords('SELECT sum(s.clickcount) as djl,d.name FROM smg_news s right join smg_dept d on s.dept_id=d.id where main_cate_id in (63,64,65,66,67,68,69,70,71,72,73,74) group by s.dept_id order by djl desc',1,10);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -党建新闻列表</title>
	<link href="/css/dj.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>
	<script type="text/javascript" language="javascript">
		var dept_id = RequestCookies("smg_dept","");
		AddSiteClickcount(dept_id);
	</script>
</head>
<body>
	<div id=bodys>
			
		<? include('inc/djtop.inc.php');?>
					<div id=right>
						<div class=gd style="background:url(/images/bg/hdjy.jpg) no-repeat;">
							<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=72 and isadopt=1 order by priority asc, pubdate desc',1,6);?>
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
				                <TD><a target="_blank" href="djlist.php?id=72"><img border=0 width=130 height=90 src="<? echo $news[$i]->photourl; ?>"></a></TD>
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
						<div class=title>领导讲话<div class=more><a target="_blank" href="djlist.php?id=63">更多</a></div></div>
						<div class=title>步骤安排<div class=more><a target="_blank" href="djlist.php?id=67">更多</a></div></div>
						<div style="width:350px; float:left; display:inline;">
							<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=63 and isadopt=1 order by priority asc, pubdate desc',1,6);
									$photourl="";
									for($i=0;$i<count($news);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$news[$i]->photourl;	
									 }
									}
							?>
							<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
							
								<? 	
								for($i=0;$i<count($news);$i++){?>
								<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
							
						</div>

							<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=67 and isadopt=1 order by priority asc, pubdate desc',1,6); 
								$photourl="";
									for($i=0;$i<count($news);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$news[$i]->photourl;	
									 }
									}
							?>
							<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
							
								<?
								for($i=0;$i<count($news);$i++){?>
									<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
									<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
							
						<div class=bg>
							<div class=title style="margin-left:10px;">文件摘编<div class=more><a target="_blank" href="djlist.php?id=68">更多</a></div></div>
							<div class=title style="margin-left:10px;">经验介绍<div class=more><a target="_blank" href="djlist.php?id=69">更多</a></div></div>
							<div style="width:350px; float:left; display:inline;">
								<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=68 and isadopt=1 order by priority asc, pubdate desc',1,6);
									$photourl="";
									for($i=0;$i<count($news);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$news[$i]->photourl;	
									 }
									}
								?>
								<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
									
										<? 	
										for($i=0;$i<count($news);$i++){?>
										<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
										<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
										<? }?>
									
							</div>
						<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=69 and isadopt=1 order by priority asc, pubdate desc',1,6); 
								$photourl="";
									for($i=0;$i<count($news);$i++){
									 if($photourl=="")
									 {
									 	$photourl=$news[$i]->photourl;	
									 }
									}
						?>
						<div class=pic><img border=0 width=98 height=90 src="<? if($photourl!=""){echo $photourl;}else {echo '/images/logo.jpg';}?>"></div>
						
							<?
							for($i=0;$i<count($news);$i++){?>
								<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
							<? }?>
						
						</div>
						<div class=gd style="background:url(/images/bg/wwjt.jpg) no-repeat;">
							<? $news1 = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=73 and isadopt=1 order by priority asc, pubdate desc');?>
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
				                <TD><a target="_blank" href="djlist2.php"><? if($news1[$i]->photourl!=""){?><img border=0 width=130 height=90 src="<? echo $news1[$i]->photourl;?>"><? }?></a></TD>
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
						</div>
						<div class=bg>
							<div class=title style="margin-left:10px;">学习资料<div class=more><a target="_blank" href="djlist.php?id=70">更多</a></div></div>
							<div class=title style="margin-left:10px;">三分钟论坛<div class=more><a target="_blank" href="djlist2.php">更多</a></div></div>
							
							<div style="width:350px; float:left; display:inline;">
								<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=70 and isadopt=1 order by priority asc, pubdate desc',1,6); ?>
								
									<? for($i=0;$i<count($news);$i++){?>
									<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
									<? if($i<2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
									<? }?>
								
							</div>
							<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=71 and isadopt=1 order by priority asc, pubdate desc',1,6); ?>
							
								<? for($i=0;$i<count($news);$i++){?>
								<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
							<div class=title style="margin-left:10px;">即知即改<div class=more><a target="_blank" href="djlist.php?id=87">更多</a></div></div>
							<div class=title style="margin-left:10px;">三分钟答题</div>
							<div style="width:350px; height:90px; float:left; display:inline;">
								<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=87 and isadopt=1 order by priority asc, pubdate desc',1,6); ?>
									<? for($i=0;$i<count($news);$i++){?>
									<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
									<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
									<? }?>
							</div>
							<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=80 and isadopt=1 order by priority asc, pubdate desc',1,6); ?>
							
								<? for($i=0;$i<count($news);$i++){?>
								<div style="width:290px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a <? if($i<1){?>style="color:red; font-weight:bold;"<? }?> target="_blank" href="djcontent.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->shorttitle;?></a></div>
								<? if($i< 2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
						</div>
						<div class=bg>
						<div id=contenttitle style="margin-left:8px;">征求意见</div>
							<? 
							$comments = $sqlmanager->GetRecords('select * from smg_dj_comment where news_id=0 order by createtime desc',$pageindex,5);
							for($i=0;$i<count($comments);$i++){?>
								<div class=content7>
									<div class=name><a href="#"><?php echo $comments[$i]->commenter; ?></a></div>	
									<div class=time><?php echo $comments[$i]->createtime; ?></div>	
									<div class=context><?php echo strfck($comments[$i]->content); ?></div>	
								</div>
								<? }?>						
							  <div class="pageurl">
							     <? PrintPageUrl('/djnews/djnews.php',$pageindex,$sqlmanager->pagecount);?>
							  </div>
							<form name="commentform" method="post" action="/djnews/djcreatecomment.php">
							   <div id=content9>
								   用户：<input type="text" value="" id="commenter" name="commenter">   	
							   </div>
							   <div id=content10>
								  <div id=plleft>意见：</div><textarea id="commentcontent" name="comment"></textarea>
							   </div>   
							   <div id=content11 onClick="return PostComment();"></div>
							   <input type="hidden" value="<? echo count($data,COUNT_RECURSIVE);?>">
			<input type="hidden" value="<? echo count($deptname);?>">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<? include('inc/djbottom.inc.php');?>
</div>
</body>
</html>

