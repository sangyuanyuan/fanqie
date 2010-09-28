<?php
require_once 'common.php';



require_once INCLUDE_PATH."admin/site_admin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
//require_once INCLUDE_PATH."admin/tplAdmin.class.php";
require_once INCLUDE_PATH."admin/publishAdmin.class.php";
require_once INCLUDE_PATH."admin/groupAdmin.class.php";
require_once INCLUDE_PATH."admin/userAdmin.class.php";
function getPagersList()
{
		$dir=dir(SYS_PATH.'setting/pager/');
		$dir->rewind();
		while($file=$dir->read()) {
			if( $file=="." || $file=="..") {
				continue;
			} elseif( is_dir(SYS_PATH.'setting/pager/'. $file)) {
				continue;
						
			}else {
				$temp = explode('.', $file);
				$dirlist[] = array(
					'Pager'=> $file,
					'PagerName'=> $temp[0],
		
				);
			}
			
		}
		$dir->close();
		return $dirlist;	
}


function getEditorsList()
{		
		 
		$dir=dir(SYS_PATH.ADMIN_NAME.'/editor');
		$dir->rewind();
		while($file=$dir->read()) {
			if( $file=="." || $file=="..") {
				continue;
			} elseif( is_dir(SYS_PATH.ADMIN_NAME.'/editor/'. $file)) {
				continue;
						
			}else {
				$temp = explode('.', $file);
				$dirlist[] = array(
					'Editor'=> $file,
					'EditorName'=> $temp[0],
		
				);
			}
			
		}
		$dir->close();
		return $dirlist;	
}

$site = new site_admin();
//$template = new tplAdmin();


$ReservedFieldName = array("NodeID" , "NodeGUID" , "TableID" , "ParentID" , "RootID" , "InheritNodeID" , "NodeType" , "NodeSort" , "Name" , "ContentPSN" , "ContentURL" , "ResourcePSN" , "ResourceURL" , "PublishMode" , "IndexTpl" , "IndexName" , "ContentTpl" , "ImageTpl" , "SubDir" , "PublishFileFormat" , "IsComment" , "CommentLength" , "IsPrint" , "IsGrade" , "IsMail" , "Disabled" , "AutoPublish" , "IndexPortalURL" , "ContentPortalURL" , "Pager" , "Editor" , "WorkFlow" , "PermissionManageG" , "PermissionManageU" , "PermissionReadG" , "PermissionReadU" , "PermissionWriteG" , "PermissionWriteU" , "PermissionApproveG" , "PermissionApproveU" , "PermissionPublishG" , "PermissionPublishU" , "PermissionInherit" , "CreationUserID");

require_once INCLUDE_PATH."admin/plugin.class.php";
require_once INCLUDE_PATH."admin/psn_admin.class.php";
$Plugin = new Plugin();

 
switch($IN['o']) {

	case 'view':
		if(!$sys->isAdmin() && !$sys->Auth[canNode]) {
			goback('access_deny_module_cate');
		}

		$NodeInfo = $site->getNodeInfo($IN['NodeID']);

		$TPL->assign('NodeInfo', $NodeInfo);
		$TPL->display("site_view.html");
		break;

	case 'add':
		site_admin::isValid(1);
		$FieldsInfo = $site->getAllFieldsInfo();
		$TPL->assign_by_ref("FieldsInfo", $FieldsInfo);

		if(empty($IN[ParentID])) {
			$TPL->assign('ParentID', 0);
			if(!$site->isSiteAdmin()) goback('site_permission_deny_notadmin');

		} else {
			$TPL->assign('ParentID', $IN[ParentID]);
		}

		$NodeInfo = $iWPC->loadNodeInfo($IN[ParentID]);


		if(!$site->canAccess($NodeInfo, "Manage") ) {
			goback(sprintf($_LANG_ADMIN['site_permission_deny_manage'], $NodeInfo['Name']) ,1);
		}

		if(!empty($IN['basedNodeID'])) {
			$basedNodeInfo = $site->getNodeInfo($IN['basedNodeID']);
			if(!$site->canAccess($basedNodeInfo, "Read") ) {
				goback(sprintf($_LANG_ADMIN['site_permission_deny_read'], $basedNodeInfo['Name']) ,1);
			}
			$TPL->assign_by_ref('NodeInfo', $basedNodeInfo);

		}



			$uInfo = userAdmin::getAll();
			$gInfo = groupAdmin::getAll();

			$PermissionReadG = explode(',', $basedNodeInfo['PermissionReadG']);
			$PermissionWriteG = explode(',', $basedNodeInfo['PermissionWriteG']);
			$PermissionManageG = explode(',', $basedNodeInfo['PermissionManageG']);
			$PermissionApproveG = explode(',', $basedNodeInfo['PermissionApproveG']);
			$PermissionPublishG = explode(',', $basedNodeInfo['PermissionPublishG']);

			$PermissionReadU = explode(',', $basedNodeInfo['PermissionReadU']);
			$PermissionWriteU = explode(',', $basedNodeInfo['PermissionWriteU']);
			$PermissionManageU = explode(',', $basedNodeInfo['PermissionManageU']);
			$PermissionApproveU = explode(',', $basedNodeInfo['PermissionApproveU']);
			$PermissionPublishU = explode(',', $basedNodeInfo['PermissionPublishU']);
			//G
			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionReadG)) $TargetPermissionReadG[] = $var;
				else $SrcPermissionReadG[] = $var;
			}

			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionWriteG)) $TargetPermissionWriteG[] = $var;
				else $SrcPermissionWriteG[] = $var;
			}
			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionManageG)) $TargetPermissionManageG[] = $var;
				else $SrcPermissionManageG[] = $var;
			}
			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionApproveG)) $TargetPermissionApproveG[] = $var;
				else $SrcPermissionApproveG[] = $var;
			}
			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionPublishG)) $TargetPermissionPublishG[] = $var;
				else $SrcPermissionPublishG[] = $var;
			}



			//U
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionReadU)) $TargetPermissionReadU[] = $var;
				else $SrcPermissionReadU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionWriteU)) $TargetPermissionWriteU[] = $var;
				else $SrcPermissionWriteU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionManageU)) $TargetPermissionManageU[] = $var;
				else $SrcPermissionManageU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionApproveU)) $TargetPermissionApproveU[] = $var;
				else $SrcPermissionApproveU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionPublishU)) $TargetPermissionPublishU[] = $var;
				else $SrcPermissionPublishU[] = $var;
			}

 			$TPL->assign_by_ref('SrcPermissionReadG', $SrcPermissionReadG);
 			$TPL->assign_by_ref('TargetPermissionReadG', $TargetPermissionReadG);
 			$TPL->assign_by_ref('SrcPermissionWriteG', $SrcPermissionWriteG);
 			$TPL->assign_by_ref('TargetPermissionWriteG', $TargetPermissionWriteG);
 			$TPL->assign_by_ref('SrcPermissionManageG', $SrcPermissionManageG);
 			$TPL->assign_by_ref('TargetPermissionManageG', $TargetPermissionManageG);

 			$TPL->assign_by_ref('SrcPermissionApproveG', $SrcPermissionApproveG);
 			$TPL->assign_by_ref('TargetPermissionApproveG', $TargetPermissionApproveG);
 			$TPL->assign_by_ref('SrcPermissionPublishG', $SrcPermissionPublishG);
 			$TPL->assign_by_ref('TargetPermissionPublishG', $TargetPermissionPublishG);



 			$TPL->assign_by_ref('SrcPermissionReadU', $SrcPermissionReadU);
 			$TPL->assign_by_ref('TargetPermissionReadU', $TargetPermissionReadU);
 			$TPL->assign_by_ref('SrcPermissionWriteU', $SrcPermissionWriteU);
 			$TPL->assign_by_ref('TargetPermissionWriteU', $TargetPermissionWriteU);
 			$TPL->assign_by_ref('SrcPermissionManageU', $SrcPermissionManageU);
 			$TPL->assign_by_ref('TargetPermissionManageU', $TargetPermissionManageU);

 			$TPL->assign_by_ref('SrcPermissionApproveU', $SrcPermissionApproveU);
 			$TPL->assign_by_ref('TargetPermissionApproveU', $TargetPermissionApproveU);
 			$TPL->assign_by_ref('SrcPermissionPublishU', $SrcPermissionPublishU);
 			$TPL->assign_by_ref('TargetPermissionPublishU', $TargetPermissionPublishU);


		$NodeArray = unserialize($NodeInfo[Nav]);
		if(!empty($NodeArray)) {
			foreach($NodeArray as $key=>$var) {

					if($key == 0) {

						$Navigation = "{$var[Name]}";
							
					} else {
						$Navigation .= "&nbsp;-&gt;&nbsp;{$var[Name]}";
							
					}



			}		
		}


		require_once INCLUDE_PATH."admin/workflowAdmin.class.php";
		$TPL->assign('workflowInfo', workflowAdmin::getAll());
		$TPL->assign('NODE_LIST', $NODE_LIST);
		$TPL->assign('NodeType', $IN['NodeType']);
		$TPL->assign('PagerInfo', getPagersList());
		$TPL->assign('EditorInfo', getEditorsList());
		$TPL->assign('ParentNodeName', $Navigation);

		$TPL->assign('tableInfo', content_table_admin::getAllTable());
		$TPL->display("site_add.html");
		break;

	case 'add_submit':
		$site->flushData();
		$site->filterData($IN);

		if(!empty($IN[data_ParentID])) {
			$nInfo = $iWPC->loadNodeInfo($IN[data_ParentID]);
			//$site->addData("RootID", $nInfo[ParentID]);	
			
			if(!$site->canAccess($nInfo, "Manage") ) {
				goback(sprintf($_LANG_ADMIN['site_permission_deny_manage'], $nInfo['Name']) ,1);
			}

		} else {
			if(!$site->isSiteAdmin()) goback('site_permission_deny_notadmin');
			$site->addData("RootID", 0);		
		
		}



		if($IN['data_NodeType'] == 2) {
			$InheritNodeInfo = $iWPC->loadNodeInfo($IN['data_InheritNodeID']);
			$site->addData('TableID', $InheritNodeInfo['TableID']);

		}

		//$site->debugData();



		if($site->add()) { //插入分类数据
			$cache = new CacheData();
			$cache->makeCache('catelist');
			$iWPC->clearALLNodeInfo();
			$iWPC->loadNodeInfo($site->db_insert_id);
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
			//echo "<script>\n
				//	top.panelMenu.location = top.panelMenu.location ;		
				//</script>\n";
			showmessage('add_site_ok', $base_url."o=edit&NodeID=".$site->db_insert_id);

		} else	
			goback( 'add_site_fail');

		break;
	case 'edit':
 		$FieldsInfo = $site->getAllFieldsInfo();
		$TPL->assign_by_ref("FieldsInfo", $FieldsInfo);

		if(!empty($IN[NodeID])) {
			$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
			if(empty($NodeInfo['NodeID'])) goback('error_NodeID_invalid');

			//Access Detector
			if(!$site->canAccess($NodeInfo, "Manage") ) {
				goback(sprintf($_LANG_ADMIN['site_permission_deny_manage'], $NodeInfo['Name']) ,1);
			}

			$uInfo = userAdmin::getAll();
			$gInfo = groupAdmin::getAll();

			$PermissionReadG = explode(',', $NodeInfo['PermissionReadG']);
			$PermissionWriteG = explode(',', $NodeInfo['PermissionWriteG']);
			$PermissionManageG = explode(',', $NodeInfo['PermissionManageG']);
			$PermissionApproveG = explode(',', $NodeInfo['PermissionApproveG']);
			$PermissionPublishG = explode(',', $NodeInfo['PermissionPublishG']);

			$PermissionReadU = explode(',', $NodeInfo['PermissionReadU']);
			$PermissionWriteU = explode(',', $NodeInfo['PermissionWriteU']);
			$PermissionManageU = explode(',', $NodeInfo['PermissionManageU']);
			$PermissionApproveU = explode(',', $NodeInfo['PermissionApproveU']);
			$PermissionPublishU = explode(',', $NodeInfo['PermissionPublishU']);
			//G
			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionReadG)) $TargetPermissionReadG[] = $var;
				else $SrcPermissionReadG[] = $var;
			}

			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionWriteG)) $TargetPermissionWriteG[] = $var;
				else $SrcPermissionWriteG[] = $var;
			}
			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionManageG)) $TargetPermissionManageG[] = $var;
				else $SrcPermissionManageG[] = $var;
			}
			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionApproveG)) $TargetPermissionApproveG[] = $var;
				else $SrcPermissionApproveG[] = $var;
			}
			foreach($gInfo as $var) {
				if(in_array($var['gId'], $PermissionPublishG)) $TargetPermissionPublishG[] = $var;
				else $SrcPermissionPublishG[] = $var;
			}



			//U
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionReadU)) $TargetPermissionReadU[] = $var;
				else $SrcPermissionReadU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionWriteU)) $TargetPermissionWriteU[] = $var;
				else $SrcPermissionWriteU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionManageU)) $TargetPermissionManageU[] = $var;
				else $SrcPermissionManageU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionApproveU)) $TargetPermissionApproveU[] = $var;
				else $SrcPermissionApproveU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $PermissionPublishU)) $TargetPermissionPublishU[] = $var;
				else $SrcPermissionPublishU[] = $var;
			}

 			$TPL->assign_by_ref('SrcPermissionReadG', $SrcPermissionReadG);
 			$TPL->assign_by_ref('TargetPermissionReadG', $TargetPermissionReadG);
 			$TPL->assign_by_ref('SrcPermissionWriteG', $SrcPermissionWriteG);
 			$TPL->assign_by_ref('TargetPermissionWriteG', $TargetPermissionWriteG);
 			$TPL->assign_by_ref('SrcPermissionManageG', $SrcPermissionManageG);
 			$TPL->assign_by_ref('TargetPermissionManageG', $TargetPermissionManageG);

 			$TPL->assign_by_ref('SrcPermissionApproveG', $SrcPermissionApproveG);
 			$TPL->assign_by_ref('TargetPermissionApproveG', $TargetPermissionApproveG);
 			$TPL->assign_by_ref('SrcPermissionPublishG', $SrcPermissionPublishG);
 			$TPL->assign_by_ref('TargetPermissionPublishG', $TargetPermissionPublishG);



 			$TPL->assign_by_ref('SrcPermissionReadU', $SrcPermissionReadU);
 			$TPL->assign_by_ref('TargetPermissionReadU', $TargetPermissionReadU);
 			$TPL->assign_by_ref('SrcPermissionWriteU', $SrcPermissionWriteU);
 			$TPL->assign_by_ref('TargetPermissionWriteU', $TargetPermissionWriteU);
 			$TPL->assign_by_ref('SrcPermissionManageU', $SrcPermissionManageU);
 			$TPL->assign_by_ref('TargetPermissionManageU', $TargetPermissionManageU);

 			$TPL->assign_by_ref('SrcPermissionApproveU', $SrcPermissionApproveU);
 			$TPL->assign_by_ref('TargetPermissionApproveU', $TargetPermissionApproveU);
 			$TPL->assign_by_ref('SrcPermissionPublishU', $SrcPermissionPublishU);
 			$TPL->assign_by_ref('TargetPermissionPublishU', $TargetPermissionPublishU);


			$TPL->assign('tableInfo', content_table_admin::getAllTable());
			$TPL->assign('NodeInfo', $site->getNodeInfo($IN[NodeID]));
			
			$NodeArray = unserialize($NodeInfo[Nav]);		
			if(!empty($NodeArray)) {
				foreach($NodeArray as $key=>$var) {
					if($key == 0) {
						$Navigation = "{$var[Name]}";						
					} else {
						$Navigation .= "&nbsp;-&gt;&nbsp;{$var[Name]}";					
					}
				}				
			}

			require_once INCLUDE_PATH."admin/workflowAdmin.class.php";
			$TPL->assign('workflowInfo', workflowAdmin::getAll());
			$TPL->assign('ParentNodeName', $Navigation);
			$TPL->assign('PagerInfo', getPagersList());
			$TPL->assign('EditorInfo', getEditorsList());

			$TPL->display("site_edit.html");
	
		} else
			goto('view');

		break;

	case 'edit_submit':
		if(empty($IN[NodeID])) goto('view');

		$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);

		//Access Detector
		if(!$site->canAccess($NodeInfo, "Manage") ) {
			goback(sprintf($_LANG_ADMIN['site_permission_deny_manage'], $NodeInfo['Name']) ,1);
		}

		$site->flushData();
		$site->filterData($IN);

		if($site->update($IN[NodeID])) { //更新节点数据
			$cache = new CacheData();
			$cache->makeCache('catelist');
			$iWPC->clearALLNodeInfo();
			$iWPC->loadNodeInfo($IN[NodeID]);
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
			if($NodeInfo['ContentPSN'] != $site->insData['ContentPSN']) {
				confirm_msg('edit_site_psn_changed', "admin_task.php?sId={$IN[sId]}&o=rePublishContent_unpublish&NodeID={$IN[NodeID]}", $referer);
			} else	showmessage('edit_site_ok', $referer);
		} else	
			showmessage('edit_site_fail', $referer);
		
		break;

	case 'del':
		if(empty($IN[NodeID])) goto('view');

		$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
		//Access Detector
		if(!$site->isCreationUser($NodeInfo)) {
				halt(sprintf($_LANG_ADMIN['site_permission_deny_notCreationUser'], $NodeInfo['Name']) ,1);
		}

		
		if($site->haveSon($IN[NodeID]) && $IN[action] != 'force') {
				confirm("del&NodeID={$IN[NodeID]}&action=force", $_LANG_ADMIN['del_site_haveson']);
			
		} elseif($site->haveSon($IN[NodeID]) && $IN[action] == 'force') {

			if($site->delTree($IN[NodeID])) {
				$cache = new CacheData();
				$cache->makeCache('catelist');
				$iWPC->clearALLNodeInfo();
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				alert('del_site_haveson_ok','panelMenu');


			} else
				alert('del_site_haveson_fail','panelMenu');

		} else {

			if($site->del($IN[NodeID])) {
				$cache = new CacheData();
				$iWPC->clearALLNodeInfo();
				$cache->makeCache('catelist');
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				alert('del_site_ok','panelMenu');
			
			} else
				alert('del_site_fail','panelMenu');

	
		}
		break;
	case 'move':
		if(empty($IN[NodeID])) goto('view');
		
		$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
		//Access Detector
		if(!$site->isCreationUser($NodeInfo)) {
				goback(sprintf($_LANG_ADMIN['site_permission_deny_notCreationUser'], $NodeInfo['Name']) ,1);
		}

		$targetNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);
		//Access Detector
		if(!$site->canAccess($targetNodeInfo, "Manage") ) {
 			halt(sprintf($_LANG_ADMIN['site_permission_deny_manage'], $targetNodeInfo['Name']) ,1);
 		
		}
  		$site->flushData();
		$site->addData('ParentID', $IN[targetNodeID]);

	


		if($IN[NodeID] == $IN[targetNodeID]) {
			alert('move_node_id_conflict','panelMenu');
		
		} elseif($site->update($IN[NodeID])) { //更新节点数据
			$cache = new CacheData();
			$cache->makeCache('catelist');
			$iWPC->clearALLNodeInfo();
			$iWPC->loadNodeInfo($IN[NodeID]);
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				alert('move_site_ok','panelMenu');
		} else
				alert('move_site_fail','panelMenu');
		break;
	case 'sort':
		$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
		
		//Access Detector
		$ParentNodeInfo = $iWPC->loadNodeInfo($NodeInfo[ParentID]);
		if(!$site->canAccess($ParentNodeInfo, "Manage") ) {
			goback(sprintf($_LANG_ADMIN['site_permission_deny_manage'], $ParentNodeInfo['Name']) ,1);
		}

		$diableDebug = true;
		$TPL->assign('NodeInfo', $NodeInfo);
		$TPL->display('site_sort.html');
		break;
	case 'sort_submit':
		if(empty($IN[NodeID])) goto('view');
		
		
		//{{{ Access Detector
		$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
		if(empty($NodeInfo[ParentID])) {
			if(!$site->isSiteAdmin()) goback('site_permission_deny_notadmin');
		} else {
			$ParentNodeInfo = $iWPC->loadNodeInfo($NodeInfo[ParentID]);
			if(!$site->canAccess($ParentNodeInfo, "Manage") ) {
				goback(sprintf($_LANG_ADMIN['site_permission_deny_manage'], $ParentNodeInfo['Name']) ,1);
			}		
		}

		//}}}

		$site->flushData();
		$site->addData('NodeSort', $IN[NodeSort]);

		if($site->update($IN[NodeID])) { //更新节点数据
			$cache = new CacheData();
			$cache->makeCache('catelist');
			$iWPC->clearALLNodeInfo();
			$iWPC->loadNodeInfo($IN[NodeID]);
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				echo '<script>parent.window.close();</script>';
		} 
		break;
	case 'destroy':
		if(empty($IN[NodeID])) goto('view');

  		//{{{ Access Detector
		if(!$site->isSiteAdmin()) goback('site_permission_deny_notadmin');
 
			if($site->destroy($IN[NodeID])) {
				$cache = new CacheData();
				$iWPC->clearALLNodeInfo();
				$cache->makeCache('catelist');
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				alert('destroy_node_ok','panelMenu');
			
			} else
				alert('destroy_node_fail','panelMenu');

	
		
		break;
	case 'restore':

  		//{{{ Access Detector
  		if(!$site->isSiteAdmin()) goback('site_permission_deny_notadmin');

		if(empty($IN[NodeID])) goto('view');


			if($site->restore($IN[NodeID], $IN[targetNodeID])) {
				$cache = new CacheData();
				$iWPC->clearALLNodeInfo();
				$cache->makeCache('catelist');
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				alert('restore_node_ok','panelMenu');
			
			} else
				alert('restore_node_fail','panelMenu');

	
		
		break;

	case 'empty_recycle_bin':
  		//{{{ Access Detector
  		if(!$site->isSiteAdmin()) goback('site_permission_deny_notadmin');

		if( $site->empty_recycle_bin() ) {
			$cache = new CacheData();
			$iWPC->clearALLNodeInfo();
			$cache->makeCache('catelist');
			clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
			alert('empty_recycle_bin_ok','panelMenu');
			
		} else
			alert('empty_recycle_bin_fail','panelMenu');
		break;

	case 'nodePropertyAdmin':
		$fInfo = $site->getAllFieldsInfo();
		$TPL->assign_by_ref("NodePropertys", $fInfo);
		$TPL->display('nodeProperty.main.html');
		break;

	case 'add_node_property':
		$TPL->display('nodeProperty.add.html');
		break;
	case 'edit_node_property':
		$fInfo = $site->getFieldInfo($IN[FieldID]);
		$TPL->assign_by_ref("FieldInfo", $fInfo);
		$TPL->display('nodeProperty.edit.html');
		break;
	case 'add_node_property_submit':
		$data['FieldName'] = $IN['FieldName'];
		$data['FieldTitle'] = $IN['FieldTitle'];
		$data['FieldType'] = $IN['FieldType'];
		$data['FieldSize'] = $IN['FieldSize'];
		$data['FieldInput'] = $IN['FieldInput'];
		$data['FieldDescription'] = $IN['FieldDescription'];
		$data['FieldAccess'] = $IN['FieldAccess'];
		$data['FieldDataSource'] = $IN['FieldDataSource'];
 
		if(in_array($data[FieldName], $ReservedFieldName)) {
			goback(sprintf($_LANG_ADMIN['nodeProperty.add.error.reservedFieldName'], $data[FieldName]) ,1);
		}

		if($site->isFieldNameExists($data['FieldName'])) {
			goback(sprintf($_LANG_ADMIN['nodeProperty.add.error.FieldNameExists'], $data[FieldName]) ,1);
		
		}

		if($site->addField($data)) {
			showmessage('nodeProperty.add.success', $referer);
		} else {
			showmessage('nodeProperty.add.fail', $referer);
					
		}
		break;
	case 'edit_node_property_submit':
		$data['FieldName'] = $IN['FieldName'];
		$data['FieldTitle'] = $IN['FieldTitle'];
		$data['FieldType'] = $IN['FieldType'];
		$data['FieldSize'] = $IN['FieldSize'];
		$data['FieldInput'] = $IN['FieldInput'];
		$data['FieldDescription'] = $IN['FieldDescription'];
		$data['FieldAccess'] = $IN['FieldAccess'];
		$data['FieldDataSource'] = $IN['FieldDataSource'];
 
		if(in_array($data[FieldName], $ReservedFieldName)) {
			goback(sprintf($_LANG_ADMIN['nodeProperty.add.error.reservedFieldName'], $data[FieldName]) ,1);
		}

		if($site->isFieldNameExists($data['FieldName'], $IN[FieldID])) {
			goback(sprintf($_LANG_ADMIN['nodeProperty.add.error.FieldNameExists'], $data[FieldName]) ,1);
		
		}

		if($site->editField($IN[FieldID], $data)) {
			showmessage('nodeProperty.edit.success', $referer);
		} else {
			showmessage('nodeProperty.edit.fail', $referer);
					
		}
		break;
	case 'del_node_property':
		if($site->delField($IN[FieldID])) {
			showmessage('nodeProperty.del.success', $referer);
		} else {
			showmessage('nodeProperty.del.fail', $referer);
					
		}
		break;


}

	
include MODULES_DIR.'footer.php' ;

?>
