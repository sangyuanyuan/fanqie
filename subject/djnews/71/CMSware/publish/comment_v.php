<?php
require_once "common.php";
$UserInfo = include_once("{$PUBLISH_CONFIG['OAS_PATH']}/getuserinfo.php");

require_once ROOT_PATH."plugins/base/plugin.config.php";
require_once "comment.lang.php";
session_save_path("./tmp");


//$IN['nodeid'] = intval($IN['nodeid']);
$IN['page']   = intval($IN['page']);
$Page = empty($IN['Page']) ? 1 : $IN['Page'];

if(empty($IN['id']) && empty($IN['IndexID']) && empty($IN['Id'])) {
	die('IndexID empty');
} else {
	$IndexID = $Id = empty($IN['id']) ? (empty($IN['IndexID']) ? intval($IN['Id']) : intval($IN['IndexID'])) : intval($IN['id']);
}
$table_count =  &$plugin_table['base']['count'];
$table_comment =  &$plugin_table['base']['comment'];

$result = $db->getRow("SELECT NodeID FROM $table_count WHERE IndexID=$IndexID");
if(empty($result['NodeID'])) {
	die('Invalid IndexID');
} else {
	$NodeInfo = $iWPC->loadNodeInfo($result['NodeID']);
	$table_content = $db_config['table_pre'].$db_config['table_publish_pre'].'_'.$NodeInfo['TableID'];
	$NodeID = &$NodeInfo['NodeID'];
}

$Setting = $db->getRow("SELECT * FROM {$plugin_table['base']['setting']}  WHERE TableID={$NodeInfo['TableID']}");

if(preg_match("/\{TID:([0-9]+)\}/isU", $Setting['CommentTpl'], $matches)) { 
	require_once INCLUDE_PATH."admin/cate_tpl_admin.class.php";
	if(!isset($cate_tpl)) {
	 	$cate_tpl = new cate_tpl_admin();
 		$TID = $matches[1];
		$TInfo = $cate_tpl->getInfo($TID);
		$Setting['CommentTpl']="/ROOT/".$TInfo[TCID]."/".$TInfo[TID].".tpl";
			
	}
		
}

if(empty($Setting['TableID'])) {
	die($_LANG_ADMIN['please_setting']);
}

$tpl= &$Setting['CommentTpl'];
$TPL->assign('TableID', $NodeInfo['TableID']);
$TPL->assign_by_ref('NodeInfo', $NodeInfo);
$TPL->assign('UserInfo',$UserInfo);
$TPL->assign('SelfURL',"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

if($IN['o'] == 'post') {
	if(!isset($UserInfo['UserName'])) {
		goback("comment.nologin");
	} else {
		$IN['username'] = $UserInfo['UserName'];
	}
}


switch($Setting['CommentMode']) {
	case '0': //匿名模式
		include_once 'include/comment_anonymous.php';
 		break;
	case '1'://会员接口权限模式
		include_once 'include/comment_bbsInterface.php';
		break;
}

include('debug.php');




?>