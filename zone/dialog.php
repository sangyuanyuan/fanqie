<?php
	require_once('../frame.php');
	require "pub.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-对话全文</title>
	<? 	
		use_jquery();
		css_include_tag('zone_dialog','top','bottom','thickbox');
		js_include_tag('dialog/dialog','pubfun','thickbox','total.js');
		
  ?>
	
</head>
<script>
	total("对话","zone");
</script>
<body>
<? require_once('../inc/top.inc.html');?>
<?php 
	if(intval($_REQUEST['id']) <= 0){
		alert('对不起,您访问的对话不存在!');
		redirect('dialog_list.php');
	}
	$dialog = new table_class('smg_dialog');
	$dialog = $dialog->find(intval($_REQUEST['id']));
	if(!$dialog){
		alert('对不起,您访问的对话不存在!');
		redirect('dialog_list.php');
	}
	$leaders = new table_class('smg_dialog_leader');
	$leaders = $leaders->find('all',array('conditions' => "dialog_id = $dialog->id"));
?>
<div id=ibody>
	<div id=ibody_top><img src="<?php echo $dialog->photo2_url;?>"></div>
	<div id=ibody_middle>
		<a href="dialog_list.php" target=_blank id="dialog_more">往期对话</a>
		<div id="dialog_titles"><?php echo $dialog->title;?></div>
		<div id="dialog_desc"><?php echo $dialog->content;?></div>
		<div id="dialog_leader" calss="border">
			对话嘉宾:<br><?php for($i=0;$i<count($leaders);$i++){ echo $leaders[$i]->name.'　';} ?>
		</div>
	</div>
	<div id=ibody_bottom>
		<div id=b_l>
			<div id=b_l_title></div>
			<div id=b_l_b>
				<div id="div_question">
					<?php
						$db=get_db();
						$answered= $db->query('select question_id from smg_dialog_answer where dialog_id='.$dialog->id);
						$c=array();
						for($i=0;$i<count($answered);$i++)
						{
							array_push($c,"id<>".$answered[$i]->question_id);	
						}
						if(count($answered)>0)
						{
							$c = implode(' and ' ,$c);
							$c=' and '.$c;
						}
				  	$questions = $db->query('select * from smg_dialog_question where dialog_id='.$dialog->id.$c);
						$len = count($questions);						
						for ($i=0;$i < $len; $i++) {
							echo_dialog_question($questions[$i],$i + 1,intval($_REQUEST['id']));
						}
					?>
				</div>
				<div id="div_leader">
					<div id="div_online_leader">对话嘉宾</div>	
					<?php
						$len = count($leaders);
						for($i=0;$i < $len; $i ++){
							$img = $leaders[$i]->photo_src ? $leaders[$i]->photo_src : '/images/zone/boy.gif';?>
							<div style="margin-left:2px;"><img src="<?php echo $img;?>" width=20 height=20> <?php echo $leaders[$i]->name;?></div>
					<?php	}
					?>				
					<!-- refresh leader status here -->
				</div>
				<div id="div_add_question">
					<?php
					if(strpos($dialog->master_ids, $_COOKIE['smg_username'])!==false){
						echo '<input type="text" id="writer" value="主持人语" disabled="true"><input type=hidden id="is_master" value="1">';
					}else{
						echo '<input type="text" id="writer" value="请填写用户名"><input type=hidden id="is_master" value="0">';
					}
					
					?>
					<div id="div_question_content">
					<?php 
					show_fckeditor('fck_question_content','Title',false,85,'',570);
					?>
					</div>
					<div id="div_submit_q">
						<a id="a_submit_q" href="#"><img src="/images/zone/dialog_submit_q.jpg" border=0></a>
					</div>
					<div id="div_q_emotion" style="width:100%;float:left;"></div>
				</div>
				<?php 
					if($dialog->video_url)
					{
				?>		
						<div id=video>
							<?php show_video_player('537','414',$dialog->photo_url,$dialog->video_url,$autostart = "false") ?>
						</div>
					
				<?
					}
				?>
				<div id="answer_title"></div>

				<div id="div_answer_list">
					<div id="div_answer_list_innerbox">
						<?php
							$db = get_db();
							$sql = 'select a.*,b.id as qid, b.content as  qcontent, b.writer, b.create_time as qcreate_time,c.nickname as leader_name from smg_dialog_answer a left join smg_dialog_question b on a.question_id=b.id left join smg_user_real c on a.leader_id = c.id';
							$sql .= ' where a.dialog_id=' .$dialog->id;
							$answers = $db->query($sql);
							$answer_count = $answers ? count($answers) : 0;
							$last_answer_id = $answer_count == 0 ? 0 : $answers[$answer_count -1]->id;
							for($i=0;$i < $answer_count; $i++){
								echo_dialog_answer($answers[$i],$i+1,intval($_REQUEST['id']));
							}
						?>
					</div>
					
				</div>
			</div>
		</div>
		<div id=b_r>
			<!--<div id=b_r_t>
				<b>我要评论</b><br>
				<input id="comment_writer" type="text" style="margin-bottom:5px;">
				<?php show_fckeditor('fck_comment_content','Title',false,70,'',278);?>
				<div id="comment_emotion"></div>
				<input style="display:none;" type="hidden" name="comment_content" value="" id="comment_content">
				<button id="comment_button" style="cursor:pointer;">提　交</button>
			</div>
			<div id=b_r_title1><div style=" margin-top:4px; margin-left:35px; font-size:larger;"><b>评论列表</b></div></div>
			<div id=b_r_m>
				<div id="comment_list_box">
				<?php 
				$dialog_comment = new table_class('smg_comment');
				$dialog_comment = $dialog_comment->find('all',array('conditions' => "resource_type='dialog' and resource_id={$dialog->id}", 'order' => 'id desc'));
				if($dialog_comment){
					foreach ($dialog_comment as $v) {				
						echo_dialog_comment($v);
					}
					$last_comment_id = $dialog_comment[0]->id;
				}else{
					$last_comment_id = 0;
				}				
				?>
				</div>
			</div>-->
			<a href="dialog_collection.php?width=400&height=250" class="thickbox" id=b_r_b1></a>
			<div id=b_r_title2><a href="dialog_list.php" target=_blank>往期对话</a></div>
			<?php 
				$db = get_db();
				$latest_dialogs = $db->query('select * from smg_dialog where id !=' .$dialog->id .' order by id desc limit 10');
				for($i=0;$i<count($latest_dialogs);$i++){
				?>
				<div class=b_r_b2>
					<a target="_blank" href="dialog.php?id=<?php echo $latest_dialogs[$i]->id;?>"><img border=0 width=125 height=82 src="<?php echo $latest_dialogs[$i]->photo_url;?>">
					<a target="_blank" href="dialog.php?id=<?php echo $latest_dialogs[$i]->id;?>"><?php echo $latest_dialogs[$i]->title;?></a>	
				</div>
			<?php }?>
		</div>
	</div>
</div>
<form id="div_hidden">
	<input type="hidden" id="last_question_id" name="last_question_id" value="<?php echo intval($questions[count($questions)-1]->id); ?>">
	<input type="hidden" id="question_count" name="question_count" value="<?php echo count($questions); ?>">
	<input type="hidden" id="dialog_id" value="<?php echo $dialog->id;?>">
	<input type="hidden" id="last_answer_id" name="last_answer_id" value="<?php echo $last_answer_id;?>">
	<input type="hidden" id="answer_count" name="answer_count" value="<?php echo $answer_count;?>">
	<input type="hidden" id="last_comment_id" name="last_comment_id" value="<?php echo $last_comment_id;?>">
</form>
<div id="ajax_ret" style="display:none;"></div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
