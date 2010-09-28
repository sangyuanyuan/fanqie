<?php
error_reporting(E_ALL ^ E_NOTICE);
define('IN_SYS', true);
set_magic_quotes_runtime(0);

define("ROOT_PATH", dirname(__FILE__) . "/");
define('INCLUDE_PATH', ROOT_PATH .'include/');

require_once 'oas.config.php';
require_once INCLUDE_PATH . 'functions.php';
require_once INCLUDE_PATH . 'SoapOAS.class.php';
require_once INCLUDE_PATH . 'Auth.php';


//init Input Data
$IN = parse_incoming();

$auth = new Auth();
$auth->init();



switch($IN['o']) {
	case 'logout':
		$auth->logout($SYS_ENV['sys_url']);
		break;
	case 'admin':
		if(!$auth->isLogin() && !$auth->fromCWPS) {
 			//$auth->login();//跳转到CWPS进行登陆
			$auth->isLoginCWPS();//判断是否在CWPS登陆

		} else if(!$auth->isLogin() && $auth->fromCWPS) { //CWPS返回isLoginCWPS调用的结果
			echo "你没有登陆";
		} else {
			$auth->ActiveCWPSSession($SYS_ENV['sessionActiveTime']);
			echo "<b>".$auth->session['UserName']."</b> is Logined<a href=?o=logout >logout</a>";
		}
		break;
	default:

		
		echo "<a href='?o=admin' >admin</a>";
		if($auth->isLogin()) {
			//调用ActiveCWPSSession定时同步CWPS的session会话时间
			$auth->ActiveCWPSSession($SYS_ENV['sessionActiveTime']);
			echo $auth->session['UserName']."<a href=?o=logout >logout</a>";
		} 

		break;
}

			print_r($auth->session);

?>