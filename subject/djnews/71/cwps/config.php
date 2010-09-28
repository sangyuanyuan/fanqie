<?php

$db_config['db_driver']   = 'db';	//db,adodb,mdb
$db_config['db_type']     = 'mysql';

$db_config['db_host']     = '172.27.203.80';      //数据库主机	
$db_config['db_user']     = 'root';      //数据库用户名	
$db_config['db_password'] = 'xunao';  //数据库用户密码	
$db_config['db_name']     = 'smg_new';      //数据库名		
$db_config['table_pre']   = 'cmsware_cwps_'; //CMS表名前缀	
$db_config['db_charset']   = 'utf8'; //数据库字符集 latin1,utf8,utf8...



$SYS_ENV['enable_admin_validcode'] = 0; //是否开启管理登陆图形验证码. 1-开启,0-关闭
$SYS_ENV['enable_validcode'] = 1; //是否开启普通登陆图形验证码. 1-开启,0-关闭
$SYS_ENV['sys_url']  = "172.27.203.81:8080/subject/djnews/71/cwps";
$SYS_ENV['html_url'] = "172.27.203.81:8080/subject/djnews/71/cwps/html";
$SYS_ENV['base_dir'] = "E:\\smg2.0\\subject\\djnews\\71\\cwps";
$SYS_ENV['sys_name'] = "CWPS网站通行证系统";
$SYS_ENV['errorReports']['switch'] = true; //是否开启报错机制
$SYS_ENV['errorReports']['mode'] = 2 ; //报错模式,0-Bug-Free,1-ReleaseCandidate,2-Alpha,3-Testing, other selfDefineErrorHandler
$SYS_ENV['errorReports']['log'] = false; //是否记录错误日志
$SYS_ENV['errorReports']['displayMode'] = 'html'; //自定义报错显示模式html,js,text
$SYS_ENV['language'] = "utf8-zh";
$SYS_ENV['enable_gzip'] = 1;
$SYS_ENV['enable_debug'] = 1;

$SYS_ENV['passport']['CheckIP'] = 1;                 // Session检测IP
$SYS_ENV['passport']['OnlineHold'] = 3600;           // 在线保持时间
$SYS_ENV['passport']['CookiePre'] = 'cms_passport_'; // Cookie前缀
$SYS_ENV['passport']['CookiePath'] = '/';            // cookie 作用路径 (如出现登录问题请修改此项)
$SYS_ENV['passport']['CookieDomain'] = '';           // cookie 作用域 (如出现登录问题请修改此项)

$SYS_ENV['passport']['AdminSessionHold'] = 3600;           // 管理员会话保持时间
$SYS_ENV['user']['registerDefaultGroupID'] = 3; //注册用户默认的组,3-一般用户
$SYS_ENV['admin']['AllowLoginIP'] = ""; //后台admin.php允许登录IP限制，多个IP使用逗号“,”分隔，留空则不限制IP


//====================
// 邮件发送设置
//====================
$SYS_ENV['Mail']['Mode'] = "SMTP"; //SMTP,mail
$SYS_ENV['Mail']['SMTP_Host'] = "smtp.163.com"; //SMTP服务器
$SYS_ENV['Mail']['SMTP_Auth'] = true; //SMTP是否需要验证
$SYS_ENV['Mail']['SMTP_Username'] = "cmsware" ; //SMTP帐号
$SYS_ENV['Mail']['SMTP_Password'] = "123456" ;//SMTP密码
$SYS_ENV['Mail']['From'] =  "cwps@cmsware.com"; //Email发送源地址
$SYS_ENV['Mail']['FromName'] = "CWPS Service";//Email发送人
$SYS_ENV['Mail']['Reply'] = "cwps@cmsware.com"; //Email回复地址
$SYS_ENV['Mail']['ReplyName'] = "CWPS Service"; //Email回复人
$SYS_ENV['Mail']['CopyMode'] = 0 ; //0-不抄送, 1-密送, 2-抄送
$SYS_ENV['Mail']['CopyTo'] = array("test@163.com","test@cmsware.com");//抄送地址



class table {
 
	function table()
	{
		global $db_config;

		$this->user = $db_config['table_pre'].'user';
		$this->sessions = $db_config['table_pre'].'sessions';
		$this->group = $db_config['table_pre'].'group';
		$this->admin_sessions = $db_config['table_pre'].'admin_sessions';
		$this->user_extra = $db_config['table_pre'].'user_extra';
		$this->user_fields = $db_config['table_pre'].'user_fields';
		
		$this->oas = $db_config['table_pre'].'oas';
		$this->role = $db_config['table_pre'].'role';
		$this->resource = $db_config['table_pre'].'resource';
		$this->privilege = $db_config['table_pre'].'privilege';
		$this->operator = $db_config['table_pre'].'operator';
		$this->soap = $db_config['table_pre'].'soap';

	}


}

$table=new table();

?>