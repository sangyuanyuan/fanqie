<?php
require_once 'common.php';


require_once INCLUDE_PATH."admin/publishAdmin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
require_once INCLUDE_PATH."admin/tplAdmin.class.php";

$publish = new publishAdmin();
	//debug($IN);

if($IN[type] == 'main') {
	if(empty($IN[NodeID])) 	goback('error_NodeID_null');
	$NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);
	switch($IN[o]) {
		case 'frameset':
			$TPL->assign('NodeID', $IN[NodeID]);
			$TPL->display('content_editor_frameset.html');
			
			break;
		case 'frame_header':
			$TPL->assign('NodeID', $IN[NodeID]);
			$TPL->assign("NodeInfo", $NodeInfo);
			$TPL->display('content_editor_header.html');
			$diableDebug = true;
			break;
		case 'add':
			require_once INCLUDE_PATH."admin/content_table_admin.class.php";
			$TableID = 	$NodeInfo[TableID];

			$tableInfo = content_table_admin::getTableFieldsInfo($TableID);

			include MODULES_DIR.'editor.php' ;
 			$diableDebug = true;
			break;
	}
} elseif($IN[type] == 'tmp') {

}


include MODULES_DIR.'footer.php' ;
?>
