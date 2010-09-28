<?php

$db_config['db_driver']   = 'db';	              //db,adodb,mdb
$db_config['db_type']     = 'mysql';                  //mysql,mssql,oracle
$db_config['db_host']     = '172.27.203.80';      //数据库主机	
$db_config['db_user']     = 'root';      //数据库用户名	
$db_config['db_password'] = 'xunao';  //数据库用户密码	
$db_config['db_name']     = 'smg_new';      //数据库名		
$db_config['table_pre']   = 'cmsware_'; //CMS表名前缀	
$db_config['db_charset']   = 'utf8'; //数据库字符集 latin1,gb2312,utf8...

$SYS_CONFIG['enable_validcode'] = 1; //是否开启登陆图形验证码. 1-开启,0-关闭
$SYS_CONFIG['language'] = 'utf8-zh'; //系统语言
$SYS_CONFIG['ftp_mode'] = 0 ; //系统运行在FTP模式,1-是,0-否
$SYS_CONFIG['ftp_host'] = 'cmsware'; //FTP主机地址
$SYS_CONFIG['ftp_port'] = '21'; //FTP服务器端口
$SYS_CONFIG['ftp_username'] = 'cms'; //FTP用户名
$SYS_CONFIG['ftp_password'] = 'cms'; //FTP密码
$SYS_CONFIG['ftp_cms_admin_path'] = ''; //CMS管理目录相对FTP根目录的路径 

$SYS_CONFIG['dir_mode'] = 0777; //系统创建目录的默认权限
$SYS_CONFIG['file_mode'] = 0777; //系统创建文件的默认权限

$SYS_CONFIG['enable_error_log'] = false; //是否开启报错日志
$SYS_CONFIG['error_reporting'] = "file"; //系统报错模式 file,html,js
$SYS_CONFIG['tpl_error_display'] = true; //是否在最终页面显示报错信息 true, false
$SYS_CONFIG['admin_dir_name'] = "admin"; //管理入口目录名

//--------------------------------以下部分请不要修改--------------------------//

$db_config['table_content_pre']     = 'content';	
$db_config['table_contribution_pre']     = 'contribution';	
$db_config['table_collection_pre']     = 'collection';	
$db_config['table_publish_pre']     = 'publish';
$lang_user = 'lang_user';
$lang_admin = 'lang_admin';
$SYS_DEBUG = true;
class table {
	var $sys;
	var $user;
	var $group;
	var $admin_sessions;
	var $sessions;

	var $site;
	var $cate;
	var $content_fields;
	var $content_index;
	var $content_table;
 	var $psn;
 	var $resource;
	var $publish_log;

	var $collection_cate;
	var $collection_rules;
	var $tasks;
 	var $contribution;
	var $resource_ref;
	var $workflow;
	var $workflow_state;
	var $workflow_record ;
	var $log_admin;
	var $log_login ;
	var $block_ip;
	var $contribution_note;
	
  	var $keywords;
	var $pubadminmasks;
 	var $plugins;
	var $tpl_vars;
 	var $tpl_cate;
 	var $tpl_data;

	function table()
	{
		global $db_config;

		$this->sys = $db_config['table_pre'].'sys';
		$this->user = $db_config['table_pre'].'user';
		$this->group = $db_config['table_pre'].'group';	
		$this->admin_sessions = $db_config['table_pre'].'admin_sessions';
		$this->sessions = $db_config['table_pre'].'sessions';

		$this->site = $db_config['table_pre'].'site';
		$this->content_fields = $db_config['table_pre'].'content_fields';
		$this->content_index = $db_config['table_pre'].'content_index';
		$this->content_table = $db_config['table_pre'].'content_table';
		$this->psn = $db_config['table_pre'].'psn';
		$this->resource = $db_config['table_pre'].'resource';
		$this->publish_log = $db_config['table_pre'].'publish_log';

		$this->collection_cate = $db_config['table_pre'].'collection_category';
		$this->collection_rules = $db_config['table_pre'].'collection_rules';
		$this->tasks = $db_config['table_pre'].'tasks';
		$this->cate = $db_config['table_pre'].'category';
		$this->contribution = $db_config['table_pre'].'contribution';
		$this->contribution_note = $db_config['table_pre'].'contribution_note';
 

		$this->keywords = $db_config['table_pre'].'keywords';
		$this->pubadminmasks = $db_config['table_pre'].'pubadminmasks';
		$this->plugins = $db_config['table_pre'].'plugins';
		$this->tpl_vars = $db_config['table_pre'].'tpl_vars';
		$this->resource_ref = $db_config['table_pre'].'resource_ref';
		
		$this->workflow = $db_config['table_pre'].'workflow';
		$this->workflow_state = $db_config['table_pre'].'workflow_state';
		$this->workflow_record = $db_config['table_pre'].'workflow_record';
		
		$this->log_login = $db_config['table_pre'].'log_login';
		$this->log_admin = $db_config['table_pre'].'log_admin';
		$this->block_ip = $db_config['table_pre'].'block_ip';
	
		$this->tpl_cate  = $db_config['table_pre'].'tpl_cate';
		$this->tpl_data = $db_config['table_pre'].'tpl_data';
		$this->tpl_block = $db_config['table_pre'].'tpl_block';

		$this->extra_publish = $db_config['table_pre'].'extra_publish';
		$this->node_fields = $db_config['table_pre'].'node_fields';


	}


}

$table=new table();

define("TPL_Error_Display", $SYS_CONFIG['tpl_error_display']);
define("ADMIN_NAME", $SYS_CONFIG['admin_dir_name']);

?>