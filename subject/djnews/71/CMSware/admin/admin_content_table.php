<?php
require_once 'common.php';
 

if(!$sys->isAdmin()) {
	goback('access_deny_module_field');

}

require_once INCLUDE_PATH."admin/plugin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
$Plugin = new Plugin();
$content_table = new content_table_admin();

switch($IN['o']) {

	case 'viewtable':
		$TPL->assign('tableInfo', $content_table->getAllTable());
		//$TPL->assign('dsnInfo',dsn_admin::getAllDSN());
		$TPL->display("table_viewtable.html");
		break;
	case 'view':
		$TPL->assign('userInfo', $user->getAllUser());
		$TPL->display("view_user.html");
		break;

	case 'addtable_submit':
		content_table_admin::isValid(1);

		if(!empty($IN['tName'])) {
			$content_table->flushData();
			$content_table->addData("Name", $IN['tName']);
			if(!empty($IN['SelfTableID'])) {
				$TableInfo = $content_table->getTableInfo($IN['SelfTableID']);
				if(empty($TableInfo['TableID'])) {
					$content_table->addData("TableID", $IN['SelfTableID']);
				}
			
			}
			//$content_table->addData('DSNID',$IN['DSNID']);
			
			if($content_table->addTable($IN['basedTableID'])) {
				/*$TableID = $content_table->db_insert_id;
				$deploy = new dbDeploy();
				$deploy->connectTo(content_table_admin::getTableInfo($TableID, 'DSNID'), $TableID);
				$deploy->deploy();
				*/
				@unlink(CACHE_DIR.'Cache_ContentModel.php');
				$cache = new CacheData();
				$cache->makeCache('content_model');	
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				//exit;
				goto("edittable&TableID={$content_table->db_insert_id}");
			}
			
		} else {
			goto('viewtable', 'addtable_name_null');
		}
		break;
	case 'edittable':
		if(!empty($IN[TableID])) {
			//$TPL->assign('dsnInfo',dsn_admin::getAllDSN());
			$TPL->assign('tableInfo',$content_table->getTableInfo($IN[TableID]));
			$TPL->assign('tableFieldsInfo',$content_table->getTableFieldsInfo($IN[TableID]));
			$TPL->display("table_edittable.html");
			
		}
		break;
	case 'edittable_submit':
		
		if( $IN['TableID']!='') {
			$content_table->flushData();
			$content_table->addData('Name',$IN['tName']);
			//$content_table->addData('DSNID',$IN['DSNID']);
			
			if($content_table->updateTable($IN['TableID'])) {
				
				//print_r($IN);exit;
				if(!empty($IN['EnableContribution'])) {
					foreach($IN['EnableContribution'] as $key=>$var) {
						if($var!='') {
							$content_table->EnableContribution($var, 1);
						}  
					}
				
				}

				if(!empty($IN['EnableCollection'])) {
					foreach($IN['EnableCollection'] as $key=>$var) {
						if($var!='') {
							$content_table->EnableCollection($var, 1);
						}  
					}
				}

				if(!empty($IN['EnablePublish'])) {
					foreach($IN['EnablePublish'] as $key=>$var) {
						if($var!='') {
							$content_table->EnablePublish($var, 1);
						}  
					}
				}
				if(!empty($IN['EnableFieldSearch'])) {
					foreach($IN['EnableFieldSearch'] as $key=>$var) {
						if($var!='') {
							$content_table->EnableFieldSearch($var, 1);
						}  
					}
				}
				if(!empty($IN['EnableFieldListDisplay'])) {
					foreach($IN['EnableFieldListDisplay'] as $key=>$var) {
						if($var!='') {
							$content_table->EnableFieldListDisplay($var, 1);
						}  
					}
				}

 				/*$TableID = $IN['TableID'];
				$deploy = new dbDeploy();
				$deploy->connectTo(content_table_admin::getTableInfo($TableID, 'DSNID'), $TableID);
				$deploy->deploy();*/

				@unlink(CACHE_DIR.'Cache_ContentModel.php');
				$cache = new CacheData();
				$cache->makeCache('content_model');	
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				goto("edittable&TableID={$IN['TableID']}", 'edittable_submit_ok');
			} else {
				goto("edittable&TableID={$IN['TableID']}", 'edittable_submit_fail');
			}
			
		} else {
			goto('viewtable');
		}

		break;
	case 'deltable':
		if($IN['TableID']!='') {
		//$content_table->delTable($IN['TableID']);exit;
			if($content_table->delTable($IN['TableID'])) {
				@unlink(CACHE_DIR.'Cache_ContentModel.php');
				$cache = new CacheData();
				$cache->makeCache('content_model');	
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				goto("viewtable", 'deltable_ok');
			} else	goto("viewtable", 'deltable_fail');

		}
		break;
	case 'addfield':
		if(!empty($IN['TableID'])) {			
			$TPL->display("table_addfield.html");
		}
		break;
	case 'addfield_submit':
		//fieldname,eName,type,length,default,index,fulltext,after_field
		if( $IN[data][FieldName]!='' &&  $IN[data][FieldTitle]!=''&& $IN[data][FieldType]!='' && $IN['TableID']!='') {
			//echo $IN[data][FieldName];
				//debug($ContentModelReservedFieldName);
				if(in_array($IN[data][FieldName], $ContentModelReservedFieldName)) {
					goback('isContentModelReservedFieldName');
				}

				if($content_table->addField($IN[TableID], $IN[data])) {
					@unlink(CACHE_DIR.'Cache_ContentModel.php');
					$cache = new CacheData();
					$cache->makeCache('content_model');	
					clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
					goto("edittable&TableID={$IN['TableID']}", 'table_add_ok');
									
				} else {
					goto("edittable&TableID={$IN['TableID']}", 'table_add_fail');
				
				}
			
		} else {
			goto("addfield&TableID={$IN['TableID']}", 'table_add_data_null');
		
		}
		break;
	
	case 'editfield':
		if($IN['ContentFieldID']!='') {
			$TPL->assign('fieldInfo',$content_table->getFieldInfo($IN['ContentFieldID']));			
			$TPL->display("table_editfield.html");
		}
		break;

	case 'editfield_submit':
		//fieldname,eName,type,length,default,index,fulltext,after_field
		if( $IN[data][FieldName]!='' &&  $IN[data][FieldTitle]!=''&& $IN[data][FieldType]!='' && $IN['TableID']!='' && $IN['ContentFieldID']!='') {

				if(in_array($IN[data][FieldName], $ContentModelReservedFieldName)) {
					goback('isContentModelReservedFieldName');
				}
				if($content_table->editField($IN['ContentFieldID'], $IN[data])) {
					@unlink(CACHE_DIR.'Cache_ContentModel.php');
					$cache = new CacheData();
					$cache->makeCache('content_model');	
					clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
					goto("edittable&TableID={$IN['TableID']}", 'table_editfield_ok');
									
				} else {
					goto("edittable&TableID={$IN['TableID']}", 'table_editfield_fail');
				
				}
			
		} else {
			goto("editfield&TableID={$IN['TableID']}", 'table_editfield_data_null');
		
		}
		break;

	case 'delfield':
		if($IN[ContentFieldID] != '') {
			if($content_table->delField($IN[ContentFieldID])) {
				@unlink(CACHE_DIR.'Cache_ContentModel.php');
				$cache = new CacheData();
				$cache->makeCache('content_model');	
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				goto("edittable&TableID={$IN['TableID']}", 'table_delfield_ok');
			
			} else 
				goto("edittable&TableID={$IN['TableID']}", 'table_delfield_fail');
		}
		break;
	case 'indexField':
		if($IN[ContentFieldID] != '') {
			if($content_table->indexField($IN[ContentFieldID])) {
				@unlink(CACHE_DIR.'Cache_ContentModel.php');
				$cache = new CacheData();
				$cache->makeCache('content_model');	
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				goto("edittable&TableID={$IN['TableID']}", 'table_indexfield_ok');
			
			} else 
				goto("edittable&TableID={$IN['TableID']}", 'table_indexfield_fail');
		}
		break;
	case 'delFieldIndex':
		if($IN[ContentFieldID] != '') {
		//$content_table->delFieldIndex($IN[ContentFieldID]);exit;
			if($content_table->delFieldIndex($IN[ContentFieldID])) {
				@unlink(CACHE_DIR.'Cache_ContentModel.php');			
				$cache = new CacheData();
				$cache->makeCache('content_model');	
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				goto("edittable&TableID={$IN['TableID']}", 'table_indexfield_ok');
			} else 
				goto("edittable&TableID={$IN['TableID']}", 'table_indexfield_fail');
		}
		break;
		
	case 'orderfield':
		if(!empty($IN[TableID])) {
			$diableDebug = true;
			$TPL->assign('TableID',$IN[TableID]);
			$TPL->assign('tableFieldsInfo',$content_table->getTableFieldsInfo($IN[TableID]));
			$TPL->display("table_orderfield.html");
			
		}
		break;
	case 'orderfield_submit':
		if(!empty($IN[FieldString])) {
			$Fields = explode(',', $IN[FieldString]);
			
			if($content_table->OrderField($Fields)) {
				@unlink(CACHE_DIR.'Cache_ContentModel.php');		
				$cache = new CacheData();
				$cache->makeCache('content_model');	
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
				goto("edittable&TableID={$IN['TableID']}", 'table_reOrdefield_ok');
			} else
				goto("edittable&TableID={$IN['TableID']}", 'table_reOrdefield_fail');
		//debug($Fields);
			
		}

	case 'field_listdisplay':
		if($IN['ContentFieldID']!='') {
				if($content_table->EnableFieldListDisplay($IN['ContentFieldID'], $IN[display])) {
					@unlink(CACHE_DIR.'Cache_ContentModel.php');		
					$cache = new CacheData();
					$cache->makeCache('content_model');	
					clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
					goto("edittable&TableID={$IN['TableID']}");
									
				} else {
					goto("edittable&TableID={$IN['TableID']}");
				
				}
			
		} else {
			goto("editfield&TableID={$IN['TableID']}", 'table_editfield_data_null');
		
		}
		
		break;
	case 'field_setmain':
		if($IN['ContentFieldID']!='') {
				if($content_table->setAsMainField($IN['ContentFieldID'], $IN['TableID'])) {
					@unlink(CACHE_DIR.'Cache_ContentModel.php');		
					$cache = new CacheData();
					$cache->makeCache('content_model');	
					clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
					goto("edittable&TableID={$IN['TableID']}");
									
				} else {
					goto("edittable&TableID={$IN['TableID']}");
				
				}
			
		} else {
			goto("editfield&TableID={$IN['TableID']}", 'table_editfield_data_null');
		
		}
		
		break;
	case 'fieldSetTitle':
		if($IN['ContentFieldID']!='') {
				if($content_table->setAsTitleField($IN['ContentFieldID'], $IN['TableID'])) {
					@unlink(CACHE_DIR.'Cache_ContentModel.php');		
					$cache = new CacheData();
					$cache->makeCache('content_model');	
					clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;
					goto("edittable&TableID={$IN['TableID']}");
									
				} else {
					goto("edittable&TableID={$IN['TableID']}");
				
				}
			
		} else {
			goto("editfield&TableID={$IN['TableID']}", 'table_editfield_data_null');
		
		}
		
		break;
/*	case 'field_setsearch':
		if($IN['ContentFieldID']!='') {
				if($content_table->EnableFieldSearch($IN['ContentFieldID'], $IN['search'])) {
					@unlink(CACHE_DIR.'Cache_ContentModel.php');		
					$cache = new CacheData();
					$cache->makeCache('content_model');	
					goto("edittable&TableID={$IN['TableID']}");
									
				} else {
					goto("edittable&TableID={$IN['TableID']}");
				
				}
			
		} else {
			goto("editfield&TableID={$IN['TableID']}", 'table_editfield_data_null');
		
		}
*/
	case 'deploy':
		$deploy = new dbDeploy();
		$deploy->connectTo(content_table_admin::getTableInfo($IN[TableID], 'DSNID'), $IN[TableID]);
		if( $deploy->deploy() )
			showmessage('content_deploy_ok', $referer);
		else
			showmessage('content_deploy_fail', $referer);
		break;
	case "export":
		if(!empty($IN[TableID])) {

			$TableInfo = $content_table->getTableInfo($IN[TableID]);
			$FieldsInfo = $content_table->getTableFieldsInfo($IN[TableID]);

			$TPL->assign_by_ref('TableInfo', $TableInfo);
			$TPL->assign_by_ref('FieldsInfo', $FieldsInfo);
			
			$contents = $TPL->fetch("content_table_export.xml");
			$ext       .= '.dat';
			$mime_type = 'application/x-dat';
			
			$dump_buffer = &$contents;
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
			$filename = "cms_content_model_".$IN[TableID];
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
	case "export_json":
		if(!empty($IN[TableID])) {
			require_once(INCLUDE_PATH."lib/JSON.php");
			$json = new Services_JSON();

			$TableInfo = $content_table->getTableInfo($IN[TableID]);
			$FieldsInfo = $content_table->getTableFieldsInfo($IN[TableID]);
			
			$contents = $json->encode(array($TableInfo, $FieldsInfo));

			$ext       .= '.dat';
			$mime_type = 'application/x-dat';
			
			$dump_buffer = &$contents;
			$now = gmdate('D, d M Y H:i:s') . ' GMT';
			$filename = "cms_content_model_".$IN[TableID];
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
	case "import":

		$content_model = & get_singleton("CMS.ContentModel");
		$TableData = $content_model->parseContentTableXMLFile($_FILES['uploadFile']['tmp_name']);

		if(!empty($TableData)) {
		 
			$content_table->flushData();
			$content_table->addData("Name", $TableData['Name']);

			$TableInfo = $content_table->getTableInfo($TableData['TableID']);
			if(empty($TableInfo['TableID'])) {
				$content_table->addData("TableID", $TableData['TableID']);
			}
	
			if($content_table->addTable()) {
				$TableID = $content_table->db_insert_id;

				foreach($TableData['Fields'] as $var) {
 					if(in_array($var[FieldName], $ContentModelReservedFieldName)) {
						goback('isContentModelReservedFieldName');
					}

					$content_table->addField($TableID, $var);
				}

				@unlink(CACHE_DIR.'Cache_ContentModel.php');
				$cache = new CacheData();
				$cache->makeCache('content_model');	
				clearDir(SYS_PATH.'sysdata/cache/','index.html;.htaccess') ;

				showmessage('content_table_import_ok', $referer);

			}
	
		} else {

			showmessage('content_table_import_fail', $referer);
		}
		break;

}

	
include('./modules/footer.php');
?>
