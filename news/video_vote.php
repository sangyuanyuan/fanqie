<?php
    require_once('../frame.php');
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
	total("视频新闻投票","news");	
</script>
<body>
	<? require_once('../inc/top.inc.php');
	js_include_once_tag('thickbox');
		$db = get_db();
	?>
	<div id=answer>
		<div id=left>
			<div style="width:980px; text-align:center; margin-top:10px; margin-left:15px; line-height:22px; float:left; display:inline;"><?php echo get_fck_content($vote->name);?></div>
			
			<div id="vote_container_box" style="width:100%; overflow:hidden; float:left;text-align:center">
				<div id=pic><?php if($vote->photo_url!=''){?><img border=0 src="<?php echo $vote->photo_url; ?>"><?php } ?></div>
				<?php $vote->display(array('show_title' => false,'target'=>'_blank'));?>
			</div>
		</div>
	</div>
	
	
	<? include('../inc/bottom.inc.php');?>
</body>
</html>

