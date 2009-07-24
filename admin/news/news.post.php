<?php 
	require "../../frame.php";
	$news_id = $_POST['id'] ? $_POST['id'] : 0;
	//var_dump($_POST);
	//exit;
	$news = new table_class('smg_news');
	if($news_id!=0){
		$news->find($news_id);
	}
	
	$news->update_attributes($_POST['news'],false);
	$news->content = str_replace("'",'\"',$news->content); //mysql_escape_string($news->content);
	$news->description = str_replace("'",'\"',$news->description);//$news->description = mysql_escape_string($news->description);
	#$news->content = strtr($news->content,array('<div>' => '','</div>' => '','<DIV>' => '','</DIV>' => ''));
	$news->keywords = str_replace('　',' ',$news->keywords);
	#$news->echo_sql = true;
	$news->is_recommend = 1;
	if($news->is_dept_adopt != 1){
		$news->is_dept_adopt = 0;
	}
	$category = new table_class('smg_category');
	if($news->category_id!=''){
		$category->find($news->category_id);
		$news->platform = $category->platform;
	}
	
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
		
	if($news_id == 0){
		//insert news
		$news->created_at = date("Y-m-d H:i:s");
		$news->last_edited_at = date("Y-m-d H:i:s");
		$news->publisher_id = $_COOKIE['smg_user_nickname'];
		$news->click_count = 0;					
		$news->is_deleted = 0;
		$news->can_commentable = 1;
		if($news->is_adopt == ''){
			$news->is_adopt = 0;
		}
		$news->save();
		if($_POST['delete_subject']!= 2)	{				
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
		
		

	}else{
		//update news
		$news->last_edited_at = date("Y-m-d H:i:s");
		if($_POST['news']['forbbide_copy']==''){
			$news->forbbide_copy=0;
		}		
		$news->last_edited_at = date("Y-m-d H:i:s");
		$news->save();
		if($_POST['delete_subject'] == 1){	
				$sql = "delete from smg_subject_items where category_type='news' and resource_id={$news->id}";
				$db = get_db();
				$db->execute($sql);
			if($_POST['subject_id']){
				$category_item = new table_class('smg_subject_items');
				$category_item->find('all',array('conditions' => 'category_type="news" and resource_id='.$news_id));
				$category_item->category_type = 'news';
				$category_item->resource_id = $news->id;
				$category_item->subject_id = $_POST['subject_id'];
				$category_item->category_id = $_POST['subject_category_id'];
				$category_item->save();
			}
		}else if($_POST['delete_subject'] == 2){
				$sql = "delete from smg_subject_items where category_type='news' and  resource_id={$news->id}";
				$db = get_db();
				$db->execute($sql);
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
	
	redirect('index.php?category='.$_POST['news']['category_id']);
	#var_dump($news);
	
?>