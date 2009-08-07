<?php
    require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-服务-投票</title>
	<?php 
		css_include_tag('top.css','bottom.css','show_vote.css','vote_right.css');
		js_include_tag('total');
		$vote_id = $_REQUEST['vote_id'];
		if(intval($vote_id)<=0){
			alert('找不到相应投票!');
			redirect('/vote/vote_list.php');
		}
		$vote = new smg_vote_class();
		$vote = $vote->find($vote_id);
		
	?>
</head>
<script>
	total("投票","server");	
</script>
<body>
	<? require_once('../inc/top.inc.php');
		$db = get_db();
	?>
	<div id=answer>
		<div id=left>
			<div style="width:100%;text-align:center;padding-top:20px;float:left;line-height:25px;"><h2><?php echo $vote->name;?></h2></div>
			<div id="vote_container_box" style="width:100%;float:left;text-align:center">
			<div id=pic><?php if($vote->photo_url!=''){?><img border=0 src="<?php echo $vote->photo_url; ?>"><?php } ?></div>
				<?php $vote->display(array('show_title' => false));?>
			</div>		
		</div>
		
		<?php include('../inc/vote_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>

<script>
	$(function(){
	})
		
</script>
