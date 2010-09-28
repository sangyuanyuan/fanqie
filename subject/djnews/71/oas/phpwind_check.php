<?php
if(basename($_SERVER['PHP_SELF']) != "passport_client.php") {
	include_once "oas.config.php";
	include_once "functions.php";
	$forward = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	parse_str(passport_decrypt($_COOKIE['OAS_COOKIE'],$SYS_ENV['passport_key']),$oasmember);

	if($oasmember['UserName']) {
		if($oasmember['UserName'] != $windid) {
			header("location:{$SYS_ENV['OAS_URL']}login.php?app=phpwind&forward=".rawurlencode($forward));
			exit;
		}
		$SYS_ENV['cookie_timeout'] = $SYS_ENV['cookie_timeout'] < 1 ? 0 : time()+$SYS_ENV['cookie_timeout'];
		if(strtolower($SYS_ENV['main_domain'])=='localhost' or empty($SYS_ENV['main_domain'])) {
			setcookie('OAS_COOKIE',$_COOKIE['OAS_COOKIE'],$SYS_ENV['cookie_timeout'],'/');
		} else {
			setcookie('OAS_COOKIE',$_COOKIE['OAS_COOKIE'],$SYS_ENV['cookie_timeout'],'/',$SYS_ENV['main_domain']);
		}
	} else {
		if($windid) {
			header("location:{$SYS_ENV['OAS_URL']}logout.php?app=phpwind&formcwps=true&forward=".rawurlencode($forward));
			exit;
		}
	}
}
?>