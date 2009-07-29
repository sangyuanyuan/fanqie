<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<link href="/css/subject.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>
	<script type="text/javascript" language="javascript">
		AddClassClickcount(1);
	</script>
</head>
<body>
	<?
		require_once('../libraries/sqlrecordsmanager.php');
		require_once('../inc/pubfun.inc.php');
		require_once('../modules/mod_vote/mod_class_define.php');

		$pageindex = isset($_REQUEST['pageindex']) ? $_REQUEST['pageindex'] : 1;
		$sqlmanager = new SqlRecordsManager();			
		$programlist = $sqlmanager->GetRecords("select * from smg_news where main_cate_id=57 order by pubdate desc",($pageindex-1)*30+1, 30);
	?>
	<script language="javascript" charset="utf-8">
		var dept_id = RequestCookies("smg_dept","");
		AddSiteClickcount(dept_id);		
	</script>
	<div id=subject_body>
		<div id=subject_logo></div>
		<div class=subject_title><a href="/" style="color:#FFFFFF;text-decoration:none"> 首页</a> >　<a href="/subject/subject.php" style="color:#FFFFFF;text-decoration:none"> 总裁奖</a>  >　参评节目一览</div>
		<div id=subject_content1>
		<div id=bottom>
			<div id=subject_contenta style="width:550px; padding-top:20px;">
				<div id=listtitle style="font-size:15px; font-weight:bold; margin-left:20px;">创新经验坛</div>
				<div id=alist style="width:540px; margin-top:10px; margin-left:15px;">
					<? for($i=0;$i<count($programlist);$i++){?>
						<div style="width:370px; margin-top:5px; margin-left:10px; color:#7B3200; text-decoration:none; float:left; dispaly:inline;overflow:hidden;">
							 <a href="/news/news.php?id=<?php echo $programlist[$i]->id;?>"><?php echo $programlist[$i]->title;?></a> <?php echo $programlist[$i]->pubdate;?>
						</div>
					<? }?>
				</div>
			<div id=context1>
				<div id=page1>
				  <? PrintPageUrl("/subject/subjectlist.php?state=$state",$pageindex,$sqlmanager->pagecount); ?>
				</div>
			</div>	
		</div>
					
			<div id=right>
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
							<a href="/news/news.php?id=<? echo $newslist[$i]->id;?>"><img border=0 width=90 height=70 src=<? echo $newslist[$i]->photourl;?>></a>
						</div>
						<div class=right>
							<div class=shang>·<? echo $newslist[$i]->title?></div>
							<div class=xia>
								<a href="/news/news.php?id=<? echo $newslist[$i]->id;?>">查看详细>></a>
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
		`	<div id=context>
				
				<? 
				$pageindex = isset($_REQUEST['pageindex']) ?$_REQUEST['pageindex']:1;
				$comments = $sqlmanager->GetRecords('select * from smg_subject_comment order by createtime desc',$pageindex,5);
				for($i=0;$i<count($comments);$i++){?>
				<div class=comment>	
					<div class=title><div style="float:left; display:inline;"><? echo $comments[$i]->commenter;?></div><div style="margin-right:50px; float:right; display:inline"><? echo $comments[$i]->createtime;?></div></div>
					<? echo $comments[$i]->content;?>
				</div>
				<? }?>
				<div id=page>
				<? PrintPageUrl('/subject/subjectlist.php',$pageindex,$sqlmanager->pagecount);?>
				</div>
				<form name="commentform" method="post" action="/subject/createcomment.php">
				<div id=subject_comment>用户：<input type="text" name="commenter" id="commenter"/><br /><div id=comment>评论：</div><textarea id="commentcontent" name="comment"></textarea></div>
				<button id=btn onclick="javascript:commentform.submit();">评　论</button>
				</form>
			</div>
		</div>
		<div id=subject_bottom>Copyright 2005-2006 MotorTrend.com.cn Science and Technology</div>
		</div>
		
	</div>
</body>
</html>
<script language="JavaScript" type="text/javascript" >
		var dept_id = RequestCookies("smg_dept","");
	AddSiteClickcount(dept_id);
</script>
