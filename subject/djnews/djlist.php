<?
	require_once('../../frame.php');
  if($_REQUEST['id']==''){die('没有找到网页');}
  $db=get_db();
  $listid=$_REQUEST['id'];
  $newslist=$db->paginate('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.id='.$listid.' order by i.priority asc, n.created_at desc',20)
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -党建新闻列表</title>
	<?php css_include_tag('dj');
		use_jquery();
		js_include_once_tag('dj','total');
	?>
	<script>
	total("专题-学实专题","other");
</script>
</head>
<body>
	<div id=bodys>
		<? include('inc/djtop.inc.php');?>
		<div id=right>
			<div class=bg>
				<div id=contenttitle><? echo $newslist[0]->cname;?></div>
				<? for($i=0;$i<count($newslist);$i++){?>
				<span style="width:550px; height:20px; margin-top:10px; margin-left:5px; line-height:20px; overflow:hidden; float:left; display:inline;"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $newslist[$i]->id;?>"><? echo $newslist[$i]->title;?></a></span><span style="width:90px; height:20px; overflow:hidden; line-height:20px; margin-top:10px; float:right; display:inline;"><? echo substr($newslist[$i]->created_at,0,10); ?></span>
				<? }?>
			</div>
			 <div class="pageurl">
	         <?php 
		          echo paginate(''); 
	         ?>
      		</div>	
		</div>
	</div>	
	<? include('inc/djbottom.inc.php');?>
</body>
</html>

