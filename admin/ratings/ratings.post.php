<?php
  require_once('../../frame.php');
  judge_role('admin');
  $item = new table_class('smg_report_item');
  if($_POST['id']!=''){
  	$item->find($_POST['id']);
  }
  if($_POST['name']!=''){
  	$item->name = $_POST['name'];
		$item->dept_id = $_POST['dept_id'];
		$item->content=$_POST['ratings']['content'];
	  if($_POST['check']!=''){
	  	$item->is_dept = 1;
	  }else{
	  	$item->is_dept = 0;
	  }
	  if($_POST['check1']!=''){
	  	$item->is_show = 1;
	  }else{
	  	$item->is_show = 0;
	  }
	  $item->save();
  }
  redirect('index.php');
?>
