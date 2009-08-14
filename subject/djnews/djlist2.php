<?
  require_once('../../frame.php');
  $db = get_db();
  $newslist = $db->paginate('select n.photo_src,n.id,n.short_title,n.title,n.news_type,n.target_url,n.file_name from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.name="三分钟论坛" order by i.priority asc, n.created_at desc',10,'threeminbbs');
  $newslist1 = $db->paginate('select n.photo_src,n.id,n.short_title,n.title,n.news_type,n.target_url,n.file_name from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.name="我为集团献一计" order by i.priority asc, n.created_at desc',10,'ideaforsmg');  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -党建新闻列表</title>
	<?php css_include_tag('dj');
		use_jquery();
		js_include_once_tag('dj','total');
	?>
	<script>
	total("专题-学实专题","news");
</script>
</head>
<body>
	<div id=bodys>
		<? include('inc/djtop.inc.php');?>
		<div id=right>
			<div class=bg>
				<div id=contenttitle>三分钟论坛</div>
				<? for($i=0;$i<count($newslist);$i++){?>
				<span style="width:550px; height:20px; margin-top:10px; margin-left:5px; line-height:20px; overflow:hidden; float:left; display:inline;"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a href="djcontent.php?id=<? echo $newslist[$i]->id;?>"><? echo $newslist[$i]->title;?></a></span><span style="width:90px; height:20px; line-height:20px; margin-top:10px; overflow:hidden; float:right; display:inline;"><? echo substr($newslist[$i]->created_at,0,10) ?></span>
				<? }?>
				<div class="pageurl">
		         <?php 
			          echo paginate('','threeminbbs'); 
		         ?>
	      		</div>
				<div id=contenttitle>我为集团献一计</div>
				<? for($i=0;$i<count($newslist1);$i++){?>
				<span style="width:550px; height:20px; margin-top:10px; margin-left:5px; line-height:20px; overflow:hidden; float:left; display:inline;"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a href="djcontent.php?id=<? echo $newslist1[$i]->id;?>"><? echo $newslist1[$i]->title;?></a></span><span style="width:90px; height:20px; line-height:20px; margin-top:10px; overflow:hidden; float:right; display:inline;"><? echo substr($newslist1[$i]->created_at,0,10) ?></span>
				<? }?>
				<div class="pageurl">
		         <?php 
			          echo paginate('','ideaforsmg'); 
		         ?>
			</div>
		</div>
	</div>	
		<? include('inc/djbottom.inc.php');?>
</body>
</html>

