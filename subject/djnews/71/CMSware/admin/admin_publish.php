<?php
//$Id: admin_publish.php,v 1.24 2006/08/02 15:09:22 Administrator Exp $
require_once 'common.php';

require_once INCLUDE_PATH."admin/publishAdmin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
//require_once INCLUDE_PATH."admin/tplAdmin.class.php";
require_once INCLUDE_PATH."admin/site_admin.class.php";
require_once INCLUDE_PATH."cms.class.php";
require_once INCLUDE_PATH."cms.func.php";
require_once INCLUDE_PATH.'encoding/encoding.inc.php';
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."admin/plugin.class.php";
require_once INCLUDE_PATH."admin/publishAuthAdmin.class.php";
require_once INCLUDE_PATH."admin/task.class.php";
require_once INCLUDE_PATH.'image.class.php';
$Plugin = new Plugin();

$publish = new publishAdmin();
$site = new site_admin();

//$db->setDebug(1);
//if($IN[NodeID] == '') 	goback('error_NodeID_null');

//权限验证
/*
if(!empty($IN[NodeID])) {
		if(!$sys->canManagePublish($IN[o], $IN[NodeID])) {
			goback($sys->returnMsg);
		}
		$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
}
*/

if(!empty($IN[IndexID])) {
	$IndexInfo = $publish->getIndexInfo($IN[IndexID]);
	
	if(empty($IndexInfo['NodeID'])) goback('error_IndexID_invalid');

	$IN[NodeID] = $IndexInfo['NodeID'];
}


if(!empty($IN[NodeID])) {
	$site->publishPermissionDetector($IN[o], $IN[NodeID], $IN);
	$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
}

$TPL->assign_by_ref("NodeInfo", $NodeInfo);
$TPL->assign_by_ref("NODE_LIST", $NODE_LIST);


switch($IN[o]) {
		case 'list':
			if(empty($NodeInfo['NodeID'])) goback('error_NodeID_invalid');
			$TPL->assign('IndexID', $IN[IndexID]);
			$TPL->assign('NodeID', $IN[NodeID]);
			$TPL->display('content_admin_frameset.html');
			
			break;
		case 'content_header'://内容管理 头部功能导航
			$TPL->assign('IndexID', $IN[IndexID]);
			$TPL->assign('NodeID', $IN[NodeID]);
			$TPL->assign_by_ref("NodeInfo", $NodeInfo);

			if($NodeInfo['NodeType'] == 2) {
				$ParentNodeInfo = $iWPC->loadNodeInfo($NodeInfo['InheritNodeID']);
				$NodeInfo['ParentNodeName'] = $ParentNodeInfo['Name'];
			}

			$TPL->display('content_admin_header.html');
			$diableDebug = true;
			break;
		case 'content_list': //内容管理 文章列表
			if(!empty($IN['IndexID'])) {
				$TPL->assign('DisplayItem', content_table_admin::getDisplayFieldsInfo($NodeInfo[TableID]));
				$TPL->assign_by_ref('catelist', $CATE_LIST);
				$pList[] = $publish->getContentInfo($IN['IndexID']);
				$TPL->assign_by_ref("pList", $pList);
				$TPL->assign_by_ref("recordInfo", $recordInfo);
				$TPL->assign_by_ref("NodeInfo", $NodeInfo);
				$TPL->assign("offset", $offset);
				$TPL->display('content_admin_list.html');
				break;
			}

			$offset = empty( $IN['offset']) ?  $SYS_ENV['ContentPageNum'] : $IN['offset'];
			//debug($IN);
			if($IN[State] != '') {
				$State = "=".$IN[State];
			} else {
				$State = "!=-1";
			
			}
			$num= $publish->getIndexRecordNum($IN[NodeID], $State);

			$pagenum=ceil($num/$offset);
			if(empty($IN[Page]))
				$Page = 1;
			else
				$Page = $IN[Page];

			$start=($Page-1)*$offset;
			
			$recordInfo[currentPage] = $Page;
			$recordInfo[pageNum] = $pagenum;
			$recordInfo[recordNum] = $num;
			$recordInfo[offset] = $offset;
			$recordInfo[from] = $start;
			$recordInfo[to] = $start+$offset;

			$TPL->assign('DisplayItem', content_table_admin::getDisplayFieldsInfo($NodeInfo[TableID]));
			$TPL->assign_by_ref('catelist', $CATE_LIST);
			$TPL->assign("pList", $publish->getIndexLimit($IN[NodeID], $start, $offset, $State, "!=3"));
			$TPL->assign_by_ref("recordInfo", $recordInfo);
			$TPL->assign_by_ref("NodeInfo", $NodeInfo);
			$TPL->assign("offset", $offset);
			

			$TPL->assign("pagelist",pagelist($pagenum,$Page,"{$base_url}o=content_list&type=main&NodeID={$IN[NodeID]}&State={$IN[State]}&offset={$offset}",'#000000'));
 			$TPL->display('content_admin_list.html');
 			
			break;
		case 'content_editor_frameset':
			$TPL->assign('NodeID', $IN[NodeID]);
			$TPL->assign('IndexID', $IN[IndexID]);
			$TPL->assign('o', $IN[extra]);
			$TPL->display('content_editor_frameset.html');

			break;
		case 'content_editor_header':
			//debug($NODE_LIST);
			$TPL->assign('NODE_LIST', $NODE_LIST);
			$TPL->assign('NodeID', $IN[NodeID]);
			$TPL->assign("NodeInfo", $NodeInfo);
			$TPL->assign("tableInfo", content_table_admin::getTableFieldsInfo($NodeInfo[TableID]));
			$TPL->display('content_editor_header.html');
			$diableDebug = true;
			break;
		
		case 'add':	//生成内容添加的UI,已经转至admin_editor.php处理
			$TableID = 	$NodeInfo[TableID];

			$tableInfo = content_table_admin::getTableFieldsInfo($TableID);
			require_once INCLUDE_PATH."admin/TplVarsAdmin.class.php";
			$PUBLISH_URL = TplVarsAdmin::getValue('PUBLISH_URL');

 			$diableDebug = true;

			//$TPL->assign('year',date("Y-m-d"));
			$output_year = date("Y-m-d");
			$hour = date("H");
			for($i=0;$i<=24;$i++) {
				if($i<10) {
					$j = '0'.$i;
					if($j == $hour)
						$output_hour .= "<option value=\"$j\" selected>$j</option>";
					else
						$output_hour .= "<option value=\"$j\">$j</option>";
				} else {
					if($i == $hour)
						$output_hour .= "<option value=\"$i\" selected>$i</option>";
					else
						$output_hour .= "<option value=\"$i\">$i</option>";
					
				}
			}
			$minute = date("i");
			for($i=0;$i<=60;$i++) {
				if($i<10) {
					$j = '0'.$i;
					if($j == $minute)
						$output_minute  .= "<option value=\"$j\" selected>$j</option>";
					else
						$output_minute  .= "<option value=\"$j\">$j</option>";
				} else {
					if($i == $minute)
						$output_minute  .= "<option value=\"$i\" selected>$i</option>";
					else
						$output_minute  .= "<option value=\"$i\">$i</option>";
					
				}
			}

			$second = date("s");
			for($i=0;$i<=60;$i++) {
				if($i<10) {
					$j = '0'.$i;
					if($j == $second)
						$output_second  .= "<option value=\"$j\" selected>$j</option>";
					else
						$output_second  .= "<option value=\"$j\">$j</option>";
				} else {
					if($i == $second)
						$output_second  .= "<option value=\"$i\" selected>$i</option>";
					else
						$output_second  .= "<option value=\"$i\">$i</option>";
					
				}
			}
			
			if($NodeInfo['Editor'] == '' || $NodeInfo['Editor'] == 'default.php' || $NodeInfo['Editor'] == 'NULL' || !file_exists(EDITORS_DIR.$NodeInfo['Editor'])) {
				include MODULES_DIR.'editor.php' ;
			
			} else {
				include EDITORS_DIR.$NodeInfo['Editor'] ;
			
			}

			break;
		case 'add_submit':
			include_once SETTING_DIR ."cms.ini.php";

			//debug($IN);
			$fieldInfo = content_table_admin::getTableFieldsInfo($NodeInfo[TableID]);			

			$publish->flushData();
			
			foreach($fieldInfo as $key=>$var) {
					$field = 'data_'.$var[FieldName];
					if($var[FieldType] == 'contentlink') {
						$field = 'data_'.$var[FieldName].'_value';
						if($IN[$field] == 'undefined') {
							$value = '';
						} else $value = $IN[$field];
						
					
					} elseif(is_array($IN[$field])) {
						foreach($IN[$field] as $keyIn=>$varIn) {
							if($keyIn == 0)
								$value = $varIn;
							else
								$value .= ';'.$varIn;


						}
					} elseif($var[FieldInput] == 'RichEditor') {
						$field = 'data_'.$var[FieldName].'_html';
						$value = RichEditor_Filter($IN[$field]);
							//debug($IN);//data_Intro_ImgAutoLocalize
						if($IN['data_'.$var[FieldName].'_ImgAutoLocalize'] == '1') {
							//echo $result;
							$ImgAutoLocalize = new ImgAutoLocalize($IN[NodeID]);
							$result = $ImgAutoLocalize->execute($value);
							if($result)
								$value = $result;

							
						} 
						//echo $value;exit;
					} else
						$value = $IN[$field];
					
					
					//debug($IN);
					$publishInfo[$var[FieldName]] = $value;
					LocalImgPathA2R::A2R($value);
					$publish->addData($var[FieldName], $value);
				
			}
			//CreationDate  ModifiedDate  CreationUserID  LastModifiedUserID  ApprovedByUserID 
			$time = time();
			$publish->addData('CreationDate', $time);
			$publish->addData('ModifiedDate', $time);
			$publish->addData('CreationUserID', $sys->session[sUId]);
			$publish->addData('LastModifiedUserID', $sys->session[sUId]);


			//$PublishDate =  strtotime($IN[year].' '.$IN[hour].':'.$IN[minute].':'.$IN[second]);
			$IndexInfo = array(
				'PublishDate'=>strtotime($IN[year].' '.$IN[hour].':'.$IN[minute].':'.$IN[second]),
				'Top'=> empty($IN[Top]) ? 0 : $IN[Top],
				'Pink'=>empty($IN[Pink]) ? 0 : $IN[Pink],
				'Sort'=> 0,
				'SelfTemplate'=>$IN[SelfTemplate],
				'SelfPublishFileName'=>$IN[SelfPublishFileName],
				'SelfPSNURL'=>$IN[SelfPSNURL],
				'SelfPSN'=>$IN[SelfPSN],
				'SelfURL'=>$IN[SelfURL],
				'SubTargetNodeID'=> $IN[SubTargetNodeID],
				'IndexTargetNodeID'=> $IN[IndexTargetNodeID],
			);

				//$publish->debugData();
			if($publish->contentAdd($NodeInfo[NodeID],$IndexInfo)) {
				//print_r($IN);exit;
				$db->query("DELETE FROM  $table->resource_ref WHERE IndexID='{$IN[IndexID]}' ");
				foreach($publishInfo as $key=>$var) {
					LocalImgPathA2R::A2R($var);
				
				}
				
				if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) {
							Task::refreshIndexTree($NodeInfo[NodeID], 'parent.window.opener.addThread');	
						}
					
				}
				echo "<script>\n
						parent.window.opener.refreshWorkArea();				
						</script>\n";				
					
				
				showmessage('content_add_ok',$referer);	
			}else
				goback('content_add_fail');
			break;
		case 'edit':
			require_once INCLUDE_PATH."admin/TplVarsAdmin.class.php";
			if(empty($IN[IndexID])) goto('content_list');
			$pInfo = $publish->getContentInfo($IN[IndexID]);
			$imgResourceInfo = $publish->getResourceInfo($IN[IndexID], 'img');
 			$attachResourceInfo = $publish->getResourceInfo($IN[IndexID], 'attach');
			$flashResourceInfo = $publish->getResourceInfo($IN[IndexID], 'flash');
			$TableID = 	$NodeInfo[TableID];
			$PUBLISH_URL = TplVarsAdmin::getValue('PUBLISH_URL');


			$tableInfo = content_table_admin::getTableFieldsInfo($TableID);

 			$diableDebug = true;
			$output_year = date("Y-m-d",$pInfo[PublishDate]);
			$hour = date("H",$pInfo[PublishDate]);
			for($i=0;$i<=24;$i++) {
				if($i<10) {
					$j = '0'.$i;
					if($j == $hour)
						$output_hour .= "<option value=\"$j\" selected>$j</option>";
					else
						$output_hour .= "<option value=\"$j\">$j</option>";
				} else {
					if($i == $hour)
						$output_hour .= "<option value=\"$i\" selected>$i</option>";
					else
						$output_hour .= "<option value=\"$i\">$i</option>";
					
				}
			}
			$minute = date("i",$pInfo[PublishDate]);
			for($i=0;$i<=60;$i++) {
				if($i<10) {
					$j = '0'.$i;
					if($j == $minute)
						$output_minute  .= "<option value=\"$j\" selected>$j</option>";
					else
						$output_minute  .= "<option value=\"$j\">$j</option>";
				} else {
					if($i == $minute)
						$output_minute  .= "<option value=\"$i\" selected>$i</option>";
					else
						$output_minute  .= "<option value=\"$i\">$i</option>";
					
				}
			}

			$second = date("s",$pInfo[PublishDate]);
			for($i=0;$i<=60;$i++) {
				if($i<10) {
					$j = '0'.$i;
					if($j == $second)
						$output_second  .= "<option value=\"$j\" selected>$j</option>";
					else
						$output_second  .= "<option value=\"$j\">$j</option>";
				} else {
					if($i == $second)
						$output_second  .= "<option value=\"$i\" selected>$i</option>";
					else
						$output_second  .= "<option value=\"$i\">$i</option>";
					
				}
			}
			//debug($pInfo);

			if($NodeInfo['Editor'] == '' || $NodeInfo['Editor'] == 'default.php' || $NodeInfo['Editor'] == 'NULL' || !file_exists(EDITORS_DIR.$NodeInfo['Editor'])) {
				include MODULES_DIR.'editor.php' ;
			
			} else {
				include EDITORS_DIR.$NodeInfo['Editor'] ;
			
			}
			break;
		case 'edit_submit':
			include_once SETTING_DIR ."cms.ini.php";

			if(empty($IN[IndexID])) goto('content_list');

			$fieldInfo = content_table_admin::getTableFieldsInfo($NodeInfo[TableID]);			

			$db->query("DELETE FROM  $table->resource_ref WHERE IndexID='{$IN[IndexID]}' ");
			$publish->flushData();
			//debug($IN);
			foreach($fieldInfo as $key=>$var) {
					$field = 'data_'.$var[FieldName];
					if($var[FieldType] == 'contentlink') {
						$field = 'data_'.$var[FieldName].'_value';
						if($IN[$field] == 'undefined') {
							$value = '';
						} else $value = $IN[$field];
						
					
					} elseif(is_array($IN[$field])) {
						foreach($IN[$field] as $keyIn=>$varIn) {
							if($keyIn == 0)
								$value = $varIn;
							else
								$value .= ';'.$varIn;
						}
					} elseif($var[FieldInput] == 'RichEditor') {
						$field = 'data_'.$var[FieldName].'_html';
						$value = RichEditor_Filter($IN[$field]);
						//debug($IN);
						if($IN['data_'.$var[FieldName].'_ImgAutoLocalize'] == '1') {
							//echo $result;
							$ImgAutoLocalize = new ImgAutoLocalize($IN[NodeID]);
							$result = $ImgAutoLocalize->execute($value);

							if($result)
								$value = $result;
						} 
					} else
						$value = $IN[$field];

					 
					LocalImgPathA2R::A2R($value);
					$publish->addData($var[FieldName], $value);
				
			}
			//exit;	 
			//CreationDate  ModifiedDate  CreationUserID  LastModifiedUserID  ApprovedByUserID 
			$publish->addData('ModifiedDate', time());
			$publish->addData('LastModifiedUserID', $sys->session[sUId]);

			//debug($IN);

			$IndexInfo = array(
				'PublishDate'=>strtotime($IN[year].' '.$IN[hour].':'.$IN[minute].':'.$IN[second]),
				'Top'=> empty($IN[Top]) ? 0 : $IN[Top],
				'Pink'=>empty($IN[Pink]) ? 0 : $IN[Pink],
 				//'Sort'=>$IN[Sort],
				'SelfTemplate'=>$IN[SelfTemplate],
				'SelfPublishFileName'=>$IN[SelfPublishFileName],
				'SelfPSN'=>$IN[SelfPSN],
				'SelfPSNURL'=>$IN['SelfPSNURL'],
				'SelfURL'=>$IN[SelfURL],
			);

		//	$publish->debugData();
			if($publish->contentEdit($IN[IndexID], $IndexInfo)) {
				if($NodeInfo[AutoPublish] == 1) {
					if($SYS_ENV['AutoRefreshTree'] == 1) {
						Task::refreshIndexTree($NodeInfo[NodeID], 'parent.window.opener.addThread');
					}				
				
				}
				echo "<script language=JavaScript>
					parent.window.opener.refreshWorkArea();				
					</script>\n";
				showmessage('content_edit_ok',$referer);	
			}else
				goback('content_edit_fail');
			break;

		case 'del':
			include_once SETTING_DIR ."cms.ini.php";

			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->indexDel($var);				
				}

				if($result) {
					//Task::refreshIndex($NodeInfo[NodeID]);
					showmessage('content_del_ok', $referer);
				
				}
				else
					showmessage('content_del_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
				
				if($publish->indexDel($IN[IndexID])) {
					if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) {
							Task::refreshIndexTree($NodeInfo[NodeID]);
						}
						echo "<script>\n
						//parent.window.opener.refreshWorkArea();				
						</script>\n";				
						
					}
					showmessage('content_del_ok', $referer);
			
				}
				else
					showmessage('content_del_fail', $referer);
			
			} else {
				showmessage('content_del_fail', $referer);
			}

			break;
		case 'view':
			if(empty($IN[IndexID])) goto('content_list');
			$pInfo = $publish->getContentInfo($IN[IndexID]);

			$TableID = 	$NodeInfo[TableID];

			$tableInfo = content_table_admin::getTableFieldsInfo($TableID);
			include MODULES_DIR.'content_admin_view.php' ;
			break;

		case 'publish':
			include_once SETTING_DIR ."cms.ini.php";

			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->publish($var);				
				}

				if($result) {
					if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($NodeInfo[NodeID]);
						
					}
					showmessage('content_publish_ok', $referer);
				
				} else
					showmessage('content_publish_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
			
				if($publish->publish($IN[IndexID])) {
					if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($NodeInfo[NodeID]);
						
					}
					showmessage('content_publish_ok', $referer);
				
				} else
					showmessage('content_publish_fail', $referer);
			
			} else
				showmessage('content_publish_fail_not_select', $referer);

			break;
		case 'refresh':
			include_once SETTING_DIR ."cms.ini.php";

			//debug($IN[pData]);exit;

			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->refresh($var);				
				}
				if($result)
					showmessage('content_refresh_ok', $referer);
				else
					showmessage('content_refresh_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
			
				if($publish->refresh($IN[IndexID])) {
					showmessage('content_refresh_ok', $referer);
				
				} else
					showmessage('content_refresh_fail', $referer);
			
			} else
				showmessage('content_refresh_fail_not_select', $referer);

			break;
		case 'unpublish':
			include_once SETTING_DIR ."cms.ini.php";

			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->unpublish($var);				
				}
				if($result) {
					if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($NodeInfo[NodeID]);
						
					}
					showmessage('content_unpublish_ok', $referer);
				
				} else
					showmessage('content_unpublish_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
				if($publish->unpublish($IN[IndexID])) {
					if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($NodeInfo[NodeID]);
						
					}
					showmessage('content_unpublish_ok', $referer);
				
				}else
					showmessage('content_unpublish_fail', $referer);

			} else {
				showmessage('content_unpublish_fail', $referer);
			}
			
			


			break;
		case 'tempUnPublish':
			include_once SETTING_DIR ."cms.ini.php";

			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->unpublish($var, 0);				
				}
				if($result) {
					if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($NodeInfo[NodeID]);
						
					}
					showmessage('content_tempUnPublish_ok', $referer);
				
				} else
					showmessage('content_tempUnPublish_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
				if($publish->unpublish($IN[IndexID], 0)) {
					if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($NodeInfo[NodeID]);
						
					}
					showmessage('content_tempUnPublish_ok', $referer);
				
				}else
					showmessage('content_tempUnPublish_fail', $referer);

			} else {
				showmessage('content_tempUnPublish_fail', $referer);
			}
			
			


			break;
		case 'cut':
			include_once SETTING_DIR ."cms.ini.php";

			if(empty($IN[targetNodeID]))
				showmessage('targetNodeID_null', $referer);
			
			if(!empty($IN[NodeID])) {
				$srcNodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
				$desNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);

				if($srcNodeInfo['TableID'] != $desNodeInfo['TableID'])
					showmessage('content_fail_TableID_unmatch', $referer);
			
			}
			
			
			
			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$publish->unpublish($var);
					$result = $publish->move($var, $IN[targetNodeID]);				
				}
				if($result) {
					if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($NodeInfo[NodeID]);
						
					}
					showmessage('content_move_ok', $referer);
				
				} else
					showmessage('content_move_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
				$publish->unpublish($IN[IndexID]);
				if($publish->move($IN[IndexID], $IN[targetNodeID])) {
					if($NodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($NodeInfo[NodeID]);
						
					}
					showmessage('content_move_ok', $referer);
				
				} else
					showmessage('content_move_fail', $referer);

			} elseif(empty($IN[IndexID]))
				showmessage('IndexID_null', $referer);


			break;
		case 'createLink':
			include_once SETTING_DIR ."cms.ini.php";

			if(empty($IN[targetNodeID]))
				showmessage('targetNodeID_null', $referer);
			

			if(isset($IN[NodeID])) {
				$srcNodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
				$desNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);

				if($srcNodeInfo['TableID'] != $desNodeInfo['TableID'])
					showmessage('content_fail_TableID_unmatch', $referer);
			
			} else {
				$desNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);
				if($IN['srcTableID'] != $desNodeInfo['TableID'])
					showmessage('content_fail_TableID_unmatch', $referer);
			
			}
			
			
			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->createLink($var, $IN[targetNodeID]);				
				}
				if($result) {
					$targetNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);
					if($targetNodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($targetNodeInfo[NodeID]);
						
					}				
					showmessage('content_createLink_ok', $referer);
				} else
					showmessage('content_createLink_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
				if($publish->createLink($IN[IndexID], $IN[targetNodeID])) {
					$targetNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);
					if($targetNodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($targetNodeInfo[NodeID]);
						
					}						
					showmessage('content_createLink_ok', $referer);
				
				} else
					showmessage('content_createLink_fail', $referer);

			} else {
				showmessage('content_createLink_fail', $referer);
			
			}


			break;
		case 'createIndexLink':
			include_once SETTING_DIR ."cms.ini.php";

			if(empty($IN[targetNodeID]))
				showmessage('targetNodeID_null', $referer);
		
			if(isset($IN[NodeID])) {
				$srcNodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
				$desNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);

				if($srcNodeInfo['TableID'] != $desNodeInfo['TableID'])
					showmessage('content_fail_TableID_unmatch', $referer);
			
			} else {
				$desNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);
				if($IN['srcTableID'] != $desNodeInfo['TableID'])
					showmessage('content_fail_TableID_unmatch', $referer);
			
			}
			
			
			
			
			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->createIndexLink($var, $IN[targetNodeID]);				
				}
				if($result) {
					$targetNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);
					if($targetNodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($targetNodeInfo[NodeID]);
						
					}						
					showmessage('content_createIndexLink_ok', $referer);
				
				
				} else
					showmessage('content_createIndexLink_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
				if($publish->createIndexLink($IN[IndexID], $IN[targetNodeID])) {
					$targetNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);
					if($targetNodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($targetNodeInfo[NodeID]);
						
					}				
					showmessage('content_createIndexLink_ok', $referer);
				
				} else
					showmessage('content_createIndexLink_fail', $referer);

			} else {
					showmessage('content_createIndexLink_fail', $referer);
			
			}


			break;
		case 'copy':
			include_once SETTING_DIR ."cms.ini.php";

			if(empty($IN[targetNodeID]))
				showmessage('targetNodeID_null', $referer);

			$srcNodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
			$desNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);

			if($srcNodeInfo['TableID'] != $desNodeInfo['TableID'])
				showmessage('content_fail_TableID_unmatch', $referer);
			
			
			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->copyTo($var, $IN[targetNodeID]);				
				}
				if($result) {
					$targetNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);
					if($targetNodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($targetNodeInfo[NodeID]);
						
					}					
					showmessage('content_copy_ok', $referer);
				} else
					showmessage('content_copy_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
				if($publish->copyTo($IN[IndexID], $IN[targetNodeID])) {
					$targetNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);
					if($targetNodeInfo[AutoPublish] == 1) {
						if($SYS_ENV['AutoRefreshTree'] == 1) Task::refreshIndexTree($targetNodeInfo[NodeID]);
						
					}	
					showmessage('content_copy_ok', $referer);
				} else
					showmessage('content_copy_fail', $referer);

			} elseif(empty($IN[IndexID]))
				showmessage('IndexID_null', $referer);




			break;

		case 'IsRecordExists':
			include_once SETTING_DIR ."cms.ini.php";

			$params[o] = $IN[action];
			$params[NodeID] = $IN[NodeID];
			$params[IndexID] = $IN[IndexID];
			$params[FieldName] = $IN[FieldName];
			$params[FieldValue] = $IN['FieldValue'];

			if($publish->IsRecordExists($params))
				echo 'yes';
			else
				echo 'no';
			exit;
			break;
		case 'topIt':

			if(!empty($IN[IndexID])) {
				$IndexInfo = $publish->getIndexInfo($IN[IndexID]);
				$TPL->assign('IndexInfo', $IndexInfo);
			}
 			$TPL->display('content_topIt.html');
			exit;

			break;
		case 'topIt_submit':
			if(!empty($IN[pData])) {
				foreach($IN[pData] as $var) {
					$result = $publish->top($var, $IN[Weight]);				
				}
				if($result) showmessage('top_mulit_ok', $referer);
				else showmessage('top_mulit_fail', $referer);

			} else if(!empty($IN[IndexID])) {
				if($publish->top($IN[IndexID], $IN[Weight]))
					exit('1');
				else
					exit('0');

			} else {
				showmessage('top_mulit_fail', $referer);
			}
			break;
		case 'pinkIt':
			if(!empty($IN[IndexID])) {
				$IndexInfo = $publish->getIndexInfo($IN[IndexID]);
				$TPL->assign('IndexInfo', $IndexInfo);
				//print_r($IndexInfo);
			}
			$TPL->display('content_pinkIt.html');
			exit;
			break;
		case 'pinkIt_submit':
			if(!empty($IN[pData])) {
				foreach($IN[pData] as $var) {
					$result = $publish->pink($var, $IN[Weight]);				
				}
				if($result) showmessage('pink_mulit_ok', $referer);
				else showmessage('pink_mulit_fail', $referer);

			} else if(!empty($IN[IndexID])) {
				if($publish->pink($IN[IndexID], $IN[Weight]))
					exit('1');
				else
					exit('0');

			} else {
				showmessage('pink_mulit_fail', $referer);

			}
			break;

		case 'sortIt':
			if(!empty($IN[IndexID])) {
				$IndexInfo = $publish->getIndexInfo($IN[IndexID]);
				$TPL->assign('IndexInfo', $IndexInfo);
				//print_r($IndexInfo);
				$TPL->display('content_sortIt.html');
				exit;
			}
			break;
		case 'sortIt_submit':
			if(!empty($IN[IndexID])) {
				if($publish->sortIt($IN[IndexID], $IN[Weight]))
					exit('1');
				else
					exit('0');

			}
			break;


		case 'viewLinkState':
			if(!empty($IN[IndexID])) {
				$LinkState = $publish->getLinkState($IN[IndexID]);
				//debug($LinkState);
				$TPL->assign('LinkState', $LinkState);
				$TPL->display('content_viewLinkState.html');


			}
			break;

		case 'siteRefresh':
			$TPL->display('content_siteRefresh.html');
			$diableDebug = true;
			break;
		case 'sitePublish':
			$TPL->display('content_sitePublish.html');
			$diableDebug = true;
			break;
		case 'recycle_bin':
			$offset = empty( $IN['offset']) ?  15 : $IN['offset'];
			//debug($IN);
			$State = "=-1";
			/*if($IN[State] != '') {
				$State = "=".$IN[State];
			} else {
				$State = "!=-1";
			
			}*/
			$num= $publish->getIndexRecordNum($IN[NodeID], $State);

			$pagenum=ceil($num/$offset);
			if(empty($IN[Page]))
				$Page = 1;
			else
				$Page = $IN[Page];

			$start=($Page-1)*$offset;
			
			$recordInfo[currentPage] = $Page;
			$recordInfo[pageNum] = $pagenum;
			$recordInfo[recordNum] = $num;
			$recordInfo[offset] = $offset;
			$recordInfo[from] = $start;
			$recordInfo[to] = $start+$offset;

			$TPL->assign('DisplayItem', content_table_admin::getDisplayFieldsInfo($NodeInfo[TableID]));
			$TPL->assign('catelist', $CATE_LIST);
			$TPL->assign("pList", $publish->getIndexLimit($IN[NodeID], $start, $offset, $State));
			$TPL->assign("recordInfo", $recordInfo);
			$TPL->assign("NodeInfo", $NodeInfo);
			$TPL->assign("offset", $offset);
			

			$TPL->assign("pagelist",pagelist($pagenum,$Page,"{$base_url}o=recycle_bin&NodeID={$IN[NodeID]}&offset={$offset}",'#000000'));
			$TPL->display('content_admin_recycle_bin_list.html');
			
			break;
		case 'restore':
			include_once SETTING_DIR ."cms.ini.php";

			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->restore($var);				
				}

				if($result) {
					showmessage('content_restore_ok', $referer);
				
				}
				else
					showmessage('content_restore_fail', $referer);

			} else {
				if(empty($IN[IndexID])) showmessage('content_restore_fail', $referer);
				if($publish->restore($IN[IndexID])) {
					exit('1');
			
				}
				else
					exit('0');
			
			}

			break;
		case 'destroy':
			include_once SETTING_DIR ."cms.ini.php";

			if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $var) {
					$result = $publish->destroy($var);				
				}

				if($result) {
					showmessage('content_destroy_ok', $referer);
				
				}
				else
					showmessage('content_destroy_fail', $referer);

			} elseif(!empty($IN[IndexID])) {
				ob_start();
			
				if($publish->destroy($IN[IndexID])) {
					$contents = ob_get_contents();	 
					ob_end_clean();	
					exit('1');
			
				} else {
					$contents = ob_get_contents();	 
					ob_end_clean();	
					exit('0');
				
				}
					
			
			} else {
				showmessage('content_destroy_fail', $referer);

			}

			break;
		case 'empty_recycle_bin':
			if($publish->empty_recycle_bin($IN[NodeID])) {
				showmessage('content_empty_recycle_bin_ok', $referer);
				
			}
			else
				showmessage('content_empty_recycle_bin_fail', $referer);
			break;
		case 'viewpublish':
			$info = $publish->editor_getContentInfo($IN[IndexID]);
			if(empty($info['URL'])) {
				exit('This Document have not published!');
			} else
				header("Location: ".$info['URL']);
		case 'editContentLink':
			switch($IN[extra]) {
				case 'ui_header':
					$TPL->assign('fieldName', $IN[fieldName]);
					$TPL->assign('NODE_LIST', $NODE_LIST);
					$TPL->assign('NodeID', $IN[NodeID]);
					$TPL->assign("NodeInfo", $NodeInfo);
					$TPL->assign("tableInfo", content_table_admin::getTableFieldsInfo($NodeInfo[TableID]));
					$TPL->assign('IndexID', $IN[IndexID]);
					$TPL->display('content_editContentLink_header.html');
					$diableDebug = true;
					break;
				case 'ui_main':
					$offset = empty( $IN['offset']) ?  15 : $IN['offset'];
					//debug($IN);
					if($IN[State] != '') {
						$State = "=".$IN[State];
					} else {
						$State = "=1";
					
					}
					$num= $publish->getIndexRecordNum($IN[NodeID], $State, 1);

					$pagenum=ceil($num/$offset);
					if(empty($IN[Page]))
						$Page = 1;
					else
						$Page = $IN[Page];

					$start=($Page-1)*$offset;
					
					$recordInfo[currentPage] = $Page;
					$recordInfo[pageNum] = $pagenum;
					$recordInfo[recordNum] = $num;
					$recordInfo[offset] = $offset;
					$recordInfo[from] = $start;
					$recordInfo[to] = $start+$offset;

					$TPL->assign('TitleField', content_table_admin::getTitleFieldInfo($NodeInfo[TableID]));
					$TPL->assign('catelist', $CATE_LIST);
					$TPL->assign("pList", $publish->getIndexLimit($IN[NodeID], $start, $offset, $State, 1));
					$TPL->assign("recordInfo", $recordInfo);
					$TPL->assign("NodeInfo", $NodeInfo);
					$TPL->assign("offset", $offset);
					

					$TPL->assign("pagelist",pagelist($pagenum,$Page,"{$base_url}o=editContentLink&extra=ui_main&NodeID={$IN[NodeID]}&State={$IN[State]}&offset={$offset}",'#000000'));
					$TPL->display('content_editContentLink_list.html');					
					break;
				case 'ui_init':
				default:
					$TPL->assign('fieldName', $IN[fieldName]);
					$TPL->assign('IndexID', $IN[IndexID]);
					$TPL->assign('NodeID', $IN[NodeID]);
					$TPL->display('content_editContentLink_frameset.html');
					break;
			}
			break;
		case 'picker_content':
			switch($IN[extra]) {
				case 'ui_header':
					$TPL->assign('fieldName', $IN[fieldName]);
					$TPL->assign('NODE_LIST', $NODE_LIST);
					$TPL->assign('NodeID', $IN[NodeID]);
					$TPL->assign("NodeInfo", $NodeInfo);
					$TPL->assign("tableInfo", content_table_admin::getTableFieldsInfo($NodeInfo[TableID]));
					$TPL->assign('IndexID', $IN[IndexID]);
					$TPL->display('content_picker_content_header.html');
					$diableDebug = true;
					break;
				case 'ui_main':
					$offset = empty( $IN['offset']) ?  15 : $IN['offset'];
					//debug($IN);
					if($IN[State] != '') {
						$State = "=".$IN[State];
					} else {
						$State = "=1";
					
					}
					$num= $publish->getIndexRecordNum($IN[NodeID], $State, 1);

					$pagenum=ceil($num/$offset);
					if(empty($IN[Page]))
						$Page = 1;
					else
						$Page = $IN[Page];

					$start=($Page-1)*$offset;
					
					$recordInfo[currentPage] = $Page;
					$recordInfo[pageNum] = $pagenum;
					$recordInfo[recordNum] = $num;
					$recordInfo[offset] = $offset;
					$recordInfo[from] = $start;
					$recordInfo[to] = $start+$offset;

					$TPL->assign('DisplayItem', content_table_admin::getDisplayFieldsInfo($NodeInfo[TableID]));
					$TPL->assign('TitleField', content_table_admin::getTitleFieldInfo($NodeInfo[TableID]));
					$TPL->assign('catelist', $CATE_LIST);
					$TPL->assign("pList", $publish->getIndexLimit($IN[NodeID], $start, $offset, $State, 1));
					$TPL->assign("recordInfo", $recordInfo);
					$TPL->assign("NodeInfo", $NodeInfo);
					$TPL->assign("offset", $offset);
					

					$TPL->assign("pagelist",pagelist($pagenum,$Page,"{$base_url}o=picker_content&extra=ui_main&NodeID={$IN[NodeID]}&State={$IN[State]}&offset={$offset}",'#000000'));
					$TPL->display('content_picker_content_list.html');					
					break;
				case 'ui_init':
				default:
					$TPL->assign('fieldName', $IN[fieldName]);
					$TPL->assign('IndexID', $IN[IndexID]);
					$TPL->assign('NodeID', $IN[NodeID]);
					$TPL->display('content_picker_content_frameset.html');
					break;
			}
			break;
		case 'node_resync':
			include_once SETTING_DIR ."cms.ini.php";

 			$offset = empty( $IN['offset']) ?  50 : $IN['offset'];
			$InheritNodeID = $iWPC->loadNodeInfo($IN[NodeID], 'InheritNodeID');
			$num= $publish->getIndexRecordNum($InheritNodeID,  '!= -1', 1);
			$pagenum=ceil($num/$offset);
			if(empty($IN[Page]))
				$Page = 1;
			else
				$Page = $IN[Page];

			$start=($Page-1)*$offset;
			$ContentInfo = $publish->getResyncIndexLimit($InheritNodeID, $start , $offset , '!= -1', 1);
			//sort($ContentInfo);
			if(!empty($ContentInfo)) {
				foreach($ContentInfo as $key=>$var) {
					if(!$publish->linkExists($var[ContentID], $IN[NodeID]))
						$publish->createLink($var[IndexID], $IN[NodeID]);
					else
						continue;
				} 				
			}
	

			$Page++;
			if($num > ($start+$offset)) {
				showMsg(sprintf($_LANG_ADMIN['resync_running'], $Page*$offset, $num) , $base_url."o=node_resync&Page={$Page}&NodeID={$IN[NodeID]}");
			
			} else {

				showMsg(sprintf($_LANG_ADMIN['resync_finished'], $num) , $base_url."o=content_list&type=main&NodeID={$IN[NodeID]}");
		
			}
			break;

		case 'planPublish':
			$PublishDate =  strtotime($IN[year].' '.$IN[hour].':'.$IN[minute].':'.$IN[second]);
			if(!empty($IN[pData])) {
				if($IN['setPublishDate']) {
					foreach($IN[pData] as $var) {
						$publish->flushData();
						$publish->addData('Sort', $IN['sort_'.$var]);
						$publish->addData('PublishDate', $PublishDate);
						$result = $publish->indexEdit($var);				
					}			
				} else {
					foreach($IN[pData] as $var) {
						$publish->flushData();
						$publish->addData('Sort', $IN['sort_'.$var]);
 						$result = $publish->indexEdit($var);				
					}			
				
				}

				if($result)
					showmessage('content_planpublish_ok', $referer);
				else
					showmessage('content_planpublish_fail', $referer);
			
			} else {
					showmessage('content_planpublish_ok', $referer);
			
			}

			break;
  

	}




include MODULES_DIR.'footer.php' ;
?>
