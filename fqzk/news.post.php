<?php 
	require "../frame.php";
	
	$news = new table_class('smg_news');
	$news->update_attributes($_POST['news'],false);
	$news->content = str_replace("'",'\"',$news->content); //mysql_escape_string($news->content);
	$news->description = str_replace("'",'\"',$news->description);//$news->description = mysql_escape_string($news->description);
	$news->keywords = str_replace('　',' ',$news->keywords);
	$news->is_recommend = 1;
	$pos = strpos(strtolower($news->content), '<img ');
	if($pos !== false){
		$pos_end = strpos(strtolower($news->content), '>',$pos);
		$imgstr = substr($news->content, $pos,$pos_end -$pos +1);
		#alert($pos_end .';'.$imgstr);
		$imgstr = str_replace('\"', '"', $imgstr);
		$pos = strpos($imgstr, 'src="');
		$pos_end = strpos($imgstr, '"',$pos + 5);
		$src = substr($imgstr, $pos+5,$pos_end - $pos - 5);
		$news->photo_src = $src;
		$news->is_photo_news = 1;
	}else{
		$news->is_photo_news = 0;
		$news->photo_src = "";
	}
	if ($news->priority == ""){
		$news->priority = 100;
	}
	$news->is_adopt = 0;	
	if($_FILES['video_src']['name'] != ''){
		$upload = new upload_file_class();
		$upload->save_dir = '/upload/video/';
		$upload_name = $upload->handle('video_src','filter_video');
		$news->video_src = '/upload/video/' .$upload_name;		
		$news->video_flag = 1;		
	}
	if($_FILES['video_pic']['name'] != ''){
		$upload = new upload_file_class();
		$upload->save_dir = '/upload/video/';
		$news->video_photo_src = '/upload/video/' .$upload->handle('video_pic','filter_pic');
	}
		
	$table_change = array('<p>'=>'');
	$table_change += array('</p>'=>'');
	$title = strtr($news->title,$table_change);	
	$news->title = $title;
	$news->short_title =$news->title;

	$news->publisher_id = strtr($news->publisher_id,$table_change);
	$news->dept_id=strtr($news->dept_id,$table_change);
	$news->isadopt='0';
	$news->category_id='192';
	
	if($news_id == 0){
		//insert news
		$news->created_at = date("Y-m-d H:i:s");
		$news->last_edited_at = date("Y-m-d H:i:s");
		$news->click_count = 0;					
		$news->is_deleted = 0;	
		$news->can_commentable = 1;
		$news->save();			
	}
	alert("上传成功！请等待管理员审批！谢谢！");
	redirect('upload.php');
	#var_dump($news);
?>