<?php
    require_once('../frame.php');

	$question_record = new table_class('smg_question_record');
	$question_record->update_attributes($_POST['record'],false);
	$question_record->question_count = isset($_POST['count'])?$_POST['count']:0;
	$question_record->point = isset($_POST['point'])?$_POST['point']:0;
	$question_record->created_at = date("Y-m-d H:i:s");
	$question_record->save();
	
	redirect('result.php?id='.$question_record->id);
	
?>