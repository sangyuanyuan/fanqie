<?php
	require "../frame.php";	
	$vote = new table_class('smg_vote');
	$vote -> update_attributes($_POST['vote'],false);
	$vote ->vote_type = 'word_vote';
	$vote->created_at = date("Y-m-d H:i:s");
	$vote->limit_type = 'ip';
	$vote->category_id = 0;
	$vote->is_app=1;
	$vote->is_adopt = 1;
	$vote->save();
	
	if($_POST['item']){
		foreach($_POST['item'] as $v){
			$item = new table_class('smg_vote_item');
			$item->title = $v[name];
			$item->vote_id = $vote->id;
			$item -> save();
		}
	}
	
	alert('上传成功！谢谢参与！');
	redirect('vote_list.php');
?>