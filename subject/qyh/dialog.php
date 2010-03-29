<?
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG - 三项教育 - 群英汇</title>
	<?php css_include_tag('qyh_dialog','qyh_top','qyh_bottom','qyh_right');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("专题-群英汇","other");
</script>
</head>
<body>
	<div id=ibody>	
		<?php include('inc/top.inc.php');?>
		<div id=qyh_dialog>
			<div id=ileft>
				<?php 
				if($_REQUEST['id']=="")
				{
					$dialog=$db->query('select * from smg_dialog where title like "%对话群英%"  order by create_time desc limit 1');
				}
				else
				{
					$dialog=$db->query('select * from smg_dialog where id='.$_REQUEST['id']);
				}
				?>
				<div id=l_t>
					<div id=l_t_title>对话群英</div>
					<div id=l_t_content_l>
						<?php  show_video_player('315','254',$dialog[0]->photo2_url,$dialog[0]->video_url);?>
					</div>
					<div id=l_t_content_r>
						<div id=title>本期嘉宾介绍</div>
						<div id=content><?php echo $dialog[0]->content; ?></div>	
					</div>
				</div>
				<div id=l_b>
					<?php
					if(count($dialog)>0)
					{ 
					$qa=$db->paginate('select a.content,q.writer,q.content as qcontent from smg_dialog_answer a left join smg_dialog_question q on a.question_id=q.id where q.dialog_id='.$dialog[0]->id.' order by a.create_time desc',4); ?>
					<div id=title>对话实录</div>
					<?php for($i=0;$i<count($qa);$i++){ ?>
					<div class=content>
						<div class=c_l></div>
						<div class=c_r>
							<div class=c_r_title><?php echo $qa[$i]->writer.":".$qa[$i]->qcontent; ?></div>
							<div class=c_r_content><?php echo $qa[$i]->content; ?></div>
						</div>	
					</div>
					<div class=l_dash></div>
					<?php } ?>
					<div class=fy><?php paginate('');?></div>
				<?php } ?>
				</div>
			
			</div>
			<?php $rightlist="dialog"; ?>
			<div id=iright><?php include('inc/right.inc.php'); ?></div>
		</div>
		<?php include('inc/bottom.inc.php');?>
	</div>
</body>
</html>

