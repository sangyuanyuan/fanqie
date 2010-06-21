<?php 
	require_once('../../frame.php');
	$db=get_db();
	if($_POST['babyshowtype']=="addact")
	{
		
		$act = new table_class('smg_babyshow_act');
		if($_POST['babyshowid']!="")
		{
			$act->find($_POST['babyshowid']);	
		}
		$act->update_attributes($_POST['babyshow'],false);
		$act->content = str_replace("'",'\"',$news->content);
		$act->is_adopt = 0;
		$act->created_at = date("Y-m-d H:i:s");
		$act->save();
		redirect('person_actlist.php');
	}
	else if($_POST['babyshowtype']=="addphoto")
	{
		$photo = new table_class('smg_babyshow_photo');
		if($_POST['babyshowid']!="")
		{
			$photo>find($_POST['babyshowid']);	
		}
		$photo->update_attributes($_POST['babyshow'],false);
		if($_FILES['photo_src']['name'] != ''){
			$upload = new upload_file_class();
			$upload->save_dir = '/upload/baby/';
			$photo->photo_src = '/upload/baby/' .$upload->handle('photo_src','filter_pic');
		}
		$photo->created_at = date("Y-m-d H:i:s");
		$photo->save();
		redirect('person_index.php');
	}
	else if($_POST['babyshowtype']=="photodel")
	{
		$db->excute('delet from smg_babyshow_photo where id='.$_POST['id']);
	}
	else if($_POST['babyshowtype']=="actdel")
	{
		$db->excute('delet from smg_babyshow_photo where id='.$_POST['id']);
	}
	else if($_POST['babyshowtype']=="isadopt")
	{
		$db->excute('update smg_babyshow_act set is_adopt=1 where id='.$_POST['id']);
	}
	else if($_POST['babyshowtype']=="unadopt")
	{
		$db->excute('update smg_babyshow_act set is_adopt=0 where id='.$_POST['id']);
	}
	
?>