<?php
    require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-每日之星投票</title>
	<?php 
		css_include_tag('top.css','bottom.css','everyday_star.css','thickbox','all_comment');
		js_include_tag('total');
		$vote_id = 286;
		$vote = new smg_vote_class();
		if($vote_id){
			$vote = $vote->find($vote_id);
		}else if($prev_id){
			$vote = $vote->find('first',array('conditions'=>"id < $prev_id and is_sub_vote =0 and (category_id=0 or category_id=11) and is_adopt=1",'order' => 'id desc'));
			if(!$vote){
				alert('找不到更多的投票');
				redirect($_SERVER['HTTP_REFERER']);
			}
			$vote_id = $vote->id;
		}
		
		
	?>
</head>
<script>
	total("每日之星投票","show");	
</script>
<body>
	<? require_once('../inc/top.inc.php');
	js_include_once_tag('thickbox');
		$db = get_db();
	?>
	<div id=answer>
		<div id=left>
			<div style="width:980px; margin-top:10px; margin-left:15px; line-height:22px; float:left; display:inline;"><?php echo get_fck_content($vote->name);?></div>
			
			<div id="vote_container_box" style="width:100%; overflow:hidden; float:left;text-align:center">
				<div id=pic><?php if($vote->photo_url!=''){?><img border=0 src="<?php echo $vote->photo_url; ?>"><?php } ?></div>
				<?php $vote->display(array('show_title' => false,'target'=>'_blank'));?>
			</div>
		</div>
		<?php $sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='everyday_star' order by created_at desc";
		$news=$db->paginate($sql,10); ?>
		<div class="comment">
			 <?php for($i=0;$i<count($news);$i++){ ?>
					<div class=content>	
						<div class=title>
							<div style="width:230px; margin-top:10px; margin-left:10px; line-height:20px; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><?php echo $news[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; float:left; display:inline;"><img title="送鲜花" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $news[$i]->diggtoid;?>" style="none"><div id="hidden_flower" style="width:50px; height:12px; margin-left:3px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $news[$i]->flowernum;?></div><img title="扔番茄" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $news[$i]->diggtoid;?>" style="none"><div style="width:50px; height:12px; margin-top:15px; margin-left:10px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $news[$i]->tomatonum;?></div></div>　
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
				<div style="width:500px; float:left; display:inline;">姓名：<input type="text" id="commenter" name="post[nick_name]"></div>
				<input type="hidden" id="resource_id" name="post[resource_id]" value="<?php echo $id;?>">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="everyday_star">
				<input type="hidden" id="target_url" name="post[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
				<input type="hidden" name="type" value="comment">
				<div style="margin-top:5px; margin-left:13px; float:left; display:inline;">内容：<?php show_fckeditor('post[comment]','Title',false,'75','','617');?></div>
				<div id=fqbq></div>
				<button style="margin-top:10px; margin-right:15px; border:1px solid #cccccc; background:#ffffff; line-height:20px; float:right; display:inline;" id="comment_sub" >提交评论</button>
			</div>
	</form>
	</div>
	
	
	<? include('../inc/bottom.inc.php');?>
</body>
</html>

