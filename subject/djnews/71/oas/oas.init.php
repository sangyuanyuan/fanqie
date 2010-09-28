<?php
session_start();
define('IN_SYS', true);
set_magic_quotes_runtime(0);

require_once("oas.config.php");

$PageInterface['Login'] = "{$SYS_ENV['CWPS_URL']}index.php?OASID={$SYS_ENV['OASID']}";
$PageInterface['IsLogin'] = "{$SYS_ENV['CWPS_URL']}index.php?do=isLogin&OASID={$SYS_ENV['OASID']}";
$PageInterface['Logout'] = "{$SYS_ENV['CWPS_URL']}index.php?do=logout&OASID={$SYS_ENV['OASID']}";
$PageInterface['Register'] = "{$SYS_ENV['CWPS_URL']}index.php?do=register&OASID={$SYS_ENV['OASID']}";
$SYS_ENV['CWPS_Address'] = "{$SYS_ENV['CWPS_URL']}soap.php";

$SYS_ENV['cookie_timeout'] = $SYS_ENV['cookie_timeout'] < 1 ? 0 : time()+$SYS_ENV['cookie_timeout'];

require_once("Auth.php");
require_once("SoapOAS.class.php");
require_once("functions.php");
$IN = oas_parse_incoming();
$Auth = new oas2cwpsAuth();

/**********************************************
Modify by 技术幻想(AT)(QQ13937123) 2007.06.24
**********************************************/
?>