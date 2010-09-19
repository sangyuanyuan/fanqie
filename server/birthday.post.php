<?php
  require_once "../frame.php";
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		 $db = get_db();
		 if($_POST['type']=='contrl'){
		 	$sql = 'update smg_user_real set hide_birthday='.$_POST['value'].' where loginname="'.$_POST['id'].'"';
			$db->execute($sql);
		 }elseif($_POST['type']=='name'){
		 	$sql = 'select loginname from smg_user_real where nickname="'.$_POST['search'].'"';
			$record = $db->query($sql);
			if(count($record)==0){
				redirect('send_gift_list_detail.php?reciever=none');
			}
			for($i=0;$i<count($record);$i++){
				if(strlen($record[$i]->loginname)==8){
					redirect('send_gift_list_detail.php?reciever='.$record[$i]->loginname);
				}
			}
			redirect('send_gift_list_detail.php?reciever=none');
		 }elseif($_POST['type']=='number'){
		 	redirect('send_gift_list_detail.php?reciever='.$_POST['search']);
		 }else{
		 	redirect('birthday_search.php?key='.$_POST['search']);
		 }
	}
	else
	{
		die('请从网站入口提交！');	
	}
?>