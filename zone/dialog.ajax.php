<?php
	require "../frame.php";
	require "pub.php";
	$dialog_id = $_REQUEST['dialog_id'];
	if(intval($dialog_id)<=0){
		alert('找不到相应的对话!');
		exit;
	}
	switch ($_POST['optype']) {
		case 'add_question':
			$question = new table_class('smg_dialog_question');
			$question->dialog_id = $_POST['dialog_id'];
			$question->ip = $_SERVER['REMOTE_ADDR'];
			$question->create_time = date("Y-m-d H:i:s");
			$question->writer = $_POST['writer'];
			$question->content = str_replace('<p>', '', $_POST['content']);
			$question->content = str_replace('</p>','',$question->content);
			$question->is_master = $_POST['is_master'];
			if($question->save()){
				//$alert_str = '发布成功!';
			}else{
				$alert_str = '发布失败!';
			};
			break;
		case 'delete_question':
			$question = new table_class('smg_dialog_question');
			if($question->delete($_POST['question_id'])){
				$alert_str = '删除成功!';
			}else{
				$alert_str = '删除失败!';
			};
			echo "<script>alert('$alert_str');location.reload();</script>";
			exit;
		case 'answer_question':
			$tanswer = new table_class('smg_dialog_answer');
			$tanswer->update_attributes($_POST['answer'],false);
			$tanswer->create_time = date("Y-m-d H:i:s");
			$tanswer->leader_id = $_COOKIE['smg_userid'];
			$tanswer->content = str_replace('<p>', '', $tanswer->content);
			$tanswer->content = str_replace('</p>', '', $tanswer->content);
			if($tanswer->save()){
				//$alert_str = '回复成功!';
			}else{
				$alert_str = '回复失败!';
			}
			break;
		case 'edit_answer':
			$tanswer = new table_class('smg_dialog_answer');
			$tanswer->update_attributes($_POST['answer'],false);
			$tanswer->create_time = date("Y-m-d H:i:s");
			$tanswer->leader_id = $_COOKIE['smg_userid'];
			$tanswer->content = str_replace('<p>', '', $tanswer->content);
			$tanswer->content = str_replace('</p>', '', $tanswer->content);
			$tanswer->id = $_REQUEST['answer_id'];
			if($tanswer->save()){
				$alert_str = '编辑回复成功!';
			}else{
				$alert_str = '编辑回复失败!';
			}
			echo "<script>alert('$alert_str');location.reload();</script>";
			exit;			
			break;
		case 'delete_answer':
			$answer = new table_class('smg_dialog_answer');
			if($answer->delete($_POST['answer_id'])){
				$alert_str = '';
			}else{
				$alert_str = '删除失败!';
			};
			echo "<script>alert('$alert_str');location.reload();</script>";
			exit;	
		default:
			;
		break;
	}
	
	//refresh the question box
	$db = get_db();
	$questions = $db->query('select * from smg_dialog_question where id > ' .$_REQUEST['last_question_id'] .' and dialog_id=' .$_REQUEST['dialog_id']);
	$question_count = $_REQUEST['question_count'];
	$last_question_id = $questions ? $questions[count($questions)-1]->id : $_REQUEST['last_question_id'];
	$len = count($questions);
	
	$sql = 'select a.*,b.id as qid,b.content as  qcontent, b.writer, b.create_time as qcreate_time from smg_dialog_answer a left join smg_dialog_question b on a.question_id=b.id';
	$sql .=  ' where a.id > ' .$_REQUEST['last_answer_id'] .' and a.dialog_id=' .$_REQUEST['dialog_id'];
	$answers = $db->query($sql);
	$answer_count = $_REQUEST['answer_count'];
	$last_answer_id = $answers ? $answers[count($answers)-1]->id : $_REQUEST['last_answer_id'];
	$len1 = count($answers);	
	?>
	<script>
		var str;
	<?php
	for($i=0;$i<$len;$i++){
		$question_count ++;?>
		str = '<?php echo_dialog_question($questions[$i],$question_count,$dialog_id);?>';
		$('#div_question').append(str);
	<?php } ?>
	$('#last_question_id').val('<?php echo $last_question_id;?>');
	$('#question_count').val('<?php echo $question_count;?>');
	
	<?php
	$comment = new table_class('smg_comment');
	//$comment->echo_sql = true;
	$comment = $comment->find('all',array('conditions' => "resource_type='dialog' and resource_id={$_REQUEST['dialog_id']} and id > {$_REQUEST['last_comment_id']}",'order' => 'created_at desc'));
	$len2 = count($comment);
	$last_comment_id = $len2 > 0 ? $comment[$len2-1]->id : $_REQUEST['last_comment_id'];
	for($i=0;$i<$len2;$i++){?>
		str = '<?php echo_dialog_comment($comment[$i]);?>';
		$('#comment_list_box').prepend(str);
	<?php } ?>
	$('#last_comment_id').val('<?php echo $last_comment_id;?>');	
	
	<?php
	for($i=0;$i<$len1;$i++){
		$answer_count ++;?>
		str = '<?php echo_dialog_answer($answers[$i],$answer_count,$dialog_id);?>';
		$('#div_answer_list_innerbox').append(str);
	<?php } 
		if($alert_str){
			echo "alert('$alert_str');";
		}
	?>
	$('#last_answer_id').val('<?php echo $last_answer_id;?>');
	$('#answer_count').val('<?php echo $answer_count;?>');	
	
	//rebind the thick box event for comment_href
	$('.comment_href').unbind();
	tb_init('.comment_href');
	scroll_buttom();
	</script>