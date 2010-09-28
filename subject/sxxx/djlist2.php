<?
 require_once('../../frame.php');
  $db = get_db();
  $newslist = $db->paginate('select n.photo_src,n.id,n.short_title,n.title,n.news_type,n.target_url,n.file_name,c.name as cname from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="规章制度" order by i.priority asc, n.created_at desc',10,'threeminbbs');
  $newslist1 = $db->paginate('select n.photo_src,n.id,n.short_title,n.title,n.news_type,n.target_url,n.file_name,c.name as cname from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="我为集团献一计" order by i.priority asc, n.created_at desc',10,'ideaforsmg');  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -三项学习新闻列表</title>
	<?php css_include_tag('sxxx');
		js_include_once_tag('total');
	?>
<script>
	total("专题-三项学习教育","news");
</script>
</head>
<body>
	<div id=bodys>
		<? include('inc/djtop.inc.php');?>
		<div id=right>
			<div class=bg>
				<div id=contenttitle><? echo $newslist[0]->cname;?></div>
				<? for($i=0;$i<count($newslist);$i++){?>
				<span style="width:550px; height:20px; margin-top:10px; margin-left:5px; line-height:20px; overflow:hidden; float:left; display:inline;"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a href="djcontent.php?id=<? echo $newslist[$i]->id;?>"><? echo $newslist[$i]->title;?></a></span><span style="width:90px; height:20px; line-height:20px; margin-top:10px; overflow:hidden; float:right; display:inline;"><? echo substr($newslist[$i]->created_at,0,10) ?></span>
				<? }?>
				<div id=contenttitle><? echo $newslist1[0]->cname;?></div>
				<? for($i=0;$i<count($newslist1);$i++){?>
				<span style="width:550px; height:20px; margin-top:10px; margin-left:5px; line-height:20px; overflow:hidden; float:left; display:inline;"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a href="djcontent.php?id=<? echo $newslist1[$i]->id;?>"><? echo $newslist1[$i]->title;?></a></span><span style="width:90px; height:20px; line-height:20px; margin-top:10px; overflow:hidden; float:right; display:inline;"><? echo substr($newslist1[$i]->created_at,0,10) ?></span>
				<? }?>
			</div>
		
      
      
		</div>
	</div>	
		<? include('inc/djbottom.inc.php');?>
</body>
</html>

