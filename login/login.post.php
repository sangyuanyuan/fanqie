<?
require_once('../frame.php');
$login_text = $_POST['login_text'];
$password_text = $_POST['password_text'];

$db = get_db();
$sql = 'select * from smg_user where name="'.$login_text.'" and password="'.$password_text.'"';
echo($sql);
$login_info = $db->query($sql);
$login_info_num = $db->record_count;
$error = "";
if($login_info === false)
{
	$error = "error1";
}
elseif($login_info_num == 0){
	$error = "error2";
}
else
{
	$y2k = mktime(0,0,0,1,1,2020); 
	if ($login_info[0]->register_type == "real")
	{
		$sql = 'select * from smg_user_real where id='.$login_info[0]->smg_real_id;
		$login_info2 = $db->query($sql);
		SetCookie('smg_user_dept',$login_info2[0]->dept_id,$y2k,'/');
	}
	SetCookie('smg_username',$login_text,$y2k,'/');
	SetCookie('smg_user_nickname',$login_info[0]->nick_name,$y2k,'/');
	setcookie('smg_role', $login_info[0]->role_name,$y2k,'/');
	$error = "ok";	
}

if(is_ajax()){
	echo $error;
}else{
	if($error == 'ok'){
		$last_url = $_SERVER['HTTP_REFERER'];
		if(empty($last_url)){
			$last_url = '/admin/admin.php';
		}
		redirect($last_url,'header');
	}else{
		alert($error);
		redirect('/login/');
	}
}

?>