<?php
include_once "oas.config.php";
include_once "functions.php";
parse_str(passport_decrypt($_COOKIE['OAS_COOKIE'],$SYS_ENV['passport_key']),$oasmember);
if(empty($oasmember)) {
	return false;
} else {
	$SYS_ENV['cookie_timeout'] = $SYS_ENV['cookie_timeout'] < 1 ? 0 : time()+$SYS_ENV['cookie_timeout'];
	if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
		setcookie('OAS_COOKIE',$_COOKIE['OAS_COOKIE'],$SYS_ENV['cookie_timeout'],'/');
	} else {
		setcookie('OAS_COOKIE',$_COOKIE['OAS_COOKIE'],$SYS_ENV['cookie_timeout'],'/',$SYS_ENV['main_domain']);
	}
	return $oasmember;
}
?>