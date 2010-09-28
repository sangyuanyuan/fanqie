<?php
/*
调用方法：
js.php?id=hot&nodeid=1&tplname=js.html
id:调用类型
	hot:最热文章（文章点击数排行）
	new:最新文章（文章发布日期排行）
Num:调用数量
TableID:内容模型ID
NodeID:调用对应节点的文章
Tpl:套用模板，有默认设置
*/
require_once 'init.php';

require_once "js.config.php";


function JsOutputFormat($str)
{
	$str = trim($str);
	$str = str_replace("\s\s", "\s", $str);
	$str = str_replace("\r", '', $str);
	$str = str_replace("\n", '', $str);
	$str = str_replace("\t", '', $str);
	$str = str_replace("\\", "\\\\", $str);  //反斜杠处理
	$str = str_replace("\"", "\\\"", $str);  //双引号处理
	//$str = addslashes($str);
	$str = str_replace("\'", "\\\'", $str);  //单引号处理
 	return $str;
}

require_once KTPL_DIR . 'kTemplate.class.php';

$TPL = new kTemplate();
$TPL->template_dir = SYS_PATH.'templates/';
$TPL->compile_dir = CACHE_DIR.'templates_c/';
$TPL->cache_dir = CACHE_DIR.'cache/';
$TPL->client_caching = false;		//不做缓存
$TPL->cache_lifetime = $cacheTime;

$id = empty($_GET['id'])? 'new' : $_GET['id'];
if(!array_key_exists($id, $templateKeys)) {
	die("document.write(\"Error! Invalid Template Key.\");");
} 

$cacheId = $id.intval($_GET['IndexID']).intval($_GET['ContentID']).intval($_GET['NodeID']).intval($_GET['TableID']);
$tplname = &$templateKeys[$id];
if($TPL->is_cached($tplname, $cacheId)) {
	echo "document.write(\"";
	$TPL->display_cache($tplname, $cacheId);
	echo "\");";

} else {
	if(isset($_GET['IndexID']))	$TPL->assign('IndexID', intval($_GET['IndexID']));
	if(isset($_GET['ContentID']))	$TPL->assign('ContentID', intval($_GET['ContentID']));
	if(isset($_GET['NodeID']))	$TPL->assign('NodeID', intval($_GET['NodeID']));
	if(isset($_GET['TableID']))	$TPL->assign('TableID', intval($_GET['TableID']));


	require_once INCLUDE_PATH."data.class.php";
	require_once INCLUDE_PATH."data.remote.class.php";
	require_once INCLUDE_PATH."functions.php";


 	require_once INCLUDE_PATH.'image.class.php';
	require_once INCLUDE_PATH."file.class.php";
	if (!extension_loaded('ftp')) {
		require_once INCLUDE_PATH."ftp.class.php";
	}
	require_once INCLUDE_PATH."Error.php";
	require_once INCLUDE_PATH."exception.class.php";
	require_once INCLUDE_PATH."admin/psn_admin.class.php";
	require_once INCLUDE_PATH."admin/dsn_admin.class.php";
	include_once SETTING_DIR."cms.ini.php";
//$db->setDebug(1);
	include_once(CACHE_DIR.'Cache_SYS_ENV.php');
	include_once(CACHE_DIR.'Cache_PSN.php');
	include_once(CACHE_DIR.'Cache_CateList.php');




	require(SYS_PATH.'license.php');
	$SYS_ENV['CMSware_Mark'] = "";
	
	require_once INCLUDE_PATH."admin/publishAdmin.class.php";
	require_once INCLUDE_PATH."admin/content_table_admin.class.php";
	require_once INCLUDE_PATH."admin/tplAdmin.class.php";
	require_once INCLUDE_PATH."admin/psn_admin.class.php";
	require_once INCLUDE_PATH."admin/site_admin.class.php";
	require_once INCLUDE_PATH."admin/dsn_admin.class.php";
	require_once INCLUDE_PATH."cms.class.php";
	require_once INCLUDE_PATH."cms.func.php";
 	require_once KDB_DIR.'kDB.php';
	if(!class_exists('TplVarsAdmin')) {
			require_once  INCLUDE_PATH.'admin/TplVarsAdmin.class.php';
	}

	
	require_once SYS_PATH."config.php";
	$db = new kDB($db_config['db_driver']);
	$db->connect($db_config);
	$db->setFetchMode('assoc');
	$db->setDebug($db_config['debug']);
	$db->setCacheDir(SYS_PATH.'sysdata/cache/');
	$iWPC = new iWPC();

 	$tpl_vars = TplVarsAdmin::getAll();
	foreach($tpl_vars as $key=>$var) {
		if($var['IsGlobal']) {//全局模板变量
			$TPL->assign($var['VarName'], $var['VarValue']);	
		} 
	}

	$TPL->registerPreFilter('CMS_Parser');
	$TPL->registerCacheFun('JsOutputFormat');
	echo "document.write(\"";
	$TPL->display_cache($tplname, $cacheId); 
	echo "\");";
	$db->close();
	
				
	

}

?>