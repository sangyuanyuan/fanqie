<?php
require_once 'common.php';


require_once INCLUDE_PATH."admin/publishAdmin.class.php";
require_once INCLUDE_PATH."admin/content_table_admin.class.php";
require_once INCLUDE_PATH."admin/tplAdmin.class.php";
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."cms.class.php";
require_once INCLUDE_PATH."cms.func.php";
require_once INCLUDE_PATH."admin/extra_publish_admin.class.php";
require_once INCLUDE_PATH."admin/site_admin.class.php";

$publish = new publishAdmin();
$extrapublish = new extra_publish_admin();
$site = new site_admin();




if(empty($IN[NodeID])) 	goback('error_NodeID_null');

/*
//权限验证
if(!$sys->canManagePublish('extrapublish', $IN[NodeID])) {
	goback($sys->returnMsg);

}
*/
$publish->NodeInfo = $iWPC->loadNodeInfo($IN[NodeID]);

if(!$site->canAccess($publish->NodeInfo, "Manage") ) {
	goback(sprintf($_LANG_ADMIN['site_permission_deny_manage'], $publish->NodeInfo['Name']) ,1);
}

switch($IN[o]) {
 	case 'view':
		header("Location: ". $extrapublish->getView($IN[PublishID]));
		break;
 

	case 'refreshIndex':			
		if($IN[pageRefresh] == 'yes') {
			$tplname = $publish->NodeInfo[IndexTpl];
			$filename = $publish->NodeInfo[IndexName];
			$filename = str_replace('{NodeID}', $publish->NodeInfo['NodeID'], $filename);
			if(preg_match("/\{(.*)\}/isU", $filename, $match)) {
				eval("\$fun_string = $match[1];");
				$filename = str_replace($match[0], $fun_string, $filename);

			}

			$SYS_ENV[tpl_pagelist][page] = $IN[page];
			$SYS_ENV[tpl_pagelist][filename] = $filename;
			
			$filename = str_replace(".","_{$IN[page]}.", $filename);
			
			if($publish->refreshIndex($IN[NodeID], $tplname, $filename )) { 
				if($SYS_ENV[tpl_pagelist][run] == 'yes') {
			
					showmessage('index_refresh_ok_refreshpage', $base_url."o=refreshIndex&NodeID={$IN[NodeID]}&pageRefresh=yes&page={$SYS_ENV[tpl_pagelist][page]}&extra={$extra}");								
				} else {
					showmessage('index_refresh_ok', $base_url."o=viewIndex&NodeID={$IN[NodeID]}");
				}
			
			}


		} else {
			$tplname = $publish->NodeInfo[IndexTpl];
			$filename = $publish->NodeInfo[IndexName];

			$filename = str_replace('{NodeID}', $publish->NodeInfo['NodeID'], $filename);
			if(preg_match("/\{(.*)\}/isU", $filename, $match)) {
				eval("\$fun_string = $match[1];");
				$filename = str_replace($match[0], $fun_string, $filename);

			}
			$SYS_ENV[tpl_pagelist][filename] = $filename;

			if($publish->refreshIndex($IN[NodeID], $tplname, $filename)) { 
				if($SYS_ENV[tpl_pagelist][run] == 'yes') {

					showmessage('index_refresh_ok_goto_refreshpage', $base_url."o=refreshIndex&NodeID={$IN[NodeID]}&pageRefresh=yes&page={$SYS_ENV[tpl_pagelist][page]}&extra={$extra}");

				} else {
					showmessage('index_refresh_ok', $base_url."o=viewIndex&NodeID={$IN[NodeID]}");
				}
			
				
			
			}else
				showmessage('index_refresh_fail', $base_url."o=viewIndex&NodeID={$IN[NodeID]}");


		
		}




	
	
	
	/*	if($publish->refreshIndex($IN[NodeID], $tplname,$new_tplname )) {






			showmessage('index_refresh_ok', $base_url."o=viewIndex&NodeID={$IN[NodeID]}");
		}else {
			showmessage('index_refresh_fail', $base_url."o=viewIndex&NodeID={$IN[NodeID]}");
		
		}
	*/	
		break;
	
	case 'viewIndex':
		switch($publish->NodeInfo[PublishMode]) {
			case '0';
				return true;
				break;
			case '1':
				$url = str_replace('{NodeID}', $publish->NodeInfo['NodeID'], $publish->NodeInfo[IndexName]);
				if(preg_match("/\{(.*)\}/isU", $url, $match)) {
					eval("\$fun_string = $match[1];");
					$url = str_replace($match[0], $fun_string, $url);

				}
				$location =$publish->getHtmlURL($url);
				//echo $location;exit;
				header("Location: $location ");
				break;
			case '2':
				$url = str_replace('{NodeID}', $publish->NodeInfo['NodeID'], $publish->NodeInfo['IndexPortalURL']);
				$url = str_replace('{Page}', 0, $url);
				header("Location: $url ");

				break;
		
		}
}
?>