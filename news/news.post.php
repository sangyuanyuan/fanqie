<?php 
	require "../frame.php";
	$news_id = $_POST['id'] ? $_POST['id'] : 0;
	
	$news = new table_class('smg_news');
	if($news_id!=0){
		$news->find($news_id);
	}
	
	$news->update_attributes($_POST['news'],false);
	$pos = strpos(strtolower($news->content), '<img ');
	if($pos !== false){
		$pos_end = strpos(strtolower($news->content), '>',$pos);
		$imgstr = substr($news->content, $pos,$pos_end -$pos +1);
		#alert($pos_end  .';' .$imgstr);
		$pos = strpos($imgstr, 'src="');
		$pos_end = strpos($imgstr, '"',$pos + 5);
		$src = substr($imgstr, $pos+5,$pos_end-$pos - 5);
		$news->photo_src = $src;
		$news->is_photo_news = 1;
	}else{
		$news->is_photo_news = 0;
	}
	if ($news->priority == ""){
		$news->priority = 100;
	}
	if($news->is_adopt == ''){
		$news->is_adopt = 0;
	}
	if($_FILES['video_src']['name'] != ''){
		$upload = new upload_file_class();
		$upload->save_dir = '/upload/video/';
		$upload_name = $upload->handle('video_src','filter_video');
		$news->video_src = '/upload/video/' .$upload_name;
		$news->video_photo_src = '/upload/video/' .$upload->handle('video_pic','filter_pic');
		$news->video_flag = 1;		
	}
	
	if($_FILES['file_name']['name'] != ''){
		$upload = new upload_file_class();
		$upload->save_dir = '/upload/file/';
		$upload_name = $upload->handle('file_name');
		$news->file_name = '/upload/file/' .$upload_name;	
	}
	$table_change = array('<p>'=>'');
	$table_change += array('</p>'=>'');
	$title = strtr($news->title,$table_change);
	$short_title =  strtr($news->short_title,$table_change);
	$description =  strtr($news->description,$table_change);
	$content =  strtr($news->content,$table_change);
	$news->title = $title;
	$news->short_title = $short_title;
	$news->description = $description;
	$news->content = $content;
	$news->publisher_id = strtr($news->publisher_id,$table_change);
	$news->dept_id=strtr($news->dept_id,$table_change);
	$news->isadopt='0';
	$news->category_id='4';
	
	if($news_id == 0){
		//insert news
		$news->created_at = date("Y-m-d H:i:s");
		$news->last_edited_at = date("Y-m-d H:i:s");
		$news->click_count = 0;					
		$news->is_deleted = 0;	
		$news->can_commentable = 1;
		$news->save();
		if($_POST['subject_id']){
			$category_item = new table_class('smg_subject_items');
			$category_item->subject_id = $_POST['subject_id'];
			$category_item->category_type = 'news';
			$category_item->resource_id = $news->id;
			$category_item->category_id = $_POST['subject_category_id'];
			$category_item->save();
		}
		if($_POST['category_add']){
			$category_add = explode(',', $_POST['category_add']);
			$copy_from = $news->id;
			foreach ($category_add as $v) {
				$news->category_id = $v;
				$news->id=0;
				$news->copy_from = $copy_from;
				$news->save();
			}
		}
		

	}
	
	redirect('news_sub.php');
	#var_dump($news);
	
?>