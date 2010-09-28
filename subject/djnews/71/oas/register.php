<?php
require_once("oas.init.php");
$action = "register";
$app_url	= (isset($IN['app']) && isset($SYS_ENV["{$IN['app']}"]))?$SYS_ENV["{$IN['app']}"]:$SYS_ENV['CWPS_URL'];
$forward = (empty($IN['forward']))?$app_url:$IN['forward'];

$referer = "{$SYS_ENV['OAS_URL']}login.php?app={$IN['app']}&formcwps=true&forward=".rawurlencode($forward);
$Auth->register($referer);
	
?>