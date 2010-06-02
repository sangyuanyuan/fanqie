<?php
	include 'frame.php';
	include 'lib/xspace_api.php';
	include 'lib/ActiveRecord.php';
	include 'inc/project_pubfun.php';
	$year=substr(date('Y-m-d'),0,4);
	$month=substr(date('Y-m-d'),5,2);
	$upload = new upload_file_class();
	$upload->save_dir = '/blog/attachments/'.$year.'/'.$month.'/';
	$upload_name = $upload->handle('file_name');
	$photo_src='/blog/attachments/'.$year.'/'.$month.'/'.$upload_name;
	$ip=$_SERVER['REMOTE_ADDR'];
	$ret = create_baby_album($_POST['id'],$_POST['nick_name'],$_POST['name'],$photo_src,$_POST['desc'],$ip);
?>