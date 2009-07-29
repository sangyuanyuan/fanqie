<?php 
	require "../../frame.php";
	var_dump($_POST);
	$news_id = $_POST['id'] ? $_POST['id'] : 0;
	$news = new table_class('smg_news');
	if($news_id!=0){
		$news->find($news_id);
	}
	
	$news->update_attributes($_POST['news'],false);
	$news->is_dept_adopt = 1;
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
	
	$news->is_adopt = 1;
	
		
	if($news_id == 0){
		//insert news
		$news->created_at = date("Y-m-d H:i:s");
		$news->last_edited_at = date("Y-m-d H:i:s");
		$news->publisher_id = $_COOKIE['smg_user_nickname'];
		$news->click_count = 0;					
		$news->is_deleted = 0;
		$news->can_commentable = 1;
		$news->save();
	}else{
		//update news
		if($_POST['news']['forbbide_copy']==''){
			$news->forbbide_copy=0;
		}
		
		$news->last_edited_at = date("Y-m-d H:i:s");
		if($news->category_id == '') $news->category_id = 0;
		if($news->dept_category_id == '') $news->dept_category_id = 0;
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
		
	}

	//redirect('news_list.php?category='.$news->category_id);

	#var_dump($news);
	
?>