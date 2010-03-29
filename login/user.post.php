<?
require_once('../frame.php');
include('uc_client/config.inc.php');
include('uc_client/client.php');
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
		//login from ucenter
		$ret = uc_user_login($login_text , $password_text);
		if($ret[0]<= 0 ){
			$error = "用户名或密码不对";		
		}else{
			//login sucessful
			$user = new table_class('smg_user');
			if($user->find_by_name($login_text)){
				$user = $user[0];
			};
			$user->name = $login_text;
			$user->password = $password_text;
			#$user->role_name = 'member';
			$user->nick_name = $login_text;
			#$user->register_type = 'nick_name';
			$user->save();
			@SetCookie('smg_username',$login_text,$y2k,'/');
			@SetCookie('smg_userid',$userid,$y2k,'/');
			@SetCookie('smg_user_nickname',$login_text,$y2k,'/');
			@setcookie('smg_role', 'member',$y2k,'/');
			$error =  "ok";
			@setcookie('smg_uid', $ret[0],$y2k,'/');
			echo (uc_user_synlogin($ret[0]));
		}
		
	}
	else
	{
		$y2k = mktime(0,0,0,1,1,2020); 
		if ($login_info[0]->register_type == "user_id"&&$login_info[0]->role_name!="1000")
		{
			$sql = 'select * from smg_user_real where id='.$login_info[0]->smg_real_id;
			$login_info2 = $db->query($sql);
			@SetCookie('smg_user_dept',$login_info2[0]->dept_id,$y2k,'/');
			$nick_name = $login_info2[0]->nickname;
			#alert($_COOKIE['smg_user_dept']);
		}else{
			$nick_name = $login_text;
		}
		@SetCookie('smg_username',$login_text,$y2k,'/');
		@SetCookie('smg_userid',$login_info[0]->smg_real_id,$y2k,'/');
		@SetCookie('smg_user_nickname',$nick_name,$y2k,'/');
		@setcookie('smg_role', $login_info[0]->role_name,$y2k,'/');
		@SetCookie('smg_user_id',$login_info[0]->id,$y2k,'/');
		session_start(); 
		$_SESSION["smg_role"] = $login_info[0]->role_name;	
		if($_SESSION['smg_role'] == 'admin'){
			@SetCookie('smg_user_dept',7,$y2k,'/');
		}
		$error =  "ok";
		$ret = uc_user_login($login_text,$password_text);
		if($ret[0] == -1)
		{//not exist!
			$reg = uc_user_register($login_text,$password_text,$login_text ."@smg.com");
			if($reg >0 ){
				$sql = "insert into bbs_members (uid,username,password,gender,regip) values ('" .$reg ."','" .$login_text ."','" .$password_text ."','0','" .getenv('REMOTE_ADDR') ."')";
				$db->execute($sql);
			}			
		}elseif ($ret[0] == -2)
		{//password wrong
			
		}
		
		if($ret[0]>0)
		{
			@setcookie('smg_uid', $ret[0],$y2k,'/');
			echo (uc_user_synlogin($ret[0]));
		}
		if($ret[0]<=0)
		{
			uc_user_login($login_text,$password_text);
		}	
	}	
	if(is_ajax()){
		echo $error;
	}else{
		if($error == 'ok'){

			$last_url = $_POST['lasturl'];
			if($login_info[0]->role_name == 'admin' || $login_info[0]->role_name == 'dept_admin'){
				
				$last_url = '/admin/admin.php';
				//var_dump($_SESSION);
			}else{
				$last_url = '/';
			}
			redirect($last_url);
		}else{
			alert($error);
			redirect('/login/login.php','js');
		}
	}	
}



if($_REQUEST['user_type']=="logout")
{
		SetCookie('smg_user_dept',"",$y2k,'/');
		SetCookie('smg_username',"",$y2k,'/');
		SetCookie('smg_user_nickname',"",$y2k,'/');
		SetCookie('smg_userid',"",$y2k,'/');
		SetCookie('smg_role',"",$y2k,'/');
		$_SESSION["smg_role"]  = '';
		echo uc_user_synlogout();
		if(is_ajax()){
			echo "ok";
		}else{
			redirect('/');
		}
		
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
		$sql = 'insert into smg_user (name,password,nickname,register_type,role) values ("'.$user_text.'","'.$password_text.'","'.$user_text.'",2,"member") ';
		$db->execute($sql);
		SetCookie(smg_username,$user_text,$y2k,'/');
		SetCookie(smg_user_nickname,$user_text,$y2k,'/');
		uc_user_register($user_text,$password_text,$user_text ."@smg.com");
		echo "ok";
	}	
}






?>