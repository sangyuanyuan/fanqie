<?php
    require_once('frame.php');
	
	$db = get_db();
	
	$sql = "insert into smg_news2(id,category_id,priority,click_count,is_adopt,is_deleted,can_commentable,forbbide_copy,tags,title,short_title,description,content,created_at,last_edited_at,publisher_id,keywords,news_type,file_name,target_url,is_photo_news,photo_src,video_photo_src,dept_id,image_flag,video_flag,sub_news_id,vote_id,video_src,related_news,platform,copy_from,sub_headline,is_dept_adopt,dept_category_id,dept_priority,is_recommend,is_commentable,low_quality,related_videos,old_category_id,flower,phone) select id,category_id,priority,click_count,is_adopt,is_deleted,can_commentable,forbbide_copy,tags,title,short_title,description,content,created_at,last_edited_at,publisher_id,keywords,news_type,file_name,target_url,is_photo_news,photo_src,video_photo_src,dept_id,image_flag,video_flag,sub_news_id,vote_id,video_src,related_news,platform,copy_from,sub_headline,is_dept_adopt,dept_category_id,dept_priority,is_recommend,is_commentable,low_quality,related_videos,old_category_id,flower,phone from smg_news";
	
	$db->execute($sql);
?>
