<?php
	 require_once('../../frame.php');
	 $n = $_COOKIE['smg_user_nickname'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>东方卫视</title>
	<link href="/css/department.css" rel="stylesheet" type="text/css">
	<?php
		css_include_tag('department');
		js_include_tag('prototype-1.6.0.2','menu');
		js_include_once_tag('total');
	?>
</head>
<script>
	total("东方卫视","news");	
</script>
<body>
	<div id=east_body>
		<? $news=show_content('smg_news','news','东方卫视','滚动新闻');?>
		<div id=east_title>
			<div id=move>
				<MARQUEE scrollAmount=1 scrollDelay=60 behavior=scroll  width="100%"><span style="float:left; display:inline">滚动新闻：</span>
				<? for($i=0;$i<count($news);$i++){?>
					<a href="news.php?id=<? echo $news[$i]->id;?>">
					<? echo $news[$i]->title; ?>
					</a>
				<? }?>
				</MARQUEE>
			</div>
			<div id=login>
				<span id=login1><a href="/login/login.php">登录</a></span>
				<span id=login2></span>
				<span id="login3"><a href="/login/user.post.php?user_type=logout">退出</a></span>
				<span id=login4 style="display:none"><a href="" id=login_admin>后台管理</a></span>
			</div>
		</div>
		<div id=east_logo><img src="/images/inner/logo.gif"></div>
		<div id=east_content>
			<div id=top>
				<div id=search><input id='cz' type="text" />　　|<button onclick="searchnews('cz')">搜索</button></div>
			</div>
			<div id=context>
				<div id=top>
					<div id=left>
					<? 
						$newslist=show_content('smg_news','news','东方卫视','新闻','7');
						$newslist1=show_content('smg_news','news','东方卫视','常用表格','10');
						$newslist2=show_content('smg_news','news','东方卫视','数据统计','10');
					?>
						<div onMouseOver="ChangeDepartTab('1')" id=title1>新闻</div>
						<div id=title2 onMouseOver="ChangeDepartTab('2')" class=title2>常用表格</div>
						<div id=title3 onMouseOver="ChangeDepartTab('3')" class=title2>数据统计</div>
						<div id="a1" class=content1>
							<div id=top1>
								<div id=left><img width=70 height=72 src="<? echo $newslist[0]->photo_src;?>"></div>
								<div id=right>
									<a style="font-size:12px;" href="news.php?id=<? echo $newslist[0]->id;?>" title="<? echo $newslist[0]->title;?>"><? echo $newslist[0]->short_title;?></a><br />
									<span style="color:#8C8C8C;"><? echo $newslis[0]->created_at;?></span>
								</div>
							</div>
							<div id=bottom><? for($i=1;$i<count($newslist);$i++){?><a style="font-size:12px;" href="news.php?id=<? echo $newslist[$i]->id;?>"><? echo $newslist[$i]->title;?></a><? }?><div class=more><a style="width:25px; margin-top:-1px; font-size:11px;" href="newslist.php?id=<?php echo $newslist[0]->dept_category_id;?>">更多</a><img width=14 height=9 src="/images/inner/more.gif"></div></div>
						</div>
						<div id="a2" style="display:none;" class=content1><div class=bottom2><? for($i=0;$i<count($newslist1);$i++){?><a style="font-size:12px;" href="news.php?id=<? echo $newslist1[$i]->id;?>"><? echo $newslist1[$i]->title;?></a><? }?><div class=more><a style="width:25px; margin-top:-1px; margin-left:190px;" href="newslist.php?id=<?php echo $newslist1[0]->dept_category_id; ?>">更多</a><img width=14 height=9 src="/images/inner/more.gif"></div></div></div>
						<div id="a3" style="display:none;" class=content1><div class=bottom2><? for($i=0;$i<count($newslist2);$i++){?><a style="font-size:12px;" href="news.php?id=<? echo $newslist2[$i]->id;?>"><? echo $newslist2[$i]->title;?></a><? }?><div class=more><a style="width:25px; margin-top:-1px; margin-left:190px;" href="newslist.php?id=<?php echo $newslist2[0]->dept_category_id; ?>">更多</a><img width=14 height=9 src="/images/inner/more.gif"></div></div></div>
					</div>
					<div id=center>
						<?php 
							$video = show_content('smg_video','video','东方卫视','首页视频','1');
							show_video_player(378,250,$video[0]->photo_url,$video[0]->video_url);
						?>
					</div>
					<div id=right1>
						<div id=title>热门博客</div>
						<div id=content1>
							
						</div>
					</div>
				</div>
				<? $photo=show_content('smg_images','picture','东方卫视','底部图片','3')?>
				<div id=bottom1><img width=253 height=63 style="float:left; display:inline" src="<? echo $photo[0]->src; ?>"><img width=378 height=63 style=" float:left; display:inline;" src="<? echo $photo[1]->src; ?>"><!--<a href="mailto:sitv@dragontv.cn">--><img border=0 width=181 height=63 style=" float:left; display:inline" src="<? echo $photo[2]->src; ?>"><!--</a>--></div>
			</div>			
		</div>	
		<div id=east_bottom>
			<div id=assistant><a href="#">设为首页</a>|<a href="#">收藏本站</a>|<a href="http://www.dragontv.cn/">联系我们</a></div>
			<div id=wz>上海东方卫视 版权所有 .版权所有 All Right Reserved Copyright ? 2003-2008</div>
		</div>	
	</div>
	<input type="hidden" id="nick_name" value="<?php echo $n;?>">
	
	
	<script type="text/javascript">
			if(window.attachEvent){
				window.attachEvent("onload",winLoad);
			}else if(window.addEventListener){
				window.addEventListener("load",winLoad,false);
			}else{
				window.onload = winLoad;
			}  
			
			function winLoad(){	
				var menu = new Menu("mymenu");
										var mymenu_item1 = new MenuItem($("mymenu_item1"));
						menu.addItem(mymenu_item1);
												var mymenu_item2 = new MenuItem($("mymenu_item2"));
						menu.addItem(mymenu_item2);
												var mymenu_item3 = new MenuItem($("mymenu_item3"));
						menu.addItem(mymenu_item3);
												var mymenu_item4 = new MenuItem($("mymenu_item4"));
						menu.addItem(mymenu_item4);
												var mymenu_item5 = new MenuItem($("mymenu_item5"));
						menu.addItem(mymenu_item5);
												var mymenu_item6 = new MenuItem($("mymenu_item6"));
						menu.addItem(mymenu_item6);
												var mymenu_item7 = new MenuItem($("mymenu_item7"));
						menu.addItem(mymenu_item7);
												var mymenu_item8 = new MenuItem(createLinkElement("办公室","newslist.php?id=28","_blank"));
						mymenu_item4.addItem(mymenu_item8);
												var mymenu_item9 = new MenuItem(createLinkElement("总编室","newslist.php?id=29","_blank"));
						mymenu_item4.addItem(mymenu_item9);
												var mymenu_item10 = new MenuItem(createLinkElement("人力资源","newslist.php?id=30","_blank"));
						mymenu_item4.addItem(mymenu_item10);
												var mymenu_item11 = new MenuItem(createLinkElement("落地办","newslist.php?id=31","_blank"));
						mymenu_item4.addItem(mymenu_item11);
												var mymenu_item12 = new MenuItem(createLinkElement("推广部","newslist.php?id=32","_blank"));
						mymenu_item4.addItem(mymenu_item12);
												var mymenu_item13 = new MenuItem(createLinkElement("节目部","newslist.php?id=33","_blank"));
						mymenu_item4.addItem(mymenu_item13);
												var mymenu_item14 = new MenuItem(createLinkElement("项目部","newslist.php?id=34","_blank"));
						mymenu_item4.addItem(mymenu_item14);
												var mymenu_item15 = new MenuItem(createLinkElement("频道网站","newslist.php?id=35","_blank"));
						mymenu_item4.addItem(mymenu_item15);
												var mymenu_item16 = new MenuItem(createLinkElement("共享资讯","newslist.php?id=36","_blank"));
						mymenu_item5.addItem(mymenu_item16);
												var mymenu_item17 = new MenuItem(createItemElement("实用资讯"));
						mymenu_item5.addItem(mymenu_item17);						
												var mymenu_item18 = new MenuItem(createLinkElement("龙视风采","newslist.php?id=38","_blank"));
						mymenu_item5.addItem(mymenu_item18);
												var mymenu_item19 = new MenuItem(createLinkElement("通讯录","newslist.php?id=39","_blank"));
						mymenu_item17.addItem(mymenu_item19);
												var mymenu_item20 = new MenuItem(createLinkElement("常用表格","newslist.php?id=40","_blank"));
						mymenu_item17.addItem(mymenu_item20);
										menu.render();	
			}
		</script>    
		
<div id=container>

			<ul id="menu">		<li id="mymenu_item1"> <a href="javascript:void(0);">首页</a></li>		
				<li id="mymenu_item2"> <a href="javascript:void(0);">今日必读</a></li>		
				<li id="mymenu_item3"> <a href="javascript:void(0);">特别策划</a></li>		
				<li id="mymenu_item4"> <a href="newslist.php?id=24">部门动态</a></li>		
				<li id="mymenu_item5"> <a href="newslist.php?id=25">龙视部落</a></li>		
				<li id="mymenu_item6"> <a href="javascript:void(0);">BLOG</a></li>		
				<li id="mymenu_item7"> <a href="javascript:void(0);">BBS</a></li>		
		</ul>		
	</div>

	
	
</body>
</html>
<script language="javascript">
document.getElementById('mymenu_item1').innerHTML='<a href="index.php">首 页</a>';
document.getElementById('mymenu_item2').innerHTML='<a href="newslist.php?id=22">今日必读</a>';
document.getElementById('mymenu_item3').innerHTML='<a href="newslist.php?id=23">特别策划</a>';
document.getElementById('mymenu_item4').innerHTML='<a href="newslist.php?id=24">部门动态</a>';
document.getElementById('mymenu_item5').innerHTML='<a href="newslist.php?id=25">龙视部落</a>';
document.getElementById('mymenu_item6').innerHTML='<a href="#">BLOG</a>';
document.getElementById('mymenu_item7').innerHTML='<a href="/bbs/forumdisplay.php?fid=32">BBS</a>';
	var smg_username = $('nick_name').value;
	//var smg_admin = RequestCookies("smg_admin","");
	if(smg_username!="")
	{
		document.getElementById("login1").style.display="none";
		document.getElementById("login2").innerHTML="　欢迎您　"+smg_username;
		document.getElementById("login3").style.display="inline";
		document.getElementById("login4").style.display="inline";
		document.getElementById("login_admin").href="/admin/admin.php";
	}
</script>
