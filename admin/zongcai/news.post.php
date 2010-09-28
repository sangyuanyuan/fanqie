<?php 
	require "../../frame.php";
	judge_role('admin');
	$news_id = $_POST['id'] ? $_POST['id'] : 0;
	$news = new table_class('smg_news');
	if($news_id!=0){
		$news->find($news_id);
	}else{
		$news2 = new table_class('smg_news');
		$news2->update_attributes($_POST['news'],false);
		$news2->is_adopt = 0;
		$news2->category_id = 23;
		$news2->platform = 'news';
		
		$pos = strpos(strtolower($news2->content), '<img ');
		if($pos !== false){
			$pos_end = strpos(strtolower($news2->content), '>',$pos);
			$imgstr = substr($news2->content, $pos,$pos_end -$pos +1);
			#alert($pos_end .';'.$imgstr);
			$imgstr = str_replace('\"', '"', $imgstr);
			$pos = strpos($imgstr, 'src="');
			$pos_end = strpos($imgstr, '"',$pos + 5);
			$src = substr($imgstr, $pos+5,$pos_end - $pos - 5);
			$news2->photo_src = $src;
			$news2->is_photo_news = 1;
		}else{
			$news2->is_photo_news = 0;
			$news2->photo_src = "";
		}
		
		if($_POST['news']['target_url']!=''){
			$news2->news_type=3;
		}else{
			$news2->news_type=1;
		}
		$news2->created_at = date("Y-m-d H:i:s");
		$news2->last_edited_at = date("Y-m-d H:i:s");
		$news2->publisher_id = $_COOKIE['smg_user_nickname'];
		$news2->click_count = 0;					
		$news2->is_deleted = 0;
		$news2->can_commentable = 1;
		$news2->save();
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
	
	if($_POST['news']['target_url']!=''){
		$news->news_type=3;
	}else{
		$news->news_type=1;
	}
		
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
		$news->save();
	}

	redirect('zongcai_news.php?category='.$news->category_id);

	#var_dump($news);
	
?>