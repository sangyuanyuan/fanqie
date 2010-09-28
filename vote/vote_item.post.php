<?php
    require_once('../frame.php');
	
	#var_dump($_POST);
	$vote_item = new table_class('smg_vote_item');
	$vote_item->vote_id = $_POST['vote_id'];
	$vote_item->title = $_POST['title'];
	$vote_item->save();
	redirect('/vote/vote.php?vote_id='.$_POST['vote_id']);
?>

