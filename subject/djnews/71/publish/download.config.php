<?php
define('_TableID', 2);				// 下载内容模型TableID
define('_Protect_Link', false);				//默认不防盗链,如果你需要防止盗链,则设为true
define('_Domain', "www.cmsware.net");		//你的主机名称,当_Protect_Link设为true时，用户必须访问_Domain才能正常下载
$_DIE_INFO = "你下载的软件来自<a href=http://"._Domain.">"._Domain."</a>，请直接访问<a href=http://"._Domain.">"._Domain."</a>来下载该软件，谢绝外链！";
$table_download = $db_config['table_pre'].'publish_'._TableID; //下载模型发布库表名
?>