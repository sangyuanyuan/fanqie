<?php
  require_once('../../frame.php');
  $ratings = new table_class('smg_ratings');
	$date=aweek($_POST['date'],1);
	if($_POST['date']==$date[5]||$_POST['date']==$date[6])
	{
		$datetime=$_POST['date'];	
	}
	else
	{
		$datetime=$date[0]."-".$date[4];	
	}
  $ratings->date = $datetime;
  $ratings->item_id = $_POST['item_id'];
  if($_FILES['file_name']['name']!=null){
  	$upload = new upload_file_class();
	$upload->save_dir = '/pChart/Sample/';
	$upload_name = $upload->handle('file_name');
	$ratings->file_path = 'Sample/' .$upload_name;
	$ratings->imagetype = $_POST['image'];
	$ratings->save();
  }
  redirect('index.php');
?>
