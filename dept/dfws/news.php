<? require_once('../inc/department.inc.php');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<link href="/css/department.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>
	<script type="text/javascript" src="../js/prototype-1.6.0.2.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
	
</head>
<body>
	
	<div id=east_body>
		<div id=east_title>
			<div id=move>
			<MARQUEE scrollAmount=1 scrollDelay=60 behavior=scroll  width="100%"><span style="float:left; display:inline">�������ţ�</span>
			<? for($i=0;$i<$news-itemcount;$i++){?>
				<a href="/dfws/news.php?id=<? echo $news->items[$i]->id;?>">
				<? echo $news->items[$i]->title; ?>
				</a>
			<? }?>
			</MARQUEE>
		</div>
	</div>
		<div id=east_logo><img src="/images/inner/logo.gif"></div>
		<div id=east_content>
			<div id=top>
				<div id=search><input type="text" />����|<button onclick="searchnews('search')">����</button></div>
			</div>
			<div id=context>
				<div id=news_left>
					<? 
              		$news=getnews();
              		if($news->newstype==3)//url����������
								  {
								  	redirecturl($news->linkurl);
								  	CloseDB();
								  	exit;
								  }
								  //�ļ�����
								  if($news->newstype==2)
								  {
								   	redirecturl($news->filepath ."/" .$news->filename);
								  	CloseDB();
								  	exit; 	
								  }
              	?>
					<div id=title><? echo $news->categoryname;?></div>
					<div id=left>
						<div id=title><? echo $news->title;?></div>
						<div id=content><? echo $news->content?></div>
					</div>
				</div>
				<div id=news_right>	
					<div id=top>
					<?php 
						$video = load_module('pos_newsvideo',1);
						  ShowMediaPlay(190,135,$video->items[0]->photourl,$video->items[0]->videourl);
						?>
					</div>
					<?  
						$newslist=load_module('pos_indexleft2',4);
						$report=getcategoryreport();
					?>
					<div id=bottom><div onMouseOver="ChangeDepartTab('1')" id=title1>���Ų���</div><div id=title2 onMouseOver="ChangeDepartTab('2')" class=title2><? echo $newslist->categoryname;?></div><div id=title3 onMouseOver="ChangeDepartTab('3')" class=title2>����ͳ��</div>
						
						<div id=a1 class=content></div>
						<div id=a2 style="display:none;" class=content><? for($i=0;$i<$newslist->itemcount;$i++){?><a href="<? echo $newslist->items[$i]->linkurl;?>">�� <?  echo $newslist->items[$i]->title;?></a><? }?></div>
						<div id=a3 style="display:none;" class=content>
						<? for($i=0;$i<4;$i++){?><a href="#">
						<div style="float:left; display:inline;"><? echo $report->items[$i]->name;?></div>
						<div style=" margin-right:20px; float:right; display:inline;">
						<? echo $report->items[$i]->clickcount;?></div>
						 <? }?>
						</div>
					</div>
				</div>
				<? $photo=load_module('pos_indexbottompic',3)?>
				<div id=bottom1><img width=253 height=63 style="float:left; display:inline" src="<? echo $photo->items[0]->photourl; ?>"><img width=378 height=63 style=" float:left; display:inline;" src="<? echo $photo->items[1]->photourl; ?>"><img width=181 height=64 style=" float:left; display:inline" src="<? echo $photo->items[2]->photourl; ?>"></div>
			</div>	
		</div>
		<div id=east_bottom>
			<div id=assistant><a href="">��Ϊ��ҳ</a>|<a href="">�ղر�վ</a>|<a href="">��ϵ����</a></div>
			<div id=wz>�Ϻ��������� ��Ȩ���� .��Ȩ���� All Right Reserved Copyright ? 2003-2008</div>
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
document.getElementById('mymenu_item1').innerHTML='<a href="/dfws/">�� ҳ</a>';
document.getElementById('mymenu_item2').innerHTML='<a href="/dfws/newslist.php?id=4">���ձض�</a>';
document.getElementById('mymenu_item3').innerHTML='<a href="/dfws/newslist.php?id=8">�ر�߻�</a>';
document.getElementById('mymenu_item4').innerHTML='<a href="/dfws/newslist.php?id=9">���Ŷ�̬</a>';
document.getElementById('mymenu_item5').innerHTML='<a href="/dfws/newslist.php?id=10">���Ӳ���</a>';
document.getElementById('mymenu_item6').innerHTML='<a href="#">BLOG</a>';
document.getElementById('mymenu_item7').innerHTML='<a href="/bbs/forumdisplay.php?fid=32">BBS</a>';
</script>