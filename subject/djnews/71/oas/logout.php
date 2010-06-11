<?php
require_once "oas.init.php";
$action = "logout";
$app_url	= (isset($IN['app']) && isset($SYS_ENV["{$IN['app']}"]))?$SYS_ENV["{$IN['app']}"]:$SYS_ENV['CWPS_URL'];
$forward = empty($IN['forward'])?$SYS_ENV['CWPS_URL']:$IN['forward'];

switch($IN['app']) {
	case "discuz":
		if(!isset($IN['formcwps'])) {
			$referer = "{$SYS_ENV['OAS_URL']}logout.php?app={$IN['app']}&formcwps=true&forward=".rawurlencode($forward);
			$Auth->logout($referer);
		} else {
			$auth = "";
			$verify = md5($action.$auth.$forward.$SYS_ENV['passport_key']);
			
			if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
				setcookie('OAS_COOKIE','',0,'/');
			} else {
				setcookie('OAS_COOKIE','',0,'/',$SYS_ENV['main_domain']);
			}
			header("Location:{$app_url}api/passport.php?action={$action}&auth=".rawurlencode($auth)."&forward=".rawurlencode($forward)."&verify={$verify}");
		}
		break;
	case "phpwind":
		$action = "quit";
		if(!isset($IN['formcwps'])) {
			$referer = "{$SYS_ENV['OAS_URL']}logout.php?app={$IN['app']}&formcwps=true&forward=".rawurlencode($forward);
			$Auth->logout($referer);
		} else {
			$userdb = array();
			$userdb['time']		= time();
			$userdb['cktime']	= 0;

			$userdb_encode='';
			foreach($userdb as $key=>$val){
				$userdb_encode .= $userdb_encode ? "&$key=$val" : "$key=$val";
			}
			$userdb_encode=str_replace('=','',StrCodeCWPS($userdb_encode));
			$verify = md5($action.$userdb_encode.$forward.$SYS_ENV['passport_key']);

			if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
				setcookie('OAS_COOKIE','',0,'/');
			} else {
				setcookie('OAS_COOKIE','',0,'/',$SYS_ENV['main_domain']);
			}
			
			header("location: {$app_url}passport_client.php?action={$action}&userdb=".rawurlencode($userdb_encode)."&forward=".rawurlencode($forward)."&verify={$verify}");
		}
		break;
	case "vbb":
		if(!isset($IN['formcwps'])) {
			$referer = "{$SYS_ENV['OAS_URL']}logout.php?app={$IN['app']}&formcwps=true&forward=".rawurlencode($forward);
			$Auth->logout($referer);
		} else {
			$auth = "";
			$verify = md5($action.$auth.$forward.$SYS_ENV['passport_key']);
			
			if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
				setcookie('OAS_COOKIE','',0,'/');
			} else {
				setcookie('OAS_COOKIE','',0,'/',$SYS_ENV['main_domain']);
			}
			header("Location:{$app_url}passport.php?action={$action}&auth=".rawurlencode($auth)."&forward=".rawurlencode($forward)."&verify={$verify}");
		}
		break;
	default:
		if(!isset($IN['formcwps'])) {
			$referer = "{$SYS_ENV['OAS_URL']}logout.php?formcwps=true&forward=".rawurlencode($forward);
			$Auth->logout($referer);
		} else {
			if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
				setcookie('OAS_COOKIE','',0,'/');
			} else {
				setcookie('OAS_COOKIE','',0,'/',$SYS_ENV['main_domain']);
			}
			
			header("Location:{$forward}");
		}
} 
?>