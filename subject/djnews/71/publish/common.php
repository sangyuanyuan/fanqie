<?php
require_once 'init.php';
define ('Error_Display','html');
require_once ROOT_PATH."config.php";
require_once  ROOT_INCLUDE_PATH.'functions.php';
$debugger = new Debug();
$debugger->startTimer();

require_once( ROOT_INCLUDE_PATH.'data.class.php');
require_once INCLUDE_PATH."Error.php";
include_once SETTING_DIR."cms.ini.php";
include_once INCLUDE_PATH."cms.func.php";
include_once INCLUDE_PATH."cms.class.php";
include_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once KTPL_DIR . 'kTemplate.class.php';
require_once KDB_DIR.'kDB.php';
$db = new kDB($db_config['db_driver']);
$db->connect($db_config);
$db->setDebug($db_config['debug']);
$db->setFetchMode('assoc');
$db->setCacheDir(SYS_PATH.'sysdata/cache/');

new Error();

$SYS_CONFIG['language'] = empty($SYS_CONFIG['language']) ? 'chinese_gb' : $SYS_CONFIG['language'];
require_once LANG_PATH.$SYS_CONFIG['language'].'/charset.inc.php';
//$db->setCharset(CHARSET); //support Mysql4.x

 
$IN = parse_incoming();
$iWPC = new iWPC();

if(!$IN[referer]) 
	$referer =  _addslashes($_SERVER[HTTP_REFERER]);
else 
	$referer = $IN[referer];



$TPL = new kTemplate();
$TPL->template_dir = SYS_PATH.'templates'.DS;
$TPL->compile_dir = CACHE_DIR.'templates_c'.DS;
$TPL->cache_dir = CACHE_DIR.'cache/';
$TPL->assign_by_ref('referer', $referer);
$TPL->assign('URL_SELF', 'http://'.$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF']);
$TPL->assign('cmsware_version', VERSION);
$TPL->assign('cms_version', VERSION);

require(ROOT_PATH.'license.php');
$license_array = $License;
unset($License);

include_once(CACHE_DIR.'Cache_SYS_ENV.php');
include_once(CACHE_DIR.'Cache_CateList.php');
include_once(CACHE_DIR.'Cache_ContentModel.php');
$TPL->assign_by_ref('SYS_ENV', $SYS_ENV);
$TPL->assign_by_ref('NODE_LIST', $NODE_LIST);
$TPL->assign_by_ref('CONTENT_MODEL_INFO', $CONTENT_MODEL_INFO);


$SYS_ENV['language'] = $SYS_CONFIG['language'];



$SYS_ENV['CMSware_Mark'] = str_replace('{date}', date('Y-m-d H:i:s', time()), $license_array['Publish-Marker']);
$SYS_ENV['CMSware_Mark'] = str_replace('{version}', CMSWARE_VERSION, $SYS_ENV['CMSware_Mark']);

if(empty($SYS_ENV['CMSware_Mark']) || !strpos($SYS_ENV['CMSware_Mark'], CMSWARE_VERSION) ) {
	$TPL->add_meta_mark = false;
}


if(!class_exists('TplVarsAdmin')) {
			require_once  ROOT_INCLUDE_PATH.'admin/TplVarsAdmin.class.php';
}
$tpl_vars = TplVarsAdmin::getAll();
foreach($tpl_vars as $key=>$var) {
	if($var['IsGlobal']) {//全局模板变量
		$TPL->assign($var['VarName'], $var['VarValue']);	
	} 
}

///////////////


 
?>