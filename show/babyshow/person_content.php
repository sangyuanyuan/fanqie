<?php
	require_once('../../frame.php');
	$db = get_db();
	$id=$_REQUEST['id'];
	$cookie=$_COOKIE['smg_user_nickname'];
	$type=$_REQUEST['type'];
	$sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='babyshow".$type."' and resource_id='".$_REQUEST["id"]."' order by created_at desc";
	$comment=$db->paginate($sql,10);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-宝宝秀首页</title>
	<? 
		css_include_tag('show_person','top','bottom');
		use_jquery();
	  js_include_once_tag('total','babyshowindex','news','pubfun');
  ?>
	
</head>
<script>
total("宝宝秀","show");
</script>
<body>
	<?php require_once('person_head.php');?>
	<div id=ibody>
		<? require_once('person_left.php');?>
		<div id=iright>
			<?php $act=$db->query('select * from smg_babyshow_act where id='.$id); 
				$photo=$db->query('select * from smg_babyshow_photo where id='.$id);
			if($type==act){?>
				<div id=title>日志</div><div id=addact></div>
			 	<?php for($i=0;$i<count($act);$i++){ ?>
			 		<div class=listcontent>
			 			<div id=content_title><?php echo $act[0]->title; ?></div>
			 			<div id=content_content><?php echo strfck($act[0]->content); ?></div>
			 		</div>
			 	<?php }}
			 	else{?>
			 			<div id=title>相册</div><div id=addphoto></div>
			 			<div class=listcontent style="margin-top:10px;"><img width=800 src="<?php echo $photo[0]->photo_src; ?>" /></div>
			 	<?php } ?>
			 	<?php for($i=0;$i<count($comment);$i++){ ?>
					<div class=content>	
						<div class=title>
							<div style="width:230px; margin-top:10px; margin-left:10px; line-height:20px; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><?php echo $comment[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; float:left; display:inline;"><img title="送鲜花" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $comment[$i]->diggtoid;?>" style="none"><div id="hidden_flower" style="width:50px; height:12px; margin-left:3px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $comment[$i]->flowernum;?></div><img title="扔番茄" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $comment[$i]->diggtoid;?>" style="none"><div style="width:50px; height:12px; margin-top:15px; margin-left:10px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $comment[$i]->tomatonum;?></div></div>　
								<div style="width:140px; line-height:20px; color:#FF0000; float:right; display:inline"><?php echo $comment[$i]->created_at; ?></div>
							</div>
						</div>
						<div class=context>
							<?php echo strfck($comment[$i]->comment);  ?>
						</div>
					</div>
			<?php  }?>
			<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
				<div class=abouttitle>发表评论</div>
				<div class=aboutcontent style="padding-bottom:10px;">
					<div class=title style="background:#ffffff;">现有<span style="color:#FF5800;"><?php $totalcoment=$db->query("select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='babyshow".$type."' and resource_id=".$id." order by created_at desc"); echo count($totalcoment);?></span>人对本文进行了评论<?php if(count($totalcoment)>0){ ?>　　<a target="_blank" style="color:#1862A3"  href="/comment/comment_list.php?id=<?php echo $id;?>&type=babyshow<?php echo $type; ?>">查看更多评论</a><?php }?>　　<a target="_blank" style="color:#1862A3"  href="/comment/all_comment.php">查看所有评论</a></div>
					<input type="text" id="commenter" name="post[nick_name]">
					<input type="hidden" id="resource_id" name="post[resource_id]" value="<?php echo $id;?>">
					<input type="hidden" id="resource_type" name="post[resource_type]" value="babyshow<?php echo $type; ?>">
					<input type="hidden" id="target_url" name="post[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
					<input type="hidden" name="type" value="comment">
					<div style="margin-top:5px; margin-left:13px; float:left; display:inline;"><?php show_fckeditor('post[comment]','Title',false,'75','','617');?></div>
					<div id=fqbq></div>
					<button style="margin-top:10px; margin-right:15px; border:1px solid #cccccc; line-height:20px; float:right; display:inline;" id="comment_sub" >提交评论</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>