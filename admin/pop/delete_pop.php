﻿<?php
	require "../../frame.php";
	$db = get_db();
	$delete_news_id  = implode(',',$_POST['delete_news']);
	$sql = 'delete from smg_pop where id in(' .$delete_news_id .')';
	$db->execute($sql);
?>