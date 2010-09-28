<?php
define("IN_SHELL", true);
/*
Usage: php cron.php [options] [args...]
  -config  <file>                        Load Cron job from a config file. 从配置文件加载计划任务
  -refreshNodeIndex   NodeID[=1] Sub[=0] updating Node Index. 更新结点首页,NodeID为要更新的结点,多个结点用逗号分隔,Sub为是否更新子结点
  -refreshNodeExtra   NodeID[=1] Sub[=0] updating Node Exra. 更新结点附加发布,其他同上
  -refreshNodeContent NodeID[=1] Sub[=0] Level[=20] updating Node Content. 更新结点内容,其他同上
  -publishNodeContent NodeID[=1] Sub[=0] Level[=20] publishing Node Content. 发布结点内容,其他同上
  -refreshExtra       PublishID[=1]      updating PublishID Exra. 更新PublishID=x的附加发布,多个IndexID使用逗号分隔
  -refreshContent     IndexID[=1]        updating PublishID Exra. 更新IndexID=x的内容页,多个IndexID使用逗号分隔
  -collection     CateID[=1]        collection CateID . 启动CateID为x的采集进程,多个CateID使用逗号分隔
  -h               This help
  -v               Version number


更新所有首页     cron.php -refreshNodeIndex   0 1
更新所有附加发布 cron.php -refreshNodeExtra   0 1
更新所有内容页   cron.php -refreshNodeContent 0 1

更新结点NodeID[=1]的首页 cron.php -refreshNodeIndex  1
更新结点NodeID[=1,2,3]的首页 cron.php -refreshNodeIndex  1,2,3
更新结点NodeID[=1](含子结点)的首页 cron.php -refreshNodeIndex  1 1
更新结点NodeID[=1,2,3](含子结点)下的所有首页 cron.php -refreshNodeIndex  1,2,3 1

更新结点NodeID[=1]的附加发布 cron.php -refreshNodeExtra  1
更新结点NodeID[=1,2,3]的附加发布 cron.php -refreshNodeExtra  1,2,3
更新结点NodeID[=1](含子结点)的附加发布 cron.php -refreshNodeExtra  1 1
更新结点NodeID[=1,2,3](含子结点)下的所有附加发布 cron.php -refreshNodeExtra  1,2,3 1

更新结点NodeID[=1]的内容页 cron.php -refreshNodeContent  1
更新结点NodeID[=1,2,3]的内容页 cron.php -refreshNodeContent  1,2,3
更新结点NodeID[=1](含子结点)的内容页 cron.php -refreshNodeContent  1 1
更新结点NodeID[=1,2,3](含子结点)下的所有内容页 cron.php -refreshNodeContent  1,2,3 1

更新结点NodeID[=1]的所有内容页,系统负载度为10 cron.php -refreshNodeContent  1 0 10
更新结点NodeID[=1](含子结点)的所有内容页,系统负载度为20 cron.php -refreshNodeContent  1 1 20

更新PublishID[=5]的附加发布 cron.php -refreshExtra 5
更新PublishID[=6,7,8]的附加发布 cron.php -refreshExtra 6,7,8

更新IndexID[=88]的内容页 cron.php -refreshContent 88
更新IndexID[=198,268]的附加内容页 cron.php -refreshContent 198,268

发布结点NodeID[=1]的所有未发布内容页 cron.php -publishNodeContent  1
发布结点NodeID[=1,2,3]的所有未发布内容页 cron.php -publishNodeContent  1,2,3
发布结点NodeID[=1](含子结点)的所有未发布内容页 cron.php -publishNodeContent  1 1
发布结点NodeID[=1,2,3](含子结点)下的所有未发布内容页 cron.php -publishNodeContent  1,2,3 1

发布结点NodeID[=1]的所有未发布内容页,系统负载度为10 cron.php -publishNodeContent  1 0 10
发布结点NodeID[=1](含子结点)的所有未发布内容页,系统负载度为20 cron.php -publishNodeContent  1 1 20

启动采集分类(CateID=3)的采集进程 cron.php -collection  3

[系统负载度: 内容更新时对系统资源的占用度.低负载度更新的时间较长,但可以降低运行时对系统资源的消耗.负载度范围为1~N,1为最低负载,默认为20,夜间运行shell更新,可以使用较高的系统负载度]
*/
$HelpInfo = <<<EOT
Usage: php {$argv[0]} [options] [args...]
  -config  <file>                        Load Cron job from a config file. 
  -refreshNodeIndex   NodeID[=1] Sub[=0]            update Node Index. 
  -refreshNodeExtra   NodeID[=1] Sub[=0]            update Node ExraPublish. 
  -refreshNodeContent NodeID[=1] Sub[=0] Level[=20] update Node Content. 
  -publishNodeContent NodeID[=1] Sub[=0] Level[=20] publish Node Content. 
  -refreshExtra       PublishID[=1]                 update ExraPublish.
  -refreshContent     IndexID[=1]                   update Content.
  -collection     CateID[=1] Sub[=0]                collection.
  -h               This help
  -v               Version number

  args...          Arguments passed to script. 
EOT;

$VersionInfo = <<<EOT
CMSware crontab script  (version:1.0)
Copyright (c) 1999-2006 Sagatec Technology.
EOT;
if(isset($_SERVER["SERVER_NAME"])) exit("Access Denied: This script can only run in cli mode.");

if(count($argv)<=1) {
	exit($HelpInfo);
}
require_once 'common.php';


require_once INCLUDE_PATH."admin/publishAdmin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
require_once INCLUDE_PATH."admin/tplAdmin.class.php";
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."cms.class.php";
require_once INCLUDE_PATH."cms.func.php";
include_once SETTING_DIR ."cms.ini.php";
require_once INCLUDE_PATH.'encoding/encoding.inc.php';
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."admin/plugin.class.php";
require_once INCLUDE_PATH."admin/publishAuthAdmin.class.php";
require_once INCLUDE_PATH."admin/task.class.php";
require_once INCLUDE_PATH.'image.class.php';
require_once INCLUDE_PATH."admin/extra_publish_admin.class.php";

$publish = new publishAdmin();
$extrapublish = new extra_publish_admin();
clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
switch($argv[1]) {
	case '-refreshNodeIndex':
 		$Task = new Task();
		if(strpos($argv[2], ",")) $NodeID = explode(",", $argv[2]);
		else $NodeID = $argv[2];

		$include_sub = isset($argv[3]) ? $argv[3] : 0;
		if(is_array($NodeID)) {
			foreach($NodeID as $varNodeID) {
				$params = array(
						'NodeID'=> intval($varNodeID),
						'refresh_index'=> 1,
						'refresh_content'=> 0,
						'refresh_extra'=> 0,
						'include_sub'=> $include_sub,
						'content_num'=> 1,
						);
				$TaskData = $Task->refreshSiteInit($params);		
				if(count($TaskData)==0) {
					print("No task to run.");
				} else {
					foreach($TaskData as $var) {
						if($var[type] == 'index') { //content,extra
							$IN['NodeID'] = $var[targetId];
							refreshNodeIndex($var[targetId], $publish);
						}		
					} 
				}		
			}
		} else {
			$params = array(
					'NodeID'=> intval($NodeID),
					'refresh_index'=> 1,
					'refresh_content'=> 0,
					'refresh_extra'=> 0,
					'include_sub'=> $include_sub,
					'content_num'=> 1,
					);
			$TaskData = $Task->refreshSiteInit($params);		
			if(count($TaskData)==0) {
				print("No task to run.");
			} else {
				foreach($TaskData as $var) {
					if($var[type] == 'index') { //content,extra
						$IN['NodeID'] = $var[targetId];
						refreshNodeIndex($var[targetId], $publish);
					}		
				} 
			}
		}		
		break;
	case '-refreshNodeExtra':
 		$Task = new Task();
		if(strpos($argv[2], ",")) $NodeID = explode(",", $argv[2]);
		else $NodeID = $argv[2];

		$include_sub = isset($argv[3]) ? $argv[3] : 0;
		if(is_array($NodeID)) {
			foreach($NodeID as $varNodeID) {
				$params = array(
						'NodeID'=> intval($varNodeID),
						'refresh_index'=> 0,
						'refresh_content'=> 0,
						'refresh_extra'=> 1,
						'include_sub'=> $include_sub,
						'content_num'=> 1,
						);
				$TaskData = $Task->refreshSiteInit($params);		
				if(count($TaskData)==0) {
					print("No task to run.");
				} else {
					foreach($TaskData as $var) {
						if($var[type] == 'extra') { //content,extra
							$IN['NodeID'] = $var[targetId];
							refreshNodeExtra($var[publishId], $var[targetId], $publish);
						}		
					} 
				}		
			}
		} else {
			$params = array(
					'NodeID'=> intval($NodeID),
					'refresh_index'=> 0,
					'refresh_content'=> 0,
					'refresh_extra'=> 1,
					'include_sub'=> $include_sub,
					'content_num'=> 1,
					);
			$TaskData = $Task->refreshSiteInit($params);		
			if(count($TaskData)==0) {
				print("No task to run.");
			} else {
				foreach($TaskData as $var) {
					if($var[type] == 'extra') { //content,extra
						$IN['NodeID'] = $var[targetId];
						refreshNodeExtra($var[publishId], $var[targetId], $extrapublish);
					}		
				} 
			}
		}
		break;
	case '-refreshNodeContent':
 		$Task = new Task();
		if(strpos($argv[2], ",")) $NodeID = explode(",", $argv[2]);
		else $NodeID = $argv[2];

		$include_sub = isset($argv[3]) ? $argv[3] : 0;
		$content_num = isset($argv[4]) ? $argv[4] : 20;

		if(is_array($NodeID)) {
			foreach($NodeID as $varNodeID) {
				$params = array(
						'NodeID'=> intval($varNodeID),
						'refresh_index'=> 0,
						'refresh_content'=> 1,
						'refresh_extra'=> 0,
						'include_sub'=> $include_sub,
						'content_num'=> 1,
						);
				$TaskData = $Task->refreshSiteInit($params);		
				if(count($TaskData)==0) {
					print("No task to run.");
				} else {
					foreach($TaskData as $var) {
						if($var[type] == 'content') { //content,extra
							$IN['NodeID'] = $var[targetId];
							refreshNodeContent($var[targetId], $publish, $content_num);
						}		
					} 
				}		
			}
		} else {
			$params = array(
					'NodeID'=> intval($NodeID),
					'refresh_index'=> 0,
					'refresh_content'=> 1,
					'refresh_extra'=> 0,
					'include_sub'=> $include_sub,
					'content_num'=> 1,
					);
			$TaskData = $Task->refreshSiteInit($params);		
			if(count($TaskData)==0) {
				print("No task to run.");
			} else {
				foreach($TaskData as $var) {
					if($var[type] == 'content') { //content,extra
						$IN['NodeID'] = $var[targetId];
						refreshNodeContent($var[targetId], $publish, $content_num);
					}		
				} 
			}
		}
		break;
	case '-publishNodeContent':
 		$Task = new Task();
		if(strpos($argv[2], ",")) $NodeID = explode(",", $argv[2]);
		else $NodeID = $argv[2];

		$include_sub = isset($argv[3]) ? $argv[3] : 0;
		if(is_array($NodeID)) {
			foreach($NodeID as $varNodeID) {
				$params = array(
						'NodeID'=> intval($varNodeID),
						'refresh_index'=> 1,
						'refresh_content'=> 0,
						'refresh_extra'=> 0,
						'include_sub'=> $include_sub,
						'content_num'=> 1,
						);
				$TaskData = $Task->refreshSiteInit($params);		
				if(count($TaskData)==0) {
					print("No task to run.");
				} else {
					foreach($TaskData as $var) {
						if($var[type] == 'index') { //content,extra
							$IN['NodeID'] = $var[targetId];
							publishNodeContent($var[targetId], &$publish , $content_num = 20);
						}		
					} 
				}		
			}
		} else {
			$params = array(
					'NodeID'=> intval($NodeID),
					'refresh_index'=> 1,
					'refresh_content'=> 0,
					'refresh_extra'=> 0,
					'include_sub'=> $include_sub,
					'content_num'=> 1,
					);
			$TaskData = $Task->refreshSiteInit($params);		
			if(count($TaskData)==0) {
				print("No task to run.");
			} else {
				foreach($TaskData as $var) {
					if($var[type] == 'index') { //content,extra
						$IN['NodeID'] = $var[targetId];
						publishNodeContent($var[targetId], &$publish , $content_num = 20);
					}		
				} 
			}
		}		
		break;
	case '-refreshExtra':
		if(empty($argv[2])) exit("Error: PublishID is null");

		if(strpos($argv[2], ",")) $PublishID = explode(",", $argv[2]);
		else $PublishID = $argv[2];
		
		if(is_array($PublishID)) {
			foreach($PublishID as $varPublishID) {
				$PublishInfo = $extrapublish->getInfo($varPublishID);
				refreshNodeExtra($varPublishID, $PublishInfo['NodeID'], $extrapublish);
			
			}
		} else {
			$PublishInfo = $extrapublish->getInfo($PublishID);
			refreshNodeExtra($PublishID, $PublishInfo['NodeID'], $extrapublish);
		
		}


		break;
	case '-refreshContent':
		if(empty($argv[2])) exit("Error: IndexID is null");

		if(strpos($argv[2], ",")) $IndexID = explode(",", $argv[2]);
		else $IndexID = $argv[2];

		if(is_array($IndexID)) {
			foreach($IndexID as $varIndexID) {
				$NodeInfo = $iWPC->loadNodeInfo($publish->getIndexInfo($varIndexID, "NodeID"));

				ob_start();
				$publish->refresh($varIndexID);
				$contents = ob_get_contents();	 
				ob_end_clean();	
				output("[".$NodeInfo['Name']."] ".$contents);		
			}		
		} else {
			$NodeInfo = $iWPC->loadNodeInfo($publish->getIndexInfo($IndexID, "NodeID"));

			ob_start();
			$publish->refresh($IndexID);
			$contents = ob_get_contents();	 
			ob_end_clean();	
			output("[".$NodeInfo['Name']."] ".$contents);		
		}
		break;
	case '-collection':
 
		if(strpos($argv[2], ",")) $CateID = explode(",", $argv[2]);
		else $CateID = $argv[2];

		$include_sub = isset($argv[3]) ? $argv[3] : 0;
	
		include dirname(__FILE__)."/collection.php";			
		
		if(is_array($CateID)) {
			foreach($CateID as $varCateID) {
				$CateInfo = collection_cate_admin::getCateInfo($varCateID);
				include dirname(__FILE__)."/collectionLogic.php";			
			
			}
		} else {
 			if($CateID == 0 && $include_sub == 1) {
 				$sql  ="SELECT * FROM $table->collection_cate where InRunPlan=1 AND Disabled=0";
				$resultCateList = $db->Execute($sql);
				while(!$resultCateList->EOF) {
					$CateInfo = $resultCateList->fields;
					$CateID = $resultCateList->fields['CateID'];
					include dirname(__FILE__)."/collectionLogic.php";

 					$resultCateList->MoveNext();
				}

 
			} else {
				$CateInfo = collection_cate_admin::getCateInfo($CateID);
				include dirname(__FILE__)."/collectionLogic.php";			
			
			}
		
		}
		
		
		break;
	case '-v':
		exit($VersionInfo);
		break;
	case '-h':
	default:
		exit($HelpInfo);
		break;
}


?>