<?php
/**
* 调用示例
*
* 发布IndexID[=?]的内容页面
*
*/
define("IN_SHELL", true);

require_once 'config.php';

require_once 'common.php';
require_once INCLUDE_PATH."admin/publishAdmin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
require_once INCLUDE_PATH."admin/tplAdmin.class.php";
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."cms.class.php";
require_once INCLUDE_PATH."cms.func.php";
require_once SETTING_DIR ."cms.ini.php";
require_once INCLUDE_PATH.'encoding/encoding.inc.php';
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."admin/plugin.class.php";
require_once INCLUDE_PATH."admin/task.class.php";
require_once INCLUDE_PATH."image.class.php";
require_once INCLUDE_PATH."admin/extra_publish_admin.class.php";


$IndexID = intval($IN['IndexID']);


$publish = new publishAdmin();
$NodeInfo = $iWPC->loadNodeInfo($publish->getIndexInfo($IndexID, "NodeID"));

if($publish->publish($IndexID)) {
	echo "success";
} else 	
	echo "fail";


?>