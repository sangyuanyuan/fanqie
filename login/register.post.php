<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-注册</title>
	<link href="/css/admin.css" rel="stylesheet" type="text/css">
</head>
<?php
	include "../frame.php";
	include('uc_client/config.inc.php');
	include('uc_client/client.php');
	$db = get_db();
	$user = new table_class('smg_user');
	$user->update_attributes($_POST['user'],false);
	$ret = uc_user_register($user->name,$user->password,$_POST['email']);
	if($ret > 0){
		$sql = "insert into bbs_members (uid,username,password,gender,regip) values ('" .$ret ."','" .$user->name ."','" .$user->password ."','0','" .getenv('REMOTE_ADDR') ."')";
		$db->execute($sql);
		$user->nick_name = $user->name;
		$user->role_name = 'member';
		$user->register_type = 'nick_name';
		$user->save();
		alert('恭喜您,注册成功!');
		redirect('/login/login.php');
		exit;
	}
	switch ($ret) {
		case -1:
			$error = '用户名不合法!';
		break;
		case -2:
			$error = '包含不允许注册的词语!';
		break;
		case -3:
			$error = '用户名已经存在!';
		break;
		case -4:
			$error = 'Email 格式有误!';
		break;
		case -5:
			$error = 'Email 不允许注册!';
		break;
		case -6:
			$error = '该 Email 已经被注册!';
		break;
		
		default:
			;
		break;
	}
	alert($error);
	redirect('register.php?name=' . urlencode($user->name) .'&email=' . $_POST['email']);
?>