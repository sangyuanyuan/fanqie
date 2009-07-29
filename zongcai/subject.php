
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG   -总裁奖</title>
	<link href="/css/subject.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>
</head>
<body>
	<? 
		require_once('../libraries/sqlrecordsmanager.php');
		require_once('../inc/pubfun.inc.php');
		require_once('../modules/mod_vote/mod_class_define.php');
		$pageindex = isset($_REQUEST['pageindex']) ? $_REQUEST['pageindex'] : 1;
		$sqlmanager = new SqlRecordsManager();		
		$newslist = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=49  order by priority,pubdate desc',1,5);
		$pic = $sqlmanager->GetRecords('select * from smg_photo where main_cate_id=27 order by priority asc,createtime desc',1,1);		
		$programlist = $sqlmanager->GetRecords("select * from smg_news where main_cate_id=57 order by pubdate desc",($pageindex-1)*10+1, 10);
?>
	<script language="javascript" charset="utf-8">
		var dept_id = RequestCookies("smg_dept","");
		AddSiteClickcount(dept_id);		
	</script>
	<div id=subject_body>
		<div id=subject_logo>
		</div>
		<div class=subject_title>
			<a href="/">网站首页</a>|<a href="/news/newslist.php?id=49">最新动态</a>|<a href="/subject/subjectlist.php">候选作品</a>|<a href="/subject/subjectlist.php?state=2">历届参评节目</a>|<a href="/news/newslist.php?id=77">荣誉榜单</a>|<a href="cxjyt.php">创新经验坛</a>
		</div>
		<div id=subject_content1>
			<div id=top>
				
				<div id=left>
					<img width=190 height=140 src=<? echo $pic[0]->photourl;?> >
				</div>
				
				<div id=middle>
					<div id=title><a href="/news/news.php?id=<? echo $newslist[0]->id; ?>"><? echo $newslist[0]->title;?></a></div>
					<div id=center><? echo strfck($newslist[0]->description);?></div>
					<div id=bottom><a href="/news/news-subject.php?id=4512">评选说明</a><a href="/news/news-subject.php?id=4513">奖项设置</a><a href="/news/news-subject.php?id=4515">评选流程</a><a href="/subject/signup.php">参评表格填写</a></div>
				</div>
				<div id=right>
					<div id=top>
					<?php
						  $video = $sqlmanager->GetRecords('select * from smg_video where isadopt = 1 and isshowongrouppage=1 and main_cate_id=10 order by priority asc, createtime desc',1,1);
						  ShowMediaPlay(190,120,$video[0]->photourl,$video[0]->videourl);
						?>
					</div>
					<div id=bottom><div id=his>获奖节目</div><div id=more><a href="/video/videolist2.php?id=10">更多</a></div></div>
				</div>
			</div>
			
			<div id=bottom>
				<div id=left>
					<? $news = $sqlmanager->GetRecords('select * from smg_news where main_cate_id=79  order by priority,pubdate desc',1,5);?>
						<div class=title><div class=t1>最新动态</div><a href="/news/newslist.php?id=79">more</a></div>
						<div id=alist style="width:550px; border-right:1px solid #ffffff; border-bottom:1px solid #ffffff; border-left:1px solid #ffffff;"><? for($i=0;$i<count($news);$i++){?><a style="width:350px; margin-top:5px; margin-left:10px; color:#7B3200; text-decoration:none; float:left; dispaly:inline;" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->title;?></a><div style="margin-top:5px; margin-right:10px; float:right; display:inline;"><? echo $news[$i]->pubdate; ?>
							</div><? }?></div>	
						<? for($i=1;$i<=4;$i++)
							{
								$vote = new mod_vote('smg_subject_');
								$vote->loadvote($i);
								if ($vote->getvoteitemscount()<=0)
								{
									continue;
								}
							?>
						<div class=title>
							<div class=t1>
								<? if ($i==1) echo '电视推荐';else if ($i==2) echo '电视自荐'; else if($i==3) echo '广播推荐'; else if ($i==4) echo '广播自荐'; ?>节目投票
							</div>
							<a href="/subject/subjectlist.php?state=2">more</a>
						</div>
						
						<div class=content>
							<?
							$vote->display(false);
							?>
						</div>						
					<? }?>	
				</div>
				
				<div id=right>
					<div class=title>
						<div class=t1>创新经验坛</div><a href="cxjyt.php">more</a>
					</div>
					
					<div class=content>
						<? for($i=0;$i<10&&$i<count($programlist);$i++){?>
							<div><a href="/news/news-subject.php?id=<? echo $programlist[$i]->id;?>"><? echo $programlist[$i]->shorttitle;?></a></div>
						<? }?>
					</div>
					<div class=title>
						<div class=t1>新闻图片</div>
						<a href="/news/newslist2.php">more</a>
					</div>
					
					<div class=content>
						<? 
						$newslist = $sqlmanager->GetRecords('select * from smg_news where  isshowongrouppage=1 and isadopt=1 and isphotonews=1 order by priority asc, pubdate desc',1,5);
						for($i=1;$i<count($newslist);$i++)
						{?>
						<div class=left>
							<a href="/news/news-subject.php?id=<? echo $newslist[$i]->id;?>"><img border=0 width=90 height=70 src="<? echo $newslist[$i]->photourl;?>" ></a>
						</div>
						<div class=right>
							<div class=shang>・<? echo $newslist[$i]->title;?></div>
							<div class=xia>
								<a href="/news/news-subject.php?id=<? echo $newslist[$i]->id;?>">查看详细>></a>
							</div>
						</div>
						<? }?>
					</div>
					
					<div class=title>
						<div class=t1>论坛</div><a href="/bbs/">more</a>
					</div>
					
					<div class=content>
						<script type="text/javascript" src="/bbs/api/javascript.php?key=threads_latesttop10%28subject%29"></script>
					</div>
				
				</div>
			</div>
			<div class=subject_title>发表评论<div id=more><a href="/comment/comment.php">更多评论>></a></div></div>
			<div id=context>
				
				<? 
				$pageindex = isset($_REQUEST['pageindex']) ?$_REQUEST['pageindex']:1;
				$comments = $sqlmanager->GetRecords('select * from smg_subject_comment order by createtime desc',$pageindex,5);
				$icount = !$comments ? 0 : count($comments);
				for($i=0;$i < $icount;$i++){?>
				<div class=comment>	
					<div class=title><div style="float:left; display:inline;"><? echo $comments[$i]->commenter;?></div><div style="margin-right:50px; float:right; display:inline"><? echo $comments[$i]->createtime;?></div></div>
					<? echo $comments[$i]->content;?>
				</div>
				<? }?>
				<div id=page>
				<? PrintPageUrl('/subject/subject.php',$pageindex,$sqlmanager->pagecount);?>
				</div>
				<form name="commentform" method="post" action="/subject/createcomment.php">
				<div id=subject_comment>用户：<input type="text" name="commenter" id="commenter"/><br /><div id=comment>评论：</div><textarea id="commentcontent" name="comment"></textarea></div>
				<button id=btn onclick="javascript:commentform.submit();">评　论</button>
				</form>
			</div>
		</div>
		<div id=subject_bottom>Copyright 2005-2006 MotorTrend.com.cn Science and Technology</div>
	</div>
</body>
</html>
<script language="JavaScript" type="text/javascript" >
		var dept_id = RequestCookies("smg_dept","");
	AddSiteClickcount(dept_id);
</script>
