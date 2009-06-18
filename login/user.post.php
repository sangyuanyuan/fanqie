<?
require_once('../frame.php');

if($_POST['user_type']=="login")
{
	$login_text = $_POST['login_text'];
	$password_text = $_POST['password_text'];

	$db = get_db();
	$sql = 'select * from smg_user where name="'.$login_text.'" and password="'.$password_text.'"';
	$login_info = $db->query($sql);
	$login_info_num = $db->record_count;
	if($login_info === false){
		$error = '系统错误!';
	}
	elseif($login_info_num == 0)
	{
		$error = "用户名或密码不对";
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
		$error =  "ok";
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
}



if($_POST['user_type']=="logout")
{
		SetCookie('smg_user_dept',"",$y2k,'/');
		SetCookie('smg_username',"",$y2k,'/');
		SetCookie('smg_user_nickname',"",$y2k,'/');
		SetCookie('smg_role',"",$y2k,'/');
		echo "ok";
}

if($_POST['user_type']=="reg")
{
	$user_text = $_POST['user_text'];
	$password_text = $_POST['password_text'];
	$email_text = $_POST['email_text'];

	$db = get_db();
	$sql = 'select * from smg_user where name="'.$user_text.'" ';
	$reg_info = $db->query($sql);
	$reg_info_num = $db->record_count;
	if($reg_info_num == 1)
	{
		echo "error";
	}
	else
	{
		$y2k = mktime(0,0,0,1,1,2020); 
		$sql = 'insert into smg_user (name,password,nickname,register_type_id) values ("'.$user_text.'","'.$password_text.'","'.$user_text.'",2) ';
		$db->execute($sql);
		SetCookie(smg_username,$user_text,$y2k,'/');
		SetCookie(smg_user_nickname,$user_text,$y2k,'/');
		echo "ok";
	}	
}






?>