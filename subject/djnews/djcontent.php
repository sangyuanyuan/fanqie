<?
  require_once('../../frame.php');
  $db=get_db();
  if($_REQUEST['id']==''){die('没有找到网页');}
  $news=$db->query('select id,title,content,news_type,target_url,file_name from smg_news n where id='.$_REQUEST['id']);
  if($news[0]->news_type==3)//url链接类新闻
  {
  	redirect($news[0]->target_url);
  	CloseDB();
  	exit;
  }
  //文件新闻
  if($news[0]->news_type==2)
  {
  	//echo $news->newstpe;
   	redirect($news[0]->file_name);
  	CloseDB();
  	exit; 	
  }
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
	total("专题-学实专题","subject");
</script>
</head>
<body>
	<div id=bodys>
		<? include('inc/djtop.inc.php');?>
		<div id=right>
			<div class=bg>
				<div id=contenttitle><? echo $news[0]->title;?></div>
				<div style="width:680px; margin-top:10px; margin-left:10px; font-size:14px; float:left; display:inline;">
				<?php echo get_fck_content($news[0]->content); ?>
			</div>
			<div id=content5><?php print_fck_pages($news[0]->content,"djcontent.php?id=".$_REQUEST['id']);?></div>
			<? if($news[0]->is_commentable==1){?>
			<div id=contenttitle style="margin-left:8px;">评论</div>
			<? 
			$comments = $db->paginate('select * from smg_comment where resource_id='.$news[0]->id.' and resource_type="news" order by created_at desc',5);
			for($i=0;$i<count($comments);$i++){?>
				<div class=content7>
					<div class=name><a href="#"><?php echo $comments[$i]->nick_name; ?></a></div>	
					<div class=time><?php echo $comments[$i]->created_at; ?></div>	
					<div class=context><?php echo strfck($comments[$i]->comment); ?></div>	
				</div>
			
			<?php }	?>
			  <div class="pageurl">
			     <? paginate('');?>
			  </div>
			<form name="commentform" id="commentform" method="post" action="/pub/pub.post.php">
				 <input type="hidden" name="post[resource_id]" id="newsid" value="<?php echo $news[0]->id;?>">
			   <div id=content9>
				   用户：<input type="text" value="" id="commenter" name="post[nick_name]">   	
			   </div>
			   <div id=content10>
				  <div id=plleft>评论：</div><textarea id="commentcontent" name="post[comment]"></textarea>
			   </div>
			   <input type="hidden" id="resource_type" name="post[resource_type]" value="news">
			   <div id=content11></div>
			</form>
			<? }?>
		</div>	
	</div>	
		<? include('inc/djbottom.inc.php');?>
</body>
</html>

