<?php
/*
 * system config file
 */
 $debug_tag = false;

 $use_localhost = false;

 
 /*
  * database configuration
  */
 

 $db_server_name = '172.27.203.82';

 if($use_localhost == true){
 	$db_server_name = 'localhost';
 }else{
 	$db_server_name = '172.27.203.82';
 }

 $db_database_name = 'smg_new';
 $db_user_name = 'root';
 $db_password = 'xunao';
 $db_code = 'utf8';
 
 $db_server_name_bak = '172.27.203.82';
 $db_database_name_bak = 'smgnew';
 $db_user_name_bak = 'root';
 $db_password_bak = '';
 $db_code_bak = 'utf8';
 
 $g_news_tags = array('小编加精','公告','业务','群团','历史头条','小编推荐','生活');
 $g_video_tags = array('视频推荐');

 $g_ucenter_ip = 'http://172.27.203.83:8080';
?>