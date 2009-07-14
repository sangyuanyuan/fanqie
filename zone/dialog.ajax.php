<?php
	require "../frame.php";
	require "pub.php";
	switch ($_POST['optype']) {
		case 'add_question':
			$question = new table_class('smg_dialog_question');
			$question->dialog_id = $_POST['dialog_id'];
			$question->ip = $_SERVER['REMOTE_ADDR'];
			$question->create_time = date("Y-m-d H:i:s");
			$question->writer = $_POST['writer'];
			$question->content = str_replace('<p>', '', $_POST['content']);
			$question->content = str_replace('</p>','',$question->content);
			$question->save();
			break;
		
		default:
			;
		break;
	}
	
	//refresh the question box
	$db = get_db();
	$questions = $db->query('select * from smg_dialog_question where id > ' .$_POST['last_question_id']);
	$question_count = $_POST['question_count'];
	$len = count($questions);
	?>
	<script>
	<?php
	for($i=0;$i<$len;$i++){
		$question_count ++;?>
		var str = '<?php echo_dialog_question($questions[$i],$question_count);?>';
		$('#div_question').append(str);

	<? }?>
	$('#last_question_id').val(<? echo array_pop($questions)->id;?>);
	$('#question_count').val(<?php echo $question_count;?>);
	</script>
