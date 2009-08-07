<?php 
	include "../frame.php";
	$status = $_SESSION['smg_chat_status'];
	$op = $_POST['op'];
	$chat_id = $_COOKIE['smg_chat_id'];
	$db = get_db();
	$db->execute("delete from smg_chat_queue where created_at < DATE_SUB(now(),INTERVAL  1 MINUTE)");
	$db->execute("delete from smg_chat_message where created_at < DATE_SUB(now(),INTERVAL  1 MINUTE)");
	$sql = "insert into smg_chat_room_online (chat_id, expire_at) values ('$chat_id',now() + INTERVAL 1 MINUTE) ON DUPLICATE key update expire_at = now() + INTERVAL 1 MINUTE";
	$db->execute($sql);	
	if($status == 'connecting'){
		$db->execute("update smg_chat_queue set created_at = now() + INTERVAL 1 MINUTE");
	}
	$sql = "select count(*) as online_count from smg_chat_room_online where expire_at > now()";
	$db->query($sql);
	$db->move_first();
	$online_count = $db->field_by_name('online_count');

	switch ($op) {
		case 'click_button':
			if(empty($status)){
				//start to connect sb
				$remote = $db->query("select * from smg_chat_queue where chat_id !='$chat_id' order by id asc limit 1");
				if(!$remote || count($remote) <= 0){
					$sql = "insert into smg_chat_queue (chat_id,created_at) select '$chat_id',NOW() from dual where not exists(select * from smg_chat_queue where chat_id= '$chat_id');";
					$db->execute($sql);
					set_status('connecting');
					unset($_SESSION['remote_id']);
				}else{
					$db->execute('delete from smg_chat_queue where id=' .$remote[0]->id);
					$now = now();
					#$db->execute("insert into smg_chat_connected (chater1, chater2, created_at) values ('{$remote[0]->chat_id}','$chat_id','{$now}')");
					set_status('connected');
					send_message('system', $remote[0]->chat_id, $chat_id, 'connect');
					$_SESSION['remote_id'] = $remote[0]->chat_id;
					echo "<script>add_chat('匹配成功!','s');</script>";
				}
			}else if($status == 'connecting'){
				//cancel connect
				$db->execute("delete from smg_chat_queue where chat_id='$chat_id'");
				set_status('');
			}else if($status == 'connected'){
				send_message('system', $_SESSION['remote_id'], $chat_id, 'disconnect');
				set_status('');
				echo "<script>add_chat('链接已断开!','s');</script>";
				unset($_SESSION['remote_id']);
			}			
			break;
		case 'refresh':
			$msgs = $db->query("select * from smg_chat_message where reciever='$chat_id'");
			if(is_array($msgs)){
				foreach ($msgs as $v) {
					$ids[] = $v->id;;
				}
				$db->execute("delete from smg_chat_message where id in(" .implode(',',$ids) .")");
				$str = '';
				foreach ($msgs as $v) {
					if($v->msg_type=='chat'){
						$str .= "add_chat('{$v->content}','h','{$v->sender_gender}');";
					}else if($v->msg_type=='connect'){
						$str .= "add_chat('已经有一位聊友进入','s');";
						$_SESSION['remote_id'] = $v->content;
						set_status('connected');
					}else if($v->msg_type == 'disconnect'){
						$str .= "add_chat('聊友已离开','s');";
						unset($_SESSION['remote_id']);
						set_status('');						
					}
				}
				echo "<script>$str</script>";
			}
			
			break;	
		case 'chat':
			send_message($chat_id, $_SESSION['remote_id'], $_POST['content'], 'chat',$_COOKIE['smg_chat_gender']);
			break;	
		default:
			;
		break;
	}
	
	function set_status($value){
		$_SESSION['smg_chat_status'] = $value;
		@SetCookie('smg_chat_status',$value,time()+3600,'/');
	}
	
	function send_message($sender,$reciever,$content,$type,$send_gender){
		$content = mysql_escape_string($content);
		$db = get_db();		
		if($send_gender){
			$db->execute("insert into smg_chat_message(sender,reciever,content,msg_type,created_at,sender_gender) values('$sender','$reciever','$content','$type',now(),'$send_gender')");			
		}else{
			$db->execute("insert into smg_chat_message(sender,reciever,content,msg_type,created_at) values('$sender','$reciever','$content','$type',now())");			
		}
		
	}
?>
<script>
	toggle_button();
	refresh_waiter(<?php echo $online_count;?>);
</script>