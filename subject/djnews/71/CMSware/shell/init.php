<?php
//$Id: init.php,v 1.1 2006/07/16 07:41:56 Administrator Exp $
define ('Error_Display','html');
set_magic_quotes_runtime(0);
define('SAFE_MODE', ini_get('safe_mode'));
if(!SAFE_MODE)	set_time_limit(0);

if(substr(phpversion(), 0 ,1) == 5) 	{ 
	define("PHP_VERSION_5", true); 
	@ini_set('zend.ze1_compatibility_mode', '1');// for PHP 5 compatibility
} else	define("PHP_VERSION_5", false);


define ('DEBUG_MODE', 2);
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

if(DIRECTORY_SEPARATOR == '/') {
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT_PATH', realpath(dirname(__FILE__).DS."..").DS);
	define("ADMIN_PATH", dirname(__FILE__).DS);
} else {
	define('DS', '/');
	define("ROOT_PATH", "../");
	define("ADMIN_PATH", "./");

}


define('INCLUDE_PATH', ROOT_PATH.'include'.DS);
define('PLUGIN_PATH', ROOT_PATH.'plugins'.DS);
define('KTPL_DIR', INCLUDE_PATH.'lib'.DS.'kTemplate'.DS);
define('LANG_PATH', ROOT_PATH.'language'.DS);
define('SYS_PATH', ROOT_PATH);
define('CACHE_DIR', ROOT_PATH.'sysdata'.DS);
define('KDB_DIR', INCLUDE_PATH.'lib'.DS.'kDB'.DS);
define('MODULES_DIR', ADMIN_PATH.'modules'.DS);
define('EDITORS_DIR', ADMIN_PATH.'editor'.DS);
define('ADMIN_DIR', ADMIN_PATH);
define('SETTING_DIR', ROOT_PATH.'setting'.DS);
define('CLS_PATH', ROOT_PATH .'classes'.DS);
define('LIB_PATH', INCLUDE_PATH.'lib'.DS);

define('IN_IWPC',true);
define('IN_SYS',true);

define('CMSWARE_VERSION', "CMSware 2.6.2 Plus");
define('BUILD_VERSION', "2.6.2.20060120");

$diableDebug = false;
$SYS_AUTH = array(
	'sys_login'=>0,
	'sys_logout'=>1,
	'sys_view'=>1,
	'sys_chpassword'=>0,
	'sys_chpassword_submit'=>0,
	'sys_setting'=>0,


);

$ContentModelReservedFieldName = array('IndexID','ContentID','NodeID','ParentIndexID','Type','PublishDate','Template',
'State','URL','Top','Pink','Sort','CreationDate','ModifiedDate','CreationUserID','LastModifiedUserID',
'ContributionUserID','ContributionID','ApprovedDate','TableID','ParentID','Name');

$_Error_vars = ''; //错误变量数组
$_DISPLAY_HELP = explode(' ', $_COOKIE['cmsware_collapse']);
require_once LIB_PATH."file.class.php";


function refreshNodeIndex($NodeID, &$publish, $pageRefresh = false, $Page = 1)
{
	global $SYS_ENV, $iWPC, $_LANG_ADMIN;
	
	$publish->NodeInfo = $iWPC->loadNodeInfo($NodeID);
	switch($publish->NodeInfo[PublishMode]) {
			case '0'://不发布
				return true;
				break;
			case '2'://动态发布
				$publish->refreshIndex($NodeID,'','');
				return true;
				break;
	}

	$tplname = $publish->NodeInfo[IndexTpl];
	$filename = $publish->NodeInfo[IndexName];
	$filename = str_replace('{NodeID}', $publish->NodeInfo['NodeID'], $filename);
	foreach($publish->NodeInfo as $key=>$var) {
		$filename = str_replace('{'.$key.'}', $var, $filename);
			
	}

	if(preg_match("/\{(.*)\}/isU", $filename, $match)) {
		eval("\$fun_string = $match[1];");
		$filename = str_replace($match[0], $fun_string, $filename);

	}

	$SYS_ENV[tpl_pagelist][filename] = $filename;

	if($pageRefresh) {
		$SYS_ENV[tpl_pagelist][page] = $Page;
		$SYS_ENV[tpl_pagelist][filename] = $filename;
		$filename = preg_replace("/\.([A-Za-z0-9]+)$/isU","_".$Page.".\\1",$filename);
			
		if($publish->refreshIndex($NodeID, $tplname, $filename )) { 
			if($SYS_ENV[tpl_pagelist][run] == 'yes') {
				output(sprintf($_LANG_ADMIN['admin_task_refreshIndex_continue'], $filename, $SYS_ENV[tpl_pagelist][page], $publish->NodeInfo[Name]));
				refreshNodeIndex($NodeID, $publish, true, $SYS_ENV[tpl_pagelist][page]);
				return true;				
			} else {
				output(sprintf($_LANG_ADMIN['admin_task_refreshIndex_finish'], $filename, $publish->NodeInfo[Name]));
				return true;	
			}
			
		} else {
			output(sprintf($_LANG_ADMIN['admin_task_refreshIndex_fail'], $filename, $publish->NodeInfo[Name]));
			return false;		
		}		
	} else {
		if($publish->refreshIndex($NodeID, $tplname, $filename)) { 
			if($SYS_ENV[tpl_pagelist][run] == 'yes') {
				output(sprintf($_LANG_ADMIN['admin_task_refreshIndex_start'], $filename,  $publish->NodeInfo[Name]));
				refreshNodeIndex($NodeID, $publish, true, $SYS_ENV[tpl_pagelist][page]);
				return true;
			} else {
				output(sprintf($_LANG_ADMIN['admin_task_refreshIndex_finish'], $filename, $publish->NodeInfo[Name]));
				return true;
			}

		} else {
			output(sprintf($_LANG_ADMIN['admin_task_refreshIndex_fail'], $filename, $publish->NodeInfo[Name]));
			return false;		
		}	
	}
}

function refreshNodeExtra($PublishID, $NodeID, &$extrapublish, $pageRefresh = false, $Page = 1)
{
	global $SYS_ENV, $iWPC, $_LANG_ADMIN;

	$NodeInfo = $iWPC->loadNodeInfo($NodeID);

	switch($NodeInfo[PublishMode]) {
		case '0'://不发布
		case '2'://动态发布
			return true;
			break;
	}
	$PublishInfo = $extrapublish->getInfo($PublishID);

	$filename = $PublishInfo[PublishFileName];
	$filename = str_replace('{NodeID}', $NodeInfo['NodeID'], $filename);
	$filename = str_replace('{PublishID}', $PublishInfo['PublishID'], $filename);

	if($pageRefresh) {
		$SYS_ENV[tpl_pagelist][filename] = $filename;
		$SYS_ENV[tpl_pagelist][page] = $Page;		
		if(preg_match("/\{Page\}/isU", $filename)) {
			$filename = str_replace("{Page}",$Page, $filename);
		} else {
			$filename = preg_replace("/\.([A-Za-z0-9]+)$/isU","_".$Page.".\\1",$filename);
		}		
		if($extrapublish->refresh($PublishInfo, $NodeInfo, $filename )) { 
			if($SYS_ENV[tpl_pagelist][run] == 'yes') {
				output(sprintf($_LANG_ADMIN['admin_task_refreshExtra_continue'],$PublishInfo['PublishName'], $filename, $SYS_ENV[tpl_pagelist][page], $NodeInfo[Name]));
				refreshNodeExtra($PublishID, $NodeID, $extrapublish, true, $SYS_ENV[tpl_pagelist][page]);
				return true;								
			} else {
				output(sprintf($_LANG_ADMIN['admin_task_refreshExtra_finished'],$PublishInfo['PublishName'], $filename,  $NodeInfo[Name]));
				return true;					
			}		
		} else {
			output(sprintf($_LANG_ADMIN['admin_task_refreshExtra_fail'],$PublishInfo['PublishName'], $filename,  $NodeInfo[Name]));		
			return false;
		
		
		}

	} else {
		if(preg_match("/\{Page\}/isU", $filename)) {
			$filename = str_replace("{Page}",'', $filename);
		} 
 		$SYS_ENV[tpl_pagelist][filename] = $filename;

		if($extrapublish->refresh($PublishInfo, $NodeInfo, $filename )) { 
			if($SYS_ENV[tpl_pagelist][run] == 'yes') {
				output(sprintf($_LANG_ADMIN['admin_task_refreshExtra_start'],$PublishInfo['PublishName'], $filename,  $NodeInfo[Name]));	
				refreshNodeExtra($PublishID, $NodeID, $extrapublish, true, $SYS_ENV[tpl_pagelist][page]);
				return true;					
			} else {
				output(sprintf($_LANG_ADMIN['admin_task_refreshExtra_finished'],$PublishInfo['PublishName'], $filename,  $NodeInfo[Name]));
				return true;					

			}
		}else {
			output(sprintf($_LANG_ADMIN['admin_task_refreshExtra_fail'],$PublishInfo['PublishName'], $filename,  $NodeInfo[Name]));		
			return false;
			
		}


		
	}
}

function refreshNodeContent($NodeID, &$publish , $content_num = 20)
{
	global $SYS_ENV, $iWPC, $_LANG_ADMIN;
	
	$publish->NodeInfo = $iWPC->loadNodeInfo($NodeID);
	$Page = 0 ;
	while(true) {
		$start= $Page*$content_num;
		$IndexIDs = $publish->getPublishLimit($NodeID, $start, $content_num);
		
		if(count($IndexIDs)==0) break;
		foreach($IndexIDs as $var) {
			ob_start();
			$publish->refresh($var[IndexID]);
			$contents = ob_get_contents();	 
			ob_end_clean();	
			output("[".$publish->NodeInfo['Name']."] ".$contents);
	
		}

		$Page++;
		sleep(1);
	
	}
}

function publishNodeContent($NodeID, &$publish , $content_num = 20)
{
	global $SYS_ENV, $iWPC, $_LANG_ADMIN;
	
	$publish->NodeInfo = $iWPC->loadNodeInfo($NodeID);
	$Page = 0 ;
	while(true) {
		$start= $Page*$content_num;
		$IndexIDs = $publish->getUnPublishLimit($NodeID, $start, $content_num);
		
		if(count($IndexIDs)==0) break;
		foreach($IndexIDs as $var) {
			ob_start();
			$publish->publish($var[IndexID]);
			$contents = ob_get_contents();	 
			ob_end_clean();	
			output("[".$publish->NodeInfo['Name']."] ".$contents);
	
		}

		$Page++;
		sleep(1);
	
	}
}

function output($_msg)
{
	$_msg = str_replace("<br>", "\n", $_msg);
	$_msg = preg_replace ("'<[\/\!]*?[^<>]*?>'si", "", $_msg);
	$_msg = str_replace("\n\n", "\n", $_msg);
	$_msg = str_replace("\r\n\r\n", "\n", $_msg);
	print($_msg."\n");
}
?>