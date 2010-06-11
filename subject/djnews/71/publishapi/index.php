<?php
define("IN_SHELL", true);
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

require_once "smsg.php";

if (empty($IN['con'])) die("Error Code:1001");

$configfile = "./config/".$IN['con'].".php";
if (!(file_exists($configfile))) {
	die("Error Code:1002");
} else {
	include_once $configfile;
}

$publish = new publishAdmin(); 
$Plugin = new Plugin();
if(empty($IN['IndexID']) && empty($IN['NodeID'])) die("Error Code:1003");
if(!empty($IN['IndexID'])) { 
	$IndexInfo = $publish->getIndexInfo($IN['IndexID']);
	if(empty($IndexInfo['NodeID'])) die("Error Code:1004");
	$IN['NodeID'] = $IndexInfo['NodeID'];				
}

if(!empty($IN['NodeID'])) {
	$NodeInfo = $iWPC->loadNodeInfo($IN['NodeID']);
}

switch($IN['action']) {
	case 'add':							
			if (function_exists('add_start')) {
				add_start(&$IN);
			}
		
			$time=time();
			if (!isset($IN['PublishDate'])) $IN['PublishDate']= $time;
			if (!isset($IN['CreationDate'])) $IN['CreationDate']= $time;
			if (!isset($IN['ModifiedDate'])) $IN['ModifiedDate']= $time;
			
			if (!isset($IN['CreationUserID'])) $IN['CreationUserID']= $_PUBAPI['DefaultUserID'] ;
			if (!isset($IN['LastModifiedUserID'])) $IN['LastModifiedUserID']= $_PUBAPI['DefaultUserID'] ;
			
			$fieldInfo = content_table_admin::getTableFieldsInfo($NodeInfo['TableID']);
					
			$publish->flushData();
			
			foreach($fieldInfo as $key=>$var) {
					$field = $var['FieldName'];
					if(is_array($IN[$field])) {
						foreach($IN[$field] as $keyIn=>$varIn) {
							if($keyIn == 0)
								$value = $varIn;
							else
								$value .= ';'.$varIn;
						}	
					} elseif($var['FieldInput'] == 'RichEditor') {
						$value = RichEditor_Filter($IN[$field]);
						if($IN[$field.'_ImgAutoLocalize'] == '1') {
							$ImgAutoLocalize = new ImgAutoLocalize($IN['NodeID']);
							$result = $ImgAutoLocalize->execute($value);
							if($result)
								$value = $result;
						} 
					} 
					else $value = $IN[$field];
					
					$publishInfo[$field] = $value;
					LocalImgPathA2R::A2R($value);
					$publish->addData($field, $value);			
			}
			
			$publish->addData('CreationDate', $IN['CreationDate']);
			$publish->addData('ModifiedDate', $IN['ModifiedDate']);
			$publish->addData('CreationUserID', $IN['CreationUserID']);
			$publish->addData('LastModifiedUserID', $IN['LastModifiedUserID']);

			$IndexInfo = array(
				'PublishDate'=>$IN['PublishDate'],
				'Top'=>$IN['Top'],
				'Pink'=>$IN['Pink'],
				'SelfTemplate'=>$IN['SelfTemplate'],
				'SelfPublishFileName'=>$IN['SelfPublishFileName'],
				'SelfPSNURL'=>$IN['SelfPSNURL'],
				'SelfPSN'=>$IN['SelfPSN'],
				'SelfURL'=>$IN['SelfURL'],
			);

			chdir(ROOT_PATH.'include/');
			if($publish->contentAdd($NodeInfo['NodeID'],$IndexInfo)) {
		
				foreach($publishInfo as $key=>$var) {
					LocalImgPathA2R::A2R($var);				
				}
				chdir(ADMIN_PATH);	
				if (function_exists('add_end')) {
					add_end(&$IN);
				}
				smsg('Add Content Success',$IN['referer']);
			}else {
				chdir(ADMIN_PATH);
				smsg('<font color=#ff0000>Add Content Failed</font>',$IN['referer']);
			}			
			break;
			
	case 'edit':
			if (function_exists('edit_start')) {
					edit_start($IN);
			}
						
			$fieldInfo = content_table_admin::getTableFieldsInfo($NodeInfo['TableID']);
			$db->query("DELETE FROM  $table->resource_ref WHERE IndexID='{$IN['IndexID']}' ");
			$publish->flushData();
			
			foreach($fieldInfo as $key=>$var) {
					$field = $var['FieldName'];
					if(is_array($IN['$field'])) {
						foreach($IN['$field'] as $keyIn=>$varIn) {
							if($keyIn == 0)
								$value = $varIn;
							else
								$value .= ';'.$varIn;
						}
					} elseif($var['FieldInput'] == 'RichEditor') {
						$value = RichEditor_Filter($IN[$field]);
						if($IN[$field.'_ImgAutoLocalize'] == '1') {
							$ImgAutoLocalize = new ImgAutoLocalize($IN['NodeID']);
							$result = $ImgAutoLocalize->execute($value);

							if($result)
								$value = $result;
						} 
					} else
						$value = $IN[$field];

				if (isset($IN[$field])) {
					LocalImgPathA2R::A2R($value);
					$publish->addData($field, $value);
				}
			}
			
			$time = time();
			if (isset($IN['CreationDate'])) $publish->addData('CreationDate', $IN['CreationDate']);
			if (isset($IN['ModifiedDate'])) $publish->addData('ModifiedDate', $IN['ModifiedDate']);
			else $publish->addData('ModifiedDate', $time);
			
			if (isset($IN['CreationUserID'])) $publish->addData('CreationUserID', $IN['CreationUserID']);
			
			if (isset($IN['LastModifiedUserID'])) $publish->addData('LastModifiedUserID', $IN['LastModifiedUserID']);
			else $publish->addData('LastModifiedUserID', $_PUBAPI['DefaultUserID']);

			if (isset($IN['PublishDate'])) $IndexInfo['PublishDate'] = $IN['PublishDate'];
			if (isset($IN['Top'])) $IndexInfo['Top'] = $IN['Top'];
			if (isset($IN['Pink'])) $IndexInfo['Pink'] = $IN['Pink'];
			if (isset($IN['SelfTemplate'])) $IndexInfo['SelfTemplate'] = $IN['SelfTemplate'];
			if (isset($IN['SelfPublishFileName'])) $IndexInfo['SelfPublishFileName'] = $IN['SelfPublishFileName'];
			if (isset($IN['SelfPSNURL'])) $IndexInfo['SelfPSNURL'] = $IN['SelfPSNURL'];
			if (isset($IN['SelfPSN'])) $IndexInfo['SelfPSN'] = $IN['SelfPSN'];
			if (isset($IN['SelfURL'])) $IndexInfo['SelfURL'] = $IN['SelfURL'];
	
			chdir(ROOT_PATH.'include/');
			if($publish->contentEdit($IN['IndexID'], $IndexInfo)) {	
				chdir(ADMIN_PATH);
				if (function_exists('edit_end')) {
					edit_end($IN);
				}
				smsg('Edit Content Success',$IN['referer']);
			} else {
				chdir(ADMIN_PATH);
				smsg('<font color=#ff0000>Edit Content Failed</font>',$IN['referer']);
			}
			break;
			
	case 'del':
			if (function_exists('del_start')) {
				del_start($IN);
			}
	
			if(($IN['multi'] == "1") && !empty($IN['pData']) ) {
				chdir(ROOT_PATH.'include/');
				foreach($IN['pData'] as $var) {
					$result = $publish->indexDel($var);				
				}
				chdir(ADMIN_PATH);

				if($result) {				
					if (function_exists('del_end')) {
						del_end($IN);
					}
					smsg('Del Content Success', $IN['referer']);
				} else {
					smsg('<font color=#ff0000>Del Content Failed</font>', $IN['referer']);
				}
			} else {
				chdir(ROOT_PATH.'include/');
				if($publish->indexDel($IN['IndexID'])) {	
				chdir(ADMIN_PATH);								
					if (function_exists('del_end')) {
						del_end($IN);
					}
					smsg('Del Content Success', $IN['referer']);
				} else {
					smsg('<font color=#ff0000>Del Content Failed</font>', $IN['referer']);	
				}		
			}
			break;
			
	default: die("unknown_action");
}

function refresh_index($NodeID) {   //刷新首页函数
	global $publish,$iWPC,$SYS_ENV;
	$publish->NodeInfo = $iWPC->loadNodeInfo($NodeID);
	
	$tplname = $publish->NodeInfo['IndexTpl'];
	$filename = $publish->NodeInfo['IndexName'];

	$filename = str_replace('{NodeID}', $publish->NodeInfo['NodeID'], $filename);
	if(preg_match("/\{(.*)\}/isU", $filename, $match)) {
		eval("\$fun_string = $match[1];");
		$filename = str_replace($match[0], $fun_string, $filename);
	}
	$SYS_ENV['tpl_pagelist']['filename'] = $filename;
	chdir(ROOT_PATH.'include/');
	$publish->refreshIndex($NodeID, $tplname, $filename);
	chdir(ADMIN_PATH);
}

?>