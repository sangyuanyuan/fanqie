<?php
/*
 * system config file
 */
 $debug_tag = true;
 $use_localhost = true;
 /*
  * database configuration
  */
 
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
 
 $g_db_log_file = 'e:\log_file.txt';
 $g_news_tags = array('小编加精','公告','业务','群团');
 $g_video_tags = array('视频推荐');
?>