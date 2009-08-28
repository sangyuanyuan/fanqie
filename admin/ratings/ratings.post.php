<?php
  require_once('../../frame.php');
  $item = new table_class('smg_report_item');
  if($_POST['id']!=''){
  	$item->find('id');
  }
  if($_POST['name']!=''){
  	$item->name = $_POST['name'];
	  if($_POST['check']!=''){
	  	$item->is_dept = 1;
	  }else{
	  	$item->is_dept = 0;
	  }
	  $item->save();
  }
  redirect('index.php');
?>
