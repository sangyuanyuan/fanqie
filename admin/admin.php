<?php
	require_once('../frame.php');
	css_include_tag('admin');
	use_jquery_ui();
	$db=get_db();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>smg</title>
</head>
<body  style="background:url(/images/bg/admin_bg2.jpg) repeat-x;">
	<div id=admin_body2>
		<div id=part1>
			<div id=nav></div>
			<div id=title>SMG</div>
			<div id=index><a href="/index.php" target="_blank">SMG</a></div>
		</div>
		<div id=part2>
			<div id="accordion">
				<?php
					$sql='select * from '
					for($i=0;$i<8;$i++){
				?>
				<div class=menu1><a href="#">部门设置</a></div>
				<div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='department.php'">部门管理</div>
				</div>
				<?php }?>
				<div class=menu1><a href="#">内容管理</a></div>
				<div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='news.php'">.文章管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='photo.php'">.图片管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='video.php'">.视频管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='mag.php'">.电子杂志管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='shorttitle.php'">.短标题长度</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='tool.php'">.文件管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='smgad.php'">.广告管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='headtitle.php'">.菜单管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='activities.php'">.活动管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='tg.php'">.团购管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='vote.php'">.投票管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='user.php'">.用户管理</div>
				</div>
				<div class=menu1><a href="#">领导信箱</a></div>
				<div>	
				   	<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='leader.php'">.领导管理</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='lactivity.php'">.领导活动</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='lletter.php'">.领导信件</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='lreply.php'">.信件回复</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='ldialog.php'">.领导对话</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='leaderuser.php'">.领导日常安排</div>
				</div>
				<div class=menu1><a href="#">专题管理</a></div>
				<div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='subjectnews.php'">.专题文章</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='subjectphoto.php'">.专题图片</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='subjectvideo.php'">.专题视频</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='subjectlist.php'">.专题内容</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='subjectitem.php'">.上传作品审核</div>
				</div>
				<div class=menu1><a href="#">统计信息</a></div>
				<div>
				  	<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='report1.php'">.网站总点击量</div>
				  	<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='report7.php'">.网站各平台点击量</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='report2.php'">.栏目点击量</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='report3.php'">.信息点击量</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='report4.php'">.部门对网站访问量</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='report5.php'">.部门发布首页信息量</div>
					<div class=menu2 ><a style="text-decoration:none; color:#000000;" target="_blank" href="http://172.27.7.155/llfx/fwpt/fwpt.htm">.服务平台</a></div>
					<div class=menu2 ><a style="text-decoration:none; color:#000000;" target="_blank" href="http://172.27.7.155/llfx/news/news.htm">.新闻平台</a></div>
					<div class=menu2 ><a style="text-decoration:none; color:#000000;" target="_blank" href="http://172.27.7.155/llfx/jlpt/jlpt.htm">.交流平台</a></div>
					<div class=menu2 ><a style="text-decoration:none; color:#000000;" target="_blank" href="http://172.27.7.155/llfx/zspt/zspt.htm">.展示平台</a></div>
					<div class=menu2 ><a style="text-decoration:none; color:#000000;" target="_blank" href="http://172.27.7.155/llfx/sfwpt/fwpt.htm">.服务平台整点点击量查询</a></div>
					<div class=menu2 ><a style="text-decoration:none; color:#000000;" target="_blank" href="http://172.27.7.155/llfx/snews/news.htm">.新闻平台整点点击量查询</a></div>
					<div class=menu2 ><a style="text-decoration:none; color:#000000;" target="_blank" href="http://172.27.7.155/llfx/sjlpt/jlpt.htm">.交流平台整点点击量查询</a></div>
					<div class=menu2 ><a style="text-decoration:none; color:#000000;" target="_blank" href="http://172.27.7.155/llfx/szspt/zspt.htm">.展示平台整点点击量查询</a></div>
				</div>
				<div class=menu1><a href="#">静态生成</a></div>
				<div>
				  	<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='static.php?type=index'">.首页静态</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='static.php?type=top'">.顶部静态</div>
					<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='static.php?type=bottom'">.底部静态</div>
				</div>
				<div class=menu1><a href="#">帮助文档</a></div>
				<div>
			 		<div class=menu2 onClick="javascript:document.getElementById('admin_iframe').src='help.php'">.帮助文档</div>
				</div>
				<div class=menu1>试题管理</div>
				<div>
					<a href="problem.php" target="admin_iframe">项目管理</a>
					<a href="answerindex.php" target="admin_iframe">题目管理</a>	
				</div>
				<a style="text-decoration:none;" href="http://trac.xun-ao.com" target="_blank" class=menu1>项目管理</a>	 
			</div>
			<div class=menu1><a href="/bbs/admincp.php" target="_blank" style="text-decoration:none; color:#333333">论坛管理</a></div>
			  	<div class=menu1><a href="/blog/admincp.php" target="_blank" style="text-decoration:none; color:#333333">博客管理</a></div>
			  	<div class=menu1><a href="/multishop_v23_free/system/index.php" target="_blank" style="text-decoration:none; color:#333333">商城管理</a></div>
		</div>
		
		<div id=part3>
		  <iframe id=admin_iframe name="admin_iframe" scrolling="yes" src="news.php" width="99%" height="700"></iframe>
		</div>
	</div>
</body>
</html>

<SCRIPT type=text/javascript>
	$(function() {
		$("#accordion").accordion({
			active:10,
			autoHeight:false,
			animated:false
		});
	});
</SCRIPT>


