<?php
require_once "common.php";

if(_BBS_INTERFACE) {
	define('PLUGINS_PATH', ROOT_PATH.'plugins/'.PLUGIN.'/');
	require_once PLUGINS_PATH.'include/access.class.php';
	require_once PLUGINS_PATH.'plugin.config.php';
	$Access =  new Access(BBS_NAME);
	require_once(PLUGINS_PATH.'include/setting.class.php');
	$PLUGIN_SETTING = PluginSetting::getInfo();
	$TPL->assign('Member', $Access->bbs->session);

}


//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//header("Expires: " .gmdate ("D, d M Y H:i:s", time() + 3600 * 24 * 30). " GMT");

//处理路径变量或是用URL的Get方式传入参数，同时允许传入五个自定义变量在模板中使用
if ( !empty($_SERVER["PATH_INFO"]) && strrpos($_SERVER["PATH_INFO"],'php?')===false ) { //Modify by easyT 07.11.23,修正了判断Pathinfo支持的方法更准确

    $PATH_INFO=substr($_SERVER["PATH_INFO"],1,strrpos($_SERVER["PATH_INFO"],'.')-1);
    list($IN['nodeid'], $IN['page'], $IN['Custom1'], $IN['Custom2'], $IN['Custom3'], $IN['Custom4'], $IN['Custom5']) = explode(',', $PATH_INFO);

} else {

	$IN['nodeid'] = intval($IN['nodeid']); //处理nodeid为整型
	$IN['page']   = intval($IN['page']);  //处理页号为整型
//	$IN['Custom1']   = intval($IN['Custom1']);  //自定义传入变量1到5
//	$IN['Custom2']   = intval($IN['Custom2']);
//	$IN['Custom3']   = intval($IN['Custom3']);
//	$IN['Custom4']   = intval($IN['Custom4']);
//	$IN['Custom5']   = intval($IN['Custom5']);

}


if(empty($IN['nodeid'])) {
//转入默认首页
	die('NodeID empty');
} else {
	$NodeID = &$IN['nodeid'];
	$IN['NodeID'] = &$IN['nodeid'];
}

$Page = empty($IN['page']) ? 0 : $IN['page'];

$NodeInfo = $iWPC->loadNodeInfo($NodeID);

if(!$NodeInfo) {
	die('NodeID is InValid');
}
//echo 'NodeID:'.$NodeID;
//echo '<br>IndexID:'.$IndexID;

if(_BBS_INTERFACE) {
	if(!$Access->canAccess($NodeID,'ReadIndex')) {//验证首页访问权限
	$TPL->assign('deny_code', $Access->deny_code);
	$TPL->display($PLUGIN_SETTING['DenyTpl']);
	exit;
	} 
}

//$TPL->client_caching = true;
//print_r($Access->bbs->session);
if (!isset($NoCache))
	$NoCache = true;	//如果没有设置不要缓存变量，就默认为fasle
$TPL->caching = !$NoCache;		//是否需要缓存
$TPL->cache_lifetime = &$INDEX_SETTING['cache_time'];

$tplname = &$NodeInfo['IndexTpl'];

//缓存的文件ID用传入参数变量做识别
$cacheId = $NodeID.$Page.$IN['Custom1'].$IN['Custom2'].$IN['Custom3'].$IN['Custom4'].$IN['Custom5'].$tplname;

if($TPL->caching and $TPL->is_cached($tplname, $cacheId)) {
	$TPL->run_cache($tplname, $cacheId);

} else {
	require_once INCLUDE_PATH."data.class.php";
	require_once INCLUDE_PATH."data.remote.class.php";
	//require_once INCLUDE_PATH."functions.php";


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
//$db->setDebug(1);
	include_once(CACHE_DIR.'Cache_SYS_ENV.php');
	include_once(CACHE_DIR.'Cache_PSN.php');
	include_once(CACHE_DIR.'Cache_CateList.php');


 


	require_once INCLUDE_PATH."admin/publishAdmin.class.php";
	require_once INCLUDE_PATH."admin/content_table_admin.class.php";
	require_once INCLUDE_PATH."admin/tplAdmin.class.php";
	require_once INCLUDE_PATH."admin/psn_admin.class.php";
	require_once INCLUDE_PATH."admin/site_admin.class.php";
	require_once INCLUDE_PATH."cms.class.php";
	require_once INCLUDE_PATH."cms.func.php";


	$SYS_ENV[tpl_pagelist][page] = $Page;
	$SYS_ENV[tpl_pagelist][filename] = $NodeInfo['IndexPortalURL'];


	$NodeInfo = $iWPC->loadNodeInfo($NodeID);
	$TPL->assign('NodeInfo', $NodeInfo);
					$TPL->assign('Custom1', $IN['Custom1']);  //自定义传入变量1
					$TPL->assign('Custom2', $IN['Custom2']); 
					$TPL->assign('Custom3', $IN['Custom3']); 
					$TPL->assign('Custom4', $IN['Custom4']); 
					$TPL->assign('Custom5', $IN['Custom5']); 

 		foreach($tpl_vars as $key=>$var) {//模板变量赋值

				if($var['IsGlobal'] == 1) continue;
				elseif(preg_match("/,".$NodeInfo['NodeID']."/isU", $var['NodeScope'])) {//单个结点匹配
					$TPL->assign($var['VarName'], $var['VarValue']);	
				} else {
					foreach(explode('%', $NodeInfo['ParentNodeID']) as $varIn) {
						if(preg_match("/all-".$varIn."/isU", $var['NodeScope'])) { //包含子结点模式匹配
							$TPL->assign($var['VarName'], $var['VarValue']);	
						}
					}
				}
		 

 		}

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

	if ($TPL->caching) {
		$TPL->run_cache($tplname, $cacheId); //如果需要缓存输出
	} else {
		$TPL->display($tplname); //不需要缓存输出
	}
	
				
	

}
include('debug.php');
?>