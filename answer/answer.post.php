<?php
  require_once('../frame.php');
  if(date('Y-m-d')!="2010-09-18"){
		session_start();
		if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
		{
			$question_record = new table_class('smg_question_record');
			$question_record->update_attributes($_POST['record'],false);
			$question_record->question_count = isset($_POST['count'])?$_POST['count']:10;
			$question_record->point = isset($_POST['point'])?$_POST['point']:10;
			$question_record->created_at = date("Y-m-d H:i:s");
			$question_record->r_id = $_POST['r_id'];
			$question_record->r_type = $_POST['r_type'];
			$question_record->s_point = isset($_POST['point_value'])?$_POST['point_value']:10;
			$dept_score = ($question_record->point/$question_record->s_point)/$question_record->question_count;
			if($dept_score<0){
				$question_record->dept_score = 0;
			}elseif($dept_score==1){
				$question_record->dept_score = 5;
			}else{
				$question_record->dept_score = 3;
			}
			$question_record->save();
			$_SESSION['url']="";
			if($_POST['r_id']!="36")
			{
				redirect('result.php?id='.$question_record->id);
			}
			else
			{
				redirect('result_hd.php?id='.$_POST['r_id']);	
			}
		}
		else
		{
			die('请从网站入口提交！');	
		}
	}
	else
	{
		alert('对不起今天关闭一切提交！');	
	}
?>