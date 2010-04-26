<?
  require_once('../../frame.php');
  $db = get_db();
  $id=$_REQUEST['id'];
  $sql="select * from smg_news where id=".$id;
  $news=$db->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>smg</title>
  <?php css_include_tag('tw'); use_jquery(); ?>
</head>
<body>
	<div id="ibody">
		<div id="iibody">
			 <? include('inc/top.inc.php');?>
	 			<div id="left">
	 				<div id=content_content>
	 					<div id=title><?php echo $news[0]->title; ?></div>
	 					<div id=comefrom>浏览次数：<?php echo $news[0]->click_count; ?><span style="color:#C2130E"></span>　时间：<?php echo $news[0]->created_at; ?></div>
	 					<div id=content>
	 						<?php if($news[0]->video_src!=""){ ?>
	 							<div id=video>
	 									<?php  show_video_player('400','300',$news[0]->video_photo_src,$news[0]->video_src);?>
	 							</div>
	 						<?php } ?>
	 						<?php echo get_fck_content($news[0]->content);?>
	 					</div>
	 				</div>
	 			</div>
			 <? include('inc/right.inc.php');
			  include('inc/bottom.inc.php');?>
		</div>
	</div>
</body>