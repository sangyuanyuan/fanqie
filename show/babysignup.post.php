<?
	require_once('../frame.php');
 if(date('Y-m-d')!="2010-09-18"){
	$db=get_db();
if($_POST['utype']=="babyvote")
{
	$news = new table_class('smg_baby_vote');
	$parent_id = $_POST['baby']['parent_id'] ? $_POST['baby']['parent_id'] : 0;
	if($parent_id!=0)
	{
		$news_id=$db->query('select id from smg_baby_vote where parent_id='.$parent_id);
	}
	if($news_id!="")
	{
		$news->find($news_id[0]->id);
	}
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
	redirect('/subject/10liuyi/index.php');
}

if($_POST['utype']=="babyitem")
{
	$news = new table_class('smg_baby_item');
	$babyid=$_POST['baby']['id'];
	if($babyid!="")
	{
		$news->find($babyid);
	}
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
}
else
{
	alert('对不起今天关闭一切番茄网提交功能！');	
}
?>