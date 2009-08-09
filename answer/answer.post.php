<?php
    require_once('../frame.php');
	
	$question_record = new table_class('smg_question_record');
	$question_record->update_attributes($_POST['record'],false);
	$question_record->question_count = isset($_POST['count'])?$_POST['count']:10;
	$question_record->point = isset($_POST['point'])?$_POST['point']:10;
	$question_record->created_at = date("Y-m-d H:i:s");
	$question_record->r_id = $_POST['r_id'];
	$question_record->r_type = $_POST['r_type'];
	$question_record->s_point = isset($_POST['point_value'])?$_POST['point_value']:10;
	$dept_score = ($question_record->point/$question_record->s_point)/$question_record->question_count;
	if($dept_score<0.6){
		$question_record->dept_score = 0;
	}elseif($dept_score==1){
		$question_record->dept_score = 5;
	}else{
		$question_record->dept_score = 3;
	}
	$question_record->save();
	
	redirect('result.php?id='.$question_record->id);
	
?>