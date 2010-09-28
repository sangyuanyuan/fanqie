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
 			//$auth->login();//��ת��CWPS���е�½
			$auth->isLoginCWPS();//�ж��Ƿ���CWPS��½

		} else if(!$auth->isLogin() && $auth->fromCWPS) { //CWPS����isLoginCWPS���õĽ��
			echo "��û�е�½";
		} else {
			$auth->ActiveCWPSSession($SYS_ENV['sessionActiveTime']);
			echo "<b>".$auth->session['UserName']."</b> is Logined<a href=?o=logout >logout</a>";
		}
		break;
	default:

		
		echo "<a href='?o=admin' >admin</a>";
		if($auth->isLogin()) {
			//����ActiveCWPSSession��ʱͬ��CWPS��session�Ựʱ��
			$auth->ActiveCWPSSession($SYS_ENV['sessionActiveTime']);
			echo $auth->session['UserName']."<a href=?o=logout >logout</a>";
		} 

		break;
}

			print_r($auth->session);

?>