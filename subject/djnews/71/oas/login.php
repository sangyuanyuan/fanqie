<?php
require_once "oas.init.php";
$action = "login";
$app_url	= (isset($IN['app']) && isset($SYS_ENV["{$IN['app']}"]))?$SYS_ENV["{$IN['app']}"]:$SYS_ENV['CWPS_URL'];
$forward = empty($IN['forward']) ? $SYS_ENV['CWPS_URL'] : $IN['forward'];

switch($IN['app']) {
	case "discuz":
		if($Auth->isLogin()) {
			$member = array(
				'username'	=> $_SESSION['UserName'],
				'password'	=> $_SESSION['Password'],
				'email'		=> $_SESSION['Email'],
				'gender'	=> $_SESSION['Gender'],
				'bday'		=> $_SESSION['Birthday'],
				'regip'		=> $_SESSION['Ip'],
				'regdate'	=> $_SESSION['RegisterDate'],
				'time'		=> $_SESSION['SessionActiveTime']
			);
			$auth = passport_encrypt(passport_encode($member),$SYS_ENV['passport_key']);
			$verify = md5($action.$auth.$forward.$SYS_ENV['passport_key']);
			
			$OAS_COOKIE = $_SESSION;
			unset($OAS_COOKIE['Password']);
			$OAS_COOKIE = passport_encrypt(passport_encode($OAS_COOKIE),$SYS_ENV['passport_key']);
			if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
				setcookie('OAS_COOKIE',$OAS_COOKIE,$SYS_ENV['cookie_timeout'],'/');
			} else {
				setcookie('OAS_COOKIE',$OAS_COOKIE,$SYS_ENV['cookie_timeout'],'/',$SYS_ENV['main_domain']);
			}
			
			header("Location: {$app_url}api/passport.php?action={$action}&auth=".rawurlencode($auth)."&forward=".rawurlencode($forward)."&verify={$verify}");
		} else {
			if(!isset($IN['formcwps'])) {
				$referer = $SYS_ENV['OAS_URL']."login.php?app={$IN['app']}&formcwps=true&forward=".rawurlencode($forward);
				$Auth->login($referer);
			} else {
				header("Location:{$forward}");
			}
		}
		break;
	case "phpwind":
		if($Auth->isLogin()) {
			$userdb = array();
			$userdb['username']	= $_SESSION['UserName'];
			$userdb['password']	= $_SESSION['Password'];
			$userdb['email']	= $_SESSION['Email'];
			$userdb['time']		= $_SESSION['SessionActiveTime'];
			$userdb['cktime']	= 0;

			$userdb_encode='';
			foreach($userdb as $key=>$val){
				$userdb_encode .= $userdb_encode ? "&$key=$val" : "$key=$val";
			}
			$userdb_encode=str_replace('=','',StrCodeCWPS($userdb_encode));
			$verify = md5($action.$userdb_encode.$forward.$SYS_ENV['passport_key']);
			
			$OAS_COOKIE = $_SESSION;
			unset($OAS_COOKIE['Password']);
			$OAS_COOKIE = passport_encrypt(passport_encode($OAS_COOKIE),$SYS_ENV['passport_key']);
			if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
				setcookie('OAS_COOKIE',$OAS_COOKIE,$SYS_ENV['cookie_timeout'],'/');
			} else {
				setcookie('OAS_COOKIE',$OAS_COOKIE,$SYS_ENV['cookie_timeout'],'/',$SYS_ENV['main_domain']);
			}
			
			header("location: {$app_url}passport_client.php?action={$action}&userdb=".rawurlencode($userdb_encode)."&forward=".rawurlencode($forward)."&verify={$verify}");
		} else {
			if(!isset($IN['formcwps'])) {
				$referer = $SYS_ENV['OAS_URL']."login.php?app={$IN['app']}&formcwps=true&forward=".rawurlencode($forward);
				$Auth->login($referer);
			} else {
				header("Location:{$forward}");
			}
		}
		break;
	case "vbb":
		if($Auth->isLogin()) {
			$member = array(
				'username'	=> $_SESSION['UserName'],
				'password'	=> $_SESSION['Password'],
				'email'		=> $_SESSION['Email'],
				'gender'	=> $_SESSION['Gender'],
				'bday'		=> $_SESSION['Birthday'],
				'regip'		=> $_SESSION['Ip'],
				'regdate'	=> $_SESSION['RegisterDate'],
				'time'		=> $_SESSION['SessionActiveTime']
			);
			$auth = passport_encrypt(passport_encode($member),$SYS_ENV['passport_key']);
			$verify = md5($action.$auth.$forward.$SYS_ENV['passport_key']);
			
			$OAS_COOKIE = $_SESSION;
			unset($OAS_COOKIE['Password']);
			$OAS_COOKIE = passport_encrypt(passport_encode($OAS_COOKIE),$SYS_ENV['passport_key']);
			if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
				setcookie('OAS_COOKIE',$OAS_COOKIE,$SYS_ENV['cookie_timeout'],'/');
			} else {
				setcookie('OAS_COOKIE',$OAS_COOKIE,$SYS_ENV['cookie_timeout'],'/',$SYS_ENV['main_domain']);
			}
			
			header("Location: {$app_url}passport.php?action={$action}&auth=".rawurlencode($auth)."&forward=".rawurlencode($forward)."&verify={$verify}");
		} else {
			if(!isset($IN['formcwps'])) {
				$referer = $SYS_ENV['OAS_URL']."login.php?app={$IN['app']}&formcwps=true&forward=".rawurlencode($forward);
				$Auth->login($referer);
			} else {
				header("Location:{$forward}");
			}
		}
		break;
	default:
		if($Auth->isLogin()) {
			$OAS_COOKIE = $_SESSION;
			unset($OAS_COOKIE['Password']);
			$OAS_COOKIE = passport_encrypt(passport_encode($OAS_COOKIE),$SYS_ENV['passport_key']);
			if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
				setcookie('OAS_COOKIE',$OAS_COOKIE,$SYS_ENV['cookie_timeout'],'/');
			} else {
				setcookie('OAS_COOKIE',$OAS_COOKIE,$SYS_ENV['cookie_timeout'],'/',$SYS_ENV['main_domain']);
			}
			
			header("Location: {$forward}");
		} else {
			if(!isset($IN['formcwps'])) {
				$referer = $SYS_ENV['OAS_URL']."login.php?formcwps=true&forward=".rawurlencode($forward);
				$Auth->login($referer);
			} else {
				header("Location:{$forward}");
			}
		}
} 
?>