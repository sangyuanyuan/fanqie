<?php
require_once '../validate.php';
/*if(time() > 2093708800)
	die("CMSware Trial version have expired, please visit <a href='http://www.cmsware.com'>http://www.cmsware.com</a> to learn more!");
*/

set_magic_quotes_runtime(0);
set_time_limit(5000);
define ('DEBUG_MODE', 2);
define('CMSWARE_VERSION', "CMSware 2.6.2 Plus");
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

$phpVersion = substr(phpversion(), 0 ,1);

if($phpVersion == 5) 	define("PHP_VERSION_5", true);
else	define("PHP_VERSION_5", false);


define('DS', '/');
define("ROOT_PATH", "../");
define("ADMIN_PATH", "./");

define('INCLUDE_PATH','../include/');
define('KTPL_DIR', INCLUDE_PATH.'lib/kTemplate/');
define('IN_IWPC',true);
define('IN_SYS',true);
define('IN_CMSWARE',true);
define('SYS_PATH', '../');
define('LANG_PATH', '../language/');
define('MODULES_DIR', './modules/');
define('CACHE_DIR','../sysdata/');
define('KDB_DIR',INCLUDE_PATH.'lib/kDB/');
define('SETTING_DIR','../setting/');
define('LIB_PATH', INCLUDE_PATH.'lib/');
define('CLS_PATH', ROOT_PATH .'classes'.DS);

require_once LIB_PATH."file.class.php";

require_once INCLUDE_PATH."session.class.php";
require_once INCLUDE_PATH."data.class.php";
require_once INCLUDE_PATH."functions.php";
require_once SYS_PATH."config.php";
define ('Error_Display', $SYS_CONFIG['error_reporting']);
if ($SYS_DEBUG) {
	$debugger = new Debug();
	$debugger->startTimer();
}

require_once KTPL_DIR . 'kTemplate.class.php';
require_once INCLUDE_PATH.'image.class.php';
require_once INCLUDE_PATH."file.class.php";
require_once INCLUDE_PATH."Error.php";
require_once INCLUDE_PATH."admin/auth.class.php";
require_once INCLUDE_PATH."admin/publishAuthAdmin.class.php";
require_once INCLUDE_PATH."exception.class.php";
require_once INCLUDE_PATH."admin/cache.class.php";
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."admin/plugin.class.php";
require_once SETTING_DIR."global.php";
//require_once LANG_PATH."$lang_admin.php";
require_once KDB_DIR.'kDB.php';
$db = new kDB($db_config['db_driver']);
$db->connect($db_config);
$db->setDebug($db_config['debug']);
$db->setFetchMode('assoc');
$db->setCacheDir(SYS_PATH.'sysdata/cache/');

$SYS_CONFIG['language'] = empty($SYS_CONFIG['language']) ? 'chinese_gb' : $SYS_CONFIG['language'];
require_once LANG_PATH.$SYS_CONFIG['language'].'/charset.inc.php';
//$db->setCharset(CHARSET); //support Mysql4.x

//from ipb
$IN = parse_incoming();

$iWPC = new iWPC();

if(!file_exists(CACHE_DIR.'Cache_SYS_ENV.php')) {
	$cache = new CacheData();
	$cache->makeCache('sys');
	$cache->makeCache('psn');
	$cache->makeCache('catelist');	
	

} 
include_once(CACHE_DIR.'Cache_SYS_ENV.php');
include_once(CACHE_DIR.'Cache_PSN.php');
include_once(CACHE_DIR.'Cache_CateList.php');
include_once(CACHE_DIR.'Cache_ContentModel.php');
define('PLUGIN_PATH', '../plugins/'.$IN['plugin'].'/');
if(!is_dir(PLUGIN_PATH.'language/'.$SYS_CONFIG['language'])) {
	define('PLUGIN_LANG_PATH', PLUGIN_PATH.'language/default/');
} else {
	define('PLUGIN_LANG_PATH', PLUGIN_PATH.'language/'.$SYS_CONFIG['language'].'/');

}

$SYS_ENV['language'] = $SYS_CONFIG['language'];

$TPL = new kTemplate();

if(!$IN[referer]) 
	$referer =  _addslashes($_SERVER['HTTP_REFERER']);
else  {
	if(strpos($IN[referer], "index.php?o=sys::login")) {
		$referer = _addslashes($_SERVER['HTTP_REFERER']);
	} else $referer = $IN[referer];
}
	

$params = array(
	'sId'=>$IN['sId'],
	'sIp'=>$IN['IP_ADDRESS'],
);
$sys = new Auth($params);
if (!$sys->isLogin()) {
	$TPL->template_dir = SYS_PATH.'skin/admin/';
	$TPL->lang_dir = LANG_PATH.$SYS_CONFIG['language'].'/lang_skin/admin/';
	$TPL->display("login.html");
	exit;

}
include_once PLUGIN_LANG_PATH.'lang_admin.php';
include_once PLUGIN_LANG_PATH.'lang_sys.php';

$Plugin = new Plugin();
if(!$Plugin->canAccess($IN['plugin'])) {
//	goback('access_deny');
}

$TPL->template_dir = PLUGIN_PATH.'templates/';
$TPL->compile_dir = SYS_PATH.'sysdata/templates_c/';
$TPL->cache_dir = SYS_PATH.'sysdata/cache/';


$TPL->lang_dir = PLUGIN_LANG_PATH.'/lang_skin/';

$TPL->compile_lang = true;
$TPL->assign('iwpc_version', CMSWARE_VERSION);
$TPL->assign('cms_version', CMSWARE_VERSION);
$TPL->global_lang_name = LANG_PATH.$SYS_CONFIG['language'].'/lang_skin_global.php';



//print_r($in);


 


header('Content-Type: text/html; charset='.CHARSET);
$TPL->assign('charset', CHARSET);


new Error();

if($IN['plugin'] == "base") {
	$IN['o'] = empty($IN['o']) ? "admin_base::commentSearchAdmin" : $IN['o'];
} else $IN['o'] = empty($IN['o']) ? "index" : $IN['o'];

 
//print_r($sys->session);
$base_url = "plugins.php?sId={$IN['sId']}&plugin=".$IN['plugin'].'&';
$TPL->assign('base_url', $base_url);
$TPL->assign('Auth', $sys->Auth);
$TPL->assign('sId', $sys->session['sId']);
$TPL->assign('Auth', $sys->session['sGAuthData']);
$TPL->assign('LicenseInfo', $LicenseInfo);
$TPL->assign('plugin_path', PLUGIN_PATH);
$TPL->assign('referer', $referer);
 list($module, $action) = explode('::',$IN['o']);
$_DISPLAY_HELP = explode(' ', $_COOKIE['cmsware_collapse']);

require_once LIB_PATH."Spring.php";
$BeanFactory = new Spring("spring.appcontext.php");


require PLUGIN_PATH."plugin.config.php";
require PLUGIN_PATH.$module.".php";

?>