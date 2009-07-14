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
		css_include_tag('zone_dialog','top','bottom');
		js_include_tag('dialog/dialog','pubfun');
		
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<?php 
	if(intval($_REQUEST['id']) <= 0){
		alert('对不起,您访问的对话不存在!');
		redirect('dialoglist.php');
	}
	$dialog = new table_class('smg_dialog');
	$dialog = $dialog->find(intval($_REQUEST['id']));
	if(!$dialog){
		alert('对不起,您访问的对话不存在!');
		redirect('dialoglist.php');
	}
	$leaders = new table_class('smg_dialog_leader');
	$leaders = $leaders->find('all',array('conditions' => "dialog_id = $dialog->id"));
	
?>
<div id=ibody>
	<div id=ibody_top></div>
	<div id=ibody_middle>
		<div id="dialog_desc"><?php echo $dialog->content;?></div>
		<div id="dialog_leader" calss="border">
			对话嘉宾:<?php echo $leaders[0]->name; if(count($leaders)>1) echo " 等 ";?><br>
			时间:<?php echo $dialog->start_time ." ~ " .$dialog->end_time; ?>
		</div>
	</div>
	<div id=ibody_bottom>
		<div id=b_l>
			<div id=b_l_title></div>
			<div id=b_l_b>
				<div id="div_question">
					<?php
					  	$questions = new table_class('smg_dialog_question');
					  	$questions = $questions->find('all',array('conditions' => "dialog_id={$dialog->id}"));
						$len = count($questions);
						echo "<script>question_count=$len;last_question_id={$questions[$len-1]->id};</script>";
						for ($i=0;$i < $len; $i++) {
							echo_dialog_question($questions[$i],$i + 1);
						}
					?>
				</div>
				<div id="div_leader">
					<div id="div_online_leader">在线领导</div>					
					<!-- refresh leader status here -->
				</div>
				<div id="div_add_question">
					<input type="text" id="writer" value="请填写用户名">
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
				<div id="answer_title"></div>
				<div id="div_answer_list">
					<div id="div_answer_list_innerbox">
						<div class="answer_question"><span class="answer_question_index"><b>问题1.</b></span>的答复第三方的答复第三方的答复第三方的答复第三方的答复第三方的答复第三方的答复第三方的答复第三方的答复第三方的答复第三方<span class="question_time"> 网友23 2009-12-12</span></div>
						<div class="answer_answer">
						sdfsdfasdfasdfsadfdsf
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div id=b_r>
			<div id=b_r_t>
				<input type="text">
				<textarea></textarea>
				<button>提　交</button>
			</div>
			<div id=b_r_title1></div>
			<div id=b_r_m></div>
			<div id=b_r_b1></div>
			<div id=b_r_title2></div>
			<?php for($i=0;$i<4;$i++){?>
				<div class=b_r_b2>
					<a target="_blank" href="#"><img border=0 width=128 height=82 src=""></a>
					<br>
					<a target="_blank" href="#">test</a>	
				</div>
			<?php }?>
		</div>
	</div>
</div>
<div id="div_hidden">
	<input type="hidden" id="last_question_id" name="last_question_id" value="<?php echo $questions[count($questions)-1]->id; ?>">
	<input type="hidden" id="question_count" name="question_count" value="<?php echo count($questions); ?>">
</div>
<div id="ajax_ret" style="display:none;"></div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
