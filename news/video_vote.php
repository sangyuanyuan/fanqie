﻿<?php
    require_once('../frame.php');
    session_start();
		setsession($_SERVER['HTTP_HOST']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-视频新闻投票</title>
	<?php 
		css_include_tag('top.css','bottom.css','everyday_star.css','thickbox','all_comment');
		use_jquery();
		js_include_tag('total','news');
		$vote_id = 293;
		$vote = new smg_vote_class();
		$vote = $vote->find($vote_id);
	?>
</head>
<script>
	total("视频新闻投票","news");	
</script>
<body>
	<? require_once('../inc/top.inc.php');
	js_include_once_tag('thickbox');
		$db = get_db();
	?>
	<div id=answer>
		<div id=left>
			<div style="width:980px; font-size:20px; font-weight:bold; color:red; text-align:center; margin-top:10px; margin-left:15px; line-height:22px; float:left; display:inline;"><?php echo delhtml($vote->name);?></div>
<div style="width:980px; font-size:14px; font-weight:bold; color:red; margin-top:10px; margin-left:15px; line-height:18px; float:left; display:inline;">
　　@_@“大眼番茄09最佳视频新闻奖”评选活动开始了！ 在过去的一年中，各部门发来了很多制作精良、有吸引力的视频新闻，视频新闻相比文字新闻制作更加耗时耗力，但也往往更受网友欢迎，在2009年，网友筒子们有哪些印象深刻的视频新闻？<br>
　　<span style="color:#000000;">番茄网特别举行“大眼番茄09最佳视频新闻奖”评选活动，请大家不要吝啬点击手中的小鼠标，为心目中的“09最佳视频新闻”投上一票吧！(点击图片可看原文和视频)<br>
活动办法：<br>
　　1、番茄小编根据2009年发布在“番茄网”上视频新闻的点击量，整理后初选出15则视频新闻入围。<br>
　　2、即日起至2月7日为网友网络匿名投票时间。<br>
　　3、春节前公布最终评选结果。</span><br>
奖项设置：<br>
 　“大眼番茄09最佳视频新闻奖”3个，获奖者有特别大礼相赠噢！！</div>
			<div id="vote_container_box" style="width:100%; overflow:hidden; float:left;text-align:center">
				<div id=pic><?php if($vote->photo_url!=''){?><img border=0 src="<?php echo $vote->photo_url; ?>"><?php } ?></div>
				<?php $vote->display(array('show_title' => false,'target'=>'_blank'));?>
			</div>
		</div>
	<?php $sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='video_vote' order by created_at desc";
		$news=$db->paginate($sql,10); ?>
		<div class="comment">
			 <?php for($i=0;$i<count($news);$i++){ ?>
					<div class=content>	
						<div class=title>
							<div style="width:230px; margin-top:10px; margin-left:10px; line-height:20px; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><?php echo $news[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; float:left; display:inline;"><img title="送鲜花" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $news[$i]->id;?>" style="none"><div id="hidden_flower" style="width:50px; height:12px; margin-left:3px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $news[$i]->flowernum;?></div><img title="扔番茄" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $news[$i]->id;?>" style="none"><div style="width:50px; height:12px; margin-top:15px; margin-left:10px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $news[$i]->tomatonum;?></div></div>　
								<div style="width:140px; line-height:20px; color:#FF0000; float:right; display:inline"><?php echo $news[$i]->created_at; ?></div>
							</div>
						</div>
						<div class=context>
							<?php echo strfck($news[$i]->comment); ?>
						</div>
					</div>
					<?php }?>	
				</div>
	<div class=page><?php paginate('');?></div>
	<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
			<div class=aboutcontent style="padding-bottom:10px;">
				<div style="width:500px; float:left; display:inline;"><div style="width:50px; float:left; display:inline;">姓名：</div><input type="text" id="commenter" name="post[nick_name]"></div>
				<input type="hidden" id="resource_id" name="post[resource_id]" value="0">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="video_vote">
				<input type="hidden" id="target_url" name="post[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
				<input type="hidden" name="type" value="comment">
				<div style="margin-top:5px; float:left; display:inline;"><div style="width:50px; float:left; display:inline;">内容：</div><?php show_fckeditor('post[comment]','Title',false,'75','','617');?></div>
				<div id=fqbq></div>
				<button style="margin-top:10px; margin-right:15px; border:1px solid #cccccc; background:#ffffff; line-height:20px; float:right; display:inline;" id="comment_sub" >提交评论</button>
			</div>
	</form>
	</div>
	
	<? include('../inc/bottom.inc.php');?>
</body>
</html>

