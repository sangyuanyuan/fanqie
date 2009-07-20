<?php
	require "../frame.php";
	
	#var_dump($_POST);
	
	$question = new table_class('smg_question');
	$question -> update_attributes($_POST['question'],false);
	$question->create_time = date("Y-m-d H:i:s");
	$question->problem_id = 0;
	$question->save();
	
	if($_POST['item']){
		foreach($_POST['item'] as $v){
			$item = new table_class('smg_question_item');
			$item->name = $v[name];
			if($v[attribute]!=''){
				$item->attribute = 1;
			}else{
				$item->attribute = 0;
			}
			$item->question_id = $question->id;
			$item -> save();
		}
	}
	
	alert('发表成功！谢谢参与！');
	redirect('question.php');
?>