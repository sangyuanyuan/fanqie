<?php
/******************* WEB API 配置文件 **********************/

$API_CONFIG['password'] = "12345";      //API访问密码

$API_CONFIG['enable_ip_access'] = true; //启用IP验证

$API_CONFIG['access_ip'] = array(       //允许访问API的IP地址
	'127.0.0.1',
	'192.168.1.1',
	'192.168.1.0',
);
?>