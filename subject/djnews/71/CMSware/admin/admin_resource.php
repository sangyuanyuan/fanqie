<?php
require_once 'common.php';

require_once INCLUDE_PATH."admin/resource.class.php";

$resource = new Resource();

switch($IN[o]) {
	case 'list_ui_main':
		$TPL->assign('Category', $IN['Category']);
		$TPL->assign_by_ref('NODE_LIST', $NODE_LIST);
		$TPL->display("resource_list_ui_main.html");
		break;
	case 'list_ui_iframe':
		break;
	case 'list':
		$Category = empty($IN['Category']) ? 'img' : $IN['Category'];
		$NodeID = intval($IN['NodeID']);

		
		$offset = empty( $IN['offset']) ?  28 : $IN['offset'];
		$num= $resource->getResourceNumByNodeID($NodeID, $Category);

		$pagenum = ceil($num/$offset);
		//$Page = empty($IN[Page]) ? 1 : intval($IN[Page]);
		if(!empty($IN['next']))  $_SESSION[ResourceListPage]++; 
		if(!empty($IN['back']))  $_SESSION[ResourceListPage]--; 
		
		$_SESSION[ResourceListPage] = empty($_SESSION[ResourceListPage]) ? 1 : $_SESSION[ResourceListPage] ;
		$_SESSION[ResourceListPage] = $_SESSION[ResourceListPage] > $pagenum ? $pagenum : $_SESSION[ResourceListPage] ;
		$Page = empty($IN[Page]) ? $_SESSION[ResourceListPage] : intval($IN[Page]);
		$Page = intval($Page);

		$start=($Page-1)*$offset;
			
		$recordInfo[currentPage] = $Page;
		$recordInfo[pageNum] = $pagenum;
		$recordInfo[recordNum] = $num;
		$recordInfo[offset] = $offset;
		$recordInfo[from] = $start;
		$recordInfo[to] = $start+$offset;
		
		$List = $resource->getResourceListByNodeIDLimit($NodeID, $Category, $start, $offset);
 		$TPL->assign("recordInfo", $recordInfo);
		$TPL->assign_by_ref('List', $List);
		$TPL->assign_by_ref('NODE_LIST', $NODE_LIST); 
 		if($Category == 'img') $TPL->display('resource_list.html');
		elseif($Category == 'attach')$TPL->display('resource_attach_list.html');
		elseif($Category == 'flash')$TPL->display('resource_flash_list.html');
		
 		break;
	case 'admin_frameset':
  		$TPL->assign('NodeID', $IN['NodeID']);
		if(!empty($IN['NodeID'])) {
			$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
			if(empty($NodeInfo['NodeID'])) goback('error_NodeID_invalid');

		}
		$TPL->display('resource_admin_frameset.html');
		break;
	case 'admin_list_header':
		$Category = empty($IN['Category']) ? 'img' : $IN['Category'];
		$NodeID = intval($IN['NodeID']);
   		$TPL->assign('NodeID', $IN['NodeID']);
		$TPL->display('resource_admin_list_header.html');
		break;
	case 'admin_list':
		$Category = empty($IN['Category']) ? 'img' : $IN['Category'];
		$NodeID = intval($IN['NodeID']);
		$haveLinks = $IN['haveLinks']=='' ? 2 : $IN['haveLinks'];
		
		$offset = empty( $IN['offset']) ?  30 : $IN['offset'];
		if($Category == 'flash') {
			$offset = empty( $IN['offset']) ?  10 : $IN['offset'];
		}
		$num= $resource->getResourceNumByNodeID($NodeID, $Category);

		$pagenum = ceil($num/$offset);
 		
 		$Page = empty($IN[Page]) ? 1 : intval($IN[Page]);

		$start=($Page-1)*$offset;
			
		$recordInfo[currentPage] = $Page;
		$recordInfo[pageNum] = $pagenum;
		$recordInfo[recordNum] = $num;
		$recordInfo[offset] = $offset;
		$recordInfo[from] = $start;
		$recordInfo[to] = $start+$offset;
		
		$List = $resource->getResourceListByNodeIDLimit($NodeID, $Category, $start, $offset);
		$TPL->assign("pagelist",pagelist($pagenum,$Page,"{$base_url}o=admin_list&Category={$Category}&haveLinks={$IN['haveLinks']}&NodeID={$IN[NodeID]}",'#000000'));
   		$TPL->assign('NodeID', $IN['NodeID']);
 		$TPL->assign("recordInfo", $recordInfo);
   		$TPL->assign('haveLinks', $haveLinks);
		$TPL->assign_by_ref('List', $List);
		$TPL->assign_by_ref('NODE_LIST', $NODE_LIST); 
		if($Category == 'img') $TPL->display('resource_img_admin_list.html');
		elseif($Category == 'attach') $TPL->display('resource_attach_admin_list.html');
		elseif($Category == 'flash') $TPL->display('resource_flash_admin_list.html');
		break;
	case 'del':
	//	debug($IN);
		if(!empty($IN[multi]) && !empty($IN[ResourceID]) ) {
			foreach($IN[ResourceID] as $var) {
				$result =  $resource->delResource($var);				
			}

			if($result)	showmessage('resource_multi_del_ok', $referer);
			else showmessage('resource_multi_del_fail', $referer);

		} else {
			if($resource->delResource($IN[ResourceID]))	showmessage('resource_del_ok', $referer);
			else showmessage('resource_del_fail', $referer);
		}
		break;
	case 'viewQuoteContents':
		$List = $resource->getQuoteContents($IN[ResourceID]);
		$TPL->assign_by_ref('List', $List);
		$TPL->display('resource_quote_contents.html');

		break;
	default:
		break;

}
?>