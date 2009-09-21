<?php
  require_once('../../frame.php');
  $rating_value = new table_class("smg_rating_value");
  if($_POST['id']!=''){
  	$rating_value->find($_POST['id']);
  }
  $rating_value->item_id = $_POST['item_id'];
  $rating_value->date = $_POST['date'];
  $rating_value->value = $_POST['value'];
  $rating_value->value2 = $_POST['value2'];
  $rating_value->value3 = $_POST['value3'];
  $rating_value->save();
  redirect('index.php');
?>
