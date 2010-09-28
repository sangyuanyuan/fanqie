<?php
define ('DEBUG_MODE','2');
define ('Error_Display','html');
set_magic_quotes_runtime(0);
define('SAFE_MODE', ini_get('safe_mode'));

if(!SAFE_MODE)	set_time_limit(20);

if(substr(phpversion(), 0 ,1) == 5) 	{ 
	define("PHP_VERSION_5", true); 
	@ini_set('zend.ze1_compatibility_mode', '1');// for PHP 5 compatibility
} else	define("PHP_VERSION_5", false);



switch(DEBUG_MODE){
	case 0: //Bug-Free
		error_reporting(0);break;
	case 1: //Release-Candidate
		error_reporting(E_ERROR | E_WARNING | E_PARSE);break;
	case 2: //Alpha/Beta
		error_reporting(E_ALL ^ E_NOTICE);break;
	case 3: //Testing
		error_reporting(E_ALL);break;
	default: //If User Meddles With Debug_Mode
		error_reporting(E_ALL ^ E_NOTICE);break;
}
define('DS', '/');

define("ROOT_PATH", "../");
define("ADMIN_PATH", "./");

include_once("config.user.php");	//add by easyT, 2007.8.22

define('INCLUDE_PATH',ROOT_PATH.'include/');
define('PLUGIN_PATH', ROOT_PATH.'plugins/');
define('KTPL_DIR', INCLUDE_PATH.'lib/kTemplate/');
define('LANG_PATH', ROOT_PATH.'language/');
define('IN_IWPC',true);
define('IN_SYS',true);
define('SYS_PATH', '../');
define('CACHE_DIR', ROOT_PATH.'sysdata/');
define('KDB_DIR',INCLUDE_PATH.'lib/kDB/');
define('MODULES_DIR','./modules/');
define('ADMIN_DIR','./');
define('SETTING_DIR', ROOT_PATH.'setting/');
define('CLS_PATH', ROOT_PATH .'classes'.DS);
define('LIB_PATH', INCLUDE_PATH.'lib'.DS);
$diableDebug = false;
$SYS_AUTH = array(
	'sys_login'=>0,
	'sys_logout'=>1,
	'sys_view'=>1,
	'sys_chpassword'=>0,
	'sys_chpassword_submit'=>0,
	'sys_setting'=>0,


);
require_once SETTING_DIR."global.php";

require_once LIB_PATH."file.class.php";

?>