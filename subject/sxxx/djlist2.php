<?
 require_once('../../frame.php');
  $db = get_db();
  $newslist = $db->paginate('select n.id,n.title,n.last_edited_at,c.name as cname from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="规章制度" inner join smg_subject s on c.subject_id=s.id and s.name="三项学习教育专题" order by n.priority asc, n.last_edited_at desc',10,'threeminbbs');
  $newslist1 = $db->paginate('select n.id,n.title,n.last_edited_at,c.name as cname from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="我为集团献一计" inner join smg_subject s on c.subject_id=s.id and s.name="三项学习教育专题" order by n.priority asc, n.last_edited_at desc',10,'ideaforsmg');  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -三项学习新闻列表</title>
	<?php css_include_tag('sxxx');?>
</head>
<body>
	<div id=bodys>
		<? include('inc/djtop.inc.php');?>
		<div id=right>
			<div class=bg>
				<div id=contenttitle><? echo $newslist[0]->cname;?></div>
				<? for($i=0;$i<count($newslist);$i++){?>
				<span style="width:550px; height:20px; margin-top:10px; margin-left:5px; line-height:20px; overflow:hidden; float:left; display:inline;"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a href="djcontent.php?id=<? echo $newslist[$i]->id;?>"><? echo $newslist[$i]->title;?></a></span><span style="width:90px; height:20px; line-height:20px; margin-top:10px; overflow:hidden; float:right; display:inline;"><? echo substr($newslist[$i]->last_edited_at,0,10) ?></span>
				<? }?>
				<div id=contenttitle><? echo $newslist1[0]->cname;?></div>
				<? for($i=0;$i<count($newslist1);$i++){?>
				<span style="width:550px; height:20px; margin-top:10px; margin-left:5px; line-height:20px; overflow:hidden; float:left; display:inline;"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a href="djcontent.php?id=<? echo $newslist1[$i]->id;?>"><? echo $newslist1[$i]->title;?></a></span><span style="width:90px; height:20px; line-height:20px; margin-top:10px; overflow:hidden; float:right; display:inline;"><? echo substr($newslist1[$i]->last_edited_at,0,10) ?></span>
				<? }?>
			</div>
		
      
      
		</div>
	</div>	
		<? include('inc/djbottom.inc.php');?>
</body>
</html>

