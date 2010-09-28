<?php 
require_once INCLUDE_PATH."admin/logAdmin.class.php";
session_save_path("../sysdata");

if(!defined('IN_IWPC')) {
 	exit('Access Denied');
}

if(file_exists("../version.php")) {
	include_once("../version.php");
	$TPL->assign('patch_version', $_PatchVersion);
 			
}

function callRemoter($Path)
{
	return null;
	global $LicenseInfo,$db,$db_config,$table,$_PatchVersion;

	$Host = "www.cmsware.org";
	//$Path = "/update/version.php";
	$Port = 80;

 
	$XMLData  = "<Request>\r\n";
	$XMLData .= "<version>".BUILD_VERSION."</version>\r\n";
	$XMLData .= "<patch>".$_PatchVersion."</patch>\r\n";
	$XMLData .= "<URL>{$LicenseInfo['Registered-URL']}</URL>\r\n";
	$XMLData .= "<Key>{$LicenseInfo['License-key']}</Key>\r\n";
	$XMLData .= "<TransactionTime>".date("Y-m-d H:i:s")."</TransactionTime>\r\n";
	$XMLData .= "</Request>";

	$Request  = "POST $Path HTTP/1.0\r\n";
	$Request .= "Host: $Host \r\n";
	$Request .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$Request .= "Content-Length: ".strlen($XMLData)."\r\n\r\n";
	$Request .= $XMLData;
	//echo $Request;
	$result="";
	$f = @fsockopen($Host, $Port, $errno, $errstr, 2);
	if ($f) {
		@fputs($f,$Request);
		stream_set_timeout($f, 5);
		while (!feof($f)) $Response .= @fread($f,128);

		fclose($f);
	}

		
	$pattern = "/<Response>(.*)<\/Response>/isU";
	
	if(preg_match($pattern, $Response,$matches)) {
		$return = base64_decode($matches[1]);
	}
	 
	return $return;

}


switch($action) {
	case 'login':
		if($sys->isBanned()) {
			$TPL->assign('error_message', $_LANG_ADMIN['ip_block']);
			$TPL->display("login.html");
			exit;
	
		}

		if($SYS_CONFIG['enable_validcode']){
			session_start();
			if(isset($_SESSION['LoginTryCount'])) { //第N登陆，尝试计数器开始计数
				if(time() - $_SESSION['LoginTryTime'] > $SYS_ENV['LoginTryTime']*60) {//登陆间隔时间已过，登陆尝试数置0
					$_SESSION['LoginTryCount'] = 1;
					$_SESSION['LoginTryTime'] = time();
			
				} else { 
					$_SESSION['LoginTryCount'] ++; //计数器++
					if($_SESSION['LoginTryCount'] >= $SYS_ENV['LoginTryCount']) {//登陆尝试超过规定次数，屏蔽IP
						$sys->addBlockIP($IN['IP_ADDRESS']);
					}
				}
			} else {//第一次登陆，初始化尝试计数器
				$_SESSION['LoginTryCount'] = 1;
				$_SESSION['LoginTryTime'] = time();
			}



			if(empty($_SESSION['sessionValid'])) { //如果没有通过validCode.php注册$_SESSION['sessionValid']
				$TPL->assign('error_message', sprintf($_LANG_ADMIN['validCode_error_hacker'], $SYS_ENV['LoginTryCount'] - $_SESSION['LoginTryCount']));
				$TPL->display("login.html");
				exit;
			} elseif(!function_exists('ImagePNG')) { //或者GD库未安装，则自动跳过验证码验证
				
			} elseif($IN['validCode'] == $_SESSION['ValidateCode']) { //验证码输入正确
				
			} else {//验证码不正确，提示
				$TPL->assign('error_message',sprintf($_LANG_ADMIN['validCode_error'],$SYS_ENV['LoginTryCount'] - $_SESSION['LoginTryCount']));
				$TPL->display("login.html");
				exit;
					
			}
	
		}
	
 		$logAdmin = new logAdmin();


		if($sys->login($IN[username],$IN[password],$IN['IpSecurity'])) {

			//if($SYS_ENV['isLogLogin'] == 1 ) {//登陆日志记录
			$logAdmin->addLoginLog($IN['username'], $IN['IP_ADDRESS'], true);
			//}
			unset($_SESSION['LoginTryCount']);
			$TPL->assign('base_url', "index.php?sId={$sys->sId}&");
			$TPL->assign('sId', $sys->sId);
			$TPL->display("panel_frameset.html");
		} elseif(isset($IN[username]) || isset($IN[password])) {
			$TPL->assign('error_message', sprintf($_LANG_ADMIN['username_error'],$SYS_ENV['LoginTryCount'] - $_SESSION['LoginTryCount']));
			$TPL->display("login.html");
			$logAdmin->addLoginLog($IN['username'], $IN['IP_ADDRESS'], false);
		} else {
 			$TPL->display("login.html");
			$logAdmin->addLoginLog($IN['username'], $IN['IP_ADDRESS'], false);
		
		}

		break;
	case 'logout':
		if($sys->logout())
			$TPL->display("logout.html");

		break;
	case 'view':



		$TPL->assign('session', $sys->session);

		switch($IN[extra]) {
			case 'header':
				require_once INCLUDE_PATH.'admin/plugins_admin.class.php';
				$plugins = new PluginsAdmin();
				$pluginsList = $plugins->getAll();
				$TPL->assign('pluginsList', $pluginsList);
				$TPL->assign('pluginsMenuLength', 21 * ( count($pluginsList) + 1 ) -1);

				$TPL->display("panel_header.html");
				break;
			case 'box':
				$TPL->display("panel_box.html");
				break;
			case 'initMultiThread':
				$diableDebug = true;

				$TPL->display("panel_MultiThread.html");
				break;
			case 'taskInfo':
				$TPL->display("panel_taskInfo.html");
				break;
			case 'menu':
				header("Location:admin_tree.php?sId={$IN['sId']}&o=publish");
				//$TPL->display("panel_admin_sys.html");
				break;
			case 'admin_sys':
				$TPL->display("panel_admin_sys.html");
				break;
			case 'workarea':
				$TPL->assign_by_ref('NODE_LIST', $NODE_LIST); 
				include MODULES_DIR.'DM_right.php';
				break;
			case 'phpinfo':
				if(!$sys->isAdmin()) {
					goback('access_deny_module_setting');

				}

				phpinfo();
				exit;
				break;

			default:
				$TPL->display("panel_frameset.html");

		}
		break;


	case 'chpassword':
		$TPL->display("chpassword.html");
		break;
	case 'chpassword_submit':
		break;

		if( $password!='') {
			if($newpassword != $newpassword2) {
				//password not match
				$TPL->assign('error_message',$SYS_ERROR['sys_chpassword_password_not_match']);			
				$TPL->display("chpassword.html");
			} else {
				if($sys->chpassword($password, $newpassword)) {
					$TPL->assign('error_message',$SYS_ERROR['sys_chpassword_ok']);
					
				} else {
					$TPL->assign('error_message',$SYS_ERROR['sys_chpassword_fail']);
				
				}

				$TPL->display("chpassword.html");
			}
		} else {
			$TPL->assign('error_message',$SYS_ERROR['sys_chpassword_password_null']);			
			$TPL->display("chpassword.html");
		
		}

		break;
	case "version";
		exit(callRemoter("/update/version.php?o=version"));
		 
		break;
	case "detect_news";
		exit(callRemoter("/update/version.php?o=detect_news"));
		break;
	default:
		$TPL->display("login.html");

}

	

?>