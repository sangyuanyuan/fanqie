<?php
require_once 'common.php';

if(!$sys->canAccess('canCollection')) {
	goback('access_deny_module_collection');

}


require_once INCLUDE_PATH."admin/collection_cate_admin.class.php";
require_once INCLUDE_PATH."admin/collection_admin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";

$collection_cate = new collection_cate_admin();
$collection = new collection_admin();

$CateInfo = collection_cate_admin::getCateInfo($IN[CateID]);

switch($IN['o']) {

	case 'add':
		if(empty($IN[ParentID])) {
			$TPL->assign('ParentID', 0);

		} else{
			$TPL->assign('ParentID', $IN[ParentID]);
		
		}


		$TPL->assign('NODE_LIST', $NODE_LIST);
		$TPL->assign('tableInfo', content_table_admin::getAllTable());

		if(!empty($IN[TableID]))
			$TableID = $IN[TableID];
		else
			$TableID = $TPL->_tpl_vars[tableInfo][0][TableID];

		$TPL->assign('tableFieldInfo', content_table_admin::getTableFieldsInfo($TableID));
		$TPL->assign('TableID', $TableID);
		$TPL->display("collection_cate_add.html");
		break;

	case 'add_submit':
		$collection_cate->flushData();

		$collection_cate->flushData();
		foreach($IN as $key=>$var) {
			$prefix = substr($key, 0, 5);
			$suffix = substr($key, 5);
			if($prefix == 'data_')
				$collection_cate->addData($suffix,$var);
			elseif($prefix == 'rule_')
				$contentRules[$suffix] = $var;
			else {
				continue;
			
			}
		}



		//$collection_cate->debugData();
		$collection_cate->addData('NodeID', $IN[TargetNodeID]);

		
		if(!empty($IN[SubTargetNodeID])) {
			foreach($IN[SubTargetNodeID] as $key=>$var) {
				if($key == 0)
					$subTargetNodeID = $var;
				else
					$subTargetNodeID .= ','.$var;

			}		
			$collection_cate->addData('SubNodeID', $subTargetNodeID);
		}
		


		if(!empty($IN[IndexNodeID])) {
			foreach($IN[IndexNodeID] as $key=>$var) {
				if($key == 0)
					$subTargetNodeID1 = $var;
				else
					$subTargetNodeID1 .= ','.$var;

			}
			$collection_cate->addData('IndexNodeID', $subTargetNodeID1);
		}




		if($collection_cate->add()) { //插入分类数据
			$CateID = $collection_cate->db_insert_id;
			foreach($contentRules as $key=>$var) {

					$collection_cate->flushData();
					$collection_cate->addData('Rule', $var);				
					$collection_cate->addData('CateID', 	$CateID );				
					$collection_cate->addData('ContentFieldID', $key);				
					$collection_cate->addData('TableID', $IN[data_TableID]);				
					$collection_cate->addRule();
				
			
			
			}

				//echo "<script>\n
				//	top.panelMenu.location = top.panelMenu.location ;		
				//</script>\n";
			showmessage('add_collection_cate_ok', $referer);
		} else	
			showmessage( 'add_collection_cate_fail', $referer);


		
				

		break;

	case 'edit':
		if(!empty($IN[CateID])) {
			$TPL->assign('NODE_LIST', $NODE_LIST);
			$TPL->assign('tableInfo', content_table_admin::getAllTable());
			
			$CateInfo = $collection_cate->getCateInfo($IN[CateID]);
			$CateInfo[SubNodeIDs] = explode(',', $CateInfo[SubNodeID]);
			$CateInfo[IndexNodeIDs] = explode(',', $CateInfo[IndexNodeID]);
			$TPL->assign('tableFieldInfo', content_table_admin::getTableFieldsInfo($CateInfo[TableID]));
			$TPL->assign('CateInfo', $CateInfo);
			$TPL->assign('RulesInfo', $collection_cate->getRules($IN[CateID]));
			
			$TPL->display("collection_cate_edit.html");
	
		} else
			goto('view');

		break;

	case 'edit_submit':
		if(empty($IN[CateID])) goto('view');

		$collection_cate->flushData();
		foreach($IN as $key=>$var) {
			$prefix = substr($key, 0, 5);
			$suffix = substr($key, 5);
			if($prefix == 'data_')
				$collection_cate->addData($suffix,$var);
			elseif($prefix == 'rule_')
				$contentRules[$suffix] = $var;
			else
				continue;
		}
		//$collection_cate->debugData();
	
		$collection_cate->addData('NodeID', $IN[TargetNodeID]);
		if(!empty($IN[SubTargetNodeID])) {
			foreach($IN[SubTargetNodeID] as $key=>$var) {
				if($key == 0)
					$subTargetNodeID = $var;
				else
					$subTargetNodeID .= ','.$var;

			}		
			$collection_cate->addData('SubNodeID', $subTargetNodeID);
		}
		


		if(!empty($IN[IndexNodeID])) {
			foreach($IN[IndexNodeID] as $key=>$var) {
				if($key == 0)
					$subTargetNodeID1 = $var;
				else
					$subTargetNodeID1 .= ','.$var;

			}
			$collection_cate->addData('IndexNodeID', $subTargetNodeID1);
		}

		if($collection_cate->update($IN[CateID])) { //更新节点数据

			foreach($contentRules as $key=>$var) {
				if($collection_cate->isRuleExists($IN[CateID], $key)) {
					$collection_cate->flushData();
					$collection_cate->addData('Rule', $var);
					$collection_cate->updateRule($IN[CateID], $key);
			
				} else {
					$collection_cate->flushData();
					$collection_cate->addData('Rule', $var);				
					$collection_cate->addData('CateID', $IN[CateID]);				
					$collection_cate->addData('ContentFieldID', $key);				
					$collection_cate->addData('TableID', $IN[TableID]);				
					$collection_cate->addRule();
				}
			
			
			}

			
			//echo "<script>\n
			//		top.panelMenu.location = top.panelMenu.location ;		
			//	</script>\n";
			showmessage('edit_collection_cate_ok', $referer);
			


		} else	
			showmessage('edit_collection_cate_fail', $referer);
		
		break;

	case 'del':
		if(empty($IN[CateID])) goto('view');

		if($collection_cate->haveSon($IN[CateID]) && $IN[action] != 'force') {
				confirm("del&CateID={$IN[CateID]}&action=force", $_LANG_ADMIN['del_collection_cate_haveson']);
			
		} elseif($collection_cate->haveSon($IN[CateID]) && $IN[action] == 'force') {

			if($collection_cate->del($IN[CateID])) {
				alert('del_collection_cate_haveson_ok','panelMenu');


			} else
				alert('del_collection_cate_haveson_fail','panelMenu');

		} else {

			if($collection_cate->del($IN[CateID])) {

				alert('del_collection_cate_ok','panelMenu');
			
			} else
				alert('del_collection_cate_fail','panelMenu');

	
		}
		break;

	case 'move':
		if(empty($IN[CateID])) goto('view');
		
		$collection_cate->flushData();
		$collection_cate->addData('ParentID', $IN[targetCateID]);

	


		if($IN[CateID] == $IN[targetCateID]) {
			alert('move_collection_cate_id_conflict','panelMenu');
	
		} elseif($collection_cate->update($IN[CateID])) { //更新分类数据
			alert('move_collection_cate_ok','panelMenu');
		} else
			alert('move_collection_cate_fail','panelMenu');

		break;
	case 'go':
		$url = $IN['url'];
		if(preg_match("/{(.*)\[([0-9]*),([0-9]*),([0-9]*)\]}/isU", $url, $matches)) {
			$page = empty($page) ? 0 : $page;
			 $Crawler_Page = true;
			if($page > $matches[3]) {
				return 0;
			} elseif($page < $matches[2]) {
				if($matches[4] == 1 && $page ==0) {
					$url = str_replace($matches[0], '', $url);
					$page = $page + $matches[2];
					//ECHO 'AAAAAAAAAAAAA'.$page;
				} else {
					$page = $page + $matches[2];
					$url = str_replace($matches[0], $matches[1].$page, $url);
					$page++;
				
				}
		
			} else {
				$url = str_replace($matches[0], $matches[1].$page, $url);
				$page++;
				//echo $url;
				//ECHO $page;
				//print_r($matches);exit;
			
			}

			//echo $page .'---------'. $matches[2]."<br>" ;
		} elseif(preg_match("/{(.*)\[([0-9]*),([0-9]*)\]}/isU", $url, $matches)) {
			$page = empty($page) ? 0 : $page;
			 $Crawler_Page = true;
			if($page > $matches[3]) {
				return 0;
			} elseif($page < $matches[2]) {
				$url = str_replace($matches[0], '', $url);
				$page = $page + $matches[2];
			} else {
				$url = str_replace($matches[0], $matches[1].$page, $url);
				$page++;
				//echo $url;
				//print_r($matches);exit;
			
			}
		}
		preg_match_all("/[\s\S]+\[([\s\S]*)\][\s\S]+/isU",$url,$matches);
		$data = $matches[1];

		foreach($data as $var) {
			$url = str_replace("[".$var."]",date($var,time()),$url);
		}

		header("Location: ".$url);
		break;
	case 'export':
		if(!empty($IN[CateID])) {
			$TPL->assign_by_ref('NODE_LIST', $NODE_LIST);
			$CateInfo = $collection_cate->getCateInfo($IN[CateID]);
			$CateInfo[SubNodeIDs] = explode(',', $CateInfo[SubNodeID]);
			$TPL->assign('tableFieldInfo', content_table_admin::getTableFieldsInfo($CateInfo[TableID]));
			$TPL->assign('CateInfo', $CateInfo);
			$TPL->assign('RulesInfo', $collection_cate->getRules($IN[CateID]));
			
			$contents = $TPL->fetch("collection_cate_export.xml");
			$ext       .= '.dat';
			$mime_type = 'application/x-dat';
			
			$dump_buffer = &$contents;
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
			$filename = "collection_rules";
			header('Content-Type: ' . $mime_type);
			header('Expires: ' . $now);
			header('Content-Disposition: inline; filename="' . $filename . $ext . '"');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			echo $dump_buffer;
			exit;
	
		} else
			goto('view');

		break;
	case 'import':
		$diableDebug = true;
		$TPL->assign('topic', $_LANG_ADMIN['collection_rules_import']);		
		$TPL->assign('target_url', $base_url."&o=import_submit&CateID={$CateInfo['CateID']}");		
		$TPL->display("ui_upload.html");
		break;
	case 'import_submit':
		$content = getFile($_FILES['uploadFile']['tmp_name']);
		unlink($_FILES['uploadFile']['tmp_name']);
		$ruleData = parseRuleXML($content);
		if(!empty($content)) {
			$collection_cate->flushData();
			$collection_cate->addData($ruleData['CateRules']);
//ContentModelRules

			if($collection_cate->update($CateInfo[CateID])) { //更新节点数据

				$tableFieldInfo = content_table_admin::getTableFieldsInfo($CateInfo[TableID]);

				foreach($tableFieldInfo as $key=>$var) {

					if($collection_cate->isRuleExists($CateInfo[CateID], $var['ContentFieldID'])) {
						$collection_cate->flushData();
						$collection_cate->addData('Rule', $ruleData['ContentModelRules'][$var['FieldName']]);
						$collection_cate->updateRule($CateInfo[CateID], $var['ContentFieldID']);
				
					} else {
						$collection_cate->flushData();
						$collection_cate->addData('Rule', $ruleData['ContentModelRules'][$var['FieldName']]);				
						$collection_cate->addData('CateID', $CateInfo[CateID]);				
						$collection_cate->addData('ContentFieldID', $var['ContentFieldID']);				
						$collection_cate->addData('TableID', $CateInfo[TableID]);					
						$collection_cate->addRule();
					}
				}

			} else {
				halt('collection_rules_import_fail');
			
			
			}
					
					
					
					echo "<script>\n
					parent.window.opener.location = parent.window.opener.location;				
					</script>\n";
			halt('collection_rules_import_ok');
		
		} else {
		
			halt('collection_rules_import_fail');
	
		}
		break;

}



function parseRuleXML($content)
{	
 	$rulePattern['TargetURL'] = "/<TargetURL>(.*)<\/TargetURL>/isU";
 	$rulePattern['TargetURLArea'] = "/<TargetURLArea>(.*)<\/TargetURLArea>/isU";
 	$rulePattern['UrlFilterRule'] = "/<UrlFilterRule>(.*)<\/UrlFilterRule>/isU";
 	$rulePattern['UrlPageRule'] = "/<UrlPageRule>(.*)<\/UrlPageRule>/isU";
 	$rulePattern_ContentModel = "/<ContentModel>(.*)<\/ContentModel>/isU";

	foreach($rulePattern as $key=>$var) { //解析分类采集规则
		if(preg_match($var, $content, $match)) {
			$CateRules[$key] = html_entity_decode($match[1]);
		}
	}

	if(preg_match($rulePattern_ContentModel, $content, $match)) { //解析内容模型采集规则
		$pattern = "/<(.*)>(.*)<\/\\1>/isU";
		if(preg_match_all($pattern, $match[1], $matches)) {
			foreach($matches[1] as $key=>$var) {
				$ContentModelRules[$var] = html_entity_decode($matches[2][$key]);
			}
		}
		
	}

	$rule['CateRules'] = $CateRules;
	$rule['ContentModelRules'] = $ContentModelRules;
	return $rule;

}
	
include MODULES_DIR.'footer.php' ;

?>
