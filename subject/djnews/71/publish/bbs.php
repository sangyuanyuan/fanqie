<?php
require_once "common.php";

if(_BBS_INTERFACE) {
	define('PLUGINS_PATH', '../plugins/'.PLUGIN.'/');
	require_once PLUGINS_PATH.'include/access.class.php';
	require_once PLUGINS_PATH.'plugin.config.php';
	$Access =  new Access(BBS_NAME);
	require_once(PLUGINS_PATH.'include/setting.class.php');
	$PLUGIN_SETTING = PluginSetting::getInfo();
	$TPL->assign('Member', $Access->bbs->session);
}

if ( !strpos($_SERVER["REQUEST_URI"], "?")   ) { //当没有
if ( strpos($_SERVER["SERVER_SOFTWARE"], "IIS")   ) { //Apache,http://www.cmsware.com/member/index.php/6,2.html
$IN['nodeid'] = intval($IN['nodeid']);
$IN['tid']   = intval($IN['tid']);
} else {
    $PATH_INFO=substr($_SERVER["PATH_INFO"],1,strrpos($_SERVER["PATH_INFO"],'.')-1);
    list($IN['nodeid'], $IN['tid']) = explode(',', $PATH_INFO);
}
}

if(empty($IN['nodeid'])) {
	die('NodeID empty');
} else {
	$NodeID = &$IN['nodeid'];
	$IN['NodeID'] = &$IN['nodeid'];
}

if(empty($IN['tid'])) {
	die('tid empty');
} else {
	$tid = &$IN['tid'];
	$IN['tid'] = &$IN['tid'];
}

$NodeInfo = $iWPC->loadNodeInfo($NodeID);

if(!$NodeInfo) {
	die('NodeID is InValid');
}

if(_BBS_INTERFACE) {
	if(!$Access->canAccess($NodeID,'ReadIndex')) {//验证首页访问权限
	$TPL->assign('deny_code', $Access->deny_code);
	$TPL->display($PLUGIN_SETTING['DenyTpl']);
	exit;
	} 
}

$TPL->caching = true;
$TPL->cache_lifetime = &$INDEX_SETTING['cache_time'];

$tplname = &$NodeInfo['ContentTpl'];

$cacheId = $NodeID.$tid.$tplname;

if($TPL->is_cached($tplname, $cacheId)) {
	$TPL->run_cache($tplname, $cacheId);

} else {
	require_once INCLUDE_PATH."data.class.php";
	require_once INCLUDE_PATH."data.remote.class.php";


	require_once KTPL_DIR . 'kTemplate.class.php';
	require_once INCLUDE_PATH.'image.class.php';
	require_once INCLUDE_PATH."file.class.php";
	if (!extension_loaded('ftp')) {
		require_once INCLUDE_PATH."ftp.class.php";
	}
	require_once INCLUDE_PATH."Error.php";
	require_once INCLUDE_PATH."exception.class.php";
	require_once INCLUDE_PATH."admin/psn_admin.class.php";
	include_once SETTING_DIR."cms.ini.php";
	include_once(CACHE_DIR.'Cache_SYS_ENV.php');
	include_once(CACHE_DIR.'Cache_PSN.php');
	include_once(CACHE_DIR.'Cache_CateList.php');




	}




	require_once INCLUDE_PATH."admin/publishAdmin.class.php";
	require_once INCLUDE_PATH."admin/content_table_admin.class.php";
	require_once INCLUDE_PATH."admin/tplAdmin.class.php";
	require_once INCLUDE_PATH."admin/psn_admin.class.php";
	require_once INCLUDE_PATH."admin/site_admin.class.php";
	require_once INCLUDE_PATH."cms.class.php";
	require_once INCLUDE_PATH."cms.func.php";


	$NodeInfo = $iWPC->loadNodeInfo($NodeID);
	$TPL->assign('Navigation', $Navigation);
	$TPL->assign('NodeInfo', $NodeInfo);
	$TPL->assign('tid', $tid);
	if(!empty( $tplname)) {
			
			if(!file_exists($TPL->template_dir. $tplname)) {
				new Error("Error: The index template  \'{$TPL->template_dir}{ $tplname}\' does not exits, Please Set it First to run.");
				return false;
			}

	} else {
			new Error("Error: You have not set the index template, Please Set it First.");
			return false;
		
	} 





	$TPL->registerPreFilter('CMS_Parser');
	$TPL->run_cache($tplname, $cacheId); 
	
				
	

include('debug.php');
?>
