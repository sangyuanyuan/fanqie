<?php
require_once 'common.php'; 
if(!$sys->canAccess('canCollection')) {
	goback('access_deny_module_collection');

}


require_once INCLUDE_PATH."admin/collection_cate_admin.class.php";
require_once INCLUDE_PATH."admin/collection_admin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
require_once INCLUDE_PATH."cms.class.php";
require_once INCLUDE_PATH."cms.func.php";
include_once SETTING_DIR ."cms.ini.php";
require_once INCLUDE_PATH.'encoding/encoding.inc.php';
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."admin/plugin.class.php";
require_once INCLUDE_PATH."admin/publishAuthAdmin.class.php";
require_once INCLUDE_PATH."admin/task.class.php";
require_once INCLUDE_PATH.'image.class.php';

$collection = new collection_admin();
$Plugin = new Plugin();

$CateInfo = collection_cate_admin::getCateInfo($IN[CateID]);
collection_admin::isValid();
switch($IN['o']) {
	case 'list':
			$TPL->assign('CateID', $IN[CateID]);
			$TPL->display('collection_admin_frameset.html');
			
			break;
	case 'content_header'://内容管理 头部功能导航
			$TPL->assign('CateID', $IN[CateID]);
			$TPL->assign("CateInfo", $CateInfo);
			$TPL->display('collection_admin_header.html');
			$diableDebug = true;
			break;
	case 'content_list': //内容管理 文章列表
			$offset = empty( $IN['offset']) ?  $SYS_ENV['CollectionPageNum'] : $IN['offset'];
			$num= $collection->getCollectionRecordNum($CateInfo,$IN[CateID]);

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

			$TPL->assign("recordInfo", $recordInfo);
			
			$TPL->assign('DisplayItem', content_table_admin::getDisplayFieldsInfo($CateInfo[TableID]));
			$TPL->assign('catelist', $CATE_LIST);
			$TPL->assign("pList", $collection->getCollectionLimit($CateInfo, $start, $offset));
			$TPL->assign("CateInfo", $CateInfo);
			$TPL->assign("offset", $offset);
			

			$TPL->assign("pagelist",pagelist($pagenum,$Page,"{$base_url}o=content_list&CateID={$IN[CateID]}&offset={$offset}",'#000000'));
			$TPL->display('collection_admin_list.html');
			
			break;

	case 'del':
		require_once INCLUDE_PATH.'admin/resource.class.php';
		$resource = new Resource();
		if(!empty($IN[multi]) && !empty($IN[pData]) ) {
			foreach($IN[pData] as $var) {
				$result = $collection->del($CateInfo,$var);				
			}

			if($result)
				showmessage('del_multi_collection_ok', $referer);
			else
				showmessage('del_multi_collection_fail', $referer);

		} else {
			
			if($collection->del($CateInfo,$IN[CollectionID]))
				showmessage('del_collection_ok', $referer);
			else
				showmessage('del_collection_fail', $referer);
			
		}
		break;
	case 'view':
		if(empty($IN[CollectionID])) goto('content_list');
		$pInfo = $collection->getCollectionInfo($CateInfo, $IN[CollectionID]);
		$TableID = 	$CateInfo[TableID];

		$tableInfo = content_table_admin::getTableFieldsInfo($TableID);
		include MODULES_DIR.'collection_admin_view.php' ;
		break;
	case 'testRule':
		include MODULES_DIR.'crawler.php' ;
		break;
	//debug($IN);
	case 'CrawleringAll':
		include MODULES_DIR.'crawleringAll.php' ;
		break;
	case 'Crawlering':
		include MODULES_DIR.'crawlering.php' ;
		break;
	case 'initMultiThread':
		$TPL->display('collection_MultiThread.html');
		break;
	case 'import':
		if(empty($IN[targetNodeID]))
			showmessage('targetNodeID_null', $referer);
			
		$desNodeInfo = $iWPC->loadNodeInfo($IN[targetNodeID]);

		if($CateInfo['TableID'] != $desNodeInfo['TableID'])
			showmessage('content_fail_TableID_unmatch', $referer);
			
			
			
		if(!empty($IN[multi]) && !empty($IN[pData]) ) {
				foreach($IN[pData] as $key=>$var) {
					$_Counter = $key;
					$result = $collection->import($var, $IN[targetNodeID], $CateInfo);	
 				}
				//exit;
				if($result)
					showmessage('collection_import_ok', $referer);
				else
					showmessage('collection_import_fail', $referer);

		} elseif(!empty($IN[CollectionID])) {
				if($collection->import($IN[CollectionID], $IN[targetNodeID], $CateInfo))
					exit('1');
				else
					exit('0');

		}


			break;

}

	
//include MODULES_DIR.'footer.php' ;

?>