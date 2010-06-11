<?php
require_once "common.php";
$UserInfo = include_once("{$PUBLISH_CONFIG['OAS_PATH']}/getuserinfo.php");

require_once SYS_PATH."plugins/base/plugin.config.php";
require_once "contribution.lang.php";
require_once INCLUDE_PATH."user/contribution_admin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
require_once INCLUDE_PATH."admin/auth.class.php";
require_once INCLUDE_PATH."file.class.php";
require_once INCLUDE_PATH."admin/plugin.class.php";
require_once INCLUDE_PATH."admin/publishAdmin.class.php";

define("PLUGIN_PATH", SYS_PATH."plugins/");
$Plugin = new Plugin();


$IN['TableID'] = empty($IN['TableID']) ? 1 : $IN['TableID'];

$TPL->template_dir = $TPL->template_dir."/plugins/contribution/";


if($IN['o'] == 'do') {
	if(!isset($UserInfo['UserName'])) {
		goback("contribution_nologin");
	}
	
	require_once INCLUDE_PATH."cms.class.php";
	require_once INCLUDE_PATH."cms.func.php";
	require_once SETTING_DIR ."cms.ini.php";

	$fieldInfo = content_table_admin::getTableFieldsInfo($IN[TableID]);			
	$contribution = new contributionUser();
	$contribution->flushData();
 
	foreach($fieldInfo as $key=>$var) {
				if(empty($var['EnableContribution'])) continue;
				$field = 'data_'.$var[FieldName];
				if(is_array($IN[$field])) {
					foreach($IN[$field] as $keyIn=>$varIn) {
						if($keyIn == 0)
							$value = $varIn;
						else
							$value .= ';'.$varIn;
					}
				}  else $value = $IN[$field];

				if($IN['HTML']==1) $contribution->addData($var[FieldName],$value);
				else $contribution->addData($var[FieldName], nl2br(htmlspecialchars($value)));
				
	}
	$time = time();
 	$contribution->addData('ContributionDate', time());
	$contribution->addData('State', 1);
	$contribution->addData('NodeID', $IN[TargetNodeID]);
	$contribution->addData('CreationDate', $time);
	$contribution->addData('ModifiedDate', $time);
	$contribution->addData('OwnerID', 0); //匿名用户
	$TableInfo['TableID'] = $IN['TableID'];
	//$contribution->debugData();
	if($contribution->add($TableInfo)) {			
		showMsg($_LANG_ADMIN['contribution_add_ok'],$referer,3);			
	}else
		goback($_LANG_ADMIN['contribution_add_fail']);



} else {
	if(empty($IN['Tpl'])) {
		$templateName = 'contribution_'.$IN['TableID'].".html";
		if(!file_exists($TPL->template_dir . $templateDir . $templateName)) {
			$templateName = 'default.html';
		}
	} else $templateName = $IN['Tpl'];

	
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




	require(SYS_PATH.'license.php');
	$license_array = $License;
	unset($License);
	
	/*
	if($license_array['Disable-Marker']!=1) {
		$SYS_ENV['CMSware_Mark'] = "<!-- Published at ".date('Y-m-d H:i:s', time()).", Powered by ".CMSWARE_VERSION." -->\n";
	}
	*/




	require_once INCLUDE_PATH."admin/publishAdmin.class.php";
	require_once INCLUDE_PATH."admin/content_table_admin.class.php";
	require_once INCLUDE_PATH."admin/tplAdmin.class.php";
	require_once INCLUDE_PATH."admin/psn_admin.class.php";
	require_once INCLUDE_PATH."admin/site_admin.class.php";
	require_once INCLUDE_PATH."cms.class.php";
	require_once INCLUDE_PATH."cms.func.php";
	
	$TPL->assign('UserInfo',$UserInfo);
	$TPL->assign('SelfURL',"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); 
	$TPL->assign('NODE_LIST', $NODE_LIST);
	$TPL->registerPreFilter('CMS_Parser');
	$TPL->assign('TableID', $IN['TableID']);
	$TPL->display($templateName);

}

include('debug.php');




?>