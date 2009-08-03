<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<link href="/css/department.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>
	<script type="text/javascript" src="../js/prototype-1.6.0.2.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
</head>
<body>
	<div id=east_body>
	<? $news=load_module('pos_topnews');?>
	<div id=east_title>
	<div id=move>
	<MARQUEE scrollAmount=1 scrollDelay=60 behavior=scroll  width="100%"><span style="float:left; display:inline">滚动新闻：</span>
	<? for($i=0;$i<$news-itemcount;$i++){?>
		<a href="/dfws/news.php?id=<? echo $news->items[$i]->id;?>">
		<? echo $news->items[$i]->title; ?>
		</a>
	<? }?>
	</MARQUEE>
	</div>
	<div id=login><span id=login1><a href="/admin">登录</a></span><span id=login2></span><span id="login3"><a href="/admin/logout.php">退出</a></span><span id=login4 style="display:none"><a href="" id=login_admin>后台管理</a></span></div></div>
		<div id=east_logo><img src="/images/inner/logo.gif"></div>
		<div id=east_content>
			<div id=top>
				<div id=search><input id='cz' type="text" />　　|<button onclick="searchnews('cz')">搜索</button></div>
			</div>
			<div id=context>
				<div id=top>
					<div id=left>
					<? 
						$newslist=load_module('pos_indexleft1',7);
						$newslist1=load_module('pos_indexleft2',10);
						$report=getcategoryreport();
					?>
						<div onMouseOver="ChangeDepartTab('1')" id=title1>
						<? echo $newslist->categoryname;?></div><div id=title2 onMouseOver="ChangeDepartTab('2')" class=title2><? echo $newslist1->categoryname;?></div><div id=title3 onMouseOver="ChangeDepartTab('3')" class=title2>数据统计</div>
						<div id="a1" class=content1>
							<div id=top1>
								<div id=left><img width=70 height=72 src="<? echo $newslist->items[0]->photourl;?>"></div>
								<div id=right><a style="font-size:12px;" href="news.php?id=<? echo $newslist->items[0]->id;?>" title="<? echo $newslist->items[0]->title;?>"><? echo $newslist->items[0]->shorttitle;?></a><br /><span style="color:#8C8C8C;"><? echo $newslist->items[0]->pubdate;?></div>
							</div>
							<div id=bottom><? for($i=1;$i<$newslist->itemcount;$i++){?><a style="font-size:12px;" href="/dfws/news.php?id=<? echo $newslist->items[$i]->id;?>"><? echo $newslist->items[$i]->title;?></a><? }?><div class=more><a style="width:25px; margin-top:-1px; font-size:11px;" href="<? echo $newslist->getmorelink();?>">更多</a><img width=14 height=9 src="/images/inner/more.gif"></div></div>
						</div>
						<div id="a2" style="display:none;" class=content1><div class=bottom2><? for($i=0;$i<$newslist1->itemcount;$i++){?><a style="font-size:12px;" href="/dfws/news.php?id=<? echo $newslist1->items[$i]->id;?>"><? echo $newslist1->items[$i]->title;?></a><? }?><div class=more><a style="width:25px; margin-top:-1px; margin-left:190px;" href="<? echo $newslist1->getmorelink();?>">更多</a><img width=14 height=9 src="/images/inner/more.gif"></div></div></div>
						<div id="a3" style="display:none;" class=content1><div class=bottom2><? for($i=0;$i<$report->itemcount;$i++){?><a style="font-size:12px;" href="#">
	<div style="float:left; display:inline;"><? echo $report->items[$i]->name;?></div>
	<div style="margin-right:50px; float:right; display:inline;"><? echo $report->items[$i]->clickcount;?></div>
	 <? }?>
	 <div class=more><a style="width:25px; margin-top:-1px; margin-left:190px;" href="<? echo $report->getmorelink();?>">更多</a><img width=14 height=9 src="/images/inner/more.gif"></div></div></div>
					</div>
					<div id=center>
						<?php
						  $video = load_module('pos_indexvideo',1);
						  ShowMediaPlay(378,250,$video->items[0]->photourl,$video->items[0]->videourl);
						?>
					</div>
					<div id=right1>
						<div id=title>热门博客</div>
						<div id=content1>
							
						</div>
					</div>
				</div>
				<? $photo=load_module('pos_indexbottompic',3)?>
				<div id=bottom1><img width=253 height=63 style="float:left; display:inline" src="<? echo $photo->items[0]->photourl; ?>"><img width=378 height=63 style=" float:left; display:inline;" src="<? echo $photo->items[1]->photourl; ?>"><!--<a href="mailto:sitv@dragontv.cn">--><img border=0 width=181 height=64 style=" float:left; display:inline" src="<? echo $photo->items[2]->photourl; ?>"><!--</a>--></div>
			</div>			
		</div>	
		<div id=east_bottom>
			<div id=assistant><a href="#">设为首页</a>|<a href="#">收藏本站</a>|<a href="http://www.dragontv.cn/">联系我们</a></div>
			<div id=wz>上海东方卫视 版权所有 .版权所有 All Right Reserved Copyright ? 2003-2008</div>
		</div>	
	</div>
	
	
	
	<?

   require_once("../modules/mod_menu/mod_class_menu.php");
   $menu = new menu("mymenu");
   //print_r($menu);
   $tree = $sqlmanager->GetRecords('select * from smg_menu_item');
   //$menu->addItem($tree[$i]->id,$tree[$i]->displayname,$tree[$i]->parent_id,$tree[$i]->url);
   for($i=0;$i<count($tree);$i++)
   {
		$menu->addItem($tree[$i]->id,$tree[$i]->displayname,$tree[$i]->parent_id,$tree[$i]->url);
	 }
	$menu->initial();   
?>

<div id=container>
			<? $menu->displaymenu();?>		
	</div>

	
	
</body>
</html>
<script language="javascript">
document.getElementById('mymenu_item1').innerHTML='<a href="/dfws/">首 页</a>';
document.getElementById('mymenu_item2').innerHTML='<a href="/dfws/newslist.php?id=4">今日必读</a>';
document.getElementById('mymenu_item3').innerHTML='<a href="/dfws/newslist.php?id=8">特别策划</a>';
document.getElementById('mymenu_item4').innerHTML='<a href="/dfws/newslist.php?id=9">部门动态</a>';
document.getElementById('mymenu_item5').innerHTML='<a href="/dfws/newslist.php?id=10">龙视部落</a>';
document.getElementById('mymenu_item6').innerHTML='<a href="#">BLOG</a>';
document.getElementById('mymenu_item7').innerHTML='<a href="/bbs/forumdisplay.php?fid=32">BBS</a>';
	var smg_username = RequestCookies("smg_username","");
	var smg_admin = RequestCookies("smg_admin","");
	if(smg_username!="")
	{
		document.getElementById("login1").style.display="none";
		document.getElementById("login2").innerHTML="　欢迎您　"+smg_username;
		document.getElementById("login3").style.display="inline";
		if(smg_admin=="7")
		{
			document.getElementById("login4").style.display="inline";
			document.getElementById("login_admin").href="/admin/admin.php";
		}
		if(smg_admin!="7"&&smg_admin!="0")
		{
			document.getElementById("login4").style.display="inline";
			document.getElementById("login_admin").href="/admin/admin2.php";
		}		
	}
//增加网站点击次数
var dept_id = RequestCookies("smg_dept","");
AddSiteClickcount(dept_id);	
</script>
<? CloseDB();?>
