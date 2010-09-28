<?php
if(!defined("IN_SHELL")) exit("Access Denied.");

require_once 'init.php';

require_once LIB_PATH."Spring.php";
$_BeanFactory = new Spring("spring.appcontext.php");

$BeanFactory = &$_BeanFactory;

require_once INCLUDE_PATH."session.class.php";
require_once INCLUDE_PATH."data.class.php";
require_once INCLUDE_PATH."functions.php";
require_once SYS_PATH."config.php";
if ($SYS_DEBUG) {
	$debugger = new Debug();
	$debugger->startTimer();
}

require_once KTPL_DIR . 'kTemplate.class.php';
require_once INCLUDE_PATH."file.class.php";
if (!extension_loaded('ftp')) {
	require_once INCLUDE_PATH."ftp.class.php";
}
require_once INCLUDE_PATH."Error.php";
require_once INCLUDE_PATH."admin/auth.class.php";
require_once INCLUDE_PATH."admin/cache.class.php";
require_once SETTING_DIR."global.php";

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
if(!file_exists(CACHE_DIR.'Cache_SYS_ENV.php') || !file_exists(CACHE_DIR.'Cache_ContentModel.php')) {
	$cache = new CacheData();
	$cache->makeCache('sys');
	$cache->makeCache('psn');
	$cache->makeCache('catelist');	
	$cache->makeCache('content_model');	
} 
include_once(CACHE_DIR.'Cache_SYS_ENV.php');
include_once(CACHE_DIR.'Cache_PSN.php');
include_once(CACHE_DIR.'Cache_CateList.php');
include_once(CACHE_DIR.'Cache_ContentModel.php');
$SYS_ENV['language'] = $SYS_CONFIG['language'];

if($SYS_ENV['isLogAdmin'] == 1 || $SYS_ENV['isLogLogin'] == 1 ) {
	require_once INCLUDE_PATH."admin/logAdmin.class.php";
}

$TPL = new kTemplate();
$TPL->template_dir = SYS_PATH.'skin/admin/';
$TPL->compile_dir = SYS_PATH.'sysdata/templates_c/';
$TPL->cache_dir = SYS_PATH.'sysdata/cache/';
$TPL->lang_dir = LANG_PATH.$SYS_CONFIG['language'].'/lang_skin/admin/';


$TPL->compile_lang = true;
$TPL->global_lang_name = LANG_PATH.$SYS_CONFIG['language'].'/lang_skin_global.php';

$TPL->assign('iwpc_version', CMSWARE_VERSION);
$TPL->assign('cmsware_version', CMSWARE_VERSION);
$TPL->assign('cms_version', CMSWARE_VERSION);
$TPL->assign('EnableLoginValidCode', $EnableLoginValidCode);
$TPL->assign('BUILD_VERSION', BUILD_VERSION);
$TPL->assign_by_ref('SYS_ENV', $SYS_ENV);
$TPL->assign_by_ref('NODE_LIST', $NODE_LIST);
$TPL->assign_by_ref('CONTENT_MODEL_INFO', $CONTENT_MODEL_INFO);




//echo $referer;

//print_r($in);
$message = $_LANG_ADMIN["{$IN['message']}"];
$base_url = $_SERVER["PHP_SELF"]."?sId=".$IN['sId']."&";
$TPL->assign('base_url', $base_url);
$TPL->assign('referer', $referer);
$TPL->assign('sId', $IN['sId']);
$TPL->assign_by_ref('IN', $IN);

$TPL->assign('session', $sys->session);

//debug($sys->Auth);
//print_r($sys->session);

require(ROOT_PATH.'license.php');
$License['Module-Collection'] = 1 ;
$License['Module-Contribution'] = 1 ;
$License['Module-FileManager'] = 1 ;
$License['Module-PublishAuth'] = 1 ;
$License['Module-DataImport'] = 1 ;
$License['Module-bbsInterface'] = 1 ;
$License['Module-FullText'] = 1 ;

$license_array = $License;

$TPL->assign('LicenseInfo', $license_array);
unset($License);
	
$SYS_ENV['CMSware_Mark'] = str_replace('{date}', date('Y-m-d H:i:s', time()), $license_array['Publish-Marker']);
$SYS_ENV['CMSware_Mark'] = str_replace('{version}', CMSWARE_VERSION, $SYS_ENV['CMSware_Mark']);
if(empty($SYS_ENV['CMSware_Mark']) || !strpos($SYS_ENV['CMSware_Mark'], CMSWARE_VERSION) ) {
	$TPL->add_meta_mark = false;
}
$SYS_ENV['CMSware_Powered'] = $license_array['Publish-Title-Marker'];

require_once LANG_PATH.$SYS_CONFIG['language'].'/lang_admin.php';
require_once LANG_PATH.$SYS_CONFIG['language'].'/lang_sys.php';
$TPL->assign('charset', CHARSET);


new Error();

//Error::addVar('ni', '啊');
//Error::addVar('distFile','b');
//Error::raiseError('imagejpeg_failure', E_USER_WARNING);


if(!empty($IN['message'])) $TPL->assign('message',$_LANG_ADMIN[$IN['message']]);

if(!empty($IN['error_message'])) $TPL->assign('error_message',$_LANG_ADMIN[$IN['error_message']]);


?>