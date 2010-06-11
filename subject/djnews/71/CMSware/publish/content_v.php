<?php
require_once "common.php";
$UserInfo = include_once("{$PUBLISH_CONFIG['OAS_PATH']}/getuserinfo.php");

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
    list($IN['id'], $IN['page'], $IN['Custom1'], $IN['Custom2'], $IN['Custom3'], $IN['Custom4'], $IN['Custom5']) = explode(',', $PATH_INFO);

} else {

	$IN['id'] = intval($IN['id']); //处理id为整型	Modify by easyT, 2007.1.9, 修正原来这里写成NodeID的错误，会引发iis按参数调用时不对
	$IN['page']   = intval($IN['page']);  //处理页号为整型
//	$IN['Custom1']   = intval($IN['Custom1']);  //自定义传入变量1到5
//	$IN['Custom2']   = intval($IN['Custom2']);
//	$IN['Custom3']   = intval($IN['Custom3']);
//	$IN['Custom4']   = intval($IN['Custom4']);
//	$IN['Custom5']   = intval($IN['Custom5']);

}



$IndexID = &$IN['id'];
$Page = empty($IN['page']) ? 0 : $IN['page'];
$result = $db->getRow("SELECT NodeID,SelfTemplate FROM $table->content_index WHERE IndexID=$IndexID");
if(empty($result['NodeID'])) {
	die('Invalid IndexID');
} else {
	$NodeInfo = $iWPC->loadNodeInfo($result['NodeID']);
	$table_content = $db_config['table_pre'].$db_config['table_publish_pre'].'_'.$NodeInfo['TableID'];
	$NodeID = &$NodeInfo['NodeID'];
}


if(!$NodeInfo) {
	die('NodeID is InValid');
}
if(_BBS_INTERFACE) {
	if(!$Access->canAccess($NodeID,'ReadContent')) {//验证首页访问权限
		$TPL->assign('deny_code', $Access->deny_code);
		$TPL->display($PLUGIN_SETTING['DenyTpl']);
		exit;
	} 

}

//echo 'NodeID:'.$NodeID;
//echo '<br>IndexID:'.$IndexID;

$NoCache = true;
//$TPL->client_caching = true;
if (!isset($NoCache))
	$NoCache = false;	//如果没有设置不要缓存变量，就默认为fasle
$TPL->caching = !$NoCache;		//是否需要缓存
$TPL->cache_lifetime = &$CONTENT_SETTING['cache_time'];;

 
	if(!empty($result[SelfTemplate])) {
		$tplname =  $result[SelfTemplate];
		
		if(!file_exists($TPL->template_dir.$result[SelfTemplate])) {
			new Error("Error: The content template {$TPL->template_dir}{$result[Template]} you have set alone for your content does not exists, system now use the default template \"{$SYS_ENV[templatePath]}/default/content.html\" to run.");
			$tplname = 'content.html';
			$TPL->template_dir =  $TPL->template_dir.'/default/';		
		}
	
	} elseif(!empty($NodeInfo[ContentTpl])) {
		$tplname =  $NodeInfo[ContentTpl];
		
		if(!file_exists($TPL->template_dir.$NodeInfo[ContentTpl])) {
			new Error("Error: The content template {$TPL->template_dir}{$NodeInfo[ContentTpl]} does not exists, system now use the default template \"{$SYS_ENV[templatePath]}/default/content.html\" to run.");
			$tplname = 'content.html';
			$TPL->template_dir = $TPL->template_dir.'/default/';		
		}

	} else {	
		new Error("Warning: You haven\'t set the content template, system now use the default template \"{$SYS_ENV[templatePath]}/default/content.html\" to run.");
		$tplname = 'content.html';
		$TPL->template_dir =  $TPL->template_dir.'/default/';

	}				


//缓存的文件ID用传入参数变量做识别
$cacheId = $IndexID.$Page.$IN['Custom1'].$IN['Custom2'].$IN['Custom3'].$IN['Custom4'].$IN['Custom5'].$tplname;

if($TPL->caching and $TPL->is_cached($tplname, $cacheId)) {
	 
	$TPL->run_cache($tplname, $cacheId);

} else {
	require_once INCLUDE_PATH."data.class.php";
	require_once INCLUDE_PATH."data.remote.class.php";
	//require_once INCLUDE_PATH."functions.php";
	require_once SYS_PATH."config.php";


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
	require_once KDB_DIR.'kDB.php';
	$db = new kDB($db_config['db_driver']);
	$db->connect($db_config);
//$db->setDebug(1);
	include_once(CACHE_DIR.'Cache_SYS_ENV.php');
	include_once(CACHE_DIR.'Cache_PSN.php');
	include_once(CACHE_DIR.'Cache_CateList.php');
	include_once(CACHE_DIR.'Cache_ContentModel.php');




 




	require_once INCLUDE_PATH."admin/publishAdmin.class.php";
	require_once INCLUDE_PATH."admin/content_table_admin.class.php";
	require_once INCLUDE_PATH."admin/tplAdmin.class.php";
	require_once INCLUDE_PATH."admin/psn_admin.class.php";
	require_once INCLUDE_PATH."admin/site_admin.class.php";
	require_once INCLUDE_PATH."cms.class.php";
	require_once INCLUDE_PATH."cms.func.php";

	$publish = new publishAdmin();


	$NodeInfo = $iWPC->loadNodeInfo($NodeID);
	$publishInfo= $publish->getPublishInfo($IndexID);
	//print_r($publishInfo);
	$publish->IndexID = $IndexID;
	$publish->NodeInfo = &$NodeInfo;
	$publish->publishInfo = $publishInfo;
	 
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

 
 
	
		
		$TPL->registerPreFilter('CMS_Parser');
		include(SETTING_DIR.'dcontent.ini.php');

		$PublishFileFormat = $NodeInfo['ContentPortalURL'];
		foreach($filenameFormatMap as $key=>$var) {
			$PublishFileFormat = str_replace($key,$var, $PublishFileFormat);
		}
	 
		foreach($publishInfo as $key=>$var) {
			//$publishInfo[$key] = $publish->ReplaceKeywords($publishInfo[$key]);
			
 			//$publish->resourcePublish($var);
			//$publish->htmlPhotoPublish($var);
			//$publish->psnPublish($var);
			$TPL->assign($key, $var);
		}
		
		//Add by easyT, 2007.1.9, 为动态发布内容页入口增加列表分页功能，按index.php首页入口格式增加系统$Page变量，在动态发布的内容页里就可以用CMS_LIST的分页功能了，同样用IndexPage()来获取分页链接
		$SYS_ENV[tpl_pagelist][page] = $Page;
		$SYS_ENV[tpl_pagelist][filename] = $NodeInfo['ContentPortalURL'];
		//Add by easyT, 2007.1.9, end

		$TPL->assign('Publish', $publishInfo);
		$TPL->assign('Navigation', $Navigation);
		$TPL->assign('sysRelateDoc', $RelateDoc);
		$TPL->assign('NodeInfo', $NodeInfo);
					$TPL->assign('Custom1', $IN['Custom1']);    //自定义传入变量1
					$TPL->assign('Custom2', $IN['Custom2']); 
					$TPL->assign('Custom3', $IN['Custom3']); 
					$TPL->assign('Custom4', $IN['Custom4']); 
					$TPL->assign('Custom5', $IN['Custom5']);
					$TPL->assign('UserInfo',$UserInfo);
					$TPL->assign('SelfURL',"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
					

		$TPL->registerPreFilter('CMS_Parser');
		if (preg_match_all($patt, $publishInfo[$mainContentLabel], $match)) {
				$contentArray = preg_split($patt, $publishInfo[$mainContentLabel]);

				if($contentArray[0] == "") {
					$contentArray = array_slice ($contentArray, 1); 
					
					$pagenum=count($contentArray);
					$pagenum_pre = $pagenum;
					$totalnum=$pagenum;
					$pagenum--;
					$pagenum_pre--;
					$hawking = 1;
				} else {
					$pagenum=count($contentArray);
					$pagenum_pre = $pagenum;
					$totalnum=$pagenum;
					$pagenum--;
					$pagenum_pre--;
					$hawking = 0;
				}

				do { 

					eval ("\$publishFileName = \"$PublishFileFormat\";");
					$publishFileName = str_replace("{Page}" , $pagenum_pre , $publishFileName);
					if ($hawking==1) {
						
						$pageNav[] = array(
							'Title' => $match[1][$pagenum_pre],
							'URL' => $publishFileName,
							'Link' => $publishFileName,
						);
					} else {
						if($match[1][$pagenum_pre-1] == '')
							$match[1][$pagenum_pre-1]= $IndexPageTitle;
						$pageNav[] = array(
							'Title' => $match[1][$pagenum_pre-1],
							'URL' => $publishFileName,
							'Link' => $publishFileName,
						);
					}
				} while($pagenum_pre--);
				
				$pageNav = array_reverse ($pageNav);


					eval ("\$publishFileName = \"$PublishFileFormat\";");
					$pagelist =  DynamicPublish::Page($totalnum-1,$Page+1,$publishFileName) ;
					
					$TPL->assign($mainContentLabel,$contentArray[$Page]);
					if($hawking == 1)
						$TPL->assign($_pageTitle,$match[1][$Page]);
					else
						$TPL->assign($_pageTitle,$match[1][$Page-1]);
					$TPL->assign($_pageList,$pagelist);
					$TPL->assign($_pageNav, $pageNav);

					$pageInfo[PageNum] = $pagenum;
					$pageInfo[Page] = $Page;
					$TPL->assign('PageInfo', $pageInfo);

				
				
			}else {
				//echo 'aaaaaaaaaa';
				$TPL->assign($mainContentLabel,$publishInfo[$mainContentLabel]);
	
			}
 
		if ($TPL->caching) {
			$TPL->run_cache($tplname, $cacheId); //如果需要缓存输出
		} else {
			$TPL->display($tplname); //不需要缓存输出
		}

	

}
include('debug.php');
?>