<?php
//CWPS及OAS接口定义
$SYS_ENV['CWPS_URL'] = "http://demo.cmsware.com/28/cwps/";		//CWPS的URL，请勿忘记最后的斜框"/"
$SYS_ENV['OAS_URL']	= "http://demo.cmsware.com/28/oas/";		//OAS的URL，请勿忘记最后的斜框"/"
$SYS_ENV['CookiePre'] = "cmsware_passport_oas_";	//无须更改
$SYS_ENV['OASID']   =  "22";						//CWPS中的OAS管理中定义的用以处理本OAS的OASID
$SYS_ENV['TransactionAccessKey'] = "";		//CWPS设置的该OAS的CWPS访问密码
$SYS_ENV['TransferEncrypt'] = true;					//在数据传输过程中是否加密,默认加密，true|false
$SYS_ENV['ReqCharset'] = "utf8" ;					//发送请求时的编码utf8|gb2312|gbk
$SYS_ENV['RespCharset'] = "utf8";					//接收响应时的编码utf8|gb2312|gbk
define(OAS_PATH, dirname(__FILE__).'/');			//无须更改
$SYS_ENV['doLog']  = false;							//是否记录登陆日志，非win主机必须将./tmp目录设置为可写才可启用,true|false
$SYS_ENV['LogPath']  = OAS_PATH . 'tmp/';			//无须更改

//应用程序接口全局定义
$SYS_ENV['passport_key']    =  "";	//OAS与应用程序间设置的通行证密码
$SYS_ENV['main_domain']	=	".cmsware.com";				//登陆状态COOKIE作用的域名范围，一般设为你的主域，不要忘记前面的"."
$SYS_ENV['cookie_timeout'] = 0;					//COOKIE过期时间，一般设为15分钟，也即900秒比较合适,0为浏览器进程


//应用程序配置（可根据你的需要选择配置，如你没有相应的应用，可以不用管）
$SYS_ENV['discuz']    =  "http://discuz.cmsware.com/";		//定义DISCUZ的访问URL
$SYS_ENV['phpwind']    =  "http://phpwind.cmsware.com/";	//定义PHPWIND的访问URL
$SYS_ENV['vbb']    =  "http://vbb.cmsware.com/";	//定义vbb的访问URL
?>