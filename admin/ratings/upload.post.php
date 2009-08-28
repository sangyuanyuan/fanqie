<?php
  require_once('../../frame.php');
  $ratings = new table_class('smg_ratings');
  $ratings->date = $_POST['date'];
  $ratings->item_id = $_POST['item_id'];
  if($_FILES['file_name']['name']!=null){
  	$upload = new upload_file_class();
	$upload->save_dir = '/upload/file/';
	$upload_name = $upload->handle('file_name');
	$ratings->file_path = '/upload/file/' .$upload_name;
	$ratings->save();
  }
  redirect('index.php');
?>
