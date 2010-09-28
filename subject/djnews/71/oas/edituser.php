<?php
session_start();
define('IN_SYS', true);
set_magic_quotes_runtime(0);

require_once("oas.config.php");
$referer = rawurlencode($_SERVER['HTTP_REFERER']);
$changePass = "{$SYS_ENV['CWPS_URL']}index.php?do=changePass&OASID={$SYS_ENV['OASID']}&referer=OAS::{$referer}";
$editProfile = "{$SYS_ENV['CWPS_URL']}index.php?do=editProfile&OASID={$SYS_ENV['OASID']}&referer=OAS::{$referer}";

if ($_REQUEST['do']=='changePass') {
	header("Location: " . $changePass);  //跳转到CWPS的修改密码页
} elseif ($_REQUEST['do']=='editProfile') {
	header("Location: " . $editProfile);  //跳转到CWPS的修改资料页
} else {
	header("Location: " . $referer);  //如果没给do参数,直接跳回上次页面
}
?>