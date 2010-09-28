<?php
if ($in['mode']=='phpinfo') {
	phpinfo();
	exit;
}
if($loginUserInfo[loginGroupName]==$SYS_ENV[adminGroup]) {
			$TPL->assign('catelist',$CATE_MENU);
}else {
			$manageCId=explode(':',$loginUserInfo[loginManageCId]);
			foreach ($manageCId as $var) {
				if($cId == $var ) {
					$catelist.="<OPTION value=$var >".$CATE_INFO[$var][cNameTree]."</OPTION>";
				} else  {
					$catelist.="<OPTION value=$var >".$CATE_INFO[$var][cNameTree]."</OPTION>";
				}
				
			
			}
			$TPL->assign('catelist',$catelist);
}
$TPL->assign('phpversion',phpversion());
$TPL->assign('mysqlversion',mysql_get_server_info());
$TPL->assign('zendversion',zend_version());
$TPL->assign('upload_max_filesize',get_cfg_var('upload_max_filesize'));

$version = explode('.', mysql_get_server_info()); 
if ($version[0] < 4) $TPL->assign('mysql4', 0);
else $TPL->assign('mysql4', 1);
 
include(LANG_PATH.$SYS_CONFIG['language'].'/lang_skin_global.php');

if (extension_loaded('ftp')) 
	$ftp = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
else
	$ftp ="<FONT  COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";

if (extension_loaded('gd')) {
	$gd = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
	$gd_info = gd_info();
	$info['version'] = $gd_info["GD Version"];
	if ($gd_info["FreeType Support"]) $info['FreeType'] = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
	else $info['FreeType'] = "<FONT  COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";

	if ($gd_info["T1Lib Support"]) $info['T1Lib'] = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
	else $info['T1Lib'] = "<FONT  COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";

	if ($gd_info["GIF Read Support"]) $info['GIFRead'] = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
	else $info['GIFRead'] = "<FONT  COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";

	if ($gd_info["GIF Create Support"]) $info['GIFCreate'] = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
	else $info['GIFCreate'] = "<FONT  COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";

	if ($gd_info["JPG Support"]) $info['JPG'] = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
	else $info['JPG'] = "<FONT  COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";

	if ($gd_info["PNG Support"]) $info['PNG'] = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
	else $info['PNG'] = "<FONT  COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";

	if ($gd_info["WBMP Support"]) $info['WBMP'] = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
	else $info['WBMP'] = "<FONT  COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";

	if ($gd_info["XBM Support"]) $info['XBM'] = "<FONT size=1 COLOR=#009900>{$_LANG_SKIN_GLOBAL[state_true]}</FONT>";
	else $info['XBM'] = "<FONT  COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";
	$TPL->assign('gd_info',$info);
} else
	$gd ="<FONT COLOR=#FF0000>{$_LANG_SKIN_GLOBAL[state_false]}</FONT>";



$result = $db->getRow("SELECT count(*) as nr FROM $table->site  WHERE  Disabled=0");
$TPL->assign('node_used',$result[nr]);

$result = $db->getRow("SELECT count(*) as nr FROM $table->content_table");
$TPL->assign('content_model_used',$result[nr]);

$i=0;
$allPsn = psn_admin::getAllPSN();
foreach($allPsn as $key=>$var) {
		$psnInfo = psn_admin::parsePSN($var['PSN']);
		if($psnInfo[publish_type] == 'ftp')
			$i++;
		else
			continue;
}
$TPL->assign('remote_psn_used',$i);

if(file_exists("../install.php"))	$TPL->assign('install_exists',1);

if(file_exists("../update.php"))	$TPL->assign('update_exists',1);

//if(!is_writable(ROOT_PATH."config.php")) $unwriteable[] = "/config.php";
if(!is_writable(ROOT_PATH."setting/cms.ini.php")) $unwriteable[] = "/setting/cms.ini.php";
if(!is_writable(ROOT_PATH."setting/crawler.ini.php")) $unwriteable[] = "/setting/crawler.ini.php";
if(!is_writable(ROOT_PATH."backup")) $unwriteable[] = "/backup/";
if(!is_writable(ROOT_PATH."resource")) $unwriteable[] = "/resource/";
if(!is_writable(ROOT_PATH."sysdata")) $unwriteable[] = "/sysdata/";
if(!is_writable(ROOT_PATH."sysdata/automini")) $unwriteable[] = "/sysdata/automini/";
if(!is_writable(ROOT_PATH."sysdata/cache")) $unwriteable[] = "/sysdata/cache/";
if(!is_writable(ROOT_PATH."sysdata/sysinfo")) $unwriteable[] = "/sysdata/sysinfo/";
if(!is_writable(ROOT_PATH."sysdata/templates_c")) $unwriteable[] = "/sysdata/templates_c/";
if(!is_writable(ROOT_PATH."sysdata/tmp")) $unwriteable[] = "/sysdata/tmp/";
if(!is_writable(ROOT_PATH."publish/tmp") && is_dir(ROOT_PATH."publish/tmp")) $unwriteable[] = "/publish/tmp/";


if(file_exists("../version.php")) {
	include_once("../version.php");
	if(!empty($_PatchVersion))	{
		$TPL->assign('patch_version', ", patch".$_PatchVersion);
		$TPL->assign('patch_version2', $_PatchVersion);
	}

}

$TPL->assign_by_ref('unwriteable', $unwriteable);
$TPL->assign('ftp',$ftp);
$TPL->assign('gd',$gd);
$TPL->assign('ftp_mode', $SYS_CONFIG['ftp_mode']);
$TPL->assign('db_charset', $db_config['db_charset']);

$TPL->display('DM_right.html');

?>
