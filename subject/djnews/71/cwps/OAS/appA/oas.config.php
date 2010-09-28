<?php
//页面访问接口定义
$PageInterface['Login'] = "http://passport/index.php";
$PageInterface['IsLogin'] = "http://passport/index.php?do=isLogin";
$PageInterface['Logout'] = "http://passport/index.php?do=logout";
$SYS_ENV['CookiePre'] = "cmsware_passport_oas_";
$SYS_ENV['CWPS_Address'] = "http://passport/soap.php"; //CWPS地址
$SYS_ENV['TransactionAccessKey'] = "d6d06739ab77c69b7d1d76a2f15421cf"; //CWPS访问密码
$SYS_ENV['sys_url']  = "http://passport/oas/appB";
$SYS_ENV['sessionActiveTime']  = 1800; //半小时同步一次CWPS的session会话时间

?>