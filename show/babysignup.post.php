<?
	require_once('../frame.php');
if($_POST['utype']=="babyvote")
{
	$news = new table_class('smg_baby_vote');
	$news->update_attributes($_POST['baby'],false);
	if($_FILES['photourl']['name'] != ''){
		$upload = new upload_file_class();
		$upload->save_dir = '/upload/baby/';
		$news->photourl = '/upload/baby/' .$upload->handle('photourl','filter_pic');	
	}
	$news->createtime = date("Y-m-d H:i:s");
	$news->content = str_replace("'",'\"',$news->content);
	$news->save();
	alert('报名成功！');
	redirect('babyvote.php');
}

if($_POST['utype']=="babyitem")
{
	$news = new table_class('smg_baby_item');
	$news->update_attributes($_POST['baby'],false);
	if($_FILES['photourl']['name'] != ''){
		$upload = new upload_file_class();
		$upload->save_dir = '/upload/baby/';
		$news->photourl = '/upload/baby/' .$upload->handle('photourl','filter_pic');	
	}
	$news->createtime = date("Y-m-d H:i:s");
	$news->content = str_replace("'",'\"',$news->content);
	$news->save();
	alert('上传成功！');
	redirect('babyshow.php?id='.$_POST['baby']['babyid']);
}
?>