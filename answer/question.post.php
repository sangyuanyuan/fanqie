<?php
	require "../frame.php";
	if(date('Y-m-d')!="2010-09-18"){
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		#var_dump($_POST);
		
		$question = new table_class('smg_question');
		$question -> update_attributes($_POST['question'],false);
		$question->create_time = date("Y-m-d H:i:s");
		$question->problem_id = 0;
		$question->is_adopt = 1;
		$question->ip=getenv('HTTP_X_FORWARDED_FOR');
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
				$item->ip = getenv('HTTP_X_FORWARDED_FOR');
				$item -> save();
			}
		}
		$_SESSION["url"]="";
		alert('上传成功！谢谢参与！');
		redirect('answerlist.php');
	}
	else
	{
		die('请从网站入口提交表单！');	
	}
}
else
	{
		alert('对不起今天关闭一切提交！');	
	}
?>