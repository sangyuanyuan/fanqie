<?php
   require_once('../frame.php');
   
   $vote_record = new table_class('smg_zongcai_vote_record');
   $vote_record->vote_id = $_POST['vote_id'];
   $vote_record->item_id = $_POST['item_id'];
   $vote_record->type = $_POST['type'];
   $ip = getenv('REMOTE_ADDR');
   $y2k = mktime(0,0,0,1,1,2020);
   if($ip=="172.27.4.80"||$ip=="172.25.201.88"||$ip=="172.28.10.33"){
	   	@SetCookie($_POST['type'],$_POST['vote_id'],$y2k,'/');
	   	$vote_record->ip = 1;
   }else{
	   	$vote_record->ip = $ip;
   }
   $vote_record->save();
   
   
?>